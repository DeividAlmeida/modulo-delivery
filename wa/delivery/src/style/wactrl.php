<style>
html{
    overflow-x: hidden;
    font-family: Montserrat, Arial, Helvetica, 'Liberation Sans', FreeSans, sans-serif;
}


.pagination{
    padding-left:15px!important;

}
.pagination>.active>a{
    cursor:pointer !important;
}
.pagination a{
    color:<?php echo $conf['pag_texto'] ?> !important;
    background:<?php echo $conf['pag_fundo'] ?> !important;
    border-color:#fff !important;
}
.pagination li{
}
#dashboard{
    display: flex;
    position:relative;
 }
* {
  box-sizing: border-box;
}
.search{
    border-radius:25px;
    height: 35px;
    border:0;
    width:98%;
    margin: 4px 0 0 5px;
}

.column:hover{
    transition: 0.3s;
    background:<?php echo $conf['lis_hover_fundo'] ?>;
}

.dois b{
    font-size:20px;
    color:<?php echo $conf['lis_titulo'] ?>;
}

#box{
    position: fixed;
    background-color: rgb(0,0,0,0.5);
    z-index: 10000000;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}
#popup{
    position: fixed;
    background-color: <?php echo $conf['pop_fundo'] ?>;
    z-index: 10000001;
    width: 70%;
    margin: 16% 22%;
    box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
    overflow: hidden;
    top: -50px;
    left: -8%;
    height:350px
}

#fechar{
    font-size: 40px;
    position: absolute;
    right: 5px;
    cursor: pointer;
    top: -2%;
    color: <?php  echo $conf['pop_fechar'] ?>;
}
#um{
    position: absolute;
    overflow: hidden;
    width: 350px;
}
#um img{
height:350px;
}
#dois {
    position: initial;
    margin: 4% 0% 4% 350px;
    overflow: hidden;
    white-space: break-spaces;
    height: 270px;
    padding: 25px;
    max-width: 60%;
}

#dois b{
    font-size: 35px;
   color: <?php  echo $conf['pop_titulo'] ?>;
   line-height:30px;
   position:relative;
   bottom:2px;

}
#dois p{
    height:150px;
    overflow-y:scroll;
    color: <?php  echo $conf['pop_descricao'] ?>;
   position:relative;
   top:9%;
   text-align: justify;
}
::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-thumb {
  background-color: rgb(0,0,0,0.2);
  border-radius: 10px;
}

.promocao{
    background:<?php  echo $conf['lis_fundo_pro'] ?> !important;
}
.quatro{
    display:none;
}

<?php if($conf['estilo'] == 1){ ?>
.dois { 
    width:60%;
    padding:10px;
    height:70px;
    white-space:nowrap;
    text-overflow:ellipsis;
    position:relative;
    top:15%;
    overflow:hidden;
}

.column {

    display:flex;
    border:<?php if(!empty($conf['borda'])){echo 'solid 1px '.$conf['borda'];} ?>;
    margin: 1%;
    cursor:pointer;
    background:<?php echo $conf['lis_fundo'] ?>;
}
.um img{
    height:120px;
    position:relative;
}
.um{
    width:120px;
}
.tres{
    padding-bottom:10px;
    padding-top: 2%;
    position:relative;
    top:16%;
    right:1.5%;
}
.talvez{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
    color:<?php echo $conf['lis_preco'] ?>;

}
.sim{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
    color:<?php echo $conf['lis_preco'] ?>;
}
.nao{
    text-decoration: line-through;
    margin: 0;
    text-align: center;
    color:<?php echo $conf['lis_preco_pro'] ?>;
    left:20%;
}
.dois p{
    text-overflow: ellipsis;
    overflow: hidden; 
    margin:0;
}
<?php } else {  ?>



.column {
    border:<?php if(!empty($conf['borda'])){echo 'solid 1px '.$conf['borda'];} ?>;
    margin: 16px 1%;
    cursor:pointer;
    background:<?php echo $conf['lis_fundo'] ?>;
    display: block;
}
.um{
    height:180px;
}
.um img{
    width:100%;
}
.tres{
    width: auto;
    padding: 0px 5px 15px 25px;
    white-space: pre-wrap;
    text-overflow: ellipsis;
    position: relative;
    overflow: hidden;
    font-size: 15px;

}
.tres b{
    font-weight: 900;
}
.talvez{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
    color:<?php echo $conf['lis_preco'] ?>;
    left:30px;
    padding-bottom: 15px;
}
.sim{
    color:<?php echo $conf['lis_preco'] ?>;
}
.nao{
    text-decoration: line-through !important;
    font-weight:700 !important;
    font-size:13px !important;
    color:<?php echo $conf['lis_preco_pro'] ?> !important;
}
.dois p{
    text-overflow: ellipsis;
    overflow: hidden; 
    margin:0;
}
.dois { 
    width:auto;
    padding: 5px 25px;
    padding-bottom:5px;
    white-space:nowrap;
    text-overflow:ellipsis;
    position:relative;
    top:15%;
    overflow:hidden;
}
<?php } ?>

@media only screen and (max-width: 991px) {
.col-sm-4, .col-sm-3 {
    width: 100% !important;
}
    <?php if($conf['mob_img'] == 'N'){?>
    .um {
        display: none !important;
    }
    .dois p{
        overflow: scroll;
        margin: 0;
        height: 70px;
        width: 100%;
        position: relative;
        top:5%;
        font-size: 75%;
        color:<?php echo $conf['mob_descricao']?>;
    }
<?php }else{?>

   .dois p{
        overflow: scroll;
        margin: 0;
        height: 100px;
        width: 100%;
        position: relative;
        top:5%;
        font-size: 75%;
        color:<?php echo $conf['mob_descricao']?>;
    } 
<?php }?>
    .talvez{
        font-weight: bolder;
        white-space: nowrap;
        text-align: center;
        margin: 0;
        position: relative;
        top: 0%;
        color:<?php echo $conf['mob_preco'] ?>;
        left:16px;
        top:0;
        font-size:120%;
    }
    .sim {
    font-weight: bolder;
    white-space: nowrap;
    margin: 0;
    position: relative;
    top:1px;
    font-size:120%;
    box-sizing: border-box;
}
.nao {
    text-decoration: line-through;
    margin: 0;
    color: <?php echo $conf['mob_preco_pro_1'] ?>;
    top: 0%;
    left: 2%;
    position: relative !important;
    font-size: 75%;
    }
  #dashboard {
    display:block;
    position:relative;
    right:5px;
  }
  .search{
    margin:5px;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
     border-radius: 20px;
     border:0;
  }
  #diferir {
    float: left;
    grid-template-columns:auto auto auto;
    grid-template-rows:45px;
    display:grid !important;
    margin: 1%;
    cursor:pointer;
    background:<?php echo $conf['mob_fundo']?>;
    border:0px;
    overflow:hidden;
    width:95% !important;
    }
    .um img {
    max-width: none !important;
    width: 9em;
    height: 123px;
    position: relative;
    }
    .um{
        grid-row:1/3; 
        padding-right:10px;
    }
.column:hover {
    background:<?php echo $conf['mob_fundo']?>;
    }

.dois {
    height:auto;
    width: auto;
    margin-top: 25px;
    top: 0;
    position: relative;
    padding: 0;
    white-space: normal;
    max-width:110px;
}

.dois b{
font-size:120%;
color:<?php echo $conf['mob_titulo']?>;
}

::-webkit-scrollbar {
  width: 0;

}
#mob{
    display:none;
}


.etiqueta2{
    background: <?php echo $conf['bg_btn_pedido']?>  !important;
    color: <?php echo $conf['cor_btn_pedido']?>  !important;
    padding: 10.5px 9px;
    border-radius: 25px;
    margin: 5% !important;
    position: relative;
    white-space: nowrap;
    bottom: 10px;
    top: 35px;
    right:5px;
    height: 35px;
    display:grid !important;
    width: 35px;
}
.etiqueta{
    display:none;
}
.tres{
    width: auto;
    padding: 5px 20px 0px 0px;
    white-space: nowrap;
    text-overflow: ellipsis;
    position: relative;
    overflow: pre-wrap;
    font-size: 15px;
}

}
.etiqueta2{
    display:none;
}
.um {
    height: auto;
}

    .lista-select{
        width: 35px;
        background-color: aqua;
        padding: 8px 8px 3px 8px;
        border-radius: 100%;
    }
    .input_sty1{
        display: grid  !important;
        border: 2px rgba(0,0,0, 0.3) solid !important;
        grid-template-columns: 40px auto !important;
        grid-gap: 1px;
        border-radius: 25px;
        background:white;
    }
    .input_sty2{
        display: grid  !important;
        border: 2px rgba(0,0,0, 0.3) solid !important;
        grid-template-columns: auto 43px !important;
        grid-gap: 1px;
        border-radius: 25px;
        background:white;
    }
    select:focus, input:focus{
    outline: none;
    }
    .picon .btn{
    pointer-events: none;
    margin: 2px;
    background: <?php echo $conf['bg_icone']?>  !important;
    color: <?php echo $conf['cor_icone']?>  !important;
    border-radius: 25px;
    height: 40px;
    width: 40px;
    padding: 9px 0px 10px 0px;
    }
    .dashboard{
        padding-top:50px;
        
    }
.etiqueta{
    background: <?php echo $conf['bg_btn_pedido']?>  !important;
    color: <?php echo $conf['cor_btn_pedido']?>  !important;;
    padding: 8px;
    border-radius: 20px;
    margin: 25%;
    position: relative;
    white-space: nowrap;
    bottom: 10px;
}
.botoes {
    position: fixed;
    bottom: -1px;
    left: 0px;
    width: 100%;
    display: table;
    background: #fff;
    padding: 5px 0px 6px;
    z-index: 10;
    box-shadow: 0px 0px 5px #00000059;
}
.fixed{
    position: fixed;
    top: 0;
    width: 84.5% !important;
    z-index: 10000;
    background: white;
    display:none
}
.btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
}
.swal2-container{
    z-index: 1000000 !important;
}

</style>