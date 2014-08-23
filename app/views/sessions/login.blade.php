@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-6 col-sm-push-3">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                {{ Form::open(['route' => 'sessions.store']) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Character Name:') }}
                        {{ Form::text('name', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Password:') }}
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                    {{ Form::submit('Login', array('class' => 'btn btn-default')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop