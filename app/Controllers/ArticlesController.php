<?php declare(strict_types=1);

namespace App\Controllers;

use App\ArticlesCollection;
use App\Models\Article;
use jcobhams\NewsApi\NewsApi;

class ArticlesController extends BaseController
{
    public function index(): string
    {
        $apiKey = $_ENV['API_KEY'];
        $search = $_GET['search'] ?? 'Tesla';
        $newsApi = new NewsApi($apiKey);
        $articlesApiResponse = $newsApi->getEverything($search);

        $articles = new ArticlesCollection();
        foreach ($articlesApiResponse->articles as $article) $articles->addArticles(new Article(
            $article->title,
            $article->description,
            $article->url,
            $article->urlToImage
        ));
        return $this->render('index.html.twig', ['articles' => $articles->getArticles()]);
    }
}