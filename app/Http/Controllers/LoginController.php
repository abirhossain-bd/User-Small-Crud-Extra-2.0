<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function signin(Request $request){
        $request->validate([
            '*'=>'required',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect('user/list')->with('success','Login Successfully!');
        }else{
            return redirect()->back()->with('error','Credential Does not match!');
        }
    }



    public function logout(){
        Auth::logout();
        return redirect('/')->with('success','Logout Successfully!');
    }
}
