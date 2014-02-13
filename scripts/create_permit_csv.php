<?php
/**
 * script name: load-permits.php
 * 
 * description: load the permits in json format in the data directory into PostGIS
 * 
 */

require 'Bootstrap.php';
$sm = Bootstrap::getServiceManager();

$permitCSV = new \PermitHeatMapper\PermitCSV(
        $dataDir = ROOT_PATH . '/data', 
        $filePattern = 'permits.\d*.json', 
        $outFile = ROOT_PATH . "/data/permits.csv" );

$permitCSV->extractPermits();
    
