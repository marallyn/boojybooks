@extends('layouts.app')

@section('content')
<div class="col-12 col-md-9 col-lg-7 col-xl-6">
    <div class="card">
        <h3 class="card-header bg-info">
            Welcome to {{ config('app.name') }}
        </h3>

        <div class="card-body">

            @include('inc.status')

            <p class="card-text">
                Do you know how to read? Do you like books? Do you like making lists? Well then, you have come to the right place! On this site you can search for books, create a list, sort the list, add more books, remove books, and maybe more incredible actions.
            </p>

            <p class="card-text">
                If you would like to read about how I completed the project and why I made the choices I made, here is the project
                <a href="{{ route('readme') }}" class="">
                    README.
                </a>
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
            <a href="{{ route('readme') }}" class="btn btn-primary">
                Project README
            </a>
        </div>
    </div>
</div>
@endsection
