@extends('layouts.app')

@section('content')
    @if(Auth::user())
        <reserves>
        </reserves>
    @endif

@endsection