<?php
    error_reporting(0);
    header('Access-Control-Allow-Origin: *');
    require_once('../../includes/funcoes.php');
    require_once('../../database/config.database.php');
    require_once('../../database/config.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://unpkg.com/vue/dist/vue.js'></script>
    <script src='https://rawgit.com/vuejs-tips/v-money/master/dist/v-money.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/v-money@0.8.1/dist/v-money.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@5.0.0/bootstrap-4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url') ?>epack/css/elements/animate.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

<?php 
    require_once('../../wa/delivery/src/style/wactrl.php'); 
    require_once('../../wa/delivery/src/style/cardapex.php');
    $entrega = json_encode(DBRead('delivery_entrega','*')[0]);
    $config = json_encode(DBRead('delivery_config','*')[0]);
    $pagamento = json_encode(DBRead('delivery_pagamento','*')[0]);
?>    
</head>
<body class="home blog">
    <span class="barraDados"></span>
    <span class="filtro-fixo"></span>
    <div id="controller" style="background:white;margin-top:30px"> 
        <section id="pedido-concluido" class="boxConfirmacao" style="display: none;position: relative; top: 55px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="center" style="box-shadow:none">
                            <div class="avisoEnviado text-center">
                                <h3 style="color:#c32c31;font-weight: bold; font-size: xx-large;">Seu pedido foi enviado =D</h3>
                                <p>Seu pedido foi enviado para o nosso Whatsapp, se houver  algum problema </p><p>você pode clicar no botão abaixo e reenviar o pedido</p>
                                <div class="abrirWhats mb-4">
                                    <a onclick="repetir()" class="btn" >
                                        Reenviar meu pedido
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>       
        <section id="confirmacao-pedido " class="boxConfirmacao">
            <div class="container-fluid p-0">
                <div class="row" id="voltar" style="padding-top:20px;position:relative">                        
                    <div class="col-md-12">
                        <a onclick="voltar()" id="voltar-cardapio" class="voltar">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
                <div class="row" id="top" style="margin-top:50px;border-top: 1px #dedede solid;">
                    <div class=" col-md-12">
                        <div class="center" style="box-shadow:none">
                            <!-- lista-itens -->
                            <div class="lista-itens">
                                <h3 class="title" id="titulo">Confirmação de Pedido</h3>
                                <div class="basketContent">
                                    <h3>Seu Pedido</h3>
                                    <div class="basket-body" id="basket">
                                        <div class="itemBasket" v-for="list,id of pedido">
                                            <div @click="openhide(id)" :id="'p'+id" class="name">
                                                <i class="fas fa-chevron-right seta"></i>
                                                <span>{{list.nome}}</span>                                                
                                            </div>
                                            <div :id="'c'+id" class="content hi">
                                                <div :id="'m'+id" class="complementos m0" >
                                                    <h3>Complementos selecionados:</h3>
                                                    <div class="options"  v-if="list.resultado == '10' || list.resultado == '11'">
                                                        <strong >Complementos</strong>
                                                        <div class="complemento" v-for="complemento, cid of pedido[id].complementos">
                                                            <div class="left" v-if="complemento.length == 2 && complemento[1] !== 0" >                                                
                                                                {{complemento[0]}}
                                                            </div>
                                                            <div class="right" v-if="complemento.length == 2 && complemento[1] !== 0">
                                                            {{list.qtd}} <span> {{complemento[1] === '0.00'?'':'x R$ '+complemento[1].replace('.',',')}}</span>
                                                            </div>
                                                            <div class="complemento" v-if="complemento.length > 2" v-for="opc, key of pedido[id].complementos[cid]">
                                                                <div class="left" v-if="opc.qtd>0">
                                                                    {{opc.nome}}
                                                                </div>
                                                                <div class="right"  v-if="opc.qtd>0">
                                                                {{opc.qtd}} <span>{{opc.vl === 'R$ 0,00'?'':' x '+opc.vl}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="options" v-if="list.resultado == '01' || list.resultado == '11'">
                                                        <strong >Adicionais</strong>
                                                        <div class="complemento"v-if="adicional.qtd>0" v-for="adicional, aid of pedido[id].adicionais">
                                                            <div class="left">
                                                                {{adicional.nome}}
                                                            </div>
                                                            <div class="right">
                                                                {{adicional.qtd}} x <span>{{adicional.vl}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="right">
                                                    <span data-identifier="178b3269e8e18a7ff5523da479ed03e50bad67535152c7961272c2e99405605b" style="white-space:nowrap"  class="price">Subtotal: <b style="color:#22a200"> R$ {{new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(list.total)}}</b></span>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="obsConfirmacao">
                                    <label class="text-center">Observações</label>
                                    <input type="text" id="obsConfirmacao" name="observa" class="form-control" placeholder="Detalhes do Pedido">
                                </div>
                            </div>
                            <div class="center infoEntregaConfirmacao" style="box-shadow:none">
                                <h3 class="title" style="bottom: 12px;">Informações para Entrega</h3>
                                <div class="dados-usuario "  >
                                    <div class="row">
                                        <div class="col-md-5 col-6 campo">
                                            <input type="text" id="telefone" v-model="telefone" name="fone" placeholder="Celular" class="mobile form-control obriga"   maxlength="15">
                                        </div>
                                        <div class="col-md-7 col-6 campo">
                                            <input type="text" id="nome" v-model="nome" name="nome" placeholder="Nome" class="form-control obriga" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="seleciona">
                                    <div class="box">
                                        <a v-if="entrega.delivery == 'on'" id="entrega" data-open="entrega" class="ativo" @click="ativo('entrega')">
                                            <i class="fas fa-motorcycle"></i>
                                            Entrega
                                        </a>
                                        <a id="retirada" v-if="entrega.balcao == 'on'" :class="entrega.delivery != 'on'? 'ativo': ' '" data-open="retirada" @click="ativo('retirada')">
                                            <i class="fas fa-hotel"></i> Retirar no
                                            Local
                                        </a>
                                    </div>
                                </div>
                                <!-- Dados Entrega -->
                                <div  id="entrega" :class="entrega.delivery == 'on' && obter=='entrega'?'formEntrega center':'formEntrega center hidden'" style="box-shadow:none">
                                    <div class="row" style="margin: 0 -20px !important;">
                                        <div class="col-md-12 " style="padding:0 !important">
                                            <select @change='bairro($event.target.value)' v-if="entrega.tipo == 'bairro'  && obter =='entrega'" name="bairro" id="bairro" class="form-control obriga"  style=" padding: 0px 20px !important; margin-bottom: 15px !important; color:#828282 !important"   v-model="bairros">
                                                <option selected value="" disabled>Bairros Atendidos</option>
                                                <option :value="bairro.bairro" v-for="bairro of api_entrega">{{bairro.bairro}}</option>                                                
                                            </select>
                                            <input type="number" @change="cep($event.target.value)" v-if="entrega.tipo != 'bairro' && obter =='entrega'" type="text" id="cep" name="cep" placeholder="CEP" class="cep form-control obriga"  autocomplete="off" maxlength="9" v-model="bairros">
                                        </div>
                                        <div v-if="obter =='entrega'" class="col-md-10 col-6 endereco campo" style="padding-left:0px">
                                            <input type="text" id="endereço" name="endereco" class="form-control obriga" placeholder="Endereço"  maxlength="100" autocomplete="off" v-model="endereco">
                                        </div>
                                        <div v-if="obter =='entrega'" class="col-md-2 col-6 numero campo" style="padding-right:0px">
                                            <input type="text" id="numero" name="numero" class="form-control obriga"  placeholder="Nº" maxlength="10"  autocomplete="off" v-model="numero">
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0 -20px !important;">
                                        <div class="col-md-5 endereco campo" style="padding-left:0px">
                                            <input type="text" id="complemento" name="complemento" class="form-control"   placeholder="Complemento (Ex: Bloco/Apto)" maxlength="100" v-model="complemento">
                                        </div>
                                        <div v-if="entrega.tipo != 'bairro'" class="col-md-4 col-6 bairro campo">
                                            <input type="text" id="bairro" name="bairro" placeholder="Bairro" class="form-control obriga"   maxlength="100" v-model="ceps">
                                        </div>
                                        <div class="col-md-3  ref campo" style="padding-right:0px">
                                            <input type="text" id="referencia" name="referencia" class="form-control"  placeholder="Ponto de Ref." maxlength="100" v-model="referencia">
                                        </div>
                                        <div v-if="obter =='entrega'" class="col-md-4 ref campo" v-if="entrega.tipo == 'bairro'" style="padding-left:5px !important; padding-right:0px !important">
                                            <input type="text" id="cep" name="cep" placeholder="CEP" class="cep form-control obriga"  autocomplete="off" maxlength="9" v-model="ceps">
                                        </div>
                                    </div>
                                    <div class="alert alert-warning" style="display:none;">
                                        <i class="fas fa-exclamation-triangle"></i> Campos Obrigatórios.
                                    </div>
                                    <!-- Alerta após sair do número -->
                                    <div class="alert alert-primary alerta-complemento" style="display:none">
                                        <i class="fas fa-exclamation-triangle"></i> Não esqueça de informar o
                                        <strong>complemento de endereço</strong> se houver.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="valoresConfirmacao">
                                    <div class="row text-right m-0 justify-content-end">
                                        <div id="cupom_desconto" class="col-3 col-lg-2">
                                            <span>Subtotal</span>
                                            <strong id="pedido_subtotal_valor">R$ {{new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(valor)}}</strong>
                                        </div>
                                        <div id="pedido_subtotal" class="col-3 col-lg-2 " >
                                            <span>Taxa de Entrega</span>
                                            <strong id="pedido_taxa_entrega_valor">{{frete}}</strong>
                                        </div>                                     
                                        <div id="pedido_total" class="col-3 col-lg-2 total " style="display: none;">
                                            <span>Total</span>
                                            <strong id="pedido_total_valor">R$  {{new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(valor)}}</strong>
                                        </div>           
                                        <div id="fora_de_area" class="col-12" style="display: none;">
                                            <strong id="fora_de_area_valor" class="red">Fora da área de atendimento</strong>
                                        </div>
                                    </div>
                                </div>
                                <!-- Retirada -->
                                <div id="retirada" :class="obter=='entrega' && entrega.delivery == 'on'?'formEntrega hidden':'formEntrega'" v-if="entrega.balcao == 'on'" >
                                    <div class="card login retirada">
                                        <div class="card-body text-center">
                                            <h5 class="card-title" style="color:#c32c31">Endereço para Retirada</h5>
                                            <p>
                                                <i class="fas fa-map-marker-alt"></i> <strong>
                                                    Rua {{entrega.rua}}
                                                    - {{entrega.bairro}} - {{entrega.cidade}}
                                                    / {{entrega.estado}}
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                            <div id="pagamentoConfirmacao" class="center pagamentoConfirmacao" style="box-shadow:none">
                                <h3 class="title" style="bottom: 12px;">Formas de Pagamento</h3>
                                <div class="box">
                                    <input onclick="document.getElementsByClassName('troco2')[0].style.float='left';document.getElementById('cartao').style.display='block'; document.getElementById('troco').style.display='none'; document.getElementById('chave').style.display='none'" type="radio" name="pagamento" id="maquininha" v-model="tipo" value="Cartão">
                                    <label for="maquininha">Cartões (Crédito, Débito, etc)</label>
                                    <div class="secundario bandeiras animated sladeInDown faster" id="cartao" style="display:none">
                                        <select v-if="tipo == 'Cartão'" v-model="cartao" id="cartão" class="form-control" style="padding:0 10px;">
                                            <option value="" selected disabled>Selecione</option>
                                            <option value="Crédito">Crédito </option>
                                            <option value="Débito">Débito </option>
                                            <option value="Vale">Vale </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box ">
                                    <input onclick="document.getElementsByClassName('troco2')[0].style.float='right';document.getElementById('cartao').style.display='none'; document.getElementById('troco').style.display='none'; document.getElementById('chave').style.display='block'"  v-model="tipo" value="Pix" type="radio" name="pagamento" id="pix"    data-uuid="8b1ffbcf-8317-4fcf-b3ef-e9ce1195feaa">
                                    <label for="pix">Pix</label>
                                    <div class="secundario troco slideInDown faster" id="chave" style="display:none">
                                        <p >Chave Pix</p>
                                        <div class="input-group mb-3 d-flex">
                                          <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" style="background:#029a26; color:#fff; font-weight: bold;"type="button" id="button-addon1" onclick="{this.innerText='Copiado'; clipboard()}">Copiar</button>
                                          </div>
                                          <input type="text" class="form-control" placeholder="" disabled :value="pagamento.pix" aria-label="Example text with button addon" aria-describedby="button-addon1" id="pixchave">
                                        </div>
                                    </div>
                                </div>
                                <div class="box mt-md-3 troco2" >
                                    <input onclick="document.getElementById('cartao').style.display='none'; document.getElementById('troco').style.display='block';document.getElementById('chave').style.display='none'" v-model="tipo" value="Dinheiro" type="radio" name="pagamento" id="dinheiro"    data-uuid="8b1ffbcf-8317-4fcf-b3ef-e9ce1195feaa">
                                    <label for="dinheiro">Dinheiro</label>
                                    <div class="secundario troco slideInDown faster" id="troco" style="display:none">
                                        <p><i class="fas fa-money-bill-alt"></i> Troco para:</p>
                                        <div class="input-group">                                                
                                            <input v-money="money" id="change" name="change"   class="price">
                                        </div>
                                        <div class="input-group box-sem-troco">
                                            <input type="checkbox"  name="no-change" id="no-change" onclick="troco(this.checked)">
                                            <label for="no-change">Sem troco</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /center -->
                    </div>
                </div>
                <div class="informacoesEntrega center" style="display:none;box-shadow:none;position:relative">
                    <div class="valoresConfirmacao">
                        <div class="row text-left">
                            <p style="display:flex">
                                <strong>Obs.:</strong>
                                <span id="obs"></span>
                            </p>
                        </div>
                        <div class="row text-right m-0 justify-content-end">
                            <div id="cupom_desconto" class="col-3 col-lg-2">
                                <span>Subtotal</span>
                                <strong id="pedido_subtotal_valor">R$ {{new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(valor)}}</strong>
                            </div>
                            <div id="pedido_subtotal" class="col-3 col-lg-2 " >
                                <span>Taxa de Entrega</span>
                                <strong id="pedido_taxa_entrega_valor">{{frete}}</strong>
                            </div>                                     
                            <div id="pedido_total" class="col-3 col-lg-2 total " style="display: none;">
                                <span>Total</span>
                                <strong id="pedido_total_valor">R$  {{new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(valor)}}</strong>
                            </div>           
                            <div id="fora_de_area" class="col-12" style="display: none;">
                                <strong id="fora_de_area_valor" class="red">Fora da área de atendimento</strong>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">                            
                                    <p>
                                        <strong>
                                            <i class="fas fa-map-marker-alt"></i> Endereço de Entrega
                                        </strong>                                
                                        <span id="endref"></span>                                
                                    </p>                      
                                </div>
                                <div class="col-md-5">                            
                                    <p>
                                        <strong><i class="fas fa-money-bill-wave"></i> Forma de Pagamento</strong>
                                        <span>{{tipo}}</span>
                                    </p>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row mt-4" id="enviar">
                    <div class="col-md-12">
                        <div class="center" style="box-shadow:none">
                            <div class="avisoEnviado text-center">
                                <h3 style="color:#c32c31;font-weight: bold;" ></h3>
                                <p></p>
                                <div class="abrirWhats">
                                    <a id="enviar-pedido" @click="pedir()" class="btn"
                                        data-number="55014981337597">
                                        Envie meu pedido
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </section>
    </div>
<script>
const vue2 = new Vue({
    el: "#controller",
    data: { 
        money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                masked: false 
            },
        troco:false,
        bairros:'',
        ceps:'',
        complemento:'',
        referencia:'',
        numero:'',
        endereco:'',     
        telefone:'',     
        nome:'',     
        frete: 'A calcular',
        api_entrega:null,
        config:<?php echo $config ?>,
        entrega:<?php echo $entrega ?>,
        pagamento:<?php echo $pagamento ?>,
        tipo:'',
        cartao:'',
        pedido:"hjgj",
        dinheiro:'',
        total:0,
        repetir: '',
        obter: 'entrega',
        valor:'0.00'
    },
    created() {this.pedido = todosPedidos; },
    methods:{
        openhide: function(a){
            let teste = document.getElementById('p'+a).getAttribute('class').search('open')
            if(teste <0){
                document.getElementById('p'+a).setAttribute('class', 'name opened')
                document.getElementById('c'+a).setAttribute('class', 'content')
                document.getElementById('m'+a).setAttribute('class', 'complementos')
            }else{
                document.getElementById('p'+a).setAttribute('class', 'name')
                document.getElementById('c'+a).setAttribute('class', 'content hi')
                document.getElementById('m'+a).setAttribute('class', 'complementos m0')
            }
        },
        ativo: function(a){
            switch(a){
                case 'entrega':
                    document.getElementById(a).setAttribute('class', 'ativo')
                    document.getElementById('retirada').setAttribute('class', '')
                    document.getElementById('pedido_total').style.display='none'
                    document.getElementById('pedido_subtotal').style.display='block'
                    document.getElementById('cupom_desconto').style.display='block'
                    vue2.obter ='entrega'
                    vue2.frete = 'A calcular'
                break;
                case 'retirada':
                    document.getElementById(a).setAttribute('class', 'ativo')
                    document.getElementById('entrega').setAttribute('class', '')                    
                    document.getElementById('pedido_total').style.display='block'
                    document.getElementById('pedido_subtotal').style.display='none'
                    document.getElementById('cupom_desconto').style.display='none'
                    vue2.obter = 'retirada'
                break;
            }           
        },
        bairro: function(a){
            this.api_entrega.filter(b=>{
                if(a == b.bairro){
                    vue2.frete = b.valor
                }
            })
        },
        cep: function(a){
            let onoff= 0
            this.api_entrega.filter(b=>{
                if(parseInt(a) >= parseInt(b.inicio) && parseInt(a) <= parseInt(b.fim)){
                    vue2.frete = b.valor
                    onoff = 1
                }
            })
                if(onoff != 1){
                    vue2.frete = 'A calcular'
                    Swal.fire(
                    'Erro',
                    'Infelizmente não entregamos nesse endereço ',
                    'error'
                    )
                }
        },
        pedir: function(){
            let minimo = vue2.entrega.min.replace('R$ ','')
            if(vue2.entrega.delivery == 'on' && vue2.obter == 'entrega' && parseFloat(minimo.replace('.',''))>parseFloat(vue2.valor)){
                Swal.fire(
                    'Erro',
                    'O pedido mínimo para entrega em nosso site é '+ vue2.entrega.min,
                    'error'
                    )
            }else{
                let form = new FormData()
                let obs = document.getElementById('obsConfirmacao').value
                let celular = document.getElementById('telefone').value
                let nome = document.getElementById('nome').value
                let  entrega = '' 
                let ipt_text = false
                for(let i = 1; i<document.getElementsByClassName('obriga').length;i++){
                    if(document.getElementsByClassName('obriga')[i].value.length<1){ ipt_text = document.getElementsByClassName('obriga')[i].id }
                }
                for(let i = 0; i<document.querySelectorAll('select').length;i++){
                    if(document.querySelectorAll('select')[i].value.length<1){ ipt_text = document.querySelectorAll('select')[i].id}
                }
                if(ipt_text){               
                    Swal.fire('Erro','Por favor preencha o campo '+ipt_text,'error')
                }else if(vue2.tipo=='' ){
                    Swal.fire('Erro','Por favor escolha a forma de pagamento','error')
                }else{
                    let hoje = new Date()
                    let agora = (hoje.getDate()<10?'0':'') + hoje.getDate()+"/"+(hoje.getMonth()<10?'0':'')+(hoje.getMonth()+1)+"/"+(hoje.getFullYear()<10?'0':'')+hoje.getFullYear()+" "+(hoje.getHours()<10?'0':'')+hoje.getHours()+":"+(hoje.getMinutes()<10?'0':'')+hoje.getMinutes()+":"+(hoje.getSeconds()<10?'0':'')+hoje.getSeconds()
                    let pedido =[]
                    let pedidos =""
                    let adicional = []
                    let complementos = []
                    if(vue2.obter ==  'entrega'){
                        let cep = document.getElementById('cep').value
                        let endereco = document.getElementById('endereço').value
                        let numero = document.getElementById('numero').value
                        let bairro = document.getElementById('bairro').value
                        let complemento = document.getElementById('complemento').value
                        let ponto = document.getElementById('referencia').value
                        let endre = "Rua "+endereco+" - "+numero+" - "+bairro
                        document.getElementById('endref').innerText=endre
                        document.getElementById('obs').innerText=" "+obs
                        entrega ="%0A%0A*ENTREGA*%0A*Endereço%20para%20entrega%3A*%0A*Rua%3A%20"+endereco+"*%0A*Número%3A%20"+numero+"*%0A*Complemento%3A%20"+complemento+"*%0A*Bairro%3A%20"+bairro+"*%0A*Ponto%20de%20Ref.%3A%20"+ponto+"*%0A*CEP%3A%20"+cep+"*"
                    }else{                   
                        vue2.frete = 'R$ 0,00'
                    }
                    let f = vue2.frete.replace('R$','')
                    let frete = parseFloat(f.replace('.',','))
                    let forma =''
                    if(vue2.tipo == 'Cartão'){
                        forma = ''
                    }else if(vue2.troco === false){
                        forma = '%0A%20-%20Troco p/ '+document.getElementById('change').value
                    }
                    for(let i = 0; i < vue2.pedido.length; i++){
                        let p = ""
                        let p2 =""
                        for(let a =0; a< vue2.pedido[i].adicionais.length; a++){
                            if(vue2.pedido[i].adicionais[a].qtd >0){
                                    p += "%0A-%20"+vue2.pedido[i].adicionais[a].nome+"%3A%20*"+vue2.pedido[i].adicionais[a].qtd+"%20(R%24%20"+vue2.pedido[i].adicionais[a].vl+")*"
                            } 
                        }
                        for(let c =0; c< vue2.pedido[i].complementos.length; c++){
                            if(vue2.pedido[i].complementos[c].length>2){
                                for(let opc =0; opc< vue2.pedido[i].complementos[c].length; opc++){
                                    if(vue2.pedido[i].complementos[c][opc].qtd>0){                    
                                        p2 += "%0A-%20"+vue2.pedido[i].complementos[c][0]+"%3A%20*"+vue2.pedido[i].complementos[c][opc].nome+"*%20-%20*"+vue2.pedido[i].complementos[c][opc].qtd+"x%20("+vue2.pedido[i].complementos[c][opc].vl+")*"
                                    }
                                }
                            }else{                 
                                p2 += "%0A-%20"+vue2.pedido[i].complementos[c][0]+"%3A%20*"+vue2.pedido[i].qtd+"x%20(R%24%20"+vue2.pedido[i].complementos[c][1].replace('.',',')+")*"
                            }
                        }
                        adicional.push(p)
                        complementos.push(p2)
                        pedido.push("%0A%0A*"+vue2.pedido[i].nome+"*%0AQuantidade%3A%20*"+vue2.pedido[i].qtd+"*%0APreço%3A%20*R%24%20"+vue2.pedido[i].total.replace('.',',')+"*%0A-%20Complementos%3A")
                        pedidos += pedido[i]+adicional[i]+complementos[i]
                    }
                    let info = [] 
                    let id = ''
                    for(let i = 0; i<document.getElementsByClassName('form-control').length;i++){
                        info.push(document.getElementsByClassName('form-control')[i].value)
                        form.append(document.getElementsByClassName('form-control')[i].name, document.getElementsByClassName('form-control')[i].value)
                        form.append('total',vue2.total)
                        form.append('valor',"R$ "+vue2.valor.replace('.',','))
                        form.append('pedido', JSON.stringify(vue2.pedido))
                        form.append('data', agora)
                        form.append('pagamento', vue2.tipo)
                        form.append('entrega', vue2.frete)
                        form.append('observa', obs)
                        form.append('troco', (document.querySelector('input[name="change"]').value.replace(/[^0-9,]/g, "")).replace(",","."))
                        
                    } 
                    fetch(WACroot+'api/pedidos.php',{method: "POST", body: form}).then(a =>a.text()).then(
                        data =>{id = data                            
                        Swal.fire({
                            title: 'Informação !',
                            text: "Podemos armazenas essas informações para automatizar esse processo em futuras compras?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Não',
                            confirmButtonText: 'Sim'
                        }).then((result) => {
                            document.getElementsByClassName('obsConfirmacao')[0].style.display = 'none'
                            document.getElementsByClassName('infoEntregaConfirmacao ')[0].style.display = 'none'
                            document.getElementsByClassName('pagamentoConfirmacao')[0].style.display = 'none'
                            document.getElementsByClassName('valoresConfirmacao')[1].style.margin = '0px 0 15px 0px'
                            document.getElementsByClassName('informacoesEntrega')[0].style.padding = '0px 35px'
                            document.getElementsByClassName('informacoesEntrega')[0].style.top = '-35px'
                            document.getElementById('pedido-concluido').style.display = 'block'
                            document.getElementById('enviar').style.display = 'none'
                            document.getElementById('titulo').style.display = 'none'
                            document.getElementById('top').style.border = '0px'
                            document.getElementById('top').style.margin = '0px'
                            document.getElementById('voltar').style.top = '30px'
                            document.getElementById('voltar').style.right = '4%'
                            document.getElementsByClassName('informacoesEntrega')[0].style.display = 'block'
                            vue2.repetir = 'https://api.whatsapp.com/send?phone='+vue2.config.whatsapp+'&text='+agora+'%0A%0AOlá%2C%20gostaria%20de%20fazer%20um%20pedido%20%231493.%0A%0AOs%20itens%20escolhidos%20são%3A'+pedidos+'%0A%0A*Subtotal.%3A%20R%24%20'+vue2.valor.replace('.',',')+'*%0A*Entrega..%3A%20'+vue2.frete+'*%0A*Total.......%3A%20R%24%20'+parseFloat(parseFloat(vue2.valor)+frete).toFixed(2).replace('.',',')+'*%0A%0A*Observações%20do%20cliente%3A*%0A*'+obs+'*%0A---------------------------------------%0A%0AForma%20de%20Pagamento%3A%20'+vue2.tipo+forma+entrega+'%0A%0A*Nome%3A%20'+nome+'*%0A*Celular%3A%20'+celular+'*'
                            if (result.isConfirmed) {                        
                                localStorage.setItem('delivery_info',JSON.stringify(info))
                                window.open('https://api.whatsapp.com/send?phone='+vue2.config.whatsapp+'&text='+agora+'%0A%0AOlá%2C%20gostaria%20de%20fazer%20um%20pedido%20%23'+id+'.%0A%0AOs%20itens%20escolhidos%20são%3A'+pedidos+'%0A%0A*Subtotal.%3A%20R%24%20'+vue2.valor.replace('.',',')+'*%0A*Entrega..%3A%20'+vue2.frete+'*%0A*Total.......%3A%20R%24%20'+parseFloat(parseFloat(vue2.valor)+frete).toFixed(2).replace('.',',')+'*%0A%0A*Observações%20do%20cliente%3A*%0A*'+obs+'*%0A---------------------------------------%0A%0AForma%20de%20Pagamento%3A%20'+vue2.tipo+forma+entrega+'%0A%0A*Nome%3A%20'+nome+'*%0A*Celular%3A%20'+celular+'*')
                            }else{
                                window.open('https://api.whatsapp.com/send?phone='+vue2.config.whatsapp+'&text='+agora+'%0A%0AOlá%2C%20gostaria%20de%20fazer%20um%20pedido%20%23'+id+'.%0A%0AOs%20itens%20escolhidos%20são%3A'+pedidos+'%0A%0A*Subtotal.%3A%20R%24%20'+vue2.valor.replace('.',',')+'*%0A*Entrega..%3A%20'+vue2.frete+'*%0A*Total.......%3A%20R%24%20'+parseFloat(parseFloat(vue2.valor)+frete).toFixed(2).replace('.',',')+'*%0A%0A*Observações%20do%20cliente%3A*%0A*'+obs+'*%0A---------------------------------------%0A%0AForma%20de%20Pagamento%3A%20'+vue2.tipo+forma+entrega+'%0A%0A*Nome%3A%20'+nome+'*%0A*Celular%3A%20'+celular+'*')
                            }
                        })        
                    })
                    
                }
            }
        }
        
    }
})

if(delivery_valor>0){
    vue2.total = delivery_total
    vue2.valor = delivery_valor
    vue2.pedido=todosPedidos;
    for(let i = 0; i<vue2.pedido.length;i++){
        let c = '0'
        let a = '0'
        let resultado = null
        vue2.pedido[i].complementos.filter(a=>{if(a[1] !== 0){c= '1'}})
        vue2.pedido[i].adicionais.filter(b=>{if(b.qtd !== 0){a = '1'}})
        resultado = c+a
        Object.assign(vue2.pedido[i], {resultado:resultado})
    }
}

voltar = () =>{
  $("#delivery").load(WACroot)
}
new atualiza()
function atualiza(){
    if(delivery_valor>0){
        vue2.total = delivery_total
        vue2.valor = delivery_valor
        vue2.pedido=todosPedidos;
    }
}
function troco(a){
    vue2.troco = a
    if(a){
        document.getElementById('change').setAttribute('disabled', 'disabled')
    }else{
        document.getElementById('change').removeAttribute('disabled')
    }
}
!Array.isArray(vue2.entrega.entrega) && typeof(vue2.entrega.entrega) != "string"?
    void(0):
    vue2.api_entrega = JSON.parse(vue2.entrega.entrega)
vue2.pagamento.opicao = JSON.parse(vue2.pagamento.opicao)

let infor = JSON.parse(localStorage.getItem('delivery_info'))
if(Array.isArray(infor)){
    Swal.fire({
        title: 'Informação !',
        text: "Você é "+infor[2]+" do telefone "+infor[1]+" ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Não',
        confirmButtonText: 'Sim'
    }).then((result) => {
        if(result.isConfirmed) {
            vue2.telefone = infor[1]
            vue2.nome = infor[2]
            vue2.bairros = infor[3]
            vue2.ceps = infor[8]
            vue2.complemento = infor[6]
            vue2.referencia = infor[7]
            vue2.numero = infor[5]
            vue2.endereco = infor[4]
            if(vue2.entrega.tipo == 'bairro'){
                vue2.api_entrega.filter(b=>{
                    if(infor[3] == b.bairro){
                        vue2.frete = b.valor
                    }   
                })
            }else{
                vue2.api_entrega.filter(b=>{
                    if(parseInt(infor[3]) >= parseInt(b.inicio) && parseInt(infor[3]) <= parseInt(b.fim)){
                        vue2.frete = b.valor                        
                    }
                })
            }
        }
    })
}
function repetir(){
    window.open(vue2.repetir)
}
function voltar(){
    $("#delivery").load(WACroot)
}

function clipboard() {
  var copyText = document.getElementById("pixchave");
  copyText.select();
  copyText.setSelectionRange(0, 99999); 
  navigator.clipboard.writeText(copyText.value);
  
}
</script>
</body>

</html>