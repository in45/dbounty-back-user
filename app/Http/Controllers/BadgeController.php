<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index()
    {
        return Badge::paginate(10);
    }

    public function show($id)
    {
        return Badge::findOrFail($id);
    }
    public function getMyBadges()
    {
        //$user = Auth::user();
        $id = '1';
        $badges = Badge::withCount('achieves') ->withCount(['done' => function($q) use($id){
                $q->where('user_id',$id);
            }])->get();
        return $badges;
    }
    public function getBadgesOfUser($id)
    {
        return UserBadge::where('user_id',$id)->with('badge')->get();
    }
}
