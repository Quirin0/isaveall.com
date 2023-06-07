<?php
// URL do vídeo a ser baixado
$url = $_POST['url'];

// Faz o download do vídeo e envia como resposta
readfile($url);