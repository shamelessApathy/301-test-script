<?php
	
	$list = $argv[1];
	$csv = array_map('str_getcsv', file($list));
	$urls = $csv;
	/*foreach ($csv as $line){
		
		$parsedValue = $line[0];
		$uri = 'http://threeohone.dev' . $parsedValue;
		$file = file_get_contents($uri);
		if ($file){
			echo 'it worked';
		}
		if (strpos($file, '404')){
			echo '404 found!';
		}
	}*/

	foreach ($urls as $url) {
   	$ch = curl_init();
   	curl_setopt_array($ch, array(
       CURLOPT_URL => $url[0],
       CURLOPT_HEADER => true,
       CURLOPT_FOLLOWLOCATION => false,
       CURLOPT_RETURNTRANSFER => true,
   ));

   $result = curl_exec($ch);
   var_dump($result);
   if (preg_match('#Location: (.*)#', $result, $r)) {
       $location = trim($r[1]);
       var_dump($location); // <-- This is the destination of the redirect
   }

   curl_close($ch);
}

?>