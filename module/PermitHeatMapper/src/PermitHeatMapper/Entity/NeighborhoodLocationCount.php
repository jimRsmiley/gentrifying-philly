<?php

namespace PermitHeatMapper\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * 
 * @ORM\Table(name="neighborhood_location_count")
 * @ORM\Entity
 **/
class NeighborhoodPermitCount {

    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;


    /**
     * @ORM\Column(type="integer",nullable=false)
     */
	protected $y2007;

    /**
     * @ORM\Column(type="integer",nullable=false)
     */
	protected $y2008;

    /**
     * @ORM\Column(type="integer",nullable=false)
     */
	protected $y2009;

    /**
     * @ORM\Column(type="integer",nullable=false)
     */
	protected $y2010;

    /**
     * @ORM\Column(type="integer",nullable=false)
     */
	protected $y2011;

    /**
     * @ORM\Column(type="integer",nullable=false)
     */
	protected $y2012;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
	protected $y2013;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
	protected $y2014;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
	protected $y2015;


    /**
     * @ORM\Column(type="geometry",nullable=false)
     */
	protected $neighborhood_polygon;

    /**
     * @ORM\Column(type="string",nullable=false)
     */
	protected $neighborhood_name;
    
    public function __construct( $array = null ) {
        
        if( !empty( $array ) ) {
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
            $hydrator->hydrate($array,$this);
            $this->createPoint();
        }
    }
}
?>
