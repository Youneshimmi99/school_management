<head>
    <link href="{{ asset('css/messages.css') }}" rel="stylesheet">
</head>

<div class="messages-main-container" @if(app()->getLocale()=='ar')style="text-align:right;" @endif>
@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger message">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success message">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger message">
        {{session('error')}}
    </div>
@endif

</div>