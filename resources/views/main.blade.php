
@extends('layout.mainlayout')

@section('content')
<div class="content" style="background:#17202A">
    <div class="center">
        <h1 id="main-heading" style="font-weight:bold" class="text-center text-light display-3 mt-5"><span class="text-danger">HQM</span>MOVIES</h1>
        <p class="text-light text-center mt-2">Like and share our website to support us</p>
        <div class="social d-flex justify-content-center">
            <div id="facebook" class="social-link text-center px-2"><i class="fab fa-facebook-square"></i> </<i></div>
            <div id="twitter" class="social-link text-center ml-2 px-2"><i class="fab fa-twitter-square"></i> </<i></div>
            <div id="instagram" class="social-link text-center ml-2 px-2"><i class="fab fa-instagram"></i> </<i></div>
        </div>
        <form method="GET" action="/search">
            <div class="d-flex justify-content-center mt-4">
                <input type="text" class="index-input form-control text-center" name="search" placeholder="Search for Movies and Dramas">
            </div>
            <p class="text-center  mt-4"><button style="padding:5px 20px" type="submit" class="btn btn-primary text-light">SEARCH</button></p>
            <p class="text-center text-light mt-3">
                HQM- Just a better place to watch free movies. ENJOY!!
            </p>
            <p class="text-center text-info">Connect with us on twiter <i class="fab fa-twitter-square" ></i> </p>
            <div class="text-center mt-2">
            <button class="btn btn-success"><a class="nav-link text-light" href="./index">GO TO HOMEPAGE</a></button>
            </div>
        </form>
        <div class="d-flex justify-content-center mt-5" >
            <p style="font-size:14px" class="btn btn-secondary mr-2 py-1">Download <i class="fab fa-app-store-ios  ml-1 "></i></p>
            <p style="font-size:14px" class="btn btn-secondary ml-2 py-1">Download <i class="fab fa-google-play  ml-1"></i></p>
        </div>
    </div>
</div>
@endsection()
