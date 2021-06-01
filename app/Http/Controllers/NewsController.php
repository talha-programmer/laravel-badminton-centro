<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', [
            'news' => $news
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'details' => 'required',
        ]);


        // For updates, get the News object through news id
        $newsId = $request->news_id;

        $news = null;
        if($newsId){
            $news = News::find($newsId);
        }else{
            $news = new News();
        }

        $news->title = $request->title;
        $news->details = $request->details;

        $news->save();

        return back()->with('info', 'News saved successfully!');


    }

    public function destroy(News $news)
    {
        $news->delete();
        return back()->with('info', 'News deleted successfully!');
    }

}
