@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <h2>Character</h2>
        <img src="https://image.eveonline.com/Character/{{ $character->id }}_128.jpg" class="pull-left img-responsive" />
        <dl class="dl-horizontal pull-left">
            <dt>id</dt>
            <dd>{{{ $character->id }}}</dd>
            <dt>Name</dt>
            <dd>{{{ $character->name }}}</dd>
            <dt>Deposits made</dt>
            <dd>{{ $character->deposits->count() }}</dd>
            <dt>Balance</dt>
            <dd>{{{ $character->balance }}}</dd>
            <dt>Active?</dt>
            <dd>{{{ $character->active }}}</dd>
            <dt>Created at</dt>
            <dd>{{{ $character->created_at }}}</dd>
            <dt>Updated at</dt>
            <dd>{{{ $character->updated_at }}}</dd>
            <dt>Roles</dt>
            <dd>
                <ul>
                @foreach ($character->roles as $role)
                    <li>{{ $role->name }}</li>
                @endforeach
                </ul>
            </dd>
        </dl>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Edit</div>
            <div class="panel-body">
                {{ Form::model($character, ['route' => ['characters.update', $character->id], 'method' => 'PUT']) }}
                    <div class="form-group">
                        {{ Form::label('key_id', 'Key ID:') }}
                        {{ Form::text('key_id', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('v_code', 'Verification Code:') }}
                        {{ Form::text('v_code', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('active', 'Active?:') }}
                        {{ Form::checkbox('active', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('roles[]', 'Roles:') }}
                        {{ Form::select('roles[]', Role::lists('name', 'id'), $character->roles->lists('id'), array('multiple' => true)) }}
                    </div>
                    {{ Form::submit('Save Changes', array('class' => 'btn btn-default')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop