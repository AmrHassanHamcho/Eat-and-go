<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function address()
    {               
        return view('home.address');            
    }

    public function addressValidation(Request $request)
    {
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
