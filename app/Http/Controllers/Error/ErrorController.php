<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Error;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,): View
    {
        $user = Auth::user();
        $detailsError=null;
        $errorID = $request->input('error_id');
        $projectID = $request->route('projectID');
        $allErrorsInProject = Error::where('projectID',$projectID)->get();
        $project = Project::where('projectID',$projectID)->first();
        if($errorID){
            $detailsError=Error::find($errorID);
        }
        $listError = [];
        $listPending = [];
        $listTested = [];
        $listClosed = [];
        $listCancel = [];

        foreach($allErrorsInProject as $error){
            switch ($error->status){
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

        return view('error.error',[
            'user'=>$user,
            'project'=>$project,
            'projectID'=>$projectID,
            'listError'=>$listError,
            'listPending'=>$listPending,
            'listTested'=>$listTested,
            'listClosed'=>$listClosed,
            'listCancel'=>$listCancel,
            'detailsError'=>$detailsError,
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

            if($error->assignedTo){
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


            if($error->reporter){
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
        $error = Error::find($request->input('errorID'));

        $error->status = $request->input('status');

        $error->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
