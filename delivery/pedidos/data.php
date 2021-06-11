<?php
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$data = DBRead('delivery_pedidos', '*', 'ORDER BY id DESC');
foreach($data as $chave => $valor){
    $data[$chave]['pedido'] = json_decode($data[$chave]["pedido"]);
};
echo json_encode($data);