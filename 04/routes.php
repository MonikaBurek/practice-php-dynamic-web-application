<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => '/controllers/index.php',
    '/about-me' => '/controllers/about.php',
    '/contact' => '/controllers/contact.php',
];

function routeToController($uri, $routes,)
{
    $filepath = $_SERVER['DOCUMENT_ROOT'] . $routes[$uri];
    if (array_key_exists($uri, $routes) && file_exists($filepath)) {
        require $filepath;
    } else {
        abort();
    }
}

function abort($code = 404)
{
    http_response_code($code);
    require $_SERVER['DOCUMENT_ROOT'] . "/views/{$code}.php";
    die();
}

if (preg_match('/^[A-Za-z0-9\/-]+$/', $uri)) {
    routeToController($uri, $routes);
} else {
   abort();
}
