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
		$editUrl = 'http://dev.venthoodpro.com' . $url[0] . '/';
		array_push($checkArray, $editUrl);
	}
	// Define and restructure the arrays holding the csv values
	$csv = array_map('str_getcsv', file($list));
	$urls = $csv;
	$newArray = [];
	foreach ($urls as $url)
	{
		$editUrl = 'http://dev.venthoodpro.com' . $url[0];
		array_push($newArray, $editUrl);
	}
// Set counter to have iterations of the foreach match the index of the $check_list array
  $array_length = count($newArray);
  if (isset($argv[3]))
  {
$counter = $argv[3];;
}
else
{
  $counter = 0;
}

for ($counter = $counter; $counter < $array_length; $counter++) {
   $ch = curl_init();

   curl_setopt_array($ch, array(
       CURLOPT_URL => $newArray[$counter],
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_RETURNTRANSFER => true,
   ));
   $result = curl_exec($ch);
   $final = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // <-- This is the final landing point of the redirect(s)
   var_dump($final);
   echo "$counter\r\n";
   while(substr($final, -1) === '/')
   {
    $final = substr($final, 0,-1);
   }
   while(substr($checkArray[$counter], -1) === '/')
   {
    $checkArray[$counter] = substr($checkArray[$counter], 0, -1);
   }
   while(substr($final, -1) === ' ')
   {
    array_pop($final);
   }
   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   $msg = "This threw a 404: " . "$newArray[$counter]\r\n";
   if($httpCode == 404) {
   	file_put_contents('404.txt', $msg, FILE_APPEND);
   }
   if (!($final === $checkArray[$counter])){
   	$msg = 'URL to redirect: ' . $newArray[$counter] . PHP_EOL . 'End URL should be:|'.$checkArray[$counter].'|'. PHP_EOL . "But is actually returning:|".$final.'|'.PHP_EOL . 'counter iteration:' . $counter . PHP_EOL . '           ' . PHP_EOL;
    file_put_contents('errors.txt', $msg, FILE_APPEND) ;
   }
   curl_close($ch);
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
