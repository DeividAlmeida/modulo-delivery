<script>

window.onscroll = function(){
  let x = parseInt(document.body.getBoundingClientRect().height - document.body.getBoundingClientRect().bottom)
  let y = parseInt(document.getElementById('delivery').getBoundingClientRect().height - document.getElementById('delivery').getBoundingClientRect().bottom)
  let z = parseInt(x-y)
  if(window.scrollY > z){
    document.getElementsByClassName('filtro-fixo')[0].style="display: inline"
  }else{
    document.getElementsByClassName('filtro-fixo')[0].style="display: none"
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
    entrega:<?php echo $entrega ?>,
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
    pedido:[],
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
    muda: function(a,b){
        if(a>=1){
            let base = parseFloat(vue.pedido[b].total)/vue.pedido[b].qtd
            let tira = base*vue.pedido[b].qtd
            let coloca = base*a
            vue.total = (vue.total + a)- vue.pedido[b].qtd 
            vue.valor = parseFloat((parseFloat(vue.valor)-tira)+coloca).toFixed(2)
            vue.pedido[b].qtd = a
            vue.pedido[b].total=parseFloat(base*vue.pedido[b].qtd).toFixed(2)
            sessionStorage.setItem('delivery_pedido',JSON.stringify(vue.pedido))
            sessionStorage.setItem('delivery_total',JSON.stringify(vue.total))
            sessionStorage.setItem('delivery_valor',vue.valor)  
        }
        this.$forceUpdate()
    },
    add: function(b){
            let a = Math.abs(document.getElementById(b).value)+1
            let base = parseFloat(vue.pedido[b].total)/vue.pedido[b].qtd
            vue.pedido[b].qtd = a
            vue.total = vue.total+1
            vue.pedido[b].total=parseFloat(base*vue.pedido[b].qtd).toFixed(2)
            vue.valor = parseFloat(parseFloat(vue.valor)+base).toFixed(2)
            sessionStorage.setItem('delivery_pedido',JSON.stringify(vue.pedido))
            sessionStorage.setItem('delivery_total',JSON.stringify(vue.total))
            sessionStorage.setItem('delivery_valor',vue.valor)
    },
    less: function(b){
            let a = Math.abs(document.getElementById(b).value)-1
        if(a>=1){
            vue.total = vue.total-1
            let base = parseFloat(vue.pedido[b].total)/vue.pedido[b].qtd
            vue.pedido[b].qtd = a
            vue.pedido[b].total=parseFloat(base*vue.pedido[b].qtd).toFixed(2)
            vue.valor = parseFloat(parseFloat(vue.valor)-base).toFixed(2)
            sessionStorage.setItem('delivery_pedido',JSON.stringify(vue.pedido))
            sessionStorage.setItem('delivery_total',JSON.stringify(vue.total))
            sessionStorage.setItem('delivery_valor',vue.valor)
        }
    },
    openhide: function(a){
      let teste = document.getElementById('p'+a).getAttribute('class').search('open')
      if(teste <0){
        document.getElementById('p'+a).setAttribute('class', 'name opened')
        document.getElementById('c'+a).setAttribute('class', 'content')
        document.getElementById('m'+a).setAttribute('class', 'complementos')
      }else{
        document.getElementById('p'+a).setAttribute('class', 'name')
        document.getElementById('c'+a).setAttribute('class', 'content hi')
        document.getElementById('m'+a).setAttribute('class', 'complementos m0')
      }
    },
    remove: function(a,b,c){
        Swal.fire({
            title: 'Tem certeza?!',
            text: "Deseja realmente removê-lo do seu pedido?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.isConfirmed) {
                vue.pedido.splice(a,1)
                vue.total = parseFloat(vue.total-b)
                vue.valor = parseFloat(vue.valor-c).toFixed(2)
                sessionStorage.setItem('delivery_pedido',JSON.stringify(vue.pedido))
                sessionStorage.setItem('delivery_total',JSON.stringify(vue.total))
                sessionStorage.setItem('delivery_valor',vue.valor)
                Swal.fire(
                'Removido!',
                'Removido com sucesso.',
                'success'
                )
            }
        })
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
                .replace(".",",")
                .toLowerCase()
                .split(" ")
                .every((v) => {
                    if (item.valor.toLowerCase().includes(v)) {
                        return item.valor.toLowerCase().includes(v);
                    } else if (item.nome.toLowerCase().includes(v)) {
                        return item.nome.toLowerCase().includes(v);
                    } else if (item.descricao.toLowerCase().includes(v)) {
                        return item.descricao.toLowerCase().includes(v);
                    } else if (item.v_cortado != null && item.v_cortado.toLowerCase().includes(v)) {
                        return item.v_cortado.toLowerCase().includes(v);
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
    if(sessionStorage.getItem('delivery_valor') != null ){
        vue.total = parseFloat(sessionStorage.getItem('delivery_total'))
        vue.valor = parseFloat(sessionStorage.getItem('delivery_valor')).toFixed(2)
        vue.pedido=JSON.parse(sessionStorage.getItem('delivery_pedido'))
        for(let i = 0; i<vue.pedido.length;i++){
            let c = '0'
            let a = '0'
            let resultado = null
            vue.pedido[i].complementos.filter(a=>{if(a[1] !== 0){c= '1'}})
            vue.pedido[i].adicionais.filter(b=>{if(b.qtd !== 0){a = '1'}})
            resultado = c+a
            Object.assign(vue.pedido[i], {resultado:resultado})
        }
    }
} 

</script>
