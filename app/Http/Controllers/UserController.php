<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use App\User;
use Hash;
use Session;
use App\Order;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    function login(){        
        if(Auth::check())
        {
            $this->assignOrderToUser();
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
            
            $this->assignOrderToUser();
            return redirect('/address');
        }
        else{
            return back()->with('error', 'wrong Login data');
        }

    }

    function logout(){
        Auth::logout();
        Session::flush();
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

    private function assignOrderToUser()
    {
        $order = new Order;
        $order->total_price = 0.0;  
        $order->user_id = Auth::user()->id;
        $order->orderlines = new Collection;
        Session::put('order', $order);
    }
}
