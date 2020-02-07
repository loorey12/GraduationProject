@extends('layout.mainlayout')
@section('content')
@if(session()->has('message'))
<script>
window.onload =function(){
  swal({
        title: "Message sent successfully",
        type: "success",
        showConfirmButton: false,
        showCancelButton: false,
        timer: 3000
    });
};
</script>
{{session()->forget('message')}}
@endif
<div id="light-div" class="main_section">
    <div class="container">
        <a href="/index"><p class="btn btn-outline-dark btn-sm float-right mt-3 ">BACK</p></a>
        <p class="text-dark pt-3  "><span class="btn btn-outline-dark btn-sm">HOME</span>  <span class="btn btn-outline-dark btn-sm">MOVIES</span>  <span class="btn btn-outline-dark btn-sm text-success">{{ strtoupper($play_data['title']) }}</span></p>
        @if($play_data['video_id']==null)
        <p class="text-danger">Sorry video file doesnot exist</p>
        @endif
        <div  style="position:relative" class="video-clip mt-3 ">
            <div  class="embed-responsive embed-responsive-16by9">
            <iframe id="video-play" class="advertisement mode" src="https://www.youtube.com/embed/{{ $play_data['video_id'] }} " frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="d-flex mt-2 px-2">
            <p class="font-weight-bold text-dark d-none d-md-block"><span class="text-primary"> WATCH </span>{{strtoupper($play_data['title'])}} <span class="btn btn-dark btn-sm text-light font-weight-bold">4K</span></p>
            @auth()
            <p id="like-box"><i id="like" class="fas fa-thumbs-up btn btn-outline-dark btn-sm ml-2 "> Like {{ $total_likes }}</i></p>
            @endauth
            @guest()
            <p onclick="signUpToLike()"><i class="fas fa-thumbs-up btn btn-outline-dark btn-sm ml-2 data-toggle="tooltip" data-placement="top" title="SignUp to like movies""> Like {{ $total_likes }}</i></p>
            <script>
            function signUpToLike(){
                swal({
                    title: "Please signup to Like",
                    type: "warning",
                    showConfirmButton: true,
                    showCancelButton: false,
                });
            }
            </script>
            @endguest

            @auth()
            <script>
                $('#like').click(function(event,index){
                $.ajax({
                url:'/like',
                type:'GET',
                data: {'movie_id':'{{ $play_data['id'] }}'},
                success: function(result) {
                    $('#like-box').empty();
                    $('#like-box').prepend('<i id="like" class="fas fa-thumbs-up btn btn-primary btn-sm ml-2 "> Like '+ result+'</i>');
                }});});
            </script>
            @endauth
            <p class=" font-weight-bold ml-2 "><span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fas fa-exclamation-triangle"></i> Report</span></p>
            <p id="nightbutton" class="ml-auto"><i class="fas fa-lightbulb text-dark"></i> <input data-size="sm" type="checkbox" checked data-toggle="toggle" data-onstyle="secondary" data-on="Dark" data-off="Dark "> </p>
        </div>

        @guest()
        <div id="ad-box-light" class="bg-secondary pb-3 px-2 text-light">
            <p id="ad-close-light" style="cursor:pointer" class="text-right"><i class="fas fa-times"></i></p>
            <p class="float-right">sponsored by kyushu</p>
            <p style="font-size:24px">You May like</p>
            <div class="row ">
                <div class="col-4">
                    <img src="{{'/images/learning.jpg'}}" alt="" width="100%" height="auto">
                    <p class=".text-truncate">忙しいママから大絶賛！CMでも話題の幼児向け通信教育がすごい！</p>
                </div>
                <div class="col-4">
                    <img src="{{'/images/learn.jpg'}}" alt="" width="100%" height="auto">
                    <p class=".text-truncate">“コーチング起業”はお金をかけずに起業でき、上がった売上はほぼ利益</p>
                </div>
                <div class="col-4">
                    <img src="{{'/images/climate.jpg'}}" alt="" width="100%" height="auto">
                    <p class=".text-truncate">However, it is a nut that will need to be cracked in order to meet 2050.</p>
                </div>
            </div>
        </div>

        <script>
            $("#ad-close-light").click(function() {
            swal({
            title: 'Are you sure you want to remove this ad?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                $("#ad-box-light").addClass( "d-none" );
                setTimeout( function(){ 
                    $("#ad-box-light").removeClass( "d-none" );               
                },6000);
            }
            })
            });
        </script>
        @endguest

        <h2 class="mt-3 text-dark text-center "><span class="font-weight-bold">{{ strtoupper($play_data['title']) }}</span></h2>
        <div class="row mt-2" >
            <div class="col-sm-6  col-xl-2 ">
                <img id="poster" class="thumbnail"  src="https://image.tmdb.org/t/p/w154{{ $play_data['poster'] }}">
            </div>
            <div class="col-sm-6 col-md-12 col-xl-7 text-secondary" >
                <p>{{ $play_data['discription'] }}</p>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="row">
                    <div class="col-7 col-md-7 col-xl-12 " >
                        <p class="text-secondary font-weight-bold "><span class="btn btn-outline-dark btn-sm "> Geners </span><span class="font-weight-bold ml-2">@foreach($play_data['genre'] as $key => $value){{ $value['name'] }} @endforeach</span></p>
                    </div>

                    <div class="col-5 col-md-5 col-xl-12"  >
                        <p class="text-secondary font-weight-bold"><span class="btn btn-outline-dark btn-sm">Release </span><span class="font-weight-bold ml-2">{{ date("Y", strtotime($play_data['id'])) }}</span></p>
                    </div>

                    <div class="col-7 col-md-7 col-xl-12" >
                        <p class="text-secondary font-weight-bold"><span class="btn btn-outline-dark btn-sm">IMDBId</span><span class="font-weight-bold ml-2">{{ $play_data['id'] }}</span></p>
                    </div>

                    <div class="col-5 col-md-5 col-xl-12" >
                        <p class="font-weight-bold">
                            <span class="btn btn-outline-dark btn-sm">Ratings</span>
                            <span class="fa fa-star checked text-warning d-none d-md-inline"></span>
                            <span class="fa fa-star checked text-warning d-none d-md-inline"></span>
                            <span class="fa fa-star checked text-warning d-none d-md-inline"></span>
                            <span class="fa fa-star d-none d-md-inline"></span>
                            <span class="fa fa-star d-none d-md-inline"></span>
                            <span class="font-weight-bold text-secondary ml-2">{{ $play_data['rating'] }}/10</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
         @if(count($similar_data)!=0)<div class="movie_category mx-4 d-flex justify-content-center"><h2 class="text-dark font-weight-bold">RANDOM MOVIES</h2></div>@endif
        <div id="scroll" class="row mt-3 px-4">
            @foreach($similar_data as $item)
            <div  class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
            </div>
            @endforeach
        </div>
</div>
</div>


<!-- Dark Mode -->
<div id="dark-div" class="main_section d-none" style="background:black">
    <div class="container">
            <p onclick="window.history.back()" class="btn btn-outline-light btn-sm float-right mt-3 ">BACK</p>
            <p class="text-light pt-3  "><span class="btn btn-outline-light btn-sm">HOME</span>  <span class="btn btn-outline-light btn-sm">MOVIES</span>  <span class="btn btn-outline-light btn-sm text-success">{{ strtoupper($play_data['title']) }}</span></p>
            @if($play_data['video_id']==null)
            <p class="text-danger">Sorry video file doesnot exist</p>
            @endif
        <div style="position:relative" class="video-clip mt-3">
            <div class="embed-responsive embed-responsive-16by9">
            <iframe  src="https://www.youtube.com/embed/{{ $play_data['video_id'] }} " frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="d-flex mt-2 px-2">
                <p class="font-weight-bold text-light d-none d-md-block"><span class="text-primary "> WATCH </span>{{strtoupper($play_data['title'])}} <span class="btn btn-primary btn-sm text-light font-weight-bold">4K</span></p>
            @auth()
            <p id="dark-like-box"><i id="dark-like" class="fas fa-thumbs-up btn btn-outline-light btn-sm ml-2 "> Like {{ $total_likes }}</i></p>
            @endauth
            @guest()
            <p onclick="signUpToLike()"><i class="fas fa-thumbs-up btn btn-outline-light btn-sm ml-2 data-toggle="tooltip" data-placement="top" title="SignUp to like movies""> Like {{ $total_likes }}</i></p>
            <script>
            function signUpToLike(){
            swal({
                    title: "Please signup to Like",
                    type: "warning",
                    showConfirmButton: true,
                    showCancelButton: false,
                });
            }
            </script>
            @endguest

            @auth()
            <script>
                $('#dark-like').click(function(event,index){
                $.ajax({
                url:'/like',
                type:'GET',
                data: {'movie_id': '{{ $play_data['id'] }}'},
                success: function(result) {
                    $('#dark-like-box').empty();
                    $('#dark-like-box').prepend('<i id="like" class="fas fa-thumbs-up btn btn-primary btn-sm ml-2 "> Like '+ result+'</i>');
                }});})
            </script>
            @endauth
                <p class=" font-weight-bold ml-2 "><span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fas fa-exclamation-triangle"></i> Report</span></p>
                <p id="daybutton" class="ml-auto "><i class="far fa-lightbulb text-warning"></i> <input data-size="sm" type="checkbox" checked data-toggle="toggle" data-onstyle="secondary" data-on=" Light " data-off="Light "> </p>
            </div>
        </div>
        @guest()
            <div id="ad-box-dark" class="bg-secondary pb-3 px-2 text-light ">
                <p id="ad-close-dark" style="cursor:pointer" class="text-right"><i class="fas fa-times"></i></p>
                <p class="float-right">sponsored by kyushu</p>
                <p style="font-size:24px">You May like</p>
                <div class="row ">
                    <div class="col-4">
                        <img src="{{'/images/learning.jpg'}}" alt="" width="100%" height="auto">
                        <p class=".text-truncate">忙しいママから大絶賛！CMでも話題の幼児向け通信教育がすごい！</p>
                    </div>
                    <div class="col-4">
                        <img src="{{'/images/learn.jpg'}}" alt="" width="100%" height="auto">
                        <p class=".text-truncate">“コーチング起業”はお金をかけずに起業でき、上がった売上はほぼ利益</p>
                    </div>
                    <div class="col-4">
                        <img src="{{'/images/climate.jpg'}}" alt="" width="100%" height="auto">
                        <p class=".text-truncate">However, it is a nut that will need to be cracked in order to meet 2050.</p>
                    </div>
                </div>
            </div>
            <script>
                $( "#ad-close-dark" ).click(function() {
                swal({
                title: 'Are you sure you want to remove this ad?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    swal(
                    'Removed!',
                    'ad has been deleted.',
                    'success'
                    )
                    $("#ad-box-dark").addClass( "d-none" );
                    setTimeout( function(){ 
                        $("#ad-box-dark").removeClass( "d-none" );               
                    },6000);
                }
                })
                });
            </script>
        @endguest

        <h2 class="mt-3 text-light text-center "><span class="font-weight-bold">{{ strtoupper($play_data['title']) }}</span></h2>
        <div class="row mt-2" >
            <div class="col-sm-6  col-xl-2 ">
                <img id="poster" class="thumbnail"  src="https://image.tmdb.org/t/p/w154{{ $play_data['poster'] }}">
            </div>
            <div class="col-sm-6 col-md-12 col-xl-7 text-light" >
                <p>{{ $play_data['discription'] }}</p>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="row">
                    <div class="col-7 col-md-7 col-xl-12 " >
                        <p class=" font-weight-bold "><span class="btn btn-outline-light btn-sm "> Geners </span><span class="text-light font-weight-bold ml-2">@foreach($play_data['genre'] as $key => $value){{ $value['name'] }} @endforeach</span></p>
                    </div>

                    <div class="col-5 col-md-5 col-xl-12"  >
                        <p class=" font-weight-bold"><span class="btn btn-outline-light btn-sm">Release </span><span class="text-light font-weight-bold ml-2">{{ date("Y", strtotime($play_data['id'])) }}</span></p>
                    </div>

                    <div class="col-7 col-md-7 col-xl-12" >
                        <p class=" font-weight-bold"><span class="btn btn-outline-light btn-sm">IMDBId</span><span class="text-light font-weight-bold ml-2">{{ $play_data['id'] }}</span></p>
                    </div>

                    <div class="col-5 col-md-5 col-xl-12" >
                        <p class="font-weight-bold">
                            <span class="btn btn-outline-light btn-sm ">Ratings</span>
                            <span class="fa fa-star checked text-warning d-none d-md-inline"></span>
                            <span class="fa fa-star checked text-warning d-none d-md-inline"></span>
                            <span class="fa fa-star checked text-warning d-none d-md-inline"></span>
                            <span class="fa fa-star text-light d-none d-md-inline"></span>
                            <span class="fa fa-star text-light d-none d-md-inline"></span>
                            <span class="font-weight-bold text-light ml-2">{{ $play_data['rating'] }}/10</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        @if(count($similar_data)!=0)<div class="movie_category mx-4 d-flex justify-content-center"><h2 class="text-light font-weight-bold ">RANDOM MOVIES</h2></div>@endif
        <div id="scroll" class="row mt-3 px-4">
            @foreach($similar_data as $item)
            <div  class="col-6 col-md-3 col-xl-2">
            <a href="/play/{{$item->id}}"><img class="display_img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"  width="100%" height="100%" ></a>
            </div>
            @endforeach
        </div>
</div>
</div>

<!-- Comment Section -->
<div id="comment-section" class="container">
    <div class="row bootstrap snippets mt-5">
        <div class="col-md-6 col-md-offset-2 col-sm-12">
            <div class="comment-wrapper">
                <div class="panel panel-info">
                    <div class="panel-heading text-secondary">
                        COMMENT SECTION
                    </div>
                    <div class="panel-body mt-2">
                        <form action="/comment" method="POST">
                            @csrf
                            <textarea class="form-control" name="comment" style="width:100%" placeholder="write a comment..." rows="5" required></textarea>
                            <input type="hidden" name="movie_id" value="{{$play_data['id']}}">
                            <br>
                            @auth()
                            <button  type="submit"  class="btn btn-info pull-right">Comment</button>
                            @endauth    
                            @guest()
                            <button type="button" onclick="signUpToCmnt()" class="btn btn-info pull-right">Post</button>
                            <script>
                            function signUpToCmnt(){
                            swal({
                                    title: "Please signup to Comment",
                                    type: "warning",
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                });
                            }
                            </script>
                            @endguest
                        </form>
                        <div class="clearfix"></div>
                        <hr>
                        <ul id="cmnt-box" class="media-list">
                        @if(isset($posts)&&count($posts)>0)
                        @foreach($posts as $post)
                            <li class="media">
                                <a href="#" class="pull-left mr-3">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                    </span>
                                    <strong class="text-success">{{ $post->name }}</strong>
                                    <p class="text-dark">{{$post->comment}}</p>
                                </div>
                            </li>
                        @endforeach
                        @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <p style="position:fixed; bottom:30px; right:5px;z-index:444;opacity:0.6" class="btn btn-dark" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">TOP <i class="fas fa-long-arrow-alt-up"></i></p>
    <p class="text-center  text-secondary mt-2 pb-4 mb-0 ">A wide section of online movies are available on <span class="text-success font-weight-bold">HQM</span> MOVIES. You can watch online movies for free without registeration.</p>
</div>
@endsection
