<?php

namespace App\Http\Controllers\panel;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    /**
     * Display a listing of the Articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.articles', [
            'articles' => Article::latest()->paginate(20),
            'page_name' => 'blog',
            'page_title' => 'مقالات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        return view('panel.add-article', [
            'page_name' => 'add_blog',
            'page_title' => 'افزودن مقاله جدید',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $article = auth()->user()->articles()->create([
        	"title"=>request()->title,
        	"description"=>request()->description,
        	"body"=>request()->body,
            'image' => $this->upload_image( Input::file('image'))
        ]);
        
        return redirect()->action(
            'panel\ArticleController@edit', ['article' => $article->id]
        )->with('message', "مقاله {request()->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified Article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     * 
     * public function show(Article $article)
     * {
     *    return $article;
     * }
     */

    /**
     * Show the form for editing the specified Article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('panel.add-article', [
            'article' => $article,
            'page_name' => 'add_blog',
            'page_title' => 'افزودن مقاله جدید',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update( Article $article)
    {
        if (request()->hasFile('image'))
        {
            $image = $this->upload_image( Input::file('image') );
            
            if ( file_exists( public_path($article->image) ) )
                unlink( public_path($article->image) );
        }
        else
        {
            $image = $article->image;
        }

        $article->update(array_merge(request() -> all(), [ 'image' => $image ]));
        return redirect()->back()->with('message', "مقاله {$article->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->back()->with('message', "مقاله {$article->title} با موفقیت حذف شد");
    }
    
    /**
     * Show the filtered articles from storage.
     *
     * @param  String  $query
     * @return \Illuminate\Http\Response
     */
    public function search ($query = '')
    {
        return view('panel.articles', [
            'articles' => Article::latest()->where('title', 'like', "%$query%")->paginate(20),
            'page_name' => 'blog',
            'page_title' => 'مقالات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }
}
