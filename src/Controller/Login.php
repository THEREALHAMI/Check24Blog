<?php

namespace Controller;

use Check24Framework\Exception\LoginMistake;
use Check24Framework\ControllerInterface;
use Check24Framework\ViewModel;

class Login implements ControllerInterface
{
    private $engine;
    public function __construct($engine)
    {
        $this->engine = $engine;
    }
    /**
     * @param \Check24Framework\Request $request
     * @return ViewModel
     */
    public function action($request): ViewModel
    {


        if ($request->getFromPost('checkingLogin')) {
            try {
                $_SESSION['validate'] = $this->engine->validate($request);
               header('Location:/', true, 301);
               die();
            } catch (LoginMistake $exception) {
                echo $exception->getMessage();
            }
        }
        $viewModel = new ViewModel();
        $viewModel->setTemplate('../template/start/login.phtml');
        return $viewModel;
    }
}
