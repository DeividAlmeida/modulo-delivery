<?php
error_reporting(0);
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
$data = DBRead('delivery_pedidos', '*', 'ORDER BY id DESC');
$entrega = DBRead('delivery_entrega', '*')[0];
$pedido = [];
$table = [];

if(is_array($data)){
    foreach($data as $chave => $valor){
        $item = '';
        $item_cozinha = '';
        $a = floatval(floatval(str_replace(",",".",str_replace(".","",str_replace('R$',"",$valor['entrega'])))));
        $b = floatval(floatval(str_replace(",",".",str_replace(".","",str_replace('R$',"",$valor['valor'])))));
        $total = number_format($a+$b,2,'.', '');
        $pedido[$chave] = json_decode($data[$chave]['pedido'], true); 
        if($valor['troco']!=null && $valor['pagamento']=='Dinheiro'){
           $troco= '<p style="margin-left:10px;" align="left">
                <span class="tx-12">
                    <b>Troco R$: </b>'.$valor['troco'].'
                </span>
            </p>';
            }else{
                $troco=null;
            }
        if(is_array($pedido[$chave])){                            
            foreach($pedido[$chave] as $key => $value){
                if(is_array($pedido[$chave][$key]['complementos'])){
                    $add = '';
                    $add_cozinha = '';
                    foreach($pedido[$chave][$key]['complementos'] as $c => $v){                        
                        if(count($v) >2){
                            foreach($v as $pass => $vl){
                                if($v[$pass+2]['qtd']>0){                                    
                                    $add .=
                                    '<p style="margin-left:10px;" align="left">
                                        <span class="tx-12">
                                           - '.$v[$pass+2]['qtd']*$value['qtd'].' x R$: '.str_replace(",",".",str_replace("R$","",$v[$pass+2]['vl'])).' | '.$v[0].' - '.$v[$pass+2]['nome'].' <br>
                                        </span>
                                    </p>';
                                    $add_cozinha .='
                                    <p style="margin-left:10px;" align="left">
                                        <span class="tx-12">                                                                                      		
                                            - + '.$v[$pass+2]['qtd']*$value['qtd'].' '.$v[0].' - '.$v[$pass+2]['nome'].'<br>		
                                        </span>
                                    </p>
                                    ';
                                };
                            };
                        }else{                       
                           $add .=
                           '<p style="margin-left:10px;" align="left">
                                <span class="tx-12">
                                    - '.$value['qtd'].' x R$: '.$v[1].' | '.$v[0].' <br>
                               </span>
                            </p>';
                            $add_cozinha .='
                                <p style="margin-left:10px;" align="left">
                                    <span class="tx-12">                                                                                      		
                                        - + '.$value['qtd'].' '.$v[0].'<br>		
                                    </span>
                                </p>
                                ';
                       }
                    };
                };               
                if(is_array($pedido[$chave][$key]['adicionais'])){
                    foreach($pedido[$chave][$key]['adicionais'] as $a => $v){ 
                        if($v['qtd']>0){
                            $add .=
                           '<p style="margin-left:10px;" align="left">
                                <span class="tx-12">
                                    - '.$value['qtd']*$v['qtd'].' x R$: '.str_replace(",",".",str_replace(".","",$v["vl"])).' | '.$v["nome"].' <br>
                                </span>
                            </p>';
                            $add_cozinha  .='
                                <p style="margin-left:10px;" align="left">
                                    <span class="tx-12">                                                                                      		
                                        - + '.$value['qtd']*$v['qtd'].' '.$v["nome"].'<br>		
                                    </span>
                                </p>
                                ';
                        }
                    }
                }
                $item_cozinha .='                    		
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>** Item:</b> '.$value['nome'].'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>- Qnt:</b> '.$value['qtd'].'
                        </span>
                    </p>                    
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>* Adicionais/Ingredientes:</b>
                        </span>
                    </p>'.$add_cozinha.'<br><br>
                ';
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
                        <b>- Sub-valor:</b> R$: '.$value['total'].'
                    </span>
                </p>                
                <p style="margin-left:10px;" align="left">
                    <span class="tx-12">
                        <b>* Adicionais/Ingredientes:</b>
                    </span>
                </p>'.$add.'<br><br>'		
                ;
            };
        };             
        $table[$chave]['<span class="hidden">'] =  '</span><span id="visul_usuario" class="row justify-content-around">		
        <div class="card card-people-list pd-15 mg-b-10 col-md-3" style="background-color:#fdfbe3; padding:0px;height: 100%;">
        <center>
        <a href="#" class="btn btn-primary btn-block invoice-print" name="btnprint" onclick="PrintMe('.$chave.')">
        <i class="fa fa-print" aria-hidden="true"></i> - Balcão
                </a>
                </center>
                <div id="'.$chave.'" style="font-family: Arial;">
                    
                    <center>
                        <p class="tx-12">'.$entrega['rua'].', Bairro '.$entrega['bairro'].'</p>
                    </center>
                    <center>
                        <p class="tx-12">'.$entrega['cidade'].' - '.$entrega['estado'].' / '.$entrega['numero'].'</p>
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
                        <p class="tx-12">'.$valor['data'].'</p>
                    </center>
                    <center>
                        <p class="tx-12">Nº '.$valor['id'].'</p>
                    </center>
                    <hr>'.
                $item.'
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>- Obs:</b> '.$valor['observa'].' 
                        </span>
                    </p>
                    <center>=========================</center>	
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
                        <span class="tx-12">Pagamento (<b>'.$valor['pagamento'].'</b>)</span>
                    </p>'.$troco.'
                    
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Subtotal R$: </b>'.str_replace(",",".",str_replace(".","",str_replace('R$',"",$valor['valor']))).'
                        </span>
                    </p>                    
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Entrega R$: </b>'.str_replace(",",".",str_replace(".","",str_replace('R$',"",$valor['entrega']))).'
                        </span>
                    </p>
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>Total Geral: </b> '.$total.'
                        </span>
                    </p>
                    <br>                                         			  
                </div>
            </div>

                    
            <div class="card card-people-list pd-15 mg-b-10 col-md-3" style="background-color:#fdfbe3; padding:0px;height: 100%;">
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
                        <p class="tx-12">'.$valor['data'].'</p>
                    </center>
                    <center>
                        <p class="tx-12">Nº '.$valor['id'].'</p>
                    </center>
                    <hr>
                    '.$item_cozinha.' 
                    <p style="margin-left:10px;" align="left">
                        <span class="tx-12">
                            <b>- Obs:</b> '.$valor['observa'].' 
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