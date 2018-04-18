<?php

namespace Check24Framework;

class Application
{
    public function init($config)
    {

        $frameworkConfig = include ('config.php');

        //  todo: recusive funktioniert nicht
        $config['factories'] = array_merge($config['factories'], $frameworkConfig);

        $request = new Request($_GET, $_POST, $_FILES);
        $diContainer = new DiContainer($config);

        $router = $diContainer->get(Router::class);
        try {
            $controllerClass = $router->route($config, $_SERVER['REQUEST_URI']);
        } catch (\Exception $exception) {
            header("HTTP/1.0 404 Not Found");
            include('../template/error/404.html');
            die();
        }


        $controller = $diContainer->get($controllerClass);
        $viewModel = $controller->action($request);
        $renderer = new Renderer();
        $renderer->render($viewModel);

    }
}