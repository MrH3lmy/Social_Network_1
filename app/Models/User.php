<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;





    protected $table = 'users';
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
        'accepted',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getName(){

        if($this->first_name && $this->lastname){

            return "{$this->this->first_name}{$this->lastname}";
        }

        if($this->first_name ){

            return $this->first_name;
        }

        return null; 

    }


    public function getName0rUsername(){
        return $this->getName() ?: $this->username;
    }

    public function getFirstNamerUsername(){
            return $this->first_name ? : $this->username;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getAvatarUrl(){
        return "https://www.gravatar.com/avatar/{{md5($this->email}}?d=mm&s=40";
    }

    public function statuses(){
        return $this->hasMany('App\Models\Status','user_id');
    }


    public function friendsOfMine()
    {

        {
            return $this->belongsToMany('App\Models\User','friends','user_id','friend_id');
        }
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User','friends','friend_id','user_id');

       
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted',true)->get()->
        merge($this->friendOf()->wherePivot('accepted',true)->get());
    }
    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted',false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendOf()->wherePivot('accepted',false)->get();
    }

    public function hasFriendRequestPending(user $user){
        return (bool) $this->friendRequestsPending()->where('id',$user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequests()->where('id',$user->id)->count();
    }

    public function addFriend(User $user){
       return $this->friendOf()->attach($user->id);
}

    public function acceptFriendRequest(User $user){

        $this->friendRequests()->where('id',$user->id)->first()->pivot->
        update(['accepted' =>true,]);
    }

    public function isFriendsWith(User $user){

        return (bool) $this->friends()->where('id',$user->id)->count();
    }
}
