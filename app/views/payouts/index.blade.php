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
                        <th>Amount</th>
                        <th>Fulfilled</th>
                        <th>Verified</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @foreach ($payouts as $payout)
                    <tr>
                        <td><a href="/payouts/{{{ $payout->id }}}">{{{ $payout->id }}}</a></td>
                        <td><a href="/characters/{{{ $payout->winner->id }}}">{{{ $payout->winner->name }}}</a></td>
                        <td>games</td>
                        <td>amount</td>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop