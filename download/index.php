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
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['down'])){
         // Obter a URL do campo 'down'
         $url = $_GET['down'];
         echo $url; 
    }
}