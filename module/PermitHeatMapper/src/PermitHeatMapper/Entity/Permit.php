<?php

namespace PermitHeatMapper\Entity;

include("/var/www/app/vendor/autoload.php");

use Doctrine\ORM\Mapping as ORM;
use proj4php\Proj4php as Proj4php;
use proj4php\Proj as Proj4phpProj;
use proj4php\Point as Proj4phpPoint;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
/** 
 * 
 * the class that r
 * 
 * @ORM\Entity */
class Permit {

    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $permitNumber;
    
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $issuedDatetime;
    
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $updatedDatetime;
    
    /**
     * @ORM\Column(type="blob",nullable=true)
     */
    protected $workDescription;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $permitTypeCode;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $permitTypeName;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $applicationType;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $applicationDescription;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $status;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactType;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactCompanyName;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactLastName;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactFirstName;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactAddress1;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactAddress2;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactCity;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactState;
    
    /**
     * @ORM\Column(nullable=true)
     */
    protected $priContactZip;
    
    /**
     * @ORM\Column(nullable=true)
     */
    private $locationId = null;
    
    /**
     * @ORM\Column(nullable=true)
     */
	private $streetNumber = null;
	
    /**
     * @ORM\Column(nullable=true)
     */
    private $streetName = null;
	
    /**
     * @ORM\Column(nullable=true)
     */
    private $streetSuffix = null;
	
    /**
     * @ORM\Column(nullable=true)
     */
    private $city = null;
    
    /**
     * @ORM\Column(nullable=true)
     */
    private $state = null;
    
    /**
     * @ORM\Column(nullable=true)
     */
    private $zip = null;
    
    /**
     * @ORM\Column(nullable=true)
     */
	private $censusTract = null;
    
    /**
     * @ORM\Column(nullable=true)
     */
    private $councilDistrict = null;
     
    /**
     * @ORM\Column(nullable=true)
     */
     private $condoUnit = null;
     
    /**
     * @ORM\Column(nullable=true)
     */
     private $unitNumber = null;
     
    /**
     * @ORM\Column(nullable=true)
     */
    private $censusBlock = null;
    
    /**
    * @ORM\Column(nullable=true)
    */
    private $ward = null;
     
    /**
    * @ORM\Column(nullable=true)
    */
    private $x = null;

    /**
    * @ORM\Column(nullable=true)
    */
    private $y = null;
    
     /*
     * @ORM\Column(type="float",nullable=true)
     */
    protected $lat;
    
    /**
    * @ORM\Column(type="float",nullable=true)
    */
    protected $lng;
    
    /**
     * @ORM\Column(type="point",nullable=true)
     */
    protected $point;
    
    
    public function __construct( $array = null ) {
        
        if( !empty( $array ) ) {
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
            $hydrator->hydrate($array,$this);
            $this->createPoint();
        }
    }
    
    public static function arrayToPermits( $array ) {
        
        $permits = [];
        foreach( $array as $permitArray ) {
            $permits[] = new Permit( $permitArray );
        }
        
        return $permits;
    }
    
    public function getWorkDescription() {
        return $this->workDescription;
    }
    
    public function setWorkDescription( $workDescription ) {
        $this->workDescription = $workDescription;
    }
        public function getPermitTypeCode() {
        return $this->permitTypeCode;
    }
    
    public function setPermitTypeCode( $permitTypeCode ) {
        $this->permitTypeCode = $permitTypeCode;
    }
    
    public function getPermitTypeName() {
        return $this->permitTypeName;
    }
    
    public function setPermitTypeName( $permitTypeName ) {
        $this->permitTypeName = $permitTypeName;
    }
    
    public function getApplicationType() {
        return $this->applicationType;
    }
    
    public function setApplicationType( $applicationType ) {
        $this->applicationType = $applicationType;
    }
    
    public function getApplicationDescription() {
        return $this->applicationDescription;
    }
    
    public function setApplicationDescription( $applicationDescription ) {
        $this->applicationDescription = $applicationDescription;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus( $status ) {
        $this->status = $status;
    }
    
    public function getIssuedDatetime() {
        return $this->issuedDatetime;
    }
    
    public function setIssuedDatetime( $issuedDateTime ) {
        $this->issuedDatetime = new \DateTime($this->getFormattedDate($issuedDateTime));
    }
    
    public function getPriContactType() {
        return $this->priContactType;
    }
    
    public function setPriContactType( $priContactType ) {
        $this->priContactType = $priContactType;
    }
    
    public function getPriContactCompanyName() {
        return $this->priContactCompanyName;
    }
    
    public function setPriContactCompanyName( $priContactCompanyName ) {
        $this->priContactCompanyName = $priContactCompanyName;
    }
    
    public function getPriContactLastName() {
        return $this->priContactLastName;
    }
    
    public function setPriContactLastName( $priContactLastName ) {
        $this->priContactLastName = $priContactLastName;
    }
    
    public function getPriContactFirstName() {
        return $this->priContactFirstName;
    }
    
    public function setPriContactFirstName( $priContactFirstName ) {
        $this->priContactFirstName = $priContactFirstName;
    }
    
    public function getPriContactAddress1() {
        return $this->priContactAddress1;
    }
    
    public function setPriContactAddress1( $priContactAddress1 ) {
        $this->priContactAddress1 = $priContactAddress1;
    }
    
    public function getPriContactAddress2() {
        return $this->priContactAddress2;
    }
    
    public function setPriContactAddress2( $priContactAddress2 ) {
        $this->priContactAddress2 = $priContactAddress2;
    }
    
    public function getPriContactCity() {
        return $this->priContactCity;
    }
    
    public function setPriContactCity( $priContactCity ) {
        $this->priContactCity = $priContactCity;
    }
    
    public function getPriContactState() {
        return $this->priContactState;
    }
    
    public function setPriContactState( $priContactState ) {
        $this->priContactState = $priContactState;
    }
    
    public function getPriContactZip() {
        return $this->priContactZip;
    }
    
    public function setPriContactZip( $priContactZip ) {
        $this->priContactZip = $priContactZip;
    }
    
    public function setX( $x ) {
        $this->x = $x;
    }
    
    public function getX() {
        return $this->x;
    }
    
    public function setY( $y ) {
        $this->y = $y;
    }
    
    public function getY() {
        return $this->y;
    }
    

    public function getId() {
        return $this->id;
    }
    
    public function setId( $id ) {
        $this->id = $id;
    }

    public function getLocationId(){
		return $this->locationId;
	}

	public function setLocationId($locationId){
		$this->locationId = $locationId;
	}

	public function getStreetNumber(){
		return $this->streetNumber;
	}

	public function setStreetNumber($streetNumber){
		$this->streetNumber = $streetNumber;
	}

	public function getStreetName(){
		return $this->streetName;
	}

	public function setStreetName($streetName){
		$this->streetName = $streetName;
	}

	public function getStreetSuffix(){
		return $this->streetSuffix;
	}

	public function setStreetSuffix($streetSuffix){
		$this->streetSuffix = $streetSuffix;
	}

	public function getCity(){
		return $this->city;
	}

	public function setCity($city){
		$this->city = $city;
	}

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function getZip(){
		return $this->zip;
	}

	public function setZip($zip){
		$this->zip = $zip;
	}

	public function getCensusTract(){
		return $this->censusTract;
	}

	public function setCensusTract($censusTract){
		$this->censusTract = $censusTract;
	}

	public function getCouncilDistrict(){
		return $this->councilDistrict;
	}

	public function setCouncilDistrict($councilDistrict){
		$this->councilDistrict = $councilDistrict;
	}

	public function getCondoUnit(){
		return $this->condoUnit;
	}

	public function setCondoUnit($condoUnit){
		$this->condoUnit = $condoUnit;
	}

	public function getUnitNumber(){
		return $this->unitNumber;
	}

	public function setUnitNumber($unitNumber){
		$this->unitNumber = $unitNumber;
	}

	public function getCensusBlock(){
		return $this->censusBlock;
	}

	public function setCensusBlock($censusBlock){
		$this->censusBlock = $censusBlock;
	}

	public function getWard(){
		return $this->ward;
	}

	public function setWard($ward){
		$this->ward = $ward;
	}
    
    public function getPermitNumber() {
        return $this->permitNumber;
    }
    
    public function setPermitNumber( $permitNumber ) {
        $this->permitNumber = $permitNumber;
    }
    
    /*
     * as far as the data I've seen, the city uses the plural 'locations' to describe
     * a single location, which should be it's own object, but I'm cheating for
     * expediency, so let's takte the associative array $array['locations'] and just
     * populate it's values
     */
    public function setLocations( $locations ) {
        $hydrator = new \Zend\StdLib\Hydrator\ClassMethods();
        $hydrator->hydrate( $locations, $this );
    }
    


    
    /**
    * the phlApi returns dates formatted as a Javascript Date function.
    */
    function getFormattedDate( $issuedDateTime ) {
       preg_match( "/\/Date\((.*)000\)\//", $issuedDateTime, $matches );
       $timestamp = $matches[1];

       return date('Y-m-d H:i:s', $timestamp );
    }
    
    public function __toString() {
        return $this->getPermitTypeCode() . " lat/lng: " . $this->getLat() . "," . $this->getLng() . " " . $this->getWorkDescription();
    }
    
    public function toString() {
        return $this->__toString();
    }
    

    public static function escapeChar( $string ) {
        $SEPARATOR = self::getSeperator();
        $string = str_replace( '"', '\"', $string );
        //$string = str_replace( "\r\n", '\\\n', $string );
        return $string;
    }
    
    public static function getSeperator() {
        return "|";
    }
    
    public function toArray() {
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $array = $hydrator->extract($this);
        $array = $this->pruneArray($array);
        
        return $array;
    }
    
    public function getLat() {
        return $this->lat;
    }
    
    public function setLat( $lat ) {
        $this->lat = $lat;
    }
    
    public function getLng() {
        return $this->lng;
    }
    
    public function setLng( $lng ) {
        $this->lng = $lng;
    }
    

    
    public function getPoint() {
        return $this->point;
    }
    
    public function setPoint($point) {
        $this->point = $point;
    }
    
    public function getUpdatedDatetime() {
        return $this->updatedDatetime;
    }
    
    public function setUpdatedDatetime( $updatedDatetime ) {
        $this->updatedDatetime = new \DateTime( $this->getFormattedDate($updatedDatetime) );
    }
    
    /*
     * License and Inspection is giving us state plane coordinates, we need
     * to change that to lat, lng
     */
    public function createPoint() {
        
        if( $this->getX() == null || $this->getY() == null )
            return;
        
        $proj4 = new Proj4php();
		$proj4->addDef("EPSG:2272", '+proj=lcc +lat_1=40.96666666666667 +lat_2=39.93333333333333 +lat_0=39.33333333333334 +lon_0=-77.75 +x_0=600000 +y_0=0 +ellps=GRS80 +datum=NAD83 +to_meter=0.3048006096012192 +no_defs');

        $statePlane2272 = new Proj4phpProj('EPSG:2272',$proj4);
        $projWGS84 = new Proj4phpProj('EPSG:4326',$proj4);
        $pointSrc = new Proj4PhpPoint( $this->getX(),$this->getY() );
        $pointDest = $proj4->transform($statePlane2272,$projWGS84,$pointSrc);

        $this->lat = $pointDest->y;
        $this->lng = $pointDest->x;
        $this->setPoint( new Point( $this->lng, $this->lat ) );
    }
    
    public function getFullAddress() {
        
        $address = $this->streetNumber;
        
        if( isset( $this->streetDirection ) && $this->streetDirection != " " ) {
            $address .= " " . $this->streetDirection;
        }

        $address .= " " . $this->streetName . " " . $this->streetSuffix;
        
        $address .= " " . $this->zip;
        return trim($address);
    }
}
?>
