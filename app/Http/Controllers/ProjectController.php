<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //
    public function create(Request $request)
    {
        $accessLogId = \App\Models\AccessLog::where('name', 'Project Logs')->firstOrFail();
        $validatedData = $request->validate(['title' => 'required|string|max:255|unique:projects', 'description' => 'required|string',]);
        if (!auth()
            ->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin')) {
            abort(403, 'Unauthorized action.');
        }

        $report = Project::create($request->all());
        \App\Models\AccessLogProject::create(['action' => "WRITE", 'description' => "Create project", 'user_id' => auth()
            ->user()->id, 'affected_model_id' => $report->id, 'access_log_id' => $accessLogId->id]);

        return response()
            ->json(['success' => true, 'data' => $report], 200);
    }

    public function getAllProjects()
    {
        $accessLogId = \App\Models\AccessLog::where('name', 'Project Logs')->firstOrFail();
        // if (!auth()
        //     ->user()
        //     ->hasRole('Super Admin') && !auth()
        //     ->user()
        //     ->hasRole('Admin') && !auth()
        //     ->user()
        //     ->hasRole('Staff'))
        // {
        //     abort(403, 'Unauthorized action.');
        // }
        \App\Models\AccessLogProject::create(['action' => "READ", 'description' => "Accessed all projects", 'user_id' => auth()
            ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);
        return Project::paginate(10);
    }

    public function delete($id)
    {
        $accessLogId = \App\Models\AccessLog::where('name', 'Project Logs')->firstOrFail();
        $project = \App\Models\Project::findOrFail($id);

        if ($project->id == 1) {
            abort(403, 'Unauthorized action.');
        }

        if (!auth()->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')) {
            abort(403, 'Unauthorized action.');
        }
        if ($project->users()
            ->exists()
        ) {
            foreach ($project->users()
                ->get() as $user) {
                $user->reports()
                    ->delete();
                $project->users()
                    ->detach($user->id);
            }
        }
        \App\Models\AccessLogProject::create(['action' => "DESTROY", 'description' => "Deleted a project", 'user_id' => auth()
            ->user()->id, 'affected_model_id' => $project->id, 'access_log_id' => $accessLogId->id]);
        $project->delete();

        return response()
            ->json(['success' => true, 'data' => null]);
    }
}
