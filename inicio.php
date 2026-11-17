<?php

$titulo = 'Início | PAD';

$descricao = 'Plataforma de Auxílio Documental. '
    . 'Informações gratuitas sobre documentação em Portugal.';

require_once __DIR__ . '/includes/header.php';

$guias = [

    [
        'sigla' => 'NIF',
        'titulo' => 'Número de Identificação Fiscal',
        'descricao' => 'Conheça os requisitos e saiba como solicitar o NIF.',
        'link' => 'documento.php?doc=nif'
    ],

    [
        'sigla' => 'NISS',
        'titulo' => 'Segurança Social',
        'descricao' => 'Consulte as informações para obter o NISS.',
        'link' => 'documento.php?doc=niss'
    ],

    [
        'sigla' => 'SNS',
        'titulo' => 'Número de Utente',
        'descricao' => 'Saiba como obter o Número Nacional de Utente.',
        'link' => 'documento.php?doc=utente'
    ],

    [
        'sigla' => 'CS',
        'titulo' => 'Centro de Saúde',
        'descricao' => 'Entenda os procedimentos de inscrição.',
        'link' => 'documento.php?doc=centro-saude'
    ],

    [
        'sigla' => 'MOR',
        'titulo' => 'Comprovativo de Morada',
        'descricao' => 'Conheça os comprovativos aceites para cada finalidade.',
        'link' => 'documento.php?doc=morada'
    ],

    [
        'sigla' => 'AR',
        'titulo' => 'Autorização de Residência',
        'descricao' => 'Consulte as modalidades e os procedimentos oficiais.',
        'link' => 'documento.php?doc=residencia'
    ]

];

?>

<main id="conteudo">

    <section class="hero">

        <div class="container hero-grid">

            <div>

                <span class="etiqueta etiqueta-hero">
                    PLATAFORMA DE AUXÍLIO DOCUMENTAL
                </span>

                <h1>
                    Informação clara.
                    Orientação responsável.
                </h1>

                <p>
                    Consulte informações gratuitas sobre
                    documentação em Portugal, organize
                    os requisitos da sua situação e
                    encontre os serviços oficiais.
                </p>

                <form
                    action="documentacao.php"
                    method="get"
                    class="pesquisa-home">

                    <input
                        type="search"
                        name="q"
                        placeholder="Pesquisar NIF, NISS, Utente..."
                        aria-label="Pesquisar documentos">

                    <button type="submit">
                        Pesquisar
                    </button>

                </form>

                <div class="acoes">

                    <a
                        href="documentacao.php"
                        class="botao botao-claro">

                        Consultar documentos

                    </a>

                    <a
                        href="sobre.php"
                        class="botao botao-contorno">

                        Conhecer a PAD

                    </a>

                </div>

            </div>


            <aside class="hero-painel">

                <span class="etiqueta">
                    COMO FUNCIONA
                </span>

                <h2>
                    Prepare os seus documentos
                </h2>

                <div class="mini-etapa">

                    <span>01</span>

                    <div>
                        <strong>Escolha um documento</strong>
                        <p>Encontre o guia que procura.</p>
                    </div>

                </div>

                <div class="mini-etapa">

                    <span>02</span>

                    <div>
                        <strong>Consulte os requisitos</strong>
                        <p>Identifique os documentos aplicáveis.</p>
                    </div>

                </div>

                <div class="mini-etapa">

                    <span>03</span>

                    <div>
                        <strong>Prepare a checklist</strong>
                        <p>Organize o que precisa apresentar.</p>
                    </div>

                </div>

                <div class="mini-etapa">

                    <span>04</span>

                    <div>
                        <strong>Confirme oficialmente</strong>
                        <p>Consulte a entidade responsável.</p>
                    </div>

                </div>

            </aside>

        </div>

    </section>


    <section class="secao" id="documentos">

        <div class="container">

            <div class="secao-cabecalho">

                <div>

                    <span class="etiqueta">
                        DOCUMENTAÇÃO
                    </span>

                    <h2>
                        Escolha o documento que precisa
                    </h2>

                    <p>
                        Seis guias para facilitar
                        a preparação dos seus procedimentos.
                    </p>

                </div>

            </div>


            <div class="grid-cards">

                <?php foreach ($guias as $guia): ?>

                    <article class="cartao">

                        <div class="cartao-topo">

                            <span class="sigla">
                                <?= htmlspecialchars($guia['sigla']) ?>
                            </span>

                        </div>

                        <h3>
                            <?= htmlspecialchars($guia['titulo']) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($guia['descricao']) ?>
                        </p>

                        <a
                            href="<?= htmlspecialchars($guia['link']) ?>"
                            class="cartao-link">

                            Consultar guia completo →

                        </a>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <section class="secao fundo-suave">

        <div class="container">

            <div class="bloco-conjunto">

                <span class="etiqueta">
                    FINALIDADE SOCIAL
                </span>

                <h2>
                    Por que existe a PAD?
                </h2>

                <p>
                    A Plataforma de Auxílio Documental
                    foi desenvolvida como um projeto acadêmico
                    de Engenharia de Software.
                </p>

                <p>
                    O objetivo é reduzir a desinformação,
                    facilitar o acesso a orientações
                    documentais e promover a autonomia
                    dos imigrantes em Portugal.
                </p>

                <div class="aviso-legal">

                    <strong>
                        Informação responsável
                    </strong>

                    <p>
                        A PAD é independente, gratuita
                        e educativa. Não incentiva
                        a imigração irregular,
                        não realiza pedidos e
                        não representa organismos públicos.
                    </p>

                </div>

                <a
                    href="sobre.php"
                    class="botao botao-primario">

                    Conhecer o projeto

                </a>

            </div>

        </div>

    </section>

</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>