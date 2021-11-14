<head>
    <link href="{{asset('css/grades/index.css')}}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')

<div class="main-container">
<!-- Button trigger modal -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createGradeModal" id="createGrade">
  <span class="fa fa-plus"></span> {{__('grades.index.create_grade')}}
</button>

@include('grades._create')

    <div class="container-table" @if(app()->getLocale()=='ar')dir="rtl" style="text-align:right;" @endif>
      <h2 class="head">{{__('grades.index.grades_table')}}</h2>
      <ul class="responsive-table">
     
        <li class="table-header">
          <div class="column column-1">{{__('grades.index.id')}}</div>
          <div class="column column-2">{{__('grades.index.name')}}</div>
          <div class="column column-3">{{__('grades.index.number')}}</div>
          <div class="column column-4">{{__('grades.index.cycle_name')}}</div>
          <div class="column column-5"></div>
        </li>
        @if(count($grades)>0)
        @foreach($grades as $grade)
       
        <li class="table-row" >
        <div class="column column-1" data-label="{{__('grades.index.id')}} :">{{$grade->id}}</div>
          <div dir="ltr" class="column column-2" data-label="{{__('grades.index.name')}} :">{{$grade->name}}</div>
          <div dir="ltr" class="column column-3" data-label="{{__('grades.index.number')}} :">{{$grade->number}}</div>
          <div class="column column-4" data-label="{{__('grades.index.cycle_name')}} :">{{$grade->cycle->name}}</div>
       
        {{-- <form onsubmit = "return confirm('{{__('admin.confirm_accept')}}');" action="{{ route('accept_request', $lost_card->id) }}" method="post" class="del-form">
            <div class="column column-5"><button  class="btn confirm" type="submit"><span class="fa fa-check"></span></button></div>    
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
        
        <form onsubmit = "return confirm('{{__('admin.confirm_refuse')}}');" action="{{ route('refuse_request', $lost_card->id) }}" method="post" class="del-form">
            <div class="column column-6"><button  class="btn refuse" type="submit"><span class="fa fa-trash"></span></button></div>    
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')
        </form> --}}
        </li>
        @endforeach
        @endif
      </ul>
    </div>


</div>


@if(Session::get('errors'))
<script>
window.onload = function(){
  document.getElementById('createGrade').click();
}
</script>
@endif
@endsection