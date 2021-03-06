<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeacherAbsences;
use Illuminate\Support\Facades\DB;

class TeacherAbsencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher_absences = TeacherAbsences::orderBy('created_at','desc')->get();

        return response()->json(["status"=>"success","teacher_absences"=>$teacher_absences]);

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
        // return $request;
        $this->validate($request,[
            'teacher_id' => 'required',  
            'start_date' => 'required',
        ]);

        $teacher_absences = new TeacherAbsences;

        $teacher_absences->teacher_id=$request->input('teacher_id');
        $teacher_absences->start_date=$request->input('start_date');
        if($request->has('end_date')){
            $teacher_absences->end_date=$request->input('end_date');
        }

        if($teacher_absences->save()){
            return response()->json(["status"=>"success"]);
        }
        else{
            return response()->json(["status"=>"error"]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // return $id;
        // $teacher_absence=TeacherAbsences::find($id);

        // return $teacher_absence;
        $teacher_absences=DB::table('teachers')
        ->join('teacher_absences','teacher_absences.teacher_id','=','teachers.id')
        ->join('subjects','subjects.id','=','teachers.subject_id')
        ->select('teacher_absences.id','teacher_absences.teacher_id','teachers.name','teacher_absences.start_date','teacher_absences.end_date')
        ->where('teacher_absences.id',$id)
        ->get();
        // return  $teacher_absences;
        return response()->json(["status"=>"success","teacher_absence"=>$teacher_absences]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // return $request;
        $this->validate($request,[
            'teacher_id' => 'required',  
            // 'start_date' => 'required',
        ]);


        $teacher_absences = TeacherAbsences::find($id);

        $teacher_absences->teacher_id=$request->teacher_id;
        $teacher_absences->start_date=$request->start_date;
        $teacher_absences->end_date=$request->end_date;
        if($teacher_absences->save()){
            return response()->json(["status"=>"success"]);
        }
        else{
            return response()->json(["status"=>"error"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher_absences=TeacherAbsences::find($id);
        if($teacher_absences->delete()){
            return response()->json(["status"=>"success"]);
        }return response()->json(["status"=>"error"]);

    }

    public function teacherAbsences(){
        $teacher_absences=DB::table('teachers')
        ->join('teacher_absences','teacher_absences.teacher_id','=','teachers.id')
        ->join('subjects','subjects.id','=','teachers.subject_id')
        ->select('teacher_absences.id','subjects.namesub','teachers.name','teachers.tele','teacher_absences.start_date','teacher_absences.end_date')
        ->get();

        return response()->json(["status"=>"success","teacher_absences"=>$teacher_absences]);

    }
}
