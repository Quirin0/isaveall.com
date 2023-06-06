<?php
session_start();

require_once '../vendor/autoload.php';
require_once '../src/Hub.php';

// Incluir o arquivo que contém a classe Hub
use Hub\Hub;
use React\Promise\Promise;

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o campo 'url' está definido no formulário
    if (isset($_POST['url'])) {
        // Obter a URL do campo 'url'
        $url = $_POST['url'];
        // Verificar de qual plataforma é a URL
        Hub::processURL($url);        
    }
    if (isset($_POST['link'])) {
        $url = $_POST['link'];
        $format = $_POST['format'];
        try {
            // Obtém o nome do arquivo
            $fileName = "nwtik-hubdownloader" . $format;
    
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
        } catch (\Throwable $th) {
            echo $th;    
        }
    }
}
