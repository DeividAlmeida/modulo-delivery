SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET @@time_zone = `+03:00`;

INSERT INTO `modulos` (`nome`, `url`, `icone`, `status`, `ordem`, `tabela`, `cod_head`, `data_atualizacao`, `chave`, `acao`)
SELECT "Cardapio", "cardapio.php", "icon-cutlery", 1, 0, "cardapio", "cardapio/cardapio.js", "2019-05-07", "72b4b1d7ce2b514a981a49b1db5790a7", "{\"item\":[\"adicionar\",\"editar\",\"deletar\"],\"professor\":[\"adicionar\",\"editar\",\"deletar\"],\"aluno\":[\"adicionar\",\"editar\",\"deletar\"],\"curso\":[\"adicionar\",\"editar\",\"deletar\"],\"modulo\":[\"adicionar\",\"editar\",\"deletar\"],\"aula\":[\"adicionar\",\"editar\",\"deletar\"],\"categoria\":[\"adicionar\",\"editar\",\"deletar\"],\"codigo\":[\"acessar\"],\"configuracao\":[\"acessar\"]}";

-- CONFIGURAÇÃO
CREATE TABLE IF NOT EXISTS `ead` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `modo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `ead` (`id`, `modo`) VALUES (
    1, 
    '<script src=\"https://cdn.jsdelivr.net/npm/vue@2\"></script>'
    );