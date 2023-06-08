<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php include '../includes/head.php' ?>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/nav.php' ?>


<section id="hero" class="section hero">
<div class="container w100">
 
<h1 class="title"><p>Download <span class="typed-text"></span><span class="cursor">&nbsp;</span></p></h1>

<h2 class="text-center text-white title-2">Rápido, fácil e para todos os dispositivos.</h2>

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
<h3 class="text-center ">Baixe qualquer mídia gratuitamente</h3>
<br>
<p>
  <b>Nwtik.com</b> é um dos melhores Hub Downloader para baixar TikTok sem marca d'água, Instagram Reels, imagens do Instagram e qualquer coisa que você queira. Você não precisa instalar nenhum software no seu computador ou celular, tudo o que você precisa é do link da plataforma e todo o processamento é feito do nosso lado, para que você possa estar a apenas um clique de baixar para seus dispositivos.</p>
<h4 class="subtitle f14 mb-3">Principais recursos:</h4>
<ul>
<li>Sem marca d'água para melhor qualidade, o que a maioria das ferramentas não oferece.</li>
<li>Baixe vídeos do TikTok em qualquer dispositivo que você quiser: celular, PC ou tablet. O TikTok só permite que os usuários baixem vídeos por meio do aplicativo e os vídeos baixados contêm a marca d'água.</li>
<li>Baixe Reels do Instagram na melhor qualidade.</li>
<li>Baixe imagens do Instagram em alta resolução.</li>
<li>Faça o download usando seu navegador: quero manter as coisas simples para você. Não é necessário baixar ou instalar nenhum software. Também criei um aplicativo para esse fim, mas você pode instalá-lo apenas quando desejar.</li>
<li>É sempre gratuito. Coloco apenas alguns anúncios, que ajudam a manter nossos serviços e desenvolvimentos futuros.</li> 
<li>O novo NwTik permite aos usuários baixar o slideshow de fotos do TikTok no formato de vídeo Mp4. As imagens e a música no slideshow do TikTok são automaticamente mescladas pelo NwTik. Além disso, você também pode baixar cada imagem do slideshow diretamente para o seu computador.</li> </ul>
<br>
</section>
<section class="container mt-1">
  <h3 class="text-center font-weight-600">Como usar o Nwtik Video Downloader</h3>
<div class="row text-left">
  <div class="col-md-4 mt-4 mx-0 pr-md-4">
    <h5>Encontre o link do conteúdo que você deseja</h5>
    <p class="text-muted">Abra o TikTok ou o Instagram e encontre o botão de compartilhamento, copie o link e siga para a próxima etapa.</p>
  </div>
  <div class="col-md-4 mt-4 mx-0">
    <h5>Cole o URL do vídeo</h5>
    <p class="text-muted">Cole o URL do vídeo na caixa de entrada e clique no botão "Download".</p>
  </div>
  <div class="col-md-4 mt-4 mx-0 pl-md-4">
    <h5>Baixe o vídeo ou áudio</h5>
    <p class="text-muted">Clique nos botões "Download" para salvar o vídeo ou áudio.</p>
  </div>
</div>
</section>
<div class="accordion" id="faq" itemscope="" itemtype="https://schema.org/FAQPage">
  <div class="accordion-item" itemprop="mainEntity" itemscope="" itemtype="https://schema.org/Question">
    <h2 class="accordion-header" id="question1">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer1" aria-expanded="false" aria-controls="answer1">
        Como baixar vídeos do TikTok sem marca d'água?
      </button>
    </h2>
    <div id="answer1" class="accordion-collapse collapse " aria-labelledby="question1" data-bs-parent="#faq">
      <div class="accordion-body">
        <ul class="list-unstyled">
          <li>Abra o aplicativo TikTok no seu celular/ou o site no seu navegador.</li>
          <li>Escolha o vídeo que você deseja baixar.</li>
          <li>Clique no botão de compartilhamento no canto inferior direito.</li>
          <li>Clique no botão "Copiar link".</li>
          <li>Baixe usando seu navegador: Eu quero simplificar as coisas para você. Não é necessário baixar ou instalar nenhum software. Também criei um aplicativo para esse fim, mas você pode instalá-lo apenas quando desejar.</li>
          <li>Volte para NwTik.com e cole seu link de download no campo acima e clique no botão "Download".</li>
          <li>Aguarde nosso servidor fazer o trabalho dele e, em seguida, salve o vídeo no seu dispositivo.</li>
        </ul>
      </div>
    </div>
  <!-- Rest of the accordion items go here -->
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingOne">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
      Como obter o link de download do vídeo do TikTok?
    </button>
  </h2>
  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      <ul class="list-unstyled">
        <li>Abra o aplicativo TikTok</li>
        <li>Escolha o vídeo do TikTok que você deseja baixar</li>
        <li>Clique em Compartilhar e, nas opções de compartilhamento, encontre o botão Copiar Link</li>
        <li>O URL de download está pronto na área de transferência.</li>
      </ul>
      <div class="example">
        <b>Por exemplo, o link teria este formato:</b>
        <div class="link-example">https://v.douyin.com/UFLNjnh/</div>
        <div class="link-example">https://www.tiktok.com/@philandmore/video/6805867805452324102</div>
        <div class="link-example">https://m.tiktok.com/v/6805867805452324102.html</div>
        e mais...
      </div>
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingTwo">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      Onde os vídeos do TikTok são salvos após serem baixados?
    </button>
  </h2>
  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      Quando você baixa arquivos, eles geralmente são salvos na pasta que você definiu como padrão. Normalmente, o seu navegador define essa pasta para você. Nas configurações do navegador, você pode alterar e escolher manualmente a pasta de destino para os vídeos do TikTok baixados.
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingThree">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      O serviço fornecido por este site é gratuito?
    </button>
  </h2>
  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      Sim. É totalmente gratuito. Os usuários devem garantir que tenham permissão do proprietário do vídeo para baixá-lo. Nosso site não armazena nenhum vídeo do TikTok.
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingFour">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      Existe uma limitação no número de vídeos baixados?
    </button>
  </h2>
  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      Não. Você pode baixar quantos vídeos quiser.
    </div>
  </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="headingFive">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
      Quais dispositivos são suportados?
    </button>
  </h2>
  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
    <div class="accordion-body">
      Todos os dispositivos que podem executar os navegadores populares, como Chrome, IE, Safari, Firefox, são suportados para usar nosso serviço.
    </div>
  </div>
</div>
</div>


<p>NwTik respeita os direitos de propriedade intelectual das faixas, por isso não fornecerá essa solução. No entanto, atualmente existem diversos sites e aplicativos que oferecem esse serviço de conversão para MP3 do TikTok, como <b>Tikmate</b>, <b>SaveTik.Net</b>, <b>SSStiktok</b>, etc. Você pode baixar músicas em MP3 do TikTok, mas não é permitido usá-las para atividades comerciais ou monetizá-las.</p>
<p><b>Observação:</b> NwTik (<i>Tiktok Video Downloader</i>) não é uma ferramenta oficial do TikTok, não temos relação com o TikTok ou a ByteDance Ltd. Apenas oferecemos suporte aos usuários do TikTok para baixar vídeos sem logotipo sem qualquer problema. Se você está tendo problemas com sites como Tikmate ou SSSTiktok, experimente o NwTik, estamos sempre atualizando para facilitar o download de vídeos do TikTok. Obrigado!</p>
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