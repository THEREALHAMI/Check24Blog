<?php

namespace Check24Framework;

class Application
{
    public function init($config)
    {
        $events = $config['events'];
        $frameworkConfig = include ('config.php');

        $config= array_merge_recursive($config, $frameworkConfig);
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
        $controller->setRouteConfig($config['routes']);
        $viewModel = $controller->action($request);

       foreach ($events[EventInterface::PRERENDER] as $preEvent){
            $preEvent = new $preEvent;
          $preEvent->register($viewModel);
        }

        $renderer = new Renderer();
        $renderer->render($viewModel);
    }
}