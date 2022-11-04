<!DOCTYPE html>


<html>


<head>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <title>Pacientes</title>
</head>


<body>
  <?php
  require_once('header.php');
  ?>
  <div class="container">
    <!--Altas-->
    <form class="row g-3 mx-5 mt-4 was-validated" action="../controlador/procesaraltas.php" method="POST">
      <h2 class="text-center">Pacientes</h2>
      <div class="col-md-6">
        <label for="inputText" class="form-label">Nombre</label>
        <input required name="nombre" type="text" pattern="[A-Z][a-z]*" class="form-control is-valid" id="inputText" placeholder="William">
      </div>
      <div class="col-md-6">
        <label for="inputText2" class="form-label">Apellido paterno</label>
        <input required name="Ap_P" type="text" pattern="[A-Z][a-z]*" class="form-control is-valid" id="inputText2" placeholder="Ardwin">
      </div>
      <div class="col-md-6">
        <label for="inputText3" class="form-label">Apellido materno</label>
        <input required name="Ap_M" type="text" pattern="[a-zA-Z]*" class="form-control is-valid" id="inputText3" placeholder="Tompson">
      </div>
      <div class="col-md-6">
        <label for="inputTel" class="form-label">Num. telefono</label>
        <input required name="tel" type="tel" pattern="[0-9]{10}" class="form-control is-valid" placeholder="0123456789" id="inputTel">
      </div>
      <div class="col-1">
        <label for="inputAge" class="form-label">Edad</label>
        <input required name="edad" min="0" type="number" class="form-control is-valid" id="inputAge">
      </div>
      <div class="col-1">
        <label for="inputSexo" class="form-label">Sexo</label>
        <input required name="sexo" ype="text" class="form-control is-valid" id="inputSexo">
      </div>
      <div class="col-10">
        <label for="inputAddress" class="form-label">Direccion</label>
        <input required name="direccion" type="text" class="form-control is-valid" id="inputAddress" placeholder="Calle, colonia y numero">
      </div>
      <div class="col-4">
        <button type="submit" class="btn btn-success">Agregar Paciente</button>
      </div>
    </form>

  </div>
  <!--Fin Altas-->
  <div class="container mt-5">
    <h2>Busqueda pacientes</h2>
    <form class="d-flex">
      <input class="form-control me-2" pattern="[0-9]* type=" text" placeholder="id paciente">
      <input class="form-control me-2" pattern="([A-Z|a-z])* type=" text" placeholder="tipo analisís">
      <input class="form-control me-2" type="date" placeholder="fecha">
      <button class="btn btn-primary" type="button">Buscar</button>
    </form>
    <table class="table table-striped mt-4 my-4">
      <thead>
        <h2 class="text-center">Pacientes</h2>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Apellido paterno</th>
          <th>Apellido materno</th>
          <th>Número telefonico</th>
          <th>Edad</th>
          <th>Sexo</th>
          <th>Dirección</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr>

          <?php
          include('../controlador/paciente_dao.php');
          $aDAO = new PacienteDAO();
          Singleton::obtenerConexion();
          $resultado = $aDAO->mostrarPacientes();
          //var_dump($resultado);

          if ($resultado->rowCount()) {
            //echo("Hay registros");
            while ($result = $resultado->fetch(PDO::FETCH_ASSOC)) {
              printf("<tr>");
              printf("<td>" . $result["id_paciente"] . "</td>");
              printf("<td>" . $result["nombre"] . "</td>");
              printf("<td>" . $result["apellido_paterno"] . "</td>");
              printf("<td>" . $result["apellido_materno"] . "</td>");
              printf("<td>" . $result["num_telefono"] . "</td>");
              printf("<td>" . $result["edad"] . "</td>");
              printf("<td>" . $result["sexo"] . "</td>");
              printf("<td>" . $result["direccion"] . "</td>");
              printf("<td>
                <a  href='#modal_modificar_pacientes' data-bs-toggle='modal' type='button' class='btn btn-outline-success'>Modificar</a>
                <a href='../controlador/procesar_bajas.php?id_paciente=%s'class='btn btn-outline-danger'>Eliminar</a>
                </td>", $result["id_paciente"]);
              printf("</tr>");
            }
          } else {
            echo ("No hay registros");
          }

          ?>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="modal" tabindex="-1" id="modal_modificar_pacientes">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar Paciente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3 mx-5 mt-4 was-validated" action="../controlador/procesaraltas.php" method="GET">
            <h2 class="text-center">Paciente</h2>
        
              <input required name="nombre" type="text" pattern="[A-Z][a-z]*" class="form-control is-valid" id="inputText" placeholder="Nombre">
            
            
              <input required name="Ap_P" type="text" pattern="[A-Z][a-z]*" class="form-control is-valid" id="inputText2" placeholder="Apellido paterno">
           
            
              <input required name="Ap_M" type="text" pattern="[a-zA-Z]*" class="form-control is-valid" id="inputText3" placeholder="Apellido materno">
            
            
              <input required name="tel" type="tel" pattern="[0-9]{10}" class="form-control is-valid" placeholder="numero telefonico" id="inputTel">
            
            
              <input required name="edad" min="0" type="number" class="form-control is-valid" id="inputAge" placeholder="0">
            
            
              <input required name="sexo" ype="text" class="form-control is-valid" id="inputSexo" placeholder="M/F">
            
            
              <input required name="direccion" type="text" class="form-control is-valid" id="inputAddress" placeholder="Calle, colonia y numero">
           
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
          <a href="" type="submit" class="btn btn-success">Guardar cambios</a>
        </div>
      </div>
    </div>
  </div>

</body>


</html>