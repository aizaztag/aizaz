@extends('master.layout')

@section('title', 'Page Title')

@section('sidebar')
    @parent


    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>

    @alert
    @slot('class')
    danger
    @endslot
    @slot('title')
    Success sdsd
    @endslot
    This is a success message, just for testing purpose.
    @endalert


@endsection