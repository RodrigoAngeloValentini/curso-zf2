<?php

namespace Admin\Controller;


use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
