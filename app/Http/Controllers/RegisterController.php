<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller 
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate(request(), User::STORE_RULES);

        // $user = User::create(request()->all());     
        $user = new User;
        
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password')); //zastiti password, dodaje simbole

        $user->save();

        auth()->login($user);

        return redirect()->route('all-posts');
    }
}





?>