<?php declare(strict_types=1);

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    private FilesystemLoader $loader;
    private Environment $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('views');
        $this->twig = new Environment($this->loader);
    }

    public function render(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }
}