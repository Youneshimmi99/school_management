<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Grade;
use App\Option;
use App\Branch;
use App\Admin;
use App\Teacher;
use App\Student;
use App\Teacher_classe;
use App\Timetable;
use Illuminate\Support\Facades\Auth;


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
                            ->select('classes.id','classes.nameClasse','classes.numberCls','grades.nameGrade','options.nameOption','branchs.nameBranch')
                            ->where('grades.cycle_id',$id)
                            ->where('classes.deleted_at',NULL)
                            ->get();
                           
         }
         else if ($id==2) {
            $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->select('classes.id','classes.nameClasse','classes.numberCls','grades.nameGrade','options.nameOption')
                            ->where('grades.cycle_id',$id)
                            ->where('classes.deleted_at',NULL)
                            ->get();
                           
         }
         else {
             $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->select('classes.id','classes.nameClasse','classes.numberCls','grades.nameGrade','options.nameOption')
                            ->where('grades.cycle_id',$id)
                            ->where('classes.deleted_at',NULL)
                            ->get();
                           
         }
        
                      
      return response()->json(["status"=>"success","classes"=>$classes]);
    }
    public function GetClassesByIdGrade($id){
        $classes=Classe::WHERE('grade_id',$id)->get();
        return response()->json(["status"=>"success","classes"=>$classes]);
    }
    public function ClasseTimeTableOk($id){
        // $timetable=TimeTable::all();
         $timetable = TimeTable::select("class_id")
                    ->whereNotNull('class_id' )
                    ->get()->ToArray();
        $classesTimeTblesuccess=DB::table('classes')
                    ->join('timetables','timetables.class_id','=','classes.id')
                    ->join('grades','grades.id','=','classes.grade_id')
                    ->select('timetables.id','classes.nameClasse','classes.numberCls','timetables.class_id')
                    ->where('classes.grade_id','=',$id)
                    ->get();
        $classesTimeTblePending=DB::table('classes')
                    ->join('grades','grades.id','=','classes.grade_id')
                    ->select('classes.id','classes.nameClasse','classes.numberCls')
                    ->where('classes.grade_id','=',$id)
                    ->whereNotIn('classes.id',$timetable)
                    
                    ->get();            
        return response()->json(["status"=>"success","classesTimeTblesuccess"=>$classesTimeTblesuccess,'classesTimeTblePending'=>$classesTimeTblePending]);
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
        $request->validate([
                'nameClasse' =>'required',
                'number'=>'required|numeric',
                'IdGrade'       =>'required',
                'Option_id'       =>'required', 
            ],[
                'nameClasse.required' => 'Le champ Nom Classe est obligatoire.',
                'number.required' => 'Le champ Number est obligatoire.',
                'IdGrade.required' => 'Le champ de Niveau est obligatoire.',
                'Option_id.required' => 'Le champ de Option est obligatoire.',
            ]);
        // return $request;
        $classe=new Classe();
        $classe->nameClasse=$request->nameClasse;
        $classe->numberCls=$request->number;
        $classe->grade_id=$request->IdGrade;
        $classe->option_id=$request->Option_id;
        if ($request->branch_id) {
            $classe->branch_id=$request->branch_id;
        }
        if ($classe->save()) {
            return response()->json(["status"=>"success"]);
        }
         else return response()->json(["status"=>"error"]);
    }
    public function AddAdmin(Request $request){
        // return $request;
        $request->validate([
                'name' =>'required',
                'email'=>'required|email',
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
    public function ConfirmTimeTable(){
        $teachers=DB::table('teachers')
                            ->join('timetables','timetables.teacher_id','=','teachers.id')
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select('timetables.id','teachers.name','subjects.namesub','timetables.nameTimetable')
                            ->get();
                            // return $teachers;
        return response()->json(["status"=>"success","teachers"=>$teachers]);
    }
    public function AllteachersClasses(){
        $teachers=DB::table('teachers')
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select('teachers.id','teachers.name','teachers.email','teachers.image','teachers.tele','subjects.namesub')
                            ->get();
                            // return $teachers;
        $teachers_classes=DB::table('teacher_classes')
                            ->join('classes','classes.id','=','teacher_classes.class_id')
                            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select('teacher_classes.id','teacher_classes.teacher_id','classes.nameClasse')
                            ->get();
                            // return $teachers;                 
        return response()->json(["status"=>"success","teachers"=>$teachers,"teacher_classes"=>$teachers_classes]);

    }
    public function AllteachersNotTimetable(){
        $teachers=DB::table('teachers')
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select('teachers.id','teachers.name','teachers.email','teachers.image','teachers.tele','subjects.namesub')
                            ->whereNotIn('teachers.id',DB::table('timetables')->where('teacher_id','=','teachers.id')->pluck('teacher_id')->toArray())
                            ->get();
        // 
                            // return $teachers;
        $teachers_classes=DB::table('teacher_classes')
                            ->join('classes','classes.id','=','teacher_classes.class_id')
                            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
                            ->join('subjects','subjects.id','=','teachers.subject_id')
                            ->select('teacher_classes.id','teacher_classes.teacher_id','classes.nameClasse')
                            ->get();
                            // return $teachers;                 
        return response()->json(["status"=>"success","teachers"=>$teachers,"teacher_classes"=>$teachers_classes]);

    }
     public function AllStudents(){
        $students=Student::all();
        if ($students) {
             return response()->json(["status"=>"success","students"=>$students]);
        }return response()->json(["status"=>"error"]);
    }
    public function AllAdmins(){
        $idadmin=Auth::guard('admin')->user()->id;
        $admins=Admin::all();
        if ($admins) {
           return response()->json(["status"=>"success","admins"=>$admins,'idadmin'=>$idadmin]);
        }return response()->json(["status"=>"error"]);
    }
    public function GestAdminActive(){
        $admin=Auth::guard('admin')->user();
        if ($admin) {
           return response()->json(["status"=>"success","adminactive"=>$admin]);
        }return response()->json(["status"=>"error"]);
    }
    
    ///1111
    public function ClassesTeacher($id){
        $teachers_classes=DB::table('teacher_classes')
                            ->join('classes','classes.id','=','teacher_classes.class_id')
                            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
                            ->select('classes.id','classes.nameClasse')
                            ->where('teachers.id',$id)
                            ->get();
                            $Conutteachers_classes=DB::table('teacher_classes')
                            ->join('classes','classes.id','=','teacher_classes.class_id')
                            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
                            ->select('classes.id','classes.nameClasse')
                            ->where('teachers.id',$id)
                            ->count();


        $teacher=Teacher::find($id);
        $teacher_classe=Teacher_classe::where('teacher_id',$id);
   

                            // return $teachers;                 
        return response()->json(["status"=>"success","teachers"=>$teacher,"teacher_classes"=>$teachers_classes,"countTeacherClasses"=>$Conutteachers_classes]);

    }

   
    ///2222
    public function EditTeacher($id){
       
        $teacher=Teacher::find($id);
        // $teacher_classe=Teacher_classe::where('teacher_id',$id);
        // $teacher_classe=DB::table('teacher_classes')
        //                     ->join('teachers','teachers.id','teacher_classes.teacher_id')
        //                     ->join('classes','classes.id','teacher_classes.class_id')
        //                     ->select('classes.id','classes.nameClasse')
        //                     ->where('teacher_classes.teacher_id',$id)
        //                     ->get();
                            
        // return $teacher;
        return response()->json(["status"=>"success","teachers"=>$teacher]);
    }
    public function EditAdmin($id){
        $admin=Admin::find($id);
        if ($admin) {
            return response()->json(["status"=>"success","editadmin"=>$admin]);
        }return response()->json(["status"=>"error"]);
    }
    public function editStudent($id){
        $student=Student::find($id);
        // return $teacher;
        return response()->json(["status"=>"success","student"=>$student]);
    }
    public function UpdateTeacher(Request $request){
        
              $request->validate([
                'name'=>'required',
                'email'=>'required|email',
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
    public function UpdateAdmin(Request $request){
        // return $request;
            $request->validate([
                'name'=>'required',
                'email'=>'required|email',
                'password'       =>'required',
                'password2'       =>'required',
                'tele'      =>'required',  
            ]);
            $admin=Admin::find($request->id);
            if ($request->password===$request->password2) {
                $admin->name=$request->name;
                $admin->email=$request->email;
                $admin->tele=$request->tele;
                $admin->password=\Hash::make($request->password);
                if($admin->save()){
                    return response()->json(["status"=>"success"]);
                }return response()->json(["status"=>"faild"]);
            }else {
            return response()->json(["password"=>"error","msg"=>"Vos mot de passe  ne sont pas correctes !"]);
            }

    }
    public function UpdateStudent(Request $request){
        $request->validate([    
            'name'=>'required',
            'email'=>'required|email',
            'password'       =>'required',
            'tele'      =>'required',  
        ]);
        $student=Student::find($request->id);
        if ($request->password===$request->password2) {
            // if (!Student::where('email',$request['student']['email'])->count()) {
                    $student->name=$request->name;
                    $student->email=$request->email;
                    $student->password=\Hash::make($request->password);
                    $student->tele=$request->tele;
                    if ($student->save()) {
                        return response()->json(["status"=>"success"]);
                    }else return response()->json(["status"=>"error"]);
                // }return response()->json(["email"=>"error","msg"=>"Ce email déjà utilisée !"]);
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
    public function DelteTeacherClasse($id){
       
        $teacher_classe=Teacher_classe::find($id);
        // return $teacher_classe;
        // return $teacher;
        // $teacher->delete();
        if ($teacher_classe->delete()) {
           return response()->json(["status"=>"success"]);
        }return response()->json(["status"=>"faild"]);
    }
     public function DeleteTimeTable($id){
        // return $id;
        $Timetable=Timetable::find($id);
        // return $teacher;
        // $teacher->delete();
        if ($Timetable->delete()) {
           return response()->json(["status"=>"success"]);
        }return response()->json(["status"=>"faild"]);
    }
    public function DeleteStudent($id){
        $student=Student::find($id);
        if ($student->delete()) {
           return response()->json(["status"=>"success"]);
        }return response()->json(["status"=>"faild"]);
    }
    public function DeleteAdmin($id){
        if (Auth::guard('admin')->user()->id==$id) {
           return response()->json(["status"=>"impossible"]);
        } 
        else {
            $admin=Admin::find($id);
            if ($admin->delete()) {
            return response()->json(["status"=>"success"]);
            }return response()->json(["status"=>"faild"]);
        }
        
    }
     public function AddStudent(Request $request){ 
            $request->validate([
                'name' =>'required',
                'email'=>'required|email',
                'password'       =>'required',
                'password2'       =>'required',
                'tele'      =>'required',  
            ]);
            if ($request->password==$request->password2) {
                    $student=new Student();
                    $student->name=$request->name;
                    $student->email=$request->email;
                    $student->password=\Hash::make($request->password);
                    $student->tele=$request->tele;
                    if ($student->save()) {
                        return response()->json(["status"=>"success"]);
                    }else return response()->json(["status"=>"error"]);       
            }else return response()->json(["password"=>"error","msg"=>"Vos mot de passe  ne sont pas correctes !"]);
      }
      public function TrashStudent($id){
        $classe = Classe::find($id);
        return $classe;   
      }

}

