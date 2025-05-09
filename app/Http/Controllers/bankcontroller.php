<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> cc89429808b39ce16bc0351bda686962c624473e

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
