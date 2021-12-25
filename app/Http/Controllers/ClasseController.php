<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Grade;
use App\Option;
use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->join('branchs','branchs.id','=','classes.branch_id')
                            ->get();
                            
      return response()->json(["status"=>"success","classes"=>$classes]);

    //   select * from classes inner join grades on grades.id = classes.grade_id
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {

    $classes=Classe::onlyTrashed()->get();
                            
      return response()->json(["status"=>"success","classes"=>$classes]);

    }

	public function trash($id)
	{
		$classe = Classe::findOrFail($id)->delete();

        return response()->json(["status"=>"success","classe"=>$classe]);
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
        $this->validate($request,[
            'name' => 'required|max:255',  
            'number' => 'required|integer|min:1|max:6',
            'grade_id' => 'required|integer',
            'option_id' => 'required|integer',
            'branch_id' => 'integer',
        
        ]);

        $classe = new Classe;
        $classe->name= $request->input('name');
        $classe->number = $request->input('number');
        $classe->grade_id = $request->input('grade_id');
        $classe->option_id = $request->input('option_id');
        $classe->branch_id = $request->input('branch_id');
        $classe->save();

        return response()->json(["status"=>"success"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$classe = Classe::onlyTrashed()->findOrFail($id)->forceDelete();
        
        return response()->json(["status"=>"success","classe"=>$classe]);
    }
}
