<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        if(Auth::guard('admin')->check()){
            return redirect(route('admin.dashboard'));
        }
        return view('dashboard.login');
    }
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect(route('admin.dashboard'));
        }
        return redirect()->back()->with('error', 'username atau password salah');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
