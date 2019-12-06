<?php

namespace App\Http\Controllers;


use \App\Models\Article;
use \App\Http\Gateways\Contracts\ArticleGateway;
use \App\Http\Gateways\Contracts\ArticleGatewayException;

use Illuminate\Http\Request;


class ArticleController extends Controller
{
    protected $articleGateway;

    public function __construct(ArticleGateway $articleGatewayProvided) {
        $this->articleGateway = $articleGatewayProvided;
    }

    public function index(Request $request) {
        //Return the information for the view
        return view('pages.articles.index', [
            'articles' => auth()->user()->articles()->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function fetch(Request $request) {
        $capturedArticles = [];
        $duplicates = 0 ;

        $request->validate(['search' => 'required']);
 
        try { 
            $capturedArticles = $this->articleGateway->fetchArticles($request->search);
        } catch (ArticleGatewayException $exception) { 
            redirect()->back()->withErrors(['Something wrong happened while fetching the articles']);
        }

        //Saves the articles
        collect($capturedArticles)->each(function($article) use ( &$duplicates ) {

            //Prevent duplicates in the database
            if(!Article::where('title', $article->title)->count()){
                auth()->user()->articles()->save($article);
            } else {
                $duplicates++;
            }
        });

        //Load the user articles
        auth()->user()->load('articles');

        //Return the information for the view
        return view('pages.articles.index', [
            'articles' => auth()->user()->articles()->orderBy('created_at', 'desc')->get(),
            'capturedArticles' => $capturedArticles,
            'duplicates' => $duplicates,
            'search' => $request->search,
        ]);
    }

    public function remove($id) { 
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json($article, 200);
    }
}
