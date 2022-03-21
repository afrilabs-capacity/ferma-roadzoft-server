<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\AccessLog;
use App\Models\AccessLogUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!auth()->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::with('roles', 'supervisorstate', 'supervisorslga')->where('id', "!=", auth()
            ->user()
            ->id);

        if (!is_null($request->project_id)) {
            $users->whereHas('projects', function ($query) use ($request) {
                $query->where('project_id', $request->project_id);
            });
        }

        if (!is_null($request->state_id)) {
            $users->where('state', $request->state_id);
        }

        if (!is_null($request->lga_id)) {
            $users->where('lga', $request->lga_id);
        }

        $usersWithoutRole = User::doesnthave('roles')->where('id', "!=", auth()
            ->user()
            ->id);
        $accessLogId = AccessLog::where('name', 'User Logs')->firstOrFail();

        if (auth()
            ->user()
            ->hasRole('Super Admin')
        ) {
            AccessLogUser::create(['action' => "READ", 'description' => "Accessed all users", 'user_id' => auth()
                ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);
            return response()
                ->json(['success' => true, 'data' => $users->orderBy('id', 'desc')
                    ->paginate(20), 'message' => 'All users'], 200);
        }

        if (auth()
            ->user()
            ->hasRole('Admin')
        ) {
            $users->whereHas('roles', function ($query) {
                $query->where('name', "!=", "Super Admin");
            });

            $collectUsers = $users->get()
                ->merge($usersWithoutRole->orderBy('id', 'desc')
                    ->get());
            AccessLogUser::create(['action' => "READ", 'description' => "Accessed all users", 'user_id' => auth()
                ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);
            return response()
                ->json(['success' => true, 'data' => $collectUsers->paginate(20), 'message' => 'All users'], 200);
        }

        if (auth()
            ->user()
            ->hasRole('Staff')
        ) {
            $users->whereHas('roles', function ($query) {
                $query->where('name', "!=", "Super Admin");
                $query->where('name', "!=", "Admin");
            });

            $collectUsers = $users->get()
                ->merge($usersWithoutRole->orderBy('id', 'desc')
                    ->get());

            AccessLogUser::create(['action' => "READ", 'description' => "Accessed all users", 'user_id' => auth()
                ->user()->id, 'affected_model_id' => null, 'access_log_id' => $accessLogId->id]);
            return response()
                ->json(['success' => true, 'data' => $collectUsers->paginate(20), 'message' => 'All users'], 200);
        }
    }

    public function getUser($id)
    {
        // if (!auth()->user()
        //     ->hasRole('Super Admin') && !auth()
        //     ->user()
        //     ->hasRole('Admin') && !auth()
        //     ->user()
        //     ->hasRole('Staff') && !auth()
        //     ->user()
        //     ->hasRole('Supervisor')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $user = User::with('supervisorstate', 'supervisorslga')->findOrFail($id);
        $accessLogId = AccessLog::where('name', 'User Logs')->firstOrFail();

        // if (
        //     auth()
        //     ->user()
        //     ->hasRole('Admin') && $user->hasRole('Super Admin')
        // ) {
        //     abort(403, 'Unauthorized action (Requires super admin access).');
        // }

        // if (
        //     auth()
        //     ->user()
        //     ->hasRole('Staff') && ($user->hasRole('Admin') || $user->hasRole('Super Admin'))
        // ) {
        //     abort(403, 'Unauthorized action (Requires super admin or admin access).');
        // }

        AccessLogUser::create(['action' => "READ", 'description' => "Accessed single user", 'user_id' => auth()
            ->user()->id, 'affected_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
        return response()
            ->json(['success' => true, 'data' => $user, 'message' => 'User'], 200);
    }

    public function updateUser($id, Request $request)
    {
        if (!auth()->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);
        $accessLogId = AccessLog::where('name', 'User Logs')->firstOrFail();

        if (
            (auth()
                ->user()
                ->hasRole('Admin') && !auth()
                    ->user()
                    ->hasRole('Super Admin')) && $user->hasRole('Super Admin')
        ) {
            abort(403, 'Unauthorized action (Requires super admin access).');
        }

        if (
            (auth()

                ->user()
                ->hasRole('Staff')  && !auth()
                    ->user()
                    ->hasRole('Super Admin')) && ($user->hasRole('Admin') || $user->hasRole('Super Admin'))
        ) {
            abort(403, 'Unauthorized action (Requires super admin or admin access).');
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255', 'phone' => 'sometimes|string|max:255|unique:users,phone,' . $id, 'dob' => 'sometimes|string|max:255', 'state' => 'sometimes|integer', 'lga' => 'sometimes|integer', 'onboarded' => 'sometimes|boolean', 'active' => 'sometimes|boolean', 'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id, 'password' => 'sometimes|string|min:4|max:8',

        ]);

        if ($request->has('password') && $request->password !== "") {
            $validatedData['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($validatedData);
        AccessLogUser::create(['action' => "PATCH", 'description' => "Updated single user", 'user_id' => auth()->user()->id, 'affected_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);

        return response()
            ->json(['success' => true, 'data' => User::where('id', $id)->first(), 'message' => 'User Updated'], 200);
    }

    public function deleteUser($id)
    {

        if (!auth()->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);
        $accessLogId = AccessLog::where('name', 'User Logs')->firstOrFail();

        if (
            auth()
            ->user()
            ->hasRole('Super Admin') && $user->hasRole('Super Admin')
        ) {
            abort(403, 'Unauthorized action (Super admin cannot be destroyed).');
        }

        if (
            auth()
            ->user()
            ->hasRole('Admin') && ($user->hasRole('Super Admin') || $user->hasRole('Admin'))
        ) {
            abort(403, 'Unauthorized action (Requires super admin access).');
        }

        if (
            auth()
            ->user()
            ->hasRole('Staff') && ($user->hasRole('Admin') || $user->hasRole('Super Admin') || $user->hasRole('Staff'))
        ) {
            abort(403, 'Unauthorized action (Requires super admin or admin access).');
        }

        if ($user->hasRole('Ad-hoc')) {
            // $userExistsInProjects = Project::whereHas('users', function ($query) use ($user) {
            //     $query->where('user_id', $user->id);
            // });

            // if ($userExistsInProjects->exists()) {

            //     foreach ($userExistsInProjects->get() as $userProject) {
            //         $userProject->users()
            //             ->detach($user->id);
            //     }
            // }

            // if ($user->roles()
            //     ->exists()
            // ) {
            //     foreach ($user->roles()
            //         ->get() as $role) {
            //         $user->removeRole($role);
            //     }
            // }
            $user->projects()
                ->delete();
            AccessLogUser::create(['action' => "DESTROY", 'description' => "Deleted single user", 'user_id' => auth()
                ->user()->id, 'affected_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
            $user->delete();
        } else {
            // if ($user->roles()
            //     ->exists()
            // ) {
            //     foreach ($user->roles()
            //         ->get() as $role) {
            //         $user->removeRole($role);
            //     }
            // }
            AccessLogUser::create(['action' => "DESTROY", 'description' => "Deleted single user", 'user_id' => auth()->user()->id, 'affected_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);
            $user->delete();
        }

        return response()
            ->json(['success' => true, 'data' => null, 'message' => 'User deleted'], 200);
    }

    public function searchUsers(Request $request)
    {

        $users = User::with('projects', 'roles')->orderBy('id', 'desc')
            ->where('id', "!=", auth()
                ->user()
                ->id);

        if (!auth()
            ->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')) {
            abort(403, 'Unauthorized action.');
        }

        if (!is_null($request->project_id)) {
            $project = Project::findOrFail($request->project_id);
            $users->whereHas('projects', function ($query) use ($request) {
                !is_null($request->project_id) ? $query->where('project_id', $request->project_id) : "";
            });
        }

        if (!is_null($request->role_id)) {
            $role = Role::findOrFail($request->role_id);
            $users->whereHas('roles', function ($query) use ($request, $role) {
                !is_null($request->role_id) ? $query->where('name', $role->name) : "";
            });
        }

        !is_null($request->state) ? $users->where('State', $request->state) : "";

        !is_null($request->lga) ? $users->where('lga', $request->lga) : "";

        return response()
            ->json(['success' => true, 'data' => $users->paginate(20), 'message' => 'All Users'], 200);
    }
}
