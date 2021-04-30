<?php
$db='delivery_adicional';
if(isset($_GET['id'])){
    foreach($_POST as $chave => $valor){
        $dado[$chave] =$valor;
    }
    $id = $_GET['id'];
    if($id == 0){
        $query = DBCreate($db, $dado, true);  
    }else{
        $query =  DBUpdate($db, $dado, "id = '{$id}'");
    };   
}
if(isset($_GET['Adic'])){
    $status = $_GET['Adic'];
    if($status !== '0'){ 
        $data = DBRead($db,'*');
    }else{        
        $data =[
            [
                'nome'=>null,
                'status'=>'Inativo',
                'categoria'=>'Selecione a categoria',
                'valor'=> 0
                ]
            ];
        }
    }else{
        $status ="";
        $data = DBRead($db,'*');
        $data = DBRead('delivery_adicional','*');
}
$query = json_encode($data);
$categoria = json_encode(DBRead('delivery_categoria','*'));

?>
<style>
tr{
    display: grid;
    grid-template-columns: 40px 200px 200px 150px 200px 250px;
    text-align:center;
}
</style>
<div class="card"  >
    <div id="control" v-if="!status">        
        <div class="card-body p-0" v-if="ctrls">
            <div>
                <div>
                    <table id="DataTable" class="table m-0 table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>                            
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th >Ações</th>
                        </tr>                        
                        <tr v-for="ctrl, index in ctrls">
                            <td>{{index+1}}</td>
                            <td>{{ctrl.nome}}</td>                            
                            <td>{{ctrl.categoria}}</td>                            
                            <td>
                                <div class="input-group mb-3">                                    
                                    <input class="form-control" :id="index+'_'+ctrl.id" v-model="ctrl.valor" v-money="money"  @change="valor(index, ctrl.id, $event.target.value)" >                                
                                </div>
                            </td>                            
                            <td>
                                <button type="button" :class="ctrl.status == 'Ativo'? 'btn btn-success':'btn btn-danger'" :id="index" @click="ativar(index, ctrl.id)">{{ctrl.status}}</button>                            
                            </td>                          
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
                                            <a class="dropdown-item" :data-id="ctrl.id"  onclick="DeletarItem(getAttribute('data-id'), 'header=Adic&db=<?php echo $db; ?>&Deletar');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir </a>
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
                <div class="alert alert-info">Nenhum registro adicionado a essa listagem até o momento, <a class="adicionarListagemItem" href="?Adic=0" >clique aqui</a> para adicionar.</div>
            <?php } ?>
        </div>
    </div>
    <div class="card-body" v-else>
        <form method="post"  :action="'?Adic&id='+status">            
            <div class="row" >
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Categoria: </label>
                        <select v-model="ctrls[idx].categoria" name='categoria' class='form-control'  > 
                            <option disable>Selecione a categoria</option>
							<option v-for="categoria, key of categorias" :value="categoria.nome">{{categoria.nome}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input v-model="ctrls[idx].nome" placeholder="Nome do item" class="form-control"  name="nome" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Valor: </label>
                        <input v-model="ctrls[idx].valor" placeholder="Valor do item" class="form-control" v-money="money"  name="valor" required>
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
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                masked: false 
            },
            idx:0,
            status:"<?php echo $status ?>",
            ctrls:<?php echo $query ?>,
            categorias: <?php echo $categoria ?>,
            
        },
        updated: function(){
            this.$nextTick(function () {
                document.getElementById('opcoes') != undefined?
                    document.getElementById('opcoes').value = JSON.stringify(this.ctrls[this.idx].opcoes):
                    void(0)
            })
        },
        methods:{
            move: function(a, b){
                this.status = a;
                this.idx = b;
                !Array.isArray(this.ctrls[this.idx].opcoes) && typeof(this.ctrls[this.idx].opcoes) != "string"?
                    this.ctrls[this.idx].opcoes = []:
                    this.ctrls[this.idx].opcoes =JSON.parse(this.ctrls[this.idx].opcoes)
            },
            add: function(){
                    this.ctrls[this.idx].opcoes.push({ nome:'',valor:''})
            },
            remove: function(i){
                this.ctrls[this.idx].opcoes.splice(i, 1)
            }, 
            ativar: function (a, b) { 
                let form = new FormData()               
                if(this.ctrls[a].status == 'Ativo'){
                    form.append('status','Inativo')
                    this.ctrls[a].status = 'Inativo'
                    fetch('?Adic&id='+b, {
                        method: 'POST',
                        body: form
                    }) 
                }else{
                    this.ctrls[a].status = 'Ativo'
                    form.append('status','Ativo')
                    fetch('?Adic&id='+b, {
                        method: 'POST',
                        body: form
                    })  
                }
            },
            valor: function (a, b, c) { 
                let form = new FormData()            
                form.append('valor',c)
                fetch('?Adic&id='+b, {
                    method: 'POST',
                    body: form
                }).then(function(res){  
                    if(res.status == 200) {
                        document.getElementById(a+'_'+b).addEventListener('focusout', function (event) {
                            swal("Salvo", "Valor Salvo com sucesso!!", "success");  
                        });                    
                    }                 
                })     
            }
        }
    }) 
     
</script>