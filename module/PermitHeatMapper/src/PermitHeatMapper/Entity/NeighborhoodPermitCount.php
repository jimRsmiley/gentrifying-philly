<?php

namespace PermitHeatMapper\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="neighborhood_permit_counts")
 */
class NeighborhoodPermitCount {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /**
     * @ORM\Column(name="neighborhood_name")
     */
    protected $neighborhoodName;
    
    /**
     * @ORM\Column(name="neighborhood_polygon",type="geometry")
     */
    protected $neighborhoodPolygon;    
    
    /**
     * @ORM\Column
     */
    protected $y2007;
    
    /**
     * @ORM\Column
     */
    protected $y2008;
    
    /**
     * @ORM\Column
     */
    protected $y2009;
    
    /**
     * @ORM\Column
     */
    protected $y2010;
    
    /**
     * @ORM\Column
     */
    protected $y2011;
    
    /**
     * @ORM\Column
     */
    protected $y2012;
    
    /**
     * @ORM\Column
     */
    protected $y2013;

    public function __construct( $data = null ) {
        
        if( !empty($data) ) {
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
            $hydrator->hydrate($data, $this);
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId( $id ) {
        $this->id = $id;
    }
    
    public function getNeighborhoodName() {
        return $this->neighborhoodName;
    }
    
    public function setNeighborhoodName( $name ) {
        $this->neighborhoodName = $name;
    }
    
    public function getNeighborhoodPolygon() {
        return $this->neighborhoodPolygon;
    }
    
    public function setNeighborhoodPolygon( $polygon ) {
        $this->neighborhoodPolygon = $polygon;
    }
    
    public function getY2007() {
        return $this->y2007;
    }
    
    public function setY2007( $y2007 ) {
        $this->y2007 = $y2007;
    }
    
    public function getY2008() {
        return $this->y2008;
    }
    
    public function setY2008( $y2008 ) {
        $this->y2008 = $y2008;
    }
    
    public function getY2009() {
        return $this->y2009;
    }
    
    public function setY2009( $y2009 ) {
        $this->y2009 = $y2009;
    }
    
    public function getY2010() {
        return $this->y2010;
    }
    
    public function setY2010( $y2010 ) {
        $this->y2010 = $y2010;
    }
    
    public function getY2011() {
        return $this->y2011;
    }
    
    public function setY2011( $y2011 ) {
        $this->y2011 = $y2011;
    }
    
    public function getY2012() {
        return $this->y2012;
    }
    
    public function setY2012( $y2012 ) {
        $this->y2012 = $y2012;
    }
    
    public function getY2013() {
        return $this->y2013;
    }
    
    public function setY2013( $y2013 ) {
        $this->y2013 = $y2013;
    }
}

?>
