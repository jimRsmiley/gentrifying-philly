<?php
namespace PermitHeatMapper\Controller;

use Zend\View\Model\ViewModel;
/**
 * Description of ResultController
 *
 * @author Jim Smiley twitter:@jimRsmiley
 */
class NeighborhoodPermitCountController extends BaseController {
    
    public function permitCountsByNeighborhoodAsGeojsonAction() {
        
        $neighborhoodPermitMapper = $this->neighborhoodPermitCountMapper();
        $geojson = $neighborhoodPermitMapper->getPermitCountsByNeighborhoodsAsGeoJson();
        
        $this->getResponse()->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $viewModel = new ViewModel( array('geojson' => $geojson ) );
        $viewModel->setTerminal( true );
        return $viewModel;
    }
    
    public function locationCountsByNeighborhoodAsGeojsonAction() {
        
        $neighborhoodPermitMapper = $this->neighborhoodPermitCountMapper();
        $geojson = $neighborhoodPermitMapper->getLocationCountsByNeighborhoodAsGeoJson();
        
        $this->getResponse()->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $viewModel = new ViewModel( array('geojson' => $geojson ) );
        $viewModel->setTemplate('permit-heat-mapper/neighborhood-permit-count/as-geojson.phtml');
        $viewModel->setTerminal( true );
        return $viewModel;
    }
}

?>
