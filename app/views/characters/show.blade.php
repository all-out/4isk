@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
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
            <dd>{{{ $character->balance }}} isk</dd>
            <dt>Active?</dt>
            <dd>{{{ $character->active }}}</dd>
            <dt>Created at</dt>
            <dd>{{{ $character->created_at }}}</dd>
            <dt>Updated at</dt>
            <dd>{{{ $character->updated_at }}}</dd>
        </dl>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h3>Deposits</h3>

        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>id</th>
                    <th>RefID</th>
                    <th>Amount</th>
                    <th>Reason</th>
                    <th>Sent at</th>
                    <th>Imported at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="table-hover">
                @foreach ($character->deposits as $deposit)
                <tr>
                    <td>{{{ $deposit->id }}}</td>
                    <td>{{{ $deposit->ref_id }}}</td>
                    <td>{{{ $deposit->amount }}} isk</td>
                    <td>{{{ $deposit->reason }}}</td>
                    <td>{{{ $deposit->sent_at }}}</td>
                    <td>{{{ $deposit->created_at }}}</td>
                    <td>
                        <a href="/deposits/{{{ $deposit->id }}}" class="btn btn-default">View</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop