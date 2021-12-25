<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Grade;
use App\Option;
use App\Branch;
use App\Admin;
use App\Teacher;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
     public function GetClasses($id){
         if ($id==3) {
             $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->join('branchs','branchs.id','=','classes.branch_id')
                            ->where('grades.cycle_id',$id)
                            ->get();
                           
         }
         else if ($id==2) {
            $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->where('grades.cycle_id',$id)
                            ->get();
                           
         }
         else {
             $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->where('grades.cycle_id',$id)
                            ->get();
                           
         }
        
                      
      return response()->json(["status"=>"success","classes"=>$classes]);
    }
    public function GetClassesByIdGrade($id){
        $classes=Classe::WHERE('grade_id',$id)->get();
        return response()->json(["status"=>"success","classes"=>$classes]);
    }
    public function GetBranchs($id){
        
        // return $id;
        // $Grades=Grade::where('id',$id)->get();

        $branches=Branch::where('grade_id',$id)->get();
        $countbranches=Branch::where('grade_id',$id)->count();
        $brancesName=[];
         for ($i=0; $i <$countbranches ; $i++) { 
            $brancesName[] = ["name"=>$branches[$i]["nameBranch"],"id"=>$branches[$i]["id"]];
         }
        if($brancesName)
        return response()->json(["status"=>"success","branchesnames"=>$brancesName]);
        else return response()->json(["status"=>"error"]);
    }
    public function AddClasse(Request $request){
        // return $request;
        $classe=new Classe();
        $classe->nameClasse=$request->nameClasse;
        $classe->numberCls=$request->number;
        $classe->grade_id=$request->IdGrade;
        $classe->option_id=$request->Option_id;
        if ($classe->save()) {
            return response()->json(["status"=>"success"]);
        }
         else return response()->json(["status"=>"error"]);
    }
    public function AddAdmin(Request $request){
        // return $request;
        $request->validate([
                'name' =>'required',
                'email'=>'required',
                'password'       =>'required',
                'password2'       =>'required',
                'tele'      =>'required',  
            ]);
            if ($request->password==$request->password2) {
               $Admin=new Admin();
                $Admin->name=$request->name;
                $Admin->email=$request->email;
                $Admin->password=\Hash::make($request->password);
                $Admin->tele=$request->tele;
                if ($Admin->save()) {
                    return response()->json(["status"=>"success"]);
                }else return response()->json(["status"=>"error"]);
            }else return response()->json(["password"=>"error","msg"=>"Vos mot de passe  ne sont pas correctes !"]);
    }
    public function Allteachers(){
        $teachers=DB::table('teachers')
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select('teachers.id','teachers.name','teachers.email','teachers.image','teachers.tele','subjects.namesub')
                            ->get();
                            // return $teachers;
        return response()->json(["status"=>"success","teachers"=>$teachers]);

    }
    public function IditTeacher($id){
      
        $teacher=Teacher::find($id);
        // return $teacher;
        return response()->json(["status"=>"success","teachers"=>$teacher]);
    }
    public function UpdateTeacher(Request $request){
        
              $request->validate([
                'name'=>'required',
                'email'=>'required',
                'password'       =>'required',
                'password2'       =>'required',
                'subject_id'      =>'required',
                'tele'      =>'required',  
            ]);
        $teacher=Teacher::find($request->id);
       
        if ($request->password===$request->password2) {
            $teacher->name=$request->name;
            $teacher->subject_id=$request->subject_id;
            $teacher->email=$request->email;
            $teacher->tele=$request->tele;
            $teacher->password=\Hash::make($request->password);
            if($teacher->save()){
                return response()->json(["status"=>"success"]);
            }return response()->json(["status"=>"faild"]);
        }else {
          return response()->json(["password"=>"error","msg"=>"Vos mot de passe  ne sont pas correctes !"]);
        }

    }
    public function DeleteTeacher($id){
        // return $id;
        $teacher=Teacher::find($id);
        // return $teacher;
        // $teacher->delete();
        if ($teacher->delete()) {
           return response()->json(["status"=>"success"]);
        }return response()->json(["status"=>"faild"]);
    }
}

