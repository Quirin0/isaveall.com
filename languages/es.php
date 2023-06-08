<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php include '../includes/head.php' ?>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/nav.php' ?>


<section id="hero" class="section hero">
<div class="container w100">
 
<h1 class="title"><p>Download <span class="typed-text"></span><span class="cursor">&nbsp;</span></p></h1>

<h2 class="text-center text-white title-2">Rápido, fácil y compatible con todos los dispositivos.</h2>

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
<h3 class="text-center ">Descarga cualquier contenido multimedia de forma gratuita</h3>
<br>
<p>
  <b>iSaveAll.com</b> es uno de los mejores Hub Downloader para descargar TikTok sin marca de agua, Instagram Reels, imágenes de Instagram y cualquier cosa que desees. No necesitas instalar ningún software en tu computadora o teléfono móvil, todo lo que necesitas es el enlace de la plataforma y todo el procesamiento se realiza desde nuestro lado, para que estés a solo un clic de descargar en tus dispositivos.</p>
<h4 class="subtitle f14 mb-3">Características principales:</h4>
<ul>
<li>Sin marca de agua para una mejor calidad, algo que la mayoría de las herramientas no ofrecen.</li>
<li>Descarga videos de TikTok en cualquier dispositivo que desees: teléfono móvil, PC o tablet. TikTok solo permite que los usuarios descarguen videos a través de la aplicación y los videos descargados contienen la marca de agua.</li>
<li>Descarga Reels de Instagram en la mejor calidad.</li>
<li>Descarga imágenes de Instagram en alta resolución.</li>
<li>Descarga utilizando tu navegador: quiero mantener las cosas simples para ti. No es necesario descargar o instalar ningún software. También he creado una aplicación con ese propósito, pero solo puedes instalarla cuando desees.</li>
<li>Siempre es gratuito. Solo mostramos algunos anuncios, los cuales nos ayudan a mantener nuestros servicios y futuros desarrollos.</li> 
<li>El nuevo iSaveAll permite a los usuarios descargar diapositivas de fotos de TikTok en formato de video Mp4. Las imágenes y la música de la presentación de diapositivas de TikTok se fusionan automáticamente con iSaveAll. Además, también puedes descargar cada imagen de la presentación de diapositivas directamente a tu computadora.</li> </ul>
<br>
</section>
<section class="container mt-1">
  <h3 class="text-center font-weight-600">Cómo usar iSaveAll Video Downloader</h3>
<div class="row text-left">
  <div class="col-md-4 mt-4 mx-0 pr-md-4">
    <h5>Encuentra el enlace del contenido que deseas</h5>
    <p class="text-muted">Abre TikTok o Instagram, encuentra el botón de compartir, copia el enlace y continúa con el siguiente paso.</p>
  </div>
  <div class="col-md-4 mt-4 mx-0">
    <h5>Pega la URL del video</h5>
    <p class="text-muted">Pega la URL del video en el cuadro de entrada y haz clic en el botón "Descargar".</p>
  </div>
  <div class="col-md-4 mt-4 mx-0 pl-md-4">
    <h5>Descarga el video o audio</h5>
    <p class="text-muted">Haz clic en los botones "Descargar" para guardar el video o audio.</p>
  </div>
</div>
</section>
<div class="accordion" id="faq" itemscope="" itemtype="https://schema.org/FAQPage">
  <div class="accordion-item" itemprop="mainEntity" itemscope="" itemtype="https://schema.org/Question">
    <h2 class="accordion-header" id="question1">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer1" aria-expanded="false" aria-controls="answer1">
        ¿Cómo descargar videos de TikTok sin marca de agua?
      </button>
    </h2>
    <div id="answer1" class="accordion-collapse collapse " aria-labelledby="question1" data-bs-parent="#faq">
      <div class="accordion-body">
        <ul class="list-unstyled">
          <li>Abre la aplicación de TikTok en tu celular/o el sitio web en tu navegador.</li>
          <li>Selecciona el video que deseas descargar.</li>
          <li>Haz clic en el botón de compartir en la esquina inferior derecha.</li>
          <li>Haz clic en el botón "Copiar enlace".</li>
          <li>Descarga utilizando tu navegador: quiero simplificar las cosas para ti. No es necesario descargar o instalar ningún software. También he creado una aplicación con ese propósito, pero solo puedes instalarla cuando desees.</li>
          <li>Vuelve a iSaveAll.com, pega tu enlace de descarga en el campo de arriba y haz clic en el botón "Descargar".</li>
          <li>Espera a que nuestro servidor haga su trabajo y luego guarda el video en tu dispositivo.</li>
        </ul>
      </div>
    </div>
  <!-- Resto de los elementos del acordeón van aquí -->
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingOne">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
      ¿Cómo obtener el enlace de descarga del video de TikTok?
    </button>
  </h2>
  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      <ul class="list-unstyled">
        <li>Abre la aplicación de TikTok</li>
        <li>Selecciona el video de TikTok que deseas descargar</li>
        <li>Haz clic en Compartir y, en las opciones de compartir, encuentra el botón Copiar Enlace</li>
        <li>El enlace de descarga está listo en el portapapeles.</li>
      </ul>
      <div class="example">
        <b>Por ejemplo, el enlace tendría este formato:</b>
        <div class="link-example">https://v.douyin.com/UFLNjnh/</div>
        <div class="link-example">https://www.tiktok.com/@philandmore/video/6805867805452324102</div>
        <div class="link-example">https://m.tiktok.com/v/6805867805452324102.html</div>
        y más...
      </div>
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingTwo">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      ¿Dónde se guardan los videos de TikTok después de descargarlos?
    </button>
  </h2>
  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      Cuando descargas archivos, generalmente se guardan en la carpeta que has establecido como predeterminada. Normalmente, tu navegador establece esa carpeta por ti. En la configuración del navegador, puedes cambiar y elegir manualmente la carpeta de destino para los videos de TikTok descargados.
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingThree">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      ¿El servicio proporcionado por este sitio es gratuito?
    </button>
  </h2>
  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      Sí. Es completamente gratuito. Los usuarios deben asegurarse de tener permiso del propietario del video para descargarlo. Nuestro sitio web no almacena ningún video de TikTok.
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingFour">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      ¿Hay alguna limitación en la cantidad de videos descargados?
    </button>
  </h2>
  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      No. Puedes descargar tantos videos como desees.
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingFive">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
      ¿Qué dispositivos son compatibles?
    </button>
  </h2>
  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      Todos los dispositivos que pueden ejecutar navegadores populares como Chrome, IE, Safari, Firefox son compatibles para usar nuestro servicio.
    </div>
  </div>
</div>
</div>
<p>iSaveAll respeta los derechos de propiedad intelectual de las pistas, por lo que no proporcionará esta solución. Sin embargo, actualmente existen varios sitios web y aplicaciones que ofrecen este servicio de conversión a MP3 de TikTok, como <b>Tikmate</b>, <b>SaveTik.Net</b>, <b>SSStiktok</b>, etc. Puedes descargar canciones en MP3 de TikTok, pero no se permite utilizarlas para actividades comerciales o monetizarlas.</p>
<p><b>Nota:</b> iSaveAll (<i>Tiktok Video Downloader</i>) no es una herramienta oficial de TikTok, no tenemos relación con TikTok ni con ByteDance Ltd. Solo brindamos soporte a los usuarios de TikTok para descargar videos sin logotipo sin ningún problema. Si tienes problemas con sitios como Tikmate o SSSTiktok, prueba iSaveAll, siempre estamos actualizando para facilitar la descarga de videos de TikTok. ¡Gracias!</p>
</div>
</div>
</div>
</div>
</section>
<?php include '../includes/footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3869138732972987"
     crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/typedText.js"></script>
<script src="../assets/js/downloadFile.js"></script>
<script src="../assets/js/getDownloadLink.js"></script>
<script src="../assets/js/pasteFromClipboard.js"></script>


</body>
</html>