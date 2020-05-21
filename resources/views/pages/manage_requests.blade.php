<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <?php
            use Illuminate\Support\Facades\Auth;
            draw_sidebar_Top($cu->abbrev, Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
            draw_sidebar_CU($cu->id);
        ?>
    <div id="content" class="col-12 col-lg-9">
        <section id="mainArea" class="col-12 col-lg-9">
            <section class="row">
                <table class="table" text-center table-hover>
                    <thead>
                        <tr>
                            <th scope="col">Curricular Unit</th>
                            <th scope="col">Name</th>
                            <th scope="col">Accept/Denie</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </section>
        </section>
    </div>
</div>
@endsection