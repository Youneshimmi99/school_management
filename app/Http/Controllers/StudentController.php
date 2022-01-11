<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Classe;
use App\Course;
use App\Exercice;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
class StudentController extends Controller
{
    public function IndexDashStudent(){
        return view("Student.DashStudent");
    }

    public function studentClasse(){
        $student = Student::find(Auth::guard('student')->user()->id);  
        return response()->json(["status"=>"success","student"=>$student]);
    }
    public function getNameCycle(){
        $student_cycle_id= DB::table('cycles')
                ->join('grades','grades.cycle_id','=','cycles.id')
                ->join('classes','classes.grade_id','=','grades.id')
                ->join('students','students.class_id','=','classes.id')
                ->select('cycles.id','cycles.name','grades.nameGrade')
                ->where('students.id','=',Auth::guard('student')->user()->id)
                ->get();
       return response()->json(["status"=>"success","timetable"=>$student_cycle_id]);

    }
    public function studentTimetable()
    {
        $student_cycle_id= DB::table('cycles')
                ->join('grades','grades.cycle_id','=','cycles.id')
                ->join('classes','classes.grade_id','=','grades.id')
                ->join('students','students.class_id','=','classes.id')
                ->select('cycles.id','students.name')
                ->where('students.id','=',Auth::guard('student')->user()->id)
                ->get();
            
        if ($student_cycle_id[0]->id==3) {
            $timetable = DB::table('timetables')
                    ->join('students','students.class_id','=','timetables.class_id')
                    ->join('classes','classes.id','=','timetables.class_id')
                    ->join('grades','grades.id','=','classes.grade_id')
                    ->join('branchs','branchs.grade_id','=','grades.id')
                    ->join('cycles','cycles.id','=','grades.cycle_id')
                    ->select('students.id','grades.nameGrade','cycles.name','classes.nameClasse','classes.numberCls','timetables.id','timetables.nameTimetable','timetables.file','branchs.nameBranch')
                    ->where('timetables.class_id',Auth::guard('student')->user()->class_id)
                    ->get();

        return response()->json(["status"=>"success","timetable"=>$timetable]);
        }
        else {
             $timetable = DB::table('timetables')
                    ->join('students','students.class_id','=','timetables.class_id')
                    ->join('classes','classes.id','=','timetables.class_id')
                    ->join('grades','grades.id','=','classes.grade_id')
                    ->join('cycles','cycles.id','=','grades.cycle_id')
                    ->select('students.id','grades.nameGrade','cycles.name','classes.nameClasse','classes.numberCls','timetables.id','timetables.nameTimetable','timetables.file')
                    ->where('timetables.class_id',Auth::guard('student')->user()->class_id)
                    ->get();

        return response()->json(["status"=>"success","timetable"=>$timetable]);
        }
       

    }

    public function studentTeachersAbsences(){
        $teachers_absences= DB::table('teacher_absences')
                    ->join('teachers','teachers.id','=','teacher_absences.teacher_id')
                    ->join('teacher_classes','teacher_classes.teacher_id','=','teachers.id')
                    ->join('classes','classes.id','=','teacher_classes.class_id')
                    ->join('students','students.class_id','=','classes.id')
                    ->join('subjects','subjects.id','=','teachers.subject_id')
                    ->select('teachers.name','subjects.namesub','teacher_absences.end_date','teacher_absences.start_date')
                    ->where('students.id',Auth::guard('student')->user()->id)
                    ->get();
        return response()->json(["status"=>"success","teachers_absences"=>$teachers_absences]);
        // $teachers=Student::find(Auth::guard('student')->user()->id)->classe->teachers;

        // foreach($teachers as $teacher){
        //     if(!$teacher->TeacherAbsences->isEmpty()){
        //         $teachers_absences[] = $teacher;
        //         $teacher->subject;
        //     }
        // }
        // if ($teachers_absences) {
        //    return response()->json(["status"=>"success","teachers_absences"=>$teachers_absences]);
        // }else {
        //    return response()->json(["status"=>"vide"]);
        // }
        

    }
    

    public function getStudentSubjectExams($id){
        
        $student_subject_exams=DB::table('teachers')
        ->join('exams','exams.teacher_id','=','teachers.id')
        ->join('subjects','subjects.id','=','teachers.subject_id')
        ->join('teacher_classes','teacher_classes.teacher_id','=','teachers.id')
        ->select('subjects.namesub','teachers.name','exams.nameExam','exams.descriptionExam','exams.fileExam','exams.sessionExam')
        ->where('teachers.subject_id','=',$id)
        ->where('teacher_classes.class_id','=',Auth::guard('student')->user()->class_id)
    ->get();

    return response()->json(["status"=>"success","student_subject_exams"=>$student_subject_exams]);
    }

    public function getStudentSubjectCourses($id){
        
        $student_subject_courses=DB::table('teachers')
        ->join('courses','courses.teacher_id','=','teachers.id')
        ->join('subjects','subjects.id','=','teachers.subject_id')
        ->join('teacher_classes','teacher_classes.teacher_id','=','teachers.id')
        ->select('courses.id','courses.nameCourse','courses.descriptionCourse','courses.fileCourse','courses.sessionCourse')
        ->where('teachers.subject_id','=',$id)
        ->where('teacher_classes.class_id','=',Auth::guard('student')->user()->class_id)
    ->get();
    $exercices=Exercice::all();

    return response()->json(["status"=>"success","student_subject_courses"=>$student_subject_courses,"exercices"=>$exercices]);
    }
    public function getCoursExercices($id){
        $exercices=Course::find($id);

        return response()->json(["status"=>"success","exercices"=>$exercices]);

    }
}
