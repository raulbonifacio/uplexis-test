<?php 

namespace App\Http\Gateways;

use  App\Http\Gateways\Contracts\ArticleGateway;

class UpLexisArticleGateway implements ArticleGateway { 
    
    public function fetchArticles() { 

        $articles  = [];
        
        return $articles;
    }
}
