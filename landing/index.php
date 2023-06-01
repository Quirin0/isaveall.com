<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.instagram.com/reel/CsJcnPjt53g/?__a=1&__d=dis',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_USERAGENT => 'PostmanRuntime/7.32.2',
  
));

$response = curl_exec($curl);

curl_close($curl);

// $array = json_decode($response);
// echo $array->graphql->;
echo "<pre>";
print_r(json_decode($response));
echo "</pre>";
