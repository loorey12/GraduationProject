@extends('layout.mainlayout')
@section('content')

    <div class="content" style="background:#17202A">
        <div class="center">
            <h1 style="font-weight:bold" class="text-center text-light"><span class="text-danger">HQM</span>MOVIES</h1>
            <p class="text-light text-center mt-2">Like and share our website to support us</p>
            <div class="social d-flex justify-content-center">
                <div id="facebook" class="social-link text-center px-2"><i class="fab fa-facebook-square"></i> </<i></div>
                <div id="twitter" class="social-link text-center ml-2 px-2"><i class="fab fa-twitter-square"></i> </<i></div>
                <div id="instagram" class="social-link text-center ml-2 px-2"><i class="fab fa-instagram"></i> </<i></div>
            </div>
                <div class="d-flex justify-content-center mt-3">
                    <h1 id="error-msg" class="text-center text-secondary">
                        @if(isset($null))
                        {{$null}}
                        @endif
                        @if(isset($noresults))
                        {{$noresults}}
                        @endif
                    </h1>
                </div>
                <p  class="text-center text-light mt-2">
                    HQMOVIES- Just a better place to watch free movies. ENJOY!!
                </p>
                <p class="text-center text-primary">Connect with us on twiter <i class="fab fa-twitter-square"></i> </p>
                <div class="text-center mt-2">
                <button class="btn btn-outline-success"><a class="nav-link text-light" href="../index">GO TO HOMEPAGE</a></button>
                </div>
        </div>

    </div>
@endsection
