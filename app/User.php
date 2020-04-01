<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function restaurant(){
        return $this->hasOne('App\Restaurant', 'admin_id');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }    

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \bcrypt($password);
    }

    public static function findByEmail($email)
    {
        $user = User::where('email', $email)->get()->first();
        return $user;
    }

    public function isAdminApp()
    {
        $admin_role = Role::where('name', 'AdminApp')->get()->first();
        return $this->role_id == $admin_role->id;
    }

    public function isAdminRestaurant()
    {
        $admin_role = Role::where('name', 'AdminRestaurant')->get()->first();
        if(is_null($admin_role))
            return false;
            
        return $this->role_id == $admin_role->id;
    }    
}

