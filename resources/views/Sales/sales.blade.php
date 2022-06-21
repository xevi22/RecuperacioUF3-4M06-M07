@extends('layouts.app')

@section('content')
    @if(Auth::user()&& Auth::user()->isAdmin)
        <sales>
        </sales>
    @else
        <jocs-users>
        </jocs-users>
    @endif
@endsection