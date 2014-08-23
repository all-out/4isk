@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Deposits</h2>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>RefID</th>
                        <th>Depositor</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Sent at</th>
                        <th>Imported at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                @foreach ($deposits as $deposit)
                        <tr>
                            <td>{{{ $deposit->id }}}</td>
                            <td>{{{ $deposit->ref_id }}}</td>
                            <td><a href="/characters/{{{ $deposit->depositor->id }}}">{{{ $deposit->depositor->name }}}</a></td>
                            <td>{{{ $deposit->amount }}}</td>
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