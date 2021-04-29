<?php
    header('Access-Control-Allow-Origin: *');
	require_once('../../includes/funcoes.php');
	require_once('../../database/config.database.php');
	require_once('../../database/config.php');
	#$_GET['id'] = 4;
	if(isset($_GET['id'])):
	    $categoria = $_GET['id'];
	    $fetch = DBRead('delivery_item','*' ,"WHERE categoria = '{$categoria}'");
	elseif (isset($_GET['categoria'])):
	    $cat = $_GET['categoria'];
	    $fetch = DBRead('delivery_item','*' ,"WHERE categoria = '{$cat}'");
	    $categoria = 'null';
	else:
	    $categoria = 'null';
	    $fetch = DBRead('delivery_item','*');

	endif;
	    $categorias = json_encode(DBRead('delivery_categoria','*'));
	    $conf = DBRead('delivery_config','*')[0];
	    $config = json_encode($conf);
	    $db = json_encode($fetch);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.10.2/underscore-min.js'></script>
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url') ?>epack/css/elements/animate.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" ></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

<style>
html{
    overflow-x: hidden;
    font-family: Montserrat, Arial, Helvetica, 'Liberation Sans', FreeSans, sans-serif;
}

.pagination{
    padding-left:15px!important;

}
.pagination>.active>a{
    cursor:pointer !important;
}
.pagination a{
    color:<?php echo $conf['pag_texto'] ?> !important;
    background:<?php echo $conf['pag_fundo'] ?> !important;
    border-color:#fff !important;
}
.pagination li{
}
#dashboard{
    display: flex;
    position:relative;
 }
* {
  box-sizing: border-box;
}
.search{
    border-radius:25px;
    height: 35px;
    border:0;
    width:98%;
    margin: 4px 0 0 5px;
}

.column:hover{
    transition: 0.3s;
    background:<?php echo $conf['lis_hover_fundo'] ?>;
}

.dois b{
    font-size:25px;
    color:<?php echo $conf['lis_titulo'] ?>;
}

#box{
    position: fixed;
    background-color: rgb(0,0,0,0.5);
    z-index: 10000000;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}
#popup{
    position: fixed;
    background-color: <?php echo $conf['pop_fundo'] ?>;
    z-index: 10000001;
    width: 70%;
    margin: 16% 22%;
    box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
    overflow: hidden;
    top: -50px;
    left: -8%;
    height:350px
}

#fechar{
    font-size: 40px;
    position: absolute;
    right: 5px;
    cursor: pointer;
    top: -2%;
    color: <?php  echo $conf['pop_fechar'] ?>;
}
#um{
    position: absolute;
    overflow: hidden;
    width: 350px;
}
#um img{
height:350px;
}
#dois {
    position: initial;
    margin: 4% 0% 4% 350px;
    overflow: hidden;
    white-space: break-spaces;
    height: 270px;
    padding: 25px;
    max-width: 60%;
}

#dois b{
    font-size: 35px;
   color: <?php  echo $conf['pop_titulo'] ?>;
   line-height:30px;
   position:relative;
   bottom:2px;

}
#dois p{
    height:150px;
    overflow-y:scroll;
    color: <?php  echo $conf['pop_descricao'] ?>;
   position:relative;
   top:9%;
   text-align: justify;
}
::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-thumb {
  background-color: rgb(0,0,0,0.2);
  border-radius: 10px;
}

.promocao{
    background:<?php  echo $conf['lis_fundo_pro'] ?> !important;
}
.quatro{
    display:none;
}

<?php if($conf['estilo'] == 1){ ?>
.dois { 
    width:60%;
    padding:10px;
    height:70px;
    white-space:nowrap;
    text-overflow:ellipsis;
    position:relative;
    top:15%;
    overflow:hidden;
}

.column {

    display:flex;
    border:<?php if(!empty($conf['borda'])){echo 'solid 1px '.$conf['borda'];} ?>;
    margin: 1%;
    cursor:pointer;
    background:<?php echo $conf['lis_fundo'] ?>;
}
.um img{
    height:120px;
    position:relative;
}
.um{
    width:120px;
}
.tres{
    padding-bottom:10px;
    padding-top: 2%;
    position:relative;
    top:16%;
    right:1.5%;
}
.talvez{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
    color:<?php echo $conf['lis_preco'] ?>;

}
.sim{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
    color:<?php echo $conf['lis_preco_pro'] ?>;
}
.nao{
    text-decoration: line-through;
    margin: 0;
    text-align: center;
    color:<?php echo $conf['lis_preco'] ?>;
    left:20%;
}
.dois p{
    text-overflow: ellipsis;
    overflow: hidden; 
    margin:0;
    color:<?php echo $conf['lis_descricao'] ?>;
}
<?php } else { 
    if($conf['colunas']=='4'){
    ?>



<?php }else{ ?>



<?php }?>
.column {
    border:<?php if(!empty($conf['borda'])){echo 'solid 1px '.$conf['borda'];} ?>;
    margin: 16px 1%;
    cursor:pointer;
    background:<?php echo $conf['lis_fundo'] ?>;
    display: block;
}
.um{
    height:180px;
}
.um img{
    width:100%;
}
.tres{
    padding-bottom:10px;
    padding-top: 2%;
    position:relative;
    top:16%;
    right:1.5%;
    display:flex;
}

.talvez{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
    color:<?php echo $conf['lis_preco'] ?>;
    left:30px;
    padding-bottom: 15px;
}
.sim{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
    color:<?php echo $conf['lis_preco_pro'] ?>;
    left:27%;
    padding-bottom: 15px;
}
.nao{
    text-decoration: line-through;
    margin: 0;
    text-align: center;
    color:<?php echo $conf['lis_preco'] ?>;
    left:9%;
    bottom:32%;
    position:absolute;
    padding-bottom:10px;
}
.dois p{
    text-overflow: ellipsis;
    overflow: hidden; 
    margin:0;
    color:<?php echo $conf['lis_descricao'] ?>;
}
.dois { 
    width:auto;
    padding:25px;
    padding-bottom:5px;

    white-space:nowrap;
    text-overflow:ellipsis;
    position:relative;
    top:15%;
    overflow:hidden;
}
<?php } ?>

@media only screen and (max-width: 1000px) {
.col-sm-4, .col-sm-3 {
    width: 100% !important;
}
    <?php if($conf['mob_img'] == 'N'){?>
    .um {
        display: none !important;
    }
    .dois p{
        overflow: scroll;
        margin: 0;
        height: 70px;
        width: 100%;
        position: relative;
        top:5%;
        font-size: 75%;
        color:<?php echo $conf['mob_descricao']?>;
    }
<?php }else{?>

   .dois p{
        overflow: scroll;
        margin: 0;
        height: 100px;
        width: 100%;
        position: relative;
        top:5%;
        font-size: 75%;
        color:<?php echo $conf['mob_descricao']?>;
    } 
<?php }?>
    .talvez{
        font-weight: bolder;
        white-space: nowrap;
        text-align: center;
        margin: 0;
        position: relative;
        top: 0%;
        color:<?php echo $conf['mob_preco'] ?>;
        left:16px;
        top:0;
        font-size:120%;
    }
    .sim {
    color:<?php echo $conf['mob_preco_pro'] ?> !important;
    font-weight: bolder;
    white-space: nowrap;
    margin: 0;
    position: relative;
    color: #f51c1c;
    left: 2%;
    top:1px;
    font-size:120%;
    box-sizing: border-box;
}
.nao {
    text-decoration: line-through;
    margin: 0;
    color: <?php echo $conf['mob_preco_pro_1'] ?>;
    top: 0%;
    left: 2%;
    position: relative !important;
    font-size: 75%;
}
  #dashboard {
    display:block;
    position:relative;
    right:5px;
  }
  .search{
    margin:5px;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
     border-radius: 20px;
     border:0;
  }
  .column {
    float: left;

    display:flex;
    margin: 1%;
    cursor:pointer;
    background:<?php echo $conf['mob_fundo']?>;
    border:0px;
    overflow:hidden;
    }
    .um img {
    width: auto;
    height: 123px;
    position: relative;
}
.column:hover {
    background:<?php echo $conf['mob_fundo']?>;
}
hr{
    position: relative;
    width: 100%;
    display: flex !important;
    margin-bottom: 10px !important;
    top:4px;
    border:0;
    height:1px;
    background:<?php echo $conf['mob_divisor']?>;
}

.dois {
    height:100px;
    width: 100%;
    margin: 10px;
    top: 0;
    position: relative;
    padding: 0;
    white-space: normal;
}

.dois b{
font-size:120%;
color:<?php echo $conf['mob_titulo']?>;
}
.tres{
 display:none;   
}
.quatro{
    display:inline;
}



::-webkit-scrollbar {
  width: 0;

}
#mob{
    display:none;
}

select {
    background:<?php echo $conf['mob_fundo_categoria']?> !important;
    color:<?php echo $conf['mob_texto_categoria']?> !important;
    font:FontAwesome;
}
input{
    background:<?php echo $conf['mob_fundo_pesquisa']?> !important;
    color:<?php echo $conf['mob_texto_pesquisa']?> !important;
}
input::placeholder {
    color: <?php echo $conf['mob_texto_pesquisa']?> !important;
}
}
.um {
    height: auto;
}

    .lista-select{
        width: 35px;
        background-color: aqua;
        padding: 8px 8px 3px 8px;
        border-radius: 100%;
    }
    .input_sty1{
        display: grid  !important;
        border: 2px rgba(0,0,0, 0.3) solid !important;
        grid-template-columns: 40px auto !important;
        grid-gap: 1px;
        border-radius: 25px;
        background:white;
    }
    .input_sty2{
        display: grid  !important;
        border: 2px rgba(0,0,0, 0.3) solid !important;
        grid-template-columns: auto 43px !important;
        grid-gap: 1px;
        border-radius: 25px;
        background:white;
    }
    select:focus, input:focus{
    outline: none;
    }
    .input-group-prepend .btn{
    pointer-events: none;
    margin: 2px;
    background: #ffad1d  !important;
    color: white;
    border-radius: 25px;
    height: 40px;
    width: 40px;
    padding: 9px 0px 10px 0px;
    }
    .dashboard{
        padding-top:10px;
        background:rgba(0,0,0, 0.1);
        
    }
}

</style>
</header>
<body>
    <div id="controller" class="container-fluid">
        <div class="row dashboard" >
            <div id="dashboard" class="col-sm-5">
                <div class="input-group mb-3 input_sty1">
                    <div class="input-group-prepend">
                        <a class=" fa btn"  type="button">
                            <i style="font-size:20px" class="fas fa-list"></i>
                        </a>
                    </div>
                    <select  @change="categor($event)"  v-if="!categoria" class="search custom-select" >
                        <option value="" selected disabled> &nbsp;Navegar pela Categorias </option>
                        <option value="all"> Todas Categorias</option>
                        <option  v-for="cat, i of categorias" :value="cat.id">{{cat.nome}}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="input-group mb-3 input_sty2">
                    <input class="search" @input='here=>searchQuery=here.target.value' placeholder=" Faça uma busca  " icon="&#xF002;" style="font-family:Arial, FontAwesome" @keyup="resultQuery()" />
                    <div class="input-group-prepend">
                        <a class=" fa btn"  type="button">
                            <i style="font-size:20px" class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>        
        
        
            <div class="col-sm-<?php if($conf['estilo'] == 1){ echo '6';}else{ echo $conf['colunas'];} ?>" v-for="(item, index) in tokens">
                <div :class="item.promocao == 'S'?'promocao column post-grid-content':'column post-grid-content'"  @click="select(index)">
                    <div class="um">
                        <img :src="origin+'wa/delivery/uploads/'+item.img">
                    </div>
                    <div class="dois">
                        <b>{{item.nome}}</b>
                        
                            <span :class="item.promocao == 'S'?'nao quatro':'talvez quatro'">R$ {{item.preco.replace('.',',')}}</span>
                            <span class="sim quatro" v-if="item.promocao == 'S'">R$ {{item.valor.replace('.',',')}}</span>
                        
                        <p>{{item.descricao}}</p>
                    </div>
                    <div class="tres">
                        <p class="sim" v-if="item.promocao == 'S'">R$ {{item.valor.replace('.',',')}}</p>
                        <p :class="item.promocao == 'S'?'nao':'talvez'">R$ {{item.preco.replace('.',',')}}</p>
                    </div>
                </div>
                <hr class="quatro">
            </div>


        <div id="mob" v-if="idx != null">
            <div id="box" @click="close()">
            </div>
            <div id="popup" :class='config.entrada'>
                <span id="fechar"  @click="close()"> 	&times;
                </span>
                <div id="um">
                    <img :src="origin+'wa/delivery/uploads/'+tokens[idx].img">
                </div>
                <div id="dois">
                    <b>{{tokens[idx].nome}}</b>
                    <p>{{tokens[idx].descricao}}</p>
                </div>
            </div>
        </div>
        <ul  class="pagination col-sm-12" v-if="config.paginacao == 'S'">
            <li id="mob" :class="{'disabled' : pager.currentPage === 1}">
                <a @click="setPage(1)">&Ll;</a>
            </li>
            <li id="mob" :class="{'disabled' : pager.currentPage === 1}">
                <a @click="setPage(pager.currentPage - 1)">	&Lt;</a>
            </li>
            <li v-for="page in pager.pages" :class="{'active' : pager.currentPage === page}">
                <a @click="setPage(page)" v-html="page"></a>
            </li>
            <li id="mob" :class="{'disabled' : pager.currentPage === pager.totalPages}">
                <a @click="setPage(pager.currentPage + 1)">	&Gt;</a>
            </li>
            <li id="mob" :class="{'disabled' : pager.currentPage === pager.totalPages}">
                <a @click="setPage(pager.totalPages)">&ggg;</a>
            </li>
        </ul>
    </div>


<script>

var myMixin = {
  methods: {
    GetPager: function (totalItems, currentPage, pageSize) {
      currentPage = currentPage || 1;

      pageSize = pageSize || <?php if($conf['item'] == null || $conf['paginacao'] == 'N'){echo 100000000; }else{echo $conf['item']; }?>;

      var totalPages = Math.ceil(totalItems / pageSize);

      var startPage, endPage;
      if (totalPages <= 10) {
        startPage = 1;
        endPage = totalPages;
      } else {
        if (currentPage <= 6) {
          startPage = 1;
          endPage = 10;
        } else if (currentPage + 4 >= totalPages) {
          startPage = totalPages - 9;
          endPage = totalPages;
        } else {
          startPage = currentPage - <?php if($conf['item'] == null || $conf['paginacao'] == 'N'){echo 100000000; }else{echo $conf['item']; }?>;
          endPage = currentPage + 4;
        }
      }

      var startIndex = (currentPage - 1) * pageSize;
      var endIndex = Math.min(startIndex + pageSize - 1, totalItems - 1);

      var pages = _.range(startPage, endPage + 1);

      return {
        totalItems: totalItems, //total elements in the array.
        currentPage: currentPage, //get the current page
        pageSize: pageSize, //elements in the current page
        totalPages: totalPages, //total pages generated
        startPage: startPage,
        endPage: endPage,
        startIndex: startIndex,
        endIndex: endIndex,
        pages: pages,
      };
    },
  },
};

const vue = new Vue({
el: "#controller",
mixins: [myMixin],

data: {
    origin:'<?php echo ConfigPainel('base_url') ?>',
    categoria: <?php echo $categoria ?>,
    categorias: <?php echo $categorias ?>,
    config:<?php echo $config ?>,
    idx:null,
    tokenDumms: [],
    pager: {},
    tokens: {},
    searchQuery: null,
    searchFilters: null,
},
methods: {
    select: function(a){
        this.idx=a;
    
    },
    close: function(){
        this.idx=null;
    },
    categor: function(i){
        if(i.target.value != "all"){
            $('#delivery').load("<?php echo ConfigPainel('base_url') ?>wa/delivery/?categoria="+i.target.value)
        }else{
            $('#delivery').load("<?php echo ConfigPainel('base_url') ?>wa/delivery/")
        }
    },
    setPage: function (page, itemsToFilter) {
        if (page < 1 || page > this.pager.totalPages) {
            return;
        }
        
        if (itemsToFilter != null) {
            this.pager = this.GetPager(itemsToFilter.length, page, <?php if($conf['item'] == null || $conf['paginacao'] == 'N'){echo 100000000; }else{echo $conf['item']; }?>);
        
            this.tokens = itemsToFilter.slice(
              this.pager.startIndex,
              this.pager.endIndex + 1
            );
        
        
        } else if (itemsToFilter == null || itemsToFilter.length <= 0) {
            this.pager = this.GetPager(this.tokenDumms.length, page, <?php if($conf['item'] == null || $conf['paginacao'] == 'N'){echo 100000000; }else{echo $conf['item']; }?>);
        
            this.tokens = this.tokenDumms.slice(
              this.pager.startIndex,
              this.pager.endIndex + 1
            );
        }
        
    },

    initController: function () {
      this.setPage(1, this.tokenDumms);
    },

    resultQuery: function () {
        if (this.searchQuery) {
            this.searchFilters = this.tokenDumms.filter((item) => {
                return this.searchQuery
                .replace(",",".")
                .toLowerCase()
                .split(" ")
                .every((v) => {
                    if (item.preco.toLowerCase().includes(v)) {
                        return item.preco.toLowerCase().includes(v);
                    } else if (item.nome.toLowerCase().includes(v)) {
                        return item.nome.toLowerCase().includes(v);
                    } else if (item.descricao.toLowerCase().includes(v)) {
                        return item.descricao.toLowerCase().includes(v);
                    } else if (item.valor!= null && item.valor.toLowerCase().includes(v)) {
                        return item.valor.toLowerCase().includes(v);
                    }
                });
            });
    
            if (this.pager.totalPages < 1) {
              this.pager.totalPages = 1;
            }
    
            this.setPage(1, this.searchFilters);
        } else {
            if (this.pager.totalPages < 1) {
              this.pager.totalPages = 1;
            }
            this.searchFilters = this.tokenDumms;
            this.setPage(1, this.searchFilters);
        }
    },
},
mounted: function () {
    this.tokenDumms = <?php echo $db?>; //data array;
    this.initController(); //index method used to call the setPage method
  },
});

vue.config.horario = JSON.parse(vue.config.horario)
let tag = 0
let hoje = new Date()
let minuto_agora = String(hoje.getMinutes())
if(minuto_agora.length<2){minuto_agora ='0'+minuto_agora}
let agora = parseInt(String(hoje.getHours())+minuto_agora)
for (key in vue.config.horario) {  
    if(tag == hoje.getDay()){             
        for(let c =0 ; c < vue.config.horario[key]["hora-inicio"].length ; c++){
            let inicio = parseInt(String(vue.config.horario[key]["hora-inicio"][c])+String(vue.config.horario[key]["minuto-inicio"][c]))
            let fim = parseInt(String(vue.config.horario[key]["hora-fim"][c])+String(vue.config.horario[key]["minuto-fim"][c]))                                  
            let switch1 = 0
            if(agora<=fim && agora>=inicio){
                switch1 = 1                                   
            }
            if(c+1 == vue.config.horario[key]["hora-inicio"].length && switch1 == 0 ){
                alert('Estamos Fechado')
            }
        }        
    }
    tag++
}
</script>

</body>

