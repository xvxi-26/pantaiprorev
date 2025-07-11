<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(!Auth::guard('admin')->check()){
            return redirect(route('admin.login'));
        }
        $jumlahPengunjung = Pengunjung::count();
        return view('dashboard.index', compact('jumlahPengunjung'));
    }

}
