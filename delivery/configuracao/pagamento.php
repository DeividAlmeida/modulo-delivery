<?php
error_reporting(0);
$array = DBRead('delivery_pagamento','*')[0];
if($array['opicao']==null ){
    $array['opicao'] = [
        'debito'=>[],
        'credito'=>[],
        'vale'=>[],
        'outro'=>[]
    ];
};
    $banco = json_encode($array);
    if(isset($_GET['editaPaga'])){
        $id = 1;
        $route ='&Paga';
        $db = 'delivery_pagamento';
        foreach($_POST as $nome => $value){
            $data[$nome]=$value;
        }
        $query =  DBUpdate($db, $data, "id = '{$id}'");     
        
        if ($query != 0)  {
            Redireciona($UrlPage.'?sucesso'.$route);
        } else {
            Redireciona($UrlPage.'?erro'.$route);
        }
      
    }
?>
<style>
.quadro{
    width: 100%;
    background: #e8e8e8;
    height: auto;
    border-radius: 5px;
    padding: 15px;
    overflow:hidden;
}
.opc{
    font-size: 12px;
    background: #f5f5f5;
    color: #000;
    border-radius: 40px;
    padding: 5px 15px;
    display: table;
    float: left;
    margin-bottom: 5px;
    margin-bottom: 5px;
    margin-right: 5px;
}



.fecha{
    background:white;
    opacity: 0.5;
    cursor:pointer;
}
.fecha:hover{
    opacity:1;
}
.input_sty2{
    display: grid !important;
    border: 2px rgba(0,0,0, 0.3) solid !important;
    grid-template-columns: auto 53px !important;
    grid-gap: 1px;
    border-radius: 10px;
    background: white;
}
.search{
    border-radius:25px;
    height: 35px;
    border:0;
    width:98%;
    margin: 4px 0 0 5px;
}
.search:focus{
    outline: none;
}

</style>
<div class="card"  >
    <div class="card-header white" >
        <strong>Configuração  de Pagamento</strong>
    </div>
    <div class="card-body">
        <form method="post" action="?Paga&editaPaga" enctype="multipart/form-data">
            <h4>Indicativos das formas de pagamento</h4>
            <div class="row"> 
                <div class="col-md-6">                   
                    <div class="form-group">
                        <label>Mostrar Formas de Pagamento:</label>
                        <select name="mostrar" v-model="idx.mostrar" class="form-control custom-select" required>
                            <option value="S" >Sim</option>
                            <option value="N" >Não</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" id="opicao" name="opicao" :value="idx.opicao">
            <div class="row" >
                <div class="col-md-1" >                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <button onclick="switchs('0')" type="button" class="btn btn-primary btnAdd" style="margin-bottom: 15px;">
                                <i id="00" class=" icon-plus"></i>
                            </button> 
                        </div>
                    </div>
                </div> 
                <div id="0" class="col-5 invisible">
                    <div class="input-group mb-3 input_sty2">
                        <input id="debito" class="search" style="font-family: Arial, FontAwesome;"> 
                        <div class="input-group-prepend picon">
                            <a @click="add('debito')" type="button" style="padding:5px;margin:5px" class="add btn btn-primary">
                                ADD
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-1" >                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <button onclick="switchs('1')" type="button"  class="btn btn-primary btnAdd" style="margin-bottom: 15px;">
                                <i id="11" class=" icon-plus"></i>
                            </button> 
                        </div>
                    </div>
                </div> 
                <div id="1" class="col-5 invisible">
                    <div class="input-group mb-3 input_sty2">
                        <input id="credito" class="search" style="font-family: Arial, FontAwesome;"> 
                        <div class="input-group-prepend picon">
                            <a @click="add('credito')" type="button" style="padding:5px;margin:5px" class="add btn btn-primary">
                                ADD
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">                   
                    <div class="form-group">
                        <label>Cartão de Débito:</label>
                        <div class="quadro">
                        <span class="opc" v-for="opd, i of idx.opicao.debito">{{opd.nome}} <span class="fecha" @click="remove(i,'debito')"> x</span></span></div>
                    </div>
                </div>
                <div class="col-md-6">                   
                    <div class="form-group">
                        <label>Cartão de Cédito:</label>
                        <div class="quadro">
                        <span class="opc" v-for="opc, i of idx.opicao.credito">{{opc.nome}} <span class="fecha" @click="remove(i,'credito')"> x</span></span></div>
                    </div>
                </div>


                <div class="col-md-1" >                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <button onclick="switchs('2')" type="button"  class="btn btn-primary btnAdd" style="margin-bottom: 15px;">
                                <i id="22" class=" icon-plus"></i>
                            </button> 
                        </div>
                    </div>
                </div> 
                <div id="2" class="col-5 invisible">
                    <div class="input-group mb-3 input_sty2">
                        <input id="vale" class="search" style="font-family: Arial, FontAwesome;"> 
                        <div class="input-group-prepend picon">
                            <a @click="add('vale')" type="button" style="padding:5px;margin:5px" class="add btn btn-primary">
                                ADD
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-1" >                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <button onclick="switchs('3')" type="button"  class="btn btn-primary btnAdd" style="margin-bottom: 15px;">
                                <i id="33" class=" icon-plus"></i>
                            </button> 
                        </div>
                    </div>
                </div> 
                <div id="3" class="col-5 invisible">
                    <div class="input-group mb-3 input_sty2">
                        <input id="outro" class="search" style="font-family: Arial, FontAwesome;"> 
                        <div class="input-group-prepend picon">
                            <a @click="add('outro')" type="button" style="padding:5px;margin:5px" class="add btn btn-primary">
                                ADD
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">                   
                    <div class="form-group">
                        <label>Vale:</label>
                        <div class="quadro">
                        <span class="opc" v-for="opv, i of idx.opicao.vale">{{opv.nome}} <span class="fecha" @click="remove(i,'vale')"> x</span></span></div>
                    </div>
                </div>
                <div class="col-md-6">                   
                    <div class="form-group">
                        <label>Outras Formas:</label>
                        <div class="quadro">
                        <span class="opc" v-for="opo, i of idx.opicao.outro">{{opo.nome}} <span class="fecha" @click="remove(i,'outro')"> x</span></span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chave Pix:</label>                        
                        <input  v-model="idx.pix" placeholder="Coloque a chave pix que receberá pagamentos " class="form-control" name="pix" >
                    </div>
                </div>
            </div> 
            <h4 class="row d-none">Receber pagamentos online</h4>
            <div class="row d-none"> 
                <div class="col-6">                   
                    <div class="form-group">
                        <label>Pagar no Site:</label>
                        <select name="pagar" v-model="idx.pagar" class="form-control custom-select" >
                            <option value="S" >Sim</option>
                            <option value="N" >Não</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">  
                    <div class="form-group">
                        <label>Escolha o Meio de Pagamento:</label>
                        <select name="meio" class="form-control custom-select" >
                            <option value="pagseguro" >PagSeguro</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row d-none">
                <div class="col-12">                
                    <div class="card">
                        <div class="card-header">
                            Configuração Meio de Pagamento 
                            <button class="btn btn-sm behance text-white" type="button" data-toggle="modal" data-target="#Ajuda">
                                <i class="icon-question-circle"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail:</label>                        
                                        <input v-model="idx.email" type="email" placeholder="E-mail" class="form-control" name="email" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Token:</label>                        
                                        <input v-model="idx.token" placeholder="Token" class="form-control" name="token" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card-footer white">
                <button style="margin-bottom: 7px;" class="btn btn-primary float-right" type="submit"><i class="icon icon-save" aria-hidden="true"></i> Salvar</button>
            </div>
        </form>
    </div>
    <div class="modal fade" id="Ajuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content b-0">
				<div class="modal-header r-0 bg-primary">
					<h6 class="modal-title text-white" id="exampleModalLabel">Informações</h6>
					<a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
				</div>
				<div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   const vue= new Vue({
        el:".card",
        data: {
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                pix:null,
                masked: false 
            },
            idx:<?php echo $banco ?>
        },
        updated: function(){
            this.$nextTick(function () {
                document.getElementById('opicao') != undefined?
                    document.getElementById('opicao').value = JSON.stringify(this.idx.opicao):
                    void(0)
            })
        },
        methods: {
            add: function(a){
                let b = document.getElementById(a).value
                this.idx.opicao[a].push({ nome:b})
                document.getElementById(a).value = ''
            },
            remove: function(i,a){
                this.idx.opicao[a].splice(i, 1)
            },
        }
   })
    !Array.isArray(vue.idx.opicao) && typeof(vue.idx.opicao) != "string"?
        void(0):
        vue.idx.opicao = JSON.parse(vue.idx.opicao)

switchs = (a) =>{
    if(document.getElementById(a).getAttribute('class') == 'col-5'){
        document.getElementById(a).setAttribute('class','col-5 invisible')
        document.getElementById(a+a).setAttribute('class','icon-plus')
    }else{
        document.getElementById(a).setAttribute('class','col-5')
        document.getElementById(a+a).setAttribute('class','icon-minus')
    }
}
</script>