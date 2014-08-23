@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Deposit</h2>
        <dl class="dl-horizontal">
            <dt>id</dt>
            <dd>{{{ $deposit->id }}}</dd>
            <dt>ref_id</dt>
            <dd>{{{ $deposit->ref_id }}}</dd>
            <dt>Depositor</dt>
            <dd>
                <a href="/characters/{{{ $deposit->depositor->id }}}">
                    <img src="https://image.eveonline.com/Character/{{ $deposit->depositor->id }}_32.jpg" class="pull-left" width="24" height="24" />
                    {{{ $deposit->depositor->name }}}
                </a>
            </dd>
            <dt>Amount</dt>
            <dd>{{{ $deposit->amount }}}</dd>
            <dt>Reason</dt>
            <dd>{{{ $deposit->reason }}}</dd>
            <dt>Sent at</dt>
            <dd>{{{ $deposit->sent_at }}}</dd>
            <dt>Imported at</dt>
            <dd>{{{ $deposit->created_at }}}</dd>
        </dl>
    </div>
</div>
@stop