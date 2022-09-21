<!DOCTYPE html>
<html>

<head>
  <script src="../js/consultarArmamento.js"></script>
  <title>ARMAMENTO</title>
</head>

<body>
  <div class="main-card mb-3 card">
    <div class="card-header"><h4>ARMAMENTO</h4></div>
    <div class="card-body">
      <form id="formArm" name="formArm" action="" method="POST">
        <div class="row" style="text-align: center;">
          
          <div class="col-md-4"></div>
          
          <div class="col-md-4">
            <strong>Buscar por:</strong><br>
            <select id="tipo" name="tipo" class="form-control">
              <option value="nombre">Nombre del Agente</option>
              <option value="arma">Matricula del Arma</option>
            </select><br><br>
          </div>

          <div class="col-md-4"></div>
          <div class="col-md-4"></div>

          <div id="divNombre" class="col-md-4">
            <strong>Nombre del Agente:</strong><br>
            <input type="text" id="nomAgente" name="nomAgente" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
            <br>
            <strong>Apellido del Agente:</strong><br>
            <input type="text" id="apeAgente" name="apeAgente" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div id="divArma" style="display: none;" class="col-md-4">
            <strong>Matricula del Arma:</strong><br>
            <input type="text" id="matArma" name="matArma" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

        </div>
        
        <br><br>

        <div class="row" style="text-align:center;">
          <div class="col-md-4"></div>

          <div class="col-md-4">
            <button class="mb-2 mr-2 btn-hover-shine btn btn-success" type="submit" id="consultar" name="consultar">CONSULTAR</button>
          </div>

          <div class="col-md-4"></div>

        </div>

      </form>
    </div>
  </div>
</body>

</html>