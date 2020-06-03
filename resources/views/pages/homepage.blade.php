@extends('layouts.app')
@section('title', 'Homepage')
@section('content')

<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">

@include('partials.navbar')
@include('partials.sidebar')

<div class="container-fluid">
	<div id="homepage" class="row justify-content-md-center">

		<?php

		use Illuminate\Support\Facades\Auth;

		draw_sidebar_Top("Home", Auth::user()->id, Auth::user()->name, Auth::user()->student_number);
		?>

		<section id="MyCUs">
			<h4 class="text-center">My CU's</h4>
			<ul>
				@each('partials.cu_list', $cus, 'cu')
			</ul>
		</section>
		</aside>

		<main id="mainArea" class="col-12 col-lg-6">
			<div>
				@include('partials.publish_card', ['where'=>"public"])
			</div>
			<!-- <hr id="post-division"> -->

			<section id="posts">
				@include('partials.post')
			</section>
			<section id="pages">
				{{ $posts->links() }}
			</section>
		</main>

		<section class="col-3">
		</section>
	</div>
</div>

@endsection