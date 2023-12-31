<?php
    header('Access-Control-Allow-Origin: *');
	require_once('../../includes/funcoes.php');
	require_once('../../database/config.database.php');
	require_once('../../database/config.php');
    $db = DBRead('delivery_produto','*',"WHERE id ='{$_GET["id"]}'");    
    $complementos = json_encode(DBRead('delivery_complemento','*',"WHERE status ='Ativo' "));
    $adicionais = json_encode(DBRead('delivery_adicional','*',"WHERE status ='Ativo' "));
    $produtos = json_encode($db);
    $conf = DBRead('delivery_config','*')[0];
    $config = json_encode($conf);
?>      
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url'); ?>wa/delivery/src/style/bootstrap.min.css">
    <?php require_once('../../wa/delivery/src/style/cardapex.php') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<style>

    
    .voltar{
        float: left !important;
        background: red;
        padding: 5px 25px !important;
        margin: 15px;
        color: white;
        font-size: 13px !important;
        border-radius: 25px;
        cursor:pointer;
    }
    .text-right{
        text-align: right!important;
    }
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
.modalComplexo .box .nomeProduto:before {
    border-top: 15px solid <?php echo $conf['pop_fundo']?>  !important;
}
.nao{
    text-decoration: line-through !important;
    font-weight:700 !important;
    font-size:13px !important;
    top: 5px;
    position: relative;
    margin-right: 5px !important;
    color:<?php echo $conf['pop_fechar']?>  !important;
}
</style>   

<body>  
    <div class="modalComplexo" id="modalComplexo">
        <div class="box"> 
            <div class="header">
                <span @click="algo()" id="fecharf" onclick="close()" class="fechar" aria-hidden="true">×</span>
                <span @click="algo()" id="fecharf" onclick="close()" class="voltar d-block d-md-none  d-lg-none" aria-hidden="true">voltar</span>
            </div>
            <div class="body" v-for="produto, id of produtos">
                <div class="nomeProduto" style="background:<?php echo $conf['pop_fundo']?>  !important;">
                    <h3 class="price" style="color:<?php echo $conf['pop_fechar']?>  !important;">{{produto.valor.replace('.','') }}</h3>
                    <h3 v-if="produto.promocao == 'S'" class="price nao" >{{ produto.v_cortado.replace('.','')}}</h3>
                    <h3 style="color:<?php echo $conf['pop_titulo']?>  !important;">{{produto.nome}}</h3>
                    <p style="color:<?php echo $conf['pop_descricao']?>  !important;">{{produto.descricao}}</p>
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
                            
                            opção.
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
                                        <button style="min-width: 2.5rem"  class="btn btn-decrement btn-outline-secondary" type="button" @click="remove(idc, idp+2, 'c', opcao.valor.replace(/[^0-9,-]+/g,''), complemento.max)">
                                            <strong>-</strong>
                                        </button>
                                    </div>
                                    <input type="number" min="0" inputmode="decimal" @change="edit(idc,idp+2,'c',$event.target.value, complemento.max, opcao.valor.replace(/[^0-9,-]+/g,''),id )" :value="pedido.complementos[idc][idp+2].qtd" style="text-align: center; padding:0px !important" class="form-control option-qtt" placeholder="">
                                    <div class="input-group-append">
                                        <button style="min-width: 2.5rem" @click="add(idc, idp+2, 'c', complemento.max, opcao.valor.replace(/[^0-9,-]+/g,''))" class="btn btn-increment btn-outline-secondary" type="button">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </div>
                                <div v-else class="checkbox">                             
                                    <input type="radio" :name="complemento.nome" @change="sel(idc, opcao.valor.replace(/[^0-9,-]+/g,''), opcao.nome,id)" v-model="pedido.complementos[idc].escolha" class="option-qtt" :value="opcao.nome" :id="opcao.nome" data-name="Mini" data-price="15.00">
                                    <label :for="opcao.nome"></label>                               
                                </div>                         
                                <p class="price">{{opcao.valor == 'R$ 0,00'?'Grátis':'+ '+opcao.valor}}</p>
                            </div>
                        </div>
                    </div>                                      
                </div>                
                <div  class="group" data-uuid="f8a507e3-5637-44af-9bc0-8c26dc753119" data-min-qtt="1" data-max-qtt="1" data-name="Tamanho">
                    <div class="title">                        
                        <h4 v-if="produtos[id].adicionais.length >0">ADICIONAIS</h4>                      
                    </div>                    
                   <div v-for="adicional, ida of pedido.adicionais" >
                        <div style="border-bottom: 1px #efefef solid;" class="option" data-uuid="70e720cc-a8c8-4dfd-8429-0a443b2804c2">
                            <div class="row">
                                <div class="col-7 align-self-center">
                                    <h5>{{adicional.nome}}</h5>                                                     
                                </div>                
                                <div class="col-5 align-self-center text-right">                          
                                    <div class="input-group " >
                                        <div class="input-group-prepend">
                                            <button style="min-width: 2.5rem" @click="remove(ida, null, 'a', adicional.vl.replace(/[^0-9,-]+/g,''))"  class="btn btn-decrement btn-outline-secondary" type="button">
                                                <strong>-</strong>
                                            </button>
                                        </div>
                                        <input type="number" min="0"  inputmode="decimal" @change="edit(ida,null,'a',$event.target.value, null, adicional.vl.replace(/[^0-9,-]+/g,''))" :value="pedido.adicionais[ida].qtd" style="text-align: center; padding:0px !important" class="form-control option-qtt" placeholder="">
                                        <div class="input-group-append">
                                            <button style="min-width: 2.5rem" @click="add(ida,null, 'a',null, adicional.vl.replace(/[^0-9,-]+/g,''))" class="btn btn-increment btn-outline-secondary" type="button">
                                                <strong>+</strong>
                                            </button>
                                        </div>
                                    </div>                          
                                    <p class="price">{{adicional.vl == 'R$ 0,00'?'Grátis':'+ '+adicional.vl}}</p>
                                </div>
                            </div>
                        </div>                    
                   </div> 
                </div>
                <div v-if="produtos[id].adicionais.length == 0 && produtos[id].complementos.length == 0 ">
                    <figure class="figure">
                        <img :src="'uploads/'+produtos[id].imagem" class="figure-img img-fluid rounded" :alt="produtos[id].descricao">
                    </figure>
                </div>
                <div class="footer">
                    <div class="right">
                        <div class="row">
                            <div class="col-5">                                
                                <div class="input-group  ">
                                    <div class="input-group-prepend">
                                        <button style="min-width: 2.5rem" @click="retirar()" class="btn btn-decrement btn-outline-secondary"  type="button">
                                            <strong>-</strong>
                                        </button>
                                    </div>
                                    <input type="number" :value="total" @input="editAll($event.target.value)" style="text-align: center; padding:0px !important" class="form-control qtt" >
                                    <div class="input-group-append">
                                        <button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" @click="total++;pedido.total = Math.abs(parseFloat(valor)+parseFloat(pedido.total)).toFixed(2)" type="button">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 confirmar">
                                <button v-if="aviso != 'Estamos fechados'" type="button" @click="concluir()" class="adicionar">Adicionar<br>R$ {{new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(pedido.total)}}</button>
                                <button v-else type="button" class="adicionar" style="background:#dc3545!important; border: 1px #dc3545 solid;    border-bottom: 3px #dc3545 solid;">ESTAMOS FECHADOS<br> NO MOMENTO</button>
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
         c_valido:[],
         c_valor:[],
         a_valor:[],
         aviso:'<?php echo $_GET['horario'] ?>',
         valor:0,
         pedido:{qtd:1,nome: '<?php echo $db[0]['nome'] ?>',total:0,complementos:[], adicionais:[]}
    },   

    methods: {
        editAll: function(t){
            if(t> 0){
               let agragado = Math.abs((this.valor*this.total)-this.pedido.total),
               valor= t*this.valor
                this.pedido.total= parseFloat(valor+agragado).toFixed(2)
                this.total = t
            }else{
                this.$forceUpdate()
            }
        },
        retirar: function(){
            if(this.total<= 1){
                this.total=1
            }else{ 
                this.total--;
                this.pedido.total = Math.abs(parseFloat(this.valor)-parseFloat(this.pedido.total)).toFixed(2)
            }
        },
        algo: function(){
            window.parent.location.assign('javascript:document.getElementById("carrinho").setAttribute("class", "hidden")')
            window.location=""
        },
        edit: function(a,b,c,d,e,f,g){
            let valor = parseFloat(f.replace(',','.'))
            let count = parseInt(Math.abs(d))
            let contar = 0
            let v
            let z =0
            let desconto = parseInt(e)
            let fator
            if(c == 'c'){
            let pass_vl =  vue.c_valor[a][0]
            let pass = this.pedido.complementos[a][b].qtd
            let compara = parseFloat((count*valor)-(pass*valor))
                let agvl = 0
                let real = 0
                this.pedido.complementos[a][b].qtd = parseInt(Math.abs(d))
                for(let i =2; i<vue.pedido.complementos[a].length; i++){
                    if(vue.pedido.complementos[a][i].nome != vue.pedido.complementos[a][b].nome){
                       count += vue.pedido.complementos[a][i].qtd 
                    }
                    if(vue.pedido.complementos[a][i].vl != "R$ 0,00"){
                        contar += vue.pedido.complementos[a][i].qtd
                        v = vue.pedido.complementos[a][i].vl.replace(/[^0-9,-]+/g,'')
                        fator =Math.abs(contar-desconto)
                        if(vue.pedido.complementos[a][i].qtd >0){
                            if(contar>parseInt(e)){
                                agvl += parseFloat(v.replace(',','.'))* fator
                                vue.c_valor[a][0] =  agvl
                                vue.c_valido[a][0] = contar
                                real = parseFloat(agvl-pass_vl)
                            }
                        }
                    }
                }
                if(contar<=parseInt(e)){
                    vue.c_valor[a][0] =  0
                    vue.c_valido[a][0] = contar
                    if(pass_vl>0){
                        real = parseFloat(vue.c_valor[a][0]-pass_vl)
                    }
                }
                
                this.pedido.complementos[a][b].qtd = parseInt(Math.abs(d))
                vue.pedido.complementos[a][1] = count                    
                vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+real).toFixed(2)
                
            }else{
                let real = parseFloat((count*valor)-(this.pedido.adicionais[a].qtd*valor))
                vue.pedido.adicionais[a].qtd = parseInt(Math.abs(d))
                vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+real).toFixed(2)
            }
            this.$forceUpdate()
        },
        add: function(a,b,c,d,e){
            let valor = parseFloat(e.replace(',','.')) 
            if(c == 'c' ){
                if(vue.pedido.complementos[a][1] < d){
                    valor = 0
                }
                if(parseFloat(e)>0){
                        vue.c_valido[a][0] = vue.c_valido[a][0]+1
                        if(vue.c_valido[a][0] >= d){
                            vue.c_valor[a][0] = vue.c_valor[a][0]+parseFloat(valor)
                        }
                }
                vue.pedido.complementos[a][b].qtd = vue.pedido.complementos[a][b].qtd+1
                vue.pedido.complementos[a][1] = vue.pedido.complementos[a][1]+1
                vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+valor).toFixed(2)
            }else if( c != 'c'){
                vue.pedido.adicionais[a].qtd = vue.pedido.adicionais[a].qtd+1
                vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+valor).toFixed(2)
            }
            this.$forceUpdate()
        },        
        remove: function(a,b,c,d,e){
            let valor = parseFloat(d.replace(',','.')) 
            if(c == 'c'){
                if(vue.pedido.complementos[a][b].qtd <= 0){
                    vue.pedido.complementos[a][b].qtd=0
                }else{
                    
                     if(vue.c_valido[a][0] == 0){
                        valor = 0
                    }
                    if(parseFloat(d)>0 &&  vue.c_valido[a][0] > 0){
                        vue.c_valido[a][0] = vue.c_valido[a][0]-1
                        if(vue.c_valor[a][0]-parseFloat(valor)<0){
                            valor = vue.c_valor[a][0]
                            vue.c_valor[a][0] = 0
                        }else{
                            vue.c_valor[a][0] = vue.c_valor[a][0]-parseFloat(valor)
                             valor = parseFloat(valor)
                        }
                    }
                    vue.pedido.complementos[a][b].qtd = vue.pedido.complementos[a][b].qtd-1
                    vue.pedido.complementos[a][1] = vue.pedido.complementos[a][1]-1
                    vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))-valor).toFixed(2)
                } 
            }else{
                if(vue.pedido.adicionais[a].qtd <= 0){
                    vue.pedido.adicionais[a].qtd=0 
                }else{
                    vue.pedido.adicionais[a].qtd = vue.pedido.adicionais[a].qtd-1
                    vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))-valor).toFixed(2)
                }
            }
            this.$forceUpdate()
        },
        concluir: function(){
            let WACroot = window.location.href.split("?")[0].replace('modal.php','')

            if(WACroot.search('http:')>0){
                 WACroot =  WACroot.replace('http:', 'https:')
            } else if(WACroot.search('www.')<0){
                 WACroot =  WACroot.replace('https://', 'https://www.')
            }
            let c = false
            vue.pedido.complementos.filter(a=>{if(a[1] === 0){c= '1'}})
            let p = [vue.pedido]
            if(c != false){             
                window.parent.location.assign("javascript:     Swal.fire({ title: 'Erro',  text: 'Você precisa selecionar ao menos 1 item nos complementos', icon: 'error', confirmButtonColor: '#d33'})")
            }else{
                vue.pedido.qtd = vue.total
                p.push(vue.pedido)              
                
                window.parent.location.assign('javascript:document.getElementById("carrinho").setAttribute("class", "hidden");new atualiza('+JSON.stringify(p)+','+JSON.stringify(vue.total)+','+JSON.stringify(vue.pedido.total)+'); Swal.fire({    title: "Adicionado",    text: "Item adicionado com sucesso!",    icon: "success",    showCancelButton: true,    confirmButtonColor: "#3085d6",    cancelButtonColor: "#22a200",    confirmButtonText: "Enviar meu pedido",    cancelButtonText: "Escolher mais itens"  }).then((result) => {    if (result.isConfirmed) {   $("#delivery").load("'+WACroot+'checkout.php")       }  })')
                window.location=""
            }
        },
        sel: function(a, b, c){  
            let valor = parseFloat(b.replace(',','.'))           
            vue.pedido.total = Math.abs(parseFloat(vue.pedido.total.replace(',','.'))+valor-vue.pedido.complementos[a][1]).toFixed(2)
            vue.valor = parseFloat(vue.valor+valor-vue.pedido.complementos[a][1])           
            vue.pedido.complementos[a][1] = valor.toFixed(2)
            vue.pedido.complementos[a][0] = c
            document.getElementById('sel'+a).innerText = '1'
            this.$forceUpdate()
        }   
    },
    mounted: function () {
        Object.keys(this.adicionais).forEach(a=>{this.a_valor.push(0)})
        Object.keys(this.complementos).forEach(a=>{this.c_valor.push(0)})
        this.$nextTick(function () {
            this.produtos[0].adicionais.forEach((a,i)=>{
                if(this.adicionais){
                    this.adicionais.filter((b)=>{
                        if(b.nome == a.nome && b.status=='Ativo'){                        
                            this.pedido.adicionais.push({nome:this.produtos[0].adicionais[i].nome,qtd:0,vl:b.valor}) 
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
     if(vue.complementos){
        vue.complementos.filter((b)=>{
            if(b.nome == a.nome && b.status=='Ativo'){
                vue.pedido.complementos[i] = [b.nome, 0]
                if(b.tipo == 1){
                    Object.assign(vue.pedido.complementos[i],{escolha:null}) 
                }
                for(let ii = 0 ; ii< vue.produtos[0].complementos[i].opcao.length; ii++){                
                    if(b.tipo == 0){
                        vue.pedido.complementos[i].push({nome:vue.produtos[0].complementos[i].opcao[ii].nome, qtd:0,vl:vue.produtos[0].complementos[i].opcao[ii].valor}) 
                    }else{
                        
                    }
                }                      
                Object.assign(vue.produtos[0].complementos[i],{tipo:b.tipo})
            }    
        })
     }
 })
 for(let l=0;l<vue.produtos[0].complementos.length;l++){
    vue.c_valido.push({0:0})
    vue.c_valor.push({0:0})
 }
let result = vue.produtos[0].valor.replace(/[^0-9,-]+/g,"")
vue.pedido.total= parseFloat(result.replace(',','.')).toFixed(2)
vue.valor = parseFloat(vue.pedido.total)
</script>