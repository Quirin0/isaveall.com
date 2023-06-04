<?php

namespace Hub;

use React\Promise\Promise;
use React\Promise\Deferred;
use DOMDocument;
use DOMXPath;
use Phpfastcache\Helper\Psr16Adapter;
use InstagramScraper\Instagram;

class Hub {

    public static $url;

    public static function setUrl($url) {
        self::$url = $url;
    }
    
    public static function processURL($url)
    {
        if (self::isTikTokURL($url)) {
            self::setUrl($url);
            $response = self::tiktokdownload($url);
            
            $response->then(function ($resultado) {
                // Capturar os valores de "nowm", "wm" e "audio" em um array
                $urls = [
                    'nowm' => $resultado['nowm'],
                    'wm' => $resultado['wm'],
                    'audio' => $resultado['audio']
                ];
                //TODO: Corrigir a variavel $selectedType para o tipo que o usuario escolher
                $selectedType = $urls['nowm'];
    
                $format = $selectedType == $urls['audio'] ? '.mp3' : '.mp4';
        
                // Obtém o nome do arquivo
                $fileName = "NwTik - UniversalHub Downloader" . $format;
        
                // Define o cabeçalho para iniciar o download
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . $fileName);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($selectedType));
        
                // Faz o download do vídeo e envia como resposta
                readfile($selectedType);
                
            })->done();

        } elseif (self::isInstagramURL($url)) {
            // If account is public you can query Instagram without auth
            $instagram = new Instagram(new \GuzzleHttp\Client());
            // If account is private and you subscribed to it, first login
            $instagram  = Instagram::withCredentials(new \GuzzleHttp\Client(), '', '', null);
            $instagram->loginWithSessionId('9157536476%3AUXT8DS2ksXPkWN%3A0%3AAYcrOcEZjuC0Mx-zMcgjDa_coZ3B5D-9uFh4udJ_6g');

            // Trata a Url para remover as informações após o código do reels
            $string = $url;
            $pattern = "/(https:\/\/www.instagram.com\/reel\/[^\/]+).*/";
            $replacement = "$1";
            $url = preg_replace($pattern, $replacement, $string);

            $media = $instagram->getMediaByUrl($url);
            $response = $media->getVideoStandardResolutionUrl();

            try {
                $selectedType = $response;
    
                $format = $selectedType == $response ? '.mp4' : '.mp3';
        
                // Obtém o nome do arquivo
                $fileName = "NwTik - UniversalHub Downloader" . $format;
        
                // Define o cabeçalho para iniciar o download
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . $fileName);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($selectedType));
        
                // Faz o download do vídeo e envia como resposta
                readfile($selectedType);
            } catch (\Throwable $th) {
                echo $th;
            }
        } else {
            // URL inválida ou de outra plataforma
            echo "alert('URL inválida ou de outra plataforma.')";
            // header('Location: /');
        }
    }

    private static function isTikTokURL($url)
    {
        // Implemente a lógica para verificar se a URL é do TikTok
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'tiktok.com') !== false || strpos($host, 'tiktok.com') !== false;
    }

    private static function isInstagramURL($url)
    {
        // Implemente a lógica para verificar se a URL é do Instagram
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'instagram.com') !== false || strpos($host, 'instagr.am') !== false;
    }

    /**
     * Método responsável por baixar um video do TikTok
     * @param string $url 
     * @return Promise Uma promessa que será resolvida com o caminho do arquivo baixado ou rejeitada com uma mensagem de erro.
     */
    public static function tiktokdownload($url) {
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
  }
  ?>