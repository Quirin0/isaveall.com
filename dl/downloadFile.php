<?php
$url = isset($_POST['url']) ? trim($_POST['url']) : '';

if (empty($url) || filter_var($url, FILTER_VALIDATE_URL) === false) {
    http_response_code(400);
    exit('URL inválida.');
}

// Determina o nome do arquivo a partir da URL
$parsedUrl = parse_url($url);
$pathParts = pathinfo($parsedUrl['path'] ?? '');
$ext       = !empty($pathParts['extension']) ? '.' . $pathParts['extension'] : '.mp4';
$filename  = 'download' . $ext;

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: public');
header('Expires: 0');
header('Content-Disposition: attachment; filename="' . $filename . '"');

flush();

// Usa cURL para fazer stream do arquivo remoto sem armazenar em memória
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36');
curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($ch, $data) {
    echo $data;
    return strlen($data);
});
curl_exec($ch);
curl_close($ch);
