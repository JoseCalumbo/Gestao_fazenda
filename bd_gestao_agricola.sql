-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para bd_gestao_agricola
CREATE DATABASE IF NOT EXISTS `bd_gestao_agricola` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bd_gestao_agricola`;

-- A despejar estrutura para tabela bd_gestao_agricola.agricultores
CREATE TABLE IF NOT EXISTS `agricultores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` enum('Masculino','Feminino') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `bilhete` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_civil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone_principal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_alternativo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo','Pendente') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `agricultores_bilhete_unique` (`bilhete`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.agricultores: ~11 rows (aproximadamente)
INSERT INTO `agricultores` (`id`, `nome_completo`, `sexo`, `data_nascimento`, `bilhete`, `nif`, `estado_civil`, `foto`, `telefone_principal`, `telefone_alternativo`, `email`, `endereco`, `created_at`, `updated_at`, `estado`) VALUES
	(1, 'Bento Vuma', 'Masculino', '1996-12-18', '003927560BA030', NULL, NULL, 'agricultores/673PtJF3b1iO4UwlQ6ufMxchKn0IuxJHeJWfd5Oc.png', '+244952152517', '+244952150987', 'josecalumbo@gmail.com', 'Camama - Bairro 4 de Abril da', '2026-06-21 15:57:02', '2026-06-21 15:57:02', 'Activo'),
	(2, 'Elena Damila', 'Feminino', '1982-01-22', '000227560BA030', '000123A003', NULL, 'agricultores/tDBBSOSoF4nrfiLxic3SnlgLAEgje6fTfRHwdps1.png', '+244952152517', '+244952152517', 'elena@gmail.com', 'Viana - Bairro 4 de Abril da', '2026-06-21 15:58:31', '2026-06-21 15:59:53', 'Inactivo'),
	(4, 'Antonio Paulo', 'Masculino', '1999-12-09', '003927560BA012', '000121A003', NULL, NULL, '99277112121', '9232323221', 'antonio@gmail.com', 'Vila de Viana Rua A', '2026-06-21 16:02:43', '2026-06-21 16:02:43', 'Pendente'),
	(5, 'Salomão David', 'Masculino', '1972-11-22', '093927560BA012', NULL, NULL, 'agricultores/lNiSFsgzQYDW3g6KM23PiRwMZcHdpv7SXeShoZVe.png', '99999222111', '98332232322', 'salomão@gmail.com', 'talatona Rua 20', '2026-06-21 16:05:00', '2026-06-23 19:00:12', 'Inactivo'),
	(6, 'Santos Vicotr', 'Masculino', '2000-08-11', '000227560BA033', '010121A003', NULL, 'agricultores/niltQOmakZBlvD5TzVB7scWYpzjxVNlqJi0t3wh2.png', '+244952152517', NULL, 'victor@gmail.com', 'Camama - Bairro 4 de Abril da', '2026-06-21 16:18:27', '2026-06-21 16:18:27', 'Activo'),
	(7, 'Angelica Armindo Daniel', 'Feminino', '2002-01-01', '103927560BA012', NULL, NULL, NULL, '+241152152517', NULL, 'angelica@gmail.com', 'Renata- Bairro 4 de Abril da', '2026-06-21 16:19:54', '2026-06-23 16:37:13', 'Activo'),
	(8, 'Jose Carlos', 'Masculino', '1997-02-12', '00392756BA030', '00010A005', NULL, 'agricultores/fgrImAQu5k9QzWdoQeXsumCJhE2JoJAwKyMIg1pV.png', '+244952152517', NULL, 'josecarlos@gmail.com', 'Camama - Bairro 4 de Abril da', '2026-06-21 16:21:18', '2026-06-21 16:21:18', 'Pendente'),
	(10, 'Silva Carlos', 'Masculino', '1960-08-11', '00022750BA030', '00012A003', NULL, NULL, '+244952152517', '+244912152517', 'silva@gmail.com', 'Vaina - Bairro 4 de Abril da', '2026-06-24 01:16:11', '2026-06-24 01:16:11', 'Activo'),
	(11, 'Zacarias Xavier Tino', 'Masculino', '2000-12-09', '103927560BA0121', '000120A0022', NULL, NULL, '+244952152517', '+244952152517', 'josecalumbo@gmail.com', 'Vila da gamek - Bairro 4 de Abril da', '2026-06-24 01:17:29', '2026-06-24 01:17:29', 'Activo'),
	(12, 'Antonio Paulo', 'Masculino', '2002-06-22', '103927560882', '000120A002', NULL, NULL, '+244952152517', NULL, 'josecalumbo@gmail.com', 'Camama - Bairro 4 de Abril da', '2026-06-26 11:41:29', '2026-06-26 11:41:29', 'Activo'),
	(13, 'Dawtson Leitão', 'Masculino', '2025-03-12', '103927560LA012', '000120A002', NULL, NULL, '961896532', NULL, 'dawtson@gmail.com', 'Icole Bengo', '2026-06-26 11:59:47', '2026-06-26 11:59:47', 'Activo');

-- A despejar estrutura para tabela bd_gestao_agricola.anos_agricolas
CREATE TABLE IF NOT EXISTS `anos_agricolas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `estado` enum('iniciado','em_producao','finalizado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'iniciado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.anos_agricolas: ~1 rows (aproximadamente)
INSERT INTO `anos_agricolas` (`id`, `nome`, `data_inicio`, `data_fim`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'ano1', '2026-06-17', '2026-11-25', 'iniciado', '2026-06-22 01:11:16', '2026-07-01 09:58:21');

-- A despejar estrutura para tabela bd_gestao_agricola.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.cache: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.cache_locks: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.cooperativas
CREATE TABLE IF NOT EXISTS `cooperativas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_fundacao` date DEFAULT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `telefone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provincia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comuna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_socios` int NOT NULL DEFAULT '0',
  `principal_cultura` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_talhoes` int NOT NULL DEFAULT '0',
  `producao_estimada` decimal(12,2) NOT NULL DEFAULT '0.00',
  `area_total_cultivada` decimal(12,2) NOT NULL DEFAULT '0.00',
  `safra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio_safra` date DEFAULT NULL,
  `fim_previsto_safra` date DEFAULT NULL,
  `estado` enum('Activa','Inactiva','pendente') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cooperativas_nif_unique` (`nif`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.cooperativas: ~4 rows (aproximadamente)
INSERT INTO `cooperativas` (`id`, `nome`, `nif`, `data_fundacao`, `descricao`, `telefone`, `email`, `website`, `provincia`, `municipio`, `comuna`, `endereco`, `numero_socios`, `principal_cultura`, `numero_talhoes`, `producao_estimada`, `area_total_cultivada`, `safra`, `inicio_safra`, `fim_previsto_safra`, `estado`, `created_at`, `updated_at`, `foto`) VALUES
	(1, 'Cooperativa Capekwa', '000120B051', '2024-12-30', 'Semear angola', '+244952152511', 'capekwao@gmail.com', 'https://kapewa.com', 'Luanda', 'Viana', 'Zango 1', 'Bairro da 4 de Maio Rua A', 3, 'Milho', 60, 30.00, 300.00, NULL, NULL, NULL, 'Activa', '2026-06-21 16:10:20', '2026-07-03 20:23:23', 'cooperativas/hSTQY6PDUZ5iD3Nu176X4b5yKldlBXL2IX64yDdH.png'),
	(2, 'Cooperação Nova Semente', '000120A012', '2026-06-08', NULL, '+244952152517', 'sementenovoo@gmail.com', 'https://sementenovayala.com', 'Luanda', 'Viana', 'Vila Nova', 'Bairro Vila nova 4 de Abril da', 23, 'Mandioca', 10, 32.30, 22.00, NULL, NULL, NULL, 'Activa', '2026-06-21 16:14:55', '2026-07-03 19:45:05', 'cooperativas/hmTBqxaDt38FW2u087jt888O47spd9tsnAbN2HoZ.png'),
	(4, 'Cooperação Pingo Verde', '000120A001', NULL, NULL, '+244952152517', 'josecalumbo@gmail.com', NULL, 'Luanda', 'Vila de Viana Norte', NULL, 'Camama - Bairro 4 de Abril da', 0, NULL, 0, 0.00, 0.00, NULL, NULL, NULL, 'Activa', '2026-06-21 16:43:29', '2026-06-26 08:11:14', NULL),
	(6, 'Cooperativa Nova aliança', '000120A003', '2019-12-22', 'aa', '+244952152517', 'novaalianca@gmail.com', NULL, 'Bengo', 'Vila de Viana Norte', 'Zango 2', 'Zango Bairro 4 de Maio', 11, 'Café', 12, 12.00, 12.00, NULL, NULL, NULL, 'pendente', '2026-06-30 16:09:38', '2026-06-30 16:10:18', NULL);

-- A despejar estrutura para tabela bd_gestao_agricola.cooperativa_membros
CREATE TABLE IF NOT EXISTS `cooperativa_membros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cooperativa_id` bigint unsigned NOT NULL,
  `agricultor_id` bigint unsigned NOT NULL,
  `cargo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperativa_membros_cooperativa_id_foreign` (`cooperativa_id`),
  KEY `cooperativa_membros_agricultor_id_foreign` (`agricultor_id`),
  CONSTRAINT `cooperativa_membros_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cooperativa_membros_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.cooperativa_membros: ~7 rows (aproximadamente)
INSERT INTO `cooperativa_membros` (`id`, `cooperativa_id`, `agricultor_id`, `cargo`, `activo`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 'Nenhum', 1, '2026-06-21 16:16:29', '2026-07-03 20:23:23'),
	(2, 1, 6, 'Nenhum', 1, '2026-06-21 16:18:27', '2026-07-03 20:23:23'),
	(3, 2, 7, 'Nenhum', 1, '2026-06-21 16:19:54', '2026-07-03 19:45:05'),
	(4, 2, 8, 'Nenhum', 1, '2026-06-21 16:21:18', '2026-07-03 19:45:05'),
	(5, 2, 5, 'Nenhum', 1, '2026-06-21 16:22:53', '2026-07-03 19:45:05'),
	(8, 4, 2, 'Nenhum', 1, '2026-06-24 01:30:08', '2026-06-26 08:11:14'),
	(10, 4, 13, 'Sem Cargo', 1, '2026-06-26 12:00:23', '2026-06-26 12:00:23');

-- A despejar estrutura para tabela bd_gestao_agricola.culturas
CREATE TABLE IF NOT EXISTS `culturas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `variedade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciclo_dias` int DEFAULT NULL,
  `tipo_unidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KG',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.culturas: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.failed_jobs: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.historico_estoques
CREATE TABLE IF NOT EXISTS `historico_estoques` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cooperativa_id` bigint unsigned NOT NULL,
  `insumo_id` bigint unsigned DEFAULT NULL,
  `agricultor_id` bigint unsigned DEFAULT NULL,
  `movimento_id` bigint unsigned DEFAULT NULL,
  `tipo_movimento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `stock_anterior` decimal(10,2) NOT NULL,
  `stock_atual` decimal(10,2) NOT NULL,
  `utilizador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sistema',
  `observacao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historico_estoques_cooperativa_id_foreign` (`cooperativa_id`),
  KEY `historico_estoques_insumo_id_foreign` (`insumo_id`),
  KEY `historico_estoques_agricultor_id_foreign` (`agricultor_id`),
  CONSTRAINT `historico_estoques_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE SET NULL,
  CONSTRAINT `historico_estoques_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historico_estoques_insumo_id_foreign` FOREIGN KEY (`insumo_id`) REFERENCES `insumos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.historico_estoques: ~17 rows (aproximadamente)
INSERT INTO `historico_estoques` (`id`, `cooperativa_id`, `insumo_id`, `agricultor_id`, `movimento_id`, `tipo_movimento`, `quantidade`, `stock_anterior`, `stock_atual`, `utilizador`, `observacao`, `created_at`, `updated_at`) VALUES
	(1, 2, NULL, NULL, NULL, 'Entrada', 100.00, 0.00, 100.00, 'Admin SIAG', 'Cadastro inicial do insumo no sistema com estoque zerado.', '2026-06-21 16:48:01', '2026-06-21 16:48:01'),
	(2, 2, 2, NULL, NULL, 'Entrada', 3000.00, 0.00, 3000.00, 'Admin SIAG', 'Cadastro inicial do insumo no sistema com estoque zerado.', '2026-06-21 16:55:33', '2026-06-21 16:55:33'),
	(3, 2, 2, 8, 2, 'Atualização', 10.00, 2960.00, 2960.00, 'Admin SIAG', 'Saída atualizada (Quantidade antiga: 10.00 -> Nova: 10).', '2026-06-21 17:31:49', '2026-06-21 17:31:49'),
	(4, 2, 2, 8, 2, 'Atualização', 10.00, 2960.00, 2960.00, 'Admin SIAG', 'Saída atualizada (Quantidade antiga: 10.00 -> Nova: 10).', '2026-06-21 17:33:45', '2026-06-21 17:33:45'),
	(5, 2, 2, 7, 1, 'Atualização', 8.00, 2960.00, 2960.00, 'Admin SIAG', 'Saída atualizada (Quantidade antiga: 8.00 -> Nova: 8).', '2026-06-21 17:43:37', '2026-06-21 17:43:37'),
	(6, 2, NULL, NULL, NULL, 'Remoção', 0.00, 0.00, 0.00, 'Admin SIAG', 'Insumo \'Catana\' removido do sistema com saldo final de 0.00.', '2026-06-21 17:45:01', '2026-06-21 17:45:01'),
	(7, 2, 3, NULL, NULL, 'Entrada', 30.00, 0.00, 30.00, 'Admin SIAG', 'Cadastro inicial do insumo no sistema com estoque zerado.', '2026-06-21 17:46:25', '2026-06-21 17:46:25'),
	(8, 2, 3, 7, 8, 'Saída', 2.00, 26.00, 24.00, 'Admin SIAG', 'Movimentação de saída registada (Crédito).', '2026-06-21 17:58:01', '2026-06-21 17:58:01'),
	(9, 2, 4, NULL, NULL, 'Entrada', 50.00, 0.00, 50.00, 'Admin SIAG', 'Cadastro inicial do insumo no sistema com estoque zerado.', '2026-06-22 13:33:04', '2026-06-22 13:33:04'),
	(10, 2, 4, 5, 9, 'Saída', 5.00, 50.00, 45.00, 'Admin SIAG', 'Movimentação de saída registada (Oferta).', '2026-06-22 13:34:20', '2026-06-22 13:34:20'),
	(11, 2, 4, 8, 10, 'Saída', 40.00, 45.00, 5.00, 'Admin SIAG', 'Movimentação de saída registada (Vendido).', '2026-06-22 13:36:07', '2026-06-22 13:36:07'),
	(12, 2, 5, NULL, NULL, 'Entrada', 50.00, 0.00, 50.00, 'Admin SIAG', 'Cadastro inicial do insumo no sistema com estoque zerado.', '2026-06-26 00:46:15', '2026-06-26 00:46:15'),
	(13, 4, 6, NULL, NULL, 'Entrada', 300.00, 0.00, 300.00, 'Admin SIAG', 'Cadastro inicial do insumo no sistema com estoque zerado.', '2026-06-26 12:02:07', '2026-06-26 12:02:07'),
	(14, 4, 6, 13, 11, 'Saída', 10.00, 300.00, 290.00, 'Admin SIAG', 'Movimentação de saída registada (Oferta).', '2026-06-26 12:03:51', '2026-06-26 12:03:51'),
	(15, 2, NULL, NULL, NULL, 'Entrada', 5.00, 0.00, 5.00, 'Admin SIAG', 'Cadastro inicial do insumo no sistema com estoque zerado.', '2026-07-01 03:19:33', '2026-07-01 03:19:33'),
	(16, 2, NULL, NULL, NULL, 'Atualização', 0.00, 5.00, 5.00, 'Admin SIAG', 'Dados cadastrais do insumo atualizados no sistema.', '2026-07-01 03:20:05', '2026-07-01 03:20:05'),
	(17, 2, NULL, NULL, NULL, 'Remoção', 0.00, 5.00, 0.00, 'Admin SIAG', 'Insumo \'Carro de mão1\' removido do sistema com saldo final de 5.00.', '2026-07-01 03:20:10', '2026-07-01 03:20:10');

-- A despejar estrutura para tabela bd_gestao_agricola.insumos
CREATE TABLE IF NOT EXISTS `insumos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cooperativa_id` bigint unsigned DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tipo` enum('fertilizante','semente','mecanico','pesticida','outro') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` decimal(15,2) NOT NULL DEFAULT '0.00',
  `stock_minimo` decimal(15,2) NOT NULL DEFAULT '0.00',
  `unidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_unitario` decimal(15,2) NOT NULL,
  `estado` enum('ativo','desativado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insumos_cooperativa_id_foreign` (`cooperativa_id`),
  CONSTRAINT `insumos_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.insumos: ~5 rows (aproximadamente)
INSERT INTO `insumos` (`id`, `cooperativa_id`, `nome`, `descricao`, `tipo`, `quantidade`, `stock_minimo`, `unidade`, `preco_unitario`, `estado`, `created_at`, `updated_at`) VALUES
	(2, 2, 'Verniz Semente', '100% puro', 'semente', 2948.00, 200.00, 'kg', 3000.00, 'ativo', '2026-06-21 16:55:33', '2026-06-21 17:54:31'),
	(3, 2, 'Trator V6', 'trator de carga', 'mecanico', 24.00, 1.00, 'unidade', 1002.00, 'ativo', '2026-06-21 17:46:25', '2026-06-21 17:58:01'),
	(4, 2, 'Carro de mão', 'carregar  produtos', 'mecanico', 5.00, 10.00, 'Unidade', 500.00, 'ativo', '2026-06-22 13:33:04', '2026-06-22 13:36:07'),
	(5, 2, 'Ureia 45%', 'Super natural para cresciemto de legumes', 'fertilizante', 50.00, 5.00, 'kg', 200.00, 'ativo', '2026-06-26 00:46:15', '2026-06-26 00:46:15'),
	(6, 4, 'Enxada', 'enxada pessoal', 'mecanico', 290.00, 20.00, 'Unidade', 3000.00, 'ativo', '2026-06-26 12:02:07', '2026-06-26 12:03:51');

-- A despejar estrutura para tabela bd_gestao_agricola.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.jobs: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.job_batches: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.migrations: ~29 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_06_04_225717_add_foto_to_users_table', 1),
	(5, '2026_06_06_184134_update_users_table', 1),
	(6, '2026_06_11_230112_create_anos_agricolas_table', 1),
	(7, '2026_06_12_154437_create_agricultores_table', 1),
	(8, '2026_06_13_021249_add_estado_to_agricultores_table', 1),
	(9, '2026_06_13_083007_create_insumos_table', 1),
	(10, '2026_06_15_135746_create_cooperativas_table', 1),
	(11, '2026_06_16_160325_create_cooperativa_membros_table', 1),
	(12, '2026_06_19_191255_create_talhoes_table', 1),
	(13, '2026_06_20_194309_add_cooperativa_id_to_insumos_table', 1),
	(14, '2026_06_21_031553_create_movimento_insumos_table', 1),
	(15, '2026_06_21_154424_create_historico_estoques_table', 1),
	(16, '2026_06_21_173227_alter_foto_nullable_in_cooperativas_table', 2),
	(17, '2026_06_21_174656_remove_data_entrada_from_insumos_table', 3),
	(18, '2026_06_22_075510_create_safras_table', 4),
	(19, '2026_06_22_081259_add_safra_actual_to_safras_table', 5),
	(20, '2026_06_22_103646_create_vendas_table', 6),
	(21, '2026_06_22_103650_create_produtos_table', 7),
	(22, '2026_06_22_103706_create_venda_items_table', 8),
	(23, '2026_06_22_110000_add_estado_to_vendas_table', 8),
	(24, '2026_06_22_105236_create_produtos_table', 9),
	(25, '2026_06_22_105237_create_venda_itens_table', 9),
	(26, '2026_06_23_095744_add_cooperativa_id_to_talhoes_table', 9),
	(27, '2026_06_24_110056_create_culturas_table', 10),
	(28, '2026_06_24_161654_add_quantidade_minima_and_descricao_to_produtos_table', 11),
	(29, '2026_06_25_184508_alter_produto_id_in_venda_itens_table', 12);

-- A despejar estrutura para tabela bd_gestao_agricola.movimento_insumos
CREATE TABLE IF NOT EXISTS `movimento_insumos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cooperativa_id` bigint unsigned NOT NULL,
  `insumo_id` bigint unsigned NOT NULL,
  `agricultor_id` bigint unsigned DEFAULT NULL,
  `tipo` enum('entrada','saida') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `modalidade` enum('vendido','oferta','distribuicao','credito','troca') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('pago','pendente','oferecido','liquidado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movimento_insumos_cooperativa_id_foreign` (`cooperativa_id`),
  KEY `movimento_insumos_insumo_id_foreign` (`insumo_id`),
  KEY `movimento_insumos_agricultor_id_foreign` (`agricultor_id`),
  CONSTRAINT `movimento_insumos_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE SET NULL,
  CONSTRAINT `movimento_insumos_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `movimento_insumos_insumo_id_foreign` FOREIGN KEY (`insumo_id`) REFERENCES `insumos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.movimento_insumos: ~11 rows (aproximadamente)
INSERT INTO `movimento_insumos` (`id`, `cooperativa_id`, `insumo_id`, `agricultor_id`, `tipo`, `quantidade`, `modalidade`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 2, 2, 7, 'saida', 8.00, 'vendido', 'liquidado', '2026-06-21 17:03:40', '2026-06-21 17:43:37'),
	(2, 2, 2, 8, 'saida', 10.00, 'oferta', 'oferecido', '2026-06-21 17:08:54', '2026-06-21 17:33:45'),
	(3, 2, 2, 7, 'saida', 11.00, 'troca', 'oferecido', '2026-06-21 17:12:01', '2026-06-21 17:12:01'),
	(4, 2, 2, 5, 'saida', 11.00, 'credito', 'pago', '2026-06-21 17:13:10', '2026-06-21 17:13:10'),
	(5, 2, 3, 8, 'saida', 2.00, 'oferta', 'liquidado', '2026-06-21 17:46:52', '2026-06-21 17:46:52'),
	(6, 2, 3, 5, 'saida', 2.00, 'vendido', 'pago', '2026-06-21 17:53:12', '2026-06-21 17:53:12'),
	(7, 2, 2, 8, 'saida', 12.00, 'oferta', 'oferecido', '2026-06-21 17:54:31', '2026-06-21 17:54:31'),
	(8, 2, 3, 7, 'saida', 2.00, 'credito', 'liquidado', '2026-06-21 17:58:01', '2026-06-21 17:58:01'),
	(9, 2, 4, 5, 'saida', 5.00, 'oferta', 'oferecido', '2026-06-22 13:34:20', '2026-06-22 13:34:20'),
	(10, 2, 4, 8, 'saida', 40.00, 'vendido', 'pago', '2026-06-22 13:36:07', '2026-06-22 13:36:07'),
	(11, 4, 6, 13, 'saida', 10.00, 'oferta', 'oferecido', '2026-06-26 12:03:51', '2026-06-26 12:03:51');

-- A despejar estrutura para tabela bd_gestao_agricola.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.password_reset_tokens: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cooperativa_id` bigint unsigned NOT NULL,
  `agricultor_id` bigint unsigned NOT NULL,
  `talhao_id` bigint unsigned NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantidade` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantidade_minima` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unidade` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponivel',
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_cooperativa_id_foreign` (`cooperativa_id`),
  KEY `produtos_agricultor_id_foreign` (`agricultor_id`),
  KEY `produtos_talhao_id_foreign` (`talhao_id`),
  CONSTRAINT `produtos_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produtos_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produtos_talhao_id_foreign` FOREIGN KEY (`talhao_id`) REFERENCES `talhoes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.produtos: ~6 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `cooperativa_id`, `agricultor_id`, `talhao_id`, `nome`, `categoria`, `quantidade`, `quantidade_minima`, `unidade`, `preco_venda`, `estado`, `descricao`, `created_at`, `updated_at`) VALUES
	(4, 2, 8, 11, 'Cebola Rosa', 'Legumes', 185.00, 30.00, 'saco', 200.00, 'disponivel', 'Cebola branca', '2026-06-24 15:41:25', '2026-07-01 10:41:49'),
	(7, 2, 5, 7, 'Manga', 'Frutas', 42.00, 5.00, 'Caixa', 5000.00, 'disponivel', 'Manga amarela', '2026-06-25 16:09:28', '2026-06-26 12:11:51'),
	(8, 2, 5, 6, 'Banana Pão', 'Frutas', 58.00, 5.00, 'Caixa', 3000.00, 'disponivel', 'Banana pão 15kg', '2026-06-25 16:11:09', '2026-06-26 12:11:51'),
	(10, 2, 7, 1, 'Brócolos', 'Hortícolas', 0.00, 3.00, 'saco', 1000.00, 'esgotado', 'Brócolos', '2026-06-25 16:53:33', '2026-06-25 18:11:21'),
	(11, 1, 4, 13, 'Cafe', 'Grãos', 286.00, 10.00, 'saco', 56.00, 'disponivel', 'cafe branco', '2026-06-26 07:34:48', '2026-07-03 20:50:53'),
	(12, 1, 4, 14, 'Manga', 'Frutas', 397.00, 10.00, 'Caixa', 1000.00, 'disponivel', 'Manga amarela', '2026-07-03 20:12:06', '2026-07-03 20:50:53');

-- A despejar estrutura para tabela bd_gestao_agricola.safras
CREATE TABLE IF NOT EXISTS `safras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cooperativa_id` bigint unsigned NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `estado` enum('Planeada','Activa','Encerrada') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Planeada',
  `safra_actual` tinyint(1) NOT NULL DEFAULT '0',
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `safras_cooperativa_id_foreign` (`cooperativa_id`),
  CONSTRAINT `safras_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.safras: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela bd_gestao_agricola.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('S1vwIdq8igbuTMkXa6fdfHMUqWbgZywdYNisowHa', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIwbDJyMDFUdDYxWDVvQWpBUlZBUXlQd1RJYWpCUXdEUU5vVVlJa0MwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jb29wZXJhdGl2YXMiLCJyb3V0ZSI6ImNvb3BlcmF0aXZhcyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1783115983);

-- A despejar estrutura para tabela bd_gestao_agricola.talhoes
CREATE TABLE IF NOT EXISTS `talhoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `designacao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `cultura_actual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localizacao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('Em cultivo','Pousio','Colhido','activo','inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activo',
  `agricultor_id` bigint unsigned NOT NULL,
  `cooperativa_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `talhoes_agricultor_id_foreign` (`agricultor_id`),
  KEY `talhoes_cooperativa_id_foreign` (`cooperativa_id`),
  CONSTRAINT `talhoes_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `talhoes_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.talhoes: ~9 rows (aproximadamente)
INSERT INTO `talhoes` (`id`, `designacao`, `area`, `cultura_actual`, `localizacao`, `estado`, `agricultor_id`, `cooperativa_id`, `created_at`, `updated_at`) VALUES
	(1, 'Talhão A', 12.00, 'Mandioca', 'Sector A', 'Em cultivo', 7, 2, '2026-06-23 12:55:46', NULL),
	(2, 'Talhão B', 20.00, 'Ova', 'Sector 2 ', 'Colhido', 6, 4, '2026-06-29 16:54:54', NULL),
	(6, 'Talhão A1', 12.00, 'Café ', 'Sector A1', 'Pousio', 5, 2, NULL, NULL),
	(7, 'Talhão A32', 12.00, 'Café Conilon', 'Sector2', 'Pousio', 5, 2, NULL, '2026-06-23 20:42:39'),
	(10, 'Talhão V1', 11.00, 'Café Conilon', 'Sector A1', 'activo', 7, 2, '2026-06-23 20:47:45', '2026-06-23 20:47:45'),
	(11, 'Talhão J1', 12.00, 'Café Conilon', 'Sector A1', 'Pousio', 8, 2, '2026-06-23 22:58:53', '2026-06-23 22:58:53'),
	(12, 'Talhão E', 12.00, 'Caranbola', 'Sector B1', 'Em cultivo', 2, 4, '2026-06-25 03:14:37', '2026-06-25 03:14:37'),
	(13, 'Talhão Setor Café', 12.00, 'Café', 'Sector A1', 'Colhido', 4, 1, '2026-06-26 07:33:08', '2026-06-26 07:33:08'),
	(14, 'Talhão B', 3.00, 'Mangueira', 'Sector A3', 'Em cultivo', 4, 1, '2026-07-03 20:09:07', '2026-07-03 20:09:07');

-- A despejar estrutura para tabela bd_gestao_agricola.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nivel` enum('admin','tecnico','agricultor','gestor') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'agricultor',
  `estado` enum('activo','inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activo',
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.users: ~4 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `telefone`, `email_verified_at`, `password`, `foto`, `nivel`, `estado`, `ultimo_acesso`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin SIAG', 'admin@email.com', NULL, NULL, '$2y$12$V40LhdGepaLB7MnbRe1XS.jPCaCPwPmeJcb1EgM2/9dsGpCApgMoq', NULL, 'admin', 'activo', '2026-07-03 19:28:29', NULL, '2026-06-21 15:51:18', '2026-07-03 19:28:29'),
	(2, 'Damião Pedro', 'damiao@gmail.com', '952152517', NULL, '$2y$12$m3rTMLHOZ.zc9KrGm5nrVeBlfy6niMKPkze0/Ee7n.4tAjdK/DA6y', '1782060930_perfil5.png', 'tecnico', 'activo', '2026-06-22 06:48:48', NULL, '2026-06-21 15:55:31', '2026-06-22 13:53:33'),
	(7, 'Sara Miguel', 'saramiguel@gmail.com', '999112872', NULL, '$2y$12$XUXUiMQuTMonUAl.ceJeGuf7/kIWbhGcwzN2n7EU8jn29SPV6UCHe', '1782903395_perfil30.png', 'agricultor', 'inactivo', NULL, NULL, '2026-07-01 09:56:35', '2026-07-01 09:56:35'),
	(8, 'José Mario Abel', 'abel@gmail.com', '922111009', NULL, '$2y$12$8FtyRrD91QsDbuyPnausJe6jR8bMMU3nw1VKokIa/svAvzxTIPATS', NULL, 'gestor', 'activo', NULL, NULL, '2026-07-01 10:30:13', '2026-07-01 10:30:38');

-- A despejar estrutura para tabela bd_gestao_agricola.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cooperativa_id` bigint unsigned NOT NULL,
  `agricultor_id` bigint unsigned DEFAULT NULL,
  `data_venda` date NOT NULL,
  `cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `forma_pagamento` enum('Dinheiro','Transferencia','Multicaixa','Credito') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacoes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Pago',
  `valor_entregue` decimal(15,0) NOT NULL DEFAULT '0',
  `troco` decimal(15,0) DEFAULT '0',
  `cancelada_em` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendas_cooperativa_id_foreign` (`cooperativa_id`),
  KEY `vendas_agricultor_id_foreign` (`agricultor_id`),
  CONSTRAINT `vendas_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE SET NULL,
  CONSTRAINT `vendas_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.vendas: ~16 rows (aproximadamente)
INSERT INTO `vendas` (`id`, `cooperativa_id`, `agricultor_id`, `data_venda`, `cliente`, `valor_total`, `forma_pagamento`, `observacoes`, `status`, `valor_entregue`, `troco`, `cancelada_em`, `created_at`, `updated_at`) VALUES
	(8, 2, NULL, '2026-06-25', 'Super Mercado Diskontão', 9000.00, 'Dinheiro', NULL, 'pago', 9900, 900, NULL, '2026-06-25 15:47:45', '2026-06-25 15:47:45'),
	(9, 2, NULL, '2026-06-25', 'Super Mercado Diskontão', 1800.00, 'Dinheiro', NULL, 'pago', 1800, 0, NULL, '2026-06-25 15:54:48', '2026-06-25 15:54:48'),
	(10, 2, NULL, '2026-06-25', 'Mercado do 30', 200.00, 'Dinheiro', NULL, 'pago', 222, 22, NULL, '2026-06-25 15:55:30', '2026-06-25 15:55:30'),
	(11, 2, NULL, '2026-06-25', 'Mercado Nosso Super', 11700.00, 'Dinheiro', NULL, 'pago', 12000, 300, NULL, '2026-06-25 17:56:03', '2026-06-25 17:56:03'),
	(12, 2, NULL, '2026-06-25', 'Mercado do 30', 30000.00, 'Dinheiro', NULL, 'pago', 30000, 0, NULL, '2026-06-25 18:11:21', '2026-06-25 18:11:21'),
	(13, 2, NULL, '2026-06-25', 'Mercado de viana', 28200.00, 'Dinheiro', NULL, 'pago', 28300, 100, NULL, '2026-06-25 21:25:46', '2026-06-25 21:25:46'),
	(14, 1, NULL, '2026-06-26', 'Super Mercado Kero', 56.00, 'Transferencia', NULL, 'pago', 66, 10, NULL, '2026-06-26 07:37:09', '2026-06-26 07:37:09'),
	(15, 1, NULL, '2026-06-26', 'Mercado do trinta', 112.00, 'Dinheiro', NULL, 'pago', 120, 8, NULL, '2026-06-26 07:38:00', '2026-06-26 07:38:00'),
	(16, 1, NULL, '2026-06-26', 'Nossa Casa', 112.00, 'Dinheiro', NULL, 'pago', 130, 18, NULL, '2026-06-26 08:07:59', '2026-06-26 08:07:59'),
	(17, 1, NULL, '2026-06-26', 'Nossa Casa', 168.00, 'Dinheiro', NULL, NULL, 169, 1, NULL, '2026-06-26 08:41:30', '2026-06-26 08:41:30'),
	(18, 1, NULL, '2026-06-26', 'Nossa Casa', 168.00, 'Dinheiro', NULL, NULL, 176, 8, NULL, '2026-06-26 08:52:03', '2026-06-26 08:52:03'),
	(19, 1, NULL, '2026-06-26', 'Nossa Casa', 112.00, 'Dinheiro', NULL, NULL, 221, 109, NULL, '2026-06-26 09:06:54', '2026-06-26 09:06:54'),
	(20, 2, NULL, '2026-06-26', 'Nosso Super', 11200.00, 'Transferencia', NULL, NULL, 12000, 800, NULL, '2026-06-26 12:09:16', '2026-06-26 12:09:16'),
	(21, 2, NULL, '2026-06-26', 'Nossa Casa', 13000.00, 'Dinheiro', NULL, NULL, 120999, 107999, NULL, '2026-06-26 12:11:51', '2026-06-26 12:11:51'),
	(22, 2, NULL, '2026-07-01', 'Nossa Casa', 200.00, 'Dinheiro', NULL, NULL, 300, 100, NULL, '2026-07-01 10:41:49', '2026-07-01 10:41:49'),
	(23, 1, NULL, '2026-07-03', 'Mercado 30', 3056.00, 'Dinheiro', NULL, NULL, 3100, 44, NULL, '2026-07-03 20:50:53', '2026-07-03 20:50:53');

-- A despejar estrutura para tabela bd_gestao_agricola.venda_itens
CREATE TABLE IF NOT EXISTS `venda_itens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `venda_id` bigint unsigned NOT NULL,
  `produto_id` bigint unsigned DEFAULT NULL,
  `quantidade` decimal(12,2) NOT NULL,
  `preco_unitario` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venda_itens_venda_id_foreign` (`venda_id`),
  KEY `venda_itens_produto_id_foreign` (`produto_id`),
  CONSTRAINT `venda_itens_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `venda_itens_venda_id_foreign` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela bd_gestao_agricola.venda_itens: ~22 rows (aproximadamente)
INSERT INTO `venda_itens` (`id`, `venda_id`, `produto_id`, `quantidade`, `preco_unitario`, `subtotal`, `created_at`, `updated_at`) VALUES
	(7, 8, NULL, 3.00, 3000.00, 9000.00, '2026-06-25 15:47:45', '2026-06-25 15:47:45'),
	(8, 9, 4, 9.00, 200.00, 1800.00, '2026-06-25 15:54:48', '2026-06-25 15:54:48'),
	(9, 10, 4, 1.00, 200.00, 200.00, '2026-06-25 15:55:30', '2026-06-25 15:55:30'),
	(10, 11, NULL, 39.00, 300.00, 11700.00, '2026-06-25 17:56:03', '2026-06-25 17:56:03'),
	(11, 12, 10, 30.00, 1000.00, 30000.00, '2026-06-25 18:11:21', '2026-06-25 18:11:21'),
	(12, 13, 8, 1.00, 3000.00, 3000.00, '2026-06-25 21:25:46', '2026-06-25 21:25:46'),
	(13, 13, 7, 5.00, 5000.00, 25000.00, '2026-06-25 21:25:46', '2026-06-25 21:25:46'),
	(14, 13, 4, 1.00, 200.00, 200.00, '2026-06-25 21:25:46', '2026-06-25 21:25:46'),
	(15, 14, 11, 1.00, 56.00, 56.00, '2026-06-26 07:37:09', '2026-06-26 07:37:09'),
	(16, 15, 11, 2.00, 56.00, 112.00, '2026-06-26 07:38:00', '2026-06-26 07:38:00'),
	(17, 16, 11, 2.00, 56.00, 112.00, '2026-06-26 08:07:59', '2026-06-26 08:07:59'),
	(18, 17, 11, 3.00, 56.00, 168.00, '2026-06-26 08:41:30', '2026-06-26 08:41:30'),
	(19, 18, 11, 3.00, 56.00, 168.00, '2026-06-26 08:52:03', '2026-06-26 08:52:03'),
	(20, 19, 11, 2.00, 56.00, 112.00, '2026-06-26 09:06:54', '2026-06-26 09:06:54'),
	(21, 20, NULL, 2.00, 3000.00, 6000.00, '2026-06-26 12:09:16', '2026-06-26 12:09:16'),
	(22, 20, 7, 1.00, 5000.00, 5000.00, '2026-06-26 12:09:16', '2026-06-26 12:09:16'),
	(23, 20, 4, 1.00, 200.00, 200.00, '2026-06-26 12:09:16', '2026-06-26 12:09:16'),
	(24, 21, 8, 1.00, 3000.00, 3000.00, '2026-06-26 12:11:51', '2026-06-26 12:11:51'),
	(25, 21, 7, 2.00, 5000.00, 10000.00, '2026-06-26 12:11:51', '2026-06-26 12:11:51'),
	(26, 22, 4, 1.00, 200.00, 200.00, '2026-07-01 10:41:49', '2026-07-01 10:41:49'),
	(27, 23, 12, 3.00, 1000.00, 3000.00, '2026-07-03 20:50:53', '2026-07-03 20:50:53'),
	(28, 23, 11, 1.00, 56.00, 56.00, '2026-07-03 20:50:53', '2026-07-03 20:50:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
