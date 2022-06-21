@extends('layouts.app')

@section('content')

    @if(Auth::user()&& Auth::user()->isAdmin)
    <users>
    </users>
    @elseif(Auth::user() && !Auth::user()->isAdmin)
        <jocs-users>
        </jocs-users>
    @endif
@endsection