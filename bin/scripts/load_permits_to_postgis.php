<?php
/**
 * script name: load-permits.php
 * 
 * description: load the permits in json format in the data directory into PostGIS
 * 
 */

require 'Bootstrap.php';
$sm = Bootstrap::getServiceManager();

chdir( dirname(__DIR__) );

$dataDir = getcwd()."/../data";
$filePattern = 'permits.1.json';
$filePattern = 'permits.\d*.json';

print "data_dir=$dataDir\n";
$files = getFiles($dataDir,$filePattern);


$outFile = 'permits.csv';

$counter = 1;

print "loading ".count($files)." into database\n";

foreach( $files as $file ) {
    $jsonObject = \Zend\Json\Json::decode( file_get_contents($file), \Zend\Json\Json::TYPE_ARRAY );

    $violationArray = $jsonObject['d']['results'];
    $permitMapper = $sm->get('PermitHeatMapper\Mapper\PermitMapper');

    foreach( $violationArray as $permitArray ) {
        $permit = new PermitHeatMapper\Entity\Permit( $permitArray );
        
        if( $counter > 41966 ) {
            $permitMapper->save( $permit );
            echo $counter . " " . $permit->toString() . "\n";
        }
        
        $counter++;
    }
}

function getFiles( $dataDir,$filePattern ) {
    $files = array();
    // Open a known directory, and proceed to read its contents
    if (is_dir($dataDir)) {
        if ($dh = opendir($dataDir)) {
            while (($file = readdir($dh)) !== false) {

                if( preg_match( '/'.$filePattern.'/',$file ) ) {
                   array_push( $files, $dataDir.'/'.$file );
                }
            }
            closedir($dh);
        }
    }
    return $files;
}
