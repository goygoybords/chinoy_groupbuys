<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    //
    public function index()
    {
    	$user = User::find(1)->customer;
    	print_r($user);
    	// echo $user->firstname;
    	
    }
}
