<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ProjectControllers extends Controller
{
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

        return view('project', ['projectData' => $projectData, 'user' => $user]);
    }




    public function show($id)
    {
        // Lấy dự án dựa trên ID
        $project = Project::find($id);

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

        return view('project-detail', ['project' => $project, 'listUser' => $listUser, 'user' =>  $user]);
    }

    public function destroy($id)
    {
        // Find the project by ID
        $project = Project::find($id);
        $user = Auth::user();

        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

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

        DB::beginTransaction(); // Bắt đầu một giao dịch

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

            DB::commit(); // Kết thúc giao dịch, lưu các thay đổi vào cơ sở dữ liệu

            return redirect()->route('projects.index')->with('success', 'Dự án đã được tạo thành công');
        } catch (\Exception $e) {
            DB::rollBack(); // Quay trở lại trạng thái trước giao dịch nếu có lỗi

            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo dự án');
        }
    }
}
