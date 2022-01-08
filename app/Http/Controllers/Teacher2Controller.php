<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Course;
use App\Teacher;
use App\Classe;
use App\Option;
use App\Grade;
use App\Branch;







class Teacher2Controller extends Controller
{
    public function IndexDashTeacher(){
        return view("Teacher.DashTeacher");
    }
     public function getgrade($idgrade,$idbranch,$idoption){
        $Grade=Grade::find($idgrade);
        $Option=Option::find($idoption);
        $Branch=Branch::find($idbranch);
        return response()->json(["status"=>"success","grade"=>$Grade,"option"=>$Option,"branch"=>$Branch]);

    }
    public function GetClassesProf($id){
        // $idTeacher=Auth::guard('teacher')->user()->id;
        $teachers_classes=DB::table('teacher_classes')
                            ->join('classes','classes.id','=','teacher_classes.class_id')
                            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select('classes.id','classes.nameClasse','teacher_classes.teacher_id')
                            ->where('teacher_classes.teacher_id',Auth::guard('teacher')->user()->id)
                            ->where('classes.grade_id',$id)
                            ->get();
        return response()->json(["status"=>"success","teachers_classes"=>$teachers_classes]);
        // return $teachers_classes;
    }
}
