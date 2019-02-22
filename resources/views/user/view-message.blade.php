@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('user.sidebar')

        <div class="col-md-8">

            <div class="card">

                <div class="card-body">

                    <h4><span class="text-muted">Subject:</span> {{ $viewmessage->subject }}</h4>
                    <em>By {{ $viewmessage->fromUser->name }} < {{ $viewmessage->fromUser->email }} > at {{ $viewmessage->created_at->format('d M, Y') }}</em>
                    
                    <p class="border-top pt-2">{{ $viewmessage->body }}</p>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection
