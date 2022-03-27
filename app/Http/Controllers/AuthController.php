<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Hash;
use App\Notifications\AccountVerification;
use App\Models\Verification;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        // return $request->all();
        // \App\Models\User::withTrashed()->find(10)->restore();
        $accessLogId = \App\Models\AccessLog::where('name', 'User Logs')->firstOrFail();
        $validatedData = $request->validate(['name' => 'required|string|max:255', 'phone' => 'required|string|max:255|unique:users', 'dob' => 'required|string|max:255', 'state' => 'required|integer|max:255', 'lga' => 'required|integer|max:1000', 'email' => 'required|string|email|max:255|unique:users', 'password' => 'required|string|min:4', ]);

        if (!auth()
            ->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff'))
        {
            abort(403, 'Unauthorized action.');
        }

        $user = User::create(['name' => $validatedData['name'], 'email' => $validatedData['email'], 'password' => Hash::make($validatedData['password']) , 'phone' => $validatedData['phone'], 'dob' => $validatedData['dob'], 'state' => $validatedData['state'], 'lga' => $validatedData['lga']]);

        \App\Models\AccessLogUser::create(['action' => "WRITE", 'description' => "Created user", 'user_id' => auth()->user()->id, 'affected_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['success' => true, 'data' => ['user_id' => $user->id], 'access_token' => $token, 'token_type' => 'Bearer', 'message' => "User Created"], 200);

        // return response()
        //     ->json(['access_token' => $token, 'user_id'=>$user->id, 'token_type' => 'Bearer', ]);
        
    }

    public function registerCitizen(Request $request)
    {

         //return $request->all();
        // \App\Models\User::withTrashed()->find(10)->restore();
        //$accessLogId = \App\Models\AccessLog::where('name', 'User Logs')->firstOrFail();
        $validatedData = $request->validate(['name' => 'required|string|max:255', 'phone' => 'required|string|max:255|unique:users', 'state' => 'required|integer|max:255', 'lga' => 'required|integer|max:1000', 'email' => 'required|string|email|max:255|unique:users', 'password' => 'required|string|min:4', ]);

        $user = User::create(['name' => $validatedData['name'], 'email' => $validatedData['email'], 'password' => Hash::make($validatedData['password']) , 'phone' => $validatedData['phone'],  'state' => $validatedData['state'], 'lga' => $validatedData['lga']]);

        // \App\Models\AccessLogUser::create(['action' => "WRITE", 'description' => "Created user", 'user_id' => auth()->user()->id, 'affected_model_id' => $user->id, 'access_log_id' => $accessLogId->id]);

        //$token = $user->createToken('auth_token')->plainTextToken;
        $role = Role::findOrFail(5);
        $user->assignRole($role);
        $verification= Verification::create(['user_id'=>$user->id,'otp'=>rand(111111, 999999)]);
        //$user->notify(new AccountVerification($user,$verification));
        $token = $user->createToken('auth_token')->plainTextToken;
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Invalid login details'], 401);
        }

        return response()
            ->json(['success' => true, 'data' => auth()->user(), 'access_token' =>  $token, 'token_type' => 'Bearer', 'message' => "User Created"], 200);

        // return response()
        //     ->json(['access_token' => $token, 'user_id'=>$user->id, 'token_type' => 'Bearer', ]);
        
    }

    public function login(Request $request)
    {
        //  return "found valet server";
        if (isset($request->auth_type))
        {
            if ($request->auth_type == "email")
            {

                //do email auth
                if (!Auth::attempt($request->only('email', 'password')))
                {
                    return response()
                        ->json(['message' => 'Invalid login details'], 401);
                }

                $user = User::where('email', $request['email'])->firstOrFail();

                $token = $user->createToken('auth_token')->plainTextToken;
                return response()
                    ->json(['access_token' => $token, 'data' => auth()->user() , 'token_type' => 'Bearer', ]);

            }

        }

        if (isset($request->auth_type))
        {
            if ($request->auth_type == "phone")
            {

                //do phone auth
                if (!Auth::attempt($request->only('phone', 'password')))
                {

                    return response()
                        ->json(['message' => 'Invalid login details'], 401);
                }

                $user = User::where('phone', $request['phone'])->firstOrFail();

                $token = $user->createToken('auth_token')->plainTextToken;
                return response()
                    ->json(['access_token' => $token, 'data' => auth()->user() , 'token_type' => 'Bearer', ]);

            }
        }

        return response()
            ->json(['message' => 'Invalid Auth type'], 401);

    }

    public function me(Request $request)
    {
        return $request->user();
    }

}

