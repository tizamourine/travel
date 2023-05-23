function adapterStyles() {
  var largeurEcran = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  var element = document.getElementById('nav-bar');

  if (largeurEcran <= 800) {
    // Styles pour les écrans de petite taille
    element.setAttibute("style", "display:inline-block;");
    alert("amine");
  }
}

// Appliquer les styles en fonction de la taille de l'écran lors du chargement de la page
adapterStyles();

// Adapter les styles lors du redimensionnement de la fenêtre
window.addEventListener('resize', adapterStyles);
