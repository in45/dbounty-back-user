<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class Program extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $appends = ['is_joined','is_reported'];
     protected $hidden = ['reports','users'];
     protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope('created_at', 'desc'));

    }
     public function reports()
    {
        return $this->hasMany('App\Models\Report','prog_id','id');
    }
      public function users()
    {
        return $this->hasMany('App\Models\ProgramUser','prog_id','id');
    }
     public function company()
    {
        return $this->hasOne('App\Models\Company','id','company_id');
    }
     public function getIsJoinedAttribute()
    {
        $user = Auth::user();
    
        $users = $this->users->pluck('user_id')->toArray();
        return in_array($user->id, $users);
    }
      public function getIsReportedAttribute()
    {
        $user = Auth::user();
    
        return Report::where('prog_id',$this->id)->where('user_id',$user->id)->count();
    
    }
}
