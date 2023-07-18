<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Traits\HttpResponses;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * User Login
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function login_user(LoginUserRequest $request)
    {
        $credentials = array('email' => $request->username, 'password' => $request->password);
        $token       = '';
        try{
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->error('', 'Credentials do not match', 401);
            }
        }catch(JWTException $e){
            return $this->error(
                [],
                $e->getMessage(),
               500
            );
        }

        $user = User::where('email', $request->username)->first();
        return $this->success(
            [
                "access_token"=> $token,
                "token_type"=>"bearer",
                'user' => $user
            ],
            'successful',
           200 );
    }

}
