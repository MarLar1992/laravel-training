<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    // public function index()
    // {
    //     return "Controller - Article List";
    // }

    public function index()
    {
        // $data = Article::all();
        $data = Article::latest()->paginate(5);
        return view('index', ['articles' => $data]);
        // $data = [["id" => 1, "title" => "First Article"], ["id" => 2, "title" => "Second Article"],];
        // return view('index', ['articles' => $data]);
    }


    public function detail($id)
    {
        $data = Article::find($id);
        return view('articles.detail', ['article' => $data]);

        // return "Controller - Article Detail - $id";
    }

    public function dashboard()
    {
        return view('dashboards.dashboard');
    }

    public function add()
    {
        $data = [["id" => 1, "name" => "News"], ["id" => 2,     "name" => "Tech"],];
        return view('articles.add', ['categories' => $data]);
    }

    public function create()
    {
        $validator = validator(
            request()->all(),
            [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();
        return redirect('/articles')->with('info', 'Article added');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles')->with('info', 'Article deleted');
    }
}
