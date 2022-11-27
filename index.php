<?php declare(strict_types=1);

require_once "vendor/autoload.php";

use App\Controllers\ArticlesController;
use App\Models\Article;
\Dotenv\Dotenv::createImmutable(__DIR__)->load();

//echo '<pre>';
//
//$articles = (new ArticlesController())->getAllArticles()->getLastEntries(10);
//echo $articles[0];
//foreach ($articles as $article){
//    var_dump($article[0]->getTitle);
//}
//$articlesApi = (new ArticlesController())->getAllArticles();
////$t = $articlesApi->getArticles()[0]->getTitle();
//var_dump($articlesApi->getSpecifiedCountOfNews());
////tiekam pie pirmās ziņas virsraksta
//var_dump($articlesApi[0]->getTitle());
//var_dump($t);
//foreach ($articlesApi as $value){
//    var_dump($value->articles[0]);
//}

//$articlesApi = (new ArticlesController())->getAllArticles();
//$t = $articlesApi->getLastEntries();
//
//var_dump($t);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', ['App\Controllers\ArticlesController', 'index']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = $handler;
        $response = (new $controller)->{$method}();
        echo $response;
        break;
}