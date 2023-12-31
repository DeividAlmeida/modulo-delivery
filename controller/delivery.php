<?php

if(!$_SESSION['node']['id']){ die(); exit(); }

require_once('database/upload.class.php');

if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'])) { Redireciona('./index.php'); }


#VUE
if(isset($_GET['modo'])){

    $modo = $_GET['modo'];

    if($modo == 'dev'){
        $vue= '<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>';
    }else{
        $vue= '<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>';
    }
        
    $query  = DBUpdate('delivery', array('modo' => $vue), "id = '1'");
  
}
    #CATEGORIA
if(isset($_GET['C_id'])):
    foreach($_POST as $nome => $valor){
        $data[$nome]=$valor;
    }
    $id = $_GET['C_id'];
    $db = 'delivery_categoria';
    if($id == 0){
        $query = DBCreate($db, $data, true);  
    }else{
        $query =  DBUpdate($db, $data, "id = '{$id}'");
    };
    if(isset($query)){
        if ($query != 0){
            Redireciona('?sucesso&Cat');
        }else{
            Redireciona('?erro&Cat');
        }
    }
endif;
#DELETAR CATEGORIA
if(isset($_GET['DeletarCategoria'])){
    $id     = get('DeletarCategoria');
    $query  = DBDelete('delivery_categoria',"id = '{$id}'");
    if(isset($query)){
        if ($query != 0){
            Redireciona('?sucesso&Cat');
        }else{
            Redireciona('?erro&Cat');
        }
    }
}

$plugins = DBRead('delivery_plugins','*');
if(!empty($plugins)){
    foreach($plugins as $key => $plugin){
        require_once('ecommerce/'.$plugin['nome'].'.php');
    }
}
