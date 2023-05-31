<?php
require '../vendor/autoload.php'; // Certifique-se de ter instalado a biblioteca ReactPHP usando o Composer

use React\Promise\Promise;
use React\Promise\Deferred;
tiktokdownload($_POST['url'])
    ->then(function($result) {
        $url = $result['nowm'];
        $url2 = $result['wm'];
        $audio = $result['wm'];
        $_SESSION['nowm'] = $url;
        $_SESSION['wm']   = $url2;
        $_SESSION['audio']= $audio;
        if (!$url && !$audio && !$url2) {
            echo 'alert("Invalid link.")';
            header("Location: /");
        }
    });
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DPX5XTJG1D"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-DPX5XTJG1D');
</script>
<!-- SEO -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Tiktok Downloader - Download Video TikTok Without Watermark - NwTik</title>
<meta name="robots" content="index, follow" />
<meta name="revisit-after" content="1 days" />
<meta name="viewport" content='width=device-width, initial-scale=1.0, maximum-scale=5, shrink-to-fit=no' />
<meta name="color-scheme" content="dark light">
<meta itemprop="name" content="Tiktok Downloader - Download Video TikTok Without Watermark - NwTik">
<meta name="description" content="TikTok Video Downloader - NwTik.com is one of the best free Download video Tiktok No Watermark tool available online. You can download TikTok video from any device you have.">
<meta name="author" content="Admin" />
<meta itemprop="image" content="https://NwTik.com/assets/img/snapthumb.jpg">
<meta name="google" content="translate" />
<!-- TWITTER -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Tiktok Downloader - Download Video tiktok Without Watermark - NwTik">
<meta name="twitter:description" content="TikTok Video Downloader - NwTik.com is one of the best free Download video Tiktok No Watermark tool available online. You can download TikTok video from any device you have.">
<meta name="twitter:image:src" content="https://NwTik.com/assets/img/snapthumb.jpg">
<meta name="twitter:site" content="NwTik.com">
<!-- OG -->
<meta property="og:locale" content="en" /> <meta name="msvalidate.01" content="1E856EC97F6E089FF79520F154CCFD0F" />
<meta property="og:title" content="Tiktok Downloader - Download Video tiktok Without Watermark - NwTik">
<meta property="og:type" content="article">
<meta property="og:image" content="https://NwTik.com/assets/img/snapthumb.jpg">
<meta property="og:description" content="TikTok Video Downloader - NwTik.com is one of the best free Download video Tiktok No Watermark tool available online. You can download TikTok video from any device you have.">
<meta property="og:site_name" content="NwTik.com">
<link rel="apple-touch-icon" sizes="192x192" href="https://NwTik.com/img/icons-192.png">
<link rel="shortcut icon" href="https://NwTik.com/assets/img/favicon.png" />
<link rel="alternate" hreflang="x-default" href="https://NwTik.com/" />
<link rel="alternate" hreflang="en" href="https://NwTik.com/" />
<link rel="alternate" hreflang="en-in" href="https://NwTik.com/in">
<link rel="alternate" hreflang="vi" href="https://NwTik.com/vn" />
<link rel="alternate" hreflang="tr" href="https://NwTik.com/tr" />
<link rel="alternate" hreflang="id-ID" href="https://NwTik.com/ID" />
<link rel="alternate" hreflang="fr" href="https://NwTik.com/fr" />
<link rel="alternate" hreflang="pt" href="https://NwTik.com/pt" />
<link rel="alternate" hreflang="ru" href="https://NwTik.com/ru" />
<link rel="alternate" hreflang="es" href="https://NwTik.com/es" />
<link rel="alternate" hreflang="ms" href="https://NwTik.com/ms" />
<link rel="alternate" hreflang="ko" href="https://NwTik.com/ko" />
<link rel="alternate" hreflang="ja" href="https://NwTik.com/ja" />
<link rel="alternate" hreflang="jv" href="https://NwTik.com/jv" />
<link rel="alternate" hreflang="cs" href="https://NwTik.com/cs" />
<link rel="alternate" hreflang="de" href="https://NwTik.com/de" />
<link rel="alternate" hreflang="it" href="https://NwTik.com/it" />
<link rel="alternate" hreflang="pl" href="https://NwTik.com/pl" />
<link rel="alternate" hreflang="hu" href="https://NwTik.com/hu" />
<link rel="alternate" hreflang="nl" href="https://NwTik.com/nl" />
<link rel="alternate" hreflang="ro" href="https://NwTik.com/ro" />
<link rel="alternate" hreflang="el" href="https://NwTik.com/el" />
<link rel="canonical" href="https://NwTik.com/" />
<link rel="preconnect" href="//www.google-analytics.com" crossorigin>
<link rel="dns-prefetch" href="//www.google-analytics.com">
<link rel="preconnect" href="//ssl.google-analytics.com" crossorigin>
<link rel="dns-prefetch" href="//ssl.google-analytics.com">
<link rel="preconnect" href="//pagead2.googlesyndication.com" crossorigin>
<link rel="preconnect" href="https://adservice.google.com" crossorigin />
<link rel="preconnect" href="https://partner.googleadservices.com" crossorigin />
<link rel="preconnect" href="https://tpc.googlesyndication.com" crossorigin />
<link rel="stylesheet" href="../assets/css/style.css">

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/faa9bc7328.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">


</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
  <a href="https://NwTik.com/" class="navbar-brand fs24 fw700 align-items-center" title="TikTok Downloader" style="color:#4B2570; font-size:28px">Nw<span style="color:black;">Tik</span></a>
    
    <div role="button" class="navbar-burger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="https://www.paypal.com/donate/?business=CMZFVZ6ETHGLQ&no_recurring=0&item_name=Hey%2C+thank+you+for+donation+%3C3&currency_code=BRL">Donate</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<div class="d-flex align-items-center justify-content-center ">
  <div id="download" class="download p-5">
    <div class="video-links" style="display:contents;">
      <a href="download.php?url=<?=$_SESSION['nowm']?>&format=mp4" class="button download-file">
        <i class="icon icon-down"></i>No Watermark Video MP4
      </a>
      <a href="download.php?url=<?=$_SESSION['wm']?>&format=mp4" class="button download-file is-secondary mt-3">
        With Watermark MP4
      </a>
      <a href="download.php?url=<?=$_SESSION['audio']?>&format=mp3" class="button is-black mt-3">Audio</a>
    </div>
  </div>
</div>


<footer class="footer">
<div class="container">

<div class="copyright"><span>© 2023 - 2023 NwTik - <a href="/">TikTok Video Download</a> Version 1.0</span></div>
<p class="footer-menu">
<a href="https://NwTik.com/landing/terms-of-service" rel="nofollow">Terms of Service</a> | <a href="https://NwTik.com/landing/privacy-policy" rel="nofollow">Privacy Policy</a>
</p>
</div>
</footer>


<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3869138732972987"
     crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


