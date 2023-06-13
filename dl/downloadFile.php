<?php
// URL do vídeo a ser baixado
$url = $_POST['url'];
//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header('Content-Disposition: attachment; filename="'.basename($url).'"');
header('Content-Length: ' . filesize($url));
header('Pragma: public');

//Clear system output buffer
flush();
// Faz o download do vídeo e envia como resposta
readfile($url);