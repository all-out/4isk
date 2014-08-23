@extends('layouts.master')

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>RefID</th>
                    <th>Amount</th>
                    <th>Reason</th>
                    <th>Sent At</th>
                    <th>Imported At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-hover">
            @foreach ($deposits as $deposit)
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
@stop