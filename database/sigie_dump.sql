-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.30-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para gie_test_desenv
CREATE DATABASE IF NOT EXISTS `gie_test_desenv` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gie_test_desenv`;

-- Copiando estrutura para tabela gie_test_desenv.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_instituicao` varchar(150) NOT NULL,
  `status_ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.accounts: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `nome_instituicao`, `status_ativo`) VALUES
	(1, 'Igreja Senhor Bonfim', 1),
	(2, 'Igreja Castro Alves', 1);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.bens_alocado_congregacao
CREATE TABLE IF NOT EXISTS `bens_alocado_congregacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_congregacao` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `qtd_item` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_congregao_alocada` (`id_congregacao`),
  KEY `FK2_item_alocado` (`id_item`),
  KEY `FK_bens_alocado_congregacao_accounts` (`account_id`),
  CONSTRAINT `FK1_congregao_alocada` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `FK2_item_alocado` FOREIGN KEY (`id_item`) REFERENCES `bens_igrejas` (`id`),
  CONSTRAINT `FK_bens_alocado_congregacao_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.bens_alocado_congregacao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bens_alocado_congregacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `bens_alocado_congregacao` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.bens_igrejas
CREATE TABLE IF NOT EXISTS `bens_igrejas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `nome_item` varchar(150) NOT NULL,
  `marca_item` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bens_igrejas_accounts` (`account_id`),
  CONSTRAINT `FK_bens_igrejas_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.bens_igrejas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bens_igrejas` DISABLE KEYS */;
/*!40000 ALTER TABLE `bens_igrejas` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.caixa
CREATE TABLE IF NOT EXISTS `caixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saldo` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.caixa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `caixa` DISABLE KEYS */;
/*!40000 ALTER TABLE `caixa` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.classe_aluno_ebd
CREATE TABLE IF NOT EXISTS `classe_aluno_ebd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_classe` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1account_id_classe_aluno` (`account_id`),
  CONSTRAINT `FK1account_id_classe_aluno` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.classe_aluno_ebd: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `classe_aluno_ebd` DISABLE KEYS */;
/*!40000 ALTER TABLE `classe_aluno_ebd` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.classe_ebd
CREATE TABLE IF NOT EXISTS `classe_ebd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1account_id_classeebd` (`account_id`),
  KEY `FK2_id_departamento_classe` (`id_departamento`),
  KEY `FK3_id_professor_classe` (`id_professor`),
  CONSTRAINT `FK1account_id_classeebd` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `FK2_id_departamento_classe` FOREIGN KEY (`id_departamento`) REFERENCES `departamento_classe_ebd` (`id`),
  CONSTRAINT `FK3_id_professor_classe` FOREIGN KEY (`id_professor`) REFERENCES `membros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.classe_ebd: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `classe_ebd` DISABLE KEYS */;
INSERT INTO `classe_ebd` (`id`, `nome`, `id_departamento`, `id_professor`, `account_id`, `created_at`, `updated_at`) VALUES
	(1, 'JUNIORES', 4, 13, 2, '2018-10-03 09:56:55', '2018-10-03 09:56:55');
/*!40000 ALTER TABLE `classe_ebd` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.contas_pagar
CREATE TABLE IF NOT EXISTS `contas_pagar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `val_pagar` decimal(10,2) NOT NULL,
  `dt_vencimento` date NOT NULL,
  `status_conta` varchar(50) NOT NULL,
  `id_congregacao` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1congregacao_contaspagar` (`id_congregacao`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `FK1congregacao_contaspagar` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.contas_pagar: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `contas_pagar` DISABLE KEYS */;
INSERT INTO `contas_pagar` (`id`, `descricao`, `val_pagar`, `dt_vencimento`, `status_conta`, `id_congregacao`, `account_id`, `created_at`, `updated_at`) VALUES
	(1, 'Posto de gasolina Zé Meireles', 1300.00, '2018-09-20', 'Em aberto', 5, 2, '2018-09-12 01:31:32', '2018-09-12 01:32:15'),
	(2, 'Diária da pousada do cantor da festividade', 265.00, '2018-09-02', 'Pago', 5, 2, '2018-09-12 01:33:30', '2018-09-12 01:36:55');
/*!40000 ALTER TABLE `contas_pagar` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.departamento_classe_ebd
CREATE TABLE IF NOT EXISTS `departamento_classe_ebd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `idade_min` int(11) DEFAULT NULL,
  `idade_max` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_account_id_departamentoebd` (`account_id`),
  CONSTRAINT `FK1_account_id_departamentoebd` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.departamento_classe_ebd: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `departamento_classe_ebd` DISABLE KEYS */;
INSERT INTO `departamento_classe_ebd` (`id`, `nome`, `idade_min`, `idade_max`, `account_id`, `created_at`, `updated_at`) VALUES
	(1, 'ROL DE BERçO', 0, 3, 2, '2018-10-03 08:19:26', '2018-10-03 08:19:26'),
	(2, 'JARDIM DE INFâNCIA', 4, 6, 2, '2018-10-03 08:33:39', '2018-10-03 08:33:39'),
	(3, 'PRIMáRIO', 7, 9, 2, '2018-10-03 08:34:04', '2018-10-03 08:34:04'),
	(4, 'JUNIORES', 10, 12, 2, '2018-10-03 08:37:32', '2018-10-03 09:22:21'),
	(5, 'ADOLESCENTES', 13, 15, 2, '2018-10-03 08:37:47', '2018-10-03 08:37:47'),
	(6, 'JOVENS', 16, 25, 2, '2018-10-03 08:38:02', '2018-10-03 08:38:02'),
	(7, 'ADULTOS', 25, NULL, 2, '2018-10-03 08:38:32', '2018-10-03 08:38:32');
/*!40000 ALTER TABLE `departamento_classe_ebd` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.dizimos
CREATE TABLE IF NOT EXISTS `dizimos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_congregacao` int(11) DEFAULT NULL,
  `id_membro` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `dt_dizimo` date NOT NULL,
  `val_dizimo` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_congregacao` (`id_congregacao`),
  KEY `FK2_membro` (`id_membro`),
  KEY `FK_dizimos_accounts` (`account_id`),
  CONSTRAINT `FK1_congregacao` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `FK2_membro` FOREIGN KEY (`id_membro`) REFERENCES `membros` (`id`),
  CONSTRAINT `FK_dizimos_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.dizimos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `dizimos` DISABLE KEYS */;
INSERT INTO `dizimos` (`id`, `id_congregacao`, `id_membro`, `account_id`, `dt_dizimo`, `val_dizimo`, `created_at`, `updated_at`) VALUES
	(1, 5, 9, 2, '2018-09-09', 565.00, '2018-09-12 00:38:23', '2018-09-12 01:14:36'),
	(2, 5, 9, 2, '2018-08-02', 550.00, '2018-09-12 01:57:22', '2018-09-12 01:57:22'),
	(3, 5, 13, 2, '2018-09-16', 290.00, '2018-09-16 23:20:35', '2018-09-16 23:20:35');
/*!40000 ALTER TABLE `dizimos` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.endereco_membros
CREATE TABLE IF NOT EXISTS `endereco_membros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(50) DEFAULT NULL,
  `logradouro` varchar(150) NOT NULL,
  `nro` int(11) NOT NULL,
  `bairro` varchar(70) NOT NULL,
  `complemento` varchar(250) DEFAULT NULL,
  `cidade` varchar(150) NOT NULL,
  `uf` varchar(150) NOT NULL,
  `id_membro` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_endereco_membro_membros` (`id_membro`),
  KEY `FK_endereco_membros_accounts` (`account_id`),
  CONSTRAINT `FK_endereco_membro_membros` FOREIGN KEY (`id_membro`) REFERENCES `membros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_endereco_membros_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.endereco_membros: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_membros` DISABLE KEYS */;
INSERT INTO `endereco_membros` (`id`, `cep`, `logradouro`, `nro`, `bairro`, `complemento`, `cidade`, `uf`, `id_membro`, `account_id`, `created_at`, `updated_at`) VALUES
	(8, '44500000', 'Urbis 2, caminho I', 508, 'Nova Castro Alves', NULL, 'Castro Alves', 'BA', 9, 2, '2018-09-03 23:44:39', '2018-09-03 23:44:39'),
	(9, '44500000', 'Rua alameda', 24, 'Centro', 'Povoado do Morro Praça', 'Castro Alves', 'BA', 10, 2, '2018-09-04 00:45:46', '2018-09-13 21:02:29'),
	(12, '44500000', 'Rua das Flores', 52, 'Centro', NULL, 'Castro Alves', 'BA', 13, 2, '2018-09-04 01:13:06', '2018-09-04 01:13:06'),
	(13, '41525023', 'Centro', 20, 'Tapimirim', NULL, 'Senhor do Bonfim', 'BA', 14, 1, '2018-09-13 01:08:14', NULL);
/*!40000 ALTER TABLE `endereco_membros` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.entradas
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `val_entrada` decimal(10,2) NOT NULL,
  `tp_entrada` int(11) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `id_dizimo` int(11) DEFAULT NULL,
  `id_oferta` int(11) DEFAULT NULL,
  `id_congregacao` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `dt_entrada` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_dizimo` (`id_dizimo`),
  KEY `FK2_oferta` (`id_oferta`),
  KEY `FK3_congregacao` (`id_congregacao`),
  KEY `FK4_tp_entrada_fk` (`tp_entrada`),
  KEY `account_id_FK` (`account_id`),
  CONSTRAINT `FK1_dizimo` FOREIGN KEY (`id_dizimo`) REFERENCES `dizimos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK2_oferta` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK3_congregacao` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `FK4_tp_entrada_fk` FOREIGN KEY (`tp_entrada`) REFERENCES `tipo_entradas` (`id`),
  CONSTRAINT `account_id_FK` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.entradas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
INSERT INTO `entradas` (`id`, `val_entrada`, `tp_entrada`, `descricao`, `id_dizimo`, `id_oferta`, `id_congregacao`, `account_id`, `dt_entrada`, `created_at`, `updated_at`) VALUES
	(4, 295.00, 6, NULL, NULL, 6, 5, 2, '2018-09-10', '2018-09-12 00:28:14', '2018-09-12 01:12:14'),
	(5, 565.00, 5, NULL, 1, NULL, 5, 2, '2018-09-09', '2018-09-12 00:38:23', '2018-09-12 01:14:36'),
	(6, 2250.00, 7, 'Doação feita pela prefeitura', NULL, NULL, 5, 2, '2018-09-01', '2018-09-12 00:55:26', '2018-09-12 00:58:11'),
	(7, 550.00, 5, NULL, 2, NULL, 5, 2, '2018-08-02', '2018-09-12 01:57:22', '2018-09-12 01:57:22'),
	(8, 86.00, 6, NULL, NULL, 7, 6, 2, '2018-09-12', '2018-09-15 13:54:52', '2018-09-15 13:54:52'),
	(9, 290.00, 5, NULL, 3, NULL, 5, 2, '2018-09-16', '2018-09-16 23:20:35', '2018-09-16 23:20:35');
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.ficha_ministerial
CREATE TABLE IF NOT EXISTS `ficha_ministerial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membro_ministerio` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `experiencias_campo` varchar(150) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_account_id_ficha` (`account_id`),
  KEY `FK2_membro_ministerio_ficha` (`id_membro_ministerio`),
  CONSTRAINT `FK1_account_id_ficha` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `FK2_membro_ministerio_ficha` FOREIGN KEY (`id_membro_ministerio`) REFERENCES `membros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.ficha_ministerial: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `ficha_ministerial` DISABLE KEYS */;
INSERT INTO `ficha_ministerial` (`id`, `id_membro_ministerio`, `account_id`, `experiencias_campo`, `observacao`, `created_at`, `updated_at`) VALUES
	(2, 10, 2, 'Foi lider dos jovens', 'Liderança do grupo dos Jovens em Castro Alves', '2018-09-16 21:15:28', '2018-09-16 21:15:28'),
	(3, 10, 2, 'Responsável pelo culto das causas impossíveis', NULL, '2018-09-16 21:18:49', '2018-09-16 21:18:49');
/*!40000 ALTER TABLE `ficha_ministerial` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_grupo` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_grupos_accounts` (`account_id`),
  CONSTRAINT `FK_grupos_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.grupos: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` (`id`, `nome_grupo`, `created_at`, `updated_at`, `account_id`) VALUES
	(6, 'SENHORAS', NULL, NULL, 2),
	(7, 'SENHORES', NULL, NULL, 2),
	(8, 'CRIANÇAS', NULL, NULL, 2),
	(9, 'JOVENS', NULL, NULL, 2),
	(10, 'ADOLESCENTE', NULL, NULL, 2),
	(11, 'NOVOS CONVERTIDOS', NULL, NULL, 2),
	(12, 'JOVENS', '2018-09-13 02:33:50', '2018-09-13 02:35:34', 1);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.igreja_congregacoes
CREATE TABLE IF NOT EXISTS `igreja_congregacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_igreja` varchar(250) NOT NULL,
  `nome_curto` varchar(100) DEFAULT NULL,
  `descricao` varchar(70) DEFAULT NULL,
  `logradouro` varchar(200) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `nro` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(50) NOT NULL,
  `tp_igreja` char(2) DEFAULT NULL,
  `id_responsavel` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_igreja_congregacoes_membros` (`id_responsavel`),
  KEY `FK2_account_id_ic` (`account_id`),
  CONSTRAINT `FK2_account_id_ic` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `FK_igreja_congregacoes_membros` FOREIGN KEY (`id_responsavel`) REFERENCES `membros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.igreja_congregacoes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `igreja_congregacoes` DISABLE KEYS */;
INSERT INTO `igreja_congregacoes` (`id`, `nome_igreja`, `nome_curto`, `descricao`, `logradouro`, `cep`, `nro`, `bairro`, `cidade`, `uf`, `tp_igreja`, `id_responsavel`, `account_id`, `created_at`, `updated_at`) VALUES
	(5, 'Assembleia de Deus de Castro Alves', 'ADECA', NULL, 'Rua do banheiro', '44500000', 58, 'centro', 'Castro Alves', 'BA', 's', NULL, 2, '2018-09-03 23:42:57', '2018-09-03 23:42:57'),
	(6, 'ADECA Morro', 'ADECA', 'Congregação do Morro', 'praça do morro', '44500000', 509, 'Centro', 'Castro Alves', 'BA', 'c', NULL, 2, '2018-09-04 00:41:39', '2018-09-04 00:41:39'),
	(7, 'Assembleia de Deus de Senhor do Bonfim', 'ADESB', 'Sede', 'centro', '44522628', 20, 'centro', 'Senhor do Bonfim', 'BA', 's', NULL, 1, NULL, NULL);
/*!40000 ALTER TABLE `igreja_congregacoes` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.membros
CREATE TABLE IF NOT EXISTS `membros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(50) DEFAULT NULL,
  `nome` varchar(250) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `flag_membro` varchar(50) NOT NULL,
  `igreja_anterior_it` varchar(150) DEFAULT NULL,
  `nome_pastor_it` varchar(150) DEFAULT NULL,
  `tp_membros` int(11) DEFAULT NULL,
  `id_congregacao` int(11) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `id_membro_oficio` int(11) DEFAULT NULL,
  `id_classe_ebd` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `situacao` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_membros_tipo_membros` (`tp_membros`),
  KEY `FK2_id_congregacao` (`id_congregacao`),
  KEY `FK3_grupo` (`id_grupo`),
  KEY `FK4_membro_oficial` (`id_membro_oficio`),
  KEY `FK_membros_accounts` (`account_id`),
  KEY `FK_classe_ebd_aluno` (`id_classe_ebd`),
  CONSTRAINT `FK2_id_congregacao` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `FK3_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`),
  CONSTRAINT `FK4_membro_oficial` FOREIGN KEY (`id_membro_oficio`) REFERENCES `membros_oficiais` (`id`),
  CONSTRAINT `FK_classe_ebd_aluno` FOREIGN KEY (`id_classe_ebd`) REFERENCES `classe_ebd` (`id`),
  CONSTRAINT `FK_membros_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `FK_membros_tipo_membros` FOREIGN KEY (`tp_membros`) REFERENCES `tipo_membros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.membros: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `membros` DISABLE KEYS */;
INSERT INTO `membros` (`id`, `matricula`, `nome`, `sexo`, `dt_nascimento`, `telefone`, `celular`, `flag_membro`, `igreja_anterior_it`, `nome_pastor_it`, `tp_membros`, `id_congregacao`, `id_grupo`, `id_membro_oficio`, `id_classe_ebd`, `account_id`, `situacao`, `created_at`, `updated_at`) VALUES
	(9, '1050', 'Felipe Gonçalves Silva Conceição', 'Masculino', '1994-10-29', NULL, '75981256337', 'Batismo', NULL, NULL, 10, 5, NULL, 12, NULL, 2, 'Ativo', '2018-09-13 21:53:59', '2018-09-13 21:53:59'),
	(10, '1051', 'Eliseu Souza Bastos Almeida', 'Masculino', '1960-10-23', NULL, '75981233417', 'Batismo', NULL, NULL, 12, 6, NULL, 7, NULL, 2, 'Ativo', '2018-09-16 19:49:31', '2018-09-16 19:49:31'),
	(13, NULL, 'Andre Masculino Dultra', 'Masculino', '1995-01-19', NULL, '75983242526', 'Batismo', NULL, NULL, 12, 5, 9, 8, NULL, 2, 'Ativo', '2018-09-16 23:42:24', '2018-09-16 23:42:24'),
	(14, NULL, 'Carlos José Santos', 'Masculino', '1995-09-13', NULL, '75981263525', 'Batismo', NULL, NULL, 10, 7, 9, NULL, NULL, 1, 'Ativo', '2018-09-13 04:24:17', NULL);
/*!40000 ALTER TABLE `membros` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.membros_oficiais
CREATE TABLE IF NOT EXISTS `membros_oficiais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_oficial` varchar(150) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id_FK_mo` (`account_id`),
  CONSTRAINT `account_id_FK_mo` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.membros_oficiais: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `membros_oficiais` DISABLE KEYS */;
INSERT INTO `membros_oficiais` (`id`, `cargo_oficial`, `account_id`, `created_at`, `updated_at`) VALUES
	(4, 'PASTOR(A) PRESIDENTE', 2, NULL, NULL),
	(5, 'PASTOR(A) AUXILIAR', 2, NULL, NULL),
	(6, 'EVANGELISTA', 2, NULL, NULL),
	(7, 'PRESBÍTERO', 2, NULL, NULL),
	(8, 'DIÁCONO', 2, NULL, NULL),
	(9, 'MISSIONÁRIO(A)', 2, NULL, NULL),
	(10, 'AUXILIARr(A)', 2, NULL, NULL),
	(11, 'PORTEIRO(A)', 2, NULL, NULL),
	(12, 'LEVITA', 2, NULL, NULL),
	(13, 'DIRIGENTE CíRCULO DE ORAçãO', 2, NULL, NULL),
	(14, 'TESOUREIRO', 2, '2018-09-08 10:03:38', '2018-09-08 10:03:38');
/*!40000 ALTER TABLE `membros_oficiais` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.membro_congregacoes
CREATE TABLE IF NOT EXISTS `membro_congregacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membro` int(11) NOT NULL,
  `id_congregacao` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_membro_congregacao_membros` (`id_membro`),
  KEY `FK2membro_congregacao_congregacao` (`id_congregacao`),
  KEY `FK3_account_id_mc` (`account_id`),
  CONSTRAINT `FK2membro_congregacao_congregacao` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `FK3_account_id_mc` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `FK_membro_congregacao_membros` FOREIGN KEY (`id_membro`) REFERENCES `membros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.membro_congregacoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `membro_congregacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `membro_congregacoes` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela gie_test_desenv.migrations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.ofertas
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_congregacao` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `dt_oferta` date NOT NULL,
  `val_oferta` decimal(10,2) NOT NULL DEFAULT '0.00',
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_congregacao_oferta` (`id_congregacao`),
  KEY `FK2_account_id_ofertas` (`account_id`),
  CONSTRAINT `FK1_congregacao_oferta` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `FK2_account_id_ofertas` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.ofertas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` (`id`, `id_congregacao`, `descricao`, `dt_oferta`, `val_oferta`, `account_id`, `created_at`, `updated_at`) VALUES
	(6, 5, 'Oferta extra para cantor', '2018-09-10', 295.00, 2, '2018-09-12 00:28:14', '2018-09-12 01:12:14'),
	(7, 6, NULL, '2018-09-12', 86.00, 2, '2018-09-15 13:54:52', '2018-09-15 13:54:52');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela gie_test_desenv.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.saidas
CREATE TABLE IF NOT EXISTS `saidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tp_saida` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `id_congregacao` int(11) DEFAULT NULL,
  `val_saida` decimal(10,2) NOT NULL,
  `dt_saida` date NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_congregacao_saida` (`id_congregacao`),
  KEY `FK2_tpsaida_saida` (`tp_saida`),
  KEY `FK3_account_id_saidas` (`account_id`),
  CONSTRAINT `FK1_congregacao_saida` FOREIGN KEY (`id_congregacao`) REFERENCES `igreja_congregacoes` (`id`),
  CONSTRAINT `FK2_tpsaida_saida` FOREIGN KEY (`tp_saida`) REFERENCES `tipo_saidas` (`id`),
  CONSTRAINT `FK3_account_id_saidas` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.saidas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `saidas` DISABLE KEYS */;
INSERT INTO `saidas` (`id`, `tp_saida`, `descricao`, `id_congregacao`, `val_saida`, `dt_saida`, `account_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 'Pagamento Pastor', 5, 5900.00, '2018-09-02', 2, '2018-09-12 01:19:45', '2018-09-12 01:25:03');
/*!40000 ALTER TABLE `saidas` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.tipo_entradas
CREATE TABLE IF NOT EXISTS `tipo_entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL DEFAULT '0',
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.tipo_entradas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_entradas` DISABLE KEYS */;
INSERT INTO `tipo_entradas` (`id`, `tipo`, `account_id`) VALUES
	(5, 'DÍZIMO', NULL),
	(6, 'OFERTA', NULL),
	(7, 'DOAÇÃO', NULL),
	(8, 'OUTROS', NULL);
/*!40000 ALTER TABLE `tipo_entradas` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.tipo_membros
CREATE TABLE IF NOT EXISTS `tipo_membros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destipo` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.tipo_membros: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_membros` DISABLE KEYS */;
INSERT INTO `tipo_membros` (`id`, `destipo`, `created_at`, `updated_at`) VALUES
	(10, 'Membro(a)', NULL, NULL),
	(11, 'Congregado(a)', NULL, NULL),
	(12, 'Ministério', NULL, NULL);
/*!40000 ALTER TABLE `tipo_membros` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.tipo_saidas
CREATE TABLE IF NOT EXISTS `tipo_saidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gie_test_desenv.tipo_saidas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_saidas` DISABLE KEYS */;
INSERT INTO `tipo_saidas` (`id`, `tipo`) VALUES
	(3, 'RETIRADA'),
	(4, 'PAGAMENTO');
/*!40000 ALTER TABLE `tipo_saidas` ENABLE KEYS */;

-- Copiando estrutura para tabela gie_test_desenv.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK1` (`account_id`),
  CONSTRAINT `FK1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela gie_test_desenv.users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `account_id`, `created_at`, `updated_at`) VALUES
	(2, 'admin', 'salvandofelipe@hotmail.com', '$2y$10$19TIKgH5KKzgry7A643iOOtsJO79yb3WrU9ks45OmkMI20FjTsQ/6', '7q9HYhN5VZ3OBvOO0Is9uZVAGX6uLihro4PglZ8QXOBrv1SEKvvUcT5IRjeX', 2, '2018-09-03 21:32:34', '2018-09-03 21:32:34'),
	(3, 'Hesron Gonçalves', 'pastor@adecal.com', '$2y$10$i/tdq89rAoX8oEHhySYeIO/4uh1znjy4JX30dniH7ILaXNdGK7/rC', 'ZR9fl1h5zsI0RsKsmnqMxh2zxyg5l3G2qUl2AIzQxCQolBDqPfcsLrwnBw0W', 1, '2018-09-13 00:59:34', '2018-09-13 00:59:34'),
	(4, 'Josemiro', 'pastor@castro.com', '$2y$10$QQ3g0.3t1N/nKeqA1o7tTuyqnS3jlKwSBK5CRKM/g7xYYBszW7PBK', 'GNsXVmtSaLDFqpNJilUriwkvEBE8HrNISSRLqZ7eN78zSpOLnfn3DJcAqg2J', 2, '2018-09-13 00:59:34', '2018-09-13 00:59:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
