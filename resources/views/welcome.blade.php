@extends('layouts.app')

@section('content')
<div class="col-12 col-md-8 col-lg-6 col-xl-5">
    <div class="card">
        <h3 class="card-header bg-info">
            Welcome to {{ config('app.name') }}
        </h3>

        <div class="card-body">

            @include('inc.status')

            <p class="card-text">
                If you like books, you have come to the right place! On this site you can search for books, create a list, sort the list, add more books, remove books, and maybe more incredible actions.
            </p>

            <p class="card-text">
                Enough small talk, let's get started.
            </p>
        </div>

        <div class="card-footer">
            <a href="{{ route('login') }}" class="btn btn-primary">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary">
                Register
            </a>
        </div>
    </div>
</div>
@endsection
