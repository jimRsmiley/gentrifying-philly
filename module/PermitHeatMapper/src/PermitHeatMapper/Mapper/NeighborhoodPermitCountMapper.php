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
    
    public function getLocationCountsByNeighborhoodAsGeoJson() {
        
        $sql = "SELECT row_to_json( fc ) as geojson
FROM ( SELECT 'FeatureCollection' as type, array_to_json(array_agg(f)) as features
FROM( SELECT 'Feature' as type
    , ST_AsGeoJSON( neighborhood_location_count.neighborhood_polygon)::json AS geometry
    , row_to_json( (SELECT l FROM ( SELECT neighborhood_name,y2007,y2008,y2009,y2010,y2011,y2012,y2013, (cast(y2007 as float)+y2008+y2009+y2010+y2011)/5 as avg_2007_to_2011, (cast(y2012 as float)+y2013)/2 as avg_2012_and_2013, ( ( (cast(y2012 as float)+y2013)/2) - ( ( (cast(y2007 as float)+y2008+y2009+y2010+y2011)/5) ) ) / ( ( cast(y2007 as float)+y2008+y2009+y2010+y2011)/5 )*100 as gentrifyer  ) AS l
    )) AS properties
FROM neighborhood_location_count ) as f ) as fc
";
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult('geojson', 'geojson');
        $query = $this->em->createNativeQuery( $sql, $rsm );
        $result = $query->getSingleResult();
        return $result['geojson'];
    }
    
    public function fetchAll() {
        $sql = "SELECT neighborhood_name,y2007,y2008,y2009,y2010,y2011,y2012,y2013 FROM neighborhood_location_count";
        
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult('neighborhood_name', 'neighborhood_name');
        $rsm->addScalarResult('y2007', 'y2007');
        $rsm->addScalarResult('y2008', 'y2008');
        $rsm->addScalarResult('y2009', 'y2009');
        $rsm->addScalarResult('y2010', 'y2010');
        $rsm->addScalarResult('y2011', 'y2011');
        $rsm->addScalarResult('y2012', 'y2012');
        $rsm->addScalarResult('y2013', 'y2013');
        
        $query = $this->em->createNativeQuery( $sql, $rsm );
        $result = $query->getResult();
        return $result;
    }
}

?>
