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
use App\Timetable;








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
    public function teacheractive(){
        $TeacherActive=Auth::guard('teacher')->user();
        // return $TeacherActive;
        return response()->json(["status"=>"success","Teacheractive"=>$TeacherActive]);
    }
    public function CountCourTeacher(){
        $countcours=DB::table('teachers')
          ->join('courses','courses.teacher_id','=','teachers.id')
          ->where('teachers.id','=',Auth::guard('teacher')->user()->id)
          ->count();
        return response()->json(["status"=>"success","countcourtechear"=>$countcours]);
    }
    public function CountclassTeacher(){
        $countclass=DB::table('classes')
          ->join('teacher_classes','teacher_classes.class_id','=','classes.id')
          ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
          ->where('teachers.id','=',Auth::guard('teacher')->user()->id)
          ->count();
        return response()->json(["status"=>"success","countclasstechear"=>$countclass]);
    }
    public function CountexamTeacher(){
        $countexam=DB::table('exams')
          ->where('exams.teacher_id','=',Auth::guard('teacher')->user()->id)
          ->count();
        return response()->json(["status"=>"success","countexamtechear"=>$countexam]);
    }
    public function CountexerciceTeacher(){
        $countexam=DB::table('courses')
            ->join('exercices','exercices.course_id','=','courses.id')
            ->where('courses.teacher_id','=',Auth::guard('teacher')->user()->id)
           ->count();
        return response()->json(["status"=>"success","counteexrcicetechear"=>$countexam]);
    }
    public function GetTeachersMatiere(){
        // return Auth::guard('teacher')->user()->subject_id;
        $teachermatiere=DB::table("teachers")
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select("teachers.id","teachers.name","teachers.email","subjects.namesub","teachers.tele")
                            ->where('teachers.subject_id',Auth::guard('teacher')->user()->subject_id)
                            ->get();
        return response()->json(["status"=>"success","teachermatiere"=>$teachermatiere]);                    
    }
     public function GetExamsPrimaire(){
        // return Auth::guard('teacher')->user()->subject_id;
        $teacherexamtechear=DB::table("exams")
                            ->join('teachers','teachers.id','=','exams.teacher_id')
                            ->join('grades','grades.id','=','exams.grade_id')
                            ->select("exams.id","exams.nameExam","exams.descriptionExam","exams.fileExam","exams.sessionExam","grades.nameGrade")
                            ->where('grades.cycle_id',1)
                            ->whereNull('exams.deleted_at')
                            ->where('exams.teacher_id',Auth::guard('teacher')->user()->id)
                            ->get();
        return response()->json(["status"=>"success","teacherexam"=>$teacherexamtechear]);                    
    }
    public function GetTimeTableProf(){
        $timetableprof=Timetable::where('teacher_id',Auth::guard('teacher')->user()->id)->get();
                return response()->json(["status"=>"success","timetableteacher"=>$timetableprof]);                    

    }
    public function GetExamsCollege(){
        // return Auth::guard('teacher')->user()->subject_id;
        $teacherexamteacher=DB::table("exams")
                            ->join('teachers','teachers.id','=','exams.teacher_id')
                            ->join('grades','grades.id','=','exams.grade_id')
                            ->select("exams.id","exams.nameExam","exams.descriptionExam","exams.fileExam","exams.sessionExam","grades.nameGrade")
                            ->where('grades.cycle_id',2)
                            ->where('exams.teacher_id',Auth::guard('teacher')->user()->id)
                            ->whereNull('exams.deleted_at')
                            ->get();
        return response()->json(["status"=>"success","teacherexam"=>$teacherexamteacher]);                    
    }
     public function GetExamsLycee(){
        //  dd("hello");
              $teacherexamlycee=DB::table("exams")
                            ->join('teachers','teachers.id','=','exams.teacher_id')
                            ->join('grades','grades.id','=','exams.grade_id')
                            ->join('branchs','branchs.id','=','exams.branch_id')
                            ->select("exams.id","exams.nameExam","exams.descriptionExam","exams.fileExam","exams.sessionExam","grades.nameGrade","branchs.nameBranch")
                            ->where('grades.cycle_id',3)
                            ->whereNull('exams.deleted_at')
                            ->where('exams.teacher_id',Auth::guard('teacher')->user()->id)
                            ->get();
        return response()->json(["status"=>"success","teacherexam"=>$teacherexamlycee]); 
                      
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
