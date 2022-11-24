num = Math.floor(Math.random() * 60);

$.post(
  "../../proceso/Controlador_escritorio.php?op=frases",
  { id: num },
  function (res) {
    let datos = JSON.parse(res);
    $("#frase").html(datos["0"]["0"]);
    $("#fuente").html(datos["0"]["1"]);
  }
);

// * SLIDER

window.onload = function () {
  clearInterval(playSlider);
  var slider = document.querySelector(".slider");
  var nextBtn = document.querySelector(".next-btn");
  var prevBtn = document.querySelector(".prev-btn");
  var slides = document.querySelectorAll(".slide");
  var slideIcons = document.querySelectorAll(".slide-icon");
  var numberOfSlides = slides.length;
  var slideNumber = 0;

  //image slider next button
  nextBtn.addEventListener("click", () => {
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove("active");
    });

    slideNumber++;

    if (slideNumber > numberOfSlides - 1) {
      slideNumber = 0;
    }

    slides[slideNumber].classList.add("active");
    slideIcons[slideNumber].classList.add("active");
  });

  //image slider previous button
  prevBtn.addEventListener("click", () => {
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove("active");
    });

    slideNumber--;

    if (slideNumber < 0) {
      slideNumber = numberOfSlides - 1;
    }

    slides[slideNumber].classList.add("active");
    slideIcons[slideNumber].classList.add("active");
  });

  //image slider autoplay
  var playSlider;

  var repeater = () => {
    playSlider = setInterval(function () {
      slides.forEach((slide) => {
        slide.classList.remove("active");
      });
      slideIcons.forEach((slideIcon) => {
        slideIcon.classList.remove("active");
      });

      slideNumber++;

      if (slideNumber > numberOfSlides - 1) {
        slideNumber = 0;
      }

      slides[slideNumber].classList.add("active");
      slideIcons[slideNumber].classList.add("active");
    }, 5000);
  };
  repeater();

  //stop the image slider autoplay on mouseover
  slider.addEventListener("mouseover", () => {
    clearInterval(playSlider);
  });

  //start the image slider autoplay again on mouseout
  slider.addEventListener("mouseout", () => {
    repeater();
  });
};
// * FIN SLIDER

$(document).ready(function () {
  $("#btnLit").click(function () {
    buscGenPrin("Literatura y Novelas");
  });
  $("#btnMed").click(function () {
    buscGenPrin("Medicina");
  });
  $("#btnDer").click(function () {
    buscGenPrin("Derecho");
  });
});

function buscGenPrin(genero) {
  generoSeleccionado = genero;
  cargarcontenido("ContenedorPrincipal", "listadoLibros.php");
}
