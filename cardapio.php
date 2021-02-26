<?php
	$TitlePage = 'Cardapio';
	$UrlPage   = 'cardapio.php';
	require_once('includes/funcoes.php');
	require_once('includes/header.php');
	require_once('includes/menu.php');
	require_once('controller/cardapio.php');
	echo DBRead('cardapio','*',"WHERE id = '1'")[0]['modo'];
?>
<div class="has-sidebar-left">
    <header class="blue accent-3 relative nav-sticky">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<div class="container-fluid text-white">
    		<div class="row p-t-b-10 ">
    			<div class="col">
    				<h4><i class="icon-cutlery"></i> <?php echo $TitlePage; ?></h4>
    			</div>
    		</div>
    	</div>
    </header>
    <body>
    	<div class="container-fluid animatedParent animateOnce my-3" >
            <div class="pb-3">
    			<span class="dropdown">
    			        <a class="btn btn-sm btn-primary dropdown-toggle" href="#" data-toggle="dropdown">Categorias</a>
    				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start">
    					<a class="dropdown-item " href="?">Categorias</a>
    						<a class="dropdown-item" href="?Cat=0">Cadastrar Categoria</a>
    				</div>
    			</span>			
    			<a class="btn btn-sm btn-primary" href="?Config">Configuração</a>
    		</div>
            <?php 
            if (isset($_GET['Config']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'configuracao', 'acessar')) :
                require_once('cardapio/configuracao/index.php'); 
            elseif (isset($_GET['Item']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) :
                require_once('cardapio/categoria/item/index.php'); 
            else:
                if(checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')){
            		require_once('cardapio/categoria/index.php'); 
                }
            endif;
            ?>
        </div>
    </body>
</div>
<?php  require_once('includes/footer.php'); ?>