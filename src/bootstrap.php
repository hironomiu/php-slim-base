<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

// Create app
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(
         __DIR__ . '/views',
        [
            'cache' => __DIR__ . '/cache',
            'debug' => true,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    $env = $view->getEnvironment();


    return $view;
};

$container['pdo'] = function() use($container,$host,$mysqldConfig){
    $cfg = $container->get('settings')['db'];
    return new PDO(sprintf('mysql:host=%s;dbname=%s;charset=utf8', $host, $mysqldConfig['database']), $mysqldConfig['user'], $mysqldConfig['password'], array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_PERSISTENT => false));
};


$container['repository.user'] = function() use($container){
    $db = $container->get('pdo');
    return new \Ap\Repository\UsersRepository($db);
};

$container['repository.sample'] = function() use($container){
    $db = $container->get('pdo');
    return new \Ap\Repository\SamplesRepository($db);
};

$container['session'] = function() {
    return new \Ap\Session();
};

$container['csrf'] = function ($c) {
        return new \Slim\Csrf\Guard;
};
