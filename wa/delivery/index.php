<?php
    header('Access-Control-Allow-Origin: *');
	require_once('../../includes/funcoes.php');
	require_once('../../database/config.database.php');
	require_once('../../database/config.php');
    switch (date('N')) {
        case 1:
            $dia = "Segunda-feira";
            break;
        case 2:
            $dia = "Terça-feira";
            break;
        case 3:
            $dia = "Quarta-feira";
            break;
        case 4:
            $dia = "Quinta-feira";
            break;
        case 5:
            $dia = "Sexta-feira";
            break;
        case 6:
            $dia = "Sabado";
            break;
        case 7:
            $dia = "Domingo";
            break;
    }
    ECHO $dia;
	if(isset($_GET['id'])):
	    $categoria = $_GET['id'];
	    $fetch = DBRead('delivery_produto','*' ,"WHERE categoria = '{$categoria}' AND status = 'Ativo'");
	elseif (isset($_GET['categoria'])):
	    $cat = $_GET['categoria'];
	    $fetch = DBRead('delivery_produto','*' ,"WHERE categoria = '{$cat}' AND status = 'Ativo' AND dias LIKE '%$dia%'");
	    $categoria = 'null';
	else:
	    $categoria = 'null';
	    $fetch = DBRead('delivery_produto','*',"WHERE status = 'Ativo' AND dias LIKE '%$dia%'");

	endif;
	    $categorias = json_encode(DBRead('delivery_categoria','*'));
	    $conf = DBRead('delivery_config','*')[0];
	    $config = json_encode($conf);
	    $db = json_encode($fetch);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.10.2/underscore-min.js'></script>
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url') ?>epack/css/elements/animate.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/delivery/src/style/main.css">
<?php require_once('../../wa/delivery/src/style/wactrl.php') ?>
<?php require_once('../../wa/delivery/src/style/cardapex.php') ?>

</header>
<body>
    <div id="controller" class="container-fluid">
        <section class="barraDados">
            <div class="container">
                <div class="boxin horario ">
                    <div class="horario-atendimento">
                        
                        <p :class="'btn '+horario" @click="horario == 'ativo'? horario = '': horario = 'ativo'">
                        
                            <i class="far fa-clock"></i> <strong class="text-success">Estamos abertos</strong>
                            
                            <span>das 00:00  até as  23:59</span>
                            <i class="fas fa-angle-down"></i>
                            
                        </p>
                        
                        <div class="box-horarios" :style="horario != 'ativo'?'display: none':void(0)">
                            <ul>
                                <li><strong>Domingo: </strong><span>00:00 - 23:59</span><span class="clearfix"></span></li><li><strong>Segunda-feira: </strong><span>00:00 - 23:59</span><span class="clearfix"></span></li><li><strong>Terça-feira: </strong><span>00:00 - 23:59</span><span class="clearfix"></span></li><li><strong>Quarta-feira: </strong><span>00:00 - 23:59</span><span class="clearfix"></span></li><li><strong>Quinta-feira: </strong><span>00:00 - 23:59</span><span class="clearfix"></span></li><li><strong>Sexta-feira: </strong><span>00:00 - 23:59</span><span class="clearfix"></span></li><li><strong>Sábado: </strong><span>00:00 - 23:59</span><span class="clearfix"></span></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>

                <!-- pagamento -->
                <div :class="'btn boxin pagamento '+pagamento" @click="pagamento == 'ativo'? pagamento = '':pagamento = 'ativo'">
                    <div class="formasPagamento">
                        <strong>Formas <br>de Pagamento</strong>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="listaFormas" :style="pagamento != 'ativo'?'display: none':void(0)">
                        <div class="">
                            <h4>Cartões de Crédito</h4>
                            <ul>
                            
                                <li>American Express</li>
                            
                                <li>Banricompras</li>
                            
                                <li>Credishop</li>
                            
                                <li>Diners</li>
                            
                                <li>Elo</li>
                            
                                <li>Goodcard</li>
                            
                                <li>Hipercard</li>
                            
                                <li>Mastercard</li>
                            
                                <li>Sorocred</li>
                            
                                <li>Verdecard</li>
                            
                                <li>Visa</li>
                            
                            </ul>
                        </div>
                        
                        
                        <div class="">
                            <h4>Cartões de Débito</h4>
                            <ul>
                            
                                <li>Banricompras</li>
                            
                                <li>Elo</li>
                            
                                <li>Mastercard</li>
                            
                                <li>Visa</li>
                            
                            </ul>
                        </div>
                        
                        
                        <div class="">
                            <h4>Vales</h4>
                            <ul>
                            
                                <li>Alelo Alimentação</li>
                            
                                <li>Alelo Refeição</li>
                            
                                <li>Cooper Card</li>
                            
                                <li>Credi Refeição</li>
                            
                                <li>Green Card</li>
                            
                                <li>Planvale</li>
                            
                                <li>Refeisul</li>
                            
                                <li>Sodexo</li>
                            
                                <li>Sodexo Alimentação</li>
                            
                                <li>Ticket Restaurante</li>
                            
                                <li>Up Brasil</li>
                            
                                <li>Vale Card</li>
                            
                                <li>Verocard</li>
                            
                                <li>Verocheque</li>
                            
                                <li>Vr Smart</li>
                            
                            </ul>
                        </div>
                        
                        
                        <div class="">
                            <h4>Outras Formas</h4>
                            <ul>
                            
                                <li>PicPay</li>
                            
                                <li>Apple Pay</li>
                            
                                <li>MercadoPago</li>
                            
                                <li>PagSeguro</li>
                            
                                <li>PayPal</li>
                            
                            
                                <li>Dinheiro</li>
                            
                                <li>Pix</li>
                            
                                <li>Transferência/Depósito</li>
                            
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <!-- entrega -->                    
                <div class="boxin entrega">
                    <div class="tempoEntrega">
                        <strong>Entrega</strong>
                        <span>De 40 à 60 minutos (aprox.)</span>
                    </div>
                </div>            
            </div>
        </section>
        <div class="row dashboard" id="no-fixed">
            <div id="dashboard" class="col-sm-5">
                <div class="input-group mb-3 input_sty1">
                    <div class="input-group-prepend picon">
                        <a class=" fa btn"  type="button">
                            <i style="font-size:20px" class="fas fa-list"></i>
                        </a>
                    </div>
                    <select  @change="categor($event)"  v-if="!categoria" class="search custom-select" >
                        <option value="" selected disabled> &nbsp;Navegar pela Categorias </option>
                        <option value="all"> Todas Categorias</option>
                        <option  v-for="cat, i of categorias" :value="cat.nome">{{cat.nome}}</option>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-7">
                <div class="input-group mb-3 input_sty2">
                    <input class="search" @input='here=>searchQuery=here.target.value' placeholder=" Faça uma busca  " icon="&#xF002;" style="font-family:Arial, FontAwesome" @keyup="resultQuery()" />
                    <div class="input-group-prepend picon">
                        <a class=" fa btn"  type="button">
                            <i style="font-size:20px" class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row dashboard fixed" >
            <div id="dashboard" class="col-sm-5">
                <div class="input-group mb-3 input_sty1">
                    <div class="input-group-prepend picon">
                        <a class=" fa btn"  type="button">
                            <i style="font-size:20px" class="fas fa-list"></i>
                        </a>
                    </div>
                    <select  @change="categor($event)"  v-if="!categoria" class="search custom-select" >
                        <option value="" selected disabled> &nbsp;Navegar pela Categorias </option>
                        <option value="all"> Todas Categorias</option>
                        <option  v-for="cat, i of categorias" :value="cat.nome">{{cat.nome}}</option>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-7">
                <div class="input-group mb-3 input_sty2">
                    <input class="search" @input='here=>searchQuery=here.target.value' placeholder=" Faça uma busca  " icon="&#xF002;" style="font-family:Arial, FontAwesome" @keyup="resultQuery()" />
                    <div class="input-group-prepend picon">
                        <a class=" fa btn"  type="button">
                            <i style="font-size:20px" class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>        
        
        
        <div class="col-sm-3" v-for="(item, index) in tokens">
            <div :class="item.promocao == 'S'?'promocao column post-grid-content':'column post-grid-content'"  @click="select(item.id)">
                <div class="um">
                    <img :src="origin+'wa/delivery/uploads/'+item.imagem">
                </div>
                <span class="etiqueta">Realizar Pedido</span>
                <div class="dois">
                    <b>{{item.nome}}</b>                       
                </div>
                <div class="tres">                        
                    <b >{{item.valor}}</b>
                </div>
            </div>                
        </div>
    

        <div id="mob" v-if="idx != null">                       
        </div>

        <ul  class="pagination col-sm-12" v-if="config.paginacao == 'S'">
            <li id="mob" :class="{'disabled' : pager.currentPage === 1}">
                <a @click="setPage(1)">&Ll;</a>
            </li>
            <li id="mob" :class="{'disabled' : pager.currentPage === 1}">
                <a @click="setPage(pager.currentPage - 1)">	&Lt;</a>
            </li>
            <li v-for="page in pager.pages" :class="{'active' : pager.currentPage === page}">
                <a @click="setPage(page)" v-html="page"></a>
            </li>
            <li id="mob" :class="{'disabled' : pager.currentPage === pager.totalPages}">
                <a @click="setPage(pager.currentPage + 1)">	&Gt;</a>
            </li>
            <li id="mob" :class="{'disabled' : pager.currentPage === pager.totalPages}">
                <a @click="setPage(pager.totalPages)">&ggg;</a>
            </li>
        </ul>
        <div class="botoes">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="botao openBasket">
                            <div class="title">
                                <span>Itens do <strong>Seu pedido</strong></span>
                                <span id="shopping-basket-total-price" class="valor">R$ {{valor.replace('.',',')}}</span>
                            </div>
                            <div id="shopping-basket-unpaired-marker" class="floating" style="display: none;"><span class="fas fa-exclamation"></span></div>
                            <div class="floating"><span id="shopping-basket-items-count">{{total}}</span></div>
                        </div>
                    </div>
                    <div class="col-6">
                        
                        <div class="botao pedir">
                            <button type="button" id="confirmar-pedido">
                                Continuar
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../../wa/delivery/src/script/wactrl.php') ?>   

</body>

