function downloadFile(url, format) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'dl/downloadFile.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.responseType = 'blob';
  
    xhr.onload = function() {
      if (xhr.status === 200) {
        var blob = xhr.response;
        var a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'nwtik-hubdownloader'+format; // Nome do arquivo de destino
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      }
    };
  
    xhr.send('url=' + encodeURIComponent(url));
  }