<?php

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php');

$outFile = "./data/violations-w-locations.csv";
$fp = fopen($outFile, 'w');

// create curl resource 
$ch = curl_init(); 
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$runningTotal = 0;

$violationCode = "PM-102.4/2"; // 27k
//$violationCode = "PM-102.4/1"; // 5K
//$violationCode = "PM-306.2/4"; // 3800
$violationCode = "PM-102.4/4"; // 1.2K

$url = 'http://services.phila.gov/PhillyApi/Data/v1.0/violationdetails?'
        . '&$inlinecount=allpages'
        //. '&$expand=cases,locations'
        . '&$expand=locations'
        . '&$filter='.urlencode("violation_code eq '$violationCode'" )
        . '&orderby=violation_datetime%20asc'
        //. '&$skip=' . $skip
        //. '&top='.$top
        ;

$headerOut = false;

while( isset($url) ) {
    
    $url .= '&$format=json';
    
    print date("H:i:s") . " $url\n";
    
    // $output contains the output string 
    $jsonObject = getData($ch,$url );

    $violationArray = $jsonObject['d']['results'];

    \Zend\Debug\Debug::dump( $violationArray );
    
    foreach( $violationArray as $violation ) {
        
        $violation = array_merge( $violation, $violation['locations'] );
        $violation = array_merge( $violation, $violation['cases']);

        $violation['violation_datetime'] = getValidDate($violation['violation_datetime']);
        
        unset( $violation['locations'] );
        unset( $violation['cases'] );
        unset( $violation['__metadata'] );
        unset( $violation['__deferred'] );
        unset( $violation['locationhistories'] );
        unset( $violation['violationdetails'] );
        unset( $violation['licenses'] );
        unset( $violation['permits'] );
        unset( $violation['appealhearings'] );
        unset( $violation['buildingboardappeals'] );
        unset( $violation['lireviewboardappeals'] );
        unset( $violation['zoningboardappeals'] );

        if( !$headerOut ) {
            fputcsv($fp, array_keys( $violation ) );
            $headerOut = true;
        }
        fputcsv($fp, array_values( $violation ) );
    } // end foreach violation

    $totalViolations = getCount( $jsonObject );
    $runningTotal += count( $violationArray );
    print $runningTotal . '/' . $totalViolations . "\n";

    $url = getNextUrl($jsonObject);
    print "next url=".$url."\n";
} // while the url is still valid

// close curl resource to free up system resources 
curl_close($ch);   

function getNextUrl($jsonObject) {
    
    // it will tell you the next url you need
    if(array_key_exists( '__next',$jsonObject['d'] ) )
        $url = $jsonObject['d']['__next'];
    else
        $url = null; // and we're finished
    
    return $url;
}

function getCount( $jsonObject ) {
    return $jsonObject['d']['__count'];
}

function getValidDate( $timestamp ) {
    
    $matches = array();
    preg_match( "/Date\((\d+)000\)/",$timestamp, $matches );
    
    if( !empty($matches) ) {
        return date( 'Y-m-d H:i:s', $matches[1] );
    }
    else {
        print "couldn't figure out $timestamp\n";
        return "";
    }
}

function getData( $ch, $url ) {
    // set url 
    print date("H:i:s") . " fetching $url\n";
    curl_setopt($ch, CURLOPT_URL, $url); 
    $jsonStr = curl_exec($ch); 
    return \Zend\Json\Json::decode( $jsonStr, \Zend\Json\Json::TYPE_ARRAY );
}
?>
