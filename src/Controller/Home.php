<?php
//todo: factory für repository erstellen, benutze Konstruker

namespace Controller;

use \Check24Framework\ControllerInterface;
use Check24Framework\ViewModel;
use Check24Framework\DiContainer;
use Factory\Entry;

class Home implements ControllerInterface
{

    private $diContainer;
    public function __construct(DiContainer $diContainer)
    {
        $this->diContainer = $diContainer;
    }

    /**
     * @param \Check24Framework\Request $request
     * @return ViewModel
     */
    public function action($request): viewModel
    {

        $currentPage = $request->getFromQuery('page') ? $request->getFromQuery('page') : 0;
        $nextPage = $currentPage + 1;
        $limit = $currentPage * 3;

        $entry = $this->diContainer->get('Repository\Entry');
        $entryData = $entry->getFromDatabase($limit);
        $countEntries = $entry->getCountEntries();
        $lastPage = ceil(($countEntries[0] / 3));

        $viewModel = new ViewModel();
        $viewModel->setTemplate('../template/start/startseite.phtml');
        $viewModel->setTemplateVariables([
            'blogEntries' => $entryData,
            'currentPage' => $currentPage,
            'nextPage' => $nextPage,
            'lastPage' => $lastPage
        ]);

        return $viewModel;
    }
}