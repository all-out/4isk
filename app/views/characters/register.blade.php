@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-6 col-sm-push-3">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                {{ Form::open(['route' => 'characters.register']) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Character Name:') }}
                        {{ Form::text('name', '', array('class' => 'form-control')) }}
                        {{ $errors->register->first('name') }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Password:') }}
                        {{ Form::password('password', array('class' => 'form-control')) }}
                        {{ $errors->register->first('password') }}
                    </div>
                    {{ Form::submit('Create Account', array('class' => 'btn btn-default')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop