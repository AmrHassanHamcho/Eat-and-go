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

    public function readUser($id){
        if(is_int($id))
        {
            try
            {
                $user=User::findOrFail($id);
                $this->id = $user->id;
                $this->name = $user->name;
                $this->email = $user->email;
                $this->password = $user->password;
                $this->role_id = $user->role_id;
               
                return true;
            }
            catch(Exception $e)
            {
                return false;
            
            }
        }
        throw new Exception("The parameter must be an integer.");   
    
    }

    public function updateUser(){
        try
        {
            $user = User::findOrFail($this->id);
            $user-> updated_at = now();
            $this->save();
            return true;
        }
        catch(Excepcion $e)
        {
            return false;
        }

    }

    public function deleteUser($id){
        if(is_int($id))
        {
            try
            {
                $user = User::findOrFail($id);
                User::destroy($id);
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }
        throw new Exception("The parameter must be an integer.");   
    
    }

    public function createUser($user){
        if($user instanceof User)
        {
            try
            {
                User::findOrFail($user->id);                
                return false;
            }       
            catch(Exception $e)     
            {
                $user->created_at = now();
                $user->updated_at = now();
                $user->save();
                return true;
            }            
        }
        throw new Exception("The parameter must be a user.");   
    
    }

    public function setRole($role){
        if($role instanceof Role)
        {
            try{
                Role::findOrFail($role->id);
                $role->id=$user->role_id;
                $this->updated_at=now();
                $this->save();
                return true;
            }
            catch(Exception $e){
                return false;

            }
        }
        throw new Exception("The parameter must be a role.");   
    
    }
}


