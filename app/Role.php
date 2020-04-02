<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];  

    public function users(){
        return $this->hasMany('App\User');
    }

    public function readUser($id){
        if(is_int($id))
        {
            try
            {
                $role=Role::findOrFail($id);
                $this->id = $role->id;
                $this->name = $role->name;
                $this->description = $role->description;
                return true;
            }
            catch(Exception $e)
            {
                return false;
            
            }
        }
        throw new Exception("The parameter must be an integer.");   
    
    }
    
    public function updateRole(){
        try
        {
            $role = Role::findOrFail($this->id);
            $role-> updated_at = now();
            $this->save();
            return true;
        }
        catch(Excepcion $e)
        {
            return false;
        }

    }

    public function deleteRole($id){
        if(is_int($id))
        {
            try
            {
                $role = Role::findOrFail($id);
                Role::destroy($id);
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }
        throw new Exception("The parameter must be an integer.");   
    
    }

    public function createRole($role){
        if($role instanceof Role)
        {
            try
            {
                Role::findOrFail($role->id);                
                return false;
            }       
            catch(Exception $e)     
            {
                $role->created_at = now();
                $role->updated_at = now();
                $role->save();
                return true;
            }            
        }
        throw new Exception("The parameter must be a role.");   
    
    }
}

