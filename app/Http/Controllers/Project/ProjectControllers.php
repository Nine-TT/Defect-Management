<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TestType;
use App\Models\ErrorType;
use Illuminate\Database\QueryException;


class ProjectControllers extends Controller
{
    function getUserRoleInProject($userID, $projectID)
    {
        $userRole = ProjectMember::where('projectID', $projectID)
            ->where('userID', $userID)
            ->value('role');

        return $userRole;
    }

    function getListTestType($projectID)
    {
        $listType = TestType::where('ProjectID', $projectID)->get();
        return $listType;
    }

    function getListErrorType($projectID)
    {
        $listType = ErrorType::where('ProjectID', $projectID)->get();
        return $listType;
    }

    public function create()
    {
        return view('projects.create');
    }

    public function index()
    {
        $user = Auth::user();
        $userID = $user->userID;

        // Lấy danh sách các dự án mà người dùng là thành viên
        $projectIDs = ProjectMember::where('userID', $userID)->pluck('projectID');

        // Lấy tất cả các dự án có projectID nằm trong danh sách $projectIDs
        $projects = Project::whereIn('projectID', $projectIDs)->get();

        // Tạo một mảng để lưu thông tin dự án, tổng số người dùng và người dùng có vai trò 'Admin' trong từng dự án
        $projectData = [];

        foreach ($projects as $project) {
            // Đếm số người dùng tham gia dự án
            $usersCount = ProjectMember::where('projectID', $project->projectID)->count();

            // Lấy vai trò của người dùng đang đăng nhập trong dự án
            $userRole = ProjectMember::where('projectID', $project->projectID)
                ->where('userID', $userID)
                ->value('role');
            // Lấy giá trị của trường isOpen từ dự án
            $isOpen = $project->isOpen;

            // Lưu thông tin dự án, tổng số người dùng và người dùng 'Admin' vào mảng
            $projectData[] = [
                'project' => $project,
                'usersCount' => $usersCount,
                'userRole' => $userRole,
                'isOpen' => $isOpen,
            ];
        }

        return view('projects/project', ['projectData' => $projectData, 'user' => $user]);
    }




    public function show($id)
    {
        // Lấy dự án dựa trên ID
        $project = Project::find($id);
        $checkRoleAdmin = false;

        $userRole = $this->getUserRoleInProject(Auth::user()->userID, $id);
        if ($userRole == 'Admin') {
            $checkRoleAdmin = true;
        }

        $listTestType = $this->getListTestType($id);
        $listErrorType = $this->getListErrorType($id);

        // Kiểm tra xem dự án có tồn tại hay không
        if (!$project) {
            // Xử lý khi không tìm thấy dự án
            return redirect()->route('projects.index')->with('error', 'Dự án không tồn tại');
        }

        // Lấy thông tin từ bảng projectMember
        $projectMembers = ProjectMember::where('projectID', $id)->get();

        // Tạo một mảng để lưu trữ thông tin người dùng
        $listUser = [];

        // Lấy thông tin từ bảng user cho từng user_id trong danh sách
        foreach ($projectMembers as $projectMember) {
            $userIDs = User::find($projectMember->userID);
            $listUser[] = $userIDs;
        }

        $user = Auth::user();

        return view(
            'projects/project-detail',
            ['project' => $project, 'listUser' => $listUser, 'user' =>  $user, 'checkRoleAdmin' => $checkRoleAdmin, 'listTestType' => $listTestType, 'listErrorType' => $listErrorType]
        );
    }

    public function destroy($id)
    {
        // Find the project by ID
        $project = Project::find($id);


        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        $user = Auth::user();
        $userID = $user->userID;
        // Lấy thông tin vai trò của người dùng trong dự án
        $userRole = ProjectMember::where('projectID', $id)
            ->where('userID', $userID)
            ->value('role');

        // Kiểm tra nếu người dùng có quyền "Admin" thì mới xóa dự án
        if ($userRole === 'Admin') {
            // Xóa các bản ghi liên quan trong projectMembers
            $project->members()->delete();
            // Sau đó, xóa dự án
            $project->delete();

            return redirect()->route('projects.index')->with('success', 'Xóa dư án thành công!');
        } else {
            return redirect()->route('projects.index')->with('error', 'Bạn không có quyền xóa dự án này!');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string',
            'description' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();

            $project = new Project;
            $project->projectName = $request->input('project_name');
            $project->description = $request->input('description');
            $project->projectCreator = $user->userID;
            $project->isOpen = true;
            $project->save();

            $projectMember = new ProjectMember;
            $projectMember->userID = $user->userID;
            $projectMember->role = "Admin";
            $projectMember->projectID = $project->projectID;
            $projectMember->save();

            DB::commit(); // Kết thúc , lưu các thay đổi vào cơ sở dữ liệu

            return redirect()->route('projects.index')->with('success', 'Dự án đã được tạo thành công');
        } catch (\Exception $e) {
            DB::rollBack(); // Quay trở lại trạng thái trước nếu có lỗi

            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo dự án');
        }
    }

    public function handleCreateTestType(Request $request)
    {
        try {
            $userID = Auth::user()->userID;

            // Lấy dữ liệu từ request
            $test_type = $request->input('test_type');
            $projectID = $request->input('projectID');

            $userRole = $this->getUserRoleInProject($userID, $projectID);
            if ($userRole == 'Admin') {
                // Tạo bản ghi mới trong bảng TestType
                $testType = new TestType();
                $testType->typeName = $test_type;
                $testType->projectID = $projectID;
                $testType->save();

                return redirect()->back()->with('success', 'Tạo thành công loại kiểm thử!');
            } else {
                return redirect()->back()->with('error', 'Bạn không có quyền quản trị!');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi cơ sở dữ liệu
            return redirect()->back()->with('error', 'Lỗi cơ sở dữ liệu: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Xử lý lỗi tổng quan
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function handleCreateErrorType(Request $request)
    {
        try {
            $userID = Auth::user()->userID;

            // Lấy dữ liệu từ request
            $error_type = $request->input('error_type');
            $projectID = $request->input('projectID');

            $userRole = $this->getUserRoleInProject($userID, $projectID);
            if ($userRole == 'Admin') {
                // Tạo bản ghi mới trong bảng TestType
                $errorType = new ErrorType();
                $errorType->typeName = $error_type;
                $errorType->projectID = $projectID;
                $errorType->save();

                return redirect()->back()->with('success', 'Tạo thành công loại lỗi!');
            } else {
                return redirect()->back()->with('error', 'Bạn không có quyền quản trị!');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi cơ sở dữ liệu
            return redirect()->back()->with('error', 'Lỗi cơ sở dữ liệu: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Xử lý lỗi tổng quan
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function handleChangeProjectInfo(Request $request)
    {
        try {
            $userID = Auth::user()->userID;

            $projectName = $request->input('projectName');
            $projectID = $request->input('projectID');
            $projectDescription = $request->input('description');

            $userRole = $this->getUserRoleInProject($userID, $projectID);

            if ($userRole == 'Admin') {
                $project = Project::find($projectID);
                $project->projectName = $projectName;
                $project->description = $projectDescription;
                $project->save();

                return redirect()->back()->with('success', 'Thông tin dự án đã được cập nhật!');
            } else {
                return redirect()->back()->with('error', 'Bạn không có quyền cập nhật thông tin dự án!');
            }
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Lỗi cơ sở dữ liệu: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function deleteTestType(Request $request)
    {
        $id = $request->input('test_type_id');

        $testTypes = TestType::find($id);

        if ($testTypes) {
            $testTypes->delete();
            return redirect()->back()->with('success', 'Xoá loại kiểm thử thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại!');
        }
    }

    public function deleteErrorType(Request $request)
    {
        $id = $request->input('error_type_id');

        $errorTypes = ErrorType::find($id);

        if ($errorTypes) {
            $errorTypes->delete();
            return redirect()->back()->with('success', 'Xoá loại lỗi thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại!');
        }
    }
}
