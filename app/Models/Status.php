<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Status extends Authenticatable
{
   protected $table = 'statuses';
   protected $fillable = [
       'body'
   ];

    public function user(){

    return  $this->belongsTo('App\Models\User','user_id');

    }
    public function scopeNotReply($query){
        return $query->whereNull('parent_id');
    }

    public function replies(){
        return $this->hasMany('App\Models\Status','parent_id');
    }
}