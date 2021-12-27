<?php

namespace App\Http\Controllers;

use App\Timetable;
use Illuminate\Http\Request;

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
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nameTimetable' => 'required|max:255',  
            // 'teaher_id' => 'required_without:student_id',
            // 'student_id' => 'required_without:teacher_id',
        
        ]);

        $timetable= Timetable::find($id);

            //upload file
            if($request->hasFile('file')){
                $image_path = $timetable->file;
      
                if(file_exists($image_path)){

                    unlink($image_path);
      
                 }

                 $filenameWithExt = $request->file('file')->getClientOriginalName();
                 $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                 $extension = $request->file('file')->getClientOriginalExtension();
                 $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
                 $path =$request->file('file')->storeAs('public/timetable_files',$filenameToStore);

                 $timetable->file='storage/timetable_files/'.$filenameToStore; 
        }

        if($request->has('teacher_id')){
            $timetable->teacher_id =$request->input('teacher_id');
        }else if($request->has('student_id')){
            $timetable->student_id =$request->input('student_id');
        }

        $timetable->nameTimetable =$request->input('nameTimetable');
        $timetable->save();
       
        return response()->json(["status"=>"success","timetable"=>$timetable]);
        }

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
}
