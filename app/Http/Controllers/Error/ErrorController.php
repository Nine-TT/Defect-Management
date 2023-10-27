<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Comment;
use App\Models\Error;
use App\Models\ImageError;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,): View
    {
        $user = Auth::user();
        $detailsError = null;
        $errorID = $request->input('error_id');
        $projectID = $request->route('projectID');
        $allErrorsInProject = Error::where('projectID', $projectID)->get();
        $project = Project::where('projectID', $projectID)->first();
        $role = ProjectMember::where('projectID', $projectID)->where('userID', $user->userID)->first()->role;
        if ($errorID) {
            $detailsError = Error::find($errorID);
        }
        $listError = [];
        $listPending = [];
        $listTested = [];
        $listClosed = [];
        $listCancel = [];

        foreach ($allErrorsInProject as $error) {
            switch ($error->status) {
                case "ERROR":
                    array_push($listError, $error);
                    break;
                case "PENDING":
                    array_push($listPending, $error);
                    break;
                case "TESTED":
                    array_push($listTested, $error);
                    break;
                case "CLOSED":
                    array_push($listClosed, $error);
                    break;
                case "CANCEL":
                    array_push($listCancel, $error);
                    break;
                default:
                    break;
            }
        }

        return view('error.error', [
            'user' => $user,
            'project' => $project,
            'projectID' => $projectID,
            'listError' => $listError,
            'listPending' => $listPending,
            'listTested' => $listTested,
            'listClosed' => $listClosed,
            'listCancel' => $listCancel,
            'detailsError' => $detailsError,
            'role' => $role,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'errorName' => 'required|string',
            'description' => 'required|string',
            'stepsToReproduce' => 'required|string',
            'expectedResult' => 'required|string',
            'actualResult' => 'required|string',
            'priority' => 'required|string',
            'projectID' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $error = new Error();
            $error->errorName = $request->input('errorName');
            $error->description = $request->input('description');
            $error->status = "ERROR";
            $error->assignedTo = $request->input('assignedTo');
            $error->estimateTime = $request->input('estimateTime');
            $error->reporter = $request->input('reporter');
            $error->testTypeID = $request->input('testTypeID');
            $error->errorTypeID = $request->input('errorTypeID');
            $error->stepsToReproduce = $request->input('stepsToReproduce');
            $error->expectedResult = $request->input('expectedResult');
            $error->actualResult = $request->input('actualResult');
            $error->priority = $request->input('priority');
            $error->projectID = $request->input('projectID');

            $error->save();

            if ($request->hasFile('files')) {
                $files = $request->file('files');
                foreach ($files as $file) {
                    $path = $file->store('images', 'public');
                    $imageError = new ImageError();
                    $imageError->imagePath = $path;
                    $imageError->errorID = $error->errorID;
                    $imageError->save();
                }
            }

            if ($error->assignedTo) {
                $content = [
                    "projectName" => $error->project->projectName,
                    "projectID" => $error->project->projectID,
                    "type" => "assigned",
                    "user" => $error->assignedToUser,
                    "jobTitle" => $error->errorName,
                    "jobContent" => $error->description,
                ];
                $mail = new SendMail($error->assignedToUser, 'assign-task', $content);
                Mail::send($mail);
            }
            if ($error->reporter) {
                $content = [
                    "projectName" => $error->project->projectName,
                    "projectID" => $error->project->projectID,
                    "type" => "reporter",
                    "user" => $error->reporterUser(),
                    "jobTitle" => $error->errorName,
                    "jobContent" => $error->description,
                ];
                $mail = new SendMail($error->reporterUser, 'assign-task', $content);
                Mail::send($mail);
            }
            DB::commit(); // Kết thúc giao dịch, lưu các thay đổi vào cơ sở dữ liệu
            return redirect()->back()->with('success', 'Dự án đã được tạo thành công');
        } catch (\Exception $e) {
            DB::rollBack(); // Quay trở lại trạng thái trước giao dịch nếu có lỗi
            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $error = Error::find($request->input('errorID'));
        $error->fill($data);
        $updatedData = [];
        $fieldsToCheck = [
            'errorName' => 'Tên lỗi',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'assignedTo' => 'Lập trình viên',
            'estimateTime' => 'Thời gian hoàn thành',
            'reporter' => 'Kiểm thử viên',
            'testTypeID' => 'Loại kiểm thử',
            'errorTypeID' => 'Loại lỗi',
            'stepsToReproduce' => 'Các bước tái hiện lỗi',
            'expectedResult' => 'Kết quả mong muốn',
            'actualResult' => 'Kết quả thực tế',
            'priority' => 'Mức độ nghiêm trọng',
        ];
        ;

        foreach ($error->getDirty() as $field => $label) {
            $updatedData[] = $fieldsToCheck[$field];
        }


        $emailRecipient = [];

        if($error->assignedToUser->email!==Auth::user()->email){
            $emailRecipient[] = $error->assignedToUser;
        }
        if($error->reporterUser->email!==Auth::user()->email){
            $emailRecipient[] = $error->reporterUser;
        }



        if($updatedData){
            $error->save();
            foreach($emailRecipient as $recipient){
                $content = [
                    "projectName" => $error->project->projectName,
                    "errorName" => $error->errorName,
                    "projectID" => $error->project->projectID,
                    "errorID" => $error->errorID,
                    "user" => $recipient,
                    "updater" => Auth::user(),
                    "listUpdate" => $updatedData,
                ];
                $mail = new SendMail($recipient, 'update-task', $content);
                Mail::send($mail);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function taskIndex()
    {
        $user = Auth::user();
        $userID = Auth::user()->userID;

        $listTaskAssignedTo = Error::where('assignedTo', $userID)->get();

        $listTaskReporter = Error::where('reporter', $userID)->get();

        return view('task/task', ['user' => $user, 'listTaskAssignedTo' => $listTaskAssignedTo, 'listTaskReporter' => $listTaskReporter]);
    }

    public function sendComment(Request  $request)
    {
        $content = $request->input('comment');
        $errorID = $request->input('error_id');
        $userID = Auth::user()->userID;

        $comment = new Comment();
        $comment->content = $content;
        $comment->errorID = $errorID;
        $comment->userID = $userID;
        $comment->type = 'text';
        $comment->save();


        return redirect()->back()->with('success', 'Comment thành công!');
    }
}
