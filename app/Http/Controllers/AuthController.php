<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pelieth\LaravelEcrecover\EthSigRecover;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token'=>$this->respondWithToken($token),
            'user'=> Auth::user()
        ]);
    }
    public function sign(Request $request)
    {

        $providedAddress =  $request->input('public_address');
        $signature = $request->input('signature');
        $message = "Welcome To Dbounty !";
        $eth_sig_util = new EthSigRecover();
        $recoveredAddress = $eth_sig_util->personal_ecRecover($message, $signature);
         if(strtolower($recoveredAddress) == strtolower($providedAddress)){
             $user= User::where('public_address',$providedAddress)->first();
             if (!$userToken=JWTAuth::fromUser($user)) {
                 return response()->json(['error' => 'invalid_credentials'], 401);
             }
             return response()->json([
                 'token'=>$this->respondWithToken($userToken),
                 'user'=> $user
             ]);
         }
         else return response()->json(['error' => 'Unauthorized'], 401);


    }


    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
    public function register(Request $request)
    {
        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $token = auth()->attempt(['email'=>$user->email,'password'=>$request->input('password')]);
        return $this->respondWithToken($token);
    }
    public function me(){
        return  Auth::user();

    }
}
