<?php

namespace Controller;

use Check24Framework\ControllerInterface;
use Check24Framework\DiContainer;
use Check24Framework\ViewModel;
use Check24Framework\Request;
use  Factory\Entry;

class AddEntrie implements ControllerInterface
{
    private $diContainer;
    public function __construct(DiContainer $diContainer)
    {
        $this->diContainer = $diContainer;
    }
    /**
     * @param Request $request
     * @return ViewModel
     */
    public function action(Request $request): viewModel
    {
       if($request->getFromPost('absenden')){
           $date =date('Y-m-d H:i:s');
           $titel = $request->getFromPost('titel');
           $content = $request->getFromPost('content');
           $authorId = $_SESSION['ID'];

           $entry = Entry::create();
           $entry->addToDatabase($date,$titel,$content,$authorId);
       }
        $viewModel = new ViewModel();
        $viewModel->setTemplate('../template/start/eintrag.phtml');

        return $viewModel;
    }
}