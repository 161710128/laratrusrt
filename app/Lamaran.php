<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    protected $fillable = ['file_cv','status','lowongan_id','user_id'];
    public $timestamps = true;

    public function Lowongan(){
        return $this->belongsto('App\Lowongan','lowongan_id');
    }
    public function User(){
        return $this->belongstoMany('App\User','user_id');
    }
}
