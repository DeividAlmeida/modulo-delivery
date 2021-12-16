<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js'></script>
<script src='https://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js'></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table-locale-all.min.js"></script>
    <form id="pedidos" method="POST">
        <div class="card">
            <div class="card-header  white"> 
                <button id="showSelectedRows" class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Excluir em Massa</button>
            </div>
            <div class="card-body">
                <div>
                    <table 
                    class="table  table-striped BootstrapTable" 
                    id="BootstrapTable" 
                    data-auto-refresh="true" 
                    data-auto-refresh-interval="120" 
                    data-checkbox-header="true"  
                    data-click-to-select="true"   
                    data-id-field="id" 
                    data-select-item-name="id[]" 
                    data-maintain-meta-data="true"  
                    data-show-refresh="true"  
                    data-show-pagination-switch="true" 
                    data-detail-view="true"   
                    data-detail-formatter="detailFormatter"  
                    data-url="delivery/pedidos/data.php" 
                    data-toggle="table" 
                    data-pagination="true" 
                    data-locale="pt-BR" 
                    data-cache="false" 
                    data-search="true" 
                    data-show-export="true" 
                    data-export-data-type="all" 
                    data-export-types="['csv', 'excel', 'pdf']" 
                    data-mobile-responsive="true"
                     data-click-to-select="true" 
                     data-toolbar="#toolbar" 
                     data-show-columns="true" 
                     >     
                        <thead >
                            <tr >
                                <th data-field="check" data-checkbox="true"></th>        
                                <th scope="col" data-field="id" data-sortable="true" > <span style="font-weight: bold; font-size:16px;">Id do Pedido<span></th>
                                <th scope="col" data-field="nome" data-sortable="true" > <span style="font-weight: bold; font-size:16px;">Comprador<span></th>
                                <th scope="col" data-field="valor" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">Valor da Venda<span></th>
                                <th scope="col" data-field="data" data-sortable="true" ><span style="font-weight: bold; font-size:16px;">Data do Pedido<span></th>
                            </tr>
                        </thead>
        
                    </table>
                </div>
            </div>
        </div>
    </form>
    
<script>
    $(document).ready(function() {				
        $("#BootstrapTable").DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Mostrar _MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
            },
        });  
    });
    $('#pedidos').submit(function(e) {
        e.preventDefault();            
        var data = $(this).serializeArray();                     				
        swal({
            title: "Você tem certeza?",
            text: "Deseja realmente deletar o(s) pedido(s)?",
            icon: "warning",
            buttons: {
            cancel: "Não",
            confirm: {
                text: "Sim",
                className: "btn-primary",
            },
            },
            closeOnCancel: false
            }).then(function(isConfirm) {
                if (isConfirm) {                    
                    $.ajax({
                        data: data,
                        type: "POST",
                        cache: false,
                        url: "delivery.php?deletarPedidos", 
                        complete: function( data ){
                            window.location = "./delivery.php?sucesso";
                             }   
                    });
                } 
                else {
                    swal("Cancelado", "Pedido(s) permanece(m) salvo(s)", "error");
                }  
            
            });        
        });
        function detailFormatter(index, row) { 
			var html = []
			$.each(row, function (key, value) {            
				html.push('<b>' + key + ':</b> ' + value + '<br>');          
			})        
			return html.join('');        
		}
        function PrintMe(DivID) {
            var disp_setting="toolbar=yes,location=no,";
            disp_setting+="directories=yes,menubar=yes,";
            disp_setting+="scrollbars=yes,width=450, height=600, left=100, top=25";
            var content_vlue = document.getElementById(DivID).innerHTML;
            var docprint=window.open("","",disp_setting);
            docprint.document.open();
            docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
            docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
            docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
            docprint.document.write('<head><title>COMANDA BALCAO</title>');
            docprint.document.write('<style type="text/css">body{ margin:0px;');
            docprint.document.write('font-family:verdana,Arial;color:#000;');
            docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
            docprint.document.write('a{color:#000;text-decoration:none;} </style>');
            docprint.document.write('</head><body onLoad="self.print()">');
            docprint.document.write(content_vlue);
            docprint.document.write('</body></html>');
            docprint.document.close();
            docprint.focus();
        }
        function PrintMe2(DivID) {
            var disp_setting="toolbar=yes,location=no,";
            disp_setting+="directories=yes,menubar=yes,";
            disp_setting+="scrollbars=yes,width=450, height=600, left=100, top=25";
            var content_vlue = document.getElementsByClassName(DivID)[0].innerHTML;
            var docprint=window.open("","",disp_setting);
            docprint.document.open();
            docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
            docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
            docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
            docprint.document.write('<head><title>COMANDA MESA</title>');
            docprint.document.write('<style type="text/css">body{ margin:0px;');
            docprint.document.write('font-family:verdana,Arial;color:#000;');
            docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
            docprint.document.write('a{color:#000;text-decoration:none;} </style>');
            docprint.document.write('</head><body onLoad="self.print()"><center>');
            docprint.document.write(content_vlue);
            docprint.document.write('</center></body></html>');
            docprint.document.close();
            docprint.focus();
        }
    </script>
