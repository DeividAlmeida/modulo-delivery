<?php
error_reporting(0);
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$data = DBRead('delivery_pedidos', '*', 'ORDER BY id DESC');
$pedido = [];
$table = [];
$item = '';
$add = '';
if(is_array($data)){
    foreach($data as $chave => $valor){
        $pedido[$chave] = json_decode($data[$chave]['pedido'], true); 
        if(is_array($pedido[$chave])){                            
            foreach($pedido[$chave] as $key => $value){
               
               $item.= '
                <p style="margin-left:10px;" align="left">
                    <span class="tx-12">
                    <b>** Item: </b>'.$value['nome'].'
                    </span>
                    </p>	
                    <p style="margin-left:10px;" align="left">
                    <span class="tx-12"><b>- Qnt:</b> '.$value['qtd'].'</span>
                    </p>	
                    <p style="margin-left:10px;" align="left">
                    <span class="tx-12">
                        <b>- V. Unitário:</b> R$: '.$value['total'].'
                    </span>
                </p>	
                <p style="margin-left:10px;" align="left">
                    <span class="tx-12">
                        <b>- Obs:</b> Sem picles 
                    </span>
                </p>
                <p style="margin-left:10px;" align="left">
                    <span class="tx-12">
                        <b>* Adicionais/Ingredientes:</b>
                    </span>
                </p>'.$add		
                ;
                if(is_array($pedido[$chave]['complementos'])){
                    var_dump($pedido[$chave]['complementos']);
                    foreach($pedido[$chave]['complementos'] as $c => $v){                        
                        if(count($v) >2){
                            
                        }else{                       
                           $add .=
                           '<p style="margin-left:10px;" align="left">
                               <span class="tx-12">
                               -  R$: '.$v[1].' | '.$v[0].' <br>
                               </span>
                           </p>';
                       }
                   };
               };               
            };
        };             
        $table[$chave]['print'] =  '<span id="visul_usuario" class="row justify-content-around">		
        <div class="card card-people-list pd-15 mg-b-10 col-md-5" style="background-color:#fdfbe3; padding:0px;height: 100%;">
        <center>
        <a href="#" class="btn btn-primary btn-block invoice-print" name="btnprint" onclick="PrintMe('.$chave.')">
        <i class="fa fa-print" aria-hidden="true"></i> - Balcão
                </a>
                </center>
                <div id="'.$chave.'" style="font-family: Arial;">
                    <center>                        
                    </center>
                    <center>
                        <p class="tx-15">
                            <strong>DEMO CARDÁPIO MOBILE</strong>
                        </p>
                    </center>
                    <center>
                        <p class="tx-12">Av. Miguel de Castro 123, Bairro Pirituba</p>
                    </center>
                    <center>
                        <p class="tx-12">São Paulo - SP / 11984187415</p>
                    </center>
                    <center>
                        <p class="tx-12">CUPOM NÃO FISCAL</p>
                    </center>
                    <hr>
                    <center>
                        <p class="tx-15">
                            <strong>PARA DELIVERY</strong>
                        </p>
                    </center>
                    <center>
                        <p class="tx-12">02-06-2021 às 12:30:01</p>
                    </center>
                    <center>
                        <p class="tx-12">Nº '.$valor['id'].'</p>
                    </center>
                    <hr>'.
                $item.'<center>=========================</center>	
                    <br>
                    <center>
                        <strong>DADOS DO CLIENTE</strong>
                    </center>
                    <hr>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Nome: </b>'.$valor['nome'].'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Celular: </b>'.$valor['fone'].'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Rua: </b>Rua '.$valor['endereco'].'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Nº: </b>'.$valor['numero'].'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Bairro: </b>'.$valor['bairro'].'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Complemento: </b>'.$valor['complemento'].'
                        </span>
                    </p>
                    <br>
                    <center><strong>PAGAMENTO</strong></center>
                    <hr>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">Pagamento (<b>DEBITO</b>)</span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Subtotal: R$: </b>20,00
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12"><b>Adicionais: R$: </b>18,00
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Desconto de </b>5%
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Entrega: R$: </b>4,00
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Total Geral: </b> '.$valor['valor'].'
                        </span>
                    </p>
                    <br>
                    <p style="margin-left:10px;" align="right">
                        <span class="tx-11">
                            <b>15-06-2021 11:42:42</b>
                        </span>
                    </p>                      			  
                </div>
            </div>

                    
            <div class="card card-people-list pd-15 mg-b-10 col-md-5" style="background-color:#fdfbe3; padding:0px;height: 100%;">
                <center>
                    <a href="#" class="btn btn-primary btn-block invoice-print" name="btnprint" onclick="PrintMe2('.$chave .')">
                        <i class="fa fa-print" aria-hidden="true"></i> - Cozinha
                    </a>
                </center>			  
                <div class="'.$chave.'" style="font-family: Arial;">
                    <center>
                        <p class="tx-15">
                            <strong>RESUMO DO PEDIDO</strong>
                        </p>
                    </center>
                    <center>
                        <p class="tx-12">02-06-2021 às 12:30:01</p>
                    </center>
                    <center>
                        <p class="tx-12">Nº '.$valor['id'].'</p>
                    </center>
                    <hr>		
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>** Item:</b> Monte seu lanche
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>- Qnt:</b> '.$valor['total'].'
                        </span>
                    </p>	
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>- Obs:</b> Sem picles 
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>* Adicionais/Ingredientes:</b>
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            - Pão Australiano<br>
                            - Mal Passado<br>
                            - Mussarela<br>		
                            - Tomate<br>		
                            - Alface<br>		
                            - + 2 Carnes<br>		
                        </span>
                    </p>
                    <center>=========================</center>
                    <br>
                    <center><strong>DADOS DO CLIENTE</strong></center>
                    <hr>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Nome: </b>'.$valor['nome'].'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Celular: </b>'.$valor['fone'].'
                        </span>
                    </p>
                    <br>
                    <p style="margin-left:10px;" align="right">
                        <span class="tx-11">
                            <b>15-06-2021 11:42:42</b>
                        </span>
                    </p>
                    </center>
                </div>			  
            </div>
        </span>';
        #para o chekcbox
        $table[$chave]['<div class="hidden">'] = "";
        $table[$chave]['id'] = $valor['id'];  
        $table[$chave]['nome'] = $valor['nome'];  
        $table[$chave]['data'] = $valor['data'];  
        $table[$chave]['valor'] = $valor['valor'];  
        $table[$chave]['check'] = '';
    };
}
#var_dump($pedido);
echo json_encode($table);