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
        
    $query  = DBUpdate('cardapio', array('modo' => $vue), "id = '1'");
  
}
    #CATEGORIA
if(isset($_GET['C_id'])):
    foreach($_POST as $nome => $valor){
        $data[$nome]=$valor;
    }
    $id = $_GET['C_id'];
    $db = 'cardapio_categoria';
    if($id == 0){
        $query = DBCreate($db, $data, true);  
    }else{
        $query =  DBUpdate($db, $data, "id = '{$id}'");
    };

    #ITEM
elseif(isset($_GET['I_id'])):
    $id = $_GET['I_id'];
    $db = 'cardapio_item';
    if($_FILES['img']['name'] == null && $id != "0"){
        $keep = DBRead('cardapio_item','*' ,"WHERE id = '{$id}'")[0];
        $data['img'] = $keep['img'];
     }else{
         $upload_folder = 'wa/cardapio/uploads/';
         $handle = new Upload($_FILES['img']);
         $handle->file_new_name_body = md5(uniqid(rand(), true));
         $handle->Process($upload_folder);
         $data['img'] = $handle->file_dst_name;
     }
     foreach($_POST as $nome => $valor){
         $data[$nome]=$valor;
     }
     if($id == 0){
        $query = DBCreate($db, $data, true);
        $route ='&Item&Catego='.$_POST['categoria'];
    }else{
        $query =  DBUpdate($db, $data, "id = '{$id}'");
        $route ='&Item&Catego='.$_POST['categoria'];
    };
endif;

#DELETAR CATEGORIA
if(isset($_GET['DeletarCategoria'])){
    $id     = get('DeletarCategoria');
    $query  = DBDelete('cardapio_categoria',"id = '{$id}'");
    $itens = DBRead('cardapio_item','*' ,"WHERE categoria = '{$id}'")[0];
    if(is_array($itens)):
        foreach($itens as $num){
            DBDelete('cardapio_item',"categoria = '{$id}'");
        }
    endif;
}

#DELETAR ITEM
if(isset($_GET['DeletarItem'])){
    $id     = get('DeletarItem');
    $cat = DBRead('cardapio_item','*' ,"WHERE id = '{$id}'")[0];
    $route ='&Item&Catego='.$cat;
    $query  = DBDelete('cardapio_item',"id = '{$id}'");
}

if(isset($query)){
    if ($query != 0)  {
        Redireciona($UrlPage.'?sucesso'.$route);
    } else {
        Redireciona($UrlPage.'?erro'.$route);
    }
}