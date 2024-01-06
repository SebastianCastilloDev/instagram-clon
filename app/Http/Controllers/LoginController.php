<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        $this->validate($request, [
            'email'=> 'required|email',
            'password' => 'required'
        ]);

        //En caso de que el usuario no se pueda autenticar
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('post.index',[
            'user'=>auth()->user()->username
        ]);
    }
}
