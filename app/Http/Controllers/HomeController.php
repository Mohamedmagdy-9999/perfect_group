<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function log(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|max:255',
            // 'captcha' => 'required|captcha',
        ]);
        $data = $request->only(['email', 'password']);

        
        if (Auth::attempt($data)) {

          
            
            return redirect()->route('dashboard');
        }

        return back()->with('message', 'Invalid password Or Email');
    }

    public function user_logout(Request $request) 
    {
            
            
        Auth::logout();

        return redirect()->route('signin');
    }

    public function update_profile(Request $request, $id)
    {
       

        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
      
        if($request->password)
        {
            $user->password = Hash::make($request->password);
           
        }

       
        $user->save();

            
        return back()->with('message', 'تم التعديل بنجاح');
    }

  
}
