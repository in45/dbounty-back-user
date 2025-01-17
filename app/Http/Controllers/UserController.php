<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\Translation\t;

class UserController extends Controller
{
     public function index()
    {
        return User::paginate(10);
    }

    public function show($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
      if($request->input('public_address')) $user->public_address = $request->input('public_address');
      if($request->input('username')) $user->username = $request->input('username');
      if($request->input('country')) $user->country = $request->input('country');
      if($request->file('avatar')) $user->avatar = $request->file('avatar')->storeAs('users', $request->avatar->getClientOriginalName(), 'public');

        $user->save();
        $token = auth()->attempt(['email'=>$user->email,'password'=>$request->input('password')]);
        return response()->json([
            'token'=>$this->respondWithToken($token),
            'user'=> $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
           if($request->input('public_address')) $user->public_address = $request->input('public_address');
      if($request->input('username')) $user->username = $request->input('username');
      if($request->input('email')) $user->email = $request->input('email');
      if($request->input('country')) $user->country = $request->input('country');
      if($request->input('first_name')) $user->first_name = $request->input('first_name');
      if($request->input('last_name')) $user->last_name = $request->input('last_name');
      if($request->input('phone')) $user->phone = $request->input('phone');
        if($request->file('avatar')) $user->avatar = $request->file('avatar')->storeAs('users', $request->avatar->getClientOriginalName(), 'public');

        $user->save();
        return $user;
    }
    public function destroy($user_id)
    {
        $user = User::findOrfail($user_id);
        if($user->delete()) return  true;
        return "Error while deleting";
    }
    public function ban($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->state = !$user->state;
        $user->save();
        return $user;
    }
      public function searchUser(Request $request)
    {
        $username = $request->input('username');
        return User::where('username', 'like', $username . '%')->paginate(6);;
    }


}
