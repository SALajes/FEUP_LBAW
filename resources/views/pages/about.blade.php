@extends('layouts.app') 
@section('title', 'Landing') 
@section('content')

<link rel="stylesheet" href="{{ asset('css/landing.css') }}"/>

<body>
    <header class="background-gradient-blue">
        <section class="masthead mb-auto pt-3 d-flex pr-5 justify-content-end">
            <div class="inner">
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active text-white" href="{{ url('/') }}">Home</a>
                    <a class="nav-link text-white" href="{{ url('/about') }}">About</a>
                </nav>
            </div>
        </section>
        <section class="position-relative overflow-hidden p-3 p-md-3 text-center text-white">
            <div class="col-md-3 p-lg-3 mx-auto my-3">
                <h1 class="font-weight-normal">About us</h1>
            </div>
        </section>
    </header>
    <main class="container marketing mt-5" style="padding:2rem;">
        <section class="row featurette">
            <blockquote>
                <h2 class="featurette-heading">
                    We are just like you.
                    <span class="text-info">University students.</span>
                </h2>
                <p class="lead">
                    Four friends at FEUP came together to design a tool that lets you and your pals 
                    discover and create. We have dreams, like you. 
                </p>
            </blockquote>
        </section>
        <section class="row featurette">
            <blockquote>
                <h2 class="featurette-heading">
                    <span class="text-info">FEUP.</span>
                    LBAW.
                </h2>
                <p class="lead">
                    This project was developed in the context of the Laboratory of Databases and 
                    Web Applications (LBAW) at the Faculty of Engineering of the University of Porto (FEUP).
                </p>
            </blockquote>
        </section>
    </main>
    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-3">
            <img class="rounded-circle" src="{{ asset('images/cadu.jpg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>Carlos "Cadu" Duarte</h2>
            <p>Ouço Nickleback e digo que é irónico para não gozarem comigo...</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="{{ asset('images/pedro.jpg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>Pedro "Maria do Carmo" Pereira</h2>
            <p>Presidente do BDC.</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="{{ asset('images/simão.jpg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>Simão "Simon" Oliveira</h2>
            <p>Gosta de lamber maçanetas, a situação do Corona obrigou-o a tomar decisões muito difíceis.</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="{{ asset('images/sofia.jpeg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>Sofia "SoFacho" Lajes</h2>
            <p>Chamei ao meu gato Mickey e ele teve uma crise de identidade quando descobriu a inspiração do seu nome, agora é vegan.</p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div>
</body>
@endsection

@include('partials.footer')