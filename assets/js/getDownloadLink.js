const getDownloadLink = async () => {
    $('#result').hide()
  
    const vid_url = $('#link').val()
  
    $('#download').val('Loading ...')
    $('#download').attr('disabled', 'disabled')
  
    $('#bar').show()
  
    const formData = new FormData()
    formData.append('url', vid_url)
    const response = await fetch('dl/getDownloadLink.php', {
      method: 'POST',
      body: formData
    })
  
    const res = await response.json()
    if (res.success) {
      $('#bar').hide()
      $('#result').show()
  
      $('#title').html(res.title)
  
      $('#links').html('')
  
      const links = res.links
      
      links !== undefined && Object.keys(links).forEach(function (key) {
        const format = links[key].substring(links[key].length - 4);
        const url = links[key].slice(0, -4);
        $('#links').append(`<a class="button download-file w-100 mb-3" name="down" href="javascript:void(0)"  onclick="downloadFile('${url}', '${format}')" rel="nofollow">${key}</a>`);
      })
      
    } else {
      $('#bar').hide()
      alert(res.message)
    }
  
    $('#download').val('Download')
    $('#download').removeAttr('disabled')
  }