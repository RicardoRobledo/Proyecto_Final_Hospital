<?php

include('paciente_dao.php');

$no_control = $_GET['id_paciente'];
$no_control = $_GET['nombre'];
$no_control = $_GET['primerAp'];
$no_control = $_GET['SegundoAp'];
$no_control = $_GET['no_tel'];
$no_control = $_GET['edad'];
$no_control = $_GET['sexo'];
$no_control = $_GET['dire'];

?>
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
    <div class="container">
        <form class="row g-3 mx-5 mt-4 was-validated" action="../controlador/procesar_cambio_paciente.php" method="POST">
            <h2 class="text-center">Paciente</h2>
            <?php
            printf("<input required readonly name='id' type='text' class='form-control is-valid' id='inputText' value='" . $_GET['id_paciente'] . "' placeholder='id'>");
            ?>
            <?php
            printf("<input required name='nombre' type='text' pattern='[A-Z][a-z]*' class='form-control is-valid' id='inputText' value='" . $_GET['nombre'] . "' placeholder='Nombre'>");
            ?>
            <?php
            printf("<input required name='Ap_P' type='text' pattern='[a-zA-Z]*' class='form-control is-valid' id='inputText' value='" . $_GET['primerAp'] . "' placeholder='Nombre'>");
            ?>
            <?php
            printf("<input required name='Ap_M' type='text' pattern='[a-zA-Z]*' class='form-control is-valid' id='inputText' value='" . $_GET['SegundoAp'] . "' placeholder='Nombre'>");
            ?>
            <?php
            printf("<input required name='tel' type='text' pattern='[0-9]{10}' class='form-control is-valid' id='inputText' value='" . $_GET['no_tel'] . "' placeholder='Nombre'>");
            ?>
            <?php
            printf("<input required name='edad' min='0' type='number' class='form-control is-valid' id='inputText' value='" . $_GET['edad'] . "' placeholder='Nombre'>");
            ?>
            <?php
            printf("<input required name='sexo' type='text' pattern='[M|F]' class='form-control is-valid' id='inputText' value='" . $_GET['sexo'] . "' placeholder='Nombre'>");
            ?>
            <?php
            printf("<input required name='direccion' type='text'  class='form-control is-valid' id='inputText' value='" . $_GET['dire'] . "' placeholder='Nombre'>");
            ?>
            <button href="#" type="submit" class="btn btn-success">Guardar cambios</button>
            <a href="../vista/pacientes.php" class="btn btn-danger">Cancelar</a>

        </form>
    </div>
</body>


</html>