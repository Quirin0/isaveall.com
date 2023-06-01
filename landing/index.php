<?php
$url = "https://www.instagram.com/reel/CsJcnPjt53g/?__a=1&__d=dis";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo "Falha ao fazer a requisição.";
} else {
    echo $response;
}

curl_close($ch);
?>
