<script>

window.onscroll = function(){
  let x = parseInt(document.body.getBoundingClientRect().height - document.body.getBoundingClientRect().bottom)
  let y = parseInt(document.getElementById('delivery').getBoundingClientRect().height - document.getElementById('delivery').getBoundingClientRect().bottom)
  let z = parseInt(x-y)
  if(window.scrollY > z){
    document.getElementsByClassName('fixed')[0].style="display: inline"
  }else{
    document.getElementsByClassName('fixed')[0].style="display: none"
  }
}
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
    horario:'',
    total:0,
    valor:'0.00',
    aviso:'Estamos fechados',
    ate:null,
    pagamento:''
},
methods: {
    select: function(a){      
      document.querySelectorAll('iframe#carrinho')[0].src=vue.origin+"wa/delivery/modal.php?id="+a
        setTimeout( function(){
          window.parent.location.assign('javascript:document.getElementById("carrinho").setAttribute("class", "open")')
        }, 300)
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
                    if (item.valor.toLowerCase().includes(v)) {
                        return item.valor.toLowerCase().includes(v);
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
            if(agora<=fim && agora>=inicio){
                vue.aviso ='Estamos abertos'
                vue.ate = 'das '+String(vue.config.horario[key]["hora-inicio"][c])+':'+String(vue.config.horario[key]["minuto-inicio"][c])+' até '+String(vue.config.horario[key]["hora-fim"][c])+':'+String(vue.config.horario[key]["minuto-fim"][c])
            }
        }        
    }
    tag++
}
new atualiza()
function atualiza(){
    if(sessionStorage.getItem('delivery_valor') != null){
        vue.total = parseFloat(sessionStorage.getItem('delivery_total'))
        vue.valor = parseFloat(sessionStorage.getItem('delivery_valor')).toFixed(2)
    }
}
</script>
