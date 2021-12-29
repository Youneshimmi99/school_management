<?php

namespace App\Http\Controllers;

use App\Timetable;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classe;
use Illuminate\Support\Facades\Storage;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->classe_id;
        // $this->validate($request,[
        //     'nameTimetable' => 'required|max:255',  
        //     'file' => 'required',
        //     // 'teaher_id' => 'required_without:student_id',
        //     // 'student_id' => 'required_without:teacher_id',
        
        // ]);

        $timetable = new Timetable;

        //upload image
        if($request->hasFile('file')){
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $path =$request->file('file')->storeAs('public/timetable_files',$filenameToStore);
            $timetable->file='storage/timetable_files/'.$filenameToStore; 
            $timetable->teacher_id =$request->teacher_id;
            // $timetable->class_id=$request->classe_id;
            $timetable->nameTimetable =$request->nameTimetable;
            $timetable->save();
             return response()->json(["status"=>"success"]);
        } return response()->json(["status"=>"error"]);

        // if($request->has('teacher_id')){
        //     $timetable->teacher_id =$request->teacher_id;
        // }else if($request->has('student_id')){
        //     $timetable->student_id =$request->input('student_id');
        // }

       
        

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timetable = Timetable::find($id);

        return response()->json(["status"=>"success","timetable"=>$timetable]);

    }

    public function teacherTimetable($id)
    {
         $timetable=TimeTable::find($id);
    //    return $timetable;
        
    // $file= $timetable['file'];

    //     $headers = [
    //           'Content-Type' => 'image/png',
    //        ];

    // return response()->download($file, 'filename.png', $headers);
        return response()->json(["status"=>"success","timetable"=>$timetable]);

    }

    public function teachersWithoutTimetable()
    {
        $timetables = Timetable::whereNotNull('teacher_id')->get();

        foreach($timetables as $timetable){
            $teachers_id[]=$timetable->teacher_id;
        }
        $teachers = Teacher::whereNotIn('id', $teachers_id)->get();

        return response()->json(["status"=>"success","teachers"=>$teachers]);

    }

    // public function studentTimetable($id)
    // {
    //     $timetable = DB::table('timetables')
    //     ->join('students','students.class_id','=','timetables.class_id')
    //     ->join('classes','classes.id','=','timetables.class_id')
    //     ->select('students.id','students.name','classes.nameClasse','classes.numberCls','timetables.id','timetables.nameTimetable','timetables.file')
    //     ->where('timetables.class_id',$id)
    //     ->get();

    //     return response()->json(["status"=>"success","timetable"=>$timetable]);

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     $timetable = new Timetable;

    //     //upload image
    //     if($request->hasFile('file')){
    //         $filenameWithExt = $request->file('file')->getClientOriginalName();
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         $extension = $request->file('file')->getClientOriginalExtension();
    //         $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
    //         $path =$request->file('file')->storeAs('public/timetable_files',$filenameToStore);
    //         $timetable->file='storage/timetable_files/'.$filenameToStore;           
    //         $timetable->teacher_id =$request->teacher_id;
    //         // $timetable->class_id=$request->classe_id;
    //         $timetable->nameTimetable =$request->nameTimetable;
    //         $timetable->save();
    //          return response()->json(["status"=>"success"]);
    //     } return response()->json(["status"=>"error"]);
 
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //
    }
    public function CreateTimeTableClasse(Request $request){
        // return $request;
        $this->validate($request,[
            'nameTimetable' => 'required|max:255',  
            'file' => 'required',
        ]);
         $timetable = new Timetable;

        //upload image
        if($request->hasFile('file')){
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $path =$request->file('file')->storeAs('public/timetable_files',$filenameToStore);
            $timetable->file='storage/timetable_files/'.$filenameToStore; 
            
            $timetable->class_id =$request->classe_id;
            // $timetable->class_id=$request->classe_id;
            $timetable->nameTimetable =$request->nameTimetable;
            $timetable->save();
             return response()->json(["status"=>"success"]);
        } return response()->json(["status"=>"error"]);
    }
     public function GetInfoClasse($id){
        $classe=Classe::find($id);
        if($classe){
            return response()->json(["status"=>"success","classeinfo"=>$classe]);
        }return response()->json(["status"=>"error"]);
       
    }public function DeleteTimetableClasse($id){
        $timetable=TimeTable::find($id);
        if($timetable->delete()){
            return response()->json(["status"=>"success"]);
        }return response()->json(["status"=>"error"]);

    }
}
