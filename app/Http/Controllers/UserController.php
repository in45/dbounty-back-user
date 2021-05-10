<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
