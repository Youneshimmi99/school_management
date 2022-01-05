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
use App\Teacher_classe;




class AuthController extends Controller
{
    //return view login admin
    public function IndexLoginAdmin(){
        return view("admin.LoginAdmin");
    }
    public function IndexTeacherLogin(){
        return view("Teacher.LoginTeacher");
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
     public function LoginTeacher(Request $request){
         $attempt = Auth::guard('teacher')
                ->attempt([
                    'email' => $request->email,
                    'password' => $request->password
                ]);
        if ($attempt){
            // return view("admin.DashAdmin");
            // $request->session()->regenerate();
            // dd("ok");
            return redirect('/accueil');     
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
    public function LogoutTeacher(){
        if (Auth::guard("teacher")->check()) {
             Auth::guard("teacher")->logout();
             return redirect('/login/prof'); 
        }   
    }
    public function AddProf(Request $request){
        // return $request;
        $request->validate([
                'email'=>'required|email',
                'password'       =>'required',
                'subject_id'      =>'required',
                'tele'      =>'required',  
            ]);
            if ( $request->password==$request->password2) {
                $Teacher=new Teacher();
                $Teacher->name=$request->name;
                $Teacher->subject_id=$request->subject_id;
                $Teacher->email=$request->email;
                $Teacher->password=\Hash::make($request->password);
                $Teacher->tele=$request->tele;
                if ($Teacher->save()) {
                    return response()->json(["status"=>"success"]);
                }else return response()->json(["status"=>"error"]);
            }else return response()->json(["password"=>"error","msg"=>"Vos mot de passe  ne sont pas correctes !"]);
  
    }
    public function AddTeacherClasses(Request $request){
        // return $request['FromProf'];
        $CountIdclasse=count($request['IdClasse']);
        // $ClasseID=[];
        //  for ($j=0; $j <$CountIdclasse ; $j++) { 
        //     $ClasseID[] = ["id"=>$request['IdClasse'][$j]['name']];
        //  }
        for ($i=0; $i < $CountIdclasse; $i++) { 
            $Teacher_classe=new Teacher_classe();
            $Teacher_classe->teacher_id=$request['FromProf']['id'];;
            $Teacher_classe->class_id=$request['IdClasse'][$i]['name'];
            $Teacher_classe->save();
        }
        if ($Teacher_classe->save()) {
           return response()->json(["status"=>"success"]);
        } return response()->json(["status"=>"error"]);
            
    }
    public function GetSubjects(){
        $subjects=Option::all();
        if($subjects)
        return response()->json(["status"=>"success","subjects"=>$subjects]);
        else return respoonse()->json(["status"=>"error"]);
    }
    public function GetSubjectsProf(){
        $subjects=Subject::all();
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
