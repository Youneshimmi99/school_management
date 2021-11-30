<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Subject;
use App\Cycle;
use App\Grade;
use App\Teacher;
use App\Option;



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
    public function AddProf(Request $request){
       
        $request->validate([
                'name' =>'required',
                'email'=>'required',
                'password'       =>'required',
                'password2'       =>'required',
                'subject_id'      =>'required',
                'tele'      =>'required',  
            ]);
            if ($request->password==$request->password2) {
               $Teacher=new Teacher();
                $subjectId=Subject::where('name',$request->subject_id)->get();
                $Teacher->name=$request->name;
                $Teacher->subject_id=$subjectId[0]['id'];
                $Teacher->email=$request->email;
                $Teacher->password=\Hash::make($request->password);
                $Teacher->tele=$request->tele;
                if ($Teacher->save()) {
                    return response()->json(["status"=>"success"]);
                }else return response()->json(["status"=>"error"]);
            }else return response()->json(["password"=>"error","msg"=>"Vos mot de passe  ne sont pas correctes !"]);
       






    }
    public function GetSubjects(){
        $subjects=Option::all();
        if($subjects)
        return response()->json(["status"=>"success","subjects"=>$subjects]);
        else return respoonse()->json(["status"=>"error"]);
    }
    public function GetCycles(){
        $Cycles=Cycle::all();
        if($Cycles)
        return response()->json(["status"=>"success","cycles"=>$Cycles]);
        else return respoonse()->json(["status"=>"error"]);
    }
    public function GetGrades($id){
        // $Cycles=Cycle::where('name',$name)->get();
        $grades=Grade::where('cycle_id',$id)->get();
        $countGrades=Grade::where('cycle_id',$id)->count();
        $gardesName=[];
         for ($i=0; $i <$countGrades ; $i++) { 
            $gardesName[] = ["name"=>$grades[$i]["nameGrade"],"id"=>$grades[$i]["id"]];
         }
        if($gardesName)
        return response()->json(["status"=>"success","gradesname"=>$gardesName]);
        else return respoonse()->json(["status"=>"error"]);
    }

}
