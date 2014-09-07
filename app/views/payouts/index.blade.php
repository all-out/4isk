@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Payouts</h2>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Winner</th>
                        <th>Related Games</th>
                        <th>Prizes</th>
                        <th>Fulfilled</th>
                        <th>Verified</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @foreach ($payouts as $payout)
                    <tr>
                        <td><a href="/payouts/{{{ $payout->id }}}">{{{ $payout->id }}}</a></td>
                        <td><a href="/characters/{{{ $payout->winner->id }}}">{{{ $payout->winner->name }}}</a></td>
                        <td>
                            @foreach ($payout->games as $game)
                            <a href="/games/{{{ $game->id }}}">{{{ $game->id }}}</a>
                            @endforeach
                        </td>
                        <td>
                            {{{ $payout->prizes['isk'] }}}
                            <ul>
                                @foreach($payout->prizes['items'] as $prize)
                                <li>{{{ $prize }}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if($payout->fulfilled)
                            <i class="glyphicon glyphicon-ok-sign" style="color: green;"></i> <a href="/characters/{{{ $payout->fulfiller->id }}}">{{{ $payout->fulfiller->name }}}</a>
                            @else
                            <a href="#" class="btn btn-default">Fulfill</a>
                            @endif
                        </td>
                        <td>
                            @if($payout->verified)
                            <i class="glyphicon glyphicon-ok-sign" style="color: green;"></i>
                            @else
                            <i class="glyphicon glyphicon-remove" style="color: red;"></i>
                            @endif
                        </td>
                        <td>{{{ $payout->created_at }}}</td>
                        <td>{{{ $payout->updated_at }}}</td>
                        <td>
                            <a href="/payouts/{{{ $payout->id }}}" class="btn btn-default">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop