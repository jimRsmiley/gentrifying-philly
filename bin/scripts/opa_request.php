<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$url = 'http://services.phila.gov/OPA/v1.0/Address/1128+foulkrod+street/';

// create curl resource 
$ch = curl_init(); 
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

$skip = 0; $runningTotal = 0;
$get = true;

// set url 
curl_setopt($ch, CURLOPT_URL, $url); 

// $output contains the output string 
$jsonStr = curl_exec($ch); 

print $jsonStr;
?>
