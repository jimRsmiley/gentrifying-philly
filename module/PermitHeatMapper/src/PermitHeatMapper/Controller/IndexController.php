<?php

namespace PermitHeatMapper\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function altVizAction()
    {
        return new ViewModel();
    }
    
    public function aboutAction() {}
    
    public function showDataAction() {
        $locationData = $this->neighborhoodPermitCountMapper()->fetchAll();
        return new ViewModel( array( 'locationData' => $locationData ) );
    }
    
    public function averageChangeAction() {
        
    }
}
