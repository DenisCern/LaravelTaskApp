<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function auth()
    {

        return view('admin');
        
    }

    public function checkUser()
    {
        
        /*
        $add = new AdminModel();
        $add->name = 'admin';
        $add->password = Hash::make('123');
        $add->save(); 
        */
        
        //return view('auth');
        
    }
}
