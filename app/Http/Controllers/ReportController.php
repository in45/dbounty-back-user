<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index()
    {
        return Report::with(['user','vuln','program'])->paginate(4);
    }

    public function show($id)
    {
        return Report::with('vuln')->findOrFail($id);
    }
      public function getProgramReports($id)
    {
        return Report::with(['user','vuln','program'])->where('prog_id',$id)->get();
    }

       public function getCompanyReports($id)
    {
        return Report::with(['user','vuln','program'])->where('company_id',$id)->get();
    }

       public function getUserReports($user_id)
    {
        return Report::with(['program','vuln'])->where('user_id',$user_id)->get();
    }
     public function getMyReports()
    {
        return Report::with(['program','vuln'])->where('user_id',Auth::user()->id)->paginate(6);
    }
      public function getFiltredReports(Request $request)
    {
        $status = $request->input('status');

        return Report::with(['user','vuln','program'])->where('status', 'like', $status . '%')->where('user_id',Auth::user()->id)->paginate(6);

    }


       public function getMyProgramrReport($id)
    {
        return Report::with(['program','vuln'])->where('user_id',Auth::user()->id)->where('prog_id',$id)->first();
    }


    public function store(Request $request,$id)
    {

        $report = new Report();
        $report->title = 'Report-'.'0x'.Str::random(10);
        if($request->input('target')) $report->target = $request->input('target');
        if($request->input('vuln_id')) $report->vuln_id = $request->input('vuln_id');
         $report->user_id = Auth::user()->id;
         $report->prog_id = $id;
        if($request->input('vuln_name')) $report->vuln_name = $request->input('vuln_name');
        if($request->input('vuln_details')) $report->vuln_details = $request->input('vuln_details');
        if($request->input('validation_steps')) $report->validation_steps = $request->input('validation_steps');
        if($request->input('severity')) $report->severity = $request->input('severity');
        if($request->file('file_upload')) $report->file_upload = $request->file('file_upload')->storeAs('Reports', $request->file_upload->getClientOriginalName(), 'public');
        if($request->input('status')) $report->status = $request->input('status');
        if($request->input('bounty_win')) $report->bounty_win = $request->input('bounty_win');
        if($request->input('status')) $report->status = $request->input('status');
        $report->save();
        return $report;
    }

    public function update(Request $request,$id)
    {
        $report = Report::findOrFail($id);
        if($request->input('target')) $report->target = $request->input('target');
        if($request->input('vuln_id')) $report->vuln_id = $request->input('vuln_id');
        if($request->input('vuln_name')) $report->vuln_name = $request->input('vuln_name');
        if($request->input('vuln_details')) $report->vuln_details = $request->input('vuln_details');
        if($request->input('validation_steps')) $report->validation_steps = $request->input('validation_steps');
        if($request->input('severity')) $report->severity = $request->input('severity');
        if($request->file('file_upload')) $report->file_upload = $request->file('file_upload')->storeAs('Reports', $request->file_upload->getClientOriginalName(), 'public');
        if($request->input('status')) $report->status = $request->input('status');
        if($request->input('bounty_win')) $report->bounty_win = $request->input('bounty_win');
        if($request->input('status')) $report->status = $request->input('status');
        $report->save();
        return $report;
    }
    public function destroy($id)
    {
        $report = Report::findOrfail($id);
        if($report->delete()) return  true;
        return "Error while deleting";
    }
}
