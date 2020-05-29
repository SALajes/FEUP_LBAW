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
            draw_sidebar_Profile($student->bio, $likeCounter, true);
        ?>
    <div id="content" class="col-12 col-lg-9">
        <section id="mainArea" class="col-12 col-lg-9">
            <section class="row">
                <table class="table" text-center table-hover>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Abbrev</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reqs as $req) {?>
                            <tr>
                                <td scope="col"><?=$req->cu_name?></td>
                                <td scope="col"><?=$req->abbrev?></td>
                                <td scope="col">
                                <div class="d-flex btn-toolbar">            
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#details_modal_<?=$req->id?>">
                                        Details
                                    </button> 
                                </div>  
                                    <div class="modal fade" id="details_modal_<?=$req->id?>" tabindex="-1" role="dialog" aria-labelledby="details_modal_<?=$req->id?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body" style="word-wrap: break-word;">
                                              <p class="font-weight-bold">Name</p>
                                              <p><?=$req->cu_name?></p>
                                              <p class="font-weight-bold">Abbreviature</p>
                                              <p><?=$req->abbrev?></p>
                                              <p class="font-weight-bold">Institutional page</p>
                                              <p><?=$req->link_to_cu_page?></p>
                                              <p class="font-weight-bold">Description</p>
                                              <p><?=$req->additional_info?></p>
                                              <p class="font-weight-bold">Requested by</p>
                                              <p><?=$req->student_name?></p>
                                            </div>
                                            <div class="btn-group mx-2">
                                                <form action="{{ url('/acceptCreateRequest/' . $req->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <button id="manage_requests_button" class="btn btn-success mx-2" type="submit">
                                                        Accept
                                                    </button>
                                                </form>                        
                                                <form action="{{ url('/denyCreateRequest/' . $req->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <button id="manage_requests_button" class="btn btn-danger mx-2" type="submit">
                                                        Deny
                                                    </button>
                                                </form>  
                                            </div>          
                                          </div>
                                        </div>
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