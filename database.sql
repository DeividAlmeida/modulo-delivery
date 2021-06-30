SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET @@time_zone = `+03:00`;

INSERT INTO `modulos` (`nome`, `url`, `icone`, `status`, `ordem`, `tabela`, `cod_head`, `data_atualizacao`, `chave`, `acao`)
SELECT "Delivery", "delivery.php", "icon-truck", 1, 0, "delivery", "delivery/delivery.js", "2019-05-07", "72b4b1d7ce2b514a981a49b1db5790a7", "{\"item\":[\"adicionar\",\"editar\",\"deletar\"],\"categoria\":[\"adicionar\",\"editar\",\"deletar\"],\"codigo\":[\"acessar\"],\"configuracao\":[\"acessar\"]}";

-- VUE
CREATE TABLE IF NOT EXISTS `delivery` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `modo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `delivery` (`id`, `modo`) VALUES (
    1, 
    '<script src=\"https://cdn.jsdelivr.net/npm/vue@2\"></script>'
    );

-- CATEGORIA
CREATE TABLE IF NOT EXISTS `delivery_categoria` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` text DEFAULT NULL,
    `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- COMPLEMENTO
CREATE TABLE IF NOT EXISTS `delivery_complemento` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` text DEFAULT NULL,
    `categoria` text DEFAULT NULL,
    `tipo` text DEFAULT NULL,
    `status` text  DEFAULT 'Ativo',
    `opcoes` text DEFAULT NULL,
    `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- PEDIDOS
CREATE TABLE IF NOT EXISTS `delivery_pedidos` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fone` text DEFAULT NULL,
    `nome` text DEFAULT NULL,
    `endereco` text DEFAULT NULL,
    `numero` text DEFAULT NULL,
    `complemento` text DEFAULT NULL,
    `bairro` text DEFAULT NULL,
    `referencia` text DEFAULT NULL,
    `cep` text DEFAULT NULL,
    `total` text DEFAULT NULL,
    `pedido` text DEFAULT NULL,
    `valor` text DEFAULT NULL,
    `data` text DEFAULT NULL,
    `pagamento` text DEFAULT NULL,    
    `entrega` text DEFAULT NULL,
    `observa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ADICIONAL
CREATE TABLE IF NOT EXISTS `delivery_adicional` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` text DEFAULT NULL,
    `categoria` text DEFAULT NULL,
    `valor` text DEFAULT NULL,
    `status` text  DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- PRODUTO
CREATE TABLE IF NOT EXISTS `delivery_produto` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` text DEFAULT NULL,
    `categoria` text DEFAULT NULL,
    `valor` text DEFAULT NULL,
    `imagem` text DEFAULT NULL,
    `complementos` text DEFAULT NULL,
    `adicionais` text DEFAULT NULL,
    `descricao` text DEFAULT NULL,
    `dias` text DEFAULT NULL,
    `promocao` text DEFAULT NULL,
    `v_cortado` text DEFAULT NULL,
    `status` text  DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- ENTREGA
CREATE TABLE IF NOT EXISTS `delivery_entrega` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `estado` text DEFAULT NULL,
    `cidade` text DEFAULT NULL,
    `bairro` text DEFAULT NULL,
    `numero` text DEFAULT NULL,
    `rua` text DEFAULT NULL,
    `cep` text DEFAULT NULL,
    `tipo` text DEFAULT NULL,
    `media` text DEFAULT NULL,
    `tempo` text DEFAULT NULL,
    `delivery` text DEFAULT NULL,
    `balcao` text DEFAULT NULL,
    `mesa` text DEFAULT NULL,
    `msg` text DEFAULT NULL,
    `min` text DEFAULT NULL,
    `entrega` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `delivery_entrega` (
    `id`,
    `estado`,
    `cidade`,
    `bairro`,
    `numero`,
    `rua`,
    `cep`,
    `tipo`,
    `media`,
    `tempo`,
    `delivery`,
    `balcao`,
    `mesa`,
    `msg`,
    `min`,
    `entrega`
)
 VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

 
-- PAGAMENTO
CREATE TABLE IF NOT EXISTS `delivery_pagamento` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `mostrar` text DEFAULT NULL,
    `meio` text DEFAULT NULL,
    `opicao` text DEFAULT NULL,
    `email` text DEFAULT NULL,
    `token` text DEFAULT NULL,
    `pagar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `delivery_pagamento` (`id`, `mostrar`, `opicao`, `pagar`, `meio`)
VALUES (1, NULL, NULL, NULL, NULL);


-- CONFIGURACAO
CREATE TABLE IF NOT EXISTS `delivery_config` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

        #ESTILO
    `estilo` text DEFAULT NULL,
    `colunas` text DEFAULT NULL,
    `lis_fundo` text DEFAULT NULL,
    `lis_fundo_pro` text DEFAULT NULL,
    `lis_hover_fundo` text DEFAULT NULL,
    `lis_titulo` text DEFAULT NULL,
    `lis_descricao` text DEFAULT NULL,
    `lis_preco` text DEFAULT NULL,
    `lis_preco_pro` text DEFAULT NULL,
    `borda` text DEFAULT NULL,
    `paginacao` text DEFAULT NULL,
    `item` text DEFAULT NULL,
    `pag_fundo` text DEFAULT NULL,
    `pag_texto` text DEFAULT NULL,
    `bg_icone` text DEFAULT NULL,
    `cor_icone` text DEFAULT NULL,
    `bg_btn_pedido` text DEFAULT NULL,
    `cor_btn_pedido` text DEFAULT NULL,
        #POPUP
    `pop_fundo` text DEFAULT NULL,
    `pop_titulo` text DEFAULT NULL,
    `pop_descricao` text DEFAULT NULL,
    `pop_fechar` text DEFAULT NULL,
    `entrada` text DEFAULT NULL,
        #MOBILE
    `mob_img` text DEFAULT NULL,
    `mob_fundo_categoria` text DEFAULT NULL,
    `mob_texto_categoria` text DEFAULT NULL,
    `mob_fundo_pesquisa` text DEFAULT NULL,
    `mob_texto_pesquisa` text DEFAULT NULL,
    `mob_fundo` text DEFAULT NULL,
    `mob_divisor` text DEFAULT NULL,
    `mob_titulo` text DEFAULT NULL,
    `mob_descricao` text DEFAULT NULL,
    `mob_preco` text DEFAULT NULL,
    `mob_preco_pro_1` text DEFAULT NULL,
    `mob_preco_pro` text DEFAULT NULL,
    `checkout` text DEFAULT NULL,
    `whatsapp` text DEFAULT NULL,
    `atendimento` text DEFAULT NULL,
        #Horario
    `horario` text DEFAULT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
   INSERT INTO `delivery_config` (
       `id`,

            #ESTILO 
        `estilo`, 
        `colunas`, 
        `lis_fundo`,
        `lis_fundo_pro`,
        `lis_hover_fundo`, 
        `lis_titulo`, 
        `lis_descricao`, 
        `lis_preco`, 
        `lis_preco_pro`, 
        `borda`, 
        `paginacao`, 
        `item`,
        `pag_fundo`,
        `pag_texto`,
        `bg_icone`,
        `cor_icone`,
        `bg_btn_pedido`,
        `cor_btn_pedido`,
            #POPUP
        `pop_fundo`, 
        `pop_titulo`, 
        `pop_descricao`, 
        `pop_fechar`, 
        `entrada`, 
        
            #MOBILE
        `mob_img`, 
        `mob_fundo_categoria`, 
        `mob_texto_categoria`, 
        `mob_fundo_pesquisa`, 
        `mob_texto_pesquisa`, 
        `mob_fundo`, 
        `mob_divisor`, 
        `mob_titulo`, 
        `mob_descricao`, 
        `mob_preco`, 
        `mob_preco_pro_1`, 
        `mob_preco_pro`,
        `checkout`,
        `whatsapp`,
        `atendimento`,

            #Horario
        `horario`
        ) 
   VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);