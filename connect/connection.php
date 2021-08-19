<?php 
    // Conexão com o banco de dados 
    $serve = 'localhost';
    $user = 'root';
    $passworld = '';
    $db = 'quickbuy';

    $connect = mysqli_connect($serve, $user, $passworld, $db);
    
    if(mysqli_connect_errno()) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_errno());
    } 
?>