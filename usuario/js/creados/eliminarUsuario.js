$("#tabUs").DataTable({
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
    url: "../../proceso/Controlador_NuevoUsuario.php?op=usuarios",
    data: {},
    type: "POST",
    dataType: "json",
    error: function (e) {
      alert("ocurrió un error, contacte al administrador");
    },
  },
});

$(document).ready(function () {
  $("#editar").click(function () {
    editar();
  });

  $("#eliminar").click(function () {
    eliminar();
  });

  $("#edContra").click(function () {
    editarContra();
  });
});

function editar() {
  let tablaUs = $("#tabUs").DataTable();
  let datosUs = tablaUs.rows({ selected: true }).data();

  if (datosUs.length > 0) {
    $("#divDatos").html("");
    let cadGral = `
      <div class="row">

        <div class="col-md-12">
          <label id="user"></label>
        </div>
        <div class="divider"></div>
        <div class="col-md-6">
          <label>EMAIL</label>
          <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="col-md-6">
          <label>NOMBRE</label>
          <input type="text" id="nombre" name="nombre" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
        </div>
        <div class="col-md-4">
          <label>TIPO DE USUARIO</label>
          <select name="tipo" id="tipo" class="form-control">
            <option value="0">SUPER USUARIO</option>
            <option value="Admin">ADMINISTRADOR</option>
            <option value="Empleado">EMPLEADO</option>
            <option value="Lector">LECTOR</option>
          </select>
        </div>
        <div><br></div>
        <div class="col-md-12">
          <button id="guardar" class="mb-2 mr-2 btn-hover-shine btn btn-success" onclick="guardar()">GUARDAR REGISTRO EDITADO</button>
        </div>
      </div>
    `;
    $("#divDatos").append(cadGral);

    $.post(
      "../../proceso/Controlador_NuevoUsuario.php?op=editar",
      {
        id: datosUs[0][4],
      },
      function (res) {
        let a = JSON.parse(res);

        $("#email").val(a[0][0]);
        $("#nombre").val(a[0][1]);
        $("#tipo").val(a[0][2]).change();
      }
    );
  } else {
    Swal.fire({
      title: "Error!",
      text: "Selecciona a un usuario!",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  }
}

function eliminar() {
  alert("ELIMINAR");
}

function guardar() {
  let tablaUs = $("#tabUs").DataTable();
  let datosUs = tablaUs.rows({ selected: true }).data();
  $.post(
    "../../proceso/Controlador_NuevoUsuario.php?op=editarUs",
    {
      id: datosUs[0][4],
      nombre: $("#nombre").val(),
      correo: $("#email").val(),
      privilegio: $("#tipo").val(),
    },
    function (res) {
      if (res == "exito") {
        Swal.fire({
          title: "Exito!",
          text: "Modificación de usuario exitosa",
          icon: "success",
          showConfirmButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          showCancelButton: 0,
          confirmButtonText: "Entendido",
        }).then(function (e) {
          if (e.value) {
            cargarcontenido("ContenedorPrincipal", "eliminarUsuario.php");
          }
        });
      } else {
        Swal.fire({
          title: "Error!",
          text: "Ocurrió un error",
          icon: "warning",
          showConfirmButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          showCancelButton: 0,
          confirmButtonText: "Entendido",
        }).then(function (e) {
          if (e.value) {
            cargarcontenido("ContenedorPrincipal", "eliminarUsuario.php");
          }
        });
      }
    }
  );
}

function editarContra() {
  let tablaUs = $("#tabUs").DataTable();
  let datosUs = tablaUs.rows({ selected: true }).data();

  if (datosUs.length > 0) {
    $("#divDatos").html("");
    let cadGral = `
      <div class="row">
        <div class="col-md-6">
          <label>CONTRASEÑA NUEVA</label>
          <input type="password" id="cont" name="cont" class="form-control">
        </div>
        <div class="col-md-6">
          <label>REPETIR CONTRASEÑA</label>
          <input type="password" id="contr" name="contr" class="form-control">
        </div>
        <div><br><br></div>
        <div class="col-md-6">
          <button type="button" id="grContra" onclick="cambiarContra()" class="mb-2 mr-2 btn btn-success">GUARDAR</button>
        </div>
      </div>   
    `;
    $("#divDatos").append(cadGral);
  } else {
    Swal.fire({
      title: "Error!",
      text: "Selecciona a un usuario!",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  }
}

function cambiarContra() {
  let tablaUs = $("#tabUs").DataTable();
  let datosUs = tablaUs.rows({ selected: true }).data();
  let c1 = $("#cont").val();
  let c2 = $("#contr").val();

  if (c1 != c2) {
    Swal.fire({
      title: "Error!",
      text: "Las Contraseñas no coinciden!",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  } else if (es(c1) || es(c2) || c1 == "" || c2 == "") {
    Swal.fire({
      title: "Error!",
      text: "Las Contraseñas no pueden estar vacías ni contener un espacio!",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  } else {
    $.post(
      "../../proceso/Controlador_NuevoUsuario.php?op=nuevaContra",
      {
        id: datosUs[0][4],
        contra: c1,
      },
      function (res) {
        if (res == "true") {
          Swal.fire({
            title: "Exito!",
            text: "Contraseña Actualizada correctamente!",
            icon: "success",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          }).then(function (e) {
            if (e.value) {
              cargarcontenido("ContenedorPrincipal", "eliminarUsuario.php");
            }
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: "Ocurrió un error",
            icon: "warning",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          }).then(function (e) {
            if (e.value) {
              cargarcontenido("ContenedorPrincipal", "eliminarUsuario.php");
            }
          });
        }
      }
    );
  }
}

function es(s) {
  return /\s/g.test(s);
}
