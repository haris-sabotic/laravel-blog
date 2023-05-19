@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="masthead" style="background-image: url('/assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Laravel Blog</h1>
                        <span class="subheading">REGISTER</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <form action="{{ route('register.perform') }}" method="POST" class="login-content">
        @csrf

        <label for="name">Name</label>
        <input type="test" name="name" id="name">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <label for="password_confirmation">Confirm password</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        <div class="butt">
            <button type="submit">OK</button>
        </div>
    </form>
@endsection
