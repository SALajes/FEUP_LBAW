<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<script src={{ asset('js/requestCU.js') }} defer></script>

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('title', 'Request CU')

@section('content')



<div class="container-fuild">
    <div class="row">
       <?php
            $bc = "Request CU";
            draw_sidebar_Top($bc, Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
        ?>
		<section id="MyCUs" >
            <h4 class="text-center">My CU's</h4>
                <ul>
                    @each('partials.cu_list', $cus, 'cu')
                </ul>
        </section>
        </aside>
		<main id="mainArea" class="col-12 col-lg-6">
			<form action="" method="POST">
				<input name="student_id" id="student_id" type="hidden" value="{{ Auth::user() -> id }}" readonly>
				<div class="form-group">
					<label for="cu_name">CU name:</label>
    				<input type="text" class="form-control" id="cu_name" name="cu_name" placeholder="Bases de Dados">
				</div>

				<div class="form-group">
					<label for="cu_abbrev">CU abbreviation:</label>
    				<input type="text" class="form-control" id="cu_name" name="cu_name" placeholder="BDAD">
				</div>

				<div class="form-group">
					<label for="cu_page">Link to page with CU info:</label>
    				<input type="text" class="form-control" id="cu_page" name="cu_page">
				</div>

				<div class="form-group">
    				<label for="additional_info">Additional Info</label>
    				<textarea class="form-control" id="additional_info" name="additional_info" rows="3"></textarea>
  				</div>

				  <button type="submit" class="btn btn-primary" disabled>Submit</button>
			</form>
        </main>
    </div>
</div>

@endsection