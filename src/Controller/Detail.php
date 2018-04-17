<?php
// TEXT ohne leerzeichen  = FEHLER
namespace Controller;

use Check24Framework\ControllerInterface;
use Check24Framework\Request;
use Check24Framework\ViewModel;
use Factory\Entry;
use Factory\Comment;

class Detail implements ControllerInterface
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
    public function action(Request $request): ViewModel
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('../template/start/detailseite.phtml');

        $blogId = $request->getFromQuery('ID');

        $entry = Entry::create();
        $entryData = $entry->getEntryById($blogId);

            $viewModel->setTemplateVariables([
                'entryData'=> $entryData,
                'ID' => $blogId
            ]);
        return $viewModel;
    }
}