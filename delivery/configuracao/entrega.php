<?php
    $banco = json_encode(DBRead('delivery_entrega','*')[0]);
    if(isset($_GET['editaEntr'])){
    $id = 1;
    $route ='&Entr';
    $db = 'delivery_entrega';
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
        <strong>Configuração  de Entrega</strong>
    </div>
    <div class="card-body">
        <form method="post" action="?Entr&editaEntr" enctype="multipart/form-data">
            <h4>Configuração de Listagem</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Estado:</label>
                        <select name="estado" v-model="idx.estado" class="form-control custom-select" required>
                            <option value="" disabled selected>Estado</option>
                            <option value="AC" >Acre</option>
                            <option value="AL" >Alagoas</option>
                            <option value="AP" >Amapá</option>
                            <option value="AM" >Amazonas</option>
                            <option value="BA" >Bahia</option>
                            <option value="CE" >Ceará</option>
                            <option value="DF" >Distrito Federal</option>
                            <option value="ES" >Espírito Santo</option>
                            <option value="GO" >Goiás</option>
                            <option value="MA" >Maranhão</option>
                            <option value="MT" >Mato Grosso</option>
                            <option value="MS" >Mato Grosso do Sul</option>
                            <option value="MG" >Minas Gerais</option>
                            <option value="PA" >Pará</option>
                            <option value="PB" >Paraíba</option>
                            <option value="PR" >Paraná</option>
                            <option value="PE" >Pernambuco</option>
                            <option value="PI" >Piauí</option>
                            <option value="RJ" >Rio de Janeiro</option>
                            <option value="RN" >Rio Grande do Norte</option>
                            <option value="RS" >Rio Grande do Sul</option>
                            <option value="RO" >Rondônia</option>
                            <option value="RR" >Roraima</option>
                            <option value="SC" >Santa Catarina</option>
                            <option value="SP" >São Paulo</option>
                            <option value="SE" >Sergipe</option>
                            <option value="TO" >Tocantins</option>
                        </select>                        
                    </div>
                    
                    <div class="form-group">
                        <label>Bairro:</label>                        
                        <input v-model="idx.bairro"  placeholder="Bairro" class="form-control" name="bairro" required>
                    </div>

                    <div class="form-group">
                        <label>Rua:</label>                        
                        <input v-model="idx.rua" placeholder="Rua" class="form-control" name="rua" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tipo de Entrega:</label>
                        <select v-model="idx.tipo" @change="idx.entrega = []" name="tipo" class="form-control custom-select" required>
                            <option value="cep" >Por Cep</option>
                            <option value="bairro" >Por Bairro</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cidade:</label>                        
                        <input v-model="idx.cidade" placeholder="Cidade" class="form-control" name="cidade" required>
                    </div>
                    <div class="form-group">
                        <label>Número:</label>                        
                        <input v-model="idx.numero" placeholder="Número" class="form-control" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label>CEP:</label>                        
                        <input v-model="idx.cep" placeholder="CEP" class="form-control" name="cep" required>
                    </div>
                </div>
            </div>
            <input type="hidden" id="entrega" name="entrega" :value="idx.entrega">
            <div class="row">
                <div class="col-md-12" >                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" @click="add" class="btn btn-primary btnAdd" style="margin-bottom: 15px;">
                                <i class=" icon-plus"></i>
                            </button> 
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row" style="margin-left: 50px;" v-for=" opicao, i  of idx.entrega">
                <div :class="idx.tipo == 'cep'?'col-md-4':'col-md-3'">
                    <div class="form-group">
                        <label>{{idx.tipo == 'cep'?'Descrição':'Bairro'}}: </label> 
                        <input v-if="idx.tipo == 'cep'" class="form-control" v-model="opicao.descricao"  required>
                        <input v-else class="form-control" v-model="opicao.bairro"  required>

                    </div>
                </div>
                <div class="col-md-3" v-if="idx.tipo == 'cep'">
                    <div class="form-group">
                        <label>Cep Inicial : </label>
                        <input  class="form-control" type="number" v-model="opicao.inicio"  required>
                        
                    </div>
                </div>
                <div class="col-md-3" v-if="idx.tipo == 'cep'">
                    <div class="form-group">
                        <label>Cep Final: </label>
                        <input class="form-control" type="number" v-model="opicao.fim"     required>
                    </div>
                </div>
                <div class="col-md-3" >
                    <div class="form-group">
                        <label>Tempo Médio de Entrega: </label>
                        <input class="form-control" v-model="opicao.tempo"    required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Valor R$: </label>
                        <input class="form-control" @input="idx.entrega[i].valor = $event.target.value" :value="opicao.valor" v-money="money"  placeholder="+ R$ 0,00"  required>
                        <small style="white-space: nowrap;">Coloque 0 para não cobrar</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="button"@click="remove(i)" class="btn btn-danger btnRemove" style="margin-top: 26px;">
                            <i class="icon-trash"></i>
                        </button>    
                    </div>
                </div>
            </div>         
            <hr>
            <h4>Média de Entrega</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mostrar Médio de Entrega</label>
                        <select v-model="idx.media" name="media" class="form-control custom-select" required>
                            <option value="S"> Sim</option>
                            <option value="N">Não</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" v-if="idx.media == 'S'">  
                    <div class="form-group">
                        <label>Tempo Médio para Entrega</label>
                        <input v-model="idx.tempo" type="text" placeholder="Tempo Médio" class="form-control" name="tempo" required>
                    </div>
                </div>
            </div> 
            <hr>
            <h4>Opções de Entrega</h4>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input v-model="idx.delivery" type="checkbox" name="delivery" id="delivery">
                        <label for="delivery">Permitir delivery</label>
                    </div>
                    <div class="form-group">
                        <input v-model="idx.balcao" type="checkbox" name="balcao" id="balcao">
                        <label for="balcao">Permitir retirada no balcão</label>
                    </div>
                    <div class="form-group">
                        <input v-model="idx.mesa" type="checkbox" name="mesa" id="mesa">
                        <label  for="mesa">Permitir pedido na mesa</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mensagem Sobre Retirar no Local:</label>                        
                        <input v-model="idx.msg" class="form-control" name="msg" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Valor Mínimo do Delivery:</label>                        
                        <input v-model="idx.min" v-money="money" class="form-control" name="min" >
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
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                masked: false 
            },
            idx:<?php echo $banco ?>
        },
        updated: function(){
            this.$nextTick(function () {
                document.getElementById('entrega') != undefined?
                    document.getElementById('entrega').value = JSON.stringify(this.idx.entrega):
                    void(0)
            })
        },
        methods: {
            add: function(){
                this.idx.tipo == 'cep'?
                    this.idx.entrega.push({ descricao:'',inicio:'', fim:'', tempo:'',valor:''}):
                    this.idx.entrega.push({ bairro:'',tempo:'', valor:''})
            },
            remove: function(i){
                this.idx.entrega.splice(i, 1)
            },
        }
   })
    !Array.isArray(vue.idx.entrega) && typeof(vue.idx.entrega) != "string"?
        vue.idx.entrega = []:
        vue.idx.entrega = JSON.parse(vue.idx.entrega)


</script>