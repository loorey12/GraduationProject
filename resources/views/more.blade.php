@extends('layout.mainlayout')
@section('content')

<div class="main_section">
@if(isset($popular_data))
    <div class="movie_category pt-3 px-4">
        <p class="btn btn-outline-dark btn-sm">{{$name}}</p>
        <a href="/index"><p class="btn btn-outline-dark btn-sm float-right ">BACK</p></a>
    </div>
    <div class="d-flex justify-content-center">{{$popular_data->links()}}</div>
    <div id="popular" class="row px-4">
        @foreach($popular_data as $item)
        @if(!empty($item->poster_path))
            <div  class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
            </div>
        @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">{{$popular_data->links()}}</div>

@elseif(isset($trending_data))
    <div class="movie_category pt-3 px-4">
        <p class="btn btn-outline-dark btn-sm">{{ $name }}</p>
        <a href="/index"><p class="btn btn-outline-dark btn-sm float-right mt-3 ">BACK</p></a>
    </div>
    <div class="d-flex justify-content-center">{{$trending_data->links()}}</div>
    <div id="popular" class="row px-4 ">
        @foreach($trending_data as $item)
        @if(!empty($item->poster_path))
            <div  class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
            </div>
        @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">{{$trending_data->links()}}</div>

@elseif(isset($now_playing_data))
    <div class=" movie_category pt-3 px-4">
        <p class="btn btn-outline-dark btn-sm">{{ $name }}</p>
        <a href="/index"><p class="btn btn-outline-dark btn-sm float-right mt-3 ">BACK</p></a>
    </div>
    <div class="d-flex justify-content-center">{{$now_playing_data->links()}}</div>
    <div id="popular" class="row px-4">
        @foreach($now_playing_data as $item)
        @if(!empty($item->poster_path))
            <div  class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
            </div>
        @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">{{$now_playing_data->links()}}</div>

@elseif(isset($upcoming_data))
    <div class=" movie_category pt-3 px-4">
        <p class="btn btn-outline-dark btn-sm">{{ $name }}</p>
        <a href="/index"><p class="btn btn-outline-dark btn-sm float-right mt-3 ">BACK</p></a>
    </div>
    <div class="d-flex justify-content-center">{{$upcoming_data->links()}}</div>
    <div id="popular" class="row px-4">
        @foreach($upcoming_data as $item)
        @if(!empty($item->poster_path))
            <div  class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
            </div>
        @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">{{$upcoming_data->links()}}</div>
@elseif(isset($dramas_data))
    <div class="movie_category pt-3 px-4">
        <p class="btn btn-outline-dark btn-sm">{{ $name }}</p>
        <a href="/index"><p class="btn btn-outline-dark btn-sm float-right mt-3 ">BACK</p></a>
    </div>
    <div class="d-flex justify-content-center">{{$dramas_data->links()}}</div>
    <div id="popular" class="row px-4">
        @foreach($dramas_data as $item)
        @if(!empty($item->poster_path))
            <div  class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
            </div>
        @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">{{$dramas_data->links()}}</div>

@endif

    <p class="toggle-text text-center text-dark mb-0 mt-4 pb-3">A wide section of online movies are available on <span class="text-success font-weight-bold">HQM</span> MOVIES. You can watch online movies for free without registeration.</p>
</div>
@endsection
