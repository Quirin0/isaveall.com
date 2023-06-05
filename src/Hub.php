<?php

namespace Hub;

use React\Promise\Promise;
use React\Promise\Deferred;
use DOMDocument;
use DOMXPath;
use Phpfastcache\Helper\Psr16Adapter;
use InstagramScraper\Instagram;
use Exception;
use Symfony\Component\HttpClient\HttpClient;

class Hub {

    public static $url;

    public static function setUrl($url) {
        self::$url = $url;
    }
    
    public static function generateId($url)
    {
        $id = '';
        if (is_int($url)) {
            $id = $url;
        } elseif (preg_match('#(\d+)/?$#', $url, $matches)) {
            $id = $matches[1];
        }

        return $id;
    }

    public static function cleanStr($str)
    {
        $tmpStr = "{\"text\": \"{$str}\"}";

        return json_decode($tmpStr)->text;
    }

    public static function getHDLink($curl_content)
    {
        $regexRateLimit = '/playable_url_quality_hd":"([^"]+)"/';

        if (preg_match($regexRateLimit, $curl_content, $match)) {
            return self::cleanStr($match[1]);
        } else {
            return false;
        }
    }

    public static function getTitle($curl_content)
    {
        $title = null;
        if (preg_match('/<title>(.*?)<\/title>/', $curl_content, $matches)) {
            $title = $matches[1];
        } elseif (preg_match('/title id="pageTitle">(.+?)<\/title>/', $curl_content, $matches)) {
            $title = $matches[1];
        }

        return self::cleanStr($title);
    }

    public static function getDescription($curl_content)
    {
        if (preg_match('/span class="hasCaption">(.+?)<\/span>/', $curl_content, $matches)) {
            return self::cleanStr($matches[1]);
        }

        return false;
    }    

    public static function isTikTokURL($url)
    {
        // Implemente a lógica para verificar se a URL é do TikTok
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'tiktok.com') !== false || strpos($host, 'tiktok.com') !== false;
    }

    public static function isInstagramURL($url)
    {
        // Implemente a lógica para verificar se a URL é do Instagram
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'instagram.com') !== false || strpos($host, 'instagr.am') !== false;
    }

    public static function isFacebookURL($url)
    {
        // Implemente a lógica para verificar se a URL é do Facebook
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'facebook.com') !== false || strpos($host, 'm.facebook.com') !== false;
    }
    
    /**
     * Método responsável por processar de qual plataforma a url se trata, e também processar se é um video ou uma imagem
     * Logo em seguida iniciar o download (TODO: corrigir para retornar as opções de Video, imagem ou Audio, para que o usuario escolha qual quer baixar. )
     * @param string $url
     */
    public static function processURL($url)
    {
        if (self::isTikTokURL($url)) {
            self::setUrl($url);
            $response = self::tiktokdownload($url);
            $msg = [];
            $response->then(function ($resultado) {
                // Capturar os valores de "nowm", "wm" e "audio" em um array
                $urls = [
                    'No Watermark'   => $resultado['nowm'] . '.mp4',
                    'With Watermark' => $resultado['wm']   . '.mp4',
                    'Audio'          => $resultado['nowm'] . '.mp3'
                ];
                
                $msg['success'] = true;
                
                $msg['id'] = "111";
                $msg['title'] = "Tiktok";
                $msg['links'] = $urls;
                echo json_encode($msg);
                
            })->done();


        } elseif (self::isInstagramURL($url)) {
            $msg = [];
            // If account is private and you subscribed to it, first login
            $instagram  = Instagram::withCredentials(new \GuzzleHttp\Client(), '', '', null);
            $instagram->loginWithSessionId('9157536476%3AUXT8DS2ksXPkWN%3A0%3AAYcrOcEZjuC0Mx-zMcgjDa_coZ3B5D-9uFh4udJ_6g');

            // Trata a Url para remover as informações após o código do reels ou imagem
            if (preg_match('/https:\/\/www.instagram.com\/(?:reel|p)\/[^\/]+/', $url, $matches)) {
                $url = $matches[0];
                $media = $instagram->getMediaByUrl($url);
                if (strpos($url, '/p/') !== false) {
                    // Se a URL contém '/p/', executar o método getImageHighResolutionUrl()
                    try {
                        $highRes = $media->getImageHighResolutionUrl();
                        $lowRes  = $media->getImageStandardResolutionUrl();
                        $urls  = [
                            'Full HD Image'        => $highRes,
                            'Low Resolution Image' => $lowRes 
                        ];
                        $msg['success'] = true;
                        $msg['id']      = "222";
                        $msg['title']   = 'Instagram';
                        $msg['links']   = $urls;
                        echo json_encode($msg);
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                } elseif (strpos($url, '/reel/') !== false) {
                    // Se a URL contém '/reel/', executar o método getVideoStandardResolutionUrl()
                    try {
                        $highRes = $media->getVideoStandardResolutionUrl();
                        $lowRes  = $media->getVideoLowResolutionUrl();
                        $urls = [
                            'Full HD Video' => $highRes . '.mp4',
                            'Hd Video'      => $lowRes  . '.mp4',
                            'Audio HD'      => $highRes . '.mp3',
                            'Audio SD'      => $lowRes  . '.mp3',
                        ];
                        $msg['success'] = true;
                        $msg['id']      = "333";
                        $msg['title']   = 'Instagram';
                        $msg['links']   = $urls;
                        echo json_encode($msg);
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                }
            }
        } elseif(self::isFacebookURL($url)) {
            self::setUrl($url);
            try {
                header('Content-Type: application/json');
    
                $msg = [];
                $headers = [
                    'sec-fetch-user'            => '?1',
                    'sec-ch-ua-mobile'          => '?0',
                    'sec-fetch-site'            => 'none',
                    'sec-fetch-dest'            => 'document',
                    'sec-fetch-mode'            => 'navigate',
                    'cache-control'             => 'max-age=0',
                    'authority'                 => 'www.facebook.com',
                    'upgrade-insecure-requests' => '1',
                    'accept-language'           => 'en-GB,en;q=0.9,tr-TR;q=0.8,tr;q=0.7,en-US;q=0.6',
                    'sec-ch-ua'                 => '"Google Chrome";v="89", "Chromium";v="89", ";Not A Brand";v="99"',
                    'user-agent'                => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
                    'accept'                    => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                    'cookie'                    => 'sb=Rn8BYQvCEb2fpMQZjsd6L382; datr=Rn8BYbyhXgw9RlOvmsosmVNT; c_user=100003164630629; _fbp=fb.1.1629876126997.444699739; wd=1920x939; spin=r.1004812505_b.trunk_t.1638730393_s.1_v.2_; xs=28%3A8ROnP0aeVF8XcQ%3A2%3A1627488145%3A-1%3A4916%3A%3AAcWIuSjPy2mlTPuZAeA2wWzHzEDuumXI89jH8a_QIV8; fr=0jQw7hcrFdas2ZeyT.AWVpRNl_4noCEs_hb8kaZahs-jA.BhrQqa.3E.AAA.0.0.BhrQqa.AWUu879ZtCw',
                ];


                $client = HttpClient::create([
                    'headers' => $headers,
                ]);

                $response = $client->request('GET', $url);

                $data = $response->getContent();

                $msg['success'] = true;

                $msg['id'] = self::generateId($url);
                $msg['title'] = self::getTitle($data);

                if ($hdLink = self::getHDLink($data)) {
                    $msg['links']['Video High Quality'] = $hdLink . '.mp4';
                    $msg['links']['Audio High Quality'] = $hdLink . '.mp3';
                }
                } catch (Exception $e) {
                    $msg['success'] = false;
                    $msg['message'] = $e->getMessage();
                }

                echo json_encode($msg);

        }
        else{
            $msg['success'] = false;
            $msg['message'] = "No video or image found. Try again";
            echo json_encode($msg);
        }
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