<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Classe;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function IndexDashStudent(){
        return view("Student.DashStudent");
    }

    public function studentClasse($id){
        $student = Student::find($id);
        $student->classe->grade->cycle;
        $student->classe->option;

        return response()->json(["status"=>"success","student"=>$student]);
    }

    public function studentTimetable($id)
    {
        $student_classe_id=Student::find($id)->class_id;
        $timetable = DB::table('timetables')
        ->join('students','students.class_id','=','timetables.class_id')
        ->join('classes','classes.id','=','timetables.class_id')
        ->select('students.id','students.name','classes.nameClasse','classes.numberCls','timetables.id','timetables.nameTimetable','timetables.file')
        ->where('timetables.class_id',$student_classe_id)
        ->get();

        return response()->json(["status"=>"success","timetable"=>$timetable]);

    }

    public function studentTeachersAbsences($id){
        $teachers=Student::find($id)->classe->teachers;

        foreach($teachers as $teacher){
            if(!$teacher->TeacherAbsences->isEmpty()){
                $teachers_absences[] = $teacher;
                $teacher->subject;
            }
        }


        return response()->json(["status"=>"success","teachers_absences"=>$teachers_absences]);

    }
}
