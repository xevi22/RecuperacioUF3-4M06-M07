@extends('layouts.app')

@section('content')
    @if(Auth::user())
        <valoracions>
        </valoracions>
    @endif
@endsection