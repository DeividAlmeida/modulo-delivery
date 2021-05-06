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
    `nome` varchar(255) DEFAULT NULL,
    `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- COMPLEMENTO
CREATE TABLE IF NOT EXISTS `delivery_complemento` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` varchar(255) DEFAULT NULL,
    `categoria` varchar(255) DEFAULT NULL,
    `tipo` varchar(255) DEFAULT NULL,
    `status` varchar(255)  DEFAULT 'Ativo',
    `opcoes` text DEFAULT NULL,
    `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ADICIONAL
CREATE TABLE IF NOT EXISTS `delivery_adicional` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` varchar(255) DEFAULT NULL,
    `categoria` varchar(255) DEFAULT NULL,
    `valor` varchar(255) DEFAULT NULL,
    `status` varchar(255)  DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- PRODUTO
CREATE TABLE IF NOT EXISTS `delivery_produto` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` varchar(255) DEFAULT NULL,
    `categoria` varchar(255) DEFAULT NULL,
    `valor` varchar(255) DEFAULT NULL,
    `imagem` varchar(255) DEFAULT NULL,
    `complementos` text DEFAULT NULL,
    `adicionais` text DEFAULT NULL,
    `descricao` text DEFAULT NULL,
    `dias` text DEFAULT NULL,
    `status` varchar(255)  DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CONFIGURACAO
CREATE TABLE IF NOT EXISTS `delivery_config` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

        #ESTILO
    `estilo` varchar(255) DEFAULT NULL,
    `colunas` varchar(255) DEFAULT NULL,
    `lis_fundo` varchar(255) DEFAULT NULL,
    `lis_fundo_pro` varchar(255) DEFAULT NULL,
    `lis_hover_fundo` varchar(255) DEFAULT NULL,
    `lis_titulo` varchar(255) DEFAULT NULL,
    `lis_descricao` varchar(255) DEFAULT NULL,
    `lis_preco` varchar(255) DEFAULT NULL,
    `lis_preco_pro` varchar(255) DEFAULT NULL,
    `borda` varchar(255) DEFAULT NULL,
    `paginacao` varchar(255) DEFAULT NULL,
    `item` varchar(255) DEFAULT NULL,
    `pag_fundo` varchar(255) DEFAULT NULL,
    `pag_texto` varchar(255) DEFAULT NULL,
        #POPUP
    `pop_fundo` varchar(255) DEFAULT NULL,
    `pop_titulo` varchar(255) DEFAULT NULL,
    `pop_descricao` varchar(255) DEFAULT NULL,
    `pop_fechar` varchar(255) DEFAULT NULL,
    `entrada` varchar(255) DEFAULT NULL,
        #MOBILE
    `mob_img` varchar(255) DEFAULT NULL,
    `mob_fundo_categoria` varchar(255) DEFAULT NULL,
    `mob_texto_categoria` varchar(255) DEFAULT NULL,
    `mob_fundo_pesquisa` varchar(255) DEFAULT NULL,
    `mob_texto_pesquisa` varchar(255) DEFAULT NULL,
    `mob_fundo` varchar(255) DEFAULT NULL,
    `mob_divisor` varchar(255) DEFAULT NULL,
    `mob_titulo` varchar(255) DEFAULT NULL,
    `mob_descricao` varchar(255) DEFAULT NULL,
    `mob_preco` varchar(255) DEFAULT NULL,
    `mob_preco_pro_1` varchar(255) DEFAULT NULL,
    `mob_preco_pro` varchar(255) DEFAULT NULL,
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

            #Horario
        `horario`
        ) 
   VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);