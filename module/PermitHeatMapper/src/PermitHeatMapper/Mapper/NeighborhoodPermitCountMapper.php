<?php
namespace PermitHeatMapper\Mapper;
/**
 * Description of NeighborhoodPermitCountMapper
 *
 * @author Jim Smiley twitter:@jimRsmiley
 */
class NeighborhoodPermitCountMapper {
    
    protected $em;
    
    public function __construct( $em ) {
        $this->em = $em;
    }
    
    public function getPermitCountsByNeighborhoodsAsGeoJson() {
        
        $sql = "SELECT row_to_json( fc ) as geojson
FROM ( SELECT 'FeatureCollection' as type, array_to_json(array_agg(f)) as features
FROM( SELECT 'Feature' as type
    , ST_AsGeoJSON( neighborhood_permit_counts.neighborhood_polygon)::json AS geometry
    , row_to_json( (SELECT l FROM ( SELECT neighborhood_name,y2007,y2008,y2009,y2010,y2011,y2012,y2013) AS l
    )) AS properties
FROM neighborhood_permit_counts ) as f ) as fc";
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult('geojson', 'geojson');
        $query = $this->em->createNativeQuery( $sql, $rsm );
        $result = $query->getSingleResult();
        return $result['geojson'];
    }
    
    public function getLocationCountsByNeighborhoodAsGeoJson() {
        
        $sql = "SELECT row_to_json( fc ) as geojson
FROM ( SELECT 'FeatureCollection' as type, array_to_json(array_agg(f)) as features
FROM( SELECT 'Feature' as type
    , ST_AsGeoJSON( neighborhood_location_count.neighborhood_polygon)::json AS geometry
    , row_to_json( (SELECT l FROM ( SELECT neighborhood_name,y2007,y2008,y2009,y2010,y2011,y2012,y2013) AS l
    )) AS properties
FROM neighborhood_location_count ) as f ) as fc";
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult('geojson', 'geojson');
        $query = $this->em->createNativeQuery( $sql, $rsm );
        $result = $query->getSingleResult();
        return $result['geojson'];
    }
}

?>
