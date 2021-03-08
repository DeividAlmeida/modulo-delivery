<?php
$status = $_GET['Item'];
$categoria = $_GET['Catego'];
$query = json_encode(DBRead('cardapio_item','*' ,"WHERE categoria = '{$categoria}'"));
?>
<style>
    .text-center img{
        max-width:50% !important;
    }
</style>
<div class="card"  >
    <div id="control" v-if="!status">
        <div class="card-header white" >
            <strong>Adicionar Item</strong>
                <a class="adicionarListagemItem tooltips" data-tooltip="Adicionar" @click="move('0')" >
                    <i class="icon-plus blue lighten-2 avatar"></i> 
                </a>
        </div>
        <div class="card-body p-0" v-if="ctrls != false">
            <div>
                <div>
                    <table id="DataTable" class="table m-0 table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th width="53px">Ações</th>
                        </tr>
                        <tr v-for="ctrl, index in ctrls">
                            <td>{{index+1}}</td>
                            <td><img v-if="ctrl.img" height="40" :src="folder+ctrl.img"></td>
                            <td>{{ctrl.nome}}</td>
                            <td>R$ {{ctrl.preco.replace('.',',')}}</td>
                            
                            <td>
                                <div class="dropdown">
                                    <a class="" href="#" data-toggle="dropdown">
                                        <i class="icon-apps blue lighten-2 avatar"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) { ?>
                                            <a class="dropdown-item"  @click="move(ctrl.id, index)" href="#!"><i class="text-primary icon icon-pencil" ></i> Editar</a>
                                        <?php } ?>
                                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) { ?>
                                            <a class="dropdown-item" :data-id="ctrl.id"  onclick="DeletarItem(getAttribute('data-id'), 'catego=<?php echo $categoria ?>&DeletarItem');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-body" v-else>
            <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
                <div class="alert alert-info">Nenhum item adicionada a essa listagem até o momento, <a class="adicionarListagemItem" href="?Item=0&Catego=<?php echo $categoria ?>" >clique aqui</a> para adicionar.</div>
            <?php } ?>
        </div>
    </div>
    <div class="card-body" v-else>
        <form method="post" :action="'?I_id='+status" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $categoria ?>" name="categoria">
            <div class="row" v-if="status !=0">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input class="form-control" v-model="ctrls[idx].nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição: </label>
                        <textarea rows="10"  class="form-control" v-model="ctrls[idx].descricao" name="descricao" required>{{ctrls[idx].descricao}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Preço: </label>
                        <input class="form-control" type="number" v-model="ctrls[idx].preco" name="preco" min="0.00" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Promoção: </label>
                        <select  required name='promocao' class='form-control'  v-model='ctrls[idx].promocao'> 
                            <option value='S'>Sim</option>
                            <option value='N'>Não</option></option>
                        </select>
                    </div>
                    <div v-if="ctrls[idx].promocao =='S'" class="form-group">
                        <label>Valor: </label>
                        <input class="form-control" type="number" v-model="ctrls[idx].valor" name="valor" :min="ctrls[idx].preco" step="0.01" required>
                    </div>
                    <div class="justify-content-md-center" >
                        <div class="form-group offset-sm-0 text-center">
                            <div>
                                <input  @change="capa(this);"  style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; z-index: -1;" type="file" multiple accept='image/*' name="img" id="capa">
                                <label multiple accept='image/*' class="btn btn-primary" for="capa">
                                    <i class="icon icon-cloud-upload" aria-hidden="true"></i>Upload Foto 
                                </lable>
                            </div>
                            <img id="food" v-if="ctrls[idx].img" :src="folder+ctrls[idx].img "  />
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row" v-if="status == 0">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input class="form-control"  name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição: </label>
                        <textarea rows="10" class="form-control"  name="descricao" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Preço: </label>
                        <input class="form-control" type="number" v-model="preco" name="preco" min="0.00" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Promoção: </label>
                        <select  required name='promocao' v-model="idx" class='form-control'  > 
                            <option value='S'>Sim</option>
                            <option value='N'>Não</option></option>
                        </select>
                    </div>
                    <div v-if="idx =='S'" class="form-group">
                        <label>Valor: </label>
                        <input class="form-control" type="number"  name="valor" :min="preco" step="0.01" required>
                    </div>
                    <div class="justify-content-md-center" >
                        <div class="form-group offset-sm-0 text-center">
                            <div>
                                <input  @change="capa(this);"  style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; z-index: -1;" type="file" multiple accept='image/*' name="img" id="capa">
                                <label multiple accept='image/*' class="btn btn-primary" for="capa">
                                    <i class="icon icon-cloud-upload" aria-hidden="true"></i>Upload Foto 
                                </lable>
                            </div>
                            <img id="food"  />
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
    const vue = new Vue({
        el:".card",
        data: {
            folder:'wa/cardapio/uploads/',
            idx:"",
            status:"<?php echo $status ?>",
            ctrls:<?php echo $query ?>,
            preco:0
        },
        methods:{
            move: function(a, b){
                this.status = a;
                this.idx = b;
            },
            capa: function(a){
                var input = event.target
                var reader = new FileReader()
                    reader.onload = (e) => {
                        document.getElementById('food').src = e.target.result;
                    }
                reader.readAsDataURL(input.files[0]);
            },
        }
    })
    
</script>