<?php declare(strict_types=1);

namespace App\Controllers;

use App\ArticlesCollection;
use App\Models\Article;
use jcobhams\NewsApi\NewsApi;

class ArticlesController extends BaseController
{

    public function getAllArticles(): ArticlesCollection
    {
        $apiKey = $_ENV['API_KEY'];
        $newsApi = new NewsApi($apiKey);
        $articlesApiResponse = $newsApi->getEverything($_GET['search'] ?? 'Tesla');
//        $articlesApiResponse = $newsApi->getTopHeadlines("apple");

        $articles = new ArticlesCollection();
        foreach ($articlesApiResponse->articles as $article) {
            $articles->addArticles(new Article(
                $article->title,
                $article->description,
                $article->url,
                $article->urlToImage
            ));
        }
        return $articles;
    }

    public function index(): string
    {
        $articles = (new ArticlesController())->getAllArticles()->getLastEntries();
        return $this->render('index.html.twig', ['articles' => $articles]);
    }
}