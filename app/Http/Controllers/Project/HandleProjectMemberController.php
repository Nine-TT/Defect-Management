<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\ProjectMember;

class HandleProjectMemberController extends BaseController
{
    public function handleAddMemberToProject(Request $request)
    {
        // Lấy địa chỉ email và vai trò từ dữ liệu gửi lên
        $user_email = $request->input('user_email');
        $role = $request->input('role');
        $projectID = $request->input('projectID');

        // Tìm người dùng dựa trên địa chỉ email
        $user = User::where('email', $user_email)->first();

        if (!$user) {
            // Xử lý khi không tìm thấy người dùng với địa chỉ email này
            return redirect()->back()->with('error', 'Người dùng không tồn tại');
        }

        $projectMember = new ProjectMember;
        $projectMember->userID = $user->userID;
        $projectMember->role = $role;
        $projectMember->projectID = $projectID;


        $projectMember->save();

        return redirect()->route('projects.show', ['id' => $projectID]);
    }
}
