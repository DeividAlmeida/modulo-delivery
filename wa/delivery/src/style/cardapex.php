<style>
    /* Helpers */
body {background:#f5f5f5; font-family: 'Roboto', sans-serif;}
h1, h2, h3, h4, h5, h6 {font-family: 'Roboto', sans-serif; color:#c32c31; font-weight:bold;}
input {max-width:100%;}
img {max-width:100%;}
ul {list-style:none; margin:0px; padding:0px;}
input[type="number"]::-webkit-inner-spin-button, input[type="number"]::-webkit-outer-spin-button {opacity: 1; padding:5px; line-height:18px; cursor:pointer;}

.jconfirm .jconfirm-box div.jconfirm-title-c .jconfirm-title {display: inline;}

#cardapio { position: relative; }

/* Barra Topo */
.barra-topo {display:table; width:100%; background:#8a1d21; padding:10px 0px;}
.barra-topo p {margin:0px; color:#fff; float:right; font-size:12px; padding:5px;}
.barra-topo p i {margin-right:3px;}

/* Header */
header {display:table; width:100%; padding:20px 0; background:#c32c31; background-size:cover; background-position:center center; background-repeat:no-repeat; position:relative;}
header:before {content:''; display:block; width:100%; height:60%; background: linear-gradient(0deg, rgba(0,0,0,0.5047794117647058) 0%, rgba(0,0,0,0) 100%); position:absolute; bottom:0; left:0;}
header .container {position:relative;}
header .row {display:flex; align-items:center;}
header .logo {display:table; margin:0 auto; border-radius: 50%; height:160px; width:160px; background:#8a1d21; border:5px #fff solid; position:relative; box-shadow: 0px 0px 10px #0000001c; overflow:hidden;}
header .logo img {position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); display:table; width:90%; max-width:90%; height:auto;}
header p {margin-top:20px; font-size:12px; margin-bottom:0px;}

/* Select Demo */
.boxSelectDemo {display:block; position:fixed; top:0; left:0; background:#0000009e; z-index:999; width:100%; height:100%;}
	.boxSelectDemo .center {position:relative; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:30px; display:table; border-radius:5px; width:400px; text-align:center;}
	.boxSelectDemo .center p {font-size:14px;}
	.boxSelectDemo .center select {background:#fff; border:1px #dedede solid; border-radius:4px;}

/* Horario */
header .horario-atendimento {position:absolute; right:15px; bottom:0px;}
header .horario-atendimento p {display:table; border:0px; padding:10px 15px; background:#fff; color:#000; border-radius: 10px 10px 0px 0px; font-size:14px;}
header .horario-atendimento p i.fa-clock {color:#ccc;}
header .horario-atendimento p strong {color:#3fb91e; margin-left:5px;}
header .horario-atendimento p span {display:block;}
header .horario-atendimento p.fechado strong {color:#c32c31;}
header .box-horarios {position:absolute; right:0px; top:100%; background: #fff; z-index: 9; width: 310px; padding: 20px; box-shadow: 0px 10px 10px #00000040;}
.box-horarios li {color:#000; clear: both; padding:5px 0;}
.box-horarios li:last-child {margin-bottom: 0; border-bottom: none;}
.box-horarios li strong {font-size: 14px;}
.box-horarios li span {color:#666; display: inline-block; max-width: 49%; padding:0 5px;}

.blocker {z-index:999999 !important;}
.modal {overflow: visible; height: initial;}

/* Horario - Modal Fechado */
#modalFechado {
	max-width: 500px;
	padding:20px;
}
#modalFechado h3 {font-size:32px; line-height:32px;}
#modalFechado h3:after {content:''; width:100%; height:5px; border-radius:5px; background:#00e36f; margin:15px 0px; display:table;}
#modalFechado p { text-align: center; }
#modalFechado .box-horarios li {border-bottom: 1px #c32c31 solid;}
#modalFechado .box-horarios li:last-child {border-bottom: none;}
@media all and (min-width:769px) {
	#modalFechado .box-horarios li,
	section.informacoes .box-horarios li {padding: 0 5px 5px; margin-bottom: 5px;}
	header .box-horarios li span {font-size: 10px;}
	#modalFechado .box-horarios li span,
	section.informacoes .box-horarios li span {font-size: 14px;}
}

.modal-fechado-idx {
	z-index: 1000 !important;
}

/* Barra Dados */
section.barraDados {background:#fff; border-bottom:1px #dedede solid; display:table; width:100%;}

	section.barraDados .boxin {padding-right:10px; display:table; float:left; border-right: 1px #dedede solid; padding-top:10px;}

	section.barraDados .horario-atendimento {display:table; float:left; position:relative; width:100%;}
	section.barraDados .horario-atendimento p.btn {text-align:left; display:table; position:relative; padding:15px; padding-left:55px; padding-right:45px; margin:0; border-radius:10px 10px 0 0; border:1px transparent solid; border-bottom:0;  width:100%;}
	section.barraDados .horario-atendimento p.btn.ativo:before {content:''; background:#fff; position:absolute; left:0; top:100%; display:block; height:1px; width:100%; bottom: -1px; z-index: 100;}
	section.barraDados .horario-atendimento p.btn.ativo {border:1px #dedede solid; border-bottom:0;}
	section.barraDados .horario-atendimento p .fa-clock {position:absolute; left:10px; top:50%; transform:translateY(-50%); font-size:34px; color:#a9a9a9; background:url(<?php echo ConfigPainel('base_url'); ?>wa/delivery/src//img/icone-relogio.png) center center no-repeat; text-indent:-9999px; width:34px;}
	section.barraDados .horario-atendimento p .fa-angle-down {position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 24px; color: #a9a9a8; z-index:100;}
	section.barraDados .horario-atendimento p.btn strong {display:block; font-size:14px; line-height:12px; margin-top:8px; color:green;}
	section.barraDados .horario-atendimento p.btn.fechado strong {color:red;}
	section.barraDados .horario-atendimento span {font-size:12px; line-height:10px;}
	section.barraDados .horario-atendimento .box-horarios {position:absolute; top:100%; left:0; background:#fff; width:420px; z-index:99; border: 1px #dedede solid; padding:15px; margin-top:0px; border-radius: 0 15px 15px 0;}


	section.barraDados .boxin.entrega {padding:23px 25px; display:table;}
	section.barraDados .tempoEntrega {padding-left:47px; background:url(<?php echo ConfigPainel('base_url'); ?>wa/delivery/src//img/icon-tempo-entrega.png) left center no-repeat;}
	section.barraDados .tempoEntrega strong {display:block; font-size:14px; color:#000;}
	section.barraDados .tempoEntrega span {display:block; font-size:12px; color:#666;}

	section.barraDados .boxin.pagamento {display:table; position:relative; cursor:pointer; padding-left:10px; padding-right:10px; padding-right:10px;}
	section.barraDados .boxin.pagamento.ativo .formasPagamento:before {content:''; background:#fff; position:absolute; left:0; top:100%; display:block; height:1px; width:100%; bottom: -1px; z-index: 100;}
	section.barraDados .formasPagamento {text-align: left; display: table; position: relative; padding: 18px; padding-left: 55px; padding-right: 45px; margin: 0; border-radius: 10px 10px 0 0;
    border: 1px transparent solid; border-bottom: 0; width: 100%; background:url(<?php echo ConfigPainel('base_url'); ?>wa/delivery/src//img/icone-cartao.png) 10px center no-repeat;}
	section.barraDados .boxin.pagamento.ativo .formasPagamento {border:1px #dedede solid; border-bottom:0;}
	section.barraDados .formasPagamento strong {display:block; font-size:14px; line-height:14px; padding:5px 0; color:#000;}
	section.barraDados .boxin.pagamento .fa-angle-down {position: absolute; right: 15px; top: 50%; transform: translateY(-50%); font-size: 24px; color: #a9a9a8;}
	section.barraDados .boxin.pagamento .listaFormas {position:absolute; top:93%; left:10px; background:#fff; width:470px; z-index:99; border: 1px #dedede solid; padding:15px; border-radius: 0 15px 15px 0;}
	section.barraDados .boxin.pagamento .listaFormas h4 {font-size: 16px; border-bottom: 1px #dedede solid; padding-bottom: 10px; margin-bottom: 10px;}
	section.barraDados .boxin.pagamento .listaFormas ul {display:table; margin-bottom:20px;}
	section.barraDados .boxin.pagamento .listaFormas ul li {font-size:12px; background:#f5f5f5; color:#000; border-radius:40px; padding:5px 15px; display:table; float:left; margin-bottom:5px; margin-bottom:5px; margin-right:5px;}

	#shareModal {max-width: 500px; padding:20px;}
	section.barraDados .boxin.social {padding:23px 10px; float:right; border-right:0;}
	section.barraDados .boxin.social .redes {display:table; margin:auto;}
	section.barraDados .boxin.social a {position:relative; display:block; float:left; margin:5px; width:30px; height:30px; background:#000; color:#fff; border-radius:50%; opacity:.8;}
	section.barraDados .boxin.social a:hover {opacity:1;}
	section.barraDados .boxin.social a i {position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)}
	section.barraDados .boxin.social a.facebook {background:#097eec;}
	section.barraDados .boxin.social a.instagram {background:linear-gradient(45deg, rgba(243,143,45,1) 0%, rgba(138,38,111,1) 100%);}
	section.barraDados .boxin.social a.twitter {background:#2da1c3;}
	section.barraDados .boxin.social a.linkedin {background:#00509a;}
	section.barraDados .boxin.social a.geral {background:#ff6a00;}

	section.barraDados .boxin.social .compartilhar {float:left; padding-right:80px;}
	section.barraDados .boxin.social .compartilhar a {position: relative;}
		section.barraDados .boxin.social .compartilhar a span {position: absolute; z-index: 1; left:20px; top:50%; transform:translateY(-50%); font-size:11px; padding:3px 15px 2px; border-radius:20px; border:1px #ff6a00 solid; border-left: none; padding-left: 16px; color: #000;}

/* Filtros Header */
section.filtros-header {display:table; width:100%; margin-bottom:20px;}
section.filtros-header .boxin {padding:20px 0; padding-bottom:0; display: block; width:100%;}
section.filtros-header .campoFiltro {display: block; width:100%; border-radius:3px; border-radius:5px; position:relative;}
section.filtros-header .campoFiltro select {-webkit-appearance: none; -moz-appearance: none;  position:relative; z-index:2; background:#fff; appearance: none; border:0px; width:100%; display: block; cursor:pointer; padding:15px 15px; padding-left:60px; border-radius:100px; color:#000; font-size:15px;  border:1px #c7c7c7 solid; outline:none; font-family:'Barlow', sans-serif;}
section.filtros-header .campoFiltro i.fa-angle-down {position: absolute; right: 20px; top: 50%; transform: translateY(-50%); margin: auto; display: block; z-index: 10; color: #b9b9b9;}
section.filtros-header .campoFiltro i.fa-list {position: absolute; left: 6px; top: 50%; transform: translateY(-50%); margin: auto; display: block; z-index: 10; color: #b9b9b9; padding: 10px; font-size: 20px; border-radius: 50%; color:#fff;}
section.filtros-header .busca {display: block; width:100%; position:relative;}
section.filtros-header .busca input {-webkit-appearance: none; -moz-appearance: none;  position:relative; z-index: 2; background: #fff; appearance: none; border: 0px; width: 100%; display: block; cursor:pointer; padding:15px 15px; padding-left: 25px;padding-right: 30px; border-radius: 5px; color: #000; font-size: 14px; outline: none; border: 1px #c7c7c7 solid;  border-radius: 100px; font-family: 'Barlow', sans-serif; font-size:15px;}
section.filtros-header .busca button {-webkit-appearance: none; -moz-appearance: none;  position:absolute; top: 50%; transform: translateY(-50%); right: 6px; z-index: 2; background: url(<?php echo ConfigPainel('base_url'); ?>wa/delivery/src//img/icone-busca.png) center center no-repeat; appearance: none; border: 0px; cursor: pointer; padding:15px 15px; border-radius:5px; color:#000; font-size:14px; outline: none; text-indent: -9999px; width: 42px; height:42px; top:50%; transform:translateY(-50%); border-radius: 50%;}

section.filtro-fixo {position:fixed; top:0px; left:0px; width:100%; z-index:99; background:#fff;}
	section.filtro-fixo .boxin {padding:10px 0; border:0;}

/* Dados Header */
header h1 {color:#fff; font-family:'Roboto', sans-serif; font-size:36px; font-weight:bold; text-shadow: #000 0px 1px 1px;}
header h2 {color:#fff; font-family:'Roboto', sans-serif; font-size:14px; margin:0px; font-weight:normal; text-shadow: #000 0px 1px 1px;}

header .telefones {display:table; float:left;}
header .telefones a {padding:5px 10px; padding-left:40px; text-decoration:none; color:#fff; display:table; float:left; background:#0000004a; position:relative; margin-right:10px; font-size:14px; font-family:'Roboto', sans-serif; border-radius:50px; overflow:hidden; font-weight:bold; border:1px #ffffff85 solid;}
header .telefones a i {position:absolute; height:100%; left:0px; top:0px; color:#fff; font-size:18px; display:flex; align-items:center; padding:0 15px;}
header .telefones a:hover {background:#00000040;}
header .endereco {float:left; display:table; margin-left:10px;}
	header .endereco p {color:#fff; font-size:14px; padding:7px 0; margin:0;}
	header .endereco p i {margin-right:5px;}


/* Menu Mobile */
.bottaoMobile {background:#ffbd00; padding:15px; cursor:pointer; display:table; position:absolute; top:0px; bottom:0px; right:15px; margin:auto;}
.bottaoMobile i {display:block; font-size:24px; line-height:24px; color:#443200;}

.menu-mobile {position:fixed; left:-300px; top:0px; height:100%; width:300px; background:#fff; z-index:99; overflow:auto;}
.menu-mobile .logo {display:table; width:100%; margin:20px 0px;}
.menu-mobile .logo img {max-width:150px; display:block; margin:0 auto;}
.menu-mobile ul {display:table; width:100%;}
.menu-mobile ul li a {display:block; border-bottom:1px #dedede solid; font-size:14px; color:#000; padding:15px 20px; text-align:center;}
.menu-mobile ul li a:hover {background:#f5f5f5; text-decoration:none;}


/* Menu Superior */
.menu-superior.fixo {position:fixed; top:0px; z-index:9; left:0px;}
.menu-superior {display:none !important; background:#fff; border-bottom:1px #dedede solid; width:100%; position:relative;}
.menu-superior .container {padding:0px; margin:0px;}

.menu-superior ul {white-space: nowrap; overflow-x:auto; -webkit-overflow-scrolling: touch; -ms-overflow-style: -ms-autohiding-scrollbar; margin:0 auto;}
.menu-superior ul li {display: inline-block;}
.menu-superior ul li a {display:block; padding:20px 15px; color:#000; font-size:13px; border-bottom:3px transparent solid; text-decoration:none !important;}
.menu-superior ul li a:focus, .menu-superior ul li a:focus, .menu-superior ul li a.ativo {border-bottom:3px #c32c31 solid;}


/* Telefones Header */
section.telefones-header {background:#ffbd00;}
section.telefones-header .col-6 {padding:0px;}
section.telefones-header a {text-align:center; display:block; color:#443200; padding:20px 0px; font-weight:bold;}
section.telefones-header a:hover {text-decoration:none; background:#ffd047;}
section.telefones-header a.fixo {border-right:1px #ecb410 solid;}
section.telefones-header a i {margin-right:5px; background:#443200; border-radius:50%; color:#fff; padding:10px; width:36px; height:36px;}


/* ConteÃºdo customizÃ¡vel */
.custom_content {display:block; margin-top:20px;}
.custom_content .video {position: relative; width: 100%; height: 0; padding-bottom: 56.25%;}
.custom_content iframe {position: absolute; top: 0; left: 0; width: 100%; height: 100%;}
.custom_content .boxin {padding:10px; background:#fff; border:1px #ccc dotted; border-radius:10px;}

/* Aviso */
section.aviso {display:table; width:100%;}
section.aviso i {margin-right:10px;}
section.aviso .alert {margin-bottom:0px; position:relative; text-align:left;}
section.aviso .alert button {position:absolute; right:10px; top:5px;}


/* Lista Produtos */
section.lista-produtos .subCategoria {margin-top:30px;}

section.lista-produtos .avisoCategoria {margin-top:30px;}

section.lista-produtos .boxin {padding:20px; border:1px #dedede solid; width:100%; border-radius:0 10px 10px 10px; display:table; margin:auto; background:#fff; margin-top:80px; position:relative;}
section.lista-produtos input {-webkit-appearance: none; border-radius:4px; display:block; width:100%; border:0; padding:10px 5px; background:transparent; color:#666; text-align:center;}
section.lista-produtos .boxin h3.categoria {background:#fff; position:absolute; top:-52px; left:-1px; font-size:18px; color:#000; padding:15px 30px; border:1px #dedede solid; border-bottom:0; border-radius:10px 10px 0 0; text-transform:uppercase;}
section.lista-produtos .boxin h4 {font-size:18px; color:#000; border-bottom:1px #dedede solid; text-transform:uppercase; padding-bottom:15px; text-align:center;}

section.lista-produtos li.product {padding:15px; border-bottom:1px #f3f3f3 solid;}
section.lista-produtos li.product.ativo  {border: 1px #099516 dotted; border-radius:3px; background: #f0fff1 !important;}
section.lista-produtos li.product:nth-child(even) {background:#fbfbfb;}
section.lista-produtos hr {margin:0;}

section.lista-produtos .product .btn-decrement {border:1px #dedede solid; display:block; width:38px; background:#fff; color:#ea0008; border-radius:50%; min-width:auto !important; opacity:1; font-weight:bold;}
section.lista-produtos .product .btn-increment {border:1px #dedede solid; display:block; width:38px; background:#fff; color:#31ab10; border-radius:50%; min-width:auto !important; opacity:1; font-weight:bold;}

section.lista-produtos .descricao {font-size:13px; margin-top:10px; color:#666; word-break: break-word; line-height:22px;}
section.lista-produtos .descricao a {border: 1px #dedede solid; border-radius: 50px; padding: 0px 10px; text-transform: uppercase; color: #7a7a7a; font-weight: bold; display: inline; margin-left:5px;}
section.lista-produtos .boxQnt {text-align:center;}
section.lista-produtos .boxQnt span {font-size:12px; color:#666;}
section.lista-produtos .introValor {font-size:11px; margin-bottom:0px; display:block; text-align:center;}
section.lista-produtos .valor {color:green; font-weight:bold; font-size:13px; display:block; text-align:center;}
section.lista-produtos .btnOpcoes {display:block; width:100%; text-align:center; padding:10px 20px; background:#fff; border:1px #dedede solid; font-size:15px; font-weight:bold; text-transform:uppercase; color:#333; border-radius: 50px; cursor:pointer;}
section.lista-produtos .btnOpcoes:hover {background:#f5f5f5;}
section.lista-produtos .btnOpcoes[aria-expanded="true"] {border-radius: 5px 5px 0px 0px; border-bottom:0px !important;}
section.lista-produtos .btnOpcoes span {position:relative; display:table; padding-left:30px; margin:auto;}
section.lista-produtos .btnOpcoes i {position:absolute; left:0; top:50%; transform:translateY(-50%); color:#fff; border-radius:50%; padding:4px 0; font-size:12px; margin-right:5px; background: #22a200; width: 20px; height: 20px;}
section.lista-produtos .slcQtd {max-width:145px; margin:auto;}

section.lista-produtos img {width:100%; height:auto;}
section.lista-produtos .alert {font-size:13px; text-align:center; border:1px #b99035 dotted;}

section.lista-produtos .titulo strong {display:block; line-height:16px;}


/* Imagem Produtos */
section.lista-produtos .imagem-produto {padding-right:0;}
section.lista-produtos .imagem-produto a {display:block; margin:auto; max-width:48px; position:relative; height:48px; overflow:hidden; border-radius:5px; background-size:cover; background-position:center center; background-repeat:no-repeat; border:1px #dedede solid;}


/* Grupos de VariaÃ§Ãµes */
section.lista-produtos .boxesOpcoes {width:100%; margin:0 15px; background:#fff; margin-top: -1px; border: 1px #dedede solid;}
section.lista-produtos .grupo-variacao {}
section.lista-produtos .grupo-variacao h6 {margin-top:15px; margin-bottom:0; padding-left:0px; background: #f5f5f5; padding:15px; border-radius: 5px 5px 0 0; border:1px #dedede solid; border-bottom:0;}
section.lista-produtos .grupo-variacao h6 small {font-size:12px; color:#000; margin-left:10px;}
section.lista-produtos .grupo-variacao h6 .badge {float:right;}
section.lista-produtos .grupo-variacao ul {width:100%; display:table; padding: 15px; border: 1px #dedede solid; border-radius: 0 0 5px 5px;}
section.lista-produtos .grupo-variacao ul li {display:table; border-bottom:1px #dedede dotted; border-radius:4px; background:#fff; position:relative; overflow:hidden; width:100%; padding-bottom:10px; margin-bottom:10px;}
section.lista-produtos .grupo-variacao ul li.selecionado {background:#f5f5f5; border:1px #22a200 dotted !important; padding: 10px 5px 10px 10px !important;}
section.lista-produtos .grupo-variacao ul li:last-child {border-bottom:0px; margin-bottom:0px; padding-bottom:0px;}
section.lista-produtos .grupo-variacao ul li .qnt {padding-left:0px;}
section.lista-produtos .grupo-variacao ul li p {margin-bottom:0px; font-size:13px;}
section.lista-produtos .grupo-variacao ul li p.nome-variacao {color:#000; font-size:12px;}
section.lista-produtos .grupo-variacao ul li p.valor-variacao {color: #168000; font-weight: bold;}
section.lista-produtos .grupo-variacao .item-variacao .row {align-items:center;}
section.lista-produtos .grupo-variacao .item-variacao input[type="checkbox"] {-webkit-appearance: none; width: 20px; height: 20px; border: 5px #ccc solid; border-radius: 50%; background: white; display: table; margin:0px; float:right; padding: 2px; cursor: pointer; outline:0 !important;}
section.lista-produtos .grupo-variacao .item-variacao input[type="checkbox"]:checked {border:5px #22a200 solid;}

section.lista-produtos .boxesOpcoes .totalProduto {display: table; padding: 15px; background: #f5f5f5; width: 100%; margin-top: 15px; border-top:1px #dedede solid;}
section.lista-produtos .boxesOpcoes .totalProduto p {margin:0px; font-size:14px; font-weight:bold; text-align:right;}
section.lista-produtos .boxesOpcoes .totalProduto .row {align-items:center;}

/* meia porÃ§Ã£o */
section.lista-produtos .grupo-variacao ul li.meia-porcao {background:#f5f5f5; border:1px #ffa500 dotted; padding: 10px 5px 10px 10px;}
section.lista-produtos .grupo-variacao ul li.meia-porcao.ok {border:1px #22a200 dotted !important;}



/* BotÃµes */
.botoes {position:fixed; bottom:-1px; left:0px; width:100%; display:table; background:#fff; padding:5px 0px 6px; z-index:10; box-shadow: 0px 0px 5px #00000059;}
.botoes .row {align-items:center;}
.botoes .botao {width:25%; padding:0px 5px;}
.botoes .botao a, .botoes .botao button {color:#fff; border-radius:6px; display:table; width:100%;}
.botoes .botao a {padding:10px; background:#c32c31; border:1px #90282c solid; border-bottom:3px #90282c solid;}
.botoes .botao a:hover {background:#ce393e; text-decoration:none;}
.botoes .botao a i {display:block; text-align:center; font-size:24px; margin-bottom:5px;}
.botoes .botao a span {display:block; text-align:center; font-size:12px;}
.botoes .botao button {-webkit-appearance: none; background:#22a200; border:1px #1b8000 solid; border-bottom:3px #1b8000 solid; padding:10px; cursor:pointer;}
.botoes .botao button:hover {background:#31ab10;}
.botoes .botao button i {display:block; text-align:center; font-size:24px; margin-bottom:5px;}
.botoes .botao button span {display:block; text-align:center; font-size:12px;}

.botoes .botao.pedir {width:100%; margin: 0 auto;}
.botoes .botao.pedir button {padding:20px; }
	.botoes .botao.pedir button span {font-size:18px; font-weight:bold; text-transform:uppercase;}

.botoes .botao a {-webkit-appearance: none; background:#22a200; border:1px #1b8000 solid; border-bottom:3px #1b8000 solid; padding:20px; cursor:pointer; text-align:center; text-transform:uppercase; font-weight:bold}
.botoes .botao a:hover {background:#31ab10;}

/* Basket */
.botoes .botao.openBasket {display:block; width:100%; background:#f5f5f5; border:1px #dedede solid; border-bottom:3px #dedede solid; border-radius:4px; cursor:pointer; position:relative;}
.botoes .botao.openBasket:hover {background:#ececec;}
	.botoes .botao.openBasket .title {padding:20px; padding-left:65px; background:url(<?php echo ConfigPainel('base_url'); ?>wa/delivery/src//img/cart-icon.png) 20px center no-repeat; background-size:34px;}
	.botoes .botao.openBasket .title span {font-size:13px; line-height:12px; color:#6b6b6b;}
	.botoes .botao.openBasket .title span.valor {position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-weight: bold; color: #22a200; font-size:16px;}
	.botoes .botao.openBasket .title span strong {display:block; text-transform:uppercase; color:#000; font-size:14px;}
	.botoes .botao.openBasket .floating {position:absolute; top:0; right:0; display:block; transform: translate(25%, -25%);}
		.botoes .botao.openBasket .floating span {display: block; background: #c32c31; border-radius: 50%; width: 28px; height: 28px; text-align: center; color: #fff; font-weight: bold; font-size: 13px; line-height: 28px;}
#shopping-basket-unpaired-marker {right: 30px; display: none;}

.basket {background: #00000057; position: fixed; top: 0; left: 0; z-index: 999; width: 100vw; height: 100vh;}
	.basket .box {display: block; background: #fff; width: 500px; position: absolute; right: -100%; top: 0; height: 100%;}
		.basket .box button.closeBasket {display: block; position: absolute; left: -44px; top: 30px; padding: 12px 15px; border: 0; background: #fff; color: #c32c31; font-size: 24px; border-radius: 5px 0px 0 5px; text-align: center; cursor: pointer; line-height:20px;}
	.basket .basketContent {padding:40px 20px; margin: 0;}
		.basket .basketContent .basket-body {max-height: 81%; overflow-y: auto;}

	.basketContent {position:relative; width: 100%; height: 100%; margin-bottom: 15px; overflow: hidden;}
		.basketContent h3 {font-weight: bold; text-transform: uppercase; color: #c32c31; font-size: 18px; padding-bottom: 10px; margin-bottom:0; border-bottom:1px #dedede solid; margin-bottom:15px;}
		.basketContent .green {color: #22a200;}
		.basketContent .itemBasket {width: 100%; border-left: none; border-right: none; border:1px #dedede solid; border-radius:10px; margin-bottom:10px; font-size:14px; overflow:hidden;}

			.basketContent .itemBasket .name {padding:10px; padding-right:40px; padding-left:35px; background:#f5f5f5; font-weight:bold; font-size:16px; border-bottom:1px #dedede solid; position:relative; cursor:pointer;}
			.basketContent .itemBasket .name span {overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box;    -webkit-line-clamp: 1;}
			.basketContent .itemBasket .name .remover {position:absolute; right:5px; top:50%; transform:translateY(-50%); font-size:14px; color:#666; cursor:pointer; padding:10px;}
			.basketContent .itemBasket .name .seta {position:absolute; left:5px; top:50%; transform:translateY(-50%); font-size:14px; color:#666; cursor:pointer; padding:10px;}
			.basketContent .itemBasket .name.opened .seta {transform:translateY(-50%) rotate(90deg);}
			.basketContent .itemBasket .name.closed .seta {transform:translateY(-50%) rotate(0);}

			.basketContent .itemBasket .content {padding:10px; border-bottom:1px #dedede solid; transition: all 100ms linear}
			.hi{opacity:0; height:0px; padding:0px !important}
			.m0{margin-top:0px !important}
			.basketContent .itemBasket .itemBasketContent {border-top: 1px solid #dedede; padding: 5px 10px; font-size: 13px;}
			.basketContent .itemBasket .collapse {padding-bottom: 10px;}
			.basketContent .itemBasket .description {color:#606060; margin:0 0 10px; overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box;    -webkit-line-clamp: 2; font-size:13px; margin-bottom:0;}
			.basketContent .itemBasket .options {}
				.basketContent .itemBasket .options:last-of-type {border-bottom: 1px #efefef solid;}
				.basketContent .itemBasket .options p {margin: 0;}
				.basketContent .itemBasket .options .paired {border: 1px dashed #22a200;}
				.basketContent .itemBasket .options .unpaired {border: 1px dashed #c32c31;}
				.basketContent .itemBasket .options small {color: #c32c31; font-weight: bold;}

			.basketContent .itemBasket .complemento {display:table; width:100%;}
			.basketContent .itemBasket .complemento .left {display:table; float:left;}
			.basketContent .itemBasket .complemento .right {display:table; float:right;}

			.basketContent .itemBasket .actions {display:table; width:100%; padding:10px;}
				.basketContent .itemBasket .actions .left {display:table; float:left; padding:8px;}
				.basketContent .itemBasket .actions.checkout .left {float:right; padding:0px;}
				.basketContent .itemBasket .actions.checkout .items {float:left; padding:0px;}
					.basketContent .itemBasket .actions .left span {font-weight:bold; color:#22a200}
				.basketContent .itemBasket .actions .right {display:table; float:right; width:130px;}
					.basketContent .itemBasket .actions .right .btn-decrement, .basketContent .itemBasket .actions .right .btn-increment {border: 0; display: block; width: 32px; background: #099516; color: #fff; border-radius: 50%; min-width: auto !important; opacity: 1;}
					.basketContent .itemBasket .actions .right input {display: block; border: 0; padding: 10px 5px; background: transparent; color: #666;}

			.basketContent .complementos {margin-top:15px;}
			.basketContent .complementos h3 {font-size:13px; color:#666; padding-bottom:10px; margin-bottom:10px; border-bottom:1px #dedede solid;}

			.basketContent .summary {border-top: 1px #dedede solid; padding-bottom:15px; padding-top:15px; width:100%;}
				.basketContent .summary .row {margin: 0;}
				.basketContent .summary .row > div {font-size:14px; color:#656565; padding-left: 5px; padding-right: 5px;}
				.basketContent .summary .total {font-weight: bold; color: #000;}
				.basketContent .summary .red {color: #c32c31;}

			.basketContent .basket-footer {padding-top: 10px; border-top: 2px solid #dedede;}

			.basketContent .pedir {-webkit-appearance: none; background: #22a200; border: 1px #1b8000 solid; border-bottom: 3px #1b8000 solid; padding: 20px; cursor: pointer; display: table; width: 100%; border-radius: 5px; margin-top: 15px; color: #fff;}
				.basketContent .pedir:hover {background: #31ab10;}


/* Box jQuery */
.jconfirm-content table {width:100%; font-size:12px;}
.jconfirm-content table tr td:nth-child(1), .jconfirm-content table th td:nth-child(1) {text-align:center;}
.jconfirm-content table tr td:nth-child(3), .jconfirm-content table th td:nth-child(3) {text-align:center;}


/* Footer */
footer {background:#fff; border-top:1px #dedede solid; padding:10px 0px; padding-bottom:95px;}
footer small {display:block; text-align:center; color:#666; font-size:12px;}

footer .dados {padding:40px 15px; border-bottom:1px #dedede dotted; margin-bottom:20px;}
footer .horario .row {padding:5px 0px; border-bottom:1px #f5f5f5 dotted;}


/* ConfirmaÃ§Ã£o de Pedido */
#confirmacao-pedido {
	z-index: 10000;
	width: 100%;
	font-family: 'Roboto', sans-serif;
}

/* ConfirmaÃ§Ã£o de Pedido */
h3.title {
	font-family: 'Roboto', sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #000;
	text-transform: uppercase;
	text-align: center;
	padding: 10px 30px;
	border: 1px #dedede solid;
	display: table;
	margin: 0 auto;
	border-radius: 50px;
	background: #fff;
}

button:hover { outline: none; }
button:focus { outline: none; }

.headerConfirmacao .box-logo {margin: 0 auto; height: 95px; width:95px; border: 5px #fff solid; position: relative; box-shadow: 0px 0px 10px #0000001c; overflow:hidden; border-radius:50%;}
.headerConfirmacao .box-logo a {display: block; position:absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width:90%;}
.headerConfirmacao {display:table; width:100%; position:relative; padding:20px 0px;}
.headerConfirmacao:before {content:''; width:100%; height:300px; background:#f5f5f5; display:table; position:absolute; top:0px; left:0px; border-bottom:1px #dedede solid;}
a.voltar {z-index:1;position:absolute; height: 38px; bottom:0px; top:0px; right:15px; margin:auto; padding:10px 25px; background:#fff; border:1px #dedede solid; background:#fff; text-decoration:none; color:#868686; font-weight:bold; font-size:11px; text-transform:uppercase; border-radius:50px; cursor: pointer;}
a.voltar i {margin-right:5px;}
a.voltar:hover {color:#000;}

#confirmacao-pedido .container.p-0 > .row {margin: 0;}
#confirmacao-pedido .container.p-0 > .row > div {padding: 0;}
.boxConfirmacao h3 {font-family:'Roboto', sans-serif;}
.boxConfirmacao .center {display:table; width:100%; padding:20px; padding-bottom:40px; background:#fff; box-shadow: 0px 0px 40px #0000001f;}
.boxConfirmacao *::placeholder {color:#828282;}
.boxConfirmacao .lista-itens > h3.title {margin-top:-40px !important; margin-bottom:25px !important; position: relative; z-index: 10;}
.boxConfirmacao input, .boxConfirmacao select {width:100%; display:block; border:1px #ccc solid; border-radius:50px; padding:10px 20px; font-size:13px; color:#000; background:#fff; outline:0px !important;}

.obsConfirmacao {display:table; width:100%;}
.obsConfirmacao label {display:block; font-size:13px; color:#666;}

.valoresConfirmacao {margin:15px 0px; width:100%;}
.valoresConfirmacao .row > div {display: block; font-size: 13px; color: #666; margin: 5px 0; border-left: 1px solid #ececec; border-right: 1px solid #ececec;}
.valoresConfirmacao .row > div strong {display: block; font-size:14px; line-height:18px;}
.valoresConfirmacao .row > .total strong {color:#029a26;}
.valoresConfirmacao .row > div .red {color: #cc3322;}

.infoEntregaConfirmacao {display:table; width:100%; border-top:1px #dedede solid; margin-top:60px;}
.infoEntregaConfirmacao > h3.title {margin-top:-25px !important; margin-bottom:10px !important; position: relative; z-index: 10;}
.infoEntregaConfirmacao .dados-usuario {margin-bottom: 25px;}
.infoEntregaConfirmacao .seleciona {display:table; width:100%; border-bottom:1px #dedede solid; margin-bottom:20px;}
.infoEntregaConfirmacao .seleciona .box {display:table; margin:0 auto;}
.infoEntregaConfirmacao .seleciona .box a {float:left; display:table; padding:12px 15px; border-radius:8px 8px 0 0; background:#dedede; margin:0 1px; color:#666; font-size:13px; font-weight:bold; line-height:18px;  cursor:pointer;}
.infoEntregaConfirmacao .seleciona .box a:hover, .infoEntregaConfirmacao .seleciona .box a.ativo {color:#fff; background:#ce0000; text-decoration:none;}
.infoEntregaConfirmacao .seleciona .box a i {float:left; line-height:18px; font-size:18px; margin-right:5px;}
.infoEntregaConfirmacao input {margin-bottom:15px;}
.infoEntregaConfirmacao .alert {font-size:13px;}
.infoEntregaConfirmacao .alert i {margin-right:5px;}
.infoEntregaConfirmacao .formEntrega .cep {padding-right:5px;}
.infoEntregaConfirmacao .formEntrega .endereco {padding-right:5px; padding-left:5px;}
.infoEntregaConfirmacao .formEntrega .numero {padding-left:5px;}
.infoEntregaConfirmacao .formEntrega .complemento {padding-right:5px;}
.infoEntregaConfirmacao .formEntrega .bairro {padding-right:5px; padding-left:5px;}
.infoEntregaConfirmacao .formEntrega .ref {padding-left:5px;}
.infoEntregaConfirmacao .login h5 {font-family:'Roboto', sans-serif; font-weight:bold; text-transform:uppercase;}
.infoEntregaConfirmacao .login p {margin-bottom:20px; font-size:13px;}
.infoEntregaConfirmacao .login button {padding: 10px 30px; color: #fff; border: 0px; background: #c32c31; border-radius: 30px; font-size: 13px; text-transform: uppercase; font-weight: bold; cursor: pointer;float:right;}
.infoEntregaConfirmacao .retirada p {margin-bottom:0px;}

.pagamentoConfirmacao {display:table; width:100%; border-top:1px #dedede solid; margin-top:40px;}
.pagamentoConfirmacao h3.title {margin-top:-25px !important; margin-bottom:10px !important; position: relative; z-index: 10;}
.pagamentoConfirmacao .box {width:47%; float:left; display:table; background:#f5f5f5; border:1px #dedede solid; position:relative; border-radius:10px;}
.pagamentoConfirmacao .box.full {width:100%;}
.pagamentoConfirmacao input[type="radio"] {position:absolute; left:0px; top:5px; bottom:0px; margin-left:10px; float: left;width: 20px; height: 20px; cursor:pointer;}
.pagamentoConfirmacao label { padding:10px; padding-left:40px; width:100%; display:table; font-size:13px; margin-bottom:0px; font-weight:bold; color:#666; cursor:pointer;}
.pagamentoConfirmacao .box .troco {display:table; width:100%;}
.pagamentoConfirmacao .box .secundario {border-top:1px #dedede solid; padding-top:5px; margin-top:5px; padding:10px;}
.pagamentoConfirmacao .box .secundario p { font-size:13px; margin-bottom:5px; font-weight:bold; }
.pagamentoConfirmacao .box .secundario i {color:#000; margin-left:3px; margin-right:5px;}
.pagamentoConfirmacao .box .troco input {border-radius: 0px 4px 4px 0px; width:50%;}
.pagamentoConfirmacao .box .troco select {font-size:13px;}

.pagamentoConfirmacao .box-sem-troco {position:relative;}
.pagamentoConfirmacao .box-sem-troco input {position:relative; position:absolute; left:0px; top:10px; bottom:0px; width: 25px !important; height: 19px;}
.pagamentoConfirmacao .box-sem-troco label {padding-left:30px !important;}
.pagamentoConfirmacao .box:nth-child(2) {float:right;}

.continuaConfirmacao {display:table; width:100%; background:#fff; padding:20px 0px; position:fixed; bottom:0px; left:0px; box-shadow: 0px 0px 10px #0006;}
.continuaConfirmacao .row {align-items:center;}
.continuaConfirmacao button {float:right; padding:15px 40px; background:#029a26; border:0px; border-bottom:4px #003f0f solid; border-radius:50px; color:#fff; font-size:18px; font-weight:bold; cursor:pointer;}
.continuaConfirmacao button:hover {background:#0bab31;}
.continuaConfirmacao button i {margin-right:5px; color:#6bff8e; font-size:20px;}

.avisoEnviado i {color:#029a26; font-size:80px; margin-bottom:20px; margin-top:-40px; background:#fff; border-radius:50%;}
.avisoEnviado p {font-size:13px; font-weight:bold;}

.informacoesEntrega p {margin-bottom:0px; font-size:13px; position:relative; padding-left:35px;}
.informacoesEntrega p i {position:absolute; top:0px; left:0px; font-size:18px; color:#c32c31; width:25px; text-align:center;}
.informacoesEntrega p strong, .informacoesEntrega p span {display:block;}
.informacoesEntrega button {padding: 10px 30px; color: #fff; border: 0px; background: #c32c31; border-radius: 30px; font-size: 13px; text-transform: uppercase; font-weight: bold; cursor: pointer; margin:10px auto; margin-top:20px; display:table;}
.informacoesEntrega small {display:block; text-align:center;}
.informacoesEntrega .card-footer p {margin-bottom:20px;}
.informacoesEntrega input {margin:5px 0px;}

.informacoesEntrega .compartilhar {display:table; width:100%; border-top:1px #dedede solid; margin-top:20px; padding-top:20px;}
	.informacoesEntrega .compartilhar a {display:table; margin:auto; position:relative; color:#000; background:#fff; border:1px #dedede solid; padding:10px 30px; border-radius:50px; padding-left:55px; font-size:14px; font-weight:bold;}
	.informacoesEntrega .compartilhar a i {margin-right:10px; position:absolute; left:10px; top:50%; transform:translateY(-50%); width:30px; height:30px; background:#ea6100; border-radius:50%; font-size:14px; color:#fff;}
	.informacoesEntrega .compartilhar a i:before {position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);}
	.informacoesEntrega .compartilhar a:hover {background:#ea6100; color:#fff; text-decoration:none;}

/* Abrir Whats */
.abrirWhats {display:table; width:100%; margin-top:20px;}
.abrirWhats a, .abrirWhats button {padding: 15px 40px; background: #029a26;  border: 0px; border-bottom: 4px #003f0f solid; border-radius: 50px; color: #fff; font-size: 16px; font-weight: bold; cursor: pointer; display:table; margin:0 auto;}
.abrirWhats a:hover, .abrirWhats button:hover {background:#0bab31; color:#fff;}


/* Dados Footer */
section.informacoes {display:table; margin:40px 0px; margin-bottom:20px; width:100%;}
section.informacoes .box {background:#fff; display:table; width:100%; padding:25px; border-radius:4px; border:1px #dedede solid; font-size:14px;}
section.informacoes .box h3 {padding-bottom:15px; margin-bottom:15px; border-bottom:1px #dedede solid; font-size:18px; line-height:24px;}
section.informacoes .box h3 i {float:left; line-height:24px; margin-right:10px; color:#000; font-size:24px;}
section.informacoes .box h4 {font-size:14px; margin-bottom:10px;}

section.informacoes .box.pagamentos h4 {font-size: 16px; border-bottom: 1px #dedede solid; padding-bottom: 10px; margin-bottom: 10px; color:#000;}
section.informacoes .box.pagamentos ul {display:table; margin-bottom:20px;}
section.informacoes .box.pagamentos ul li {font-size:12px; background:#f5f5f5; color:#000; border-radius:40px; padding:5px 15px; display:table; float:left; margin-bottom:5px; margin-bottom:5px; margin-right:5px;}
section.informacoes .box.pagamentos .alert {font-size:12px; position:relative;}
	section.informacoes .box.pagamentos .alert button {position:absolute; right:10px; top:5px;}


/* Banner Tarja */
section.banner-tarja .box {padding: 20px 30px; box-shadow: 0px 0px 20px #ccc; margin-bottom: 100px; border-radius: 10px; display: table; background: #fff; width: 100%;}
section.banner-tarja .box .row {align-items:center;}
section.banner-tarja .box img {display:block; margin:0 auto;}
section.banner-tarja .box p {color: #666; margin-bottom: 0px; border-left: 1px #dedede solid; padding-left:15px;}
section.banner-tarja .box a {padding: 8px 30px; background: #a7a7a7; border-radius: 50px; color: #fff; font-weight: bold; text-decoration: none; font-size: 13px; text-transform: uppercase; display:block; text-align:center;}
section.banner-tarja .box a:hover {background:#28475d;}


/* PÃ¡ginas Erro */
.pagina-erro {background:#f5f5f5; position:absolute; width:100%; height:100%; display:table; overflow-x:auto; padding:30px 0px;}
.pagina-erro .container {display:table; position:absolute; top:0px; bottom:0px; left:0px; right:0px; margin:auto;}
.pagina-erro img {margin:0 auto; display:table; margin-bottom:40px;}
.pagina-erro h1 {font-size:50px;}
.pagina-erro p {color:#000; margin:20px 0px;}
.pagina-erro a {border:0px; background:#c32c31; text-transform:uppercase; font-weight:bold; color:#fff; padding:15px 40px; border-radius:50px; display:table; margin:0 auto; margin-bottom:50px;}
.pagina-erro a i {margin-right:10px;}
.pagina-erro a:hover {background-color:#e21b22; box-shadow:0px 0px 10px #ccc;}

/* Modal Complexo */
.modalComplexo {display:block; width:100%; height:100%; overflow-y:auto; position:fixed; top:0; left:0; z-index:9999; background:#0006;}
	.modalComplexo .box {width:550px; height:80%; top:10%; display:block; background:#fff; position:absolute; left:50%; transform:translateX(-50%); border-radius:10px; overflow:hidden; padding-bottom:97px; padding-top:57px;}
		.modalComplexo .box .header {border-bottom:1px #dedede solid; display:table; width:100%; display:table; width:100%; position:absolute; top:0; left:0; background:#fff;}
			.modalComplexo .box .header .fechar {padding: 10px 20px; display: block; float: right; font-size: 24px; cursor:pointer;}

		.modalComplexo .box .body {display:block; overflow-y:auto; height:100%;}
		.modalComplexo .box .nomeProduto {padding:30px 20px; background:#f5f5f5; position:relative; margin-bottom:30px;}
		.modalComplexo .box .nomeProduto:before {content:''; display:block; position:absolute; bottom:-15px; left:30px; width: 0; height: 0; border-left: 15px solid transparent; border-right: 15px solid transparent; border-top: 15px solid #f5f5f5;}
		.modalComplexo .box .nomeProduto h3.price {float:right; color: #22a200;}
		.modalComplexo .box .nomeProduto h3 {margin:0; font-size:20px; text-transform:uppercase; color:#000;}
		.modalComplexo .box .nomeProduto p {font-size:13px; margin-bottom:0; color:#7a7a7a;}

		.modalComplexo .box .group {width:100%; padding:0 20px; margin-bottom:30px;}
			.modalComplexo .box .group .title {width:100%; padding-bottom:10px; margin-bottom:10px; border-bottom:1px #efefef solid;}
				.modalComplexo .box .group .title h4 {font-size:16px; line-height: 27px; color:#c32c31; text-transform:uppercase; margin:0;}
				.modalComplexo .box .group .title .required {float: right; font-size: 10px; padding: 5px 15px; border: 1px #dedede solid; border-radius: 40px; text-transform: uppercase; font-weight: bold; color: #c32c31;}
			.modalComplexo .box .group .selected_qtt {text-align: right; font-size:10px;}
				.modalComplexo .box .group .selected_qtt .green {color: #22a200; font-weight: bold;}
			.modalComplexo .box .group p {font-size: 13px; color: #717171; margin: 0;}

			.modalComplexo .box .group .option {width:100%; padding:15px 0; border-bottom:1px #efefef solid;}
			.modalComplexo .box .group .option:last-of-type {border-bottom: none;}
				.modalComplexo .box .group .option h5 {font-size:14px; font-weight:bold; text-transform:uppercase; margin:0; color:#000;}
				.modalComplexo .box .group .option .checkbox {display:inline-block; width:27px; height:27px; overflow: hidden; background:#efefef; border-radius:5px;}
				.modalComplexo .box .group .option input[type="radio"],
				.modalComplexo .box .group .option input[type="checkbox"] {display:none;}
				.modalComplexo .box .group .option label {width:27px; height:27px; cursor:pointer; margin:0; display:block; border: 2px solid #dedede; border-radius: 5px; font-size: 16px;}
				.modalComplexo .box .group .option input:checked + label:before {content:'\f00c'; font-family: "Font Awesome 5 Free"; font-weight: 900; display: inline-block; width: 100%; text-align: center; height: 100%; line-height: 27px; color: #22a200;}

		.modalComplexo .box .footer {border-bottom:1px #dedede solid; display:table; width:100%; position:absolute; z-index:10; bottom:0; left:0; padding:20px; background:#f5f5f5; border-top:1px #dedede solid;}
			.modalComplexo .box .footer .right {float:right; display:table; width:100%;}
				.modalComplexo .box .footer .right .row {align-items:center;}
				.modalComplexo .box .footer .confirmar button {border: 1px #1b8000 solid;  border-bottom: 3px #1b8000 solid; background: #22a200; -webkit-appearance:none; padding:15px 30px; border-radius:5px; font-weight:bold; text-transform:uppercase; font-size:14px; color:#fff; width:100%; cursor:pointer;}
			.modalComplexo .box .footer .numero {max-width:150px; display:table;}
			
			
/* Cupom desconto */
#cupomDesconto .row {align-items:center;}
#cupomDesconto label {padding:0px 0; font-weight:normal;}
#cupomDesconto button {width:100%; text-align:center; border-radius:40px;}
#cupomDesconto button.btn-danger {width:initial; padding:5px 20px;}
.avisoCupom {line-height:14px; color:red; display:block;}
#coupon-code { max-width: 300px; text-transform: uppercase; }

/* Basket */
#shopping-basket-unpaired-marker {right: 20px;}
		#shopping-basket-unpaired-marker span {font-size: 8px;}

		.basket .box {height:90%; width: 50%; padding: 10px; top: 5%; right: 25%;}
		.basket .box button.closeBasket {left:0; top:0; width:100%; z-index:99; background:#c32c31; border-radius:0px; color:#fff; font-size: 15px; text-transform: uppercase; font-weight: bold;}
		.basket .box button.closeBasket i {transform: rotate(90deg);}
		.basket .box button.closeBasket:after {content:'Fechar'; margin-left:10px;}
		.basketContent {padding: 10px 0 0;}
		.basket .basketContent {padding:50px 20px 80px;}
		.basket .basketContent .basket-body {max-height: 70%;}
		.basketContent .itemBasket .title p {font-size:13px; line-height:15px;}
		.basketContent .itemBasket .description {font-size:12px;}
		.basketContent .itemBasket .row > div {padding-left: 10px; padding-right: 10px;}

		.basketContent .summary .row > div {font-size:13px;}


	section.lista-produtos .boxin {margin-top:70px;}

	section.lista-produtos strong {font-size:14px;}

	#shareModal a.btn {margin-bottom:10px; width:100%;}
/* Responsivo */
@media all and (max-width:1200px) {
	section.barraDados .boxin.social {width:100%; border-top:1px #dedede solid; border-right:0; padding:10px 0;}

	header .logo {width:130px; height:130px;}
}

@media all and (max-width:998px) {
	.basket .box {height:100%; width: 100%; padding: 10px; top: 0; right: 0;}
	header h1 {font-size:24px;}

	section.barraDados .boxin.entrega {border-right:0;}

	section.lista-produtos .valor {text-align:left; font-size:16px;}

	section.barraDados .boxin.horario.semDelivery, section.barraDados .boxin.pagamento.semDelivery {width:50%;}
	section.barraDados .boxin.pagamento.semDelivery {border-right:0;}
	
	#cupomDesconto label {text-align:center; margin-bottom:10px;}
}
@media all and (max-width:768px) {	
	

	.box-horarios li span {font-size: 0.8rem;}

	section.barraDados .boxin.pagamento:before {display:none;}

	.botoes .botao button i, .botoes .botao a i {font-size:20px;}
	.botoes .botao button span, .botoes .botao a span {font-size:10px;}

	header {padding:10px 0;}
	header .dados {margin-top:20px; text-align:center;}
	header .logo {width:130px; height:130px;}
	header h2 {font-size:12px;}
	header h1 {font-size:18px;}
	header .telefones, header .endereco {width:100%; margin:0;}
	header .telefones a {width:48%; margin:0; font-size:12px; margin:1%; padding-left:30px;}
	header .telefones.centralizado a {float:none !important; margin:5px auto !important;}
	header .endereco p {font-size:12px;}

	section.barraDados .boxin.pagamento .listaFormas {right:0; left:auto;}

	section.barraDados .boxin.horario {width:50%; border:0; padding-right:0;}
	section.barraDados .horario-atendimento {float:none; margin:auto;}
	section.barraDados .horario-atendimento p.btn {padding-left:0; padding-right:0; padding-top:35px; text-align:center;}
		section.barraDados .horario-atendimento p.btn .fa-clock {top:4px; bottom:auto; left:50%; transform:translateX(-50%);}
		section.barraDados .horario-atendimento p.btn .fa-angle-down {bottom:-5px; top:auto; left:50%; transform:translateX(-50%);}
		section.barraDados .horario-atendimento p.btn span {display:block;line-height:16px;}
		section.barraDados .horario-atendimento .box-horarios, section.barraDados .boxin.pagamento .listaFormas {width:330px; border-radius:0;}
		section.barraDados .boxin.pagamento .listaFormas {right:0;}

	section.barraDados .boxin.pagamento {width:50%; border:0; padding-left:0; padding-right:0; padding-top:10px;}
	section.barraDados .formasPagamento {padding-top:35px; padding-left:0; background-position:center 7px; text-align:center; padding-right:0;}
	section.barraDados .boxin.pagamento .fa-angle-down {right: auto; left: 50%; bottom: 0px; top: auto; transform:translateX(-50%);}

	section.barraDados .boxin.entrega {width:100%; border-right:0; border-top:1px #dedede solid; margin-top:10px; padding:15px 0;}
		section.barraDados .tempoEntrega {margin:auto; display:table;}

	section.lista-produtos .titulo strong {font-size:13px;}
	section.lista-produtos .titulo span {font-size:11px;}

	section.lista-produtos .comprarLine {margin-top:10px;}
	section.lista-produtos .btnOpcoes {padding:5px 15px;}

	section.lista-produtos .boxin {padding:0;}
	section.lista-produtos .alert {margin:10px; padding:10px;}


	section.lista-produtos .product .btn-increment, section.lista-produtos .product .btn-decrement {width:35px; height:35px; padding:0;}
	section.lista-produtos .product .form-control {padding:0; height:35px;}

	section.telefones-header a span {font-size:13px;}

	section.aviso {font-size:12px; text-align:center; margin:20px 0px;}
	section.aviso i {margin:5px;}

	section.filtros-header .campoFiltro {margin-bottom:10px;}

	section.filtro-fixo {padding:10px 0px;}
	section.filtro-fixo .busca {display:none !important;}
	section.filtro-fixo .campoFiltro {margin-bottom:0px;}

	/* ConfirmaÃ§Ã£o de Pedido */
	body.page-template-template-confirmacao h3.title {font-size:12px;}

	.headerConfirmacao {padding-bottom:40px;}

	.valoresConfirmacao .row > div {padding:0 10px;}

	.pagamentoConfirmacao .box {margin-bottom:15px; width:100%;}

	.continuaConfirmacao {padding:3px 0px;}
	.continuaConfirmacao .logo-cardapex {display:none;}
	.continuaConfirmacao button {font-size:12px; width:100%; float:none; padding:8px 10px;}
	.continuaConfirmacao button i {font-size:13px;}

	.infoEntregaConfirmacao .seleciona .box a {font-size:13px; padding:10px 20px;}
	.infoEntregaConfirmacao .seleciona .box a i {font-size:10px;}

	.formEntrega {padding:0 10px;}
	.formEntrega .campo, .dados-usuario .campo {padding:5px !important;}
	.formEntrega .campo input {margin-bottom:0px;}
	.formEntrega .alert {margin-top:15px;}


	section.informacoes .box.pagamentos {margin-top:30px;}

	section.banner-tarja {}
	section.banner-tarja .box p {font-size:7px;}
	section.banner-tarja .box a {font-size:7px; padding:5px;}

	.valoresConfirmacao .row > div {font-size:11px;}

	.boxSelectDemo .center {width:90%;}

	section.banner-tarja .box {padding:15px 10px;}

	.infoEntregaConfirmacao .dados-usuario {padding:0 10px;}
	.boxConfirmacao .center {padding:20px 10px;}

	.modalComplexo .box {height: 100%; top: 0; width: 100%;  border-radius: 0;}

	.botoes .botao.pedir button {padding:10px;}
	.botoes .botao.openBasket .title {padding-left:10px; background-size:25px; background-position:10px center;}
	.botoes .botao.openBasket .title span.valor {font-size:14px;}
	.botoes .botao.openBasket .title span:not(.valor) {display:none;}
	.botoes .botao.openBasket .floating span {width: 16px; height: 16px; font-size: 10px; line-height: 16px;}
}


@media all and (min-width:361px) and (max-width:768px) {
	section.barraDados .boxin {width:33.3% !important;}
	section.barraDados .boxin.horario.semDelivery, section.barraDados .boxin.pagamento.semDelivery {width:50% !important;}
	section.barraDados .horario-atendimento p.btn span {font-size:9px;}
	section.barraDados .boxin.entrega {border:0; padding:0; margin:0;}
		section.barraDados .boxin.pagamento .listaFormas {left:97%;top:94%; right:auto; transform:translateX(-50%);}
		section.barraDados .boxin.pagamento.semDelivery .listaFormas {right:0; left:auto; transform:none;}
		section.barraDados .tempoEntrega {padding-top:50px; background-position:center 10px; padding-left:0; text-align:center;}
			section.barraDados .tempoEntrega strong {line-height:13px;}

	section.barraDados .boxin.social {width:100% !important;}

	section.filtros-header .campoFiltro select, section.filtros-header .busca input {padding-top:10px; padding-bottom:10px;}
	section.filtros-header .campoFiltro i.fa-list {font-size:13px;}
	section.filtros-header .busca button {width:33px; height:33px;}

	.custom_content .boxin {padding:0;}
	section.lista-produtos .boxin {margin-top:60px;}

	section.lista-produtos .boxin h3.categoria {font-size:14px; top:-47px;}

}
@media all and (max-width:350px) {
	.modalComplexo .input-group-prepend>.btn, .modalComplexo .input-group-append>.btn {padding-left: 5px; padding-right: 5px;}

	.basket .basketContent, .botoes .botao.openBasket .title span, .botoes .botao.openBasket .title span strong,
	.basketContent .itemBasket .title .title-container, .basketContent .itemBasket .itemBasketContent,
	.basketContent .summary p {font-size: 10px !important;}

	.basketContent .itemBasket .title .title-container .name {font-size:12px;}

	.valoresConfirmacao .row > div {font-size:9px;}
	.valoresConfirmacao .row > div strong {font-size:12px; line-height:13px;}

	.infoEntregaConfirmacao .seleciona .box a {font-size:9px; padding:5px 5px;}
	.infoEntregaConfirmacao .seleciona .box a i {display:none;}

	section.lista-produtos .btnOpcoes {font-size:9px;}

	section.barraDados .horario-atendimento .box-horarios, section.barraDados .boxin.pagamento .listaFormas {width:280px;}
}
</style>