<?php

namespace App\Http\Controllers;

use Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Verification;
use App\Notifications\AccountVerification;

class VerificationController extends Controller
{
    //

    public function verifyAccount(Request $request){
        
        if(!Verification::where('user_id',$request->user()->id)->where('otp',$request->otp)->first()){
            return response()
            ->json(['success'=>false,'message' => 'Invalid Verification Code'], 404);
        }

       User::where('id',$request->user()->id)->update(['email_verified_at'=>Carbon::now()]);

        return response()
            ->json(['success'=>true,'message' => 'Account Verified'], 200);

       
    }

    public function resendVerificationCode(Request $request){
     
        $verification= Verification::create(['user_id'=>$request->user()->id,'otp'=>rand(111111, 999999)]);
        $request->user()->notify(new AccountVerification($request->user(),$verification,'You recently registered on the Roadzoft Citizens App. please find your verification code below.'));
        return response()
        ->json(['success'=>true,'message' => 'Verification Code Resent'], 200);
        
    }

    public function sendValidationCodeIfEmailExists(Request $request){
        $user=User::where('email',$request->email)->first();
        if($user){
            $verification= Verification::create(['user_id'=>$user->id,'otp'=>rand(111111, 999999)]);
            $user->notify(new AccountVerification($user,$verification,'You recently requested a password reset on your account. Please ignore this email if you did not initiate a password request.'));
            return response()
            ->json(['success'=>true,'message' => 'Email exists'], 200);
        }

        return response()->json(['success'=>true,'message' => 'WEmail exists'], 404);
    }

    public function verifyAccountPasswordRecovery(Request $request){
        $user=User::where('email',$request->email)->first();
        $time = Carbon::now()->subHour(1);
        $verification= Verification::where('user_id',$user->id)->where('otp',$request->otp)->where('created_at','>=',$time)->first();
       
        if($verification && $user){
            return response()
            ->json(['success'=>true,'message' => 'Account Verified','data'=>$verification], 200);  
        }

        return response()
        ->json(['success'=>false,'message' => 'Invalid Verification Code'], 404);
       


    }


    public function resetAccountPassword(Request $request){
        $user=User::where('email',$request->email)->first();
        $time = Carbon::now()->subHour(1);
        $verification= Verification::where('user_id',$user->id)->where('otp',$request->otp)->where('created_at','>=',$time)->first();
       
        if($verification && $user){
            User::where('email',$request->email)->update(['password'=>Hash::make($request->password)]);
            return response()
            ->json(['success'=>true,'message' => 'Password Reset Successful','data'=>$request->password], 200);  
        }

        return response()
        ->json(['success'=>false,'message' => 'Invalid Verification Code, email or password'], 404);
    }
}
