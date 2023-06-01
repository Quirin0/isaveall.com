<?php
$url = "https://www.instagram.com/reel/CsJcnPjt53g/?__a=1&__d=dis";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36');

$response = curl_exec($ch);

if ($response === false) {
    echo "Falha ao fazer a requisição.";
} else {
    echo $response;
}

curl_close($ch);
?>
