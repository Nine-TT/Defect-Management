<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProjectMemberController extends Controller
{

    public function index($projectID)
    {
        $projectMembers = ProjectMember::where('projectID', $projectID)->get();

        // Tạo một mảng để lưu trữ thông tin người dùng và vai trò
        $listUserWithRole = [];

        // Lặp qua danh sách projectMembers để lấy vai trò của từng người dùng
        foreach ($projectMembers as $projectMember) {
            $user = User::find($projectMember->userID);

            // Lấy vai trò từ trường role trong bảng ProjectMember
            $role = $projectMember->role;

            // Thêm thông tin người dùng và vai trò vào mảng
            $listUserWithRole[] = [
                'user' => $user,
                'role' => $role,
            ];
        }

        // dd($listUserWithRole[0]);

        $user = Auth::user();

        $userAuthRole = ProjectMember::where('projectID', $projectID)
            ->where('userID', $user->userID)
            ->first();

        $roleCheck = false;

        if ($userAuthRole && $userAuthRole->role == 'Admin') {
            $roleCheck = true;
        } else {
            $roleCheck = false;
        }

        return view('projects/project_management_user', ['listUser' => $listUserWithRole, 'projectID' => $projectID, 'user' => $user, 'roleCheck' => $roleCheck]);
    }

    public function handleAddMemberToProject(Request $request)
    {

        $user = Auth::user();
        $userID = Auth::user()->userID;

        // Lấy địa chỉ email và vai trò từ dữ liệu gửi lên
        $user_email = $request->input('user_email');
        $role = $request->input('role');
        $projectID = $request->input('projectID');



        $isAdminInProject = ProjectMember::where('userID', $userID)
            ->where('projectID', $projectID)
            ->where('role', 'Admin')
            ->exists();

        if (!$isAdminInProject) {
            // Xử lý khi người dùng hiện tại không có vai trò "Admin" trong dự án
            return redirect()->back()->with('error', 'Bạn không có quyền thêm thành viên vào dự án này!');
        }


        // Tìm người dùng dựa trên địa chỉ email
        $user = User::where('email', $user_email)->first();

        if (!$user) {
            // Xử lý khi không tìm thấy người dùng với địa chỉ email này
            return redirect()->back()->with('error', 'Người dùng không tồn tại!');
        }

        // Kiểm tra xem đã tồn tại cặp userID và projectID trong ProjectMember
        $existingProjectMember = ProjectMember::where('userID', $user->userID)
            ->where('projectID', $projectID)
            ->first();

        if ($existingProjectMember) {
            // Xử lý khi đã tồn tại cặp userID và projectID
            return redirect()->back()->with('error', 'Người dùng đã tồn tại trong dự án!');
        }

        // Nếu không có dữ liệu tồn tại, thêm mới
        $projectMember = new ProjectMember;
        $projectMember->userID = $user->userID;
        $projectMember->role = $role;
        $projectMember->projectID = $projectID;
        $projectMember->save();


        $project = Project::find($projectID);
        $inviter = Auth::user();
        $content = [
            "projectName" => "$project->projectName", "inviter" => $inviter->lastName . " " . $inviter->firstName, "role" => $role, "projectID" => $projectID
        ];

        $mail = new SendMail($user, 'project-invitation', $content);
        Mail::send($mail);


        return redirect()->back()->with('success', 'Thêm thành viên thành công!');
    }

    public function managementUserInProject($projectID)
    {
        // Lấy thông tin từ bảng projectMember
        $projectMembers = ProjectMember::where('projectID', $projectID)->get();

        // Tạo một mảng để lưu trữ thông tin người dùng và vai trò
        $listUserWithRole = [];

        // Lặp qua danh sách projectMembers để lấy vai trò của từng người dùng
        foreach ($projectMembers as $projectMember) {
            $user = User::find($projectMember->userID);

            // Lấy vai trò từ trường role trong bảng ProjectMember
            $role = $projectMember->role;

            // Thêm thông tin người dùng và vai trò vào mảng
            $listUserWithRole[] = [
                'user' => $user,
                'role' => $role,
            ];
        }

        $user = Auth::user();

        return view('projects/project_management_user', ['listUser' => $listUserWithRole, 'projectID' => $projectID, 'user' => $user]);
    }

    public function deleteUser(Request $request)
    {

        $user = Auth::user();
        $userID = $user->userID;
        $user_id = $request->input('user_id');
        $project_id = $request->input('projectID');


        // Lấy thông tin vai trò của người dùng trong dự án
        $userRole = ProjectMember::where('projectID', $project_id)
            ->where('userID', $userID)
            ->value('role');


        // Kiểm tra nếu người dùng có quyền "Admin" thì mới xóa dự án
        if ($userRole === 'Admin' && $user_id != $userID) {
            ProjectMember::where('projectID', $project_id)
                ->where('userID', $user_id)
                ->delete();



            return redirect()->route('projects.member', ['projectID' => $project_id])
                ->with('success', 'Xóa người dùng ra khỏi dự án thành công!');
        } else {
            return redirect()->route('projects.member', ['projectID' => $project_id])
                ->with('error', 'Xóa người dùng ra khỏi dự án thất bại!');
            dd('Deletion fail');
        }
    }

    public function handleChangeRole(Request $request)
    {
        $projectID = $request->input('projectID');
        $authUserID = Auth::user()->userID;
        $userID = $request->input('user_id');
        $role = $request->input('role');

        // Lấy thông tin vai trò của người dùng trong dự án
        $userRole = ProjectMember::where('projectID', $projectID)
            ->where('userID', $authUserID)
            ->value('role');

        // lay ra thong tin du an de lay id nguoi tao
        $projectCreator = Project::where('projectID', $projectID)->first();


        // Kiểm tra nếu người dùng có quyền "Admin"
        if ($userRole === 'Admin' && $authUserID != $userID && $authUserID == $projectCreator->projectCreator) {
            $projectMember = ProjectMember::where('userID', $userID)
                ->where('projectID', $projectID)
                ->first();

            if ($projectMember) {
                // Cập nhật trường role của dòng tìm được
                $projectMember->role = $role;
                $projectMember->save(); // Lưu thay đổi vào cơ sở dữ liệu
            }

            return redirect()->back()->with('success', 'Vai trò đã được thay đổi thành công.');
        } else {
            return redirect()->back()->with('error', 'Thay đổi thất bại!');
        }
    }
}
