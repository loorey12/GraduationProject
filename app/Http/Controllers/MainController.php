<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Logic;
use App\User;
use App\Message;
use App\Comment;
use App\Like;
use App\LikedUser;
use Session;
use DB;
use Auth;

class MainController extends Controller
{

    public function main(){
        return view('main');
    }

    public function index(Request $request)
    { 
        $lang = $request->session()->get('lang', 'en-US');
        $logic = new Logic();
        $trending = $logic->query_tmdv('trending/movie/week','sort_by=vote_average.desc&page=1&language='.$lang)['results'];
        $popular = $logic->query_tmdv('discover/movie','primary_release_date.gte=2001-10-15&primary_release_date.lte=2017-12-20&sort_by=popularity.desc&page=1&language='.$lang)['results'];
        $upcoming = $logic->query_tmdv('movie/upcoming','sort_by=popularity&page=1&language='.$lang)['results'];
        $dramas = $logic->query_tmdv('discover/movie','with_genres=18&primary_release_year=2012&page=1&language='.$lang)['results'];
        $now_playing = $logic->query_tmdv('discover/movie','primary_release_date.gte=2019-07-15&primary_release_date.lte=2019-12-20&page=1&language='.$lang)['results'];
        if($request->genre){
            $genre_param = $request->input('genre');
            for($i=1; $i<5; $i++){
            $data[$i] = $logic->query_tmdv('discover/movie','with_genres='.$genre_param.'&page='.$i.'&language='.$lang)['results'];
            }
            $result = array_merge($data[1],$data[2],$data[3],$data[4]);
            $genre = $result;
            $genre_name = $request->input('name');
            $genre_data = $logic->data($genre,'genre_page','/index');
        }else{
            $genre_data = null;
            $genre_name = null;
        }


        $carousel_data = $logic ->data($trending,'carousel_page','index');
        $popular_data = $logic ->data($popular,'popular_page','index');
        $trending_data = $logic ->data($trending,'trending_page','index');
        $now_playing_data = $logic ->data($now_playing,'now_playing_page','index');
        $dramas_data = $logic ->data($dramas,'daramas_page','index');
        $upcoming_data = $logic ->data($upcoming,'upcoming_page','index');
        return view('index',
        compact('carousel_data','popular_data','trending_data','now_playing_data','dramas_data','genre_data','genre_name','upcoming_data','lang'));
    }


    public function play(Request $request, $movie_id){
        $lang = $request->session()->get('lang', 'en-US');
        $logic = new Logic();
        $id = $movie_id;
        $results_default = $logic->query_tmdv_id($id,'en-US');
        foreach($results_default as $result){
            if(!empty($results_default['videos']['results'])){
                $video = $results_default['videos']['results'][0]['key'];
            }else{
                $video=null;
            }
        }
        $results = $logic->query_tmdv_id($id, $lang);
        $play_data = [];
        foreach($results as $result){
            $play_data['poster'] = $results['poster_path'];
            $play_data['title'] = $results['title'];
            $play_data['years'] = $results['release_date'];
            $play_data['discription'] = $results['overview'];
            $play_data['background'] = $results['backdrop_path'];
            $play_data['rating'] = $results['vote_average'];
            $play_data['genre'] = $results['genres'];
            $play_data['id'] = $id;
        }
        $play_data['video_id'] = $video;
        $play_data['genre'] = array_slice($play_data['genre'],1,1);
        $similar = $logic->query_tmdv('movie/'.$play_data['id'].'/similar',null)['results'];
        $similar_lists = $logic->check_get_data($similar);
        $similar_data = $logic->filter_data($similar_lists ,'similar_page','play');
        // dd($similar_data);
        $posts = Comment::where('movie_id',$movie_id)->get();
        $total_likes = DB::table('likes')->where('movie_id',$movie_id)->value('count');
        return view('play')->with('play_data',$play_data)->with('similar_data',$similar_data)->with('id',$play_data['id'])->with('posts',$posts)->with('total_likes',$total_likes)->with('lang',$lang);


    }

    public function search(Request $request){
        $lang = $request->session()->get('lang', 'en-US');
        $logic = new Logic();
        $param = $request->search;
        $search = $logic->query_tmdv('search/movie','query="'.$param.'"')['results'];
        $search_lists = $logic->check_get_data($search);
        $search_data = $logic->filter_data($search_lists,'search_page','search');
        $null = 'Please Input movie or drama name';
        $noresults = 'SORRY !! No match Found in Database';
        if(!$param)
        {
            return view('errors/errors')->withNull($null);
            exit;
        }
        if(!$search_data->total())
        {   return view('errors/errors')->withNoresults($noresults);
            exit;
        }
        return view('search',compact('search_data','null','noresults','param'));
    }

    public function message(Request $request){
       $messages = new Message();
       $messages->subject = $request->subject;
       $messages->message = $request->message;
       $messages->save();
       Session::put('message','sent');
       return back();
    }
    public function comment(Request $request){
            $movie_id = $request->movie_id;
            $comments = new Comment();
            $name = Auth::user()->name;
            $comments->name = $name;
            $comments->comment = $request->comment;
            $comments->movie_id = $movie_id;
            $comments->save();
            Session::put('comment','message');
            // $comments = Comment::where('movie_id',$movie_id)->get();
            return redirect()->back();
    }
 
    public function like(Request $request){
        $movie_id = $request->movie_id;
        $likes_data = DB::table('likes')->where('movie_id',$movie_id)->first();
        $liked = LikedUser::where('user_name',Auth::user()->name)->where('movie_id',$movie_id)->first();
        $likes_now = DB::table('likes')->where('movie_id',$movie_id)->value('count');

        if($liked){
            return $likes_now;
        }

        if (is_null($likes_data)) {
            $likes = new Like();
            $likedUser = new LikedUser();
            $likes->movie_id = $movie_id;
            $likes->count = 1;
            $likedUser->user_name = Auth::user()->name;
            $likedUser->movie_id = $movie_id;
            $likes->save();
            $likedUser->save();
        }else{
        DB::table('likes')->where('movie_id', $movie_id)->update(['count' => DB::raw('count+1')]);    
        }
        $total_likes = DB::table('likes')->where('movie_id',$movie_id)->value('count');
        Session::put('like','message');
       return $total_likes;
    }

    public function myMovie(Request $request){
        $lang = $request->session()->get('lang', 'en-US');
        $logic = new Logic();
        $my_movie_ids = DB::table('liked_users')->where('user_name',Auth::user()->name)->get();
        foreach($my_movie_ids as $list){
            $my_movie_list[] = $list->movie_id;
        }
        foreach($my_movie_list as $data){
            $liked_list[] = $logic->query_tmdv_id($data,$lang);
        }

        return view('mymovielist')->with('liked_list',$liked_list)->with('lang',$lang);
    }
    public function language($lang){
        Session::put('lang',$lang);
        return redirect()->back();
    }
}