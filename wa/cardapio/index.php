<?php
    header('Access-Control-Allow-Origin: *');
	require_once('../../includes/funcoes.php');
	require_once('../../database/config.database.php');
	require_once('../../database/config.php');
	#$_GET['id'] = 4;
	if(isset($_GET['id'])):
	    $categoria = $_GET['id'];
	    $fetch = DBRead('cardapio_item','*' ,"WHERE categoria = '{$categoria}'");
	    
	else:
	    $categoria = 'null';
	    $fetch = DBRead('cardapio_item','*');

	endif;
	    $categorias = json_encode(DBRead('cardapio_categoria','*'));
	    $config = json_encode(DBRead('cardapio_config','*')[0]);
	    $db = json_encode($fetch);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ConfigPainel('base_url') ?>epack/css/elements/animate.css" >
    <?php  echo DBRead('cardapio','*',"WHERE id = '1'")[0]['modo']; ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.10.2/underscore-min.js'></script>

<style>
html{
    overflow-x: hidden;;
}
.pagination {
    width: 100%;
    display: inline-block;
    padding-left: 0;
    margin: 20px 9%;
    border-radius: 4px;
}

.pagination > li {
  display: inline;
}

.pagination > li > a,
.pagination > li > span {
  position: relative;
  float: left;
  padding: 10px 16px;
  margin-left: -2px;
  line-height: 1.42857143;
  color: #fff !important;
  text-decoration: none;
  background-color: #1c2228;
  border: 1px solid #000;
}

.pagination > li:first-child > a,
.pagination > li:first-child > span {
  margin-left: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}

.pagination > li:last-child > a,
.pagination > li:last-child > span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.pagination > li > a:focus,
.pagination > li > a:hover,
.pagination > li > span:focus,
.pagination > li > span:hover {
  z-index: 3;
  color: #fff;
  background-color: #000;
  border-color: #000;
}

.pagination > .active > a,
.pagination > .active > a:focus,
.pagination > .active > a:hover,
.pagination > .active > span,
.pagination > .active > span:focus,
.pagination > .active > span:hover {
  z-index: 2;
  color: #fff;
  cursor: default;
  background: linear-gradient(-68deg, #000, #000);
  border-color: #000;
}

.pagination > .disabled > a,
.pagination > .disabled > a:focus,
.pagination > .disabled > a:hover,
.pagination > .disabled > span,
.pagination > .disabled > span:focus,
.pagination > .disabled > span:hover {
  color: #777 !important;
  cursor: not-allowed;
  background-color: #1c2228;
  border-color: #000;
}

.pagination-lg > li > a,
.pagination-lg > li > span {
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
}

.pagination-lg > li:first-child > a,
.pagination-lg > li:first-child > span {
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
}

.pagination-lg > li:last-child > a,
.pagination-lg > li:last-child > span {
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}

.pagination-sm > li > a,
.pagination-sm > li > span {
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
}

.pagination-sm > li:first-child > a,
.pagination-sm > li:first-child > span {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}

.pagination-sm > li:last-child > a,
.pagination-sm > li:last-child > span {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}

.pagination a {
  cursor: pointer;
}
#dashboard{
    margin:10px 7%; 
    display: flex;
    justify-content: center;
 }
* {
  box-sizing: border-box;
}
.search{
    width:250px;
    height: 35px;
    margin:15px;
}
#menu{
    position:relative;
    left:8%;
}
.column {
    float: left;
    width: 40%;
    display:flex;
    border:solid 3px #000;
    margin: 1%;
    cursor:pointer;
    height:120px;
}
.column div{
    
}
.um{
    width:120px;
    overflow:hidden;
}
.um img{
    height:120px;
}
.dois p{
    text-overflow: ellipsis;
    overflow: hidden; 
    margin:0;
}
.dois b{
    font-size:25px;
}
.dois { 
    width:60%;
    padding:10px;
    height:70px;
    white-space:nowrap;
    text-overflow:ellipsis;
    position:relative;
    top:15%;
    
}
.tres{
    padding-bottom:10px;
    padding-top: 2%;
    position:relative;
    top:16%;
    right:1.5%;
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
    background-color: #fff;
    z-index: 10000001;
    height: 250px;
    width: 750px;
    margin: 5% 18%;
    border-radius: 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    overflow:hidden;
}
#fechar{
    font-size: 50px;
    margin: 0px 10px;
    position: absolute;
    right: 5px;
    cursor: pointer;
    font-weight: bolder;
    color: rgb(0,0,0,0.1);
}
#um{
    position: absolute;
    overflow: hidden;
    width: 250px;
}
#um img{
    height:250px;
}
#dois {
    position: initial;
    margin: 2% 0% 0% 38%;
    width: 440px;
    overflow: hidden;
    white-space: break-spaces
}
#dois p{
    height:150px;
    overflow-y:scroll;
}
#dois b{
    font-size: 35px;
}
            
::-webkit-scrollbar {
  width: 10px;

}

::-webkit-scrollbar-thumb {
  background-color: rgb(0,0,0,0.2);
  border-radius: 10px;
}
.nao{
    text-decoration: line-through;
    margin: 0;
    text-align: center;
}
.sim{
    font-size: 20px;
    font-weight: bolder;
    white-space: nowrap;
    text-align: center;
    margin: 0;
    position: relative;
    top: 5%;
}
.promocao{
    background:grey;
}
</style>
</header>
<body>
    <div id="controller">
        <div id="dashboard">
            <select @change="categor($event)" v-if="!categoria" class="search">
                <option selected>Escolha a categoria que deseja </option>
                <option  v-for="cat, i of categorias" :value="cat.id">{{cat.nome}}</option>
            </select>
            <input class="search"  v-model="searchQuery" placeholder="Digite aqui o que está procurando... &#128269;" @keyup="resultQuery()" />
        </div>
        
        <div id="menu" >
            <div :class="item.promocao == 'S'?'promocao column':'column'" class="" v-for="(item, index) in tokens" @click="select(index)">
                <div class="um">
                    <img :src="origin+'wa/cardapio/uploads/'+item.img">
                </div>
                <div class="dois">
                    <b>{{item.nome}}</b>
                    <p>{{item.descricao}}</p>
                </div>
                <div class="tres">
                    <p class="sim" v-if="item.promocao == 'S'">R$ {{item.valor.replace('.',',')}}</p>
                    <p :class="item.promocao == 'S'?'nao':'sim'">R$ {{item.preco.replace('.',',')}}</p>
                </div>
            </div>
            
        </div>
        <div v-if="idx != null">
            <div id="box" @click="close()">
            </div>
            <div id="popup" :class='config.entrada'>
                <span id="fechar"  @click="close()"> 	&times;
                </span>
                <div id="um">
                    <img :src="origin+'wa/cardapio/uploads/'+tokens[idx].img">
                </div>
                <div id="dois">
                    <b>{{tokens[idx].nome}}</b>
                    <p>{{tokens[idx].descricao}}</p>
                </div>
            </div>
        </div>
        <ul  class="pagination">
            <li :class="{'disabled' : pager.currentPage === 1}">
                <a @click="setPage(1)">&Ll;</a>
            </li>
            <li :class="{'disabled' : pager.currentPage === 1}">
                <a @click="setPage(pager.currentPage - 1)">	&Lt;</a>
            </li>
            <li v-for="page in pager.pages" :class="{'active' : pager.currentPage === page}">
                <a @click="setPage(page)" v-html="page"></a>
            </li>
            <li :class="{'disabled' : pager.currentPage === pager.totalPages}">
                <a @click="setPage(pager.currentPage + 1)">	&Gt;</a>
            </li>
            <li :class="{'disabled' : pager.currentPage === pager.totalPages}">
                <a @click="setPage(pager.totalPages)">&ggg;</a>
            </li>
        </ul>
    </div>


<script>

var myMixin = {
  methods: {
    GetPager: function (totalItems, currentPage, pageSize) {
      currentPage = currentPage || 1;

      pageSize = pageSize || 11;

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
          startPage = currentPage - 11;
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
        window.location.href = '<?php echo ConfigPainel('base_url') ?>wa/cardapio/?id='+i.target.value
    },
    setPage: function (page, itemsToFilter) {
        if (page < 1 || page > this.pager.totalPages) {
            return;
        }
        
        if (itemsToFilter != null) {
            this.pager = this.GetPager(itemsToFilter.length, page, 11);
        
            this.tokens = itemsToFilter.slice(
              this.pager.startIndex,
              this.pager.endIndex + 1
            );
        
        
        } else if (itemsToFilter == null || itemsToFilter.length <= 0) {
            this.pager = this.GetPager(this.tokenDumms.length, page, 11);
        
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
                .toLowerCase()
                .split(" ")
                .every((v) => {
                    if (item.preco.toLowerCase().includes(v)) {
                        return item.preco.toLowerCase().includes(v);
                    } else if (item.nome.toLowerCase().includes(v)) {
                        return item.nome.toLowerCase().includes(v);
                    } else if (item.descricao.toLowerCase().includes(v)) {
                        return item.descricao.toLowerCase().includes(v);
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
</script>

</body>

