@extends('layouts.master')

@section('content')
<div class="table-responsive">
    <table class="table table-striped table-condensed">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Password</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @foreach ($characters as $character)
        <tr>
            <td>{{{ $character->id }}}</td>
            <td>{{{ $character->name }}}</td>
            <td>{{{ $character->password }}} isk</td>
            <td>{{{ $character->created_at }}}</td>
            <td>
                <a href="/characters/{{{ $character->id }}}" class="btn btn-default">View</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop