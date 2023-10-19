<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectControllers extends Controller
{
    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        // Xác thực và xử lý dữ liệu từ form
        $request->validate([
            'project_name' => 'required|string',
            'description' => 'required|string',
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $project = new Project;
        $project->project_name = $request->input('project_name');
        $project->description = $request->input('description');
        $project->user_id = $request->input('user_id'); // Bạn cũng có thể lấy user_id từ session hoặc Auth::user()

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Dự án đã được tạo thành công');
    }
}
