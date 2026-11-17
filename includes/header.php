<?php

require_once __DIR__ . '/config.php';

/*
 * ============================================
 * PAD - PLATAFORMA DE AUXÍLIO DOCUMENTAL
 * CABEÇALHO DAS PÁGINAS INTERNAS
 * ============================================
 *
 * Inclui:
 * - Identidade da plataforma
 * - Metadados e título dinâmico
 * - URL canónica
 * - Menu responsivo
 * - Navegação entre páginas
 * - Acesso ao ranking de nacionalidades
 * ============================================
 */

if (!function_exists('e')) {

    function e($valor): string
    {
        return htmlspecialchars(
            (string) $valor,
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        );
    }
}

// Título da página.
$titulo = $titulo ?? PAD_NOME;

// Descrição da página.
$descricao = $descricao
    ?? 'Orientações sobre documentação e serviços públicos em Portugal.';

// Identificar a página atual.
$paginaAtual = basename(
    $_SERVER['SCRIPT_NAME'] ?? 'index.php'
);

// Configuração de indexação.
$paginaIndexavel = $paginaIndexavel ?? true;

// Endereço canónico.
$caminhoCanonico = $caminhoCanonico ?? $paginaAtual;

$urlCanonica = '';

if (SITE_URL !== '') {

    $urlCanonica =
        rtrim(SITE_URL, '/') . '/' . $caminhoCanonico;
}

// Marcar o link da página atual no menu.
if (!function_exists('paginaAtiva')) {

    function paginaAtiva(
        array $paginas,
        string $atual
    ): string {

        return in_array($atual, $paginas, true)
            ? ' aria-current="page"'
            : '';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="theme-color"
          content="#123c5d">

    <meta name="description"
          content="<?= e($descricao) ?>">

    <?php if (!$paginaIndexavel): ?>

        <meta name="robots" content="noindex, nofollow">

    <?php endif; ?>

    <?php if ($urlCanonica !== ''): ?>

        <link
            rel="canonical"
            href="<?= e($urlCanonica) ?>"
        >

    <?php endif; ?>

    <title>
        <?= e($titulo) ?>
    </title>

    <link
        rel="stylesheet"
        href="css/style.css"
    >

</head>

<body>

<!-- ========================================
     ACESSIBILIDADE
======================================== -->

<a class="saltar" href="#conteudo">
    Saltar para o conteúdo
</a>


<!-- ========================================
     CABEÇALHO PRINCIPAL
======================================== -->

<header class="topo">

    <div class="container cabecalho">

        <!-- LOGÓTIPO -->

        <a
            href="index.php"
            class="marca"
            aria-label="PAD, capa de apresentação"
        >

            <span class="marca-icone">
                PAD
            </span>

            <span class="marca-texto">

                <strong>
                    Auxílio Documental
                </strong>

                <small>
                    Informação para imigrantes
                </small>

            </span>

        </a>


        <!-- BOTÃO DO MENU RESPONSIVO -->

        <button
            type="button"
            class="menu-botao"
            id="menuBotao"
            aria-expanded="false"
            aria-controls="menu"
            aria-label="Abrir menu"
        >

            <span></span>
            <span></span>
            <span></span>

        </button>


        <!-- ====================================
             MENU DE NAVEGAÇÃO
        ===================================== -->

        <nav
            id="menu"
            class="menu"
            aria-label="Navegação principal"
        >

            <!-- PÁGINA INICIAL -->

            <a
                href="inicio.php"
                <?= paginaAtiva(
                    ['inicio.php'],
                    $paginaAtual
                ) ?>
            >
                Início
            </a>


            <!-- DOCUMENTAÇÃO -->

            <a
                href="documentacao.php"
                <?= paginaAtiva(
                    [
                        'documentacao.php',
                        'documento.php'
                    ],
                    $paginaAtual
                ) ?>
            >
                Documentação
            </a>


            <!-- PASSO A PASSO -->

            <a
                href="regularizacao.php"
                <?= paginaAtiva(
                    ['regularizacao.php'],
                    $paginaAtual
                ) ?>
            >
                Passo a Passo
            </a>


            <!-- PERGUNTAS FREQUENTES -->

            <a
                href="faq.php"
                <?= paginaAtiva(
                    ['faq.php'],
                    $paginaAtual
                ) ?>
            >
                Perguntas Frequentes
            </a>


            <!-- NACIONALIDADES PARTICIPANTES -->

            <a
                href="avaliar.php"
                <?= paginaAtiva(
                    ['avaliar.php'],
                    $paginaAtual
                ) ?>
            >
                Nacionalidades
            </a>


            <!-- SOBRE -->

            <a
                href="sobre.php"
                <?= paginaAtiva(
                    ['sobre.php'],
                    $paginaAtual
                ) ?>
            >
                Sobre
            </a>


            <!-- PRIVACIDADE -->

            <a
                href="privacidade.php"
                <?= paginaAtiva(
                    ['privacidade.php'],
                    $paginaAtual
                ) ?>
            >
                Privacidade
            </a>

        </nav>

    </div>

</header>
