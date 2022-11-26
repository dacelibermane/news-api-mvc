<?php declare(strict_types=1);

namespace App;

use App\Models\Article;

class ArticlesCollection
{
    private array $articles = [];

    public function __construct(array $articles = [])
    {
        foreach ($articles as $article) {
            $this->addArticles($article);
        }
    }

    public function addArticles(Article $article): void
    {
        $this->articles [] = $article;
    }
    
    public function getLastEntries( int $amount = 10):array
    {

        return array_slice($this->articles, -$amount);
    }


}