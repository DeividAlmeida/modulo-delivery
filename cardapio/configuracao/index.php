<?php 
    $a =DBRead('cardapio_config','*')[0];
    $banco = json_encode($a);
    if(isset($_GET['editaConfig'])){
    $id = 1;
    $route ='&Config';
    $db = 'cardapio_config';
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
                            <option value='25%'>3 Colunas</option>
                            <option value='20%'>4 Colunas</option></option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <h4>Configuração Popup</h4>
            <div class="row">
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
            </div>
            <div class="row">
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
                        <label>Cor do Preço da Promoção:</label>
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
            paginacao:'',
            idx:<?php echo $banco ?>
        }, 
        methods: {

        }
    })
    vue.estilo = vue.idx.estilo;
    vue.paginacao = vue.idx.paginacao;
</script>