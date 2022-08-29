-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Ago-2022 às 06:09
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6
drop database if exists barbearia_dev;
create database barbearia_dev;
use barbearia_dev;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `barbearia_dev`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_AGENDAMENTOS_BARBEARIA` (IN `id_barbearia` INT)   BEGIN
	select 
		agendamento.id_agendamento,
		agendamento.barbearia,
		agendamento.data_agendamento, 
		agendamento.horario_agendamento,
		agendamento.valor_total,
		agendamento.status,
		agendamento.data_criacao,
		group_concat(concat(" ", servico.nome)) as "nome_servico",
		user.nome as "nome_usuario"
	from agendamento_servico
	inner join agendamento
	on agendamento_servico.agendamento = agendamento.id_agendamento
	inner join servico
	on agendamento_servico.servico = servico.id_servico
	inner join user
	on agendamento.usuario = user.user_id
	where agendamento.barbearia=id_barbearia
	group by agendamento.id_agendamento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_AGENDAMENTOS_USUARIO` (IN `usuario` INT)   BEGIN
	SELECT 
		barbearia.nome_barbearia,
		agendamento.data_agendamento,
		agendamento.horario_agendamento,
		group_concat(concat(" ", servico.nome)) as "nome_servico",
		agendamento.valor_total,
		barbearia.rua,
		barbearia.num_bar,
		barbearia.bairro,
		barbearia.telefone
	FROM agendamento_servico
	INNER JOIN agendamento
	ON agendamento_servico.agendamento = agendamento.id_agendamento
	INNER JOIN barbearia
	ON agendamento.barbearia = barbearia.barbearia_id
	INNER JOIN servico
	ON agendamento_servico.servico = servico.id_servico
	WHERE agendamento.status = 'P' AND agendamento.usuario = usuario
    GROUP BY barbearia.nome_barbearia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_DEL_SERVICO` (IN `servico` INT, IN `id_barbearia` INT)   BEGIN
	DELETE FROM servico 
    WHERE id_servico = servico and barbearia = id_barbearia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_INS_AGENDAMENTO` (IN `id_usuario` INT, IN `id_barbearia` INT, IN `data_agendamento_escolhida` DATE, IN `horario_agendamento_escolhido` TIME, IN `valor_total_escolhido` DECIMAL)   BEGIN
	INSERT INTO agendamento (
		usuario,
        barbearia,
        data_agendamento,
        horario_agendamento,
        valor_total,
        status
    ) VALUES (
		id_usuario,
        id_barbearia,
        data_agendamento_escolhida,
        horario_agendamento_escolhido,
        valor_total_escolhido,
        'P'
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_INS_AGENDAMENTO_SERVICO` (IN `id_agendamento` INT, IN `servico` INT)   BEGIN
	INSERT INTO agendamento_servico(
		agendamento,
        servico
    ) VALUES (
		id_agendamento,
        servico
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_INS_SERVICO` (IN `nome_servico` VARCHAR(45), IN `preco_servico` DECIMAL, IN `id_barbearia` INT)   BEGIN
	INSERT INTO servico (nome, preco, barbearia)
	VALUES (nome_servico, preco_servico, id_barbearia);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_LUCRO_TOTAL_DIA` (IN `data_hoje` DATE, IN `id_barbearia` INT)   BEGIN
	select 
		sum(valor_total) as "lucro_total"
	from agendamento
	where data_agendamento = data_hoje
	and agendamento.barbearia = id_barbearia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_PESQUISAR_BARBEARIAS` (IN `nome` VARCHAR(45), IN `cidade` VARCHAR(45), IN `horario` TIME)   BEGIN
	SELECT 
		barbearia_id,
		nome_barbearia,
		horario_abertura,
		horario_fechamento,
		horario_abertura_final_semana,
		horario_fechamento_final_semana,
		telefone,
		cidade,
        imagem_barbearia
	FROM barbearia
	WHERE nome_barbearia LIKE concat('%', nome, '%') AND 
		  cidade  LIKE concat('%', cidade, '%') AND
		  horario >= horario_abertura AND horario <= horario_fechamento
	LIMIT 16;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_SEL_BARBEARIA` (IN `barbearia` INT)   BEGIN
	SELECT 
		nome_barbearia,
        telefone,
        rua,
        num_bar,
        bairro,
        cidade,
        uf
        cep, 
        horario_abertura,
        horario_fechamento, 
        horario_abertura_final_semana,
        horario_fechamento_final_semana
    FROM barbearia WHERE barbearia.barbearia_id = barbearia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_SEL_CARD_BARBEARIAS` ()   BEGIN
	SELECT 
		barbearia_id,
		nome_barbearia,
        horario_abertura,
        horario_fechamento,
        horario_abertura_final_semana,
        horario_fechamento_final_semana,
		telefone,
		cidade,
        imagem_barbearia
	FROM barbearia
    LIMIT 16;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_SEL_SERVICOS` (IN `id_barbearia` INT)   BEGIN
	SELECT 
		id_servico,
		nome, 
        preco
	FROM servico
	WHERE barbearia = id_barbearia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_SEL_USUARIO` (IN `usuario` INT)   BEGIN
	SELECT * FROM user WHERE user.user_id = usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_SEL_VALOR_SERVICO` (IN `nome_servico` VARCHAR(45), IN `id_barbearia` INT)   BEGIN
	SELECT preco
    FROM servico
    WHERE nome = nome_servico and barbearia = id_barbearia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_SERVICO_MAIS_REQUISITADO` (IN `data_atual` DATE, IN `id_barbearia` INT)   BEGIN
	select 
		servico.nome,
		count(servico.nome) as "quantidade"
	from agendamento_servico
	inner join agendamento
	on agendamento_servico.agendamento = agendamento.id_agendamento
	inner join servico
	on agendamento_servico.servico = servico.id_servico
	where data_agendamento = data_atual and agendamento.barbearia = id_barbearia
	group by servico.nome asc
    limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_TOTAL_SERVICOS_DIA` (IN `data_hoje` DATE, IN `id_barbearia` INT)   BEGIN
    select 
		count(*) as "quantidade"
	from agendamento
	where data_agendamento = data_hoje and agendamento.barbearia = id_barbearia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_UP_USER` (IN `usuario` INT, IN `nome_atualizado` VARCHAR(45), IN `telefone_atualizado` VARCHAR(45) )   BEGIN
	UPDATE user
    SET nome = nome_atualizado, 
		telefone = telefone_atualizado
    WHERE user.user_id = usuario;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id_agendamento` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `barbearia` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `horario_agendamento` time NOT NULL,
  `valor_total` decimal(10,0) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'P' COMMENT 'F - finalizado | P - pendente | C - Cancelado',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `agendamento`
--

INSERT INTO `agendamento` (`id_agendamento`, `usuario`, `barbearia`, `data_agendamento`, `horario_agendamento`, `valor_total`, `status`, `data_criacao`) VALUES
(1, 1, 1, '2022-08-23', '14:00:00', '18', 'P', '2022-08-20 15:08:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento_servico`
--

CREATE TABLE `agendamento_servico` (
  `agendamento` int(11) NOT NULL,
  `servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `agendamento_servico`
--

INSERT INTO `agendamento_servico` (`agendamento`, `servico`) VALUES
(12, 1),
(13, 1),
(13, 2),
(14, 2),
(15, 2),
(16, 1),
(19, 15),
(20, 15),
(20, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `barbearia`
--

CREATE TABLE `barbearia` (
  `barbearia_id` int(11) NOT NULL,
  `nome_dono` varchar(45) NOT NULL,
  `cpf_dono` varchar(45) NOT NULL,
  `email_dono` varchar(45) NOT NULL,
  `senha_dono` varchar(45) NOT NULL,
  `nome_barbearia` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `num_bar` varchar(10) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `uf` varchar(45) NOT NULL,
  `horario_abertura` time DEFAULT NULL,
  `horario_fechamento` time DEFAULT NULL,
  `horario_abertura_final_semana` time DEFAULT NULL,
  `horario_fechamento_final_semana` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `barbearia`
--

INSERT INTO `barbearia` (`barbearia_id`, `nome_dono`, `cpf_dono`, `email_dono`, `senha_dono`, `nome_barbearia`, `telefone`, `cep`, `cnpj`, `rua`, `num_bar`, `bairro`, `cidade`, `uf`, `horario_abertura`, `horario_fechamento`, `horario_abertura_final_semana`, `horario_fechamento_final_semana`) VALUES
(8, 'Gustavo', '111.111.111-11', 'gustavogauerorth@gmail.com', '123456789', 'El Salvador', '(51) 99532-6200', '95750-000', '11.111.111/1111-11', 'Rua Alcidio Hartmann', '15 ', 'Liberdade', 'Salvador do Sul', 'RS', '07:30:00', '17:30:00', '08:30:00', '16:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `barbearia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_servico`, `nome`, `preco`, `barbearia`) VALUES
(1, 'Corte de Cabelo', '18', 8),
(2, 'Corte de Barba', '10', 8),
(15, 'Cabelo e Barba', '25', 8),
(17, 'Sombracelha', '9', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_id`, `nome`, `telefone`, `email`, `senha`) VALUES
(1, 'gustavo', '(51) 99532-6200', 'gustavogauerorth@gmail.com', '123456789');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `fk_user_id` (`usuario`),
  ADD KEY `fk_barbearia_id` (`barbearia`);

--
-- Índices para tabela `agendamento_servico`
--
ALTER TABLE `agendamento_servico`
  ADD KEY `fk_agendamento_servico` (`agendamento`),
  ADD KEY `fk_servico_agendamento` (`servico`);

--
-- Índices para tabela `barbearia`
--
ALTER TABLE `barbearia`
  ADD PRIMARY KEY (`barbearia_id`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id_servico`),
  ADD KEY `fk_barbearia_servico` (`barbearia`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `barbearia`
--
ALTER TABLE `barbearia`
  MODIFY `barbearia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`usuario`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `agendamento_servico`
--

-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `fk_barbearia_servico` FOREIGN KEY (`barbearia`) REFERENCES `barbearia` (`barbearia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
