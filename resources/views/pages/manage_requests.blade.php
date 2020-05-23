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
            draw_sidebar_Top("Manage requests", Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
            draw_sidebar_Profile($student->bio, 0, true);
        ?>
    <div id="content" class="col-12 col-lg-9">
        <section id="mainArea" class="col-12 col-lg-9">
            <section class="row">
                <table class="table" text-center table-hover>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Abbrev</th>
                            <th scope="col">Web page</th>
                            <th scope="col">Info</th>
                            <th scope="col">Student</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reqs as $req) {?>
                            <tr>
                                <td scope="col"><?=$req->cu_name?></td>
                                <td scope="col"><?=$req->abbrev?></td>
                                <td scope="col"><?=$req->link_to_cu_page?></td>
                                <td scope="col"><?=$req->additional_info?></td>
                                <td scope="col"><?=$req->student_id?></td>
                                <td scope="col"><?=$req->request_status?></td>
                                <td scope="col">
                                    <a href="{{ url('/manageRequests/') }}">
                                        <button id="manage_requests_button" class="btn btn-success" type="button">
                                            Accept 
                                        </button>
                                    </a>                        
                                </td>
                                <td scope="col">
                                    <a href="{{ url('/manageRequests/') }}">
                                        <button id="manage_requests_button" class="btn btn-danger" type="button">
                                            Denie 
                                        </button>
                                    </a>                        
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