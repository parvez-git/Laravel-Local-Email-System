@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('user.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Message</div>

                <div class="card-body">
                    
                    <form action="{{ route('home.message.send') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <select name="message_to" class="form-control rounded-0" id="">
                                <option value="">--SELECT EMAIL--</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('message_to'))
                                <small id="emailHelp" class="form-text text-danger">
                                    <strong>{{ $errors->first('message_to') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control rounded-0" placeholder="Enter Subject">
                            @if ($errors->has('subject'))
                                <small id="emailHelp" class="form-text text-danger">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="body" class="form-control rounded-0" rows="3"></textarea>
                            @if ($errors->has('body'))
                                <small id="emailHelp" class="form-text text-danger">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </small>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary rounded-0">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
