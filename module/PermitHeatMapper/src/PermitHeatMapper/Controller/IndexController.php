<?php

namespace PermitHeatMapper\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    public function yearlyChangeAction() {}
    
    public function altVizAction() {}
    
    public function aboutAction() {}
    
    public function showDataAction() {
        $locationData = $this->neighborhoodPermitCountMapper()->fetchAll();
        return new ViewModel( array( 'locationData' => $locationData ) );
    }
    
    public function averageChangeAction() {}
}
