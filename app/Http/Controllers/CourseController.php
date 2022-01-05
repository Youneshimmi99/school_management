<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Teacher;
use Illuminate\Support\Facades\DB;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::orderBy('created_at','desc')->get();

        return response()->json(["status"=>"success","course"=>$course]);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {

    $courses=Course::onlyTrashed()->get();
                            
      return response()->json(["status"=>"success","courses"=>$courses]);

    }

	public function trash($id)
	{
		$course = Course::findOrFail($id)->delete();

        return response()->json(["status"=>"success","course"=>$course]);
	}

    public function restore($id)
	{
        $course = Course::onlyTrashed()->findOrFail($id)->restore();

        return response()->json(["status"=>"success","course"=>$course]);
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
            'nameCourse' => 'required|max:255',
            'fileCourse' => 'required',
            'sessionCourse' => 'required',
            'teacher_id' => 'required',
            'grade_id' => 'required',

        
        ]);

        $course = new Course;

        //upload image
        if($request->hasFile('fileCourse')){
            // $filenameWithExt = $request->file('fileCourse')->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('fileCourse')->getClientOriginalExtension();
            // $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $filenameToStore=\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $path =$request->file('fileCourse')->storeAs('public/courses',$filenameToStore);
        
            $course->fileCourse='storage/courses/'.$filenameToStore; 
        }

        $course->nameCourse= $request->input('nameCourse');
        if($request->has('descriptionCourse')){
            $course->descriptionCourse= $request->input('descriptionCourse');
        }

        $course->sessionCourse= $request->input('sessionCourse');
        $course->teacher_id= $request->input('teacher_id');
        $course->grade_id= $request->input('grade_id');

        if($request->has('option_id')){
            $course->option_id= $request->input('option_id');
        }

        if($request->has('branch_id')){
            $course->branch_id= $request->input('branch_id');
        }

        $course->save();

        return response()->json(["status"=>"success","course"=>$course]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        return response()->json(["status"=>"success","course"=>$course]);
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
            'nameCourse' => 'required|max:255',
            'sessionCourse' => 'required',
            'teacher_id' => 'required',
            'grade_id' => 'required',

        
        ]);

        $course = Course::find($id);

        //upload image
        if($request->hasFile('fileCourse')){

            $image_path = $course->fileCourse;
      
            if(file_exists($image_path)){

                unlink($image_path);
  
             }

            // $filenameWithExt = $request->file('fileCourse')->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('fileCourse')->getClientOriginalExtension();
            // $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $filenameToStore=\Carbon\Carbon::now()->timestamp.$extension;
            $path =$request->file('fileCourse')->storeAs('public/courses',$filenameToStore);
        
            $course->fileCourse='storage/courses/'.$filenameToStore; 
        }

        $course->nameCourse= $request->input('nameCourse');
        if($request->has('descriptionCourse')){
            $course->descriptionCourse= $request->input('descriptionCourse');
        }
        if($request->has('sessionCourse')){
            $course->sessionCourse= $request->input('sessionCourse');
        }
        $course->teacher_id= $request->input('teacher_id');
        $course->grade_id= $request->input('grade_id');

        if($request->has('option_id')){
            $course->option_id= $request->input('option_id');
        }

        if($request->has('branch_id')){
            $course->branch_id= $request->input('branch_id');
        }

        $course->save();

        return response()->json(["status"=>"success","course"=>$course]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$course = Course::onlyTrashed()->findOrFail($id);
        $image_path = $course->fileCourse;

        if(file_exists($image_path)){
          unlink($image_path);
        }
        $course->forceDelete();
        
        return response()->json(["status"=>"success","course"=>$course]);
    }

    public function teacherCourses($id){

        $teacher_courses=Teacher::find($id)->courses;

        return response()->json(["status"=>"success","teacher_courses"=>$teacher_courses]);
    }

    public function subjectCourses($id){

        $subject_courses=DB::table('teachers')
        ->join('courses','courses.teacher_id','=','teachers.id')
        ->join('subjects','subjects.id','=','teachers.subject_id')
        ->select('subjects.namesub','teachers.name as nameTeacher','courses.nameCourse','courses.descriptionCourse','courses.fileCourse','courses.sessionCourse')
        ->where('teachers.subject_id','=',$id)
        ->get();

        return response()->json(["status"=>"success","subject_courses"=>$subject_courses]);
    }
}
