<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Order;
use App\OrderLine;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.welcome');
    }

    public function welcome()
    {
        return view('home.welcome');
    }

    public function address()
    {
        return view('home.address');
    }

    public function addressValidation(Request $request)
    {        
        $order = new Order;
        $order->total_price = 0.0;  
        $order->user_id = Auth::user()->id;
        $order->orderlines = new Collection;
        Session::put('order', $order);

        $this->validate($request, [
            'address' => 'required',            
        ]);
        
        Session::put('address', $request->address);
        return redirect('/restaurants');
    }

    public function about()
    {
        return view('home.about');
    }
    
    public function contact()
    {
        return view('home.contact');
    }
}
