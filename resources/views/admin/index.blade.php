@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        @include('admin.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->login_at)->diffForHumans() }}</td>
                                        <td>
                                        @if($user->admin == 0)
                                            @if($user->block)
                                                <a href="{{ route('admin.user.block',$user->id) }}" class="btn btn-sm btn-success rounded-0 w-50 float-left"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('userblock-form-{{$user->id}}').submit();">Unblock</a>

                                                <form id="userblock-form-{{$user->id}}" action="{{ route('admin.user.block',$user->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            @else
                                                <a href="{{ route('admin.user.block',$user->id) }}" class="btn btn-sm btn-warning rounded-0 w-50 float-left"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('userblock-form-{{$user->id}}').submit();">Block</a>

                                                <form id="userblock-form-{{$user->id}}" action="{{ route('admin.user.block',$user->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            @endif

                                            <a href="{{ route('admin.user.delete',$user->id) }}" class="btn btn-sm btn-danger rounded-0 w-50 float-left"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('userdelete-form-{{$user->id}}').submit();">Delete</a>

                                            <form id="userdelete-form-{{$user->id}}" action="{{ route('admin.user.delete',$user->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-sm btn-primary rounded-0 w-100">Admin</button>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
