@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Game #{{{ $game->id }}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
         <dl class="dl-horizontal">
            <dt>Started by</dt>
            <dd><a href="/characters/{{{ $game->initiator->id }}}">{{{ $game->initiator->name }}}</a></dd>
            <dt># Seats</dt>
            <dd>{{{ $game->seats }}}</dd>
            <dt>Buy In</dt>
            <dd>{{{ $game->buy_in }}}</dd>
            <dt>Prize</dt>
            <dd>{{{ $game->prize }}}</dd>
            <dt>Created At</dt>
            <dd>{{{ $game->created_at }}}</dd>
            <dt>Updated At</dt>
            <dd>{{{ $game->updated_at }}}</dd>
        </dl>
        @if ($game->trashed())
        <dl class="dl-horizontal">
            <dt>Winner</dt>
            <dd><a href="/characters/{{{ $game->winner->id }}}">{{{ $game->winner->name }}}</a></dd>
            <dt>Completed At</dt>
            <dd>{{{ $game->deleted_at }}}</dd>
        </dl>
        @endif
    </div>
    <div class="col-sm-6">
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Seat</th>
                        <th colspan="2">Character</th>
                        <th>Joined at</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @foreach ($seats as $index => $player)
                        @if ($player['pivot']['seat'])
                        <tr>
                            <td>{{ $player['pivot']['seat'] }}</td>
                            <td><a href="/characters/{{{ $player['id'] }}}"><img src="https://image.eveonline.com/Character/{{{ $player['id'] }}}_32.jpg" width="24" height="24" /></a></td>
                            <td><a href="/characters/{{{ $player['id'] }}}">{{{ $player['name'] }}}</a></td>
                            <td>{{{ $player['pivot']['created_at'] }}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td colspan="3"><a href="#" class="btn btn-primary">Buy in</a></td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop