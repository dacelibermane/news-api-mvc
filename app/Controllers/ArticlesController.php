<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\ShowAllArticles;
use App\Template;

class ArticlesController
{
    public function index(): Template
    {
        $search = $_GET['search'] ?? 'tesla';
        $category = $_GET['category'] ?? null;

        $articles = (new ShowAllArticles())->execute($search, $category);

        return new Template('index.html.twig', ['articles' => $articles->getArticles()]);
    }
}