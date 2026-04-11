# iSaveAll.com — Hub Downloader de Vídeos e Imagens

**iSaveAll** é uma aplicação web em PHP que permite ao utilizador baixar vídeos e imagens de plataformas populares (TikTok, Instagram e Facebook) diretamente pelo navegador, sem precisar instalar nenhum software.

---

## Índice

- [Visão Geral](#visão-geral)
- [Funcionalidades](#funcionalidades)
- [Plataformas Suportadas](#plataformas-suportadas)
- [Como Funciona](#como-funciona)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Configuração do Servidor](#configuração-do-servidor)
- [Dependências](#dependências)
- [Páginas Disponíveis](#páginas-disponíveis)
- [Fluxo Técnico](#fluxo-técnico)
- [Limitações Conhecidas](#limitações-conhecidas)

---

## Visão Geral

O **iSaveAll** é um downloader hub centralizado: o utilizador cola o link de um post, vídeo ou reel de uma rede social e a aplicação processa o link no servidor, extrai as URLs diretas de mídia e devolve botões de download — tudo sem redirecionamentos externos nem instalação de extensões.

O projeto roda sobre **PHP 7.2+** com Apache (XAMPP/WAMP ou servidor Linux), sem framework MVC — a estrutura é simples, com arquivos PHP incluídos diretamente e endpoints específicos na pasta `dl/`.

---

## Funcionalidades

- Download de vídeos do **TikTok** sem marca d'água e com marca d'água
- Download de **Reels** e **Posts de imagem** do Instagram
- Download de vídeos do **Facebook** em qualidade SD e HD (quando disponível)
- Interface responsiva que funciona em desktop e mobile
- Botão de **colar da área de transferência** (clipboard) com um clique
- **Modo escuro** disponível em rota separada (`/darkmode/`)
- Processamento 100% server-side — sem extensões no navegador
- Suporte a múltiplos formatos de link de cada plataforma

---

## Plataformas Suportadas

| Plataforma | Tipo de Conteúdo | Observações |
|---|---|---|
| **TikTok** | Vídeo sem marca d'água, vídeo com marca d'água, áudio | Via API `tikwm.com` |
| **Instagram** | Reels (vídeo), Posts (imagem) | Apenas posts públicos |
| **Facebook** | Vídeos em SD e HD | Apenas vídeos públicos |

---

## Como Funciona

1. O utilizador acessa `isaveall.com` e cola o link de um vídeo/imagem no campo de entrada.
2. Ao clicar em **Download**, o JavaScript envia o link via `POST` para o endpoint `dl/getDownloadLink.php`.
3. O PHP detecta a plataforma (TikTok, Instagram ou Facebook) e chama o método correspondente na classe `Hub`.
4. O servidor extrai as URLs diretas de mídia e devolve um JSON com os links disponíveis.
5. O JavaScript exibe botões de download para cada qualidade/formato encontrado.
6. Ao clicar num botão, o `downloadFile.php` faz o stream do arquivo remoto diretamente para o navegador do utilizador.

---

## Estrutura do Projeto

```
isaveall.com/
│
├── index.php                  # Página principal (landing + formulário de download)
├── .htaccess                  # Rewrite HTTPS e front controller
├── composer.json              # Dependências do projeto
│
├── src/
│   ├── Hub.php                # Classe central: detecção de plataforma e lógica de download
│   ├── InstagramScraper.php   # Carregamento do scraper do Instagram (legado)
│   └── InstagramScraper/      # Biblioteca de scraping do Instagram
│       ├── Instagram.php
│       ├── Endpoints.php
│       ├── Model/
│       ├── Http/
│       └── Exception/
│
├── dl/
│   ├── getDownloadLink.php    # Endpoint POST: recebe URL, devolve JSON com links
│   └── downloadFile.php       # Endpoint POST: faz stream do arquivo remoto para o browser
│
├── assets/
│   └── js/
│       ├── getDownloadLink.js     # Fetch para dl/getDownloadLink.php e renderiza botões
│       ├── downloadFile.js        # XHR para dl/downloadFile.php e dispara download
│       ├── pasteFromClipboard.js  # Botão de colar da área de transferência
│       └── typedText.js           # Animação de texto digitado no título
│
├── includes/
│   ├── head.php               # <head> HTML (meta tags, CSS, fontes)
│   ├── nav.php                # Barra de navegação
│   └── footer.php             # Rodapé com links legais
│
├── darkmode/
│   └── index.php              # Variante da home com tema escuro
│
├── landing/
│   ├── terms-of-service/
│   │   └── index.php          # Termos de Serviço
│   └── privacy-policy/
│       └── index.php          # Política de Privacidade
│
└── vendor/                    # Dependências instaladas pelo Composer (não versionado)
```

---

## Requisitos

- **PHP** >= 7.2
- Extensões PHP: `curl`, `json`, `dom`, `libxml`
- **Composer** (para instalar dependências)
- Servidor web **Apache** com `mod_rewrite` habilitado (ou Nginx com configuração equivalente)
- Certificado SSL (o `.htaccess` força HTTPS)

---

## Instalação

**1. Clone o repositório:**

```bash
git clone https://github.com/seu-usuario/isaveall.com.git
cd isaveall.com
```

**2. Instale as dependências via Composer:**

```bash
composer install
```

**3. Configure o servidor web** para apontar o `DocumentRoot` para a pasta do projeto e garanta que o `mod_rewrite` está ativo.

**4. Certifique-se que as extensões PHP necessárias estão habilitadas** no `php.ini`:

```ini
extension=curl
extension=json
extension=dom
```

**5. Acesse no navegador:**

```
https://localhost/isaveall.com/
```

---

## Configuração do Servidor

O arquivo `.htaccess` na raiz faz duas coisas principais:

- Redireciona todo tráfego HTTP para HTTPS.
- Redireciona requisições de rotas inexistentes para `index.php` (front controller simples).

Os endpoints `dl/getDownloadLink.php` e `dl/downloadFile.php` são arquivos reais e são servidos diretamente, sem passar pelo `index.php`.

**Permissões recomendadas para o servidor:**

```bash
chmod -R 755 .
chmod -R 777 vendor/  # Apenas se necessário para cache
```

---

## Dependências

| Pacote | Versão | Uso |
|---|---|---|
| `symfony/http-client` | ^5.3 | Cliente HTTP para requisições ao Facebook |
| `react/promise` | ^2.8 | Promises assíncronas (legado, não utilizado nas versões atuais) |
| `guzzlehttp/psr7` | ^1.7 | Mensagens PSR-7 HTTP |
| `psr/simple-cache` | >=1.0 | Interface de cache PSR-16 |
| `phpfastcache/phpfastcache` | ^7.1 | Cache de sessão (Instagram) |
| `guzzlehttp/guzzle` | ^7.2 | Cliente HTTP (InstagramScraper) |

Todas as dependências são instaladas via `composer install`.

---

## Páginas Disponíveis

| URL | Arquivo | Descrição |
|---|---|---|
| `/` | `index.php` | Landing principal com o downloader |
| `/darkmode/` | `darkmode/index.php` | Versão com tema escuro |
| `/landing/terms-of-service/` | `landing/terms-of-service/index.php` | Termos de Serviço |
| `/landing/privacy-policy/` | `landing/privacy-policy/index.php` | Política de Privacidade |

**Endpoints internos (não acessados pelo utilizador diretamente):**

| URL | Método | Descrição |
|---|---|---|
| `/dl/getDownloadLink.php` | `POST` | Recebe `url`, devolve JSON com links |
| `/dl/downloadFile.php` | `POST` | Recebe `url`, faz stream do arquivo |

---

## Fluxo Técnico

### Detecção de Plataforma

```
Hub::processURL($url)
    ├── isTikTokURL()   → tiktokdownload()
    ├── isInstagramURL() → instagramDownload()
    └── isFacebookURL()  → facebookDownload()
```

### TikTok

Utiliza a API pública e gratuita do **[tikwm.com](https://www.tikwm.com)**:

```
POST https://www.tikwm.com/api/
Body: url=<link_tiktok>&hd=1

Resposta: { data: { play, wmplay, music, title } }
```

- `play` → vídeo sem marca d'água
- `wmplay` → vídeo com marca d'água
- `music` → áudio extraído

### Instagram

Faz scraping da página pública do post/reel com headers de browser moderno e extrai o conteúdo em quatro camadas de fallback:

1. JSON-LD embutido na página (`<script type="application/ld+json">`)
2. Campo `"video_url"` do JSON da página
3. Campo `"display_url"` para imagens
4. Meta tags Open Graph (`og:video` / `og:image`)

> **Nota:** Funciona apenas para posts e reels **públicos**. Posts privados exigem autenticação.

### Facebook

Faz um GET da página do vídeo com headers de browser e usa múltiplos padrões de regex para extrair as URLs de vídeo embutidas no HTML:

- HD: `playable_url_quality_hd`, `browser_native_hd_url`, `hd_src`
- SD: `playable_url`, `browser_native_sd_url`, `sd_src`

> **Nota:** Funciona para vídeos **públicos**. Vídeos privados ou de grupos fechados não são acessíveis sem login.

### Download do Arquivo

O `downloadFile.php` usa **cURL com stream** para enviar os bytes do arquivo remoto diretamente para o navegador, sem armazenar nada no servidor:

```php
curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($ch, $data) {
    echo $data;
    return strlen($data);
});
```

---

## Limitações Conhecidas

- **Instagram:** Posts e Reels privados não funcionam sem autenticação.
- **Facebook:** Vídeos de grupos privados, páginas com restrição geográfica ou vídeos exclusivos para membros não são suportados.
- **TikTok:** Vídeos de contas privadas não são suportados pela API do tikwm.com.
- **Rate Limiting:** Uso intensivo pode resultar em bloqueios temporários por parte das plataformas.
- O projeto **não** armazena os vídeos no servidor — todo o conteúdo é transmitido em tempo real.

---

## Licença

Este projeto é de uso pessoal/educacional. Respeite os Termos de Serviço de cada plataforma ao utilizá-lo.
