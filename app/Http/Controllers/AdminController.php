<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Grade;
use App\Option;
use App\Branch;
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
                            ->where('grades.cycle_id',$id)
                            ->get();
         }
         else if ($id==2) {
            $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->where('grades.cycle_id',$id)
                            ->get();
         }
         else {
             $classes=DB::table('classes')
                            ->join('grades','grades.id','=','classes.grade_id')
                            ->join('options','options.id','=','classes.option_id')
                            ->where('grades.cycle_id',$id)
                            ->get();
         }
        
                      
      return response()->json(["status"=>"success","classes"=>$classes]);
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
        $classe=new Classe();
        $classe->nameClasse=$request->nameClasse;
        $classe->numberCls=$request->number;
        $classe->grade_id=$request->IdGrade;
        $classe->option_id=$request->Option_id;
        if ($classe->save()) {
            return response()->json(["status"=>"success"]);
        }
         else return response()->json(["status"=>"error"]);



    }
}

