<?php

namespace Hub;

use Exception;

class Hub {

    public static $url;

    private static $curlUserAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36';

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

    public static function getTitle($html)
    {
        $title = '';
        if (preg_match('/<title[^>]*>(.*?)<\/title>/si', $html, $matches)) {
            $title = html_entity_decode(trim($matches[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        return $title;
    }

    public static function isTikTokURL($url)
    {
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }
        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'tiktok.com') !== false || strpos($host, 'vm.tiktok.com') !== false;
    }

    public static function isInstagramURL($url)
    {
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }
        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'instagram.com') !== false || strpos($host, 'instagr.am') !== false;
    }

    public static function isFacebookURL($url)
    {
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }
        $host = strtolower($parsedUrl['host']);
        return strpos($host, 'facebook.com') !== false || strpos($host, 'fb.watch') !== false;
    }

    /**
     * Cria um handle cURL com configurações padrão
     */
    private static function createCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_USERAGENT, self::$curlUserAgent);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        return $ch;
    }

    /**
     * Processa a URL e retorna JSON com os links de download
     * @param string $url
     */
    public static function processURL($url)
    {
        header('Content-Type: application/json');
        $msg = [];

        try {
            if (self::isTikTokURL($url)) {
                $result = self::tiktokdownload($url);
                $links = [];
                if (!empty($result['nowm'])) {
                    $links['Sem Marca d\'água'] = $result['nowm'] . '.mp4';
                }
                if (!empty($result['wm'])) {
                    $links['Com Marca d\'água'] = $result['wm'] . '.mp4';
                }
                if (!empty($result['audio'])) {
                    $links['Apenas Áudio'] = $result['audio'] . '.mp3';
                }
                if (empty($links)) {
                    throw new Exception('Não foi possível obter os links do TikTok. Tente novamente.');
                }
                $msg['success'] = true;
                $msg['id']      = '111';
                $msg['title']   = $result['title'] ?? 'TikTok';
                $msg['links']   = $links;

            } elseif (self::isInstagramURL($url)) {
                $result = self::instagramDownload($url);
                $msg['success'] = true;
                $msg['id']      = '222';
                $msg['title']   = 'Instagram';
                $msg['links']   = $result['links'];

            } elseif (self::isFacebookURL($url)) {
                $result = self::facebookDownload($url);
                $msg['success'] = true;
                $msg['id']      = self::generateId($url);
                $msg['title']   = $result['title'] ?? 'Facebook';
                $msg['links']   = $result['links'];

            } else {
                $msg['success'] = false;
                $msg['message'] = 'URL não suportada. Use links do TikTok, Instagram ou Facebook.';
            }
        } catch (Exception $e) {
            $msg['success'] = false;
            $msg['message'] = $e->getMessage();
        }

        echo json_encode($msg);
    }

    /**
     * Download do TikTok via API tikwm.com
     * @param string $url
     * @return array
     */
    public static function tiktokdownload($url)
    {
        $ch = self::createCurl('https://www.tikwm.com/api/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['url' => $url, 'hd' => 1]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Referer: https://www.tikwm.com/',
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($response === false || $httpCode !== 200) {
            throw new Exception('Falha ao conectar ao serviço do TikTok: ' . $error);
        }

        $data = json_decode($response, true);

        if (!$data || !isset($data['code']) || $data['code'] !== 0 || empty($data['data'])) {
            throw new Exception('Nenhum vídeo encontrado. Verifique o link do TikTok.');
        }

        return [
            'nowm'  => $data['data']['play']   ?? '',
            'wm'    => $data['data']['wmplay']  ?? '',
            'audio' => $data['data']['music']   ?? '',
            'title' => $data['data']['title']   ?? 'TikTok',
        ];
    }

    /**
     * Download do Instagram via scraping da página
     * @param string $url
     * @return array
     */
    public static function instagramDownload($url)
    {
        if (!preg_match('/instagram\.com\/(reel|p|tv)\/([A-Za-z0-9_-]+)/', $url, $matches)) {
            throw new Exception('URL do Instagram inválida. Use links de posts (/p/) ou reels (/reel/).');
        }

        $type      = $matches[1];
        $shortcode = $matches[2];
        $cleanUrl  = "https://www.instagram.com/{$type}/{$shortcode}/";

        $ch = self::createCurl($cleanUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.5',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'Sec-Fetch-Dest: document',
            'Sec-Fetch-Mode: navigate',
            'Sec-Fetch-Site: none',
            'Sec-Fetch-User: ?1',
            'Upgrade-Insecure-Requests: 1',
        ]);
        $html     = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($html === false || $httpCode === 0) {
            throw new Exception('Falha ao conectar ao Instagram.');
        }

        $links = [];

        // Tenta JSON-LD (funciona para posts públicos)
        if (preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $m)) {
            $ld = json_decode($m[1], true);
            if ($ld && isset($ld['contentUrl'])) {
                $mediaType = isset($ld['@type']) && $ld['@type'] === 'VideoObject' ? 'video' : 'image';
                if ($mediaType === 'video') {
                    $links['Vídeo HD'] = $ld['contentUrl'] . '.mp4';
                } else {
                    $links['Imagem HD'] = $ld['contentUrl'];
                }
            }
        }

        // Tenta extrair video_url do JSON embutido na página
        if (empty($links)) {
            if (preg_match('/"video_url"\s*:\s*"(https:[^"]+)"/', $html, $m)) {
                $links['Vídeo HD'] = self::cleanStr($m[1]) . '.mp4';
            }
        }

        // Tenta extrair display_url para imagens
        if (empty($links)) {
            if (preg_match('/"display_url"\s*:\s*"(https:[^"]+)"/', $html, $m)) {
                $links['Imagem HD'] = self::cleanStr($m[1]);
            }
        }

        // Tenta extrair da tag og:video ou og:image como fallback
        if (empty($links)) {
            if (preg_match('/<meta property="og:video" content="([^"]+)"/', $html, $m)) {
                $links['Vídeo'] = html_entity_decode($m[1], ENT_QUOTES) . '.mp4';
            } elseif (preg_match('/<meta property="og:image" content="([^"]+)"/', $html, $m)) {
                $links['Imagem'] = html_entity_decode($m[1], ENT_QUOTES);
            }
        }

        if (empty($links)) {
            throw new Exception('Não foi possível extrair o conteúdo. O Instagram pode exigir login para este post.');
        }

        return ['links' => $links];
    }

    /**
     * Download do Facebook via scraping com múltiplos padrões de regex
     * @param string $url
     * @return array
     */
    public static function facebookDownload($url)
    {
        $ch = self::createCurl($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.9',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'Sec-Fetch-Dest: document',
            'Sec-Fetch-Mode: navigate',
            'Sec-Fetch-Site: none',
            'Sec-Fetch-User: ?1',
            'Upgrade-Insecure-Requests: 1',
        ]);
        $html     = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($html === false || $httpCode === 0) {
            throw new Exception('Falha ao conectar ao Facebook: ' . $error);
        }

        $links  = [];
        $title  = self::getTitle($html);

        // Padrões HD
        $hdPatterns = [
            '/playable_url_quality_hd["\\\\]+\s*:\s*["\\\\]+(https:[^"\\\\]+)/',
            '/browser_native_hd_url["\\\\]+\s*:\s*["\\\\]+(https:[^"\\\\]+)/',
            '/"hd_src"\s*:\s*"(https:[^"]+)"/',
            '/hd_src_no_ratelimit":"([^"]+)"/',
        ];

        foreach ($hdPatterns as $pattern) {
            if (preg_match($pattern, $html, $m)) {
                $links['Vídeo HD'] = self::cleanStr($m[1]);
                break;
            }
        }

        // Padrões SD
        $sdPatterns = [
            '/playable_url["\\\\]+\s*:\s*["\\\\]+(https:[^"\\\\]+)/',
            '/browser_native_sd_url["\\\\]+\s*:\s*["\\\\]+(https:[^"\\\\]+)/',
            '/"sd_src"\s*:\s*"(https:[^"]+)"/',
            '/sd_src_no_ratelimit":"([^"]+)"/',
        ];

        foreach ($sdPatterns as $pattern) {
            if (preg_match($pattern, $html, $m)) {
                $links['Vídeo SD'] = self::cleanStr($m[1]);
                break;
            }
        }

        if (empty($links)) {
            throw new Exception('Nenhum vídeo encontrado. O vídeo pode ser privado ou o Facebook pode estar bloqueando a requisição.');
        }

        return ['title' => $title, 'links' => $links];
    }
}
?>
