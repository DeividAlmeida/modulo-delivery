<?php 
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
        
    }
if(isset($query)){
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
</style>
<div class="card"  >
    <div class="card-header white" >
        <strong>Configuração </strong>
    </div>
    <div class="card-body">
        <form method="post" action="?Config&editaConfig" enctype="multipart/form-data">
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
                    <label>Cor da Descrição:</label>
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Estilo de Listagem: </label>
                        <select   name='estilo' class='form-control'  v-model="estilo"> 
                            <option value='1'>Estilo 1</option>
                            <option value='2'>Estilo 2</option></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-if="estilo == '2'">
                    <div class="form-group">
                        <label>Número de colunas: </label>
                        <select   name='colunas' class='form-control'  v-model='idx.colunas'> 
                            <option value='4'>3 Colunas</option>
                            <option value='3'>4 Colunas</option></option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <h4>Configuração Popup</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Cor do Fundo:</label>
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
                    <label>Cor do Botão Fechar:</label>
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
                <div class="col-md-6">
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
                </div>
            </div>
            <hr>
            <h4>Configuração Mobile</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mostrar Imagem: </label>
                        <select   name='mob_img' class='form-control'  v-model='idx.mob_img'> 
                            <option value='S'>Sim</option>
                            <option value='N'>Não</option></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cor do Fundo das Categorias:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['mob_fundo_categoria'] ?>" class="form-control" name="mob_fundo_categoria" >
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
                        <label>Cor do Texto das Categorias:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['mob_texto_categoria'] ?>" class="form-control" name="mob_texto_categoria" >
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
                    <label>Cor do Fundo da Pesquisa:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['mob_fundo_pesquisa'] ?>" class="form-control" name="mob_fundo_pesquisa" >
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
                        <label>Cor do Texto da Pesquisa:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['mob_texto_pesquisa'] ?>" class="form-control" name="mob_texto_pesquisa" >
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
                    <label>Cor do Fundo:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['mob_fundo'] ?>" class="form-control" name="mob_fundo" >
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
                        <label>Cor do Divisor:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['mob_divisor'] ?>" class="form-control" name="mob_divisor" >
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
                            <input value="<?php echo $a['mob_titulo'] ?>" class="form-control" name="mob_titulo" >
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
                    <label>Cor da Descrição:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                            <input value="<?php echo $a['mob_descricao'] ?>" class="form-control" name="mob_descricao" >
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
                          <input value="<?php echo $a['mob_preco'] ?>" class="form-control" name="mob_preco" >
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
                        <label>Cor do Preço da Promoção 1:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['mob_preco_pro_1'] ?>" class="form-control" name="mob_preco_pro_1" >
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
                        <label>Cor do Preço da Promoção 2:</label>
                        <div class="color-picker input-group colorpicker-element focused">
                          <input value="<?php echo $a['mob_preco_pro'] ?>" class="form-control" name="mob_preco_pro" >
                            <span class="input-group-append">
                                <span class="input-group-text add-on white">
                                    <i class="circle"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h4>Configuração Horário de Funcionamento</h4>
            <div  v-for="dia, i of idx.horario">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group grided">
                            <label>{{i}}: </label>
                            <button  type="button" @click="add(i)" class="btn btn-primary btnAdd" style="margin-left:5px"><i class=" icon-plus"></i></button>
                        </div>
                    </div>   
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <table id="DataTable" class="table m-0 table-striped">
                            <tr>
                                <th>Inicio</th>
                                <th>Fim</th>
                                <th>Deletar</th>
                            </tr>                            
                            <tr v-for='hora, id of idx.horario[i]["hora-fim"]'>                                        
                                <td >
                                    <input v-if="status == i+id+'a'"  min="0" max="23" step="0" type="number" :value='idx.horario[i]["hora-inicio"][id]' @change='idx.horario[i]["hora-inicio"][id] = $event.target.value; status=""'> 
                                    <input v-if="status == i+id+'a'"  min="0" max="23" step="0" type="number" :value='idx.horario[i]["minuto-inicio"][id]' @change='idx.horario[i]["minuto-inicio"][id] = $event.target.value; status=""'> 
                                    <span  v-else style="cursor:pointer"  @click="status = i+id+'a'" >{{idx.horario[i]["hora-inicio"][id]+" : "+idx.horario[i]["minuto-inicio"][id]}} </span>
                                </td> 
                                <td >
                                    <input v-if="status == i+id+'b'"  min="0" max="23" step="0" type="number" :value='idx.horario[i]["hora-fim"][id]' @change='idx.horario[i]["hora-fim"][id] = $event.target.value; status=""'> 
                                    <input v-if="status == i+id+'b'"  min="0" max="23" step="0" type="number" :value='idx.horario[i]["minuto-fim"][id]' @change='idx.horario[i]["minuto-fim"][id] = $event.target.value; status=""'>
                                    <span  v-else style="cursor:pointer"  @click="status = i+id+'b'" >{{idx.horario[i]["hora-fim"][id]+" : "+idx.horario[i]["minuto-fim"][id]}} </span>
                                </td> 
                                <td>
                                    <button type="button" @click="remove(id, i)" class="btn btn-danger btnRemove" style="margin-left:5px"><i class="icon-trash"></i></button>
                                </td>                                                                           
                            </tr>                  
                        </table><br>
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
<!-- https://codare.aurelio.net/2009/04/03/javascript-obter-e-mostrar-data-e-hora/#:~:text=Para%20obter%20a%20data%20(e,uma%20vari%C3%A1vel%20var%20dia%20%3D%20data.-->
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
            }
        }
    })
    vue.estilo = vue.idx.estilo;
    vue.paginacao = vue.idx.paginacao;
    typeof(vue.idx.horario) == "string"?
        vue.idx.horario = JSON.parse(vue.idx.horario):
        void(0)
</script>