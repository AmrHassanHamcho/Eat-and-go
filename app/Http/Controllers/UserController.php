<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use App\User;

class UserController extends Controller
{
    function login(){
        return view('user.login');
    }

    function checklogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3' 
        ]);

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data)){
            return redirect('/address');
        }
        else{
            return back()->with('error', 'wrong Login data');
        }

    }

    function successlogin(){
        return redirect('/address');
    }

   

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function registerCreate()
    {
        return view('user.create');
    }

    public function registerStore()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
                
        $user = User::create(request(['name', 'email', 'password']));
        
        auth()->login($user);
        
        return redirect()->to('/login');
    }
}
