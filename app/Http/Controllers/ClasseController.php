<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::orderBy('number','desc')->get();
        $grades = Grade::orderBy('number','desc')->get();
        $options = Option::orderBy('id','desc')->get();
        $branchs = Branch::orderBy('id','desc')->get();

        return response()->json([
            "status" => "success",
            "classes" => $classes,
            "grades" => $grades,
            "options" => $options,
            "branchs" => $branchs
        ]);
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
    public function destroy(Classe $classe)
    {
        //
    }
}
