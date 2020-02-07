@extends('layout.mainlayout')
@section('content')
        {{-- Liked movies list --}}
<div class="main_section">
    <div class="movie_category pt-3 px-4">
        <p class="btn btn-outline-dark btn-sm">My Movie</p>
        <a href="/index"><p class="btn btn-outline-dark btn-sm float-right ">BACK</p></a>
    </div>
        <div class="row">
        @foreach($liked_list as $item)
            <div class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item['id']}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item['poster_path']}}"  width="100%" height="100%" ></a>
            </div>
        @endforeach

        </div>
    <p class="toggle-text text-center text-dark mb-0 mt-4 pb-3">A wide section of online movies are available on <span class="text-success font-weight-bold">HQM</span> MOVIES. You can watch online movies for free without registeration.</p>
</div>
@endsection
