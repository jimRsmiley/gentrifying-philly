<?php
/**
 * script name: get_permits.php
 * 
 * description: go out to the phlAPI and pull down all of of L&I's permits
 * 
 */


/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php');


// create curl resource 
$ch = curl_init(); 
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

$runningTotal = 0;

$skip = 0;
$url = 'http://services.phila.gov/PhillyApi/Data/v1.0/permits?'
        . 'orderby=issued_datetime'
        . '&$expand=locations'
        . '&$inlinecount=allpages'
        . '&$skip=' . $skip;

$counter = 1;
while( isset($url) ) {
    
    $url .= '&$format=json';
    
    print date("H:i:s") . $url . "\n";
    
    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 

    // $output contains the output string 
    $jsonStr = curl_exec($ch); 
    
    if( $storeFile = true )
        file_put_contents( 'data/permits.'.sprintf( "%03d",$counter).'.json', $jsonStr );
    
    if( $createPermits = false ) {
        $jsonArray = \Zend\Json\Json::decode( $jsonStr, \Zend\Json\Json::TYPE_ARRAY );
        
        \Zend\Debug\Debug::dump( $jsonArray );

        $violationArray = \PermitHeatMapper\Entity\Permit::arrayToPermits( $jsonArray['d']['results'] );
        
        \Zend\Debug\Debug::dump( $violationArray[0] );
        exit;
    }
    
    $jsonObject = \Zend\Json\Json::decode( $jsonStr );
    $violationArray = $jsonObject->d->results;
    $totalViolations = $jsonObject->d->__count;
    
    // it will tell you the next url you need
    $url = $jsonObject->d->__next;
    
    $runningTotal += count( $violationArray );
    print $runningTotal . '/' . $totalViolations . "\n";

    $counter++;
}

// close curl resource to free up system resources 
curl_close($ch);   

?>
