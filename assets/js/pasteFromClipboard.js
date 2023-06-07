function togglePasteButton() {
    var linkInput = document.getElementById("link");
    var pasteButton = document.getElementById("pasteButton");
  
    if (linkInput.value.trim() !== "") {
      pasteButton.textContent = "Clear";
    } else {
      pasteButton.textContent = "Paste";
    }
  }
  
  function pasteFromClipboard() {
    navigator.clipboard.readText().then(function (text) {
      document.getElementById("link").value = text;
      togglePasteButton();
    });
  }
  
  function clearLink() {
    document.getElementById("link").value = "";
    togglePasteButton();
  }
  
  // Adicione este evento ao campo de texto ou botão de colar
  document.getElementById("link").addEventListener("input", togglePasteButton);
  document.getElementById("pasteButton").addEventListener("click", function() {
    if (this.textContent === "Clear") {
      clearLink();
    } else {
      pasteFromClipboard();
    }
  });
  