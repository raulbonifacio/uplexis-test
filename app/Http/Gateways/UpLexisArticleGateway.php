<?php 

namespace App\Http\Gateways;

use \App\Http\Gateways\Contracts\ArticleGateway;
use \App\Http\Gateways\Contracts\ArticleGatewayException;
use \GuzzleHttp\Client;
use \App\Models\Article;

class UpLexisArticleGateway implements ArticleGateway { 
    
    const URL = 'https://www.uplexis.com.br/blog';
    const TARGETED_DOM_ELEMENT = '';
    
    protected $client;

    public function __construct(Client $clientProvided) {
        $this->client = $clientProvided;
    }

    public function fetchArticles($searchParams) {
        
        //To store the articles
        $articles = [];

        //Get the response from the upLexis website blog
        $response = $this->client->get(self::URL, [
            'query' => [
                's' => $searchParams
            ]
        ]);

        //If the request was sucessful
        if($response->getStatusCode() == '200') {
            
            //Suppress the errors from libxml
            libxml_use_internal_errors(true);

            //Converte the html
            $html = $response->getBody()->getContents();
            $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
            $html = preg_replace('/\s\s+/', ' ', $html);
            $html = trim($html);

            //Parse the document
            $document = new \DOMDocument();
            $document->preserveWhiteSpace = false;
            $document->loadHTML($html);

            //Get the links and titles from the posts
            foreach($document->getElementsByTagName('div') as $div) { 

                //If its a post
                if(strpos($div->getAttribute('class') ,'post') != false) {
                    
                    //Get the title and link
                    $title = trim($div->getElementsByTagName('div')->item(3)->textContent);
                    $link = $div->getElementsByTagName('a')->item(0)->getAttribute('href');

                    //Create the article
                    $article = new Article(); 
                    $article->title = $title;
                    $article->link = $link;
                    
                    //Push to the articles
                    $articles[] = $article;
                }
            }
            return $articles;
        } else {
            throw new ArticleGatewayException('Error while making the gateway request');
        }
    }
}
