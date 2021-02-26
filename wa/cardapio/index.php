<?php
    header('Access-Control-Allow-Origin: *');
	require_once('../../includes/funcoes.php');
	require_once('../../database/config.database.php');
	require_once('../../database/config.php');
	$_GET['id'] = 4;
	if(isset($_GET['id'])):
	    $categoria = $_GET['id'];
	    $query = json_encode(DBRead('cardapio_item','*' ,"WHERE categoria = '{$categoria}'"));
	else:
	    $categoria = null;
	    $query = json_encode(DBRead('cardapio_categoria','*'));
	endif;
	    
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php  echo DBRead('cardapio','*',"WHERE id = '1'")[0]['modo']; ?>
        <style>
            * {
              box-sizing: border-box;
            }
            #menu{
                margin-left:6%;
            }
            .column {
                float: left;
                width: 45%;
                display:flex;
                border:solid 10px #000;
                margin: 1%;
            }
            .column div{
                margin:1%;
            }
            .um{
                width:100px;
            }
            .um img{
                width:100px;
            }
            .dois p{
                text-overflow: ellipsis;
                overflow: hidden; 
            }
            .dois { 
                width:65%;
            }
        </style>
    </head>
    <body>
        <div id="controller">
            <div id="menu" v-if="categoria">
                <div class="column" v-for="item, id of db">
                    <div class="um">
                        <img :src="origin+'wa/cardapio/uploads/'+item.img">
                    </div>
                    <div class="dois">
                        <b>{{item.nome}}</b>
                        <p>{{item.descricao}}</p>
                    </div>
                    <div class="tres">
                        {{item.preco}}
                    </div>
                </div>
            </div>

  
    


  

        </div>



    <script>
        const vue= new Vue({
            el:"#controller",
            data:{
                origin:'<?php echo ConfigPainel('base_url') ?>',
                categoria: <?php echo $categoria ?>,
                db: <?php echo $query ?>
            },
        })
    </script>
    </body>
</html>