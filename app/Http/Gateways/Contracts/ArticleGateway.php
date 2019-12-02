<?php

namespace App\Http\Gateways\Contracts;

/**
 * A gateway to an external source of articles
 */

 interface ArticleGateway {

    /**
     * Fetches a list of external articles
     * 
     * 
     * @return App\Models\Article
     */
    public function fetchArticles();
}