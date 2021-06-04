<!DOCTYPE html>
<html lang="pt-br">
    <?php
     header('Access-Control-Allow-Origin: *');
     require_once('../../includes/funcoes.php');
     require_once('../../database/config.database.php');
     require_once('../../database/config.php');
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.10.2/underscore-min.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@5.0.0/bootstrap-4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url') ?>epack/css/elements/animate.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/delivery/src/style/main.css">
<?php 
    require_once('../../wa/delivery/src/style/wactrl.php'); 
    require_once('../../wa/delivery/src/style/cardapex.php');
    ?>
    
</head>
<body class="home blog">
    <div id="controller">

            <span class="barraDados hidden"></span>
            <input type="hidden" value="14981337597" id="whatsapp-phone">
        <section id="confirmacao-pedido " class="boxConfirmacao">
            <div class="container-fluid p-0">
                <div class="row" style="padding-top:20px">                        
                    <div class="col-md-12">
                        <a onclick="voltar()" id="voltar-cardapio" class="voltar">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-top:50px;border-top: 1px #dedede solid;">
                    <div class=" col-md-12">
                        <div class="center" style="box-shadow:none">
                            <!-- lista-itens -->
                            <div class="lista-itens">
                                <h3 class="title">Confirmação de Pedido</h3>
                                <div class="basketContent">
                                    <h3>Seu Pedido</h3>
                                    <div class="basket-body" id="basket">
                                        <div class="itemBasket" v-for="list,id of pedido">
                                            <div @click="openhide(id)" :id="'p'+id" class="name opened">
                                                <i class="fas fa-chevron-right seta"></i>
                                                <span>{{list.nome}}</span>                                                
                                            </div>
                                            <div :id="'c'+id" class="content">
                                                <div :id="'m'+id" class="complementos" >
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
                                                                {{opc.qtd*list.qtd}} <span>{{opc.vl === 'R$ 0,00'?'':' x '+opc.vl}}</span>
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
                                                                {{adicional.qtd*list.qtd}} x <span>{{adicional.vl}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="right">
                                                    <span data-identifier="178b3269e8e18a7ff5523da479ed03e50bad67535152c7961272c2e99405605b" style="white-space:nowrap"  class="price">Subtotal: <b style="color:#22a200"> R$ {{list.total.replace('.',',')}}</b></span>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="obsConfirmacao">
                                    <label class="text-center">Observações</label>
                                    <input type="text" id="obsConfirmacao" name="obsConfirmacao"  placeholder="Detalhes do Pedido">
                                </div>
                            </div>
                            <div class="infoEntregaConfirmacao">
                                <h3 class="title">Informações para Entrega</h3>
                                <div class="dados-usuario">
                                    <div class="row">
                                        <div class="col-md-5 col-6 campo">
                                            <input type="text" id="phone" name="phone" placeholder="Celular" class="mobile"   maxlength="15">
                                        </div>
                                        <div class="col-md-7 col-6 campo">
                                            <input type="text" id="name" name="name" placeholder="Nome" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="seleciona">
                                    <div class="box">
                                        <a id="entrega" data-open="entrega" class="ativo">
                                            <i class="fas fa-motorcycle"></i>
                                            Entrega
                                        </a>
                                        <a id="retirada" data-open="retirada">
                                            <i class="fas fa-hotel"></i> Retirar no
                                            Local
                                        </a>
                                    </div>
                                </div>
                                <!-- Dados Entrega -->
                                <div id="entrega" class="formEntrega">
                                    <div class="row">
                                        <div class="col-md-3 cep campo">
                                            <input type="text" id="zip_code" name="zip_code" placeholder="CEP" class="cep"
                                                autocomplete="off" maxlength="9">
                                        </div>
                                        <div class="col-md-7 col-6 endereco campo">
                                            <input type="text" id="address" name="address" placeholder="Endereço"  maxlength="100" autocomplete="off">
                                        </div>
                                        <div class="col-md-2 col-6 numero campo">
                                            <input type="text" id="number" name="number" placeholder="Nº" maxlength="10"  autocomplete="off">
                                        </div>
                                        <input type="hidden" id="city" name="city" maxlength="50" autocomplete="off" value="">
                                        <input type="hidden" id="state" name="state" autocomplete="off" value="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 complemento campo">
                                            <input type="text" id="additional1" name="additional1"  placeholder="Complemento (Ex: Bloco/Apto)" maxlength="100">
                                        </div>
                                        <div class="col-md-4 col-6 bairro campo">
                                            <input type="text" id="additional2" name="additional2" placeholder="Bairro"  maxlength="100">
                                        </div>
                                        <div class="col-md-3 col-6 ref campo">
                                            <input type="text" id="additional3" name="additional3"  placeholder="Ponto de Ref." maxlength="100">
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
                                        </div>
                                        <div id="pedido_subtotal" class="col-3 col-lg-2" >
                                            <span>Subtotal</span>
                                            <strong id="pedido_subtotal_valor">R$ {{valor.replace('.',',')}}</strong>
                                        </div>
                                        <div id="pedido_taxa_entrega" class="col-4 col-sm-3" >
                                            <span>Taxa de Entrega</span>
                                            <strong id="pedido_taxa_entrega_valor">A calcular</strong>
                                        </div>
                                        <div id="pedido_total" class="col-3 col-lg-2 total" style="display: none;">
                                            <span>Total</span>
                                            <strong id="pedido_total_valor">{{valor.replace('.',',')}}</strong>
                                        </div>
                                        <div id="fora_de_area" class="col-12" style="display: none;">
                                            <strong id="fora_de_area_valor" class="red">Fora da área de atendimento</strong>
                                        </div>
                                    </div>
                                </div>
                                <!-- Retirada -->
                                <div id="retirada" class="formEntrega" style="display: none">
                                    <div class="card login retirada">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Endereço para Retirada</h5>
                                            <p>
                                                <i class="fas fa-map-marker-alt"></i> <strong>
                                                    Rua Araújo Leite
                                                    - Bauru
                                                    / SP
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                            <div id="pagamentoConfirmacao" class="pagamentoConfirmacao">
                                <h3 class="title">Formas de Pagamento</h3>
                                <div class="box">
                                    <input type="radio" name="pagamento" id="maquininha">
                                    <label for="maquininha">Cartões (Crédito, Débito, etc)</label>
                                    <div class="secundario bandeiras animated sladeInDown faster" style="display:none">
                                        <select id="selecaoBandeira" class="form-control">
                                            <option value="">Selecione</option>
                                            <option value="fc8d8b90-ac2e-43d9-a04d-c10d03d7d168">Crédito - American Express </option>
                                            <option value="60210829-e89c-4114-bad6-b8d9bbfde8bf">Crédito - Banricompras  </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box">
                                    <input type="radio" name="pagamento" id="dinheiro"
                                        data-uuid="8b1ffbcf-8317-4fcf-b3ef-e9ce1195feaa">
                                    <label for="dinheiro">Dinheiro</label>
                                    <div class="secundario troco slideInDown faster" style="display:none">
                                        <p><i class="fas fa-money-bill-alt"></i> Troco para:</p>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">R$</div>
                                            </div>
                                            <input type="money" id="change" name="change" placeholder="0,00"   class="form-control price" maxlength="6">
                                        </div>
                                        <div class="input-group box-sem-troco">
                                            <input type="checkbox" name="no-change" id="no-change">
                                            <label for="no-change">Sem troco</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /center -->
                    </div>
                </div>
    
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="center" style="box-shadow:none">
                            <div class="avisoEnviado text-center">
                                <h3>Quase lá...</h3>
                                <p>Seu pedido ainda não foi enviado, clique no botão abaixo para enviar no WhatsApp!</p>
                                <div class="abrirWhats">
                                    <a id="enviar-pedido" class="btn"
                                        data-number="55014981337597">
                                        Envie seu pedido via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Box Confirmação -->
        <section id="pedido-concluido" class="boxConfirmacao" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="center">
                            <div class="avisoEnviado text-center">
                                <h3>Pedido concluído!</h3>
                                <p>Enviou o pedido via WhatsApp? Caso não tenha certeza, envie novamente! Clique no botão
                                    abaixo para enviar no WhatsApp!</p>
                                <div class="abrirWhats mb-4">
                                    <a href="https://marmitarias.cardapex.com.br/checkout/#" class="btn"
                                        data-number="55014981337597">
                                        Envie seu pedido via WhatsApp
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
const vue = new Vue({
    el: "#controller",
    data: {        
        pedido:[],
        total:0,
        valor:'0.00'
    },
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
    }
})
function atualiza(){
    if(sessionStorage.getItem('delivery_valor') != null ){
        vue.total = parseFloat(sessionStorage.getItem('delivery_total'))
        vue.valor = parseFloat(sessionStorage.getItem('delivery_valor')).toFixed(2)
        vue.pedido=JSON.parse(sessionStorage.getItem('delivery_pedido'))
        for(let i = 0; i<vue.pedido.length;i++){
            let c = '0'
            let a = '0'
            let resultado = null
            vue.pedido[i].complementos.filter(a=>{if(a[1] !== 0){c= '1'}})
            vue.pedido[i].adicionais.filter(b=>{if(b.qtd !== 0){a = '1'}})
            resultado = c+a
            Object.assign(vue.pedido[i], {resultado:resultado})
        }
    }
} 
new atualiza()
voltar = () =>{
  $("#delivery").load(WACroot)
}
</script>
</body>

</html>