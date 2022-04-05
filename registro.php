<?php
include('config.php');
session_start();

if (isset($_POST['registro']))  { 
    
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $dui = $_POST['dui'];
    

    $query = $conn->prepare("SELECT * FROM clientes WHERE dui =:dui");
    $query->bindParam("dui", $dui, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo "El cliente ya esta registrado";
    }
    if ($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO clientes(nombre,direccion,telefono,dui) VALUES (:nombre,:direccion,:telefono,:dui)");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
        $query->bindParam("telefono", $telefono, PDO::PARAM_STR);
        $query->bindParam("dui", $dui, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            echo " Registro exitoso";
        } else {
            echo "Registro fallido";
        }
    }

}
