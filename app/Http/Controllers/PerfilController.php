<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('perfil.index');
    }
    
    public function store(Request $request) {
        
        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        //not_in: permite crear una black list.
        //in: permite crear una white list.
        $this->validate($request, [
            'username'=>'required|unique:users,username|min:3|max:20|not_in:twitter,editar-perfil'
        ]);
    }
}
