<?php
/*
 * PAD - Exibição dos guias documentais.
 * Arquivo: documento.php (pasta principal)
 *
 * Mantém os dados e as funcionalidades existentes.
 * Os perfis de checklist são selecionados numa área
 * separada da explicação documental.
 */

require __DIR__ . '/includes/dados_documentos.php';

$slug = isset($_GET['doc']) && is_string($_GET['doc'])
    ? $_GET['doc']
    : '';

$doc = $documentos[$slug] ?? null;

if ($doc === null) {
    http_response_code(404);
}

$titulo = $doc
    ? $doc['titulo'] . ' | PAD'
    : 'Documento não encontrado | PAD';

$descricao = $doc['resumo']
    ?? 'Documentação para imigrantes em Portugal.';

$paginaIndexavel = $doc !== null;

$caminhoCanonico = $doc
    ? 'documento.php?doc=' . rawurlencode($slug)
    : 'documentacao.php';

require __DIR__ . '/includes/header.php';
?>

<style>
/* Estilos exclusivos desta página. */

.pad-guia {
    color: #173a53;
    background: #f5f8fb;
}

.pad-guia *,
.pad-guia *::before,
.pad-guia *::after {
    box-sizing: border-box;
}

.pad-guia .pad-hero {
    background: linear-gradient(125deg, #0d304d, #174f72);
    color: #fff;
    padding: 52px 0 48px;
}

.pad-guia .pad-hero .container {
    max-width: 1160px;
}

.pad-guia .breadcrumb {
    color: #c9dfed;
    margin-bottom: 24px;
    font-size: 14px;
}

.pad-guia .breadcrumb a {
    color: #e7f4ff;
}

.pad-guia .pad-hero .etiqueta {
    display: inline-block;
    color: #cce7f8;
    margin-bottom: 12px;
    font-weight: 700;
}

.pad-guia .pad-hero h1 {
    color: #fff;
    line-height: 1.14;
    font-size: clamp(32px, 4vw, 52px);
    margin: 0 0 13px;
}

.pad-guia .pad-hero p {
    color: #e1eef7;
    max-width: 800px;
    line-height: 1.7;
}

.pad-guia .pad-hero .subtitulo-grande {
    font-size: clamp(18px, 2vw, 22px);
    font-weight: 600;
}

.pad-guia .acoes-guia {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 22px;
}

.pad-guia .pad-hero .botao {
    min-height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.pad-guia .pad-hero .botao-secundario {
    color: #fff;
    border-color: #cbe5f4;
}

/* INFORMAÇÕES ESSENCIAIS */

.pad-guia .pad-panorama {
    margin-top: -20px;
    position: relative;
    z-index: 1;
}

.pad-guia .pad-resumo-grade {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
}

.pad-guia .pad-dado {
    background: #fff;
    border: 1px solid #cfe0ea;
    border-radius: 12px;
    padding: 19px;
    box-shadow: 0 8px 20px #0c35520c;
    min-width: 0;
}

.pad-guia .pad-dado small {
    display: block;
    color: #5d7587;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    font-size: 11px;
    margin-bottom: 6px;
}

.pad-guia .pad-dado strong {
    display: block;
    color: #123c5d;
    font-size: 16px;
    overflow-wrap: anywhere;
}

.pad-guia .pad-dado p {
    font-size: 13px;
    color: #587185;
    margin: 5px 0 0;
}

/* ETAPAS DE LEITURA */

.pad-guia .pad-fases {
    margin: 25px 0 3px;
}

.pad-guia .pad-fases p {
    margin: 0 0 12px;
    color: #587185;
}

.pad-guia .pad-fases-grade {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
}

.pad-guia .pad-fase {
    background: #edf5fa;
    border: 1px solid #d4e6f0;
    padding: 14px;
    border-radius: 10px;
}

.pad-guia .pad-fase strong {
    display: block;
    font-size: 14px;
    color: #164665;
}

.pad-guia .pad-fase span {
    color: #597487;
    font-size: 12px;
}

/* ESTRUTURA PRINCIPAL */

.pad-guia .pad-conteudo {
    padding: 28px 0 65px;
}

.pad-guia .guia-layout {
    max-width: 1160px;
    display: grid;
    grid-template-columns: 250px minmax(0, 1fr);
    gap: 24px;
    align-items: start;
}

.pad-guia .guia-indice {
    position: sticky;
    top: 20px;
    align-self: start;
    border: 1px solid #d4e4ee;
    border-radius: 13px;
    padding: 20px;
    background: #fff;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
}

.pad-guia .guia-indice h2 {
    font-size: 16px;
    color: #123c5d;
    margin: 0 0 12px;
}

.pad-guia .guia-indice nav {
    display: grid;
    gap: 3px;
}

.pad-guia .guia-indice nav a {
    display: block;
    color: #315c76;
    font-size: 13px;
    line-height: 1.45;
    padding: 9px 10px;
    text-decoration: none;
    border-radius: 8px;
}

.pad-guia .guia-indice nav a:hover,
.pad-guia .guia-indice nav a:focus-visible {
    background: #edf5fa;
    color: #0f4d74;
}

.pad-guia .guia-indice .pad-revisao {
    border-top: 1px solid #e3edf2;
    margin: 14px 0 0;
    padding-top: 12px;
    font-size: 12px;
    color: #637c8d;
}

.pad-guia .guia-principal {
    min-width: 0;
}

/* BLOCOS DE INFORMAÇÃO */

.pad-guia .bloco {
    background: #fff;
    border: 1px solid #d0e0e9;
    border-radius: 14px;
    padding: clamp(21px, 3vw, 33px);
    margin: 0 0 20px;
    box-shadow: 0 5px 14px #123c5d06;
    scroll-margin-top: 22px;
}

.pad-guia .bloco h2 {
    color: #123c5d;
    line-height: 1.25;
    font-size: clamp(23px, 2.7vw, 29px);
    margin: 4px 0 14px;
}

.pad-guia .bloco h3 {
    color: #174865;
    font-size: 17px;
    margin: 16px 0 9px;
}

.pad-guia .bloco p,
.pad-guia .bloco li {
    line-height: 1.8;
}

.pad-guia .bloco p {
    margin: 10px 0 15px;
}

.pad-guia .secao-numero {
    display: inline-block;
    color: #146a91;
    background: #eaf5fa;
    border-radius: 7px;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .04em;
}

.pad-guia .pad-intro-bloco {
    color: #506e82;
    margin-bottom: 18px !important;
}

/* PERFIS DOCUMENTAIS INFORMATIVOS */

.pad-guia .pad-perfil {
    border: 1px solid #cddfe9;
    border-radius: 11px;
    margin: 10px 0;
    background: #fbfdfe;
    overflow: hidden;
}

.pad-guia .pad-perfil summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 17px 18px;
    cursor: pointer;
    font-weight: 700;
    color: #154968;
    list-style: none;
}

.pad-guia .pad-perfil summary::-webkit-details-marker {
    display: none;
}

.pad-guia .pad-perfil summary::after {
    content: '+';
    font-size: 22px;
    line-height: 1;
    color: #29709b;
}

.pad-guia .pad-perfil[open] summary::after {
    content: '−';
}

.pad-guia .pad-perfil[open] summary {
    background: #ecf5fa;
    border-bottom: 1px solid #d5e5ef;
}

.pad-guia .pad-perfil .pad-perfil-corpo {
    padding: 12px 20px 16px;
}

.pad-guia .pad-perfil ul {
    margin: 0;
    padding-left: 21px;
}

.pad-guia .pad-perfil li {
    margin: 7px 0;
}

.pad-guia .pad-perfil .pad-tipo {
    font-size: 11px;
    color: #56758a;
    font-weight: 600;
    white-space: nowrap;
}

/* PREPARAÇÃO E PROCEDIMENTOS */

.pad-guia .lista-check {
    padding-left: 23px;
    margin: 10px 0;
}

.pad-guia .lista-check li {
    margin-bottom: 8px;
}

.pad-guia .pad-passos {
    list-style: none;
    counter-reset: none;
    margin: 20px 0 0;
    padding: 0;
}

.pad-guia .pad-passos > li {
    list-style: none;
    display: flex;
    gap: 17px;
    padding: 17px 0;
    border-top: 1px solid #e2edf3;
    margin: 0;
}

.pad-guia .pad-passos > li::marker {
    content: '';
}

.pad-guia .pad-passo-numero {
    display: grid;
    place-items: center;
    flex: 0 0 38px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #155c87;
    color: #fff;
    font-weight: 800;
    font-size: 14px;
}

.pad-guia .pad-passo-texto {
    min-width: 0;
}

.pad-guia .pad-passo-texto h3 {
    margin-top: 0;
}

.pad-guia .dica {
    padding: 12px 15px;
    border-left: 3px solid #2b86b4;
    background: #f0f7fb;
    border-radius: 0 8px 8px 0;
}

/* ONDE PEDIR E CUSTOS */

.pad-guia .pad-duas-colunas {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
}

.pad-guia .pad-info {
    background: #f2f8fb;
    border: 1px solid #d3e4ed;
    border-radius: 10px;
    padding: 17px;
}

.pad-guia .pad-info h3 {
    margin-top: 0;
}

.pad-guia .pad-info p {
    margin-bottom: 0;
    overflow-wrap: anywhere;
}

.pad-guia .alerta {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    background: #fffaf0;
    border: 1px solid #eadbb5;
    border-radius: 10px;
    padding: 13px 15px;
    margin: 11px 0;
}

.pad-guia .alerta strong {
    flex-shrink: 0;
    color: #946017;
}

.pad-guia .alerta p {
    margin: 0;
}

/* CHECKLIST INDEPENDENTE */

.pad-guia .bloco-checklist {
    border-top: 5px solid #16865d;
}

.pad-guia .pad-seletores {
    display: grid;
    gap: 10px;
    margin: 18px 0 24px;
}

.pad-guia .pad-seletores .grupo-documentos {
    background: #f7fbfd;
    border: 1px solid #c9e0e9;
    border-radius: 10px;
    padding: 13px 15px;
    margin: 0;
}

.pad-guia .pad-seletores .grupo-documentos h3 {
    margin: 0 0 9px;
    font-size: 15px;
}

.pad-guia .pad-seletores .selecionar-grupo {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    font-size: 13px;
    color: #235b7a;
    margin: 0;
}

.pad-guia .pad-seletores .selecionar-grupo input {
    width: 18px;
    height: 18px;
    accent-color: #156f9b;
}

.pad-guia .pad-seletores .grupo-documentos:has(input:checked) {
    border-color: #16865d;
    background: #eefaf3;
}

.pad-guia .pad-seletores .lista-check[hidden] {
    display: none !important;
}

.pad-guia .pad-area-checklist {
    border: 1px solid #c7dce5;
    border-radius: 12px;
    padding: 19px;
    background: #fff;
}

.pad-guia .progresso-texto {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 8px;
}

.pad-guia .progresso-area {
    margin-bottom: 18px;
}

.pad-guia .barra-progresso {
    overflow: hidden;
    margin-top: 12px;
    height: 10px;
    background: #e4edf2;
    border-radius: 10px;
}

.pad-guia .barra-progresso > div {
    background: #16865d;
    height: 100%;
    width: 0;
    transition: width .2s ease;
}

.pad-guia #checklistItens {
    min-height: 48px;
}

.pad-guia .checklist-vazia {
    color: #567489;
}

.pad-guia .checklist-acoes {
    display: flex;
    flex-wrap: wrap;
    gap: 11px;
    margin-top: 17px;
}

.pad-guia .checklist-acoes button:disabled {
    opacity: .55;
    cursor: not-allowed;
}

.pad-guia .nota-checklist {
    font-size: 12px;
    color: #617b8d;
    margin-bottom: 0;
}

.pad-guia .checklist-fontes-impressao {
    display: none;
}

/* FONTES OFICIAIS */

.pad-guia .fontes {
    display: grid;
    gap: 10px;
}

.pad-guia .fontes a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 14px 15px;
    border: 1px solid #d4e4ec;
    border-radius: 9px;
    text-decoration: none;
    color: #185e87;
    overflow-wrap: anywhere;
}

.pad-guia .fontes a:hover {
    background: #f1f8fc;
}

.pad-guia .aviso-legal {
    background: #edf3f7;
    border-left: 4px solid #53778f;
    padding: 18px 22px;
    border-radius: 8px;
    line-height: 1.7;
}

.pad-guia .aviso-legal p {
    margin: 6px 0 0;
}

.pad-guia .voltar {
    margin: 22px 0;
}

.pad-guia .pad-guia-final {
    margin-top: 17px;
}

.pad-guia :focus-visible {
    outline: 3px solid #d7a433;
    outline-offset: 3px;
}

/* DISPOSITIVOS MÓVEIS */

@media (max-width: 940px) {

    .pad-guia .guia-layout {
        grid-template-columns: 1fr;
    }

    .pad-guia .guia-indice {
        position: static;
        max-height: none;
    }

    .pad-guia .guia-indice nav {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .pad-guia .guia-indice nav a {
        background: #f1f7fa;
    }
}

@media (max-width: 640px) {

    .pad-guia .pad-hero {
        padding: 36px 0 45px;
    }

    .pad-guia .pad-resumo-grade,
    .pad-guia .pad-fases-grade {
        grid-template-columns: 1fr;
    }

    .pad-guia .pad-duas-colunas {
        grid-template-columns: 1fr;
    }

    .pad-guia .pad-passo-numero {
        flex-basis: 32px;
        width: 32px;
        height: 32px;
    }

    .pad-guia .bloco {
        padding: 20px;
    }

    .pad-guia .pad-perfil summary {
        align-items: flex-start;
    }

    .pad-guia .checklist-acoes .botao {
        width: 100%;
    }
}

/* IMPRESSÃO */

@media print {

    .pad-guia .guia-indice,
    .pad-guia .acoes-guia,
    .pad-guia .checklist-acoes,
    .pad-guia .pad-fases {
        display: none !important;
    }

    .pad-guia {
        background: white !important;
    }

    .pad-guia .pad-hero {
        background: white !important;
        color: black !important;
        padding: 10px 0;
    }

    .pad-guia .pad-hero h1,
    .pad-guia .pad-hero p {
        color: black !important;
    }

    .pad-guia .guia-layout {
        display: block;
    }

    .pad-guia .bloco {
        box-shadow: none;
        break-inside: avoid;
    }

    .pad-guia .pad-perfil:not([open]) .pad-perfil-corpo {
        display: block !important;
    }
}

</style>


<main id="conteudo" class="pad-guia">

<?php if ($doc === null): ?>

    <section class="secao">

        <div class="container">

            <h1>Documento não encontrado</h1>

            <p>O guia solicitado não existe.</p>

            <a href="documentacao.php"
               class="botao botao-primario">

                Voltar à documentação

            </a>

        </div>

    </section>

<?php else: ?>

    <!-- =====================================
         1. APRESENTAÇÃO DO DOCUMENTO
    ====================================== -->

    <section class="pad-hero">

        <div class="container">

            <nav class="breadcrumb"
                 aria-label="Localização no site">

                <a href="inicio.php">
                    Início
                </a> /

                <a href="documentacao.php">
                    Documentação
                </a> /

                <span aria-current="page">
                    <?= e($doc['titulo']) ?>
                </span>

            </nav>


            <span class="etiqueta">
                <?= e($doc['categoria']) ?>
            </span>


            <h1>
                <?= e($doc['titulo']) ?>
            </h1>


            <p class="subtitulo-grande">
                <?= e($doc['subtitulo']) ?>
            </p>


            <p>
                <?= e($doc['resumo']) ?>
            </p>


            <div class="acoes-guia">

                <button
                    id="imprimirGuia"
                    type="button"
                    class="botao botao-primario">

                    Imprimir guia completo

                </button>


                <a href="#necessarios"
                   class="botao botao-secundario">

                    Ver documentos necessários

                </a>


                <a href="#checklist"
                   class="botao botao-secundario">

                    Ir para a checklist

                </a>

            </div>

        </div>

    </section>


    <!-- =====================================
         2. INFORMAÇÕES ESSENCIAIS
    ====================================== -->

    <div class="container pad-panorama">

        <div class="pad-resumo-grade"
             aria-label="Informações essenciais">

            <div class="pad-dado">

                <small>
                    Documento ou serviço
                </small>

                <strong>
                    <?= e($doc['sigla']) ?>
                </strong>

                <p>
                    <?= e($doc['titulo']) ?>
                </p>

            </div>


            <div class="pad-dado">

                <small>
                    Entidade responsável
                </small>

                <strong>
                    <?= e($doc['entidade']) ?>
                </strong>

            </div>


            <div class="pad-dado">

                <small>Custos</small>

                <strong>
                    <?= e($doc['custo']) ?>
                </strong>

            </div>

        </div>


        <!-- ORIENTAÇÃO DE LEITURA -->

        <div class="pad-fases"
             aria-label="Como utilizar este guia">

            <p>
                <strong>
                    Como utilizar este guia
                </strong>
            </p>


            <div class="pad-fases-grade">

                <div class="pad-fase">

                    <strong>
                        01 · Compreender
                    </strong>

                    <span>
                        Saiba o que é e quem pode pedir.
                    </span>

                </div>


                <div class="pad-fase">

                    <strong>
                        02 · Preparar
                    </strong>

                    <span>
                        Leia os requisitos da sua situação.
                    </span>

                </div>


                <div class="pad-fase">

                    <strong>
                        03 · Solicitar
                    </strong>

                    <span>
                        Consulte os passos e canais.
                    </span>

                </div>


                <div class="pad-fase">

                    <strong>
                        04 · Conferir
                    </strong>

                    <span>
                        Use a checklist no final.
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================
         3. CONTEÚDO DOCUMENTAL
    ====================================== -->

    <section class="pad-conteudo">

        <div class="container guia-layout">


            <!-- ÍNDICE -->

            <aside class="guia-indice"
                   aria-label="Navegação do guia">

                <h2>Neste guia</h2>

                <nav aria-label="Índice do guia">

                    <a href="#oque">
                        01 · O que é
                    </a>

                    <a href="#quem">
                        02 · Quem pode pedir
                    </a>

                    <a href="#necessarios">
                        03 · Documentos necessários
                    </a>

                    <a href="#preparar">
                        04 · Antes de começar
                    </a>

                    <a href="#passos">
                        05 · Como solicitar
                    </a>

                    <a href="#onde">
                        06 · Onde pedir e custos
                    </a>

                    <a href="#atencao">
                        07 · Informações importantes
                    </a>

                    <a href="#checklist">
                        08 · Minha checklist
                    </a>

                    <a href="#fontes">
                        09 · Fontes oficiais
                    </a>

                </nav>


                <p class="pad-revisao">

                    Última revisão indicada:
                    <?= e($doc['revisao']) ?>

                </p>

            </aside>


            <!-- CONTEÚDO PRINCIPAL -->

            <div class="guia-principal">


                <!-- ==========================
                     O QUE É
                =========================== -->

                <section class="bloco" id="oque">

                    <span class="secao-numero">
                        01 · COMPREENDER
                    </span>

                    <h2>
                        O que é e para que serve?
                    </h2>

                    <?php foreach (
                        $doc['oque'] as $texto
                    ): ?>

                        <p>
                            <?= e($texto) ?>
                        </p>

                    <?php endforeach; ?>

                </section>


                <!-- ==========================
                     QUEM PODE PEDIR
                =========================== -->

                <section class="bloco" id="quem">

                    <span class="secao-numero">
                        02 · QUEM PODE PEDIR
                    </span>

                    <h2>
                        Quem pode solicitar?
                    </h2>

                    <?php foreach (
                        $doc['quem'] as $texto
                    ): ?>

                        <p>
                            <?= e($texto) ?>
                        </p>

                    <?php endforeach; ?>

                </section>


                <!-- ==========================
                     DOCUMENTOS NECESSÁRIOS
                =========================== -->

                <section class="bloco" id="necessarios">

                    <span class="secao-numero">
                        03 · DOCUMENTAÇÃO
                    </span>

                    <h2>
                        Quais documentos são necessários?
                    </h2>

                    <p class="pad-intro-bloco">

                        Os requisitos dependem da sua situação.

                        Abra o perfil correspondente
                        para consultar os documentos indicados.

                        A seleção para imprimir e marcar
                        documentos fica numa checklist
                        independente, no final do guia.

                    </p>


                    <?php foreach (
                        $doc['grupos'] as $indice => $grupo
                    ): ?>

                        <?php

                        $principal = (
                            $grupo['tipo'] === 'perfil'
                        );

                        ?>

                        <details
                            class="pad-perfil"
                            <?= $indice === 0 ? 'open' : '' ?>
                        >

                            <summary>

                                <span>
                                    <?= e($grupo['titulo']) ?>
                                </span>

                                <span class="pad-tipo">

                                    <?= $principal
                                        ? 'Perfil principal'
                                        : 'Complementar' ?>

                                </span>

                            </summary>


                            <div class="pad-perfil-corpo">

                                <ul>

                                    <?php foreach (
                                        $grupo['itens'] as $item
                                    ): ?>

                                        <li>
                                            <?= e($item) ?>
                                        </li>

                                    <?php endforeach; ?>

                                </ul>

                            </div>

                        </details>

                    <?php endforeach; ?>


                    <p class="nota-checklist">

                        Esta lista é informativa.

                        A entidade responsável pode
                        exigir elementos adicionais
                        conforme o caso concreto.

                        Confirme os requisitos
                        nas fontes oficiais abaixo.

                    </p>

                </section>


                <!-- ==========================
                     ANTES DE COMEÇAR
                =========================== -->

                <section class="bloco" id="preparar">

                    <span class="secao-numero">
                        04 · PREPARAÇÃO
                    </span>

                    <h2>
                        Antes de começar
                    </h2>

                    <p class="pad-intro-bloco">

                        Verifique estes pontos antes
                        de contactar a entidade responsável.

                    </p>

                    <ul class="lista-check">

                        <?php foreach (
                            $doc['antes'] as $item
                        ): ?>

                            <li>
                                <?= e($item) ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </section>


                <!-- ==========================
                     COMO SOLICITAR
                =========================== -->

                <section class="bloco" id="passos">

                    <span class="secao-numero">
                        05 · PROCEDIMENTO
                    </span>

                    <h2>
                        Como solicitar, passo a passo
                    </h2>

                    <p class="pad-intro-bloco">

                        Siga a sequência abaixo
                        e confirme o canal e as
                        condições atuais com a
                        entidade responsável.

                    </p>


                    <ol class="pad-passos passos-guia">

                        <?php foreach (
                            $doc['passos'] as $indice => $passo
                        ): ?>

                            <li>

                                <span
                                    class="pad-passo-numero passo-numero"
                                    aria-hidden="true"
                                >

                                    <?= $indice + 1 ?>

                                </span>


                                <div class="pad-passo-texto">

                                    <h3>
                                        <?= e($passo['titulo']) ?>
                                    </h3>

                                    <p>
                                        <?= e($passo['texto']) ?>
                                    </p>


                                    <?php if (
                                        !empty($passo['dica'])
                                    ): ?>

                                        <p class="dica">

                                            <strong>
                                                Dica prática:
                                            </strong>

                                            <?= e($passo['dica']) ?>

                                        </p>

                                    <?php endif; ?>

                                </div>

                            </li>

                        <?php endforeach; ?>

                    </ol>

                </section>


                <!-- ==========================
                     ONDE PEDIR E CUSTOS
                =========================== -->

                <section class="bloco" id="onde">

                    <span class="secao-numero">
                        06 · ATENDIMENTO
                    </span>

                    <h2>
                        Onde solicitar e quanto custa?
                    </h2>


                    <div class="pad-duas-colunas">

                        <div class="pad-info">

                            <h3>
                                Onde e como solicitar
                            </h3>

                            <p>
                                <?= e($doc['onde']) ?>
                            </p>

                        </div>


                        <div class="pad-info">

                            <h3>
                                Custos indicados
                            </h3>

                            <p>
                                <?= e($doc['custo']) ?>
                            </p>

                        </div>

                    </div>

                </section>


                <!-- ==========================
                     INFORMAÇÕES IMPORTANTES
                =========================== -->

                <section class="bloco" id="atencao">

                    <span class="secao-numero">
                        07 · CUIDADOS
                    </span>

                    <h2>
                        Informações importantes
                    </h2>


                    <?php foreach (
                        $doc['alertas'] as $alerta
                    ): ?>

                        <div class="alerta">

                            <strong aria-hidden="true">
                                !
                            </strong>

                            <p>
                                <?= e($alerta) ?>
                            </p>

                        </div>

                    <?php endforeach; ?>

                </section>


                <!-- ==========================
                     CHECKLIST INDEPENDENTE
                =========================== -->

                <section
                    class="bloco bloco-checklist"
                    id="checklist"
                    data-documento="<?= e($doc['titulo']) ?>"
                    data-revisao="<?= e($doc['revisao']) ?>"
                >

                    <span class="secao-numero">
                        08 · FERRAMENTA PRÁTICA
                    </span>

                    <h2>
                        Minha checklist documental
                    </h2>

                    <p class="pad-intro-bloco">

                        Agora que já leu os requisitos,
                        escolha uma situação principal.

                        Se for necessário, acrescente
                        documentos complementares.

                        A lista será gerada logo abaixo.

                    </p>


                    <!-- SELEÇÃO DOS PERFIS -->

                    <div
                        id="gruposDocumentais"
                        class="pad-seletores"
                    >

                        <?php foreach (
                            $doc['grupos'] as $indice => $grupo
                        ): ?>

                            <?php

                            $principal = (
                                $grupo['tipo'] === 'perfil'
                            );

                            ?>

                            <article
                                class="grupo-documentos"
                                data-grupo="<?= (int) $indice ?>"
                                data-tipo="<?= e($grupo['tipo']) ?>"
                            >

                                <h3>
                                    <?= e($grupo['titulo']) ?>
                                </h3>


                                <label class="selecionar-grupo">

                                    <input
                                        class="grupo-seletor"
                                        type="<?= $principal
                                            ? 'radio'
                                            : 'checkbox' ?>"
                                        name="<?= $principal
                                            ? 'perfil-documental'
                                            : 'complemento-' . (int) $indice ?>"
                                        value="<?= (int) $indice ?>"
                                    >


                                    <span>

                                        <?= $principal
                                            ? 'Selecionar como minha situação'
                                            : 'Incluir documentação complementar' ?>

                                    </span>

                                </label>


                                <!--
                                    Lista utilizada pelo JavaScript
                                    para gerar a checklist.

                                    Os documentos já foram apresentados
                                    na secção informativa anterior.
                                -->

                                <ul class="lista-check" hidden>

                                    <?php foreach (
                                        $grupo['itens'] as $item
                                    ): ?>

                                        <li>
                                            <?= e($item) ?>
                                        </li>

                                    <?php endforeach; ?>

                                </ul>

                            </article>

                        <?php endforeach; ?>

                    </div>


                    <!-- CHECKLIST GERADA -->

                    <div class="pad-area-checklist">

                        <div class="progresso-area">

                            <div class="progresso-texto">

                                <strong>
                                    Documentos preparados
                                </strong>

                                <span
                                    id="progressoTexto"
                                    role="status"
                                    aria-live="polite"
                                >

                                    Selecione primeiro um perfil

                                </span>

                            </div>


                            <div
                                id="barraProgresso"
                                class="barra-progresso"
                                role="progressbar"
                                aria-label="Documentos preparados"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                aria-valuenow="0"
                            >

                                <div id="progressoPreenchimento">
                                </div>

                            </div>

                        </div>


                        <div id="checklistItens">

                            <p class="checklist-vazia">

                                Escolha acima a situação
                                que corresponde ao seu caso
                                para gerar a checklist.

                            </p>

                        </div>


                        <div class="checklist-acoes">

                            <button
                                id="imprimirChecklist"
                                type="button"
                                class="botao botao-primario"
                                disabled
                            >

                                Imprimir checklist

                            </button>


                            <button
                                id="limparChecklist"
                                type="button"
                                class="botao botao-secundario"
                            >

                                Limpar seleção

                            </button>

                        </div>

                    </div>


                    <!-- FONTES PARA IMPRESSÃO -->

                    <div class="checklist-fontes-impressao">

                        <h3>
                            Fontes oficiais
                        </h3>

                        <?php foreach (
                            $doc['fontes'] as $fonte
                        ): ?>

                            <p>

                                <?= e($fonte['nome']) ?>:
                                <?= e($fonte['url']) ?>

                            </p>

                        <?php endforeach; ?>

                    </div>


                    <p class="nota-checklist">

                        A checklist é uma ferramenta
                        pessoal de organização e não
                        substitui as exigências oficiais.

                        As marcações não são enviadas
                        nem guardadas pela PAD.

                    </p>

                </section>


                <!-- ==========================
                     FONTES OFICIAIS
                =========================== -->

                <section class="bloco" id="fontes">

                    <span class="secao-numero">
                        09 · VERIFICAÇÃO
                    </span>

                    <h2>
                        Fontes oficiais
                    </h2>

                    <p class="pad-intro-bloco">

                        Antes de apresentar o pedido,
                        consulte os canais oficiais
                        para confirmar os requisitos atuais.

                    </p>


                    <div class="fontes">

                        <?php foreach (
                            $doc['fontes'] as $fonte
                        ): ?>

                            <a
                                href="<?= e($fonte['url']) ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >

                                <span>
                                    <?= e($fonte['nome']) ?>
                                </span>


                                <span aria-hidden="true">
                                    ↗
                                </span>

                            </a>

                        <?php endforeach; ?>

                    </div>


                    <p class="nota-checklist">

                        Revisão indicada neste guia:
                        <?= e($doc['revisao']) ?>.

                    </p>

                </section>


                <!-- ==========================
                     AVISO DE RESPONSABILIDADE
                =========================== -->

                <div class="aviso-legal">

                    <strong>
                        Aviso de responsabilidade
                    </strong>

                    <p>

                        A PAD não realiza pedidos,
                        não recebe documentos pessoais
                        e não garante resultados.

                        Confirme sempre os requisitos
                        junto da entidade competente.

                    </p>

                </div>


                <p class="voltar pad-guia-final">

                    <a href="documentacao.php">

                        ← Voltar à documentação

                    </a>

                </p>

            </div>

        </div>

    </section>

<?php endif; ?>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
