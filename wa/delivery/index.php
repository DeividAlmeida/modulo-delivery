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
	    $entrega = json_encode(DBRead('delivery_entrega','*')[0]);
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
    
    <div id="controller" class="container-fluid" style="background:<?php echo $conf['lis_descricao'] ?>; padding:0px">
        <section class="barraDados" style="display:grid;width:auto">
            <div class="container">
                <div class="boxin horario ">
                    <div class="horario-atendimento">
                        
                        <p :class="'btn '+horario" @click="horario == 'ativo'? horario = '': horario = 'ativo'">
                        
                            <i class="far fa-clock"></i> <strong :class="aviso == 'Estamos abertos'?'text-success':'text-danger'">{{aviso}}</strong>
                            
                            <span v-if="aviso == 'Estamos abertos'">{{ate}}</span>
                            <i class="fas fa-angle-down"></i>
                            
                        </p>
                        
                        <div class="box-horarios" :style="horario != 'ativo'?'display: none':void(0)">
                            <ul>
                                <li v-for="hora, dia of config.horario" v-if="!config.horario[dia]['hora-fim'].length<=0">
                                    <strong>{{dia}}: </strong>
                                    <span style="white-space: nowrap; letter-spacing: -1px;padding:0" v-for="hinicio, horas of config.horario[dia]['hora-inicio']">
                                        <span >{{config.horario[dia]['hora-inicio'][horas]+' : '+config.horario[dia]['minuto-inicio'][horas] + '&nbsp;&nbsp;-&nbsp;&nbsp;' + config.horario[dia]['hora-fim'][horas]+' : '+config.horario[dia]['minuto-fim'][horas]}}</span>
                                        <span class="clearfix"></span>
                                    </span>
                                </li>
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
                <div class="boxin entrega" v-if="entrega.media == 'S'">
                    <div class="tempoEntrega">
                        <strong>Entrega</strong>
                        <span>{{entrega.tempo}}</span>
                    </div>
                </div>            
            </div>
        </section>
        <div class="basket hidden" >
            <div class="box">
                <button class="closeBasket" onclick="document.getElementsByClassName('basket')[0].setAttribute('class','basket hidden')" >
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="basketContent">
                    <h3>Seu Pedido</h3>
                    <div class="basket-body" id="basket">
                        <div class="itemBasket" v-for="list,id of pedido">
                            <div class="name opened">
                                <i class="fas fa-chevron-right seta"></i>
                                <span>{{list.nome}}</span>
                                <button type="button" class="close remover" aria-label="Remover"  data-identifier="178b3269e8e18a7ff5523da479ed03e50bad67535152c7961272c2e99405605b">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="content">
                                <div class="complementos">
                                    <h3>Complementos selecionados:</h3>
                                    <div class="options" v-if="list.adicionais.length>0">
                                        <strong>Adicionais</strong>
                                        <div class="complemento" v-for="adicional, aid of pedido[id].adicionais">
                                            <div class="left">
                                                {{adicional.nome}}
                                            </div>
                                            <div class="right">
                                            {{adicional.qtd}} x <span>{{adicional.vl}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="options" v-if="list.complementos.length>0">
                                        <strong>Complementos</strong>
                                        <div class="complemento" v-for="complemento, cid of pedido[id].complementos">
                                            <div class="left" v-if="complemento.length == 2 && complemento[1] != 0" >
                                                {{complemento[0]}}
                                            </div>
                                            <div class="right" v-if="complemento.length == 2 && complemento[1] != 0">
                                            1 x <span>R$ {{complemento[1].replace('.',',')}}</span>
                                            </div>
                                            <div class="left" v-if="complemento.length > 2 && complemento[cid+2].qtd > 0" >
                                                {{complemento[cid+2].nome}}
                                            </div>
                                            <div class="right" v-if="complemento.length > 2 && complemento[cid+2].qtd > 0 && complemento[cid+2].vl != 'R$ 0,00'">
                                            {{complemento[cid+2].qtd}} x <span>{{complemento[cid+2].vl}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <div class="left">
                                    <span data-identifier="178b3269e8e18a7ff5523da479ed03e50bad67535152c7961272c2e99405605b"  class="price">R$ {{list.total.replace('.',',')}}</span>
                                </div>
                                <div class="right">
                                    <input class="basket-update-qtt"  data-identifier="178b3269e8e18a7ff5523da479ed03e50bad67535152c7961272c2e99405605b"  type="number" value="4" style="display: none;">
                                    <div class="input-group" style=" display: grid; grid-template-columns: auto auto auto;">
                                        <div class="input-group-prepend">
                                            <button style="min-width: 2.5rem" class="btn btn-decrement btn-outline-secondary" type="button">
                                                <strong>-</strong>
                                            </button>
                                        </div>
                                            <input type="text"  inputmode="decimal" style="text-align: center"  v-model="list.qtd"  class="form-control basket-update-qtt" placeholder="">
                                        <div class="input-group-append">
                                            <button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary"   type="button">
                                                <strong>+</strong>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="summary">
                            <div class="row">
                                <div class="col-3 text-left">Total:</div>
                                <div class="col-9 text-right total">
                                    <span class="green">R$ 44,00</span>
                                    <span class="red">+</span> Taxa de Entrega
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basket-footer">
                        <p>
                            <small>
                                <span class="left">
                                    Taxa de Entrega será calculada ao final da compra.
                                    <br>
                                    Cupom de desconto poderá ser aplicado na tela de conclusão do pedido.
                                </span>

                            </small>
                        </p>
                        <button type="button" class="pedir" id="confirmar-pedido">Continuar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard row" id="no-fixed" style="margin:0px">
            <div id="dashboard" class="col-lg-5">
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
            
            <div class="col-lg-7">
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
        <section class="dashboard filtros-header filtro-fixo" style="display:none">
            <div class="container">
				<div class="boxin">
					<div class="row">
                        <div id="dashboard " class="col-md-5 col-12 filtro d-none d-lg-block">
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
                        
                        <div class="col-12 col-lg-7">
                            <div class="input-group mb-3 input_sty2" >
                                <input class="search" @input='here=>searchQuery=here.target.value' placeholder=" Faça uma busca  " icon="&#xF002;" style="font-family:Arial, FontAwesome" @keyup="resultQuery()" />
                                <div class="input-group-prepend picon">
                                    <a class=" fa btn"  type="button">
                                        <i style="font-size:20px" class="fas fa-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
        
        
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
                    <b class="nao" v-if="item.promocao == 'S'" >{{item.v_cortado}}</b> <b class="sim">{{item.valor}}</b>
                </div>
                <span class="etiqueta2">Realizar Pedido</span>
            </div>                
        </div>                      
        <ul  class="pagination col-12" v-if="config.paginacao == 'S'">
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
                        <div class="botao openBasket" onclick="document.getElementsByClassName('basket')[0].setAttribute('class', 'basket')">
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

