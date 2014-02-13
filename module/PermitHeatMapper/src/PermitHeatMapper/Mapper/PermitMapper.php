<?php
namespace PermitHeatMapper\Mapper;

use PermitHeatMapper\Entity\Permit;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PermitMapper {
    
    protected $em;
    
    public function __construct( $entityManager ) {
        $this->em = $entityManager;
    }
    
    public function save(Permit $permit) {
        $this->em->persist($permit);
        $this->em->flush();
        $this->em->clear();
    }
    
    public function getPermitByPermitId() {
        
    }
    
    public function getPermitTypeNames() {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 'permit.permitTypeName, COUNT(permit.id)')
            ->from( 'PermitHeatMapper\Entity\Permit', 'permit' )
            ->groupBy( 'permit.permitTypeName' );
        return $qb->getQuery()->getResult();
    }
    
    public function getPermitCountByTypeName( $permitTypeName ) {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 'COUNT (permit.id)')
            ->from( 'PermitHeatMapper\Entity\Permit', 'permit' )
            ->where( 'permit.permitTypeName = :permitTypeName' )
            ->setParameter( ':permitTypeName', $permitTypeName );
        
        return $qb->getQuery()->getResult();
    }

    
    public function fetchInsideDateRangeInsideBuffer( $fromDate, $toDate, $lat, $lng, $bufferSize ) {
        /*
		SELECT COUNT(*) 
		FROM incident
		WHERE 
			ST_DWithin( ST_MakePoint( rail_stops.stop_lon,rail_stops.stop_lat ), incident.point, .0015 ) = 't' 
			AND ( 
				   incident.text_general_code LIKE '%Robbery%' 
				OR incident.text_general_code LIKE '%Assault%' 
				OR incident.text_general_code LIKE '%Rape%' 
				OR incident.text_general_code LIKE '%Homicide%' 
			) 
		)
	AS count 
	FROM rail_stops 
) row;
        */
    }
}
?>
