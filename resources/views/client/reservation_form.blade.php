@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mt-4">
    <form method="post" action="{{ route('client.checkout')}}" >
        @csrf
        {{-- @method('PUT') --}}
        <div class="mb-3" hidden>
            <label for="price" class="form-label">Room id</label>
            <input type="text" class="form-control id="price" name="room_id" aria-describedby="emailHelp" value="{{ request()->route('room') }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="accompany_number" class="form-label">Accompany Number</label>
            <input type="text" class="form-control" id="accompany_number" name="accompany_number" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
  </div>
@endsection