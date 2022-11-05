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

// *******************************************************************

$(document).ready(function () {
  $("#btnBuscarGenero").click(function () {
    buscarGenero();
  });
  $("#btnLit").click(function () {
    buscGenPrin("Literatura y Novelas");
  });
  $("#btnMed").click(function () {
    buscGenPrin("Medicina");
  });
  $("#btnDer").click(function () {
    buscGenPrin("Derecho");
  });
  $("#bscTit").click(function () {
    buscarLibro();
  });
});

$("#tbGeneros").DataTable({
  bFilter: true,
  bInfo: false,
  bPaginate: true,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
  },
  select: {
    style: "single",
    info: false,
  },

  ajax: {
    url: "../../proceso/Controlador_busqueda.php?op=generos",
    data: {},
    type: "POST",
    dataType: "json",
    error: function (e) {
      console.log(e.responseText);
    },
  },
});

function buscarGenero() {
  var tablaGenero = $("#tbGeneros").DataTable();
  var datoGenero = tablaGenero.rows({ selected: true }).data();
  if (datoGenero.length > 0) {
    generoSeleccionado = datoGenero[0][0];
    cargarcontenido("ContenedorPrincipal", "listadoLibros.php");
  } else {
    alert("SELECCIONE UN GENERO");
  }
}

function buscGenPrin(genero) {
  generoSeleccionado = genero;
  cargarcontenido("ContenedorPrincipal", "listadoLibros.php");
}

function buscarLibro() {
  libroBusqueda = $("#titulo").val();
  cargarcontenido("ContenedorPrincipal", "listadoLibrosBusqueda.php");
}
