SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET @@time_zone = `+03:00`;

INSERT INTO `modulos` (`nome`, `url`, `icone`, `status`, `ordem`, `tabela`, `cod_head`, `data_atualizacao`, `chave`, `acao`)
SELECT "Cardapio", "cardapio.php", "icon-cutlery", 1, 0, "cardapio", "cardapio/cardapio.js", "2019-05-07", "72b4b1d7ce2b514a981a49b1db5790a7", "{\"item\":[\"adicionar\",\"editar\",\"deletar\"],\"categoria\":[\"adicionar\",\"editar\",\"deletar\"],\"codigo\":[\"acessar\"],\"configuracao\":[\"acessar\"]}";

-- VUE
CREATE TABLE IF NOT EXISTS `cardapio` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `modo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `cardapio` (`id`, `modo`) VALUES (
    1, 
    '<script src=\"https://cdn.jsdelivr.net/npm/vue@2\"></script>'
    );

-- CATEGORIA
CREATE TABLE IF NOT EXISTS `cardapio_categoria` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` varchar(255) DEFAULT NULL,
    `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ITEM
CREATE TABLE IF NOT EXISTS `cardapio_item` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `categoria` int(11) DEFAULT NULL,
    `nome` varchar(255) DEFAULT NULL,
    `descricao` text DEFAULT NULL,
    `preco` float(50,2) DEFAULT NULL DEFAULT NULL,
    `valor` float(50,2) DEFAULT NULL DEFAULT NULL,
    `promocao` varchar(255) DEFAULT NULL,
    `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CONFIGURACAO
CREATE TABLE IF NOT EXISTS `cardapio_config` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

        #ALGO
    `lg_cor_fundo` varchar(255) DEFAULT NULL,
    `lg_cor_texto` varchar(255) DEFAULT NULL,
    `lg_cor_texto_bt` varchar(255) DEFAULT NULL,
    `lg_cor_texto_hover_bt` varchar(255) DEFAULT NULL,
    `lg_cor_fundo_bt` varchar(255) DEFAULT NULL,
    `logo` varchar(255) DEFAULT NULL,
    `img` varchar(255) DEFAULT NULL,
    `lg_cor_fundo_hover_bt` varchar(255) DEFAULT NULL,
    `destaque` varchar(255) DEFAULT NULL,
        #ALGO
    `ds_cor_fundo` varchar(255) DEFAULT NULL,
    `ds_cor_titulo` varchar(255) DEFAULT NULL,
    `ds_descricao` varchar(255) DEFAULT NULL,
    `cor_primaria` varchar(255) DEFAULT NULL,
    `cor_secundaria` varchar(255) DEFAULT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    INSERT INTO `cardapio_config` (
        `id`, 

        #ALGO
        `lg_cor_fundo`, 
        `lg_cor_texto`, 
        `lg_cor_texto_bt`, 
        `lg_cor_texto_hover_bt`, 
        `lg_cor_fundo_bt`,
        `logo`, 
        `img`,  
        `lg_cor_fundo_hover_bt`,
        `destaque`,
        #ALGO
        `ds_cor_fundo`, 
        `ds_cor_titulo`,
        `ds_descricao`, 
        `cor_primaria`,  
        `cor_secundaria`

    ) VALUES
    (1,'','','','','','','','','','','','','','');