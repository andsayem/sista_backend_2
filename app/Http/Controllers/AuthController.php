<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Resources\UserResource;
use Hash;
use Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AuthController extends AppBaseController
{

    // public function useradd(Request $request)
    // {
    //     // dd($request);
    //     $request->validate([
    //         'type' => 'required',
    //         'reference_id' => 'required',
    //         'name' => 'required|string',
    //         'email' => 'required|string|unique:users',
    //         'password' => 'required|string|confirmed'
    //     ]);

    //     try {
    //         DB::beginTransaction();
    //         $user = new User([
    //             'name' => $request->name,
    //             'type' => $request->type,
    //             'reference_id' => $request->reference_id,
    //             'email' => $request->email,
    //             'password' => bcrypt($request->password)
    //         ]);
    //         $user->save();


    //         $user->assignRole($request->type);
    //         DB::commit();
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         dd($e);
    //         return $this->sendError('Unsuccessful');
    //     }

    //     return $this->sendResponse($user, 'User saved successfully');
    // }


    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        
        $userFind = User::where('email', $request->email)->first();  
        if($userFind){ 
            if(Hash::check($request->password,$userFind->password)){ 
                //if( $request->password =='sist@'){ 
                if ($userFind) {
                    auth()->loginUsingId($userFind->id);
                    $accessToken = auth()->user()->createToken('authToken')->accessToken;
                    return response()->json([
                        'status' => 1,
                        'message' => 'You are successfully logged in',
                        'user' => new UserResource(auth()->user()),
                        'access_token' =>  $accessToken,
                        'token_type' => 'Bearer',
                    ]);
                }
            }
        }
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message'  => 'Invalid credentials', 'status' => 0
            ]);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response(['user' => new UserResource(auth()->user()), 'access_token' => $accessToken, 'message' => 'success']);
        return response()->json([
            'status' => 1,
            'message' => 'You are successfully logged in',
            'user' => new UserResource(auth()->user()),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
         auth()->logout();
         return redirect("login")->withSuccess('Successfully logged out');
        // $request->user()->token()->revoke();
        // return response()->json([
        //     'message' => 'Successfully logged out'
        // ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
    
     public function forgot_password(Request $request )
    {
        $data = $request->validate([
            'email'    => 'required|email',
        ]);

        $email = $request->email; 
        $otp_code = mt_rand(10000, 99999);

        $user = User::where(['email' => $email])->first();
        
    
        
        if(empty($user))
        {
            return $this->sendResponse(0, 'Your account does not exists.');
            
           // return response()->json(['message' => 'Your account does not exists.'], 400);
        }

        if(!empty($user))
        { 
            
             $changePassword = User::where(['email' => $email])->update([
                    'otp_code' => $otp_code
                ]);
                
            $to =  $email;
            $subject = "Your Sista forgot password verification code is ".$otp_code.". Do not share it with anyone.";
            
            $message = "
            <html>
            <head>
            <title>Forgot password verification code</title>
            </head>
            <body>
            <p>Forgot password verification code</p>
            <table>
            <tr>
            <th>OTP Code</th>
            <th>".$otp_code."</th>
            </tr>
            <tr>
            <td>John</td>
            <td>Doe</td>
            </tr>
            </table>
            </body>
            </html>
            ";
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <info@sista.com>' . "\r\n"; 
            
            mail($to,$subject,$message,$headers); 
                
            //     event(new SmsEvenet($user->phone, "Your Sista forgot password verification code is ".$otp_code.". Do not share it with anyone."));
                
        
            //return response()->json(['message' => 'A code has been sent to your email Address.'], 200);
              return $this->sendResponse(1, 'A code has been sent to your email Address.');
        }
        // return response()->json(['message' => 'Try again or click forgot password to reset it.'], 400);
         return $this->sendResponse(0, 'Try again or click forgot password to reset it.');
    }
    
    public function varifyPasswordOtp(Request $request)
    {
         $data = $request->validate([
            'email'    => 'required|email',
            'otp_code'    => 'required',
        ]);


        $email = $request->email;
        $otp_code = $request->otp_code;
        $exists = User::where(['email' => $email, 'otp_code' => $otp_code])->exists();
        if($exists)
        {
            return $this->sendResponse(1, 'Verification code verified successfully.');
           // return response()->json(['message' => 'Verification code verified successfully.'], 200);
        }
         return $this->sendResponse(0, 'Faild to verified verification code.');
       // return response()->json(['message' => 'Faild to verified verification code.'], 400);
    }
    
     public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required ',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $changePassword = User::where(['email' => $email])->update([
            'password' => bcrypt($password)
        ]);

        if($changePassword)
        {
            return $this->sendResponse(1, 'Password Change successfull..'); 
        }
        return $this->sendResponse(0, 'Password Change failed.'); 
    }


    
}
