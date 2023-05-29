<?php
require '../vendor/autoload.php'; // Certifique-se de ter instalado a biblioteca ReactPHP usando o Composer

use React\Promise\Promise;
use React\Promise\Deferred;

function tiktokdownload($url) {
    return new Promise(function($resolve, $reject) use ($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://ttdownloader.com/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            $reject(array('status' => false, 'message' => 'error fetch data', 'e' => $error));
        }

        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
        $cookies = array();
        foreach($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }

        $dataPost = array(
            'url' => $url,
            'format' => '',
            'token' => ''
        );

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($response);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        $tokenElement = $xpath->query('//*[@id="token"]')->item(0);
        if ($tokenElement) {
            $dataPost['token'] = $tokenElement->getAttribute('value');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://ttdownloader.com/search/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataPost));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Origin: https://ttdownloader.com',
            'Referer: https://ttdownloader.com/',
            'Cookie: ' . http_build_query($cookies, '', '; ')
        ));
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            $reject(array('status' => false, 'message' => 'error fetch data', 'e' => $error));
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($response);
        libxml_clear_errors();

        $result = array(
            'nowm' => null,
            'wm' => null,
            'audio' => null
        );

        $xpath = new DOMXPath($dom);

        $nowmNode = $xpath->query('//*[@id="results-list"]/div[1]/div[2]/a')->item(0);
        if ($nowmNode) {
            $result['nowm'] = $nowmNode->getAttribute('href');
        }

        $wmNode = $xpath->query('//*[@id="results-list"]/div[2]/div[2]/a')->item(0);
        if ($wmNode) {
            $result['wm'] = $wmNode->getAttribute('href');
        }

        $audioNode = $xpath->query('//*[@id="results-list"]/div[3]/div[2]/a')->item(0);
        if ($audioNode) {
            $result['audio'] = $audioNode->getAttribute('href');
        }
        
        $resolve($result);
    });
}


tiktokdownload($_POST['url'])
    ->then(function($result) {
        $url = $result['nowm'];
        if ($url) {
            $ch = curl_init($url);
            $fp = fopen('video.mp4', 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            echo 'Vídeo baixado com sucesso e salvo em video.mp4';
        } else {
            echo 'Nenhum vídeo disponível para download.';
        }
    })
    ->then(function() {
        
        header("Location: ./video.mp4");
        
    });
?>
