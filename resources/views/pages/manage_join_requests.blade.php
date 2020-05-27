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
            draw_sidebar_Top("Manage join requests", Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
            draw_sidebar_Profile($student->bio, 0, true);
        ?>
    <div id="content" class="col-12 col-lg-9">
        <section id="mainArea" class="col-12 col-lg-9">
            <section class="row">
                <table class="table" text-center table-hover>
                    <thead>
                        <tr>
                            <th scope="col">Curricular unit</th>
                            <th scope="col">Student name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reqs as $req) {?>
                            <tr>
                                <td scope="col"><?=$req->cu_abbrev?></td>
                                <td scope="col"><?=$req->student_name?></td>
                                <td scope="col">
                                    <div class="btn-group mx-2">
                                        <form action="{{ url('/acceptJoinRequest/' . $req->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <button id="manage_requests_button" class="btn btn-success mx-2" type="submit">
                                                Accept
                                            </button>
                                        </form>                        
                                        <form action="{{ url('/denyJoinRequest/' . $req->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <button id="manage_requests_button" class="btn btn-danger mx-2" type="submit">
                                                Deny
                                            </button>
                                        </form>  
                                    </div>                 
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </section>
        </section>
    </div>
</div>
@endsection