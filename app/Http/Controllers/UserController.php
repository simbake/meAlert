<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $access_level = Auth::user()->access_level;
      if($access_level == "MOH"){
      $users = User::all();
      return view("user.index",compact("users"));
    }else{
      return redirect("/access_restricted");
    }
    }
}
