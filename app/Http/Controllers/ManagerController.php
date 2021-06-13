<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RequestCompany;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ManagerController extends Controller
{
    public function requestCompany(Request $request){
       
        $details = [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
        ];
        Mail::to('dbounty@gmail.com')->send(new RequestCompany($details));
        return true;
    }
}
