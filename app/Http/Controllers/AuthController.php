<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
class AuthController extends Controller
{
    //return view login admin
    public function IndexLoginAdmin(){
        return view("admin.LoginAdmin");
    }
    //return view dash Admin
    public function IndexDashboardAdmin(){
        return view("admin.DashAdmin");
    }
    //login admin
    public function LoginAdmin(Request $request){
         $attempt = Auth::guard('admin')
                ->attempt([
                    'email' => $request->email,
                    'password' => $request->password
                ]);
        if ($attempt){
            // return view("admin.DashAdmin");
            // $request->session()->regenerate();
            return redirect('/administration');     
        }else {
          return back()->withErrors([
            'email' => 'Vos informations d\'identification ne sont pas correctes !',
        ]);
        }
    }
    public function LougoutAdmin(){
        if (Auth::guard("admin")->check()) {
             Auth::guard("admin")->logout();
             return redirect('/login/admin'); 
        }   
    }
}
