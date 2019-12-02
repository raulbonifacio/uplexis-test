<?php

namespace App\Http\Controllers;

use \App\Http\Gateways\Contracts\ArticleGateway;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleGateway;

    public function __construct(ArticleGateway $articleGatewayProvided) {
        $this->articleGateway = $articleGatewayProvided;
    }

    public function index(ArticleGateway $articleGatewayProvided) {

        $articles = $this->articleGateway->fetchArticles();

        
        return "something";
    }
}
