<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\Auth;

class ProjectMemberController extends Controller
{
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

        return redirect()->route('projects.show', ['id' => $projectID, 'user' => $user])->with('success', 'Thêm thành viên thành công!');
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
}
