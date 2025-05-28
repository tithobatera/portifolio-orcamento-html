function calcularOrcamento() {
  // Obter o valor da página
  const tipoPaginaValue = document.getElementById("tipoPagina").value;
  let tipoPagina = 0;

  if (tipoPaginaValue === "500,00 Simples") {
      tipoPagina = 500;
  } else if (tipoPaginaValue === "600,00 Intermediária") {
      tipoPagina = 600;
  } else if (tipoPaginaValue === "700,00 Avançada") {
      tipoPagina = 700;
  } else if (tipoPaginaValue === "900,00 Premium") {
      tipoPagina = 900;
  }

  const prazoElement = document.getElementById("prazoMeses");
  const prazoText = prazoElement.options[prazoElement.selectedIndex].text;

  if (tipoPagina === 0 || prazoText === "Selecione") {
      document.getElementById("valorEstimadoValue").innerText = "0.00€";
      document.getElementById("valorEstimadoInput").value = "0.00";
      return;
  }

  // Custos adicionais
  const separadores = [
      document.querySelector('input[value="Quem somos (+ 300€)"]').checked ? 300 : 0,
      document.querySelector('input[value="Onde estamos (+ 300€)"]').checked ? 300 : 0,
      document.querySelector('input[value="Galeria de fotografias (+ 500€)"]').checked ? 500 : 0,
      document.querySelector('input[value="eCommerce (+ 500€)"]').checked ? 500 : 0,
      document.querySelector('input[value="Gestão interna / Base de dados (+ 600€)"]').checked ? 600 : 0,
      document.querySelector('input[value="Notícias (+ 200€)"]').checked ? 200 : 0,
      document.querySelector('input[value="Redes sociais (+ 250€)"]').checked ? 250 : 0,
  ];

  const custoSeparadores = separadores.reduce((acc, curr) => acc + curr, 0);
  let total = tipoPagina + custoSeparadores;

  // Determinar desconto com base no texto do prazo
  let desconto = 0;
  if (prazoText.includes("5%")) desconto = 5;
  else if (prazoText.includes("10%")) desconto = 10;
  else if (prazoText.includes("15%")) desconto = 15;
  else if (prazoText.includes("20%")) desconto = 20;

  const valorDesconto = total * (desconto / 100);
  const valorEstimado = total - valorDesconto;

  document.getElementById("valorEstimadoValue").innerText = valorEstimado.toFixed(2) + "€";
  document.getElementById("valorEstimadoInput").value = valorEstimado.toFixed(2);
}



/**/
// JavaScript para Lightbox - Galeria de Imagens
let currentImageIndex = 0;
let images = [];

function openLightbox(element) {
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const lightboxDesc = document.getElementById("lightbox-desc");

  images = Array.from(document.querySelectorAll(".gallery-image"));
  currentImageIndex = images.indexOf(element);

  lightboxImg.src = element.src;
  lightboxDesc.innerText = element.alt;

  lightbox.style.display = "block";
}

function closeLightbox() {
  document.getElementById('lightbox').style.display = 'none';
}

function changeImage(direction) {
  currentImageIndex += direction;

  if (currentImageIndex >= images.length) {
    currentImageIndex = 0;
  } else if (currentImageIndex < 0) {
    currentImageIndex = images.length - 1;
  }

  const lightboxImg = document.getElementById("lightbox-img");
  const lightboxDesc = document.getElementById("lightbox-desc");

  lightboxImg.src = images[currentImageIndex].src;
  lightboxDesc.innerText = images[currentImageIndex].alt;
}