<?php

namespace Check24Framework;

class Application
{
    private $config =[];
   public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    public function init()
    {

        $frameworkConfig = include ('config.php');

       $this->config['factories'] = array_merge($this->config['factories'], $frameworkConfig);

        $request = new Request($_GET, $_POST, $_FILES);
        $diContainer = new DiContainer($this->config);
        $router = $diContainer->get('Check24Framework\Router');
        try {
            $controllerClass = $router->route($this->config, $_SERVER['REQUEST_URI']);
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