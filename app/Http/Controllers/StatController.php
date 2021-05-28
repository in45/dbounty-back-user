<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
     public function getProgramsStatus()
    {
        $user = Auth::user();
        $programs = $user->programs()->pluck('prog_id')->toArray();
        return Program::whereIn('id',$programs)->groupBy('status')->select('status', DB::raw('count(*) as count'))->get();;

    }
    public function getProgramsStats()
    {
         $user = Auth::user();
        $programs = $user->programs()->pluck('prog_id')->toArray();
        return Program::withCount(['users','reports'])->whereIn('id', $programs)->get();

    }


    public function Evolution()
    {
        $stats = [] ;
         $user = Auth::user();
        $now = Carbon::now();
        $programs =  $user->programs()->pluck('prog_id')->toArray();
        for($i=0;$i<6;$i++)
        {
            array_push($stats,array(Carbon::parse($now)->format('F')=>Report::whereIn('prog_id',$programs)->whereMonth('bounty_at',$now->month)->sum("bounty_win")));
            $now->subMonth() ;

        }
        return  $stats;

    }

        public function getUserReportsStats()
    {
         $stats= new StatController();
          $user = Auth::user();
        $programs =   $user->programs()->pluck('prog_id')->toArray();
        $stats->status =  Report::whereIn('prog_id',$programs)->groupBy('status')->select('status', DB::raw('count(*) as status_count'))->get();
        $stats->severity = Report::whereIn('prog_id',$programs)->groupBy('severity')->select('severity', DB::raw('count(*) as severity_count'))->get();

        return response()->json($stats);
    }

}
