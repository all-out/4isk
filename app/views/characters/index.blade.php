@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Characters</h2>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Balance</th>
                    <th>Deposits made</th>
                    <th>Active?</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="table-hover">
                @foreach ($characters as $character)
                <tr>
                    <td>{{{ $character->id }}}</td>
                    <td>{{{ $character->name }}}</td>
                    <td>{{{ $character->balance }}} isk</td>
                    <td>{{ $character->deposits->count() }}</td>
                    <td>{{{ $character->active }}}</td>
                    <td>
                        <a href="/characters/{{{ $character->id }}}" class="btn btn-default">View</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop