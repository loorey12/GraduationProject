<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

class ViewDataComposer{
    public function compose(View $view){
        // variable declaring for genre
        $genres = ['Action' => 28, 'Adventure' => 12, 'Animation' => 16, 'Biography' => 99,'Comedy' => 35, 'Crime' => 80, 'Drama' => 18, 'Family' => 10751, 'Fantasy' => 14, 'History' => 36, 'Horror' => 27, 'Music' => 10749, 'Mystery' => 9648, 'Romance' => 10770, 'Sci-Fi' => 878, 'war' => 10749, 'Thriller' => 53];
        $genres = array_flip($genres);
        $language =['Japanese' => 'ja-JP','Nepali'=>'na-NP','Chinese' => 'zh-CN','English' => 'en-US','Korean' => 'ko-KR','Vietnamese' => 'vi-VN','French' => 'fr-FR','Hindi'=>'hi-IN'];
        $view->with('genres',$genres)->with('language',$language);

    }
}