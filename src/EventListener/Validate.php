<?php


namespace EventListener;

use Check24Framework\EventInterface;
use Check24Framework\ViewModel;

class Validate implements EventInterface
{
    /**
     * @param $viewModel
     * @return ViewModel
     */
    //todo : Alles richtig trennen 
    public function register($viewModel) : ViewModel
    {
            $viewModel->setLayoutVariables(['validate' => isset($_SESSION['validate']) ? $_SESSION['validate'] : null]);
            return $viewModel;
    }

    public function execute()
    {

    }
}