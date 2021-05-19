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
                    <h3 class="price">{{produto.valor.replace('.','')}}</h3>
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
                    <div class="row selected_qtt" v-if="complemento.tipo == 0">
                        <div class="col-12"> 
                            Você deve selecionar ao menos 
                            <span class="green">1</span>
                            e no máximo 
                            <span class="green">{{complemento.max}}</span>
                            opções.
                            <br>
                            Você selecionou 
                            <span class="qtt green">{{pedido.complementos[idc][1]}}</span>.
                        </div>
                    </div>
                    <div class="row selected_qtt" v-else>
                        <div class="col-12">
                            Você deve selecionar
                            <span class="green">1</span> opção.                        
                            <br>Você selecionou 
                            <span class="qtt green" :id="'sel'+idc">0</span>.
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
                                        <button style="min-width: 2.5rem"  class="btn btn-decrement btn-outline-secondary" type="button" @click="remove(idc, idp+2, 'c', opcao.valor.replace(/[^0-9,-]+/g,''))">
                                            <strong>-</strong>
                                        </button>
                                    </div>
                                    <input type="number" min="0" inputmode="decimal" @change="edit(idc,idp+2,'c',$event.target.value, complemento.max, opcao.valor.replace(/[^0-9,-]+/g,'') )" :value="pedido.complementos[idc][idp+2].qtd" style="text-align: center" class="form-control option-qtt" placeholder="">
                                    <div class="input-group-append">
                                        <button style="min-width: 2.5rem" @click="add(idc, idp+2, 'c', complemento.max, opcao.valor.replace(/[^0-9,-]+/g,''))" class="btn btn-increment btn-outline-secondary" type="button">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </div>
                                <div v-else class="checkbox">                             
                                    <input type="radio" :name="complemento.nome" @change="sel(idc, opcao.valor.replace(/[^0-9,-]+/g,''))" v-model="pedido.complementos[idc].escolha" class="option-qtt" :value="opcao.nome" :id="opcao.nome" data-name="Mini" data-price="15.00">
                                    <label :for="opcao.nome"></label>                              
                                </div>                         
                                <p class="price">{{opcao.valor == 'R$ 0,00'?'Grátis':'+ '+opcao.valor}}</p>
                            </div>
                        </div>
                    </div>                                      
                </div>                
                <div  class="group" data-uuid="f8a507e3-5637-44af-9bc0-8c26dc753119" data-min-qtt="1" data-max-qtt="1" data-name="Tamanho">
                    <div class="title">                        
                        <h4>ADICIONAIS</h4>                      
                    </div>                    
                   <div v-if="pedido.adicionais[ida]" v-for="adicional, ida of produtos[id].adicionais" >
                        <div class="option" data-uuid="70e720cc-a8c8-4dfd-8429-0a443b2804c2">
                            <div class="row">
                                <div class="col-7 align-self-center">
                                    <h5>{{adicional.nome}}</h5>                                                     
                                </div>                
                                <div class="col-5 align-self-center text-right">                          
                                    <div class="input-group " >
                                        <div class="input-group-prepend">
                                            <button style="min-width: 2.5rem" @click="remove(ida, null, 'a', adicional.valor.replace(/[^0-9,-]+/g,''))"  class="btn btn-decrement btn-outline-secondary" type="button">
                                                <strong>-</strong>
                                            </button>
                                        </div>
                                        <input type="number" min="0"  inputmode="decimal" @change="edit(ida,null,'a',$event.target.value, null, adicional.valor.replace(/[^0-9,-]+/g,''))" :value="pedido.adicionais[ida].qtd" style="text-align: center" class="form-control option-qtt" placeholder="">
                                        <div class="input-group-append">
                                            <button style="min-width: 2.5rem" @click="add(ida,null, 'a',null, adicional.valor.replace(/[^0-9,-]+/g,''))" class="btn btn-increment btn-outline-secondary" type="button">
                                                <strong>+</strong>
                                            </button>
                                        </div>
                                    </div>                          
                                    <p class="price">{{adicional.valor == 'R$ 0,00'?'Grátis':'+ '+adicional.valor}}</p>
                                </div>
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
                                        <button style="min-width: 2.5rem" @click="total<= 1?total=1: total--;pedido.total = Math.abs(parseFloat(valor)*total).toFixed(2)" class="btn btn-decrement btn-outline-secondary"  type="button">
                                            <strong>-</strong>
                                        </button>
                                    </div>
                                    <input type="number" v-model="total" style="text-align: center" class="form-control qtt" >
                                    <div class="input-group-append">
                                        <button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" @click="total++;pedido.total = Math.abs(parseFloat(valor)*total).toFixed(2)" type="button">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 confirmar">
                                <button type="button" @click="concluir()" class="adicionar">Adicionar<br>R$ {{pedido.total}}</button>
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
         total:1, 
         valor:0,
         pedido:{total:0,complementos:[], adicionais:[]}
    },    
    methods: {
        algo: function(){
            window.parent.location.assign('javascript:document.getElementById("carrinho").setAttribute("class", "hidden")')
            window.location=""
        },
        edit: function(a,b,c,d,e,f){
            let valor = parseFloat(f.replace(',','.'))
            let count = parseInt(Math.abs(d))               
            if(c == 'c'){
                for(let i =2; i<vue.pedido.complementos[a].length; i++){
                    if(vue.pedido.complementos[a][i].nome != vue.pedido.complementos[a][b].nome){
                       count += vue.pedido.complementos[a][i].qtd 
                    }
                }
                if(count <= e){
                    let real = parseFloat((count*valor)-(this.pedido.complementos[a][b].qtd*valor))
                    this.pedido.complementos[a][b].qtd = parseInt(Math.abs(d))
                    vue.pedido.complementos[a][1] = count                    
                    vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+real).toFixed(2)
                    vue.valor = parseFloat(vue.valor+real)
                }
            }else{
                let real = parseFloat((count*valor)-(this.pedido.adicionais[a].qtd*valor))
                vue.pedido.adicionais[a].qtd = parseInt(Math.abs(d))
                vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+real).toFixed(2)
                vue.valor = parseFloat(vue.valor+real)
            }
            this.$forceUpdate()
        },
        add: function(a,b,c,d,e){
            let valor = parseFloat(e.replace(',','.')) 
            if(c == 'c' && vue.pedido.complementos[a][1] < d){
                vue.pedido.complementos[a][b].qtd = vue.pedido.complementos[a][b].qtd+1
                vue.pedido.complementos[a][1] = vue.pedido.complementos[a][1]+1
                vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+valor).toFixed(2)
                vue.valor = parseFloat(vue.valor+valor)
            }else if( c != 'c'){
                vue.pedido.adicionais[a].qtd = vue.pedido.adicionais[a].qtd+1
                vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+valor).toFixed(2)
                vue.valor = parseFloat(vue.valor+valor)
             
            }
            this.$forceUpdate()
        },
        remove: function(a,b,c,d){
            let valor = parseFloat(d.replace(',','.')) 
            if(c == 'c'){
                if(vue.pedido.complementos[a][b].qtd <= 0){
                    vue.pedido.complementos[a][b].qtd=0
                }else{
                    vue.pedido.complementos[a][b].qtd = vue.pedido.complementos[a][b].qtd-1
                    vue.pedido.complementos[a][1] = vue.pedido.complementos[a][1]-1
                    vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))-valor).toFixed(2)
                    vue.valor = parseFloat(vue.valor-valor)
                } 
            }else{
                if(vue.pedido.adicionais[a].qtd <= 0){
                    vue.pedido.adicionais[a].qtd=0 
                }else{
                    vue.pedido.adicionais[a].qtd = vue.pedido.adicionais[a].qtd-1
                    vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))-valor).toFixed(2)
                    vue.valor = parseFloat(vue.valor-valor)
                }
            }
            this.$forceUpdate()
        }, 
        concluir: function(){
            window.parent.location.assign('javascript:document.getElementById("carrinho").setAttribute("class", "hidden");new atualiza()')
            window.location=""
            if(sessionStorage.getItem('delivery_valor') == null){
                sessionStorage.setItem('delivery_valor',parseFloat(vue.pedido.total)) 
                sessionStorage.setItem('delivery_total',vue.total) 
            }else{
               let valor = parseFloat(sessionStorage.getItem('delivery_valor'))+parseFloat(vue.pedido.total)
               let total = parseFloat(sessionStorage.getItem('delivery_total'))+vue.total
               sessionStorage.setItem('delivery_valor',valor) 
               sessionStorage.setItem('delivery_total',total) 
            }
        },
        sel: function(a, b){  
            let valor = parseFloat(b.replace(',','.'))           
            vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+valor-vue.pedido.complementos[a][1]).toFixed(2)
            vue.valor = parseFloat(vue.valor+valor-vue.pedido.complementos[a][1])           
            vue.pedido.complementos[a][1] =  valor.toFixed(2)
            document.getElementById('sel'+a).innerText = '1'
            this.$forceUpdate()
        }   
    },
    mounted: function () {
        this.$nextTick(function () {
            this.produtos[0].adicionais.forEach((a,i)=>{
                if(this.adicionais){
                    this.adicionais.filter((b)=>{
                        if(b.nome == a.nome && b.status=='Ativo'){                        
                            this.pedido.adicionais.push({nome:this.produtos[0].adicionais[i].nome,qtd:0}) 
                        }
                    })
                }
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
            vue.pedido.complementos[i] = [b.nome, 0]
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
let result = vue.produtos[0].valor.replace(/[^0-9,-]+/g,"")
vue.pedido.total= parseFloat(result.replace(',','.')).toFixed(2)
vue.valor = parseFloat(vue.pedido.total)
</script>