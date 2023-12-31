<?php
$db='delivery_produto';
if(isset($_GET['two'])){
    $id = $_GET['two'];
    $data = DBRead($db,'*',"WHERE id = '{$id}'")[0];
    unset($data['id']);    
    $query = DBCreate($db,$data, true);
    if(isset($query)){
		if ($query != 0)  {
			Redireciona('?sucesso&Prod');
		} else {
			Redireciona('?erro&Prod');
		}
	}  
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    foreach($_POST as $chave => $valor){
        $dado[$chave] =$valor;
    }
    if($_FILES['imagem']['name'] == null && $id != "0"){
        $keep = DBRead($db,'*' ,"WHERE id = '{$id}'")[0];
        $data['imagem'] = $keep['imagem'];
     }else{
         $upload_folder = 'wa/delivery/uploads/';
         $handle = new Upload($_FILES['imagem']);
         $handle->file_new_name_body = md5(uniqid(rand(), true));
         $handle->Process($upload_folder);
         $dado['imagem'] = $handle->file_dst_name;
     }
    if($id == 0){
        $query = DBCreate($db, $dado, true);  
    }else{
        $query =  DBUpdate($db, $dado, "id = '{$id}'");
    };
    if(isset($query)){
		if ($query != 0)  {
			Redireciona('?sucesso&Prod');
		} else {
			Redireciona('?erro&Prod');
		}
	}   
}
if(isset($_GET['Prod'])){
    $status = $_GET['Prod'];
    if($status !== '0'){ 
        $data = DBRead($db,'*');
    }else{        
        $data =[
            [
                'nome'=>null,
                'status'=>'Inativo',
                'categoria'=>'Selecione a categoria',
                'valor'=> 0,
                'v_cortado'=> 0,
                'imagem'=> null,
                'descricao'=> null,
                'promocao'=>'N',
                'dias'=> [],
                'complementos'=> [],
                'adicionais'=> []
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
$complemento = json_encode(DBRead('delivery_complemento','*'));
$adicional = json_encode(DBRead('delivery_adicional','*'));

?>

<script src='https://cdn.rawgit.com/matfish2/vue-tables-2/master/dist/vue-tables-2.min.js'></script>
<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">


<style>
.VuePagination__pagination-item-prev-chunk{
    display:none 
}
.VuePagination__pagination-item-next-chunk{
    display:none
}
.VueTables__limit{
    position: absolute;
    right: 3.5%;
    top: 20%;
}
.VueTables__search{
    margin: 20px;
}
.pagination{
    margin-left:20px
}
.VueTables__sortable {
    cursor:pointer;
}
.VueTables__heading{
    font-weight: bold;
    font-size: 15px;
}

.form-group .btn{
    margin-top: 26px;
}
.imgs{    
    border: dotted;
    justify-content: center;
    display: flex;
    cursor:pointer;
}
.imgs i{
    position: relative;
    font-size: 75px;
    width: 100px;
    height: 100px;
    background: #86939e;
    border-radius: 100%;
    padding: 2% 5% 5% 7%;
    color: #fff;
    top: 50px;
}
.imgs:before{
    width: 170px;
    content: "Enviar Imagem...";
    position: absolute;
    top: 65%;
    font-size: 15px;
    line-height: 15px;
    text-align: center;  
}
.imgs:after{
    width: 170px;
    content: "Resolução recomendada de 800x800";
    position: absolute;
    top: 70%;
    font-size: 13px;
    line-height: 15px;
    text-align: center;  
}
.imgs img{
    max-height: 230px;
}
tbody td{
    text-align: center;
}
thead th{
    text-align: center;
}
.multiselect__tag, .multiselect__option--highlight, .multiselect__tag-icon, .multiselect__tag-icon:after{ background: #86939e !important}
</style>
<div class="card"  >
    <div id="control" v-if="!status"> 
        <div class="card-header white" v-if="ctrls">
                <button type="button" class="btn btn-danger btnRemove" onclick="massa()"> <i class="icon icon-trash" aria-hidden="true"></i> Excluir em Massa</button>
        </div>
        <div class="card-body p-0" v-if="ctrls">
            <v-client-table :columns="columns" :data="table" :options="options" class="thead-dark" id="DataTable">                
                <input class="form-control" slot="check" slot-scope="props" :value="props.row.id" type="checkbox" :id="'checkbx'+props.row.index">
                <span slot="index" slot-scope="props" > {{props.row.index+1}}</span>
                <img slot="imagem" slot-scope="props"  v-if="ctrls[props.row.index].imagem" height="40" :src="folder+props.row.imagem">
                <input style="width:120px; display:inline" type="text" slot="valor" slot-scope="props"  class="form-control" :id="props.row.index+'_'+props.row.id" v-model="ctrls[props.row.index].valor" v-money="money"  @change="valor(props.row.index,props.row.id, $event.target.value)" >                                
                <button type="button" slot="status" slot-scope="props" :class="props.row.status == 'Ativo'? 'btn btn-success':'btn btn-danger'" :id="props.row.index" @click="ativar(props.row.index, props.row.id)">{{props.row.status}}</button>                            
                <div class="dropdown" slot="acoes" slot-scope="props">                
                    <a class="" href="#" data-toggle="dropdown">
                        <i class="icon-apps blue lighten-2 avatar"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) { ?>
                            <a class="dropdown-item"  @click="move(props.row.id, props.row.index)" href="#!"><i class="text-primary icon icon-pencil" ></i> Editar</a>
                            <a class="dropdown-item"  :href="'?Prod&two='+props.row.id"><i class="text-primary icon icon-clone" ></i> Duplicar</a>
                        <?php } ?>
                        <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) { ?>
                            <a class="dropdown-item" :data-id="props.row.id"  onclick="DeletarItem(getAttribute('data-id'), 'header=Prod&db=<?php echo $db; ?>&Deletar');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir </a>
                        <?php } ?>
                    </div>
                </div>        
            </v-client-table>            
        </div>
        <div class="card-body" v-else>
            <?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
                <div class="alert alert-info">Nenhum registro adicionado a essa listagem até o momento, <a class="adicionarListagemItem" href="?Prod=0" >clique aqui</a> para adicionar.</div>
            <?php } ?>
        </div>
    </div>
    <div class="card-body" v-else>
        <form method="post"  :action="'?Prod&id='+status" enctype="multipart/form-data">

            <div class="row" >
                <div class="col-md-3" >
                    <input  @change="capa(this);"  style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; z-index: -1;" type="file" multiple accept='image/*' name="imagem" id="capa">                                
                    <label for="capa" class="imgs" :style="ctrls[idx].imagem !== null? 'color:transparent': 'height: 230px; width: 230px;'" multipleaccept='image/*'>
                        <i v-if="ctrls[idx].imagem === null" class="icon icon-upload icon-5x" aria-hidden="true"></i>
                        <img v-if="ctrls[idx].imagem !== null" id="view" v-once :src="status !== '0' ?folder+ctrls[idx].imagem:void(0)" />           
                    </label>
                </div>                
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome: </label>
                                <input v-model="ctrls[idx].nome" placeholder="Nome do item" class="form-control"  name="nome" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Preço Base do Item: </label>
                                <input @input="ctrls[idx].valor = $event.target.value; ctrls[idx].v_cortado = $event.target.value" :value="ctrls[idx].v_cortado" placeholder="R$ 00,00" class="form-control" v-money="money"  :name="ctrls[idx].promocao == 'N'?'valor':'v_cortado'" required>
                                <input type="hidden" name="v_cortado" :value="ctrls[idx].v_cortado">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição: </label>
                                <textarea v-model="ctrls[idx].descricao" placeholder="Escreva uma descrição do item..." class="form-control" name="descricao" required>{{ctrls[idx].descricao}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <label>Dias em que o item aparece para o Cliente: </label>
                                    <multiselect  :show-labels="false"  :hide-selected="true" v-model="ctrls[idx].dias" :group-select="true" group-values="semana" group-label="tudo" placeholder=""   :options="dias"   :multiple="true" :taggable="true"  ></multiselect>
                                    <input type="hidden" name="dias" id="dias" :value="ctrls[idx].dias">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Categoria: </label>
                        <select v-model="ctrls[idx].categoria" name='categoria' class='form-control'  > 
                            <option disable>Selecione a categoria</option>
							<option v-for="categoria, key of categorias" :value="categoria.nome">{{categoria.nome}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">                
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" data-target="#Modal" data-toggle="modal" @click="status_opc='Complementos'; index=[]; opcao = 'Selecione os Complementos'; index2 = []; catego = 'Selecione a categoria'"> Cadastrar Complementos</button>
                        <input type="hidden" name="complementos" id="complementos">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="button" class=" btn btn-primary" data-target="#Modal" data-toggle="modal" @click="{status_opc='Adicionais'; index=[]; opcao = 'Selecione os Adicionais'; index2 = []; catego = 'Selecione a categoria'}"> Cadastrar Adicionais</button>
                        <input type="hidden" name="adicionais" id="adicionais">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Promoção: </label>
                        <select v-model="ctrls[idx].promocao" name='promocao' class='form-control'  > 
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" v-if="ctrls[idx].promocao == 'S'">
                    <div class="form-group">
                        <label>Preço Promocional: </label>
                        <input v-once :value="ctrls[idx].valor" placeholder="R$ 00,00" class="form-control" v-money="money"  name="valor" required>
                    </div>
                </div>
            </div>
            <div class="card-footer white">
                <button style="margin-bottom: 7px;" class="btn btn-primary float-right" type="submit"><i class="icon icon-save" aria-hidden="true"></i> Salvar</button>
            </div>
        </form>
    </div>
    <div class="modal fade"  id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div  class="modal-dialog" role="document">
            <div  class="modal-content">
                <div class="modal-content b-0">
                    <div class="modal-header r-0 bg-primary">
                        <h6 class="modal-title text-white" id="exampleModalLabel">Adicionar {{status_opc}}</h6>
                        <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
                    </div>
                    <div class="modal-body container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Categoria: </label>
                                    <select v-model="catego" onchange="pesquisa(this.value)"  class='form-control'  > 
                                        <option disable>Selecione a categoria</option>
                                        <option v-for="categoria, key of categorias" :value="categoria.nome">{{categoria.nome}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{status_opc}}: </label>
                                    <select class='form-control' onchange="pesquisa2(this.value, this.options[this.selectedIndex].innerText)" > 
                                        <option disable selected>Selecione os {{status_opc}}</option>
                                        <option v-for="option, key of index" :value="option.valor">{{option.nome}}</option>  
                                    </select>
                                </div>                                
                                <div class="form-group" v-if="status_opc == 'Complementos' && index2.length > 0">                                    
                                        <label>Opções: </label>
                                        <multiselect v-model="value" :show-labels="false" :hide-selected="true" label="nome" track-by="nome" :options="index2" :multiple="true" :taggable="true" ></multiselect>
                                </div>  
                                <div class="form-group">
                                    <button @click="add()" class="btn btn-primary" type="button">Adicionar</button>
                                </div>
                                <div class="form-group" >
                                    <small style="color:red">{{alerta}}</small>
                                    <table class="table m-0 table-striped" v-if="status_opc=='Adicionais' && ctrls[idx].adicionais.length > 0">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Valor</th>
                                            <th></th>
                                        </tr>
                                        <tr v-for="adicional, ii of ctrls[idx].adicionais">
                                            <td>{{adicional.nome}}</td>
                                            <td>{{adicional.valor}}</td>
                                            <td>
                                                <button type="button"@click="remove(ii)" class="btn btn-danger btnRemove" style="margin-top: 0px;">
                                                    deletar
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table m-0 table-striped" v-if="status_opc == 'Complementos' && ctrls[idx].complementos.length > 0">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Opções</th>
                                            <th>Grátis até x Opções</th>
                                            <th></th>
                                        </tr>
                                        <tr v-for="complemento, ii of ctrls[idx].complementos">
                                            <td>{{complemento.nome}}</td>
                                            <td>
                                                <span v-for="opc, iii of ctrls[idx].complementos[ii].opcao" > {{opc.nome}}<br></span>
                                            </td>
                                            <td style="display: flex; justify-content: center;">
                                                <input style="width: 50px;" v-model="ctrls[idx].complementos[ii].max" type="number" min="0" step="0" >
                                            </td>
                                            <td>
                                                <button type="button"@click="remove(ii)" class="btn btn-danger btnRemove" style="margin-top: 0px;">
                                                    deletar
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>                                                             
                            </div>                           
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
<script>    
    Vue.use(VueTables.ClientTable);
    const vue = new Vue({
        el:".card",        
        components: { Multiselect: window.VueMultiselect.default },
        data:{   
            test:true,         
            columns: ['check','index', 'imagem', 'nome', 'categoria', 'valor', 'status', 'acoes'],            
            sortable: true,
            options: {                           
                headings: {
                    check:function (h) {
                        return h('input', {
                            attrs: {
                            type: 'checkbox',
                            id: 'selectAllCheckbox',
                            class:'form-control'
                            },
                            on: {
                                click: (e) => {                                    
                                    for(let i = 1; i < document.querySelectorAll('input[type=checkbox]').length; i++){               
                                        document.querySelectorAll('input[type=checkbox]')[i].checked = e.srcElement.checked   
                                    }                                   
                                }
                            }                            
                        })
                    },
                    index: 'ID',
                    imagem:'Imagem',
                    nome: 'Nome',
                    categoria:'Categoria',
                    valor: 'Valor', 
                    status: 'Status',
                    acoes: 'Ações',
                },                
                sortable: ['index', 'imagem', 'nome', 'categoria', 'valor', 'status', 'acoes'],
                filterable: ['index', 'imagem', 'nome', 'categoria', 'valor', 'status', 'acoes'],
                texts: {
                    count: "Mostrando de {from} a {to} total {count} registros|{count} registros|Um registro",
                    first: 'Primeiro',
                    last: 'Último',
                    filter: "",
                    filterPlaceholder: "Pesquisa",
                    limit: "",
                    page: "Página:",
                    noResults: "Sem registros correspondentes",
                    filterBy: "Filtrar por {column}",
                    loading: 'Carregando...',
                    defaultOption: 'Selecione {column}',
                    columns: 'Colunas'
                },             
            }, 
            table:[],
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                masked: false 
            },
            alerta:null,
            opcao:null,
            vlr:null,
            catego:null,
            status_opc:null,
            folder:'wa/delivery/uploads/',
            idx:0,
            index:[],
            index2:[],
            status:"<?php echo $status ?>",
            dias:[{tudo: 'Selecionar tudo',semana:['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado']}],
            ctrls:<?php echo $query ?>,
            categorias: <?php echo $categoria ?>,
            complementos: <?php echo $complemento ?>,
            adicionais: <?php echo $adicional ?>,
            value: []
        },
        updated: function(){
            this.$nextTick(function () {                               
                document.getElementById('complementos') != undefined?
                    document.getElementById('complementos').value = JSON.stringify(this.ctrls[this.idx].complementos):
                    void(0)
                document.getElementById('adicionais') != undefined?
                    document.getElementById('adicionais').value = JSON.stringify(this.ctrls[this.idx].adicionais):
                    void(0)
                document.getElementById('dias') != undefined?
                    document.getElementById('dias').value = JSON.stringify(this.ctrls[this.idx].dias):
                    void(0)
            })
        },
        methods:{
            move: function(a, b){
                this.status = a;
                this.idx = b;
                !Array.isArray(this.ctrls[this.idx].dias) && typeof(this.ctrls[this.idx].dias) != "string"?
                    this.ctrls[this.idx].dias = []:
                    this.ctrls[this.idx].dias =JSON.parse(this.ctrls[this.idx].dias)
                !Array.isArray(this.ctrls[this.idx].adicionais) && typeof(this.ctrls[this.idx].adicionais) != "string"?
                    this.ctrls[this.idx].adicionais = []:
                    this.ctrls[this.idx].adicionais =JSON.parse(this.ctrls[this.idx].adicionais)
                !Array.isArray(this.ctrls[this.idx].complementos) && typeof(this.ctrls[this.idx].complementos) != "string"?
                    this.ctrls[this.idx].complementos = []:
                    this.ctrls[this.idx].complementos =JSON.parse(this.ctrls[this.idx].complementos)
            },
            add: function(){
                switch(this.opcao){
                    case 'Selecione os Complementos':
                        this.alerta = 'Preencha os campos obrigatórios acima'
                    break;
                    case 'Selecione os Adicionais':
                        this.alerta = 'Preencha os campos obrigatórios acima'
                    break;
                    case null:
                        this.alerta = 'Preencha os campos obrigatórios acima'
                    break;
                    default:
                    this.status_opc == 'Complementos'?
                        this.ctrls[this.idx].complementos.push({nome:this.opcao, max:0, opcao:this.value}):
                        this.ctrls[this.idx].adicionais.push({nome:this.opcao, valor:this.vlr})
                        this.value =[]
                        this.alerta = null
                }
            },
            remove: function(i){
                swal({
                title: "Você tem certeza?", 
                text: "Deseja realmente deletar este item?", 
                icon: "info",
                buttons: true}
                ).then((a)=>{
                    if(a) {
                    this.status_opc == 'Complementos'?
                        this.ctrls[this.idx].complementos.splice(i, 1):
                        this.ctrls[this.idx].adicionais.splice(i, 1)
                        swal("Deletado", "Item deletado com sucesso!!", "success");  
                    }
                });  
            },
            capa: function(a){
                var input = event.target
                var reader = new FileReader()
                    this.ctrls[this.idx].imagem = 0
                    reader.onload = (e) => {
                        document.getElementById('view').src = e.target.result;
                    }
                reader.readAsDataURL(input.files[0]);
            }, 
            ativar: function (a, b) { 
                let form = new FormData()               
                if(this.ctrls[a].status == 'Ativo'){
                    form.append('status','Inativo')
                    this.ctrls[a].status = 'Inativo'
                    fetch('?Prod&id='+b, {
                        method: 'POST',
                        body: form
                    }) 
                }else{
                    this.ctrls[a].status = 'Ativo'
                    form.append('status','Ativo')
                    fetch('?Prod&id='+b, {
                        method: 'POST',
                        body: form
                    })  
                }
            },            
            valor: function (a, b, c) { 
                let form = new FormData()            
                form.append('valor',c)
                fetch('?Prod&id='+b, {
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
    }); 
    function pesquisa(a){ 
        vue.index = []
        let geo
        if(vue.status_opc == "Complementos"){           
            vue.complementos.filter(
                function(b,i){     
                    return [a].every(()=>{
                        if(b.categoria.includes(a)){
                             !Array.isArray(vue.complementos[i].opcoes)?
                                vue.complementos[i].opcoes = JSON.parse(vue.complementos[i].opcoes):
                                void(0)
                            vue.index.push(b)
                        }   
                    });
                }
            ); 
        }else{           
            vue.adicionais.filter(
                function(b,i){     
                    return [a].every(()=>{
                        if(b.categoria.includes(a)){
                            vue.vlr = b.valor                            
                            vue.index.push(b)
                        }   
                    });
                }
            );         
        }
    }
    function pesquisa2(a,c){
        vue.index2 = [] 
        vue.value = [] 
        if(vue.status_opc == "Complementos"){          
            vue.complementos.filter(
                function(b,i){     
                    return [a].every(()=>{
                        if(b.nome.includes(c)){
                            vue.index2.push(b.opcoes)                            
                        }   
                    });
                }                
            ); 
        }
        vue.opcao = c
        vue.vlr = a
        vue.index2 = vue.index2[0];
    }
    for(let i = 0; i < vue.ctrls.length; i++){
        Object.assign(vue.ctrls[i],{index:i})        
        Object.assign(vue.ctrls[i],{checked:false})        
        vue.table.push(vue.ctrls[i])        
    }   
 function massa(){
    swal({
        title: "Você tem certeza?", 
        text: "Deseja realmente deletar este(s) dado(s)?", 
        icon: "info",
        buttons: true}
        ).then((a)=>{
            if(a) {
                for(let i= 0; i<document.querySelectorAll('input[type=checkbox]').length-1;i++){                    
                    if(document.getElementById('checkbx'+i).checked == true){
                        fetch('?header=Prod&db=<?php echo $db; ?>&Deletar='+document.getElementById('checkbx'+i).value)
                    }
                    if(parseInt(i+2) == document.querySelectorAll('input[type=checkbox]').length){
                        setTimeout(function(){window.location = "?sucesso&Prod"},1000)                              
                    }
                }
            }
        })
            
}
</script>