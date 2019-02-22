@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('user.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Received Message
                    <span class="float-right">

                        <form action="{{ route('home.receivedmessage.search') }}" method="GET" class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="receivedmessage" class="form-control rounded-0" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 rounded-0">Search</button>
                        </form>

                    </span>
                </div>

                <div class="card-body">
                    
                    <ul class="list-group">

                        @foreach($receivedmessages as $message)

                            <li class="list-group-item">
                                <a href="{{ route('home.viewmessage', $message->id) }}">
                                    @php 
                                        $fontbold = ($message->status == 0) ? 'font-weight-bold' : '';
                                    @endphp
                                    <span class="text-dark {{$fontbold}}">
                                        {{ $message->subject }}
                                    </span>
                                    <span class="text-dark font-italic">
                                        by {{ $message->fromUser->name }}
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </a>
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
