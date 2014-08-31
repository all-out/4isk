@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Games</h2>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#in-progress" role="tab" data-toggle="tab">In Progress</a></li>
            <li><a href="#completed" role="tab" data-toggle="tab">Completed</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="in-progress">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Started By</th>
                            <th># Seats</th>
                            <th>Buy In</th>
                            <th>Prize</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach ($games['inProgress'] as $game)
                        <tr>
                            <td><a href="/games/{{{ $game->id }}}">{{{ $game->id }}}</a></td>
                            <td><a href="/characters/{{{ $game->initiator->id }}}">{{{ $game->initiator->name }}}</a></td>
                            <td>{{{ $game->seats }}}</td>
                            <td>{{{ $game->buy_in }}}</td>
                            <td>{{{ $game->prize }}}</td>
                            <td>{{{ $game->created_at }}}</td>
                            <td>
                                <a href="/games/{{{ $game->id }}}" class="btn btn-default">View</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="completed">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Started By</th>
                            <th>Winner</th>
                            <th># Seats</th>
                            <th>Buy In</th>
                            <th>Prize</th>
                            <th>Completed at</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach ($games['completed'] as $game)
                        <tr>
                            <td><a href="/games/{{{ $game->id }}}">{{{ $game->id }}}</a></td>
                            <td><a href="/characters/{{{ $game->initiator->id }}}">{{{ $game->initiator->name }}}</a></td>
                            <td><a href="/characters/{{{ $game->winner->id }}}">{{{ $game->winner->name }}}</a></td>
                            <td>{{{ $game->seats }}}</td>
                            <td>{{{ $game->buy_in }}}</td>
                            <td>{{{ $game->prize }}}</td>
                            <td>{{{ $game->deleted_at }}}</td>
                            <td>
                                <a href="/games/{{{ $game->id }}}" class="btn btn-default">View</a>
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
@stop