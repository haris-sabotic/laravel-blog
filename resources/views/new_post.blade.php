@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="masthead" style="background-image: url('/assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Laravel Blog</h1>
                        <span class="subheading">NEW POST</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <form class="new-post" method="POST" action="{{ route('new_post.perform') }}">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title">

        <label for="description">Description</label>
        <input type="text" name="description" id="description">

        <button type="submit">POST</button>

        <x-forms.tinymce-editor />
    </form>
@endsection
