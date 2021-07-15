<?php 
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(!strpos($url, "www.")){
    $url = "https://www.$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
$c = strrpos($url, "/");
$cod = '<iframe id="carrinho" class="hidden" style="border: 0; width: 100%; position: fixed;	left: 0; height: 100%; top: 0;	z-index: 100000;" src=""  frameborder="0"></iframe>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.10.2/underscore-min.js"></script>
<div id="delivery"></div>
<script>
let WACroot= "'.substr($url,0, $c).'/wa/delivery/"; 
$("#delivery").load(WACroot) 
</script>';

    $a =DBRead('delivery_config','*')[0];
    if(empty($a['horario'])){
        $a['horario'] = [
            'Domingo' => ['hora-fim' => [], 'hora-inicio' => [], 'minuto-fim' => [], 'minuto-inicio' => []],
            'Segunda-feira' => ['hora-fim' => [], 'hora-inicio' => [], 'minuto-fim' => [], 'minuto-inicio' => []],
            'Terça-feira' => ['hora-fim' => [], 'hora-inicio' => [], 'minuto-fim' => [], 'minuto-inicio' => []],
            'Quarta-feira' => ['hora-fim' => [], 'hora-inicio' => [], 'minuto-fim' => [], 'minuto-inicio' => []],
            'Quinta-feira' => ['hora-fim' => [], 'hora-inicio' => [], 'minuto-fim' => [], 'minuto-inicio' => []],
            'Sexta-feira' => ['hora-fim' => [], 'hora-inicio' => [], 'minuto-fim' => [], 'minuto-inicio' => []],
            'Sábado' => ['hora-fim' => [], 'hora-inicio' => [], 'minuto-fim' => [], 'minuto-inicio' => []]   
        ];
    }
    $banco = json_encode($a);
    if(isset($_GET['editaConfig'])){
    $id = 1;
    $route ='&Config';
    $db = 'delivery_config';
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
.grided{
    display: grid;
    grid-template-columns: 100px 50px 50px;
}
td input::-webkit-outer-spin-button,
td input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
tr{
    display: grid;
    grid-template-columns: 200px 200px 200px auto;
}
td input{
    width:20%;
}
</style>
<div class="card"  >
    <div class="card-header white" >
        <strong>Configuração  Geral</strong>
    </div>
    <div class="card-body">
        <form method="post" action="?Config&editaConfig" enctype="multipart/form-data">
        <button id="btnCopiarCodSite1" class="btn btn-primary btn-xs m-1" onclick="CopiadoCodSite(1)" data-clipboard-text='<?php echo $cod; ?>' type="button">
                <i class="icon icon-code"></i> Copiar Código de Implementação
            </button>
            <hr/>
            <h4>Configuração de Listagem</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cor do Fundo:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['lis_fundo'] ?>" class="form-control" name="lis_fundo" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    <label>Cor Hover Fundo:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['lis_hover_fundo'] ?>" class="form-control" name="lis_hover_fundo" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cor do Título:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['lis_titulo'] ?>" class="form-control" name="lis_titulo" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Cor do Background Geral:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['lis_descricao'] ?>" class="form-control" name="lis_descricao" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cor do Preço:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['lis_preco'] ?>" class="form-control" name="lis_preco" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    <label>Cor do Preço da Promoção:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['lis_preco_pro'] ?>" class="form-control" name="lis_preco_pro" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cor do Fundo Promoção:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['lis_fundo_pro'] ?>" class="form-control" name="lis_fundo_pro" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Cor da Borda:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['borda'] ?>" class="form-control" name="borda" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Paginação: </label>
                        <select   name='paginacao' class='form-control'  v-model='paginacao'> 
                            <option value='S'>Sim</option>
                            <option value='N'>Não</option></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-if="paginacao == 'S'">
                    <div class="form-group">
                        <label>Itens por página: </label>
                        <input class="form-control" type="number"  name="item" value="<?php echo $a['item'] ?>" min="1" step="0" >
                    </div>
                </div>
                <div class="col-md-4" v-if="paginacao == 'S'">
                    <div class="form-group">
                        <label>Cor do Fundo da Paginação:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['pag_fundo'] ?>" class="form-control" name="pag_fundo" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" v-if="paginacao == 'S'">
                    <div class="form-group">
                        <label>Cor do texto da Paginação:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['pag_texto'] ?>" class="form-control" name="pag_texto" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <label>Cor Background do Ícone Pesquisa e Filtro:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['bg_icone'] ?>" class="form-control" name="bg_icone" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <label>Cor Ícone Pesquisa e Filtro:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['cor_icone'] ?>" class="form-control" name="cor_icone" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <label>Cor Botão Realizar Pedido:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['bg_btn_pedido'] ?>" class="form-control" name="bg_btn_pedido" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-group">
                        <label>Cor Texto do Botão Realizar Pedido:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['cor_btn_pedido'] ?>" class="form-control" name="cor_btn_pedido" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Ordenar por:</label>
                    <select v-model="idx.ordem" name="ordem" class="form-control custom-select" required>
                        <option value="id">ID (Ordem de Criação)</option>
                        <option value="nome"> Nome</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Ordem de Exibição:</label>
                    <select class="form-control custom-select" name="ascdesc" v-model="idx.ascdesc">
                        <option value="ASC" selected>Crescente (Menor > Maior)</option>
                        <option value="DESC">Decrescente (Maior > Menor)</option>
                    </select>
                </div>
            </div>
            <hr>
            <h4>Configuração Popup</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Cor do Fundo Superior:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['pop_fundo'] ?>" class="form-control" name="pop_fundo" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Cor do Título:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['pop_titulo'] ?>" class="form-control" name="pop_titulo" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Cor da Descrição:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['pop_descricao'] ?>" class="form-control" name="pop_descricao" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Cor do Preço:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['pop_fechar'] ?>" class="form-control" name="pop_fechar" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-6">
                    <div class="form-group">
                        <label>Efeito de Entrada: </label>
                        <select   name='entrada' class='form-control'  v-model='idx.entrada'> 
                            <option value="none">Nenhum</option>
							<option value="tc-animation-slide-top">Slide Top</option>
							<option value="tc-animation-slide-right">Slide Right</option>
							<option value="tc-animation-slide-bottom">Slide Bottom</option>
							<option value="tc-animation-slide-left">Slide Left</option>
							<option value="tc-animation-scale-up">Scale Up</option>
							<option value="tc-animation-scale-down">Scale Down</option>
							<option value="tc-animation-scale">Scale</option>
							<option value="tc-animation-shake">Shake</option>
							<option value="tc-animation-rotate">Rotate</option>
                        </select>
                    </div>
                </div>-->
            </div>
            <hr>
            <h4>Configuração Horário de Funcionamento</h4>
            <table id="DataTable" class="table m-0 ">
                <tr>
                    <th>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dia
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a @click="add($event.target.innerText)" class="dropdown-item" href="javascript:void(0)">Domingo</a>
                                <a @click="add($event.target.innerText)" class="dropdown-item" href="javascript:void(0)">Segunda-feira</a>
                                <a @click="add($event.target.innerText)" class="dropdown-item" href="javascript:void(0)">Terça-feira</a>
                                <a @click="add($event.target.innerText)" class="dropdown-item" href="javascript:void(0)">Quarta-feira</a>
                                <a @click="add($event.target.innerText)" class="dropdown-item" href="javascript:void(0)">Quinta-feira</a>
                                <a @click="add($event.target.innerText)" class="dropdown-item" href="javascript:void(0)">Sexta-feira</a>
                                <a @click="add($event.target.innerText)" class="dropdown-item" href="javascript:void(0)">Sábado</a>
                            </div>
                        </div>
                    </th>
                    <th>Inicio</th>
                    <th>Fim</th>
                    <th>Deletar</th>
                </tr> 
            </table>
            <div  v-for="dia, i of idx.horario">                
                <div class="row ">
                    <div class="col-md-12">
                        <table id="DataTable" class="table m-0 ">
                                                        
                            <tr v-for='hora, id of idx.horario[i]["hora-fim"]'>  
                                <td>{{i}}</td>                                      
                                <td >
                                    <input v-if="status == i+id+'a'"  type="number" :value='idx.horario[i]["hora-inicio"][id]'  @change='hora_inicio($event.target.value,i,id)'> 
                                    <span  v-if="status != i+id+'a'" style="cursor:pointer"  @click="status = i+id+'a'" >{{idx.horario[i]["hora-inicio"][id]}} </span>
                                    <span> : </span>
                                    <input v-if="status == i+id+'aa'"  type="number" :value='idx.horario[i]["minuto-inicio"][id]' @change='minuto_inicio($event.target.value,i,id)'> 
                                    <span  v-if="status != i+id+'aa'" style="cursor:pointer"  @click="status = i+id+'aa'" >{{idx.horario[i]["minuto-inicio"][id]}} </span>
                                </td> 
                                <td >
                                    <input v-if="status == i+id+'b'"  type="number" :value='idx.horario[i]["hora-fim"][id]' @change='hora_fim($event.target.value,i,id)'> 
                                    <span  v-if="status != i+id+'b'"style="cursor:pointer"  @click="status = i+id+'b'" >{{idx.horario[i]["hora-fim"][id]}} </span>
                                    <span> : </span>
                                    <input v-if="status == i+id+'bb'"  step="0" type="number" :value='idx.horario[i]["minuto-fim"][id]' @change='minuto_fim($event.target.value,i,id)'>
                                    <span  v-if="status != i+id+'bb'" style="cursor:pointer"  @click="status = i+id+'bb'" >{{idx.horario[i]["minuto-fim"][id]}} </span>
                                </td> 
                                <td>
                                    <button type="button" @click="remove(id, i)" class="btn btn-danger btnRemove" style="margin-left:5px"><i class="icon-trash"></i></button>
                                </td>                                                                           
                            </tr>                  
                        </table>
                    </div>
                </div>               
            </div>
            <hr>
            <h4>Configuração de Checkout</h4>
            <div class="row">
                <div class="col-6">
                    <label>Tipo de checkout</label>
                    <select v-model="idx.checkout" name="checkout" class="form-control custom-select" required>
                        <option value="whatsapp"> Pelo Whatsapp</option>
                        <option value="sistema"> Pelo Sistema</option>
                    </select>
                </div>
                <div v-if="idx.checkout == 'whatsapp'" class="col-6">
                    <div class="form-group">
                        <label>Número do Whatsapp:</label>                        
                        <input v-model="idx.whatsapp" class="form-control" name="whatsapp" required type="number">
                        <small>Lembre-se de inserir seu número completo com Código do País, DDD e Número de Telefone completo Ex. 5511912345678 </small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Número de atendimento ao cliente:</label>                        
                        <input v-model="idx.atendimento" class="form-control" name="atendimento" required type="number">
                        <small>Lembre-se de inserir seu número completo com Código do País, DDD e Número de Telefone completo Ex. 5511912345678 </small>
                    </div>
                </div>
            </div>

            <input type="hidden" name="horario" id="horario" > 
            <div class="card-footer white">
                <button style="margin-bottom: 7px;" class="btn btn-primary float-right" type="submit"><i class="icon icon-save" aria-hidden="true"></i> Salvar</button>
            </div>
        </form>
    </div>
</div>
<script>
   const vue= new Vue({
        el:".card",
        data: {
            estilo:'',
            status:'',
            paginacao:'',
            idx:<?php echo $banco ?>
        },
        updated: function(){
            this.$nextTick(function(){
                document.getElementById('horario').value = JSON.stringify(this.idx.horario)
                $('.color-picker').colorpicker();  

            })
        },
        methods: {
            add: function(i){                
                this.idx.horario[i]["hora-inicio"].push('00')
                this.idx.horario[i]["hora-fim"].push('00')   
                this.idx.horario[i]["minuto-inicio"].push('00')   
                this.idx.horario[i]["minuto-fim"].push('00')   
            },
            remove: function(index, i){
                this.idx.horario[i]["hora-inicio"].splice(index, 1)
                this.idx.horario[i]["hora-fim"].splice(index, 1)
                this.idx.horario[i]["minuto-inicio"].splice(index, 1)
                this.idx.horario[i]["minuto-fim"].splice(index, 1)
            }, 
            hora_inicio: function(a,b,c){
                let valor = parseInt(a)
                if(valor >= 0 && valor<=23){
                    this.idx.horario[b]["hora-inicio"][c] = valor;                    
                    this.status=""
                }else{ 
                    this.status=""
                }  
            },
            minuto_inicio: function(a,b,c){
                if(a.length<2){a="0"+a}
                let valor = parseInt(a)
                if(valor >= 0 && valor<=59){
                    this.idx.horario[b]["minuto-inicio"][c] = a; this.status=""
                }else{ 
                    this.status=""
                }  
            },
            hora_fim: function(a,b,c){
                let valor = parseInt(a)
                if(valor >= this.idx.horario[b]["hora-inicio"][c] && valor<=23){
                    this.idx.horario[b]["hora-fim"][c] = valor; this.status=""
                }else{ 
                    this.status=""
                }  
            },
            minuto_fim: function(a,b,c){
                if(a.length<2){a="0"+a}
                let valor = parseInt(a)
                let menor = parseInt(String(this.idx.horario[b]["hora-inicio"][c])+String(this.idx.horario[b]["minuto-inicio"][c]))
                let maior = parseInt(String(this.idx.horario[b]["hora-fim"][c])+a)
                if(menor < maior && valor<=59){
                    this.idx.horario[b]["minuto-fim"][c] = a; this.status=""
                }else{ 
                    this.status=""
                }  
            },
        }
    })
    vue.estilo = vue.idx.estilo;
    vue.paginacao = vue.idx.paginacao;
    typeof(vue.idx.horario) == "string"?
        vue.idx.horario = JSON.parse(vue.idx.horario):
        void(0)
</script>