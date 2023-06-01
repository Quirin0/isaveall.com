<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.instagram.com/reel/CsJcnPjt53g/?__a=1&__d=dis',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36'),
  CURLOPT_HTTPHEADER => array(
    'Cookie: csrftoken=OsosgC3yUIFKwLyra4uEVPK2kZw93CgE; ig_did=6CD51340-2BFE-4DE9-990F-CC59F11EAC50; ig_nrcb=1; mid=ZHgWFQAEAAFSKu1JqwYoUHEuX4Uk'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
