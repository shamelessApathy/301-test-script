<?php
	// Define the list of sites to visit $list
	$list = $argv[1];
	// Define the list of site urls to check to make sure the end url is what the 301 redirect should be going to
	$check_list = $argv[2];
	// Define and restructure the arrays holding the csv values
	$check_csv = array_map('str_getcsv', file($check_list));
	$checkArray = [];
	foreach ($check_csv as $url)
	{
		$editUrl = 'http://threeohone.dev' . $url[0] . '/';
		array_push($checkArray, $editUrl);
	}
	// Define and restructure the arrays holding the csv values
	$csv = array_map('str_getcsv', file($list));
	$urls = $csv;
	$newArray = [];
	foreach ($urls as $url)
	{
		$editUrl = 'threeohone.dev' . $url[0];
		array_push($newArray, $editUrl);
	}
// Set counter to have iterations of the foreach match the index of the $check_list array
$counter = 0;

foreach ($newArray as $url) {
   
   $ch = curl_init();

   curl_setopt_array($ch, array(
       CURLOPT_URL => $url,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_RETURNTRANSFER => true,
   ));

   $result = curl_exec($ch);
   $final = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // <-- This is the final landing point of the redirect(s)
   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   echo $httpCode;
   if($httpCode == 404) {
   	echo "This threw a 404: " . $url;
   }
   if (!($final === $checkArray[$counter])){
   	echo 'End URL should be: ' . $newArray[$counter] . PHP_EOL . "But is actually returning: " . $checkArray[$counter] . PHP_EOL; 
   }
   curl_close($ch);
   $counter++;
}




















																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																	








































/*oreach ($newArray as $url) {
   	$ch = curl_init();
   	curl_setopt_array($ch, array(
       CURLOPT_URL => $url,
       CURLOPT_HEADER => true,
       CURLOPT_FOLLOWLOCATION => false,
       CURLOPT_RETURNTRANSFER => true,
   ));

   //$result = curl_exec($ch);
   $result = curl_getinfo($ch);
   var_dump($result);
   if (preg_match('#Location: (.*)#', $result, $r)) {
       $location = trim($r[1]);
       //var_dump($location); // <-- This is the destination of the redirect
   }

   curl_close($ch);
}*/

?>