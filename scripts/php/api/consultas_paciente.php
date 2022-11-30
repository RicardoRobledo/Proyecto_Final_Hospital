<?php

    header("Content-Type: application/json");
    include '../scripts/php/conexionDB/Singleton.php';
    
    Singleton::obtenerConexion();
    echo json_encode(Singleton::consultaPacientes()->fetchAll(), true);
    
?>