<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    
    public function index()
    {
        // dd("sal");
        // dd(auth()->user);
        // 
        return view('account.profile.index');
    }
    
    
}
