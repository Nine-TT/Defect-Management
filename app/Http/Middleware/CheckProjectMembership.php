<?php

namespace App\Http\Middleware;

use App\Models\ProjectMember;
use Closure;
use Illuminate\Http\Request;


class CheckProjectMembership
{
    public function handle(Request $request, Closure $next)
    {
        $userId = auth()->user()->userID;
        $projectId = $request->route('id');

        // Kiểm tra xem người dùng có trong dự án không
        $projectMember = ProjectMember::where('userID', $userId)
            ->where('projectID', $projectId)
            ->first();

        if (!$projectMember) {
            return redirect()->route('projects.index');
        }

        return $next($request);
    }
}
