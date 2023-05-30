<?php
// URL do vídeo a ser baixado
$url = $_GET['url'];
$format= $_GET['format'];

// Obtém o nome do arquivo
$fileName = "NwTik - Tiktokdownloader" . "." . $format;

// Define o cabeçalho para iniciar o download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $fileName);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($url));

// Faz o download do vídeo e envia como resposta
readfile($url);