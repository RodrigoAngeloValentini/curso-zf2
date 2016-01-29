<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{
    protected $albumTable;

    public function indexAction()
    {

        // grab the paginator from the AlbumTable
        $paginator = $this->getAlbumTable()->fetchAll(true);
        // set the current page to what has been passed in query string, or to 1 if none set
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        // set the number of items per page to 10
        $paginator->setItemCountPerPage(10);

        return new ViewModel(array(
            'paginator' => $paginator
        ));
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }

    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
}