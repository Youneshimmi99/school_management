<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Classe;
use App\Teacher;
use App\Grade;
use App\Subject;
use App\Admin;




class TeacherController extends Controller
{
    //count all the students
    public function allStudents(){
        $students = Student::orderBy('created_at','desc')->count();

        return response()->json(["status"=>"success","students"=>$students]);
    }

    //count male students
    public function maleStudents(){
        $maleStudents = Admin::orderBy('created_at','desc')->where('gender','male')->count();

        return response()->json(["status"=>"success","maleStudents"=>$maleStudents]);
    }

    //count female students
    public function femaleStudents(){
        $femaleStudents = Student::orderBy('created_at','desc')->where('gender','female')->count();

        return response()->json(["status"=>"success","femaleStudents"=>$femaleStudents]);
    }

    //count classes
    public function allClasses(){
        $classes = Classe::orderBy('created_at','desc')->count();

        return response()->json(["status"=>"success","classes"=>$classes]);
    }

    //count grades classes
    public function gradesClasses(){

        $grades = Grade::orderBy('cycle_id','asc')->orderBy('number','asc')->get();

        foreach($grades as $grade){
            $classes[$grade->nameGrade]=$grade->classes->count();
        }

        return response()->json(["status"=>"success","classes"=>$classes]);
    }

    //count teachers
    public function allTeachers(){
        $teachers = Teacher::orderBy('created_at','desc')->count();
        return response()->json(["status"=>"success","teachers"=>$teachers]);
    }

    //count teachers of each subject
    public function subjectsTeachers(){
        $subjects = Subject::orderBy('created_at','desc')->get();

        foreach($subjects as $subject){
            $teachers[$subject->namesub]=$subject->teachers->count();
        }

        return response()->json(["status"=>"success","teachers"=>$teachers]);
    }
}
