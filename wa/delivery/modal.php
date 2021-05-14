<?php
    header('Access-Control-Allow-Origin: *');
	require_once('../../includes/funcoes.php');
	require_once('../../database/config.database.php');
	require_once('../../database/config.php');
    $db = DBRead('delivery_produto','*',"WHERE id ='{$_GET["id"]}'");    
    $complementos = json_encode(DBRead('delivery_complemento','*',"WHERE status ='Ativo'"));
    $adicionais = json_encode(DBRead('delivery_adicional','*',"WHERE status ='Ativo'"));
    $produtos = json_encode($db);
?>  <script src='https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js'></script>
    <link rel="stylesheet"
        href="<?php echo ConfigPainel('base_url') ?>wa/delivery/teste/bootstrap.min.css">
    <link rel="stylesheet"
        href="<?php echo ConfigPainel('base_url') ?>wa/delivery/teste/cardapio.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<style>
    body{
        background:transparent !important;
    }
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>   

<body>   
    <div class="modalComplexo" id="modalComplexo">
        <div class="box"> 
            <div class="header">
                <span @click="algo()" id="fecharf" onclick="close()" class="fechar" aria-hidden="true">×</span>
            </div>
            <div class="body" v-for="produto, id of produtos">
                <div class="nomeProduto">
                    <h3 class="price">{{produto.valor}}</h3>
                    <h3>{{produto.nome}}</h3>
                    <p>{{produto.descricao}}</p>
                    <input type="hidden" name="complex-product-uuid" value="78bf3955-10da-445d-897b-9b39cc7fc036">
                    <input type="hidden" name="complex-product-name" value="Grande">
                </div>
                <div v-if="complemento.tipo == 1 || complemento.tipo == 0" v-for="complemento, idc of produtos[id].complementos" class="group" data-uuid="84da382f-8b6a-4cdb-abef-9f0ce65e5f28" data-min-qtt="1" data-max-qtt="2" data-name="Principal">
                    <div class="title">
                        <span class="required">Obrigatório</span>
                        <h4>{{complemento.nome}}</h4>
                    </div>
                    <div class="row selected_qtt">
                        <div class="col-12"> 
                            Você deve selecionar ao menos 
                            <span class="green">1</span>
                            e no máximo 
                            <span class="green">{{complemento.max}}</span>
                            opções.
                            <br>
                            Você selecionou 
                            <span class="qtt green">0</span>.
                        </div>
                    </div>
                    <div class="option" v-for="opcao, idp of produtos[id].complementos[idc].opcao" data-uuid="0f66c8e7-aed9-4a79-8bd9-337c2fba72bf">
                        <div class="row" >
                            <div class="col-7 align-self-center">
                                <h5>{{opcao.nome}}</h5>
                            </div>
                            <div class="col-5 align-self-center text-right">                                
                                <div class="input-group " v-if="complemento.tipo == 0">
                                    <div class="input-group-prepend">
                                        <button style="min-width: 2.5rem"  class="btn btn-decrement btn-outline-secondary" type="button" @click="remove(idc, idp+1, 'c')">
                                            <strong>-</strong>
                                        </button>
                                    </div>
                                    <input type="number" min="0" inputmode="decimal" v-model="pedido.complementos[idc][idp+1].qtd" style="text-align: center" class="form-control option-qtt" placeholder="">
                                    <div class="input-group-append">
                                        <button style="min-width: 2.5rem" @click="add(idc, idp+1, 'c')" class="btn btn-increment btn-outline-secondary" type="button">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </div>
                                <div v-else class="checkbox">                             
                                    <input type="radio" :name="complemento.nome" v-model="pedido.complementos[idc].escolha" class="option-qtt" :value="opcao.nome" :id="opcao.nome" data-name="Mini" data-price="15.00">
                                    <label :for="opcao.nome"></label>                              
                                </div>                         
                                <p class="price">{{opcao.valor == 'R$ 0,00'?'Grátis':'+ '+opcao.valor}}</p>
                            </div>
                        </div>
                    </div>                                      
                </div>                
                <div v-for="adicional, ida of produtos[id].adicionais" class="group" data-uuid="f8a507e3-5637-44af-9bc0-8c26dc753119" data-min-qtt="1" data-max-qtt="1" data-name="Tamanho">
                    <div class="title">                        
                        <h4>ADICIONAIS</h4>                      
                    </div>                    
                    <div class="row selected_qtt">
                        <div class="col-12">
                            Você deve selecionar
                            <span class="green">1</span> opção.                        
                            <br>Você selecionou 
                            <span class="qtt green">0</span>.
                        </div>
                    </div>
                    <div class="option" data-uuid="70e720cc-a8c8-4dfd-8429-0a443b2804c2">
                        <div class="row">
                            <div class="col-7 align-self-center">
                                <h5>{{adicional.nome}}</h5>                                                     
                            </div>                
                            <div class="col-5 align-self-center text-right">                          
                                <div class="input-group " >
                                    <div class="input-group-prepend">
                                        <button style="min-width: 2.5rem" @click="remove(ida,null, 'a')"  class="btn btn-decrement btn-outline-secondary" type="button">
                                            <strong>-</strong>
                                        </button>
                                    </div>
                                    <input type="number" min="0"  inputmode="decimal" v-model="pedido.adicionais[ida].qtd" style="text-align: center" class="form-control option-qtt" placeholder="">
                                    <div class="input-group-append">
                                        <button style="min-width: 2.5rem" @click="add(ida,null, 'a')" class="btn btn-increment btn-outline-secondary" type="button">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </div>                          
                                <p class="price">{{adicional.valor == 'R$ 0,00'?'Grátis':'+ '+adicional.valor}}</p>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="footer">
                    <div class="right">
                        <div class="row">
                            <div class="col-5">                                
                                <div class="input-group  ">
                                    <div class="input-group-prepend">
                                        <button style="min-width: 2.5rem" @click="total<= 0?total=0: total--" class="btn btn-decrement btn-outline-secondary"  type="button">
                                            <strong>-</strong>
                                        </button>
                                    </div>
                                    <input type="number" v-model="total" style="text-align: center" class="form-control qtt" >
                                    <div class="input-group-append">
                                        <button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" @click="total++" type="button">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 confirmar">
                                <button type="button" @click="concluir()" class="adicionar">Adicionar<br>{{produto.valor}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>

 const vue = new Vue({
    el: '#modalComplexo',
    data:{
         produtos: <?php echo $produtos ?>,
         complementos: <?php echo $complementos ?>, 
         adicionais: <?php echo $adicionais ?>,
         total:0, 
         pedido:{complementos:[], adicionais:[]}
    },
    methods: {
        algo: function(){
            window.parent.location.assign('javascript:document.getElementById("carrinho").setAttribute("class", "hidden")')
            window.location=""
        },
        add: function(a,b,c){
            if(c == 'c'){
                vue.pedido.complementos[a][b].qtd = vue.pedido.complementos[a][b].qtd+1
            }else{
                vue.pedido.adicionais[a].qtd = vue.pedido.adicionais[a].qtd+1
            }
            this.$forceUpdate()
        },
        remove: function(a,b,c){
            if(c == 'c'){
                vue.pedido.complementos[a][b].qtd <= 0 ?
                    vue.pedido.complementos[a][b].qtd=0: 
                    vue.pedido.complementos[a][b].qtd = vue.pedido.complementos[a][b].qtd-1
            }else{
                vue.pedido.adicionais[a].qtd <= 0 ?
                    vue.pedido.adicionais[a].qtd=0: 
                    vue.pedido.adicionais[a].qtd = vue.pedido.adicionais[a].qtd-1
            }
            this.$forceUpdate()
        }, 
        concluir: function(){
            window.parent.location.assign('javascript:document.getElementById("carrinho").setAttribute("class", "hidden")')
            window.location=""
        }   
    },
    mounted: function () {
        this.$nextTick(function () {
            this.produtos[0].adicionais.forEach((a,i)=>{
                this.adicionais.filter((b)=>{
                    if(b.nome == a.nome && b.status=='Ativo'){
                        this.pedido.adicionais.push({nome:this.produtos[0].adicionais[i].nome,qtd:0}) 
                    }
                })
            })
        })
    },
 })
 vue.produtos[0].adicionais =JSON.parse(vue.produtos[0].adicionais)
 vue.produtos[0].complementos =JSON.parse(vue.produtos[0].complementos)
 vue.produtos[0].dias =JSON.parse(vue.produtos[0].dias)
 

 vue.produtos[0].complementos.forEach((a,i)=>{
    vue.complementos.filter((b)=>{
        if(b.nome == a.nome && b.status=='Ativo'){
            vue.pedido.complementos[i] = [b.nome]
            if(b.tipo == 1){
                Object.assign(vue.pedido.complementos[i],{escolha:null}) 
            }
            for(let ii = 0 ; ii< vue.produtos[0].complementos[i].opcao.length; ii++){                
                if(b.tipo == 0){
                    vue.pedido.complementos[i].push({nome:vue.produtos[0].complementos[i].opcao[ii].nome, qtd:0}) 
                }else{
                    
                }
            }                      
            Object.assign(vue.produtos[0].complementos[i],{tipo:b.tipo})
        }    
    })
 })
 
</script>