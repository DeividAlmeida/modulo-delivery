<?php
	$TitlePage = 'Delivery';
	$UrlPage   = 'delivery.php';
	require_once('includes/funcoes.php');
	require_once('includes/header.php');
	require_once('includes/menu.php');
	require_once('controller/delivery.php');
	echo DBRead('delivery','*',"WHERE id = '1'")[0]['modo'];
?>
<script src='https://rawgit.com/vuejs-tips/v-money/master/dist/v-money.js'></script>
<div class="has-sidebar-left">
    <header class="blue accent-3 relative nav-sticky">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<div class="container-fluid text-white">
    		<div class="row p-t-b-10 ">
    			<div class="col">
    				<h4><i class="icon-truck"></i> <?php echo $TitlePage; ?></h4>
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
				<span class="dropdown">
    			    <a class="btn btn-sm btn-primary dropdown-toggle" href="#" data-toggle="dropdown">Complementos</a>
    				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start">
    					<a class="dropdown-item" href="?Comp=0">Cadastrar Complementos</a>
    					<a class="dropdown-item " href="?Comp">Complementos Cadastrados</a>
    				</div>
    			</span>	
				<span class="dropdown">
    			    <a class="btn btn-sm btn-primary dropdown-toggle" href="#" data-toggle="dropdown">Adicionais</a>
    				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start">
    					<a class="dropdown-item" href="?Adic=0">Cadastrar Adicionais</a>
    					<a class="dropdown-item " href="?Adic">Adicionais Cadastrados</a>
    				</div>
    			</span>
				<span class="dropdown">
    			    <a class="btn btn-sm btn-primary dropdown-toggle" href="#" data-toggle="dropdown">Produtos</a>
    				<div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start">
    					<a class="dropdown-item" href="?Prod=0">Cadastrar Produtos</a>
    					<a class="dropdown-item " href="?Prod">Produtos Cadastrados</a>
    				</div>
    			</span>			
    			<a class="btn btn-sm btn-primary" href="?Config">Configuração</a>
    		</div>
            <?php 
            if (isset($_GET['Config']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'configuracao', 'acessar')) :
                require_once('delivery/configuracao/index.php');              
			elseif (isset($_GET['Comp']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) :
				require_once('delivery/complemento/index.php'); 
			elseif (isset($_GET['Adic']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) :
				require_once('delivery/adicional/index.php'); 
			elseif (isset($_GET['Prod']) && checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) :
				require_once('delivery/produto/index.php'); 
            else:
                if(checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')){
            		require_once('delivery/categoria/index.php'); 
                }
            endif;
            ?>
        </div>
    </body>
</div>
<?php  
if(isset($_GET['Deletar'])){
    $id     = $_GET['Deletar'];
    $db     = $_GET['db'];
    $query  = DBDelete($db,"id = '{$id}'");
	$route 	= $_GET['header'];
	if(isset($query)){
		if ($query != 0)  {
			Redireciona('?sucesso&'.$route);
		} else {
			Redireciona('?erro&'.$route);
		}
	}
}
require_once('includes/footer.php'); ?>