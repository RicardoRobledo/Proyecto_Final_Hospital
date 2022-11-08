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
?>