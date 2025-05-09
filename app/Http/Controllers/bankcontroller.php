<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bankcontroller extends Controller
{
    public function store(Request $request)
    { 
        User::create([
        "Nom"=>$request->title,
        "Prenom"=>$request->Prenom,
        "Cin"=>$request->Cin,
        "Role"=>"client",
        "email"=>$request->email,
        "telephone"=>$request->telephone,
        "password"=>$request->password,
    ]);
    }
}
