<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'includes/head.php' ?>
</head>
<body>

<?php include 'includes/nav.php' ?>


<section id="hero" class="section hero">
<div class="container w100">
 
<h1 class="title"><p>Download <span class="typed-text"></span><span class="cursor">&nbsp;</span></p></h1>

<h2 class="text-center text-white title-2">Fast, Easy and for All devices.</h2>

<form class="form pb-2" name="formurl" method="post" action="">
  <div class="message">
    <div class="message-body"></div>
  </div>
  <div class="is-relative" style="overflow: hidden;width: 100%;">
    <input name="url" id="link" type="text" class="link-input" value="" placeholder="Paste TikTok or Reels Here." required="" aria-label="Name" autocomplete="off" autocapitalize="none">
    <button class="button button-paste" id="pasteButton" type="button" onclick="togglePasteButton()"><i class="fas fa-clipboard" style="margin-right: 5px;"></i><span>Paste</span></button>
  </div>
  <style>
    @keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.02);
  }
  100% {
    transform: scale(1);
  }
}

.pulse-animation {
  animation: pulse 1.5s infinite;
}
  </style>
  <!-- <i class='fas fa-cloud-download-alt'></i> -->
  <input type="button" name="download" id="download" value="Download" class="button button-go is-link pulse-animation" onclick="getDownloadLink();">
    
</form>
<div class="mt-3" id="result" style="display: none;">
    <div id="downloadUrl">
        <div class="row">
            <div class="col-md-12 mt-1">
                <div class="d-flex text-white" style="border-radius: 0.375rem;margin-bottom: 1rem;font-weight:700;"><div id="title"></div>&nbsp;Download:</div>
                <div class="d-flex align-items-center justify-content-center ">
                    <div id="links" class="video-links" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

</div>
</section>
<section id="main" class="section">
<div class="container">

<div id="download" class="download"></div>
<div class="contents">
<section class="container mt-1">
<h3 class="text-center ">Download Anything for FREE</h3>
<br>
<p><b>Nwtik.com</b> is one of the best Hub Downloader <b>TikTok Without Watermark, Instagram Reels, Instagram Images</b>, Anything you want you can download here. You are not required to install any software on your computer or mobile phone, all that you need is the plataform link, and all the processing is done on our side so you can be <b>one click</b> away from downloading to your devices.</p>
<h4 class="subtitle f14 mb-3">Key features:</h4>
<ul>
<li>No watermark for better quality, which most of the tools out there can't.</li>
<li>Download TikTok videos on any devices that you want: mobile, PC, or tablet. TikTok only allows users to download videos by its application and downloaded videos contain the watermark.</li>
<li>Download Instagram Reels in the best quality.</li>
<li>Download Instagram Images in high resolution.</li>
<li>Download by using your browsers: I want to keep things simple for you. No need to download or install any software. I make an application for this purpose as well but you can only install whenever you like.</li>
<li>It's always free. I only place some ads, which support maintaining our services, and further development.</li> <li>New NwTik provides users with the ability to download Tiktok's photo slide show as Mp4 Video format. The images and music in the Tiktok slide show will be automatically merged by NwTik. In addition, you can also download each image in the slide show to your computer right away.</li> </ul>
<br>
</section>
<section class="container mt-1">
  <h3 class="text-center font-weight-600">How to Use Nwtik Video Downloader</h3>
  <div class="row text-left">
    <div class="col-md-4 mt-4 mx-0 pr-md-4">
      <h5>Find the link of media you want</h5>
      <p class="text-muted">Open TikTok or Instagram and find share button, copy the link and go for next step.</p>
    </div>
    <div class="col-md-4 mt-4 mx-0">
      <h5>Paste the video URL</h5>
      <p class="text-muted">Paste the video URL to the input box and click the "Download" button.</p>
    </div>
    <div class="col-md-4 mt-4 mx-0 pl-md-4">
      <h5>Download the Video or Audio</h5>
      <p class="text-muted">Click the "Download" buttons to save the video or audio.</p>
    </div>
  </div>
</section>
<div class="accordion" id="faq" itemscope="" itemtype="https://schema.org/FAQPage">
  <div class="accordion-item" itemprop="mainEntity" itemscope="" itemtype="https://schema.org/Question">
    <h2 class="accordion-header" id="question1">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer1" aria-expanded="false" aria-controls="answer1">
        How to Download Tiktok Video Without Watermark?
      </button>
    </h2>
    <div id="answer1" class="accordion-collapse collapse " aria-labelledby="question1" data-bs-parent="#faq">
      <div class="accordion-body">
        <ul class="list-unstyled">
          <li>Open Tik Tok app on your phone/or Web on your browser.</li>
          <li>Choose whatever video you want to download.</li>
          <li>Click to the Share button at the right bottom.</li>
          <li>Click the Copy Link button.</li>
          <li>Download by using your browsers: I want to keep things simple for you. No need to download or install any software. I make an application for this purpose as well but you can only install whenever you like.</li>
          <li>Go back to NwTik.com and paste your download link to the field above then click to the Download button.</li>
          <li>Wait for our server to do its job and then, save the video to your device.</li>
        </ul>
      </div>
    </div>
  <!-- Rest of the accordion items go here -->
</div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        How to get the TikTok Video Download Link?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <ul class="list-unstyled">
          <li>Open your TikTok application</li>
          <li>Choose the TikTok video that you want to download</li>
          <li>Click Share and at the Share options, find Copy Link button</li>
          <li>Your download URL is ready on the clipboard.</li>
        </ul>
        <div class="example">
          <b>For example, the link would look like this:</b>
          <div class="link-example">https://v.douyin.com/UFLNjnh/</div>
          <div class="link-example">https://www.tiktok.com/@philandmore/video/6805867805452324102</div>
          <div class="link-example">https://m.tiktok.com/v/6805867805452324102.html</div>
          and more...
        </div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Where are TikTok videos saved after being downloaded?
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        When you're downloading files, they are usually saved into whatever folder you have set as your default. Your browser normally sets this folder for you. In browser settings, you can change and choose manually the destination folder for your downloaded TikTok videos.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Is the service provided by this site free?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
         Yes. It is totally free. Users have to make sure that you have a permission from the video owner to download the video. Our site does not store and keep any videos from the TikTok.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFour">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        Is there a limitation on the numbers of videos downloaded?
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        No. You can download videos as many as you like.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFive">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        Which devices are suported?
      </button>
    </h2>
    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Any devices that can run the popular browsers such as Chrome, IE, Safari, Firefox are supported to use our service.
      </div>
    </div>
  </div>
</div>

<p>NwTik respects the intellectual property rights of the tracks so NwTik will not provide this solution. However, there are currently quite a few application websites that provide this Tiktok Mp3 service such as <b>Tikmate</b>, <b>SaveTik.Net</b>, <b>SSStiktok</b>, etc. You can download TikTok mp3 music but are not allowed to use it for commercial activities, monetize it.</p>
<p><b>Note:</b> NwTik (<i>Tiktok video Downloader</i>) is not a tool of Tiktok, we have no relationship with Tiktok or ByteDance Ltd. We only support Tiktok users to download our videos on Tiktok without logo without any trouble. If you have problems with sites like Tikmate or SSSTiktok, try NwTik, we are constantly updating to make it easy for users to download tiktok videos. Thank you!</p>
</div>
</div>
</div>
</div>
</section>
<?php include 'includes/footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3869138732972987"
     crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/typedText.js"></script>
<script src="assets/js/downloadFile.js"></script>
<script src="assets/js/getDownloadLink.js"></script>
<script src="assets/js/pasteFromClipboard.js"></script>


</body>
</html>