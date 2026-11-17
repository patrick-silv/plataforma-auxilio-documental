<?php
/*
 * PAD - PLATAFORMA DE AUXÍLIO DOCUMENTAL
 *
 * Arquivo: privacidade.php
 *
 * Política de Privacidade
 *
 * Funcionalidades:
 * - Consulta gratuita dos guias
 * - Checklists documentais
 * - Participação por nacionalidade
 * - Estatísticas agregadas
 * - Cookies e sessões técnicas
 * - Segurança e hospedagem
 * - Direitos dos participantes
 */

require_once __DIR__ . '/includes/config.php';

$titulo = 'Política de Privacidade | PAD';

$descricao =
    'Saiba como a PAD disponibiliza guias gratuitos, '
    . 'utiliza checklists e apresenta estatísticas '
    . 'agregadas de participação por nacionalidade.';

$paginaIndexavel = true;

$emailPrivacidade = 'patrickprogramador.22@gmail.com';

require __DIR__ . '/includes/header.php';

?>

<main id="conteudo">

    <!-- APRESENTAÇÃO -->

    <section class="pagina-topo">

        <div class="container">

            <div class="breadcrumb">

                <a href="inicio.php">Início</a>

                / Política de Privacidade

            </div>

            <span class="etiqueta">
                TRANSPARÊNCIA E PRIVACIDADE
            </span>

            <h1>Política de Privacidade</h1>

            <p>
                A PAD disponibiliza informações
                documentais gratuitas e procura
                recolher apenas o mínimo necessário
                para o funcionamento da plataforma.
            </p>

        </div>

    </section>


    <!-- CONTEÚDO -->

    <section class="secao">

        <div class="container">

            <div class="bloco-conjunto politica">


                <!-- 1. SOBRE A PAD -->

                <h2>1. Sobre a PAD</h2>

                <p>
                    A Plataforma de Auxílio Documental
                    (PAD) é uma iniciativa informativa
                    independente, criada por um grupo
                    de imigrantes para partilhar
                    gratuitamente orientações sobre
                    documentos e procedimentos
                    administrativos em Portugal.
                </p>

                <p>
                    O desenvolvimento da plataforma
                    está também associado a uma
                    atividade extensionista do curso
                    de Engenharia de Software
                    da UNIGRAN EAD.
                </p>

                <p>
                    Essa referência identifica o
                    contexto académico do projeto
                    e não significa que a PAD seja
                    um serviço oficial da universidade.
                </p>

                <p>
                    A PAD não representa organismos
                    governamentais, não emite documentos
                    e não realiza solicitações
                    administrativas em nome
                    dos visitantes.
                </p>


                <!-- 2. GUIAS -->

                <h2>
                    2. Consulta gratuita dos guias
                </h2>

                <p>
                    O acesso aos guias é público
                    e não exige cadastro,
                    início de sessão ou identificação.
                </p>

                <p>
                    Para consultar as informações,
                    não é necessário fornecer nome,
                    e-mail, passaporte, NIF, NISS
                    ou título de residência.
                </p>

                <p>
                    A simples visita ao site pode
                    gerar registos técnicos no servidor
                    de hospedagem, explicados
                    nesta política.
                </p>


                <!-- 3. CHECKLISTS -->

                <h2>
                    3. Checklists documentais
                </h2>

                <p>
                    As checklists permitem organizar
                    os documentos necessários e marcar
                    os itens já preparados.
                </p>

                <p>
                    Na versão atual, essas seleções
                    são processadas no navegador
                    e não são guardadas pela PAD
                    numa conta ou no banco de dados
                    MySQL.
                </p>

                <p>
                    A impressão é feita pelas funções
                    do próprio navegador.
                </p>

                <p>
                    O visitante pode consultar
                    os guias e usar as checklists
                    sem participar nas estatísticas.
                </p>


                <!-- 4. NACIONALIDADE -->

                <h2>
                    4. Participação voluntária
                    por nacionalidade
                </h2>

                <p>
                    A PAD disponibiliza uma participação
                    opcional em que o visitante seleciona
                    apenas o país da sua nacionalidade.
                </p>

                <p>
                    <strong>
                        O formulário atual não pede
                        nome, e-mail, telefone,
                        comentário, endereço ou
                        documentos pessoais.
                    </strong>
                </p>

                <p>
                    A nacionalidade é indicada pelo
                    próprio participante.
                </p>

                <p>
                    Não é exigido qualquer comprovativo
                    e a resposta não é associada
                    a um perfil de utilizador.
                </p>

                <p>
                    O sistema acrescenta uma unidade
                    ao contador do país selecionado.
                </p>

                <p>
                    A tabela de estatísticas guarda
                    somente o código do país
                    e o total acumulado
                    de participações.
                </p>

                <p>
                    Essa tabela não contém nomes,
                    comentários, endereços IP,
                    horários individuais de envio
                    ou identificadores pessoais
                    dos participantes.
                </p>

                <p>
                    O objetivo é apresentar
                    as nacionalidades mais representadas
                    entre as pessoas que decidiram
                    participar.
                </p>

                <p>
                    Os resultados não medem todas
                    as visitas ao site, não identificam
                    pessoas únicas e não comprovam
                    quantas pessoas obtiveram documentos
                    com ajuda da PAD.
                </p>

                <p>
                    Para reduzir envios repetidos
                    na mesma sessão, o formulário
                    utiliza uma sessão técnica temporária.
                </p>

                <p>
                    Esse mecanismo não impede que
                    uma pessoa participe novamente
                    noutra sessão ou dispositivo.
                </p>


                <!-- 5. ESTATÍSTICAS -->

                <h2>
                    5. Publicação das estatísticas
                </h2>

                <p>
                    A página de participação apresenta
                    um ranking com os países declarados
                    e os respetivos números totais.
                </p>

                <p>
                    Não são publicados nomes,
                    testemunhos, comentários
                    ou respostas individuais.
                </p>

                <p>
                    O painel administrativo consulta
                    os mesmos contadores agregados.
                </p>

                <p>
                    O acesso à administração
                    é protegido por credenciais
                    e sessão própria.
                </p>

                <p>
                    As estatísticas agregadas
                    são mantidas enquanto forem
                    úteis à apresentação dos
                    resultados do projeto.
                </p>

                <p>
                    Não são usadas para criar
                    perfis individuais nem
                    comercializadas.
                </p>


                <!-- 6. HOSPEDAGEM -->

                <h2>
                    6. Dados técnicos da hospedagem
                </h2>

                <p>
                    Como acontece com outros sites,
                    o servidor que disponibiliza
                    a PAD pode registar dados técnicos,
                    como endereço IP, data e hora
                    do acesso, página solicitada
                    e mensagens de erro.
                </p>

                <p>
                    Estes registos podem ser necessários
                    para o funcionamento, a segurança
                    e o diagnóstico de problemas
                    da infraestrutura.
                </p>

                <p>
                    São distintos dos contadores
                    agregados de nacionalidades
                    da PAD.
                </p>

                <p>
                    O prestador de hospedagem,
                    a localização efetiva dos servidores,
                    eventuais transferências internacionais,
                    a base legal e os prazos de conservação
                    dos registos técnicos devem ser
                    confirmados nas condições do serviço
                    contratado antes da publicação pública.
                </p>


                <!-- 7. COOKIES -->

                <h2>
                    7. Cookies e sessões
                </h2>

                <p>
                    A PAD utiliza sessões PHP para
                    o funcionamento técnico e
                    a proteção dos formulários.
                </p>

                <p>
                    Esses mecanismos incluem
                    a limitação de participações
                    repetidas durante uma mesma sessão.
                </p>

                <p>
                    A área administrativa também
                    utiliza uma sessão própria
                    de autenticação.
                </p>

                <p>
                    Essas sessões podem utilizar
                    cookies técnicos.
                </p>

                <p>
                    Na implementação analisada,
                    não foram integrados pela PAD
                    sistemas próprios de publicidade
                    personalizada ou análise
                    comportamental.
                </p>

                <p>
                    Os recursos e cookies efetivamente
                    disponibilizados pela hospedagem
                    devem ser confirmados antes
                    da publicação.
                </p>


                <!-- 8. VERSÕES ANTERIORES -->

                <h2>
                    8. Informações de versões anteriores
                </h2>

                <p>
                    Uma versão anterior da PAD
                    possuía um formulário com
                    avaliações e comentários.
                </p>

                <p>
                    Essa funcionalidade foi substituída
                    pela participação por nacionalidade.
                </p>

                <p>
                    A versão atual não recolhe
                    nem publica novos comentários.
                </p>

                <p>
                    Contudo, a antiga tabela
                    <code>avaliacoes</code>
                    poderá ainda conter dados
                    de testes ou participações
                    anteriores.
                </p>

                <p>
                    Esses dados não são utilizados
                    pelo novo ranking.
                </p>

                <p>
                    Antes da publicação pública,
                    os eventuais registos antigos
                    e respetivas cópias de segurança
                    deverão ser revistos para determinar
                    se devem ser eliminados ou conservados
                    por alguma finalidade legítima
                    e documentada.
                </p>


                <!-- 9. SEGURANÇA -->

                <h2>
                    9. Segurança e conservação
                </h2>

                <p>
                    A PAD procura limitar a informação
                    recolhida, validar as entradas
                    do formulário e proteger o acesso
                    ao painel administrativo.
                </p>

                <p>
                    A nova tabela de nacionalidades
                    mantém apenas totais por país,
                    sem histórico individual.
                </p>

                <p>
                    A proteção do site depende também
                    de medidas da hospedagem, como HTTPS,
                    atualizações, permissões adequadas
                    e cópias de segurança.
                </p>

                <p>
                    Essas configurações serão verificadas
                    antes da disponibilização pública.
                </p>

                <p>
                    Os prazos de conservação de eventuais
                    dados pessoais presentes em registos
                    técnicos e na estrutura antiga
                    serão definidos conforme a sua
                    finalidade e as obrigações legais
                    aplicáveis.
                </p>


                <!-- 10. DIREITOS -->

                <h2>
                    10. Direitos relativos
                    a dados pessoais
                </h2>

                <p>
                    Quando exista tratamento de
                    dados pessoais, os titulares
                    podem exercer os direitos
                    previstos no Regulamento Geral
                    sobre a Proteção de Dados (RGPD),
                    nas condições legalmente aplicáveis.
                </p>

                <p>
                    Estes podem incluir informação,
                    acesso, retificação, apagamento,
                    limitação, oposição e outros
                    direitos previstos na lei.
                </p>

                <p>
                    O facto de os resultados estatísticos
                    não identificarem participantes
                    significa que não será possível
                    localizar e retirar uma participação
                    individual apenas a partir
                    do contador agregado.
                </p>

                <p>
                    Questões sobre dados pessoais
                    eventualmente presentes em registos
                    técnicos ou versões anteriores
                    podem ser enviadas para o contacto
                    de privacidade abaixo.
                </p>

                <p>
                    O visitante também pode apresentar
                    reclamação à Comissão Nacional
                    de Proteção de Dados (CNPD).
                </p>

                <p>
                    Consulte

                    <a
                        href="https://www.cnpd.pt/"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        o site oficial da CNPD
                    </a>.
                </p>


                <!-- 11. RESPONSÁVEIS -->

                <h2>
                    11. Responsáveis e contacto
                </h2>

                <p>
                    A PAD é apresentada como uma
                    iniciativa independente de
                    um grupo de imigrantes,
                    com finalidade informativa
                    e social.
                </p>

                <p>
                    <strong>
                        Contacto para privacidade:
                    </strong>

                    <a
                        href="mailto:<?= htmlspecialchars(
                            $emailPrivacidade,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >
                        <?= htmlspecialchars(
                            $emailPrivacidade,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </a>
                </p>

                <p>
                    A identificação formal da pessoa
                    ou entidade responsável pelo
                    tratamento dos eventuais dados
                    pessoais deve ser confirmada
                    antes da publicação pública
                    da plataforma.
                </p>


                <!-- 12. LIGAÇÕES EXTERNAS -->

                <h2>
                    12. Ligações externas
                </h2>

                <p>
                    Os guias da PAD apresentam ligações
                    para portais e serviços oficiais
                    portugueses.
                </p>

                <p>
                    Ao seguir uma ligação externa,
                    o visitante passa a utilizar
                    as condições e a política de
                    privacidade do respetivo organismo.
                </p>


                <!-- 13. ALTERAÇÕES -->

                <h2>
                    13. Atualizações desta política
                </h2>

                <p>
                    Esta política será revista
                    sempre que forem alteradas
                    as funcionalidades, a recolha
                    de informações ou as condições
                    relevantes da hospedagem.
                </p>

                <p>
                    <strong>
                        Última revisão:
                    </strong>

                    12/11/2026.
                </p>


                <!-- AVISO FINAL -->

                <div class="aviso-legal">

                    <strong>
                        O nosso compromisso
                    </strong>

                    <p>
                        A PAD foi criada para partilhar
                        informações documentais gratuitas.
                    </p>

                    <p>
                        A consulta dos guias não exige
                        identificação, e a participação
                        por nacionalidade é inteiramente
                        opcional.
                    </p>

                    <p>
                        As estatísticas exibidas
                        são contagens por país,
                        e não uma identificação
                        dos visitantes ou uma medição
                        de todos os acessos ao site.
                    </p>

                </div>


                <!-- NAVEGAÇÃO -->

                <p>

                    <a
                        href="avaliar.php"
                        class="botao botao-secundario"
                    >
                        Consultar nacionalidades participantes
                    </a>

                </p>

                <p>

                    <a
                        href="inicio.php"
                        class="botao botao-primario"
                    >
                        Voltar à plataforma
                    </a>

                </p>

            </div>

        </div>

    </section>

</main>

<?php

require __DIR__ . '/includes/footer.php';

?>
