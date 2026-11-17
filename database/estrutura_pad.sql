
-- =============================================
-- PAD - PLATAFORMA DE AUXÍLIO DOCUMENTAL
-- Estrutura demonstrativa do banco de dados
-- Projeto académico - UNIGRAN Europa
-- =============================================

-- Não contém dados reais, senhas ou contas.
-- Estrutura baseada nas funcionalidades atuais.

-- 1. CRIAR O BANCO DE DADOS

CREATE DATABASE IF NOT EXISTS pad_plataforma
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE pad_plataforma;


-- 2. TABELA DE ADMINISTRADORES

CREATE TABLE IF NOT EXISTS pad_admins (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(254) NOT NULL,
    senha_hash VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP NOT NULL
        DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY uniq_pad_admins_email (email)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


-- 3. TABELA DE PARTICIPAÇÕES POR PAÍS

CREATE TABLE IF NOT EXISTS pad_participacoes_paises (
    codigo_pais CHAR(2)
        CHARACTER SET ascii
        COLLATE ascii_bin NOT NULL,

    total INT UNSIGNED NOT NULL DEFAULT 0,

    PRIMARY KEY (codigo_pais)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


-- =============================================
-- FIM DA ESTRUTURA DEMONSTRATIVA
-- =============================================

-- Observação:
-- A tabela histórica de avaliações não está
-- incluída neste arquivo.
-- O módulo antigo foi descontinuado.

