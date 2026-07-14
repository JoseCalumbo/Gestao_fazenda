-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 02-Jul-2026 às 16:48
-- Versão do servidor: 8.4.3
-- versão do PHP: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dados: `bd_gestao_agricola`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agricultores`
--

CREATE TABLE `agricultores` (
  `id` bigint UNSIGNED NOT NULL,
  `nome_completo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` enum('Masculino','Feminino') COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `bilhete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_civil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone_principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_alternativo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo','Pendente') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `agricultores`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `anos_agricolas`
--

CREATE TABLE `anos_agricolas` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `estado` enum('iniciado','em_producao','finalizado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'iniciado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `anos_agricolas`
--

INSERT INTO `anos_agricolas` (`id`, `nome`, `data_inicio`, `data_fim`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ano1', '2026-06-17', '2026-11-25', 'iniciado', '2026-06-22 01:11:16', '2026-07-01 09:58:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cooperativas`
--

CREATE TABLE `cooperativas` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_fundacao` date DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comuna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_socios` int NOT NULL DEFAULT '0',
  `principal_cultura` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_talhoes` int NOT NULL DEFAULT '0',
  `producao_estimada` decimal(12,2) NOT NULL DEFAULT '0.00',
  `area_total_cultivada` decimal(12,2) NOT NULL DEFAULT '0.00',
  `safra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio_safra` date DEFAULT NULL,
  `fim_previsto_safra` date DEFAULT NULL,
  `estado` enum('Activa','Inactiva','pendente') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cooperativas`
--

INSERT INTO `cooperativas` (`id`, `nome`, `nif`, `data_fundacao`, `descricao`, `telefone`, `email`, `website`, `provincia`, `municipio`, `comuna`, `endereco`, `numero_socios`, `principal_cultura`, `numero_talhoes`, `producao_estimada`, `area_total_cultivada`, `safra`, `inicio_safra`, `fim_previsto_safra`, `estado`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'Cooperativa Capekwa', '000120B051', '2024-12-30', 'Semear angola', '+244952152511', 'capekwao@gmail.com', 'https://kapewa.com', 'Luanda', 'Viana', 'Zango 1', 'Bairro da 4 de Maio Rua A', 3, 'Milho', 60, 30.00, 300.00, NULL, NULL, NULL, 'Inactiva', '2026-06-21 16:10:20', '2026-06-29 19:06:09', 'cooperativas/6MeoDurXsW0UaF4GShCPqyWU0mF8hOsarhBRp5A8.png'),
(2, 'Cooperação Nova Semente', '000120A012', '2026-06-08', NULL, '+244952152517', 'sementenovoo@gmail.com', 'https://sementenovayala.com', 'Luanda', 'Viana', 'Vila Nova', 'Bairro Vila nova 4 de Abril da', 23, 'Mandioca', 10, 32.30, 22.00, NULL, NULL, NULL, 'Activa', '2026-06-21 16:14:55', '2026-06-26 00:09:01', 'cooperativas/6Venc2D0aatY9QgeDGAkumOzDtjbjRL2Xi4ev29H.png'),
(4, 'Cooperação Pingo Verde', '000120A001', NULL, NULL, '+244952152517', 'josecalumbo@gmail.com', NULL, 'Luanda', 'Vila de Viana Norte', NULL, 'Camama - Bairro 4 de Abril da', 0, NULL, 0, 0.00, 0.00, NULL, NULL, NULL, 'Activa', '2026-06-21 16:43:29', '2026-06-26 08:11:14', NULL),
(6, 'Cooperativa Nova aliança', '000120A003', '2019-12-22', 'aa', '+244952152517', 'novaalianca@gmail.com', NULL, 'Bengo', 'Vila de Viana Norte', 'Zango 2', 'Zango Bairro 4 de Maio', 11, 'Café', 12, 12.00, 12.00, NULL, NULL, NULL, 'pendente', '2026-06-30 16:09:38', '2026-06-30 16:10:18', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cooperativa_membros`
--

CREATE TABLE `cooperativa_membros` (
  `id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED NOT NULL,
  `agricultor_id` bigint UNSIGNED NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cooperativa_membros`
--

INSERT INTO `cooperativa_membros` (`id`, `cooperativa_id`, `agricultor_id`, `cargo`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Nenhum', 1, '2026-06-21 16:16:29', '2026-06-29 19:06:09'),
(2, 1, 6, 'Nenhum', 1, '2026-06-21 16:18:27', '2026-06-29 19:06:09'),
(3, 2, 7, 'Nenhum', 1, '2026-06-21 16:19:54', '2026-06-26 00:09:01'),
(4, 2, 8, 'Nenhum', 1, '2026-06-21 16:21:18', '2026-06-26 00:09:01'),
(5, 2, 5, 'Nenhum', 1, '2026-06-21 16:22:53', '2026-06-26 00:09:01'),
(8, 4, 2, 'Nenhum', 1, '2026-06-24 01:30:08', '2026-06-26 08:11:14'),
(10, 4, 13, 'Sem Cargo', 1, '2026-06-26 12:00:23', '2026-06-26 12:00:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `culturas`
--

CREATE TABLE `culturas` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variedade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciclo_dias` int DEFAULT NULL,
  `tipo_unidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KG',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_estoques`
--

CREATE TABLE `historico_estoques` (
  `id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED NOT NULL,
  `insumo_id` bigint UNSIGNED DEFAULT NULL,
  `agricultor_id` bigint UNSIGNED DEFAULT NULL,
  `movimento_id` bigint UNSIGNED DEFAULT NULL,
  `tipo_movimento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `stock_anterior` decimal(10,2) NOT NULL,
  `stock_atual` decimal(10,2) NOT NULL,
  `utilizador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sistema',
  `observacao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `historico_estoques`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `insumos`
--

CREATE TABLE `insumos` (
  `id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `tipo` enum('fertilizante','semente','mecanico','pesticida','outro') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` decimal(15,2) NOT NULL DEFAULT '0.00',
  `stock_minimo` decimal(15,2) NOT NULL DEFAULT '0.00',
  `unidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_unitario` decimal(15,2) NOT NULL,
  `estado` enum('ativo','desativado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `insumos`
--

INSERT INTO `insumos` (`id`, `cooperativa_id`, `nome`, `descricao`, `tipo`, `quantidade`, `stock_minimo`, `unidade`, `preco_unitario`, `estado`, `created_at`, `updated_at`) VALUES
(2, 2, 'Verniz Semente', '100% puro', 'semente', 2948.00, 200.00, 'kg', 3000.00, 'ativo', '2026-06-21 16:55:33', '2026-06-21 17:54:31'),
(3, 2, 'Trator V6', 'trator de carga', 'mecanico', 24.00, 1.00, 'unidade', 1002.00, 'ativo', '2026-06-21 17:46:25', '2026-06-21 17:58:01'),
(4, 2, 'Carro de mão', 'carregar  produtos', 'mecanico', 5.00, 10.00, 'Unidade', 500.00, 'ativo', '2026-06-22 13:33:04', '2026-06-22 13:36:07'),
(5, 2, 'Ureia 45%', 'Super natural para cresciemto de legumes', 'fertilizante', 50.00, 5.00, 'kg', 200.00, 'ativo', '2026-06-26 00:46:15', '2026-06-26 00:46:15'),
(6, 4, 'Enxada', 'enxada pessoal', 'mecanico', 290.00, 20.00, 'Unidade', 3000.00, 'ativo', '2026-06-26 12:02:07', '2026-06-26 12:03:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimento_insumos`
--

CREATE TABLE `movimento_insumos` (
  `id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED NOT NULL,
  `insumo_id` bigint UNSIGNED NOT NULL,
  `agricultor_id` bigint UNSIGNED DEFAULT NULL,
  `tipo` enum('entrada','saida') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `modalidade` enum('vendido','oferta','distribuicao','credito','troca') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('pago','pendente','oferecido','liquidado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `movimento_insumos`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED NOT NULL,
  `agricultor_id` bigint UNSIGNED NOT NULL,
  `talhao_id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantidade` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantidade_minima` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unidade` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponivel',
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `cooperativa_id`, `agricultor_id`, `talhao_id`, `nome`, `categoria`, `quantidade`, `quantidade_minima`, `unidade`, `preco_venda`, `estado`, `descricao`, `created_at`, `updated_at`) VALUES
(4, 2, 8, 11, 'Cebola Rosa', 'Legumes', 185.00, 30.00, 'saco', 200.00, 'disponivel', 'Cebola branca', '2026-06-24 15:41:25', '2026-07-01 10:41:49'),
(7, 2, 5, 7, 'Manga', 'Frutas', 42.00, 5.00, 'Caixa', 5000.00, 'disponivel', 'Manga amarela', '2026-06-25 16:09:28', '2026-06-26 12:11:51'),
(8, 2, 5, 6, 'Banana Pão', 'Frutas', 58.00, 5.00, 'Caixa', 3000.00, 'disponivel', 'Banana pão 15kg', '2026-06-25 16:11:09', '2026-06-26 12:11:51'),
(10, 2, 7, 1, 'Brócolos', 'Hortícolas', 0.00, 3.00, 'saco', 1000.00, 'esgotado', 'Brócolos', '2026-06-25 16:53:33', '2026-06-25 18:11:21'),
(11, 1, 4, 13, 'Cafe', 'Grãos', 287.00, 10.00, 'saco', 56.00, 'disponivel', 'cafe branco', '2026-06-26 07:34:48', '2026-06-26 09:06:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `safras`
--

CREATE TABLE `safras` (
  `id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `estado` enum('Planeada','Activa','Encerrada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Planeada',
  `safra_actual` tinyint(1) NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5iyQwxq5A6BDozcYUMOiG3LFnoTSyimbdKuEvZnf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJicnZKRnZJNWd4RGJhaDJqcnpEOUI3NUFjbktWUlR1TVJDbmdkWUxMIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2luc3Vtb3MiLCJyb3V0ZSI6Imluc3Vtb3MuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1783009725),
('G3HzFCliQkm874LluOMWIxQMZE0PvwP60bFFknu2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0', 'eyJfdG9rZW4iOiJHUXlHUHZGdktEdWF6YnBUUTBsSU91bzdQTmZsUjNEUFdkMkFwbkhrIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FncmljdWx0b3Jlc1wvOCJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Fub19hZ3JpY29sYT9lc3RhZG89Jm5vbWU9JnBhZ2U9MSIsInJvdXRlIjoiYW5vLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1782901327),
('H60NlLSHb04xyAMYsmsjrz4ZQOSf7xaZ6coQJXWD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIwSENuekk2amJwMFpBOVlVeWo0b2ZocUhsdG1NeVY5MGFyaFFUYVp3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1782916578);

-- --------------------------------------------------------

--
-- Estrutura da tabela `talhoes`
--

CREATE TABLE `talhoes` (
  `id` bigint UNSIGNED NOT NULL,
  `designacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `cultura_actual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localizacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('Em cultivo','Pousio','Colhido','activo','inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activo',
  `agricultor_id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `talhoes`
--

INSERT INTO `talhoes` (`id`, `designacao`, `area`, `cultura_actual`, `localizacao`, `estado`, `agricultor_id`, `cooperativa_id`, `created_at`, `updated_at`) VALUES
(1, 'Talhão A', 12.00, 'Mandioca', 'Sector A', 'Em cultivo', 7, 2, '2026-06-23 12:55:46', NULL),
(2, 'Talhão B', 20.00, 'Ova', 'Sector 2 ', 'Colhido', 6, 4, '2026-06-29 16:54:54', NULL),
(6, 'Talhão A1', 12.00, 'Café ', 'Sector A1', 'Pousio', 5, 2, NULL, NULL),
(7, 'Talhão A32', 12.00, 'Café Conilon', 'Sector2', 'Pousio', 5, 2, NULL, '2026-06-23 20:42:39'),
(10, 'Talhão V1', 11.00, 'Café Conilon', 'Sector A1', 'activo', 7, 2, '2026-06-23 20:47:45', '2026-06-23 20:47:45'),
(11, 'Talhão J1', 12.00, 'Café Conilon', 'Sector A1', 'Pousio', 8, 2, '2026-06-23 22:58:53', '2026-06-23 22:58:53'),
(12, 'Talhão E', 12.00, 'Caranbola', 'Sector B1', 'Em cultivo', 2, 4, '2026-06-25 03:14:37', '2026-06-25 03:14:37'),
(13, 'Talhão Setor Café', 12.00, 'Café', 'Sector A1', 'Colhido', 4, 1, '2026-06-26 07:33:08', '2026-06-26 07:33:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nivel` enum('admin','tecnico','agricultor','gestor') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'agricultor',
  `estado` enum('activo','inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activo',
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telefone`, `email_verified_at`, `password`, `foto`, `nivel`, `estado`, `ultimo_acesso`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin SIAG', 'admin@email.com', NULL, NULL, '$2y$12$V40LhdGepaLB7MnbRe1XS.jPCaCPwPmeJcb1EgM2/9dsGpCApgMoq', NULL, 'admin', 'activo', '2026-07-02 15:22:41', NULL, '2026-06-21 15:51:18', '2026-07-02 15:22:41'),
(2, 'Damião Pedro', 'damiao@gmail.com', '952152517', NULL, '$2y$12$m3rTMLHOZ.zc9KrGm5nrVeBlfy6niMKPkze0/Ee7n.4tAjdK/DA6y', '1782060930_perfil5.png', 'tecnico', 'activo', '2026-06-22 06:48:48', NULL, '2026-06-21 15:55:31', '2026-06-22 13:53:33'),
(7, 'Sara Miguel', 'saramiguel@gmail.com', '999112872', NULL, '$2y$12$XUXUiMQuTMonUAl.ceJeGuf7/kIWbhGcwzN2n7EU8jn29SPV6UCHe', '1782903395_perfil30.png', 'agricultor', 'inactivo', NULL, NULL, '2026-07-01 09:56:35', '2026-07-01 09:56:35'),
(8, 'José Mario Abel', 'abel@gmail.com', '922111009', NULL, '$2y$12$8FtyRrD91QsDbuyPnausJe6jR8bMMU3nw1VKokIa/svAvzxTIPATS', NULL, 'gestor', 'activo', NULL, NULL, '2026-07-01 10:30:13', '2026-07-01 10:30:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` bigint UNSIGNED NOT NULL,
  `cooperativa_id` bigint UNSIGNED NOT NULL,
  `agricultor_id` bigint UNSIGNED DEFAULT NULL,
  `data_venda` date NOT NULL,
  `cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `forma_pagamento` enum('Dinheiro','Transferencia','Multicaixa','Credito') COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Pago',
  `valor_entregue` decimal(15,0) NOT NULL DEFAULT '0',
  `troco` decimal(15,0) DEFAULT '0',
  `cancelada_em` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `vendas`
--

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
(22, 2, NULL, '2026-07-01', 'Nossa Casa', 200.00, 'Dinheiro', NULL, NULL, 300, 100, NULL, '2026-07-01 10:41:49', '2026-07-01 10:41:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_itens`
--

CREATE TABLE `venda_itens` (
  `id` bigint UNSIGNED NOT NULL,
  `venda_id` bigint UNSIGNED NOT NULL,
  `produto_id` bigint UNSIGNED DEFAULT NULL,
  `quantidade` decimal(12,2) NOT NULL,
  `preco_unitario` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `venda_itens`
--

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
(26, 22, 4, 1.00, 200.00, 200.00, '2026-07-01 10:41:49', '2026-07-01 10:41:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agricultores`
--
ALTER TABLE `agricultores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agricultores_bilhete_unique` (`bilhete`);

--
-- Índices para tabela `anos_agricolas`
--
ALTER TABLE `anos_agricolas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Índices para tabela `cooperativas`
--
ALTER TABLE `cooperativas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cooperativas_nif_unique` (`nif`);

--
-- Índices para tabela `cooperativa_membros`
--
ALTER TABLE `cooperativa_membros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cooperativa_membros_cooperativa_id_foreign` (`cooperativa_id`),
  ADD KEY `cooperativa_membros_agricultor_id_foreign` (`agricultor_id`);

--
-- Índices para tabela `culturas`
--
ALTER TABLE `culturas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Índices para tabela `historico_estoques`
--
ALTER TABLE `historico_estoques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historico_estoques_cooperativa_id_foreign` (`cooperativa_id`),
  ADD KEY `historico_estoques_insumo_id_foreign` (`insumo_id`),
  ADD KEY `historico_estoques_agricultor_id_foreign` (`agricultor_id`);

--
-- Índices para tabela `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insumos_cooperativa_id_foreign` (`cooperativa_id`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `movimento_insumos`
--
ALTER TABLE `movimento_insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimento_insumos_cooperativa_id_foreign` (`cooperativa_id`),
  ADD KEY `movimento_insumos_insumo_id_foreign` (`insumo_id`),
  ADD KEY `movimento_insumos_agricultor_id_foreign` (`agricultor_id`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_cooperativa_id_foreign` (`cooperativa_id`),
  ADD KEY `produtos_agricultor_id_foreign` (`agricultor_id`),
  ADD KEY `produtos_talhao_id_foreign` (`talhao_id`);

--
-- Índices para tabela `safras`
--
ALTER TABLE `safras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `safras_cooperativa_id_foreign` (`cooperativa_id`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `talhoes`
--
ALTER TABLE `talhoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `talhoes_agricultor_id_foreign` (`agricultor_id`),
  ADD KEY `talhoes_cooperativa_id_foreign` (`cooperativa_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendas_cooperativa_id_foreign` (`cooperativa_id`),
  ADD KEY `vendas_agricultor_id_foreign` (`agricultor_id`);

--
-- Índices para tabela `venda_itens`
--
ALTER TABLE `venda_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_itens_venda_id_foreign` (`venda_id`),
  ADD KEY `venda_itens_produto_id_foreign` (`produto_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agricultores`
--
ALTER TABLE `agricultores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `anos_agricolas`
--
ALTER TABLE `anos_agricolas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cooperativas`
--
ALTER TABLE `cooperativas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cooperativa_membros`
--
ALTER TABLE `cooperativa_membros`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `culturas`
--
ALTER TABLE `culturas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_estoques`
--
ALTER TABLE `historico_estoques`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `movimento_insumos`
--
ALTER TABLE `movimento_insumos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `safras`
--
ALTER TABLE `safras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `talhoes`
--
ALTER TABLE `talhoes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `venda_itens`
--
ALTER TABLE `venda_itens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cooperativa_membros`
--
ALTER TABLE `cooperativa_membros`
  ADD CONSTRAINT `cooperativa_membros_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cooperativa_membros_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `historico_estoques`
--
ALTER TABLE `historico_estoques`
  ADD CONSTRAINT `historico_estoques_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `historico_estoques_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historico_estoques_insumo_id_foreign` FOREIGN KEY (`insumo_id`) REFERENCES `insumos` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `insumos`
--
ALTER TABLE `insumos`
  ADD CONSTRAINT `insumos_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `movimento_insumos`
--
ALTER TABLE `movimento_insumos`
  ADD CONSTRAINT `movimento_insumos_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `movimento_insumos_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movimento_insumos_insumo_id_foreign` FOREIGN KEY (`insumo_id`) REFERENCES `insumos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produtos_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produtos_talhao_id_foreign` FOREIGN KEY (`talhao_id`) REFERENCES `talhoes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `safras`
--
ALTER TABLE `safras`
  ADD CONSTRAINT `safras_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `talhoes`
--
ALTER TABLE `talhoes`
  ADD CONSTRAINT `talhoes_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `talhoes_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_agricultor_id_foreign` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vendas_cooperativa_id_foreign` FOREIGN KEY (`cooperativa_id`) REFERENCES `cooperativas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `venda_itens`
--
ALTER TABLE `venda_itens`
  ADD CONSTRAINT `venda_itens_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `venda_itens_venda_id_foreign` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
