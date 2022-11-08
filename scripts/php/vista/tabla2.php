<!doctype html>
<html lang="en">

<head>
    <title>Laboratorio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

<h2>Sigue en proceso</h2>
</body>

</html>

<?php
include('../controlador/paciente_dao.php');
$paciente = new Paciente(
    $_POST['id_paciente'],
    $_POST['nombre'],
    $_POST['Ap_P'],
    $_POST['Ap_M'],
    $_POST['tel'],
    $_POST['edad'],
    $_POST['sexo'],
    $_POST['direccion']
);

$aDAO = new PacienteDAO();
Singleton::obtenerConexion();
//var_dump($paciente);
$resultado = $aDAO->mostrarPacienteFiltro($paciente);


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
        printf(
            "<td><a  href='../controlador/procesar_cambios.php?id_paciente=%s&nombre=%s&primerAp=%s&SegundoAp=%s&no_tel=%s&edad=%s&sexo=%s&dire=%s'
                class='btn btn-outline-success'>Modificar</a>",
            $result["id_paciente"],
            $result["nombre"],
            $result["apellido_paterno"],
            $result["apellido_materno"],
            $result["num_telefono"],
            $result["edad"],
            $result["sexo"],
            $result["direccion"]
        );
        printf("<a href='../controlador/procesar_bajas.php?id_paciente=%s'class='btn btn-outline-danger'>Eliminar</a></td>", $result["id_paciente"]);
        printf("</tr>");
    }
} else {
    echo ("No hay registros");
}
