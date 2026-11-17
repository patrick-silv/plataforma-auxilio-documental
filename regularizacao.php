<?php

$titulo = 'Passo a Passo | PAD';

require __DIR__ . '/includes/header.php';

$etapas = [

    [
        'Identifique o objetivo',
        'Defina se pretende obter NIF, NISS,
        Número de Utente, inscrição no Centro
        de Saúde, comprovativo de morada
        ou autorização de residência.'
    ],

    [
        'Escolha o guia correto',
        'Abra o documento correspondente
        e identifique a situação que
        se aplica ao seu caso.'
    ],

    [
        'Organize a documentação',
        'Prepare a identificação,
        os comprovativos e os demais
        documentos exigidos.'
    ],

    [
        'Confirme a fonte oficial',
        'Antes de enviar o pedido ou
        comparecer ao atendimento,
        confirme os requisitos atualizados.'
    ],

    [
        'Faça o pedido',
        'Utilize o serviço online ou
        atendimento presencial indicado
        para o procedimento.'
    ],

    [
        'Guarde os comprovativos',
        'Conserve recibos, referências,
        confirmações e documentos
        relacionados ao pedido.'
    ]

];

?>

<main id="conteudo">

    <section class="pagina-topo">

        <div class="container">

            <div class="breadcrumb">
                <a href="index.php">Início</a>
                / Passo a Passo
            </div>

            <span class="etiqueta">
                ORIENTAÇÃO DOCUMENTAL
            </span>

            <h1>
                Organize o pedido documental
                em seis etapas
            </h1>

            <p>
                Um roteiro para preparar os pedidos
                e evitar erros frequentes.
            </p>

        </div>

    </section>


    <section class="secao">

        <div class="container">

            <div class="fluxo">

                <?php foreach ($etapas as $i => $item): ?>

                    <article class="fluxo-item">

                        <span><?= $i + 1 ?></span>

                        <div>

                            <h2><?= e($item[0]) ?></h2>

                            <p><?= e($item[1]) ?></p>

                            <?php if ($i === 1): ?>

                                <a href="documentacao.php"
                                   class="link">

                                    Consultar guias →

                                </a>

                            <?php endif; ?>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <section class="secao fundo-suave" id="conjunto">

        <div class="container">

            <div class="bloco-conjunto">

                <span class="etiqueta">
                    SERVIÇO INTEGRADO
                </span>

                <h2>
                    Pedir NIF, NISS e
                    Número de Utente juntos
                </h2>

                <p>
                    Existe um serviço público integrado
                    em Espaços Cidadão participantes
                    para determinadas pessoas estrangeiras
                    com morada em Portugal.
                </p>

                <h3>Quem pode utilizar?</h3>

                <p>
                    Entre as condições oficiais,
                    é necessário não possuir
                    Cartão de Cidadão português
                    e enquadrar-se numa das
                    situações previstas:
                </p>

                <ul class="lista-check">

                    <li>
                        Ter pedido ou obtido
                        autorização de residência.
                    </li>

                    <li>
                        Ter nacionalidade de um
                        país da União Europeia.
                    </li>

                    <li>
                        Ter pedido proteção internacional.
                    </li>

                    <li>
                        Ser refugiado ou beneficiário
                        de proteção internacional.
                    </li>

                </ul>

                <h3>Como solicitar?</h3>

                <ol class="lista-comum">

                    <li>
                        Consulte a página oficial
                        do serviço no gov.pt.
                    </li>

                    <li>
                        Confirme se cumpre
                        uma das condições.
                    </li>

                    <li>
                        Identifique os Espaços
                        Cidadão participantes.
                    </li>

                    <li>
                        Verifique os documentos
                        exigidos para o seu caso.
                    </li>

                    <li>
                        Compareça ou utilize
                        representante autorizado,
                        conforme as regras do serviço.
                    </li>

                </ol>

                <p>
                    O gov.pt informa também condições
                    específicas para representação
                    de menores e pedidos apresentados
                    por representante legal.
                </p>

                <a
                    href="https://www.gov.pt/servicos/pedir-os-numeros-de-identificacao-fiscal-seguranca-social-e-nacional-de-utente-saude-para-estrangeiros"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="botao botao-primario">

                    Consultar o serviço oficial ↗

                </a>

            </div>

        </div>

    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>