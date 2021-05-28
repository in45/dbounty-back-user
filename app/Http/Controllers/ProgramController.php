<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index()
    {
        return Program::with('company')->withCount(['reports','users'])->paginate(6);
    }

    public function show($id)
    {
        return Program::with('company')->where('id',$id)->withCount(['reports','users'])->first();;
    }

     public function getCompanyPrograms($id)
    {
        return Program::where('company_id',$id)->withCount(['reports','users'])->get();
    }
      public function getUserPrograms($user_id)
    {
        return ProgramUser::with('program')->where('user_id',$user_id)->get();
    }
       public function getMyPrograms()
    {
        return ProgramUser::with('program')->where('user_id',Auth::user()->id)->paginate(6);
    }
    public function getUsers($id)
    {
        return ProgramUser::with('user')->where('prog_id',$id)->limit(10)->get();
    }
     public function join($id)
    {
        $user_id = Auth::user()->id;
         if (ProgramUser::where('user_id', $user_id )->where('prog_id', $id)->count() != 0) {
            return response()->json(['data' => ['msg' => "You  already in this program"]], 403);
        }
        else{
            $prog_user = new ProgramUser();
            $prog_user->user_id = $user_id;
            $prog_user->prog_id = $id;
            $prog_user->save();
            return $prog_user;
        }
    }


    public function store(Request $request)
    {

        $program = new Program();
        $program->name = $request->input('name');
        $program->company_id = $request->input('company_id');
        if($request->input('type')) $program->type = $request->input('type');
        if($request->file('logo')) $program->logo = $request->file('logo')->storeAs('programs', $request->logo->getClientOriginalName(), 'public');
        if($request->input('status')) $program->status = $request->input('status');
        if($request->input('min_bounty')) $program->min_bounty = $request->input('min_bounty');
        if($request->input('max_bounty')) $program->max_bounty = $request->input('max_bounty');
        if($request->input('begin_at')) $program->begin_at = $request->input('begin_at');
        if($request->input('finish_at')) $program->finish_at = $request->input('finish_at');
        if($request->input('range_response')) $program->range_response = $request->input('range_response');
        if($request->input('description')) $program->description = $request->input('description');
        if($request->input('scopes')) $program->scopes = $request->input('scopes');
        if($request->input('rules')) $program->rules = $request->input('rules');
        if($request->input('conditions')) $program->conditions = $request->input('conditions');
        $program->save();
        return $program;
    }

    public function update(Request $request,$id)
    {
        $program = Program::findOrFail($id);
        if($request->input('name')) $program->name = $request->input('name');
        if($request->input('company_id')) $program->company_id = $request->input('company_id');
        if($request->input('type')) $program->type = $request->input('type');
        if($request->file('logo')) $program->logo = $request->file('logo')->storeAs('programs', $request->logo->getClientOriginalName(), 'public');
        if($request->input('status')) $program->status = $request->input('status');
        if($request->input('min_bounty')) $program->min_bounty = $request->input('min_bounty');
        if($request->input('max_bounty')) $program->max_bounty = $request->input('max_bounty');
        if($request->input('begin_at')) $program->begin_at = $request->input('begin_at');
        if($request->input('finish_at')) $program->finish_at = $request->input('finish_at');
        if($request->input('range_response')) $program->range_response = $request->input('range_response');
        if($request->input('description')) $program->description = $request->input('description');
        if($request->input('scopes')) $program->scopes = $request->input('scopes');
        if($request->input('rules')) $program->rules = $request->input('rules');
        if($request->input('conditions')) $program->conditions = $request->input('conditions');
        $program->save();
        return $program;
    }
    public function destroy($id)
    {
        $program = Program::findOrfail($id);
        if($program->delete()) return  true;
        return "Error while deleting";
    }
     public function searchProgram(Request $request)
    {
        $name = $request->input('name');
        return Program::with('company')->where('name', 'like', $name . '%')->withCount(['reports','users'])->paginate(6);;
    }
}
