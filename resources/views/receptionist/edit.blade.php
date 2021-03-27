@extends('layouts.app')

@section('content')

<div class="container mt-4">

<form method="POST" action="{{route('mangerUpdateReceptionist',$user->id ) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label" >Name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" value="{{$user['name']}}" >
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{$user['email']}}" >
    </div>
    <div class="mb-3">
        <label for="mobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" name="mobile" id="mobile" aria-describedby="emailHelp" value="{{$user['mobile']}}" >
    </div>
    <div class="mb-3">
        <label for="country" class="form-label">Country</label>
        <input type="text" class="form-control" name="country" id="country" aria-describedby="emailHelp" value="{{$user['country']}}" >
    </div>
    <button type="submit" class="btn btn-success">Edit</button>
</form> 
</div>

@endsection('content')
