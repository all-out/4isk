@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Payout #{{{ $payout->id }}}</h2>
        <dl class="dl-horizontal">
            <dt>Winner</dt>
            <dd>
                <a href="/characters/{{{ $payout->winner->id }}}">{{{ $payout->winner->name }}}</a>
            </dd>
            <dt>Related Games</dt>
            <dd>
                @foreach ($payout->games as $game)
                <a href="/games/{{{ $game->id }}}">{{{ $game->id }}}</a>
                @endforeach
            </dd>
            <dt>Prizes</dt>
            <dd>
                {{{ $payout->prizes['isk'] }}}
                <ul>
                    @foreach($payout->prizes['items'] as $prize)
                    <li>{{{ $prize }}}</li>
                    @endforeach
                </ul>
            </dd>
            <dt>Fulfilled</dt>
            <dd>
                @if($payout->fulfilled)
                <i class="glyphicon glyphicon-ok-sign" style="color: green;"></i> <a href="/characters/{{{ $payout->fulfiller->id }}}">{{{ $payout->fulfiller->name }}}</a>
                @else
                {{ Form::open(['route' => ['payouts.fulfill', $payout->id], 'method' => 'PATCH']) }}
                    {{ Form::submit('Fulfill', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
                @endif
            </dd>
            <dt>Verified</dt>
            <dd>
                @if($payout->verified)
                <i class="glyphicon glyphicon-ok-sign" style="color: green;"></i>
                @else
                <i class="glyphicon glyphicon-remove" style="color: red;"></i>
                @endif
            </dd>
            <dt>Created at</dt>
            <dd>{{{ $payout->created_at }}}</dd>
            <dt>Updated at</dt>
            <dd>{{{ $payout->updated_at }}}</dd>
        </dl>
    </div>
</div>
@stop