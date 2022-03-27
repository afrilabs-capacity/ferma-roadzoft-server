<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupervisorReportController;
use App\Http\Controllers\VerificationController;
use Spatie\Permission\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
// use App\Http\Controllers\UserController;
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Credentials', ' true');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register', [AuthController::class, 'register'])->middleware('auth:sanctum');
Route::post('/register/citizen', [AuthController::class, 'registerCitizen']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])
    ->middleware('auth:sanctum');

    Route::post('/verify-account', [VerificationController::class, 'verifyAccount'])->middleware('auth:sanctum');    
    Route::get('/resend-verification-code', [VerificationController::class, 'resendVerificationCode'])->middleware('auth:sanctum'); 
    
    Route::post('/password-recovery-email-validation', [VerificationController::class, 'sendValidationCodeIfEmailExists']); 

    Route::post('/verify-account/password-recovery', [VerificationController::class, 'verifyAccountPasswordRecovery']); 

    Route::post('/verify-account/password-reset', [VerificationController::class, 'resetAccountPassword']);


    

/*project routes*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/project', [ProjectController::class, 'create'])
        ->middleware('auth:sanctum');
    Route::delete('/project/{id}', [ProjectController::class, 'delete'])
        ->middleware('auth:sanctum');
    Route::get('/projects', [ProjectController::class, 'getAllProjects'])
        ->middleware('auth:sanctum');
    Route::get('/project/reports/{project_id}/{user_id}', [ReportController::class, 'getUserReportsByProject']);
});

Route::post('/platform', [PlatformController::class, 'create'])
    ->middleware('auth:sanctum');
Route::delete('/platform/{id}', [PlatformController::class, 'delete'])
    ->middleware('auth:sanctum');
Route::get('/platforms', [PlatformController::class, 'list'])
    ->middleware('auth:sanctum');
Route::get('/platform/{plarform_id}/assign/user/{user_id}', [PlatformController::class, 'assignPlatform'])
    ->middleware('auth:sanctum');
Route::get('/platform/{prlatform_id}/detach/user/{user_id}', [PlatformController::class, 'detachPlatform'])
    ->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index'])
    ->middleware('auth:sanctum');
Route::get('user/{user_id}', [UserController::class, 'getUser'])
    ->middleware('auth:sanctum');
Route::patch('user/update/{id}', [UserController::class, 'updateUser'])
    ->middleware('auth:sanctum');
Route::delete('user/delete/{id}', [UserController::class, 'deleteUser'])
    ->middleware('auth:sanctum');
Route::post('users/search', [UserController::class, 'searchUsers'])
    ->middleware('auth:sanctum');


Route::post('/supervisor/report', [SupervisorReportController::class, 'create'])
    ->middleware('auth:sanctum');
Route::get('/supervisor/reports', [SupervisorReportController::class, 'index'])
    ->middleware('auth:sanctum');

Route::get('/supervisor/report/{report_id}', [SupervisorReportController::class, 'getSupervisorReport'])
    ->middleware('auth:sanctum');

Route::get('supervisor/report/{report_id}/action/{action_id}', function ($report_id, $action_id) {

    $report = \App\Models\SupervisorReport::findOrFail($report_id);
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    if (!isset($action_id) || $action_id > 2) {
        abort(403, 'Invalid action ID, allowed actions are 0=Approved, 1=Rejected, 2=Pending');
    }

    $status = ['Approved', 'Rejected', 'Queried'];

    \App\Models\SupervisorReport::where('id', $report->id)
        ->update(['status' => $status[$action_id]]);

    return response()->json(['success' => true, 'data' => \App\Models\SupervisorReport::findOrFail($report_id), 'message' => "Report with ID: $report_id has been " . $status[$action_id]], 200);
})->middleware('auth:sanctum');


Route::post('supervisor/queried', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff') && !auth()
        ->user()
        ->hasRole('Supervisor')) {
        abort(403, 'Unauthorized action.');
    }

    if (!auth()
        ->user()
        ->hasRole('Supervisor')) {
        $report = \App\Models\SupervisorReport::findOrFail($request->report_id);
    } else {
        $report = \App\Models\SupervisorReport::findOrFail($request->report_id);
    }


    // return [$report];

    if ($report->status !== "Queried") {
        abort(403, 'Unauthorized action. You can only leave a comment on a queried report.');
    }
    $request->validate(['comment' => 'required']);

    if (!auth()
        ->user()
        ->hasRole('Supervisor')) {

        if (
            \App\Models\SupervisorQueryComment::where('report_id', $report->id)
            ->get()
            ->count() < 2 && $report->or !== null
        ) {
            \App\Models\SupervisorQueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => Uuid::uuid4(), 'user_id' => $report->user_id, 'type' => 'Supervisor', 'comment' => $report->or, 'created_at' => $report->created_at]);

            $message = \App\Models\SupervisorQueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => Uuid::uuid4(), 'user_id' => auth()
                ->user()->id, 'type' => 'admin', 'comment' => $request->comment]);
        } else {
            $message = \App\Models\SupervisorQueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => Uuid::uuid4(), 'user_id' => auth()
                ->user()->id, 'type' => 'admin', 'comment' => $request->comment]);
        }
    } else {

        $message = \App\Models\SupervisorQueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => Uuid::uuid4(), 'user_id' => auth()
            ->user()->id, 'type' => 'Supervisor', 'comment' => $request->comment]);
    }

    return response()
        ->json(['success' => true, 'data' => $message, 'message' => 'Comment Added'], 200);
})->middleware('auth:sanctum');

Route::post('supervisor/queried/approve', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff') && !auth()
        ->user()
        ->hasRole('Supervisor')) {
        abort(403, 'Unauthorized action.');
    }

    $comment = \App\Models\SupervisorQueryComment::where('uuid', $request->comment_uuid)
        ->where('report_uuid', $request->report_uuid)
        ->firstOrFail();

    $report = \App\Models\SupervisorReport::where('uuid', $request->report_uuid)
        ->firstOrFail();

    if ($report->status !== "Queried") {
        abort(403, 'Unauthorized action. You can only approve a comment where report status=Queried.');
    }

    if ($comment->type !== "Supervisor") {
        abort(403, 'Unauthorized action. You can only approve a comment from an Supervisor.');
    }

    $request->validate(['comment_uuid' => 'required', 'report_uuid' => 'required']);

    $report->update(['status' => 'Approved', 'message' => $comment->comment]);

    return response()
        ->json(['success' => true, 'data' => \App\Models\Report::where('uuid', $request->report_uuid)
            ->first(), 'message' => 'Comment Approved'], 200);
})
    ->middleware('auth:sanctum');

Route::get('supervisor/queried/{uuid}', function ($uuid) {
    if (!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Staff') && !auth()->user()->hasRole('Supervisor')) {
        abort(403, 'Unauthorized action.');
    }
    $report = \App\Models\SupervisorReport::where('uuid', $uuid)->firstOrFail();

    if ($report->status !== "Queried") {
        abort(403, 'Unauthorized action. You can only fetch comments on a queried report.');
    }

    return response()
        ->json(['success' => true, 'data' => \App\Models\SupervisorQueryComment::where('report_id', $report->id)
            ->paginate(20), 'message' => 'Comment Added'], 200);
})
    ->middleware('auth:sanctum');


Route::get('roles', function () {

    $accessLogId = \App\Models\AccessLog::where('name', 'Role Logs')->firstOrFail();

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    if (auth()
        ->user()
        ->hasRole('Super Admin')
    ) {
        \App\Models\AccessLogRole::create(['action' => "READ", 'description' => "Accessed all roles", 'user_id' => auth()
            ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);

        return response()
            ->json(['success' => true, 'data' => Role::all(), 'message' => 'All roles'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Admin')
    ) {
        \App\Models\AccessLogRole::create(['action' => "READ", 'description' => "Accessed all roles", 'user_id' => auth()
            ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);

        return response()
            ->json(['success' => true, 'data' => Role::where('name', "!=", "Super Admin")
                ->where('name', "!=", "Admin")
                ->get(), 'message' => 'All roles'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Staff')
    ) {
        \App\Models\AccessLogRole::create(['action' => "READ", 'description' => "Accessed all roles", 'user_id' => auth()
            ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);

        return response()
            ->json(['success' => true, 'data' => Role::where('name', "!=", "Super Admin")
                ->where('name', "!=", "Admin")
                ->where('name', "!=", "Staff")
                ->get(), 'message' => 'All roles'], 200);
    }
})
    ->middleware('auth:sanctum');




Route::post('/report', function (Request $request) {
    $project = \App\Models\Project::findOrFail($request->project_id);
    $user = \App\Models\User::findOrFail($request->user_id);
    //$report = \App\Models\Report::create($request->all());

    $doesReportExist = \App\Models\Report::where('uuid', $request->uuid)->first();

    if (!isset($doesReportExist->id)) {

        $modifiedRequest = $request->all();

        if ($request->has('sos')) {
            $modifiedRequest['sos'] = $request->sos == 'Yes' ? 1 : 0;
        }

        if ($request->has('gtw')) {
            $modifiedRequest['gtw'] = $request->gtw == 'Yes' ? 1 : 0;
        }

        if ($request->has('eqw')) {
            $modifiedRequest['eqw'] = $request->eqw == 'Yes' ? 1 : 0;
        }

        $report = \App\Models\Report::create($modifiedRequest);
    } else {
        $report =  $doesReportExist;
    }


    $accessLogId = \App\Models\AccessLog::where('name', 'Report Logs')->firstOrFail();

    \App\Models\AccessLogReport::create(['action' => "WRITE", 'description' => "Created report", 'user_id' => auth()
        ->user()->id, 'affected_model_id' => $report->id, 'access_log_id' => $accessLogId->id]);
    // if (!$user->hasRole('Ad-hoc') || !$user->hasRole('Citizen')) {
    //     abort(403, 'Unauthorized action.');
    // }
    // if (!$project->users()
    //     ->where('user_id', $user->id)
    //     ->exists()) {
    //     abort(403, 'Unauthorized action (User does not exist on project ' . $project->title . ' ).');;
    // }
    return response()
        ->json(['success' => true, 'data' => $report, 'message' => 'Report Created'], 200);
})->middleware('auth:sanctum');

Route::post('/report/sync', function (Request $request) {

    $report = \App\Models\Report::where('uuid', $request->uuid)
        ->first();
    if (!auth()
        ->user()
        ->hasRole('Ad-hoc')) {
        abort(403, 'Unauthorized action.');
    }

    return response()
        ->json(['success' => true, 'data' => $report, 'message' => 'Report Created'], 200);
})->middleware('auth:sanctum');

Route::get('/report/download/sync', function (Request $request) {

    $reports = \App\Models\Report::where('user_id', auth()->user()
        ->id)
        ->get();
    if (!auth()
        ->user()
        ->hasRole('Ad-hoc')) {
        abort(403, 'Unauthorized action.');
    }

    return response()
        ->json(['success' => true, 'data' => $reports, 'message' => 'All Reports'], 200);
})->middleware('auth:sanctum');

Route::get('/report/{report_id}/action/{action_id}', function ($report_id, $action_id) {

    $report = \App\Models\Report::findOrFail($report_id);
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    if (!isset($action_id) || $action_id > 2) {
        abort(403, 'Invalid action ID, allowed actions are 0=Approved, 1=Rejected, 2=Pending');
    }

    $status = ['Approved', 'Rejected', 'Queried'];

    \App\Models\Report::where('id', $report->id)
        ->update(['status' => $status[$action_id]]);

    return response()->json(['success' => true, 'data' => \App\Models\Report::findOrFail($report_id), 'message' => "Report with ID: $report_id has been " . $status[$action_id]], 200);
})->middleware('auth:sanctum');

Route::get('/reports', function (Request $request) {
    if ($request->header('X-RGM-PLATFORM') == "") {
        abort(403, 'Please provide platform header e.g X-RGM-PLATFORM:Citizen X-RGM-PLATFORM:Ad-hoc.');
    }
    if ($request->header('X-RGM-PLATFORM') !== "Ad-hoc" && $request->header('X-RGM-PLATFORM') !== "Citizen") {
        abort(403, 'X-RGM-PLATFORM value must be Citizen or Ad-hoc .');
    }
    $reports = \App\Models\Report::with('user')->orderBy('id', 'desc');
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff') && !auth()
        ->user()
        ->hasRole('Supervisor')) {
        abort(403, 'Unauthorized action (Requires Super Admin, Admin, Staff, or Supervisor roles for Access).');
    }


    $reports->whereHas('user.roles', function ($query) use ($request) {
        $query->where('name', $request->header('X-RGM-PLATFORM'));
    });


    if (
        auth()
        ->user()
        ->hasRole('Supervisor')
    ) {

        $reports->whereHas('user', function ($query) use ($request) {
            if ($request->has('state_id') && !is_null($request->state_id)) {
                if (auth()->user()->supervisorstate()->where('state_id', $request->state_id)->exists()) {
                    $query->where('state', $request->state_id);
                } else {
                    $query->where('state', null);
                }
            }

            if ($request->has('lga_id') && !is_null($request->lga_id)) {

                $stateByLga = \App\Models\LocalGovernment::find($request->lga_id);
                if (auth()->user()->supervisorstate()->where('state_id', $stateByLga->state_id)->exists()) {
                    $query->where('lga', $request->lga_id);
                } else {
                    $query->where('state', null);
                }
            }

            if (is_null($request->state_id) && is_null($request->lga_id)) {
                $spStates = auth()->user()->supervisorstate()->get()->pluck('id');
                $query->whereIn('state', $spStates);
            }
        });



        if ($request->has('status') && !is_null($request->status)) {
            $reports->where('status', $request->status);
        }



        return response()
            ->json(['success' => true, 'data' => $reports->paginate(20), 'message' => 'All reports', 'report_meta' => [
                'Approved' => $reports->where('status', 'Approved')->count(),
                'Pending' => $reports->where('status', 'Pending')->count(),
                'Rejected' => $reports->where('status', 'Rejected')->count(),
                'Queried' => $reports->where('status', 'Queried')->count(),
                'Total' => $reports->count()
            ]], 200);
    } else {


        $reports->whereHas('user', function ($query) use ($request) {
            if ($request->has('state_id') && !is_null($request->state_id)) {
                $query->where('state', $request->state_id);
            }

            if ($request->has('lga_id') && !is_null($request->lga_id)) {
                $query->where('lga', $request->lga_id);
            }
        });


        if ($request->has('status') && !is_null($request->status)) {
            $reports->where('status', $request->status);
        }

        return response()
            ->json(['success' => true, 'data' => $reports->paginate(20), 'message' => 'All reports', 'report_meta' => [
                'Approved' => \App\Models\Report::where('status', 'Approved')->get()->count(),
                'Pending' => \App\Models\Report::where('status', 'Pending')->get()->count(),
                'Rejected' => \App\Models\Report::where('status', 'Rejected')->get()->count(),
                'Queried' => \App\Models\Report::where('status', 'Queried')->get()->count(),
                'Total' => \App\Models\Report::all()->count()
            ]], 200);
    }
})
    ->middleware('auth:sanctum');

Route::post('/reports/search', function (Request $request) {
    if ($request->header('X-RGM-PLATFORM') == "") {
        abort(403, 'Please provide platform header e.g X-RGM-PLATFORM:Citizen X-RGM-PLATFORM:Ad-hoc.');
    }
    if ($request->header('X-RGM-PLATFORM') !== "Ad-hoc" && $request->header('X-RGM-PLATFORM') !== "Citizen") {
        abort(403, 'X-RGM-PLATFORM value must be Citizen or Ad-hoc .');
    }
    $projects = \App\Models\Report::with('user')->orderBy('id', 'desc');
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }


    if (
        auth()
        ->user()
        ->hasRole('Supervisor') && (!auth()
            ->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff'))
    ) {

        $projects->whereHas('user', function ($query) use ($request) {
            if (auth()->user()->supervisorstate()->exists()) {
                $spStates = auth()->user()->supervisorstate()->get()->pluck('id');
                $query->whereIn('state', $spStates);
            }

            if (auth()->user()->supervisorslga()->exists()) {
                $spLgas = auth()->user()->supervisorslga()->get()->pluck('id');
                $query->whereIn('lga', $spLgas);
            }
        });
    }

    $projects->whereHas('user.projects', function ($query) use ($request) {
        !is_null($request->project_id) ? $query->where('project_id', $request->project_id) : "";
    });

    $projects->whereHas('user', function ($query) use ($request) {
        !is_null($request->state) ? $query->where('state', $request->state) : "";
    });
    $projects->whereHas('user', function ($query) use ($request) {
        !is_null($request->lga) ? $query->where('lga', $request->lga) : "";
    });

    $projects->whereHas('user.roles', function ($query) use ($request) {
        $query->where('name', $request->header('X-RGM-PLATFORM'));
    });

    return response()
        ->json(['success' => true, 'data' => $projects->paginate(20), 'message' => 'All reports'], 200);
})
    ->middleware('auth:sanctum');

/*Queried endpoints*/
Route::get('/reports/queried', function (Request $request) {
    $reports = \App\Models\Report::with('user')->where('status', 'Queried')
        ->orderBy('id', 'desc')
        ->paginate(20);
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    return response()
        ->json(['success' => true, 'data' => $reports, 'message' => 'All queried reports'], 200);
})->middleware('auth:sanctum');

Route::get('/reports/approved', function (Request $request) {
    $reports = \App\Models\Report::with('user')->where('status', 'Approved')
        ->orderBy('id', 'desc')
        ->paginate(20);
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    return response()
        ->json(['success' => true, 'data' => $reports, 'message' => 'All approved reports'], 200);
})->middleware('auth:sanctum');

Route::get('/reports/pending', function (Request $request) {
    $reports = \App\Models\Report::with('user')->where('status', 'Pending')
        ->orderBy('id', 'desc')
        ->paginate(20);
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    return response()
        ->json(['success' => true, 'data' => $reports, 'message' => 'All pending reports'], 200);
})->middleware('auth:sanctum');

Route::get('/reports/rejected', function (Request $request) {
    $reports = \App\Models\Report::with('user')->where('status', 'Rejected')
        ->orderBy('id', 'desc')
        ->paginate(20);
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    return response()
        ->json(['success' => true, 'data' => $reports, 'message' => 'All rejected reports'], 200);
})->middleware('auth:sanctum');

Route::get('/project/{project_id}/users', function ($projectId) {
    $project = \App\Models\Project::findOrFail($projectId);
    $users = $project->users()
        ->orderBy('id', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(20);
    $accessLogId = \App\Models\AccessLog::where('name', 'Project Logs')->firstOrFail();
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    \App\Models\AccessLogProject::create(['action' => "READ", 'description' => "Accessed all projects", 'user_id' => auth()
        ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);
    return response()
        ->json(['success' => true, 'data' => $users, 'message' => 'User reports'], 200);
})->middleware('auth:sanctum');

Route::get('/user/{user_id}/reports', function ($userId) {
    $user = \App\Models\User::findOrFail($userId);
    $reports = \App\Models\Report::where('user_id', $userId)->orderBy('id', 'desc')
        ->paginate(20);

    $accessLogId = \App\Models\AccessLog::where('name', 'User Logs')->firstOrFail();

    if (
        auth()
        ->user()->id !== $user->id && !$user->hasRole('Super Admin') && !$user->hasRole('Admin') && !$user->hasRole('Staff') && !$user->hasRole('Ad-hoc')
    ) {
        abort(403, 'Unauthorized action.');
    }
    \App\Models\AccessLogUser::create(['action' => "READ", 'description' => "Accessed single user reports", 'user_id' => auth()
        ->user()->id, 'affected_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
    return response()
        ->json(['success' => true, 'data' => $reports, 'message' => 'User reports'], 200);
})->middleware('auth:sanctum');

Route::get('/project/{project_id}/assign/user/{user_id}', function ($projectId, $userId) {

    $project = \App\Models\Project::findOrFail($projectId);
    $user = \App\Models\User::findOrFail($userId);
    $projectUser = $project->users()
        ->where('user_id', $userId)->first();
    $accessLogId = \App\Models\AccessLog::where('name', 'Project Assignment Logs')->firstOrFail();

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    if ($user->hasRole('Super Admin') || $user->hasRole('Admin') || $user->hasRole('Staff')) {
        abort(403, 'Unauthorized action (only Ad-hoc users can be added to a project).');
    }

    if (!$user->roles()
        ->exists()) {
        abort(403, 'Unauthorized action (PLease assign role (Ad-hoc) before assigning user to project).');
    }

    //check if submitted user is a Super Admin or admin, abort if either
    if (!isset($projectUser->id)) {
        $project->users()
            ->attach($user->id);
        $user->update(['can_report' => true]);
        \App\Models\AccessLogProjectAssignment::create(['action' => "ATTACH", 'description' => "Assigned user to project", 'user_id' => auth()
            ->user()->id, 'affected_project_model_id' => $project->id, 'affected_user_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
        return response()
            ->json(['success' => true, 'data' => \App\Models\Project::findOrFail($projectId)]);
    }
    return response()->json(['error' => true, 'data' => null, 'message' => 'User already exists on project' . $project->title], 403);
})
    ->middleware('auth:sanctum');

Route::get('/project/{project_id}/detach/user/{user_id}', function ($projectId, $userId) {

    $project = \App\Models\Project::findOrFail($projectId);
    $user = \App\Models\User::findOrFail($userId);
    $projectUser = $project->users()
        ->where('user_id', $userId)->first();
    $accessLogId = \App\Models\AccessLog::where('name', 'Project Assignment Logs')->firstOrFail();

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    if (isset($projectUser->id)) {
        $project->users()
            ->detach($user->id);
        $user->update(['can_report' => false]);
        \App\Models\AccessLogProjectAssignment::create(['action' => "DETACH", 'description' => "Unassigned user from project", 'user_id' => auth()
            ->user()->id, 'affected_project_model_id' => $project->id, 'affected_user_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
        return response()
            ->json(['success' => true, 'data' => \App\Models\Project::findOrFail($projectId)]);
    }
    return response()->json(['error' => true, 'data' => null, 'message' => 'User does not exists on project' . $project->title], 404);
})
    ->middleware('auth:sanctum');

Route::get('roles/assign/role/{role_id}/user/{user_id}', function ($roleId, $userId) {
    $user = \App\Models\User::findOrFail($userId);
    $role = Role::findOrFail($roleId);
    $accessLogId = \App\Models\AccessLog::where('name', 'Role Assignment Logs')->firstOrFail();

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    if (
        (auth()
            ->user()
            ->hasRole('Admin') && !auth()
                ->user()
                ->hasRole('Super Admin')) && ($user->hasRole('Super Admin') || $user->hasRole('Admin'))
    ) {
        abort(403, 'Unauthorized action (Requires Super Admin Access).');
    }

    if (
        (auth()
            ->user()
            ->hasRole('Staff')  && !auth()
                ->user()
                ->hasRole('Super Admin')) && ($user->hasRole('Admin') || $user->hasRole('Super Admin') || $user->hasRole('Staff'))
    ) {
        abort(403, 'Unauthorized action (Requires Admin or Super Admin Access).');
    }

    if (($user->hasRole('Staff') || $user->hasRole('Admin') || $user->hasRole('Super Admin') || $user->hasRole('Ad-hoc')) && $role->name == 'Supervisor') {
        return response()
            ->json(['error' => true, 'data' => null, 'message' => 'The role (Supervisor) is a standalone role, cannot be be assigned to users of role(s) (Super Admin, Admin, Staff).'], 403);
    }

    if (($role->name == 'Staff' || $role->name == 'Admin' || $role->name == 'Super Admin' || $role->name == 'Ad-hoc')  && $user->hasRole('Supervisor')) {
        return response()
            ->json(['error' => true, 'data' => null, 'message' => 'The role (' . $role->name . ')  cannot be be assigned to user of role(s) (Supervisor).'], 403);
    }


    if ($user->hasRole('Citizen')) {
        return response()
            ->json(['error' => true, 'data' => null, 'message' => 'The role (Citizen) is immutable no further action can be performed.'], 403);
    }

    if ($user->hasRole($role->name)) {
        return response()
            ->json(['error' => true, 'data' => null, 'message' => 'User already has role ' . $role->name], 403);
    }


    if ($role->name == 'Citizen') {
        return response()
            ->json(['error' => true, 'data' => null, 'message' => 'The Citizen role is automatically assigned once a user registers from the Citizen mobile app. This is not an admin feature.'], 403);
    }

    // if ($user->hasRole('Ad-hoc') && $role->name == 'Citizen') {
    //     return response()
    //         ->json(['error' => true, 'data' => null, 'message' => 'The role (Citizen), cannot be assigned to a user with role (Ad-hoc).'], 403);
    // }

    // if ($user->hasRole('Citizen') && $role->name == 'Supervisor') {
    //     return response()
    //         ->json(['error' => true, 'data' => null, 'message' => 'The role (Supervisor), cannot be assigned to a user with role (Citizen).'], 403);
    // }

    // if ($user->hasRole('Ad-hoc')  &&   $role->name == 'Supervisor') {
    //     return response()
    //         ->json(['error' => true, 'data' => null, 'message' => 'The role (Supervisor), cannot be assigned to a user with role (Ad-hoc).'], 403);
    // }


    $user->assignRole($role);
    \App\Models\AccessLogRoleAssignment::create(['action' => "ATTACH", 'description' => "Assigned role to user", 'user_id' => auth()->user()->id, 'affected_role_model_id' => $role->id, 'affected_user_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
    return response()
        ->json(['success' => true, 'data' => \App\Models\User::findOrFail($userId)]);
})->middleware('auth:sanctum');

Route::get('roles/detach/role/{role_id}/user/{user_id}', function ($roleId, $userId) {
    $user = \App\Models\User::findOrFail($userId);
    $role = Role::findOrFail($roleId);
    $accessLogId = \App\Models\AccessLog::where('name', 'Role Assignment Logs')->firstOrFail();
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    // if (
    //     auth()
    //     ->user()
    //     ->hasRole('Super Admin') && $user->hasRole('Super Admin')
    // ) {
    //     abort(403, 'Unauthorized action (Requires Super Admin Access).');
    // }



    if (
        (auth()
            ->user()
            ->hasRole('Admin') && !auth()
                ->user()
                ->hasRole('Super Admin')) && ($user->hasRole('Super Admin') || $user->hasRole('Admin'))
    ) {
        abort(403, 'Unauthorized action (Requires Super Admin Access).');
    }

    if (
        (auth()
            ->user()
            ->hasRole('Staff')  && !auth()
                ->user()
                ->hasRole('Super Admin')) && ($user->hasRole('Admin') || $user->hasRole('Super Admin') || $user->hasRole('Staff'))
    ) {
        abort(403, 'Unauthorized action (Admin or Super Admin Access).');
    }

    if ($user->hasRole($role->name)) {

        if ($role->name == 'Citizen') {
            return response()
                ->json(['error' => true, 'data' => null, 'message' => 'The Citizen role is automatically assigned and cannot be unassigned.'], 403);
        }
        $user->removeRole($role);
        \App\Models\AccessLogRoleAssignment::create(['action' => "DETACH", 'description' => "Unassigned role from user", 'user_id' => auth()->user()->id, 'affected_role_model_id' => $role->id, 'affected_user_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
        return response()
            ->json(['success' => true]);
    }
    return response()
        ->json(['error' => true, 'data' => null, 'message' => 'The role ' . $role->name . ' does not exist for the supplied user'], 404);
})
    ->middleware('auth:sanctum');

Route::get('logs', function () {
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    $logs = \App\Models\AccessLog::where('id', "!=", auth()->user()
        ->id);

    return response()
        ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
            ->get(), 'message' => 'All logs'], 200);
})
    ->middleware('auth:sanctum');

Route::get('logs/users', function () {
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    $logs = \App\Models\AccessLogUser::where('user_id', "!=", auth()->user()
        ->id);

    if (auth()
        ->user()
        ->hasRole('Super Admin')
    ) {
        return response()
            ->json(['success' => true, 'data' => \App\Models\AccessLogUser::orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Admin')
    ) {

        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Staff')
    ) {
        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
            $query->where('name', "!=", "Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All logs'], 200);
    }
})
    ->middleware('auth:sanctum');

Route::get('logs/projects', function () {
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    $logs = \App\Models\AccessLogProject::where('user_id', "!=", auth()->user()
        ->id);

    if (auth()
        ->user()
        ->hasRole('Super Admin')
    ) {
        return response()
            ->json(['success' => true, 'data' => \App\Models\AccessLogProject::orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All project logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Admin')
    ) {

        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate20(), 'message' => 'All project logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Staff')
    ) {
        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
            $query->where('name', "!=", "Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All project logs'], 200);
    }
})
    ->middleware('auth:sanctum');

Route::get('logs/reports', function () {
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    // $logs=\App\Models\AccessLogReport::where('user_id',"!=",auth()->user()->id);
    return response()
        ->json(['success' => true, 'data' => \App\Models\AccessLogReport::orderBy('id', 'desc')
            ->paginate(20), 'message' => 'All report logs'], 200);
})
    ->middleware('auth:sanctum');

Route::get('logs/roles/assignments', function () {
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    $logs = \App\Models\AccessLogRoleAssignment::where('user_id', "!=", auth()->user()
        ->id);

    if (auth()
        ->user()
        ->hasRole('Super Admin')
    ) {
        return response()
            ->json(['success' => true, 'data' => \App\Models\AccessLogRoleAssignment::orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All role assignment logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Admin')
    ) {

        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All role assignment logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Staff')
    ) {
        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
            $query->where('name', "!=", "Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All role assignment logs'], 200);
    }
})
    ->middleware('auth:sanctum');

Route::get('logs/projects/assignments', function () {
    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    $logs = \App\Models\AccessLogProjectAssignment::where('user_id', "!=", auth()->user()
        ->id);

    if (auth()
        ->user()
        ->hasRole('Super Admin')
    ) {
        return response()
            ->json(['success' => true, 'data' => \App\Models\AccessLogProjectAssignment::orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All role assignment logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Admin')
    ) {

        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All role assignment logs'], 200);
    }

    if (auth()
        ->user()
        ->hasRole('Staff')
    ) {
        $logs->whereHas('user.roles', function ($query) {
            $query->where('name', "!=", "Super Admin");
            $query->where('name', "!=", "Admin");
        });
        return response()
            ->json(['success' => true, 'data' => $logs->orderBy('id', 'desc')
                ->paginate(20), 'message' => 'All role assignment logs'], 200);
    }
})
    ->middleware('auth:sanctum');

Route::post('/message', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    $request->validate(['title' => 'required', 'body' => 'required']);
    $message = \App\Models\Message::create(['title' => $request->title, 'body' => $request->body, 'uuid' => ""]);

    return response()
        ->json(['success' => true, 'data' => $message, 'message' => 'Message Created'], 200);
})->middleware('auth:sanctum');

Route::get('/messages', function (Request $request) {
    // if(!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Staff') && !auth()->user()->hasRole('Ad-Hoc') ){
    //     abort(403, 'Unauthorized action.');
    // }
    // dd(auth()->user()->roles()->first()->name);
    $messages = \App\Models\Message::orderBy('id', 'desc')->paginate(20);

    return response()
        ->json(['success' => true, 'data' => $messages, 'message' => 'All messages'], 200);
})->middleware('auth:sanctum');

Route::get('/mobile/messages', function (Request $request) {
    // if(!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Staff') && !auth()->user()->hasRole('Ad-Hoc') ){
    //     abort(403, 'Unauthorized action.');
    // }
    // dd(auth()->user()->roles()->first()->name);
    $messages = \App\Models\Message::orderBy('id', 'desc')->get();

    return response()
        ->json(['success' => true, 'data' => $messages, 'message' => 'All messages'], 200);
})->middleware('auth:sanctum');

Route::post('/queried', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff') && !auth()
        ->user()
        ->hasRole('Ad-hoc')) {
        abort(403, 'Unauthorized action.');
    }

    if (!auth()
        ->user()
        ->hasRole('Ad-hoc')) {
        $report = \App\Models\Report::findOrFail($request->report_id);
    } else {
        $report = \App\Models\Report::where('uuid', $request->report_uuid)
            ->firstOrFail();
    }

    if ($report->status !== "Queried") {
        abort(403, 'Unauthorized action. You can only leave a comment on a queried report.');
    }
    $request->validate(['comment' => 'required']);

    if (!auth()
        ->user()
        ->hasRole('Ad-hoc')) {

        if (
            \App\Models\QueryComment::where('report_id', $report->id)
            ->get()
            ->count() < 2 && $report->message !== null
        ) {
            \App\Models\QueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => Uuid::uuid4(), 'user_id' => $report->user_id, 'type' => 'Ad-Hoc', 'comment' => $report->message, 'created_at' => $report->created_at]);

            $message = \App\Models\QueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => Uuid::uuid4(), 'user_id' => auth()
                ->user()->id, 'type' => 'admin', 'comment' => $request->comment]);
        } else {
            $message = \App\Models\QueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => Uuid::uuid4(), 'user_id' => auth()
                ->user()->id, 'type' => 'admin', 'comment' => $request->comment]);
        }
    } else {

        $message = \App\Models\QueryComment::create(['report_id' => $report->id, 'report_uuid' => $report->uuid, 'uuid' => $request->uuid, 'user_id' => auth()
            ->user()->id, 'type' => 'Ad-Hoc', 'comment' => $request->comment]);
    }

    return response()
        ->json(['success' => true, 'data' => $message, 'message' => 'Comment Added'], 200);
})->middleware('auth:sanctum');

Route::post('/queried/approve', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff') && !auth()
        ->user()
        ->hasRole('Ad-hoc')) {
        abort(403, 'Unauthorized action.');
    }

    $comment = \App\Models\QueryComment::where('uuid', $request->comment_uuid)
        ->where('report_uuid', $request->report_uuid)
        ->firstOrFail();

    $report = \App\Models\Report::where('uuid', $request->report_uuid)
        ->firstOrFail();

    if ($report->status !== "Queried") {
        abort(403, 'Unauthorized action. You can only approve a comment where report status=Queried.');
    }

    if ($comment->type !== "Ad-Hoc") {
        abort(403, 'Unauthorized action. You can only approve a comment from an Ad-Hoc user.');
    }

    $request->validate(['comment_uuid' => 'required', 'report_uuid' => 'required']);

    $report->update(['status' => 'Approved', 'message' => $comment->comment]);

    return response()
        ->json(['success' => true, 'data' => \App\Models\Report::where('uuid', $request->report_uuid)
            ->first(), 'message' => 'Comment Approved'], 200);
})
    ->middleware('auth:sanctum');

Route::get('/queried/{uuid}', function ($uuid) {
    // if(!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Staff') ){
    //     abort(403, 'Unauthorized action.');
    // }
    $report = \App\Models\Report::where('uuid', $uuid)->firstOrFail();

    if ($report->status !== "Queried") {
        abort(403, 'Unauthorized action. You can only fetch comments on a queried report.');
    }

    return response()
        ->json(['success' => true, 'data' => \App\Models\QueryComment::where('report_id', $report->id)
            ->paginate(20), 'message' => 'Comment Added'], 200);
})
    ->middleware('auth:sanctum');

Route::get('/mobile/queried/{uuid}', function ($uuid) {
    // if(!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Staff') ){
    //     abort(403, 'Unauthorized action.');
    // }
    $report = \App\Models\Report::where('uuid', $uuid)->firstOrFail();

    if ($report->status !== "Queried") {
        abort(403, 'Unauthorized action. You can only fetch comments on a queried report.');
    }

    return response()
        ->json(['success' => true, 'data' => \App\Models\QueryComment::where('report_id', $report->id)
            ->get(), 'message' => 'Comment Added'], 200);
})
    ->middleware('auth:sanctum');

Route::post('/user/onboarding/password-change', function (Request $request) {
    return auth()->user()
        ->update(['password' => \Hash::make($request->password), 'onboarded' => 1]);

    return response()
        ->json(['success' => true, 'data' => auth()
            ->user(), 'message' => 'Password changed'], 200);
})
    ->middleware('auth:sanctum');

Route::post('/user/profile/avatar', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff') && !auth()
        ->user()
        ->hasRole('Ad-hoc')  && !auth()
        ->user()
        ->hasRole('Citizen')) {
        abort(403, 'Unauthorized action.');
    }
    $request->validate(['user_id' => 'required', 'photo' => 'required']);
    $user = \App\Models\User::findOrFail($request->user_id);
    if (!$user->photos()
        ->exists()) {
        $photo = $user->photos()
            ->create(['user_id' => $request->user_id, 'photo' => $request->photo]);
    } else {
        if ($request->photo == null) {
            return null;
        }
        $image = $request->photo; // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(8) . '.png';
        Storage::disk('avatar')->put($imageName, base64_decode($image));
        $user->photos()
            ->update(['user_id' => $request->user_id, 'photo' => $imageName]);
    }

    return response()->json(['success' => true, 'data' => $user->photos()
        ->first()->photo, 'message' => 'Image Uploaded'], 200);
})
    ->middleware('auth:sanctum');

Route::post('/user/contact', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Ad-hoc') && !auth()->user()
        ->hasRole('Citizen')) {
        abort(403, 'Unauthorized action.');
    }
    \App\Models\Inquiry::create(['message' => $request->message, 'user_id' => $request->user_id]);

    return response()
        ->json(['success' => true, 'data' => $request->all(), 'message' => 'Inquiry Submitted'], 200);
})
    ->middleware('auth:sanctum');

Route::get('/inquiries', function (Request $request) {
    if (!auth()->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    return response()
        ->json(['success' => true, 'data' => \App\Models\Inquiry::orderBy('id', 'desc')
            ->paginate(20), 'message' => 'All Inquiries'], 200);
})
    ->middleware('auth:sanctum');



Route::get('/supervisor/state/{state_id}/assign/user/{user_id}', function ($stateId, $userId) {

    $state = \App\Models\State::findOrFail($stateId);
    $user = \App\Models\User::findOrFail($userId);
    $stateSupervisorUser = $state->supervisorstate()
        ->where('user_id', $userId)->first();

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    if (!$user->hasRole('Supervisor')) {
        abort(403, 'Unauthorized action (PLease assign role (Supervisor) before assigning user to state).');
    }

    //check if submitted user is a Super Admin or admin, abort if either
    if (!isset($stateSupervisorUser->id)) {
        $state->supervisorstate()
            ->attach($user->id);

        return response()
            ->json(['success' => true, 'data' => null]);
    }
    return response()->json(['error' => true, 'data' => null, 'message' => "User has already been added to state ($state->name) as a Supervisor."], 403);
})
    ->middleware('auth:sanctum');

Route::get('/supervisor/state/{state_id}/detach/user/{user_id}', function ($stateId, $userId) {

    $state = \App\Models\State::findOrFail($stateId);
    $user = \App\Models\User::findOrFail($userId);
    $stateSupervisorUser = $state->supervisorstate()
        ->where('user_id', $userId)->first();

    // Todo check if user has report in state to be detached and return error
    //if($user->supervisorreports()->where('state',))    

    return [$user->supervisorslga()
        ->wherePivot('state_id', $state->id)->detach()];

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    if (isset($stateSupervisorUser->id)) {
        $state->supervisorstate()
            ->detach($user->id);

        $user->supervisorslga()
            ->where('state_id', $state->id)->detach();

        return response()
            ->json(['success' => true, 'data' => null]);
    }
    return response()->json(['error' => true, 'data' => null, 'message' => "User does not exist as a supervisor on state ( $state->name)"], 404);
})
    ->middleware('auth:sanctum');


Route::get('/supervisor/state/{state_id}/lga/{lga_id}/assign/user/{user_id}', function ($stateId, $lgaId, $userId) {
    $state = \App\Models\State::findOrFail($stateId);
    $lga = \App\Models\LocalGovernment::findOrFail($lgaId);
    $user = \App\Models\User::findOrFail($userId);
    $lgaSupervisorUser = $lga->supervisorslga()
        ->where('user_id', $userId)->first();

    if (!$state->localgovernments()->where('id', $lga->id)->exists()) {
        return response()->json(['error' => true, 'data' => null, 'message' => "$lga->name is not a local government under $state->name"], 404);
    }

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    if (!$user->hasRole('Supervisor')) {
        abort(403, 'Unauthorized action (PLease assign role (Supervisor) before assigning user to state).');
    }

    //check if submitted user is a Super Admin or admin, abort if either
    $stateSupervisorUser = $state->supervisorstate()
        ->where('user_id', $userId)->first();

    if (!isset($stateSupervisorUser->id)) {

        return response()->json(['error' => true, 'data' => null, 'message' => "User must be assigned to  $state->name before being assigned to $lga->name ."], 403);
    }


    if (!isset($lgaSupervisorUser->id)) {
        $lga->supervisorslga()
            ->attach($user->id, ['state_id' => $state->id]);

        return response()
            ->json(['success' => true, 'data' => null]);
    }
    return response()->json(['error' => true, 'data' => null, 'message' => "User has already been added to local government ($lga->name ) as a Supervisor."], 403);
})
    ->middleware('auth:sanctum');

Route::get('/supervisor/lga/{lga_id}/detach/user/{user_id}', function ($lgaId, $userId) {

    $lga = \App\Models\localGovernment::findOrFail($lgaId);
    $user = \App\Models\User::findOrFail($userId);
    $lgaSupervisorUser = $lga->supervisorslga()
        ->where('user_id', $userId)->first();

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }
    if (isset($lgaSupervisorUser->id)) {
        $lga->supervisorslga()
            ->detach($user->id);

        return response()
            ->json(['success' => true, 'data' => null]);
    }
    return response()->json(['error' => true, 'data' => null, 'message' => "User does not exist as a supervisor on local government ( $lga->name)"], 404);
})
    ->middleware('auth:sanctum');


Route::get('/supervisor/state/{state_id}/supervisors', function ($stateId) {
    $state = \App\Models\State::findOrFail($stateId);
    $supervisors = $state->supervisorstate()
        ->orderBy('id', 'desc')
        ->paginate(20);

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    return response()
        ->json(['success' => true, 'data' => $supervisors, 'message' => 'State Supervisors'], 200);
})->middleware('auth:sanctum');



Route::get('/supervisor/state/{state_id}/lga/{lga_id}/supervisors', function ($stateId, $lgaId) {
    $state = \App\Models\State::findOrFail($stateId);
    $lga = \App\Models\LocalGovernment::findOrFail($lgaId);
    if (!$state->localgovernments()->where('id', $lga->id)->exists()) {
        return response()->json(['error' => true, 'data' => null, 'message' => "$lga->name is not a local government under $state->name"], 404);
    }
    $supervisors = $lga->supervisorslga()
        ->orderBy('id', 'desc')
        ->paginate(20);

    if (!auth()
        ->user()
        ->hasRole('Super Admin') && !auth()
        ->user()
        ->hasRole('Admin') && !auth()
        ->user()
        ->hasRole('Staff')) {
        abort(403, 'Unauthorized action.');
    }

    return response()
        ->json(['success' => true, 'data' => $supervisors, 'message' => 'State Supervisors'], 200);
})->middleware('auth:sanctum');


Route::get('/states', function () {
    return response()
        ->json(['success' => true, 'data' => \App\Models\State::all(), 'message' => 'All States'], 200);
});


Route::get('/state/{state_id}/lgas', function ($state_id) {
    $state = \App\Models\State::findOrFail($state_id);
    return response()
        ->json(['success' => true, 'data' => $state->localgovernments, 'message' => "All Local Governments under $state->name state."], 200);
});


Route::get('/supervisor/assigned/states/', function (Request $request) {

    if (
        !auth()
            ->user()
            ->hasRole('Supervisor')
    ) {

        abort(403, 'Unauthorized action.');
    }

    return response()->json(['success' => true, 'data' => $request->user()->supervisorstate, 'message' => ""], 200);
})->middleware('auth:sanctum');

Route::get('/supervisor/assigned/state/{state_id}/lgas/', function (Request $request, $state_id) {

    if (
        !auth()
            ->user()
            ->hasRole('Supervisor')
    ) {

        abort(403, 'Unauthorized action.');
    }

    return response()->json(['success' => true, 'data' => $request->user()->supervisorslga()->where('state_id', $state_id)->get(), 'message' => ""], 200);
})->middleware('auth:sanctum');


Route::get('/reports/{type}', function (Request $request,$type) {
    if($type=='day'){
       $reports= \App\Models\Report::where('user_id',$request->user()->id)->whereDate('posted',Carbon::today())->latest()->get();
        return response()->json(['success' => true, 'data' => $reports, 'message' => "Single Report"], 200); 
    }

    else if($type=='week'){
        $reports= \App\Models\Report::where('user_id',$request->user()->id)->whereBetween('posted', 
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
    )
->latest()->get();
        return response()->json(['success' => true, 'data' => $reports, 'message' => "Single Report"], 200); 
    }

    else if($type=='month'){
        $reports= \App\Models\Report::where('user_id',$request->user()->id)->whereMonth('posted', date('m'))
        ->whereYear('posted', date('Y'))->latest()->get();
        return response()->json(['success' => true, 'data' => $reports, 'message' => "Single Report"], 200); 
    }

    else if($type=='all'){
        $reports= \App\Models\Report::where('user_id',$request->user()->id)->latest()->get();
        return response()->json(['success' => true, 'data' => $reports, 'message' => "Single Report"], 200); 
    }
    
    })->middleware('auth:sanctum');


Route::get('/report/{uuid}', function (Request $request,$uuid) {
$report= \App\Models\Report::where('uuid',$uuid)->first();
    return response()->json(['success' => true, 'data' => $report, 'message' => "Single Report"], 200);
})->middleware('auth:sanctum');

