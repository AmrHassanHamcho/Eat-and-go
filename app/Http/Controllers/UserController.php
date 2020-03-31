<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use App\User;
use Hash;

class UserController extends Controller
{
    function login(){
        if(Auth::check())
        {
            return redirect('/address');
        }

        return view('user.login');
    }

    function checklogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3' 
        ]);

        $user_data = $request->only('email', 'password');

        if(Auth::attempt($user_data)){
            return redirect('/address');
        }
        else{
            return back()->with('error', 'wrong Login data');
        }

    }

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3' 
        ]);
                
        $user = User::create(request(['name', 'email', 'password']));
        
        auth()->login($user);
        
        return redirect()->to('/login');
    }
}
