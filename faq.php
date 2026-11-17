<?php

$titulo = 'Perguntas Frequentes | PAD';

require __DIR__ . '/includes/header.php';

$perguntas = [

    [
        'O NIF é gratuito?',
        'Sim. A atribuição do NIF pela
        administração pública é gratuita.
        Intermediários particulares podem
        cobrar serviços próprios.',
        'documento.php?doc=nif'
    ],

    [
        'Posso solicitar NIF sem título de residência?',
        'Existe um pedido para não residentes
        fiscais, com requisitos próprios.
        Consulte a lista correspondente
        e confirme a situação junto da AT.',
        'documento.php?doc=nif'
    ],

    [
        'O NISS é gratuito?',
        'Sim. O pedido do NISS através
        dos canais oficiais é gratuito.',
        'documento.php?doc=niss'
    ],

    [
        'O empregador pode solicitar NISS?',
        'Pode fazê-lo nas condições previstas,
        incluindo contrato e comunicação
        do vínculo laboral.',
        'documento.php?doc=niss'
    ],

    [
        'Onde posso obter Número de Utente?',
        'Numa unidade pública do SNS,
        como centro de saúde ou hospital.',
        'documento.php?doc=utente'
    ],

    [
        'Ter Número de Utente garante cuidados gratuitos?',
        'Não automaticamente.
        A cobertura das despesas depende
        das condições legais aplicáveis.',
        'documento.php?doc=utente'
    ],

    [
        'Como inscrever-me no centro de saúde?',
        'Procure uma unidade de cuidados
        de saúde primários, preferencialmente
        da sua área de residência,
        e apresente os dados exigidos.',
        'documento.php?doc=centro-saude'
    ],

    [
        'A inscrição garante médico de família?',
        'Não. A atribuição depende
        da disponibilidade e da
        organização dos serviços.',
        'documento.php?doc=centro-saude'
    ],

    [
        'Qual é o comprovativo de morada correto?',
        'Depende da finalidade.
        A certidão de domicílio fiscal
        não substitui automaticamente
        a prova de alojamento exigida pela AIMA.',
        'documento.php?doc=morada'
    ],

    [
        'Todos os pedidos de residência são iguais?',
        'Não. Trabalho, estudo, família,
        CPLP e outras modalidades
        têm regras e requisitos específicos.',
        'documento.php?doc=residencia'
    ],

    [
        'Posso pedir NIF, NISS e Utente juntos?',
        'Existe um serviço integrado
        em Espaços Cidadão participantes
        para pessoas que cumpram
        os requisitos oficiais.',
        'regularizacao.php#conjunto'
    ],

    [
        'A checklist envia os meus dados à PAD?',
        'Não. Nesta versão, as marcações
        funcionam apenas no navegador
        e são reiniciadas quando
        a página é recarregada.',
        'privacidade.php'
    ],

    [
        'A PAD substitui as entidades públicas?',
        'Não. A PAD é um projeto
        informativo independente,
        sem competência para
        decidir pedidos administrativos.',
        'sobre.php'
    ]

];

?>

<main id="conteudo">

    <section class="pagina-topo">

        <div class="container">

            <div class="breadcrumb">
                <a href="index.php">Início</a>
                / Perguntas Frequentes
            </div>

            <span class="etiqueta">
                CENTRAL DE AJUDA
            </span>

            <h1>Perguntas Frequentes</h1>

            <p>
                Respostas rápidas para dúvidas
                sobre documentação em Portugal.
            </p>

        </div>

    </section>


    <section class="secao">

        <div class="container faq-area">

            <?php foreach ($perguntas as $item): ?>

                <details class="faq-item">

                    <summary>
                        <?= e($item[0]) ?>
                    </summary>

                    <div>

                        <p><?= e($item[1]) ?></p>

                        <a href="<?= e($item[2]) ?>"
                           class="link">

                            Consultar mais informações →

                        </a>

                    </div>

                </details>

            <?php endforeach; ?>

        </div>

    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>