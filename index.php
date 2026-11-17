
<!DOCTYPE html>
<html lang="pt-PT">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#0B2942">

<meta name="description"
      content="PAD: orientações gratuitas sobre documentação e serviços públicos em Portugal.">

<title>PAD | Plataforma de Auxílio Documental</title>

<link rel="stylesheet" href="css/capa.css">
<script src="js/capa.js" defer></script>

<style>
/* Melhorias da capa. Mantém o CSS e os carrosséis existentes. */

.pad-assistente {
    padding: 65px 0;
    background: #edf6fb;
    border-top: 1px solid #d5e5ef;
}

.pad-tag {
    display: inline-block;
    color: #11618d;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .08em;
    margin-bottom: 10px;
}

.pad-assistente h2,
.pad-participacao h2 {
    font-size: clamp(28px, 3.5vw, 40px);
    line-height: 1.2;
    color: #103e60;
    margin: 0 0 12px;
}

.pad-assistente p,
.pad-participacao p {
    line-height: 1.7;
    color: #526f83;
}

.pad-intro {
    max-width: 750px;
    margin-bottom: 25px;
}

.pad-layout {
    display: grid;
    grid-template-columns: 1.1fr .9fr;
    gap: 18px;
}

.pad-opcoes {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
}

.pad-opcao {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 17px;
    text-align: left;
    border: 1px solid #c9dfea;
    border-radius: 12px;
    background: #fff;
    color: #153f5c;
    cursor: pointer;
    font: inherit;
    transition:
        transform .2s,
        border-color .2s,
        box-shadow .2s;
}

.pad-opcao:hover {
    transform: translateY(-3px);
    border-color: #237ba9;
    box-shadow: 0 10px 24px #123c5d12;
}

.pad-opcao[aria-pressed="true"] {
    background: #e9f8f0;
    border-color: #16865d;
}

.pad-opcao b {
    display: grid;
    place-items: center;
    flex: 0 0 35px;
    width: 35px;
    height: 35px;
    background: #e6f2f9;
    border-radius: 8px;
    font-size: 12px;
    color: #14618e;
}

.pad-opcao strong,
.pad-opcao small {
    display: block;
}

.pad-opcao strong {
    font-size: 15px;
    line-height: 1.4;
}

.pad-opcao small {
    margin-top: 4px;
    font-size: 12px;
    color: #648094;
    line-height: 1.5;
}

.pad-resultado {
    background: linear-gradient(
        135deg,
        #0d2f49,
        #17516f
    );
    color: #fff;
    border-radius: 14px;
    padding: 26px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.pad-resultado .pad-tag {
    color: #a7d9ef;
}

.pad-resultado h3 {
    color: #fff;
    margin: 0 0 12px;
    font-size: clamp(22px, 2.7vw, 28px);
}

.pad-resultado p {
    color: #dcecf5;
    margin: 0 0 16px;
}

.pad-links {
    display: grid;
    gap: 10px;
}

.pad-links a {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    text-decoration: none;
    color: #12547c;
    background: #f3faff;
    border-radius: 8px;
    padding: 13px 15px;
    font-size: 14px;
    font-weight: 700;
}

.pad-links a:hover {
    background: #dff0fa;
}

.pad-nota {
    font-size: 12px;
    margin-top: 16px;
}

.pad-participacao {
    padding: 68px 0;
    background: #fff;
}

.pad-participacao-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
    border: 1px solid #cce0ec;
    background: linear-gradient(
        110deg,
        #eef7fc,
        #fff
    );
    padding: 30px;
    border-radius: 14px;
}

.pad-participacao-box p {
    max-width: 620px;
    margin: 0;
}

.pad-participacao-links {
    min-width: 225px;
    display: grid;
    gap: 10px;
}

.pad-participacao-links a {
    text-decoration: none;
    text-align: center;
    border-radius: 9px;
    padding: 12px;
    font-size: 14px;
    font-weight: 700;
}

.pad-participacao-links a:first-child {
    background: #216f9d;
    color: #fff;
}

.pad-participacao-links a:last-child {
    border: 1px solid #bfd6e3;
    color: #185e82;
}

.pad-opcao:focus-visible,
.pad-links a:focus-visible {
    outline: 3px solid #d8a633;
    outline-offset: 3px;
}

@media (prefers-reduced-motion: no-preference) {

    .document-tile,
    .step-card {
        transition:
            transform .25s,
            box-shadow .25s;
    }

    .document-tile:hover,
    .step-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px #103b5818;
    }

    .pad-entrada {
        animation: pad-aparecer .55s ease both;
    }

    @keyframes pad-aparecer {
        from {
            opacity: .45;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
}

@media (max-width: 850px) {
    .pad-layout {
        grid-template-columns: 1fr;
    }

    .pad-participacao-box {
        flex-direction: column;
        align-items: stretch;
    }
}

@media (max-width: 540px) {
    .pad-assistente,
    .pad-participacao {
        padding: 44px 0;
    }

    .pad-opcoes {
        grid-template-columns: 1fr;
    }

    .pad-resultado,
    .pad-participacao-box {
        padding: 20px;
    }
}
</style>

</head>

<body>

<a href="#conteudo" class="skip-link">
    Saltar para o conteúdo
</a>

<!-- CABEÇALHO -->

<header class="site-header">

    <div class="wrap header-inner">

        <a href="index.php"
           class="brand"
           aria-label="PAD, página de entrada">

            <span class="brand-icon">PAD</span>

            <span class="brand-text">
                <strong>Auxílio Documental</strong>
                <small>Informação clara em Portugal</small>
            </span>

        </a>

        <nav class="header-nav"
             aria-label="Navegação da capa">

            <a href="#documentos">Documentos</a>

            <a href="#como-funciona">
                Como funciona
            </a>

            <a href="#compromisso">
                Nosso compromisso
            </a>

        </nav>

        <a href="inicio.php"
           class="button button-header">

            Entrar na plataforma

            <span aria-hidden="true">↗</span>

        </a>

    </div>

</header>


<main id="conteudo">

<!-- CARROSSEL PRINCIPAL -->

<section class="hero"
         aria-label="Apresentação da PAD">

    <div class="wrap hero-wrap">

        <div class="hero-heading">

            <span class="eyebrow">
                <span class="signal-dot"></span>
                PROJETO ACADÉMICO INDEPENDENTE
            </span>

            <span class="hero-counter"
                  id="heroCounter">
                01 / 03
            </span>

        </div>

        <div id="heroCarousel"
             class="hero-carousel"
             aria-roledescription="carrossel"
             aria-label="Destaques da plataforma">


            <!-- DESTAQUE 01 -->

            <article class="hero-slide"
                     data-slide="0"
                     role="group"
                     aria-roledescription="slide"
                     aria-label="1 de 3">

                <div class="slide-copy">

                    <span class="slide-tag">
                        INFORMAÇÃO PARA QUEM VIVE EM PORTUGAL
                    </span>

                    <h1 class="hero-title">
                        Documentação menos complicada.

                        <em>
                            Mais clareza no caminho.
                        </em>
                    </h1>

                    <p>
                        Entenda o que precisa,
                        organize os documentos
                        adequados à sua situação
                        e encontre os organismos
                        oficiais. Tudo de forma
                        gratuita e sem cadastro.
                    </p>

                    <div class="hero-actions">

                        <a href="inicio.php"
                           class="button button-primary">

                            Explorar a Plataforma

                            <span aria-hidden="true">→</span>

                        </a>

                        <a href="#documentos"
                           class="button button-ghost">

                            Conhecer os seis guias

                            <span aria-hidden="true">↓</span>

                        </a>

                    </div>

                    <div class="hero-proof">

                        <span>✓ Informação organizada</span>

                        <span class="proof-separator">•</span>

                        <span>Fontes oficiais</span>

                    </div>

                </div>


                <div class="slide-art art-journey"
                     aria-hidden="true">

                    <div class="art-topline">

                        <span class="mini-flag">
                            <i></i>
                            <b></b>
                        </span>

                        <span>PORTUGAL</span>

                        <span class="art-corner-label">
                            GUIA DOCUMENTAL
                        </span>

                    </div>

                    <div class="art-card">

                        <span class="art-card-icon">01</span>

                        <div>
                            <strong>Escolha o documento</strong>
                            <small>Informações por serviço</small>
                        </div>

                        <span class="art-check">✓</span>

                    </div>

                    <div class="art-card">

                        <span class="art-card-icon">02</span>

                        <div>
                            <strong>Identifique a sua situação</strong>
                            <small>Requisitos do seu caso</small>
                        </div>

                        <span class="art-check">✓</span>

                    </div>

                    <div class="art-card">

                        <span class="art-card-icon">03</span>

                        <div>
                            <strong>Consulte a fonte oficial</strong>
                            <small>Informação responsável</small>
                        </div>

                        <span class="art-check">↗</span>

                    </div>

                    <div class="art-caption">
                        Do primeiro passo à fonte oficial
                    </div>

                </div>

            </article>


            <!-- DESTAQUE 02 -->

            <article class="hero-slide"
                     data-slide="1"
                     role="group"
                     aria-roledescription="slide"
                     aria-label="2 de 3"
                     hidden>

                <div class="slide-copy">

                    <span class="slide-tag">
                        SEIS DOCUMENTOS NUM ÚNICO LUGAR
                    </span>

                    <h1 class="hero-title">
                        Encontre o documento certo.

                        <em>
                            Sem complicar a pesquisa.
                        </em>
                    </h1>

                    <p>
                        NIF, NISS, Número de Utente,
                        Centro de Saúde, comprovativo
                        de morada e autorização de
                        residência. Consulte guias,
                        requisitos e checklists
                        organizadas por situação.
                    </p>

                    <div class="hero-actions">

                        <a href="documentacao.php"
                           class="button button-primary">

                            Consultar documentação

                            <span aria-hidden="true">→</span>

                        </a>

                        <a href="documento.php?doc=nif"
                           class="button button-ghost">

                            Começar pelo NIF

                            <span aria-hidden="true">↗</span>

                        </a>

                    </div>

                    <div class="hero-proof">

                        <span>✓ Seis guias documentais</span>

                        <span class="proof-separator">•</span>

                        <span>Checklists interativas</span>

                    </div>

                </div>


                <div class="slide-art art-documents"
                     aria-hidden="true">

                    <div class="art-topline">
                        <span>BIBLIOTECA DOCUMENTAL</span>
                        <span>06 GUIAS</span>
                    </div>

                    <div class="mini-grid">

                        <div class="mini-doc">
                            <span>01</span>
                            <strong>NIF</strong>
                            <small>Identificação Fiscal</small>
                        </div>

                        <div class="mini-doc">
                            <span>02</span>
                            <strong>NISS</strong>
                            <small>Segurança Social</small>
                        </div>

                        <div class="mini-doc">
                            <span>03</span>
                            <strong>SNS</strong>
                            <small>Número de Utente</small>
                        </div>

                        <div class="mini-doc">
                            <span>04</span>
                            <strong>CS</strong>
                            <small>Centro de Saúde</small>
                        </div>

                        <div class="mini-doc">
                            <span>05</span>
                            <strong>MOR</strong>
                            <small>Comprovativo de Morada</small>
                        </div>

                        <div class="mini-doc">
                            <span>06</span>
                            <strong>AR</strong>
                            <small>Residência</small>
                        </div>

                    </div>

                    <div class="art-caption">
                        Informação organizada num só lugar
                    </div>

                </div>

            </article>


            <!-- DESTAQUE 03 -->

            <article class="hero-slide"
                     data-slide="2"
                     role="group"
                     aria-roledescription="slide"
                     aria-label="3 de 3"
                     hidden>

                <div class="slide-copy">

                    <span class="slide-tag">
                        INFORMAÇÃO COM RESPONSABILIDADE
                    </span>

                    <h1 class="hero-title">
                        Menos desinformação.

                        <em>
                            Mais autonomia para decidir.
                        </em>
                    </h1>

                    <p>
                        A PAD nasceu no contexto de um
                        projeto acadêmico de Engenharia
                        de Software. É uma plataforma
                        gratuita, independente e educativa
                        que procura facilitar o acesso
                        à informação.
                    </p>

                    <div class="hero-actions">

                        <a href="sobre.php"
                           class="button button-primary">

                            Conhecer a PAD

                            <span aria-hidden="true">→</span>

                        </a>

                        <a href="inicio.php"
                           class="button button-ghost">

                            Explorar a Plataforma

                            <span aria-hidden="true">↗</span>

                        </a>

                    </div>

                    <div class="hero-proof">

                        <span>✓ Projeto independente</span>

                        <span class="proof-separator">•</span>

                        <span>Finalidade social</span>

                    </div>

                </div>


                <div class="slide-art art-purpose"
                     aria-hidden="true">

                    <div class="art-topline">
                        <span>O NOSSO COMPROMISSO</span>
                        <span>PAD</span>
                    </div>

                    <div class="purpose-emblem">

                        <div class="shield">✓</div>

                        <strong>
                            Clareza, confiança e autonomia.
                        </strong>

                    </div>

                    <div class="purpose-tags">
                        <span>Sem cadastro</span>
                        <span>Sem envio de documentos</span>
                        <span>Fontes oficiais</span>
                    </div>

                    <div class="art-caption">
                        Uma iniciativa com finalidade social
                    </div>

                </div>

            </article>

        </div>


        <!-- CONTROLOS DO CARROSSEL -->

        <div class="hero-toolbar"
             id="heroToolbar"
             hidden>

            <div class="carousel-controls">

                <button type="button"
                        class="circle-button"
                        id="heroPrev"
                        aria-label="Destaque anterior">
                    ←
                </button>

                <div id="heroDots"
                     class="carousel-dots">

                    <button type="button"
                            class="carousel-dot is-active"
                            data-target="0"
                            aria-label="Mostrar destaque 1"
                            aria-current="true">
                    </button>

                    <button type="button"
                            class="carousel-dot"
                            data-target="1"
                            aria-label="Mostrar destaque 2">
                    </button>

                    <button type="button"
                            class="carousel-dot"
                            data-target="2"
                            aria-label="Mostrar destaque 3">
                    </button>

                </div>

                <button type="button"
                        class="circle-button"
                        id="heroNext"
                        aria-label="Próximo destaque">
                    →
                </button>

            </div>

            <button type="button"
                    class="pause-button"
                    id="heroPause"
                    aria-pressed="false">

                <span id="pauseSymbol"
                      aria-hidden="true">Ⅱ</span>

                <span id="pauseText">
                    Pausar apresentação
                </span>

            </button>

        </div>

        <p class="sr-only"
           id="slideAnnouncement"
           aria-live="polite"></p>

    </div>

</section>


<!-- OS SEIS DOCUMENTOS -->

<section class="documents-section"
         id="documentos">

    <div class="wrap">

        <div class="section-heading">

            <div>

                <span class="section-kicker">
                    OS SEIS DOCUMENTOS
                </span>

                <h2>Por onde deseja começar?</h2>

                <p>
                    Escolha um documento e descubra
                    o que precisa preparar.
                </p>

            </div>

            <div class="reel-toolbar">

                <span class="reel-status"
                      id="reelStatus"
                      role="status"
                      aria-live="polite">
                </span>

                <div class="reel-controls"
                     id="reelControls"
                     hidden>

                    <button type="button"
                            id="reelPrev"
                            class="reel-arrow"
                            aria-label="Documentos anteriores">
                        ←
                    </button>

                    <button type="button"
                            id="reelNext"
                            class="reel-arrow"
                            aria-label="Próximos documentos">
                        →
                    </button>

                </div>

            </div>

        </div>


        <div id="documentReel"
             class="document-reel"
             tabindex="0"
             aria-label="Lista horizontal dos seis documentos">


            <a class="document-tile"
               href="documento.php?doc=nif">

                <span class="tile-code">NIF</span>

                <strong>
                    Número de Identificação Fiscal
                </strong>

                <small>
                    Finanças e identificação tributária
                </small>

                <span class="tile-bottom">
                    Consultar guia <span>↗</span>
                </span>

            </a>


            <a class="document-tile"
               href="documento.php?doc=niss">

                <span class="tile-code">NISS</span>

                <strong>
                    Segurança Social
                </strong>

                <small>
                    Identificação e contribuições sociais
                </small>

                <span class="tile-bottom">
                    Consultar guia <span>↗</span>
                </span>

            </a>


            <a class="document-tile"
               href="documento.php?doc=utente">

                <span class="tile-code">SNS</span>

                <strong>
                    Número de Utente
                </strong>

                <small>
                    Registo nos serviços de saúde
                </small>

                <span class="tile-bottom">
                    Consultar guia <span>↗</span>
                </span>

            </a>


            <a class="document-tile"
               href="documento.php?doc=centro-saude">

                <span class="tile-code">CS</span>

                <strong>
                    Centro de Saúde
                </strong>

                <small>
                    Inscrição nos cuidados primários
                </small>

                <span class="tile-bottom">
                    Consultar guia <span>↗</span>
                </span>

            </a>


            <a class="document-tile"
               href="documento.php?doc=morada">

                <span class="tile-code">MOR</span>

                <strong>
                    Comprovativo de Morada
                </strong>

                <small>
                    Domicílio fiscal e alojamento
                </small>

                <span class="tile-bottom">
                    Consultar guia <span>↗</span>
                </span>

            </a>


            <a class="document-tile"
               href="documento.php?doc=residencia">

                <span class="tile-code">AR</span>

                <strong>
                    Autorização de Residência
                </strong>

                <small>
                    Modalidades e procedimentos da AIMA
                </small>

                <span class="tile-bottom">
                    Consultar guia <span>↗</span>
                </span>

            </a>

        </div>

        <p class="swipe-hint">
            Utilize as setas ou deslize
            horizontalmente para explorar.
        </p>

    </div>

</section>


<!-- ORIENTAÇÃO INTERATIVA -->

<section class="pad-assistente"
         id="orientacao"
         aria-labelledby="padOrientacaoTitulo">

    <div class="wrap">

        <div class="pad-intro"
             data-pad-animar>

            <span class="pad-tag">
                AJUDA PARA COMEÇAR
            </span>

            <h2 id="padOrientacaoTitulo">
                O que precisa de resolver em Portugal?
            </h2>

            <p>
                Escolha um assunto e a PAD indica
                quais guias consultar primeiro.
                Não precisa de criar conta nem
                fornecer dados pessoais.
            </p>

        </div>


        <div class="pad-layout">

            <div class="pad-opcoes"
                 role="group"
                 aria-label="Escolha um assunto"
                 data-pad-animar>

                <button type="button"
                        class="pad-opcao"
                        data-pad-assunto="comecar"
                        aria-pressed="false">

                    <b>01</b>

                    <span>
                        <strong>Estou a começar</strong>
                        <small>
                            Identificação e primeiros documentos
                        </small>
                    </span>

                </button>


                <button type="button"
                        class="pad-opcao"
                        data-pad-assunto="trabalho"
                        aria-pressed="false">

                    <b>02</b>

                    <span>
                        <strong>
                            Trabalho e Segurança Social
                        </strong>
                        <small>NIF e NISS</small>
                    </span>

                </button>


                <button type="button"
                        class="pad-opcao"
                        data-pad-assunto="saude"
                        aria-pressed="false">

                    <b>03</b>

                    <span>
                        <strong>
                            Preciso de cuidados de saúde
                        </strong>
                        <small>Utente e Centro de Saúde</small>
                    </span>

                </button>


                <button type="button"
                        class="pad-opcao"
                        data-pad-assunto="morada"
                        aria-pressed="false">

                    <b>04</b>

                    <span>
                        <strong>
                            Preciso de comprovar morada
                        </strong>
                        <small>
                            Domicílio fiscal e alojamento
                        </small>
                    </span>

                </button>


                <button type="button"
                        class="pad-opcao"
                        data-pad-assunto="residencia"
                        aria-pressed="false">

                    <b>05</b>

                    <span>
                        <strong>
                            Quero entender a residência
                        </strong>
                        <small>Modalidades e AIMA</small>
                    </span>

                </button>


                <button type="button"
                        class="pad-opcao"
                        data-pad-assunto="todos"
                        aria-pressed="false">

                    <b>06</b>

                    <span>
                        <strong>Quero explorar tudo</strong>
                        <small>Os seis guias</small>
                    </span>

                </button>

            </div>


            <div class="pad-resultado"
                 data-pad-animar
                 aria-live="polite"
                 aria-atomic="true">

                <span class="pad-tag">
                    ORIENTAÇÃO INICIAL
                </span>

                <h3 id="padResultadoTitulo">
                    A sua próxima etapa começa aqui.
                </h3>

                <p id="padResultadoDescricao">
                    Selecione um assunto para receber
                    sugestões de leitura.
                </p>

                <div class="pad-links"
                     id="padResultadoLinks">

                    <a href="documentacao.php">
                        Ver todos os guias
                        <span aria-hidden="true">↗</span>
                    </a>

                </div>

            </div>

        </div>

        <p class="pad-nota">
            Esta ferramenta ajuda a encontrar conteúdos.
            Não determina elegibilidade e não substitui
            as orientações oficiais.
        </p>

    </div>

</section>


<!-- COMO FUNCIONA -->

<section class="steps-section"
         id="como-funciona">

    <div class="wrap">

        <span class="section-kicker">
            SIMPLES E ORGANIZADO
        </span>

        <h2>
            Três passos para chegar mais preparado.
        </h2>

        <div class="steps-grid">

            <article class="step-card">

                <span class="step-number">01</span>

                <h3>Encontre o documento</h3>

                <p>
                    Escolha um dos guias
                    documentais disponíveis.
                </p>

            </article>

            <article class="step-card">

                <span class="step-number">02</span>

                <h3>Organize a sua situação</h3>

                <p>
                    Consulte os requisitos
                    correspondentes ao seu caso
                    e utilize a checklist.
                </p>

            </article>

            <article class="step-card">

                <span class="step-number">03</span>

                <h3>Confirme oficialmente</h3>

                <p>
                    Verifique as instruções junto
                    da entidade responsável antes
                    de apresentar o pedido.
                </p>

            </article>

        </div>

    </div>

</section>


<!-- PARTICIPAÇÃO DA COMUNIDADE -->

<section class="pad-participacao"
         id="participar"
         aria-labelledby="padParticiparTitulo">

    <div class="wrap">

        <div class="pad-participacao-box"
             data-pad-animar>

            <div>

                <span class="pad-tag">
                    NACIONALIDADES DA COMUNIDADE
                </span>

                <h2 id="padParticiparTitulo">
                    De que países são os participantes da PAD?
                </h2>

                <p>
                    Selecione apenas o país da sua
                    nacionalidade, sem informar nome,
                    e-mail ou documentos pessoais.
                    Conheça o ranking dos países mais
                    representados entre as pessoas
                    que decidiram participar.
                </p>

            </div>

            <div class="pad-participacao-links">

                <a href="avaliar.php">
                    Ver ranking e participar ↗
                </a>

                <a href="sobre.php">
                    Conhecer o projeto
                </a>

            </div>

        </div>

    </div>

</section>


<!-- COMPROMISSO -->

<section class="commitment-section"
         id="compromisso">

    <div class="wrap commitment-grid">

        <div>

            <span class="section-kicker">
                RESPONSABILIDADE E TRANSPARÊNCIA
            </span>

            <h2>
                Uma plataforma para informar,
                não para substituir.
            </h2>

            <p>
                A PAD é uma iniciativa acadêmica
                independente, gratuita e educativa.
                Não incentiva a imigração irregular,
                não realiza pedidos ou agendamentos
                e não recebe documentos pessoais.
            </p>

            <p>
                Também não representa a universidade,
                o Governo português ou qualquer
                organismo público. Os requisitos
                devem ser confirmados nos canais
                oficiais competentes.
            </p>

        </div>

        <div class="commitment-action">

            <div class="commitment-symbol">✓</div>

            <strong>
                Informação com responsabilidade.
            </strong>

            <a href="inicio.php"
               class="button button-primary">
                Explorar a Plataforma →
            </a>

            <a href="sobre.php"
               class="commitment-link">
                Conhecer a origem da PAD
            </a>

        </div>

    </div>

</section>

</main>


<!-- RODAPÉ -->

<footer class="cover-footer">

    <div class="wrap cover-footer-content">

        <strong>
            PAD — Plataforma de Auxílio Documental
        </strong>

        <p>
            Projeto acadêmico independente
            desenvolvido no contexto das
            Atividades Extensionistas
            de Engenharia de Software.
        </p>

        <a href="privacidade.php">
            Privacidade
        </a>

    </div>

</footer>


<!-- JAVASCRIPT DA ORIENTAÇÃO INTERATIVA -->

<script>
(function () {

    'use strict';

    const assuntos = {

        comecar: {
            titulo:
                'Comece pelos documentos de identificação',

            texto:
                'Consulte os requisitos do NIF e do NISS de acordo com a sua situação.',

            guias: [
                [
                    'NIF — identificação fiscal',
                    'documento.php?doc=nif'
                ],
                [
                    'NISS — Segurança Social',
                    'documento.php?doc=niss'
                ]
            ]
        },

        trabalho: {
            titulo:
                'Trabalho e identificação social',

            texto:
                'Consulte o NISS e o NIF antes de procurar os serviços responsáveis.',

            guias: [
                [
                    'NISS — Segurança Social',
                    'documento.php?doc=niss'
                ],
                [
                    'NIF — identificação fiscal',
                    'documento.php?doc=nif'
                ]
            ]
        },

        saude: {
            titulo:
                'Organize a sua informação de saúde',

            texto:
                'Número de Utente e inscrição no Centro de Saúde são procedimentos diferentes.',

            guias: [
                [
                    'Número de Utente',
                    'documento.php?doc=utente'
                ],
                [
                    'Centro de Saúde',
                    'documento.php?doc=centro-saude'
                ]
            ]
        },

        morada: {
            titulo:
                'Compreenda os comprovativos de morada',

            texto:
                'A certidão fiscal e a prova de alojamento não são sempre equivalentes.',

            guias: [
                [
                    'Comprovativo de Morada',
                    'documento.php?doc=morada'
                ]
            ]
        },

        residencia: {
            titulo:
                'Conheça os procedimentos de residência',

            texto:
                'Os requisitos variam conforme a modalidade. Confirme sempre junto da AIMA.',

            guias: [
                [
                    'Autorização de Residência',
                    'documento.php?doc=residencia'
                ],
                [
                    'Comprovativo de Morada',
                    'documento.php?doc=morada'
                ]
            ]
        },

        todos: {
            titulo:
                'Explore os seis guias',

            texto:
                'Conheça os documentos e os organismos competentes.',

            guias: [
                [
                    'Todos os documentos',
                    'documentacao.php'
                ]
            ]
        }

    };


    const botoes = document.querySelectorAll(
        '[data-pad-assunto]'
    );

    const titulo = document.getElementById(
        'padResultadoTitulo'
    );

    const texto = document.getElementById(
        'padResultadoDescricao'
    );

    const lista = document.getElementById(
        'padResultadoLinks'
    );


    if (
        botoes.length &&
        titulo &&
        texto &&
        lista
    ) {

        botoes.forEach(function (botao) {

            botao.addEventListener(
                'click',
                function () {

                    const item = assuntos[
                        botao.dataset.padAssunto
                    ];

                    if (!item) {
                        return;
                    }

                    botoes.forEach(function (outro) {

                        outro.setAttribute(
                            'aria-pressed',
                            String(outro === botao)
                        );

                    });

                    titulo.textContent = item.titulo;

                    texto.textContent = item.texto;

                    lista.replaceChildren();

                    item.guias.forEach(function (guia) {

                        const link =
                            document.createElement('a');

                        link.href = guia[1];

                        link.append(
                            document.createTextNode(
                                guia[0] + ' '
                            )
                        );

                        const seta =
                            document.createElement('span');

                        seta.setAttribute(
                            'aria-hidden',
                            'true'
                        );

                        seta.textContent = '↗';

                        link.appendChild(seta);

                        lista.appendChild(link);

                    });

                }
            );

        });

    }


    // Animações discretas

    if (
        'IntersectionObserver' in window &&
        !window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        ).matches
    ) {

        const observador = new IntersectionObserver(
            function (entradas) {

                entradas.forEach(function (entrada) {

                    if (entrada.isIntersecting) {

                        entrada.target.classList.add(
                            'pad-entrada'
                        );

                        observador.unobserve(
                            entrada.target
                        );

                    }

                });

            },
            {
                threshold: .1
            }
        );

        document.querySelectorAll(
            '[data-pad-animar]'
        ).forEach(function (elemento) {

            observador.observe(elemento);

        });

    }

})();
</script>

</body>
</html>
