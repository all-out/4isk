@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Payout</h2>
        <dl class="dl-horizontal">
            <dt>id</dt>
            <dd>{{{ $payout->id }}}</dd>
            <dt>Winner</dt>
            <dd>
                <a href="/characters/{{{ $payout->winner->id }}}">{{{ $payout->winner->name }}}</a>
            </dd>
            <dt>Related Games</dt>
            <dd>games</dd>
            <dt>Amount</dt>
            <dd>amount</dd>
            <dt>Fulfilled</dt>
            <dd>
                @if($payout->fulfilled)
                <i class="glyphicon glyphicon-ok-sign" style="color: green;"></i> <a href="/characters/{{{ $payout->fulfiller->id }}}">{{{ $payout->fulfiller->name }}}</a>
                @else
                <a href="#" class="btn btn-default">Fulfill</a>
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