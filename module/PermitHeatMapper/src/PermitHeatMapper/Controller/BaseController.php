<?php

namespace PermitHeatMapper\Controller;

use Zend\Mvc\Controller\AbstractActionController;
/**
 * Description of BaseController
 *
 * @author Jim Smiley twitter:@jimRsmiley
 */
class BaseController extends AbstractActionController {
    
    private $neighborhoodPermitCountMapper;
    
    public function neighborhoodPermitCountMapper() {
        if( $this->neighborhoodPermitCountMapper == null ) {
            $this->neighborhoodPermitCountMapper = $this->getServiceLocator()
                    ->get( 'PermitHeatMapper\Mapper\NeighborhoodPermitCountMapper' );
        }
        return $this->neighborhoodPermitCountMapper;
    }
}
?>