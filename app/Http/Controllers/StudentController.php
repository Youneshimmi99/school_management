<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function IndexDashStudent(){
        return view("Student.DashStudent");
    }
}
