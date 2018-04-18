<?php
//todo: factory für repository erstellen, benutze Konstruker

namespace Controller;

use \Check24Framework\ControllerInterface;
use Check24Framework\ViewModel;

class Home implements ControllerInterface
{

    private $repositoryEntry;

    public function __construct($repositoryEntry)
    {
        $this->repositoryEntry = $repositoryEntry;
    }

    /**
     * @param \Check24Framework\Request $request
     * @return ViewModel
     */
    public function action($request): viewModel
    {

        $currentpage = $request->getfromquery('page') ? $request->getfromquery('page') : 0;
        $nextpage = $currentpage + 1;
        $limit = $currentpage * 3;

        $entry = $this->repositoryEntry;
        $entrydata = $entry->getfromdatabase($limit);
        $countentries = $entry->getcountentries();
        $lastpage = ceil(($countentries[0] / 3));

        $viewmodel = new viewmodel();
        $viewmodel->settemplate('../template/start/startseite.phtml');
        $viewmodel->settemplatevariables([
            'blogEntries' => $entrydata,
            'currentpage' => $currentpage,
            'nextPage' => $nextpage,
            'lastPage' => $lastpage
        ]);

        return $viewmodel;
    }
}