<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Teacher;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam = Exam::orderBy('created_at','desc')->get();

        return response()->json(["status"=>"success","exam"=>$exam]);
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

    public function archive()
    {

    $exams=Exam::onlyTrashed()->get();
                            
      return response()->json(["status"=>"success","exams"=>$exams]);

    }

	public function trash($id)
	{
		$exam = Exam::findOrFail($id)->delete();

        return response()->json(["status"=>"success","exam"=>$exam]);
	}

    public function restore($id)
	{
        $exam = Exam::onlyTrashed()->findOrFail($id)->restore();

        return response()->json(["status"=>"success","exam"=>$exam]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nameExam' => 'required|max:255',
            'fileExam' => 'required',
            'sessionExam' => 'required',
            'teacher_id' => 'required',
            'grade_id' => 'required',

        
        ]);

        $exam = new Exam;

        //upload file
        if($request->hasFile('fileExam')){

            $extension = $request->file('fileExam')->getClientOriginalExtension();
            $filenameToStore=\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $path =$request->file('fileExam')->storeAs('public/exams',$filenameToStore);
        
            $exam->fileExam='storage/exams/'.$filenameToStore; 
        }

        $exam->nameExam= $request->input('nameExam');
        if($request->has('descriptionExam')){
            $exam->descriptionExam= $request->input('descriptionExam');
        }

        $exam->sessionExam= $request->input('sessionExam');
        $exam->teacher_id= $request->input('teacher_id');
        $exam->grade_id= $request->input('grade_id');

        if($request->has('option_id')){
            $exam->option_id= $request->input('option_id');
        }

        if($request->has('branch_id')){
            $exam->branch_id= $request->input('branch_id');
        }

        $exam->save();

        return response()->json(["status"=>"success","exam"=>$exam]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);

        return response()->json(["status"=>"success","exam"=>$exam]);
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
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nameExam' => 'required|max:255',
            // 'fileExam' => 'required',
            'sessionExam' => 'required',
            'teacher_id' => 'required',
            'grade_id' => 'required',

        
        ]);

        $exam = Exam::find($id);

        //upload file
        if($request->hasFile('fileExam')){
            $image_path = $exam->fileExam;
      
            if(file_exists($image_path)){

                unlink($image_path);
  
             }
            $extension = $request->file('fileExam')->getClientOriginalExtension();
            $filenameToStore=\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $path =$request->file('fileExam')->storeAs('public/exams',$filenameToStore);
        
            $exam->fileExam='storage/exams/'.$filenameToStore; 
        }

        $exam->nameExam= $request->input('nameExam');
        if($request->has('descriptionExam')){
            $exam->descriptionExam= $request->input('descriptionExam');
        }

        $exam->sessionExam= $request->input('sessionExam');
        $exam->teacher_id= $request->input('teacher_id');
        $exam->grade_id= $request->input('grade_id');

        if($request->has('option_id')){
            $exam->option_id= $request->input('option_id');
        }

        if($request->has('branch_id')){
            $exam->branch_id= $request->input('branch_id');
        }

        $exam->save();

        return response()->json(["status"=>"success","exam"=>$exam]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$exam = Exam::onlyTrashed()->findOrFail($id);
        $image_path = $exam->fileExam;

        if(file_exists($image_path)){
          unlink($image_path);
        }
        $exam->forceDelete();
        
        return response()->json(["status"=>"success","exam"=>$exam]);
    }


    public function teacherExams($id){

        $teacher_exams=Teacher::find($id)->exams;

        return response()->json(["status"=>"success","teacher_exams"=>$teacher_exams]);
    }

    public function subjectExams($id){

        $subject_exams=DB::table('teachers')
        ->join('exams','exams.teacher_id','=','teachers.id')
        ->join('subjects','subjects.id','=','teachers.subject_id')
        ->select('subjects.namesub','teachers.name as nameTeacher','exams.nameExam','exams.descriptionExam','exams.fileExam','exams.sessionExam')
        ->where('teachers.subject_id','=',$id)
        ->get();

        return response()->json(["status"=>"success","subject_exams"=>$subject_exams]);
    }
}
