@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div >
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        @if (session('status'))
                                    <div class="alert alert-success" role="alert">{{session('status')}}</div>
                                        @endif
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>Email</td>
                                                    <td>Status</td>
                                                    <td>Actions</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <th>{{ $user->name }}</th>
                                                    <th>{{ $user->email }}</th>
                                                    <th>@if ($user->status == false)Inactive
                                                        @else Active
                                                    @endif</th>
                                                    <th><a href="{{ route('status', ['id'=>$user->id]) }}">@if ($user->status == true)Inactive
                                                        @else Active @endif</a></th>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
