<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercice;
use App\Course;

class ExerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercice = Exercice::orderBy('created_at','desc')->get();

        return response()->json(["status"=>"success","exercice"=>$exercice]);
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

    $exercices=Exercice::onlyTrashed()->get();
                            
      return response()->json(["status"=>"success","exercices"=>$exercices]);

    }

	public function trash($id)
	{
		$exercice = Exercice::findOrFail($id)->delete();

        return response()->json(["status"=>"success","exercice"=>$exercice]);
	}

    public function restore($id)
	{
        $exercice = Exercice::onlyTrashed()->findOrFail($id)->restore();

        return response()->json(["status"=>"success","courseExercices"=>$exercice]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request ;
        $this->validate($request,[
            'nameExercice' => 'required|max:255',
            'fileExercice' => 'required',
            'course_id' => 'required',
            'descriptionExercice'=>'required',
        ]);

        $exercice = new Exercice;

        //upload image
        if($request->hasFile('fileExercice')){
            // $filenameWithExt = $request->file('fileCourse')->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('fileExercice')->getClientOriginalExtension();
            // $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $filenameToStore=\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $path =$request->file('fileExercice')->storeAs('public/courses/exercices/',$filenameToStore);
        
            $exercice->fileExercice='storage/courses/exercices/'.$filenameToStore; 
        }

        $exercice->nameExercice= $request->input('nameExercice');
        if($request->has('descriptionExercice')){
            $exercice->descriptionExercice= $request->input('descriptionExercice');
        }

        $exercice->course_id= $request->input('course_id');


        $exercice->save();

        return response()->json(["status"=>"success","exercice"=>$exercice]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exercice = Exercice::find($id);

        return response()->json(["status"=>"success","exercice"=>$exercice]);
    }

   public function courseExercices($id)
    {
        
        $exercices = Course::find($id)->exercices;
// return $exercices;
        return response()->json(["status"=>"success","exercices"=>$exercices]);
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
            'nameExercice' => 'required|max:255',
            // 'fileExercice' => 'required',
            'course_id' => 'required',


        
        ]);

        $exercice = Exercice::find($id);

        //upload image
        if($request->hasFile('fileExercice')){
            $image_path = $exercice->fileExercice;
      
            if(file_exists($image_path)){
                unlink($image_path);
             }

            // $filenameWithExt = $request->file('fileCourse')->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('fileExercice')->getClientOriginalExtension();
            // $filenameToStore=$filename.''.\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $filenameToStore=\Carbon\Carbon::now()->timestamp.'main.'.$extension;
            $path =$request->file('fileExercice')->storeAs('public/courses/exercices',$filenameToStore);
        
            $exercice->fileExercice='storage/courses/exercices'.$filenameToStore; 
        }

        $exercice->nameExercice= $request->input('nameExercice');
        if($request->has('descriptionExercice')){
            $exercice->descriptionExercice= $request->input('descriptionExercice');
        }

        $exercice->course_id= $request->input('course_id');
        $exercice->save();

        return response()->json(["status"=>"success","exercice"=>$exercice]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$exercice = Exercice::onlyTrashed()->findOrFail($id);
        $image_path = $exercice->fileExercice;

        if(file_exists($image_path)){
          unlink($image_path);
        }
        $exercice->forceDelete();
        
        return response()->json(["status"=>"success","exercice"=>$exercice]);
    }
}
