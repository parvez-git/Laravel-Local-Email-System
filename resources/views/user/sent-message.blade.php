@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('user.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Sent Message</span>
                    <span class="float-right">

                        <form action="{{ route('home.sentmessage.search') }}" method="GET" class="form-inline">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="sentmessage" class="form-control rounded-0" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 rounded-0">Search</button>
                        </form>

                    </span>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($sentmessages as $message)
                        <li class="list-group-item">
                            <div class="text-dark">
                                <span class="font-weight-bold">
                                    {{ $message->subject }}
                                </span>
                                @if($message->toUser)
                                <span class="font-italic">
                                    to {{ $message->toUser->name }}
                                </span>
                                @endif
                            </div>
                            <span class="d-block">{{ $message->body }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
