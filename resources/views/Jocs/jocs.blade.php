@extends('layouts.app')

@section('content')
    @if(Auth::user()&& Auth::user()->isAdmin)
        <jocs>
        </jocs>
    @elseif(Auth::user() && !Auth::user()->isAdmin)
        <jocs-users>
        </jocs-users>
    @else

    @endif

@endsection