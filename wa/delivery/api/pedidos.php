<?php
    error_reporting(0);
    header('Access-Control-Allow-Origin: *');
    require_once('../../../includes/funcoes.php');
    require_once('../../../database/config.database.php');
    require_once('../../../database/config.php');
    foreach($_POST as $chave => $valor){
        $dado[$chave] =$valor;
    }
    $query = DBCreate('delivery_pedidos', $dado, true);  
    echo $query;
?>