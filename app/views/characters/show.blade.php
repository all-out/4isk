@extends('layouts.master')

@section('content')
    Deposits: {{ count($character->deposits) }}
    <pre>{{ print_r($character) }}</pre>
@stop