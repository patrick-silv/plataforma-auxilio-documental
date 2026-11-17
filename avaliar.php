<?php
/*
 * PAD - Participação por nacionalidade
 * Arquivo: avaliar.php
 *
 * Requer:
 * - includes/config.php
 * - includes/conexao.php
 * - tabela pad_participacoes_paises
 *
 * Não solicita nome, comentário, e-mail
 * ou identificação documental.
 *
 * Guarda somente contadores por país.
 */

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

header('Referrer-Policy: no-referrer');
header('X-Content-Type-Options: nosniff');

require_once __DIR__ . '/includes/config.php';


function padPaisEscapar($valor): string
{
    return htmlspecialchars(
        (string) $valor,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}


/*
 * Países e territórios.
 *
 * Os códigos são usados no banco de dados.
 * Os nomes são apresentados ao visitante.
 */

$listaPaises = <<<'PAISES'
AF|Afeganistão
ZA|África do Sul
AL|Albânia
DE|Alemanha
AD|Andorra
AO|Angola
AI|Anguila
AQ|Antártida
AG|Antígua e Barbuda
SA|Arábia Saudita
DZ|Argélia
AR|Argentina
AM|Arménia
AW|Aruba
AU|Austrália
AT|Áustria
AZ|Azerbaijão
BS|Baamas
BD|Bangladeche
BB|Barbados
BH|Barém
BE|Bélgica
BZ|Belize
BJ|Benim
BM|Bermudas
BY|Bielorrússia
BO|Bolívia
BA|Bósnia e Herzegovina
BW|Botsuana
BR|Brasil
BN|Brunei
BG|Bulgária
BF|Burquina Faso
BI|Burundi
BT|Butão
CV|Cabo Verde
CM|Camarões
KH|Camboja
CA|Canadá
QA|Catar
KZ|Cazaquistão
TD|Chade
CZ|Chéquia
CL|Chile
CN|China
CY|Chipre
CO|Colômbia
KM|Comores
KP|Coreia do Norte
KR|Coreia do Sul
CI|Costa do Marfim
CR|Costa Rica
HR|Croácia
CU|Cuba
CW|Curaçau
DK|Dinamarca
DM|Domínica
EG|Egito
AE|Emirados Árabes Unidos
EC|Equador
ER|Eritreia
SK|Eslováquia
SI|Eslovénia
ES|Espanha
SZ|Essuatíni
US|Estados Unidos
EE|Estónia
ET|Etiópia
FJ|Fiji
PH|Filipinas
FI|Finlândia
FR|França
GA|Gabão
GM|Gâmbia
GH|Gana
GE|Geórgia
GI|Gibraltar
GD|Granada
GR|Grécia
GL|Gronelândia
GP|Guadalupe
GU|Guame
GT|Guatemala
GG|Guernesey
GY|Guiana
GF|Guiana Francesa
GN|Guiné
GQ|Guiné Equatorial
GW|Guiné-Bissau
HT|Haiti
HN|Honduras
HK|Hong Kong, RAE da China
HU|Hungria
YE|Iémen
BV|Ilha Bouvet
IM|Ilha de Man
CX|Ilha do Natal
NF|Ilha Norfolk
AX|Ilhas Åland
KY|Ilhas Caimão
CK|Ilhas Cook
CC|Ilhas dos Cocos (Keeling)
FK|Ilhas Falkland
FO|Ilhas Faroé
GS|Ilhas Geórgia do Sul e Sandwich do Sul
HM|Ilhas Heard e McDonald
MP|Ilhas Marianas do Norte
MH|Ilhas Marshall
UM|Ilhas Menores Afastadas dos EUA
PN|Ilhas Pitcairn
SB|Ilhas Salomão
TC|Ilhas Turcas e Caicos
VG|Ilhas Virgens Britânicas
VI|Ilhas Virgens dos EUA
IN|Índia
ID|Indonésia
IR|Irão
IQ|Iraque
IE|Irlanda
IS|Islândia
IL|Israel
IT|Itália
JM|Jamaica
JP|Japão
JE|Jersey
DJ|Jibuti
JO|Jordânia
XK|Kosovo
KW|Koweit
LA|Laos
LS|Lesoto
LV|Letónia
LB|Líbano
LR|Libéria
LY|Líbia
LI|Listenstaine
LT|Lituânia
LU|Luxemburgo
MO|Macau, RAE da China
MK|Macedónia do Norte
MG|Madagáscar
YT|Maiote
MY|Malásia
MW|Maláui
MV|Maldivas
ML|Mali
MT|Malta
MA|Marrocos
MQ|Martinica
MU|Maurícia
MR|Mauritânia
MX|México
MM|Mianmar (Birmânia)
FM|Micronésia
MZ|Moçambique
MD|Moldávia
MC|Mónaco
MN|Mongólia
MS|Monserrate
ME|Montenegro
NA|Namíbia
NR|Nauru
NP|Nepal
NI|Nicarágua
NE|Níger
NG|Nigéria
NU|Niuê
NO|Noruega
NC|Nova Caledónia
NZ|Nova Zelândia
OM|Omã
NL|Países Baixos
BQ|Países Baixos Caribenhos
PW|Palau
PS|Palestina
PA|Panamá
PG|Papua-Nova Guiné
PK|Paquistão
PY|Paraguai
PE|Peru
PF|Polinésia Francesa
PL|Polónia
PR|Porto Rico
PT|Portugal
KE|Quénia
KG|Quirguistão
KI|Quiribáti
GB|Reino Unido
CF|República Centro-Africana
CD|República Democrática do Congo
CG|República do Congo
DO|República Dominicana
RE|Reunião
RO|Roménia
RW|Ruanda
RU|Rússia
SV|Salvador
WS|Samoa
AS|Samoa Americana
SH|Santa Helena
LC|Santa Lúcia
BL|São Bartolomeu
KN|São Cristóvão e Neves
SM|São Marinho
MF|São Martinho (parte francesa)
SX|São Martinho (parte neerlandesa)
PM|São Pedro e Miquelão
ST|São Tomé e Príncipe
VC|São Vicente e Granadinas
EH|Sara Ocidental
SC|Seicheles
SN|Senegal
SL|Serra Leoa
RS|Sérvia
SG|Singapura
SY|Síria
SO|Somália
LK|Sri Lanca
SD|Sudão
SS|Sudão do Sul
SE|Suécia
CH|Suíça
SR|Suriname
SJ|Svalbard e Jan Mayen
TH|Tailândia
TW|Taiwan
TJ|Tajiquistão
TZ|Tanzânia
IO|Território Britânico do Oceano Índico
TF|Territórios Austrais Franceses
TL|Timor-Leste
TG|Togo
TO|Tonga
TK|Toquelau
TT|Trindade e Tobago
TN|Tunísia
TM|Turquemenistão
TR|Turquia
TV|Tuvalu
UA|Ucrânia
UG|Uganda
UY|Uruguai
UZ|Usbequistão
VU|Vanuatu
VA|Vaticano
VE|Venezuela
VN|Vietname
WF|Wallis e Futuna
ZM|Zâmbia
ZW|Zimbabué
PAISES;


$paises = [];

foreach (
    explode("\n", $listaPaises)
    as $linhaPais
) {
    $linhaPais = trim($linhaPais);

    if ($linhaPais === '') {
        continue;
    }

    $partesPais = explode(
        '|',
        $linhaPais,
        2
    );

    if (count($partesPais) === 2) {
        $paises[$partesPais[0]] =
            $partesPais[1];
    }
}

unset(
    $listaPaises,
    $linhaPais,
    $partesPais
);


// ============================================
// PROTEÇÃO DO FORMULÁRIO
// ============================================

if (empty($_SESSION['pad_csrf_pais'])) {
    $_SESSION['pad_csrf_pais'] =
        bin2hex(random_bytes(32));
}

$erros = [];

$paisSelecionado = '';

$sucesso = !empty(
    $_SESSION['pad_pais_sucesso']
);

unset($_SESSION['pad_pais_sucesso']);

$jaParticipou = !empty(
    $_SESSION['pad_pais_participou']
);


// ============================================
// REGISTAR A PARTICIPAÇÃO
// ============================================

if (
    ($_SERVER['REQUEST_METHOD'] ?? 'GET')
    === 'POST'
) {
    $paisSelecionado =
        isset($_POST['pais'])
        && is_string($_POST['pais'])

            ? strtoupper(trim($_POST['pais']))
            : '';

    $tokenRecebido =
        isset($_POST['csrf_token'])
        && is_string($_POST['csrf_token'])

            ? $_POST['csrf_token']
            : '';

    $campoInvisivel =
        isset($_POST['website'])
        && is_string($_POST['website'])

            ? trim($_POST['website'])
            : 'invalido';


    // Verificar o token de segurança.

    if (
        !hash_equals(
            (string) $_SESSION['pad_csrf_pais'],
            $tokenRecebido
        )
    ) {
        $erros[] =
            'A sessão expirou. Atualize a página e tente novamente.';
    }


    // Verificar o campo contra spam.

    if ($campoInvisivel !== '') {
        $erros[] =
            'Não foi possível validar esta participação.';
    }


    // Aceitar apenas países da lista.

    if (!isset($paises[$paisSelecionado])) {
        $erros[] =
            'Selecione um país válido na lista.';
    }


    // Limitar a uma participação por sessão.

    if ($jaParticipou) {
        $erros[] =
            'Esta sessão já registou uma participação. Obrigado!';
    }


    // ========================================
    // ATUALIZAR O CONTADOR NO MYSQL
    // ========================================

    if ($erros === []) {

        try {

            require_once __DIR__ .
                '/includes/conexao.php';

            if (
                !isset($conn)
                || !($conn instanceof mysqli)
            ) {
                throw new RuntimeException(
                    'Ligação MySQL indisponível.'
                );
            }

            $stmt = $conn->prepare(
                'INSERT INTO pad_participacoes_paises '
                . '(codigo_pais, total) '
                . 'VALUES (?, 1) '
                . 'ON DUPLICATE KEY UPDATE '
                . 'total = total + 1'
            );

            $stmt->bind_param(
                's',
                $paisSelecionado
            );

            if (!$stmt->execute()) {
                throw new RuntimeException(
                    'Não foi possível atualizar o contador.'
                );
            }

            $stmt->close();


            // Assinalar a participação na sessão.

            $_SESSION['pad_pais_participou'] =
                true;

            $_SESSION['pad_pais_sucesso'] =
                true;

            $_SESSION['pad_csrf_pais'] =
                bin2hex(random_bytes(32));


            // Evitar repetição ao atualizar a página.

            header(
                'Location: avaliar.php#ranking',
                true,
                303
            );

            exit;

        } catch (Throwable $erro) {

            error_log(
                '[PAD] Erro ao registar país: '
                . $erro->getMessage()
            );

            $erros[] =
                'Não foi possível registar a participação. '
                . 'Confirme a configuração do banco de dados.';
        }
    }
}


// ============================================
// CONSULTAR RANKING DE NACIONALIDADES
// ============================================

$ranking = [];

$totalParticipacoes = 0;

$maiorContagem = 0;

$erroEstatisticas = false;

try {

    require_once __DIR__ .
        '/includes/conexao.php';

    if (
        !isset($conn)
        || !($conn instanceof mysqli)
    ) {
        throw new RuntimeException(
            'Ligação MySQL indisponível.'
        );
    }

    $resultado = $conn->query(
        'SELECT codigo_pais, total '
        . 'FROM pad_participacoes_paises '
        . 'WHERE total > 0 '
        . 'ORDER BY total DESC, codigo_pais ASC'
    );

    while (
        $registo = $resultado->fetch_assoc()
    ) {
        $codigo = (string)
            $registo['codigo_pais'];

        if (!isset($paises[$codigo])) {
            continue;
        }

        $total = (int)
            $registo['total'];

        $ranking[] = [
            'pais' => $paises[$codigo],
            'total' => $total
        ];

        $totalParticipacoes += $total;

        $maiorContagem = max(
            $maiorContagem,
            $total
        );
    }

    $resultado->free();

} catch (Throwable $erro) {

    error_log(
        '[PAD] Erro ao listar nacionalidades: '
        . $erro->getMessage()
    );

    $erroEstatisticas = true;
}


// ============================================
// CONFIGURAÇÃO DA PÁGINA
// ============================================

$titulo =
    'Nacionalidades dos participantes | PAD';

$descricao =
    'Consulte as nacionalidades das pessoas '
    . 'que participam voluntariamente '
    . 'na Plataforma de Auxílio Documental.';

$paginaIndexavel = false;

require_once __DIR__ .
    '/includes/header.php';

?>

<style>
.pad-nac {
    max-width: 1050px;
    margin: 44px auto 75px;
    padding: 0 20px;
    color: #173b54;
}

.pad-nac * {
    box-sizing: border-box;
}

.pad-nac h1 {
    margin: 7px 0 14px;
    font-size: clamp(30px, 4vw, 44px);
    line-height: 1.2;
    color: #123c5d;
}

.pad-nac h2 {
    margin: 0 0 12px;
    color: #123c5d;
    font-size: clamp(23px, 3vw, 30px);
}

.pad-nac p {
    line-height: 1.75;
}

.pad-nac .pad-nac-tag {
    color: #176b93;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.pad-nac .pad-nac-sub {
    max-width: 740px;
    color: #527087;
}

.pad-nac .pad-nac-grid {
    display: grid;
    grid-template-columns:
        minmax(0, .9fr)
        minmax(0, 1.1fr);
    gap: 24px;
    margin-top: 32px;
    align-items: start;
}

.pad-nac .pad-nac-card {
    min-width: 0;
    background: #fff;
    border: 1px solid #c9deeb;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 9px 26px #0b29420d;
}

.pad-nac .pad-nac-form {
    border-top: 4px solid #16865d;
}

.pad-nac .pad-nac-stats {
    border-top: 4px solid #216fa3;
}

.pad-nac label {
    display: block;
    font-weight: 750;
    color: #123c5d;
    margin: 20px 0 9px;
}

.pad-nac select {
    width: 100%;
    border: 1px solid #b9d2e2;
    padding: 13px;
    border-radius: 9px;
    font: inherit;
    background: #fff;
    color: #173b54;
}

.pad-nac select:focus-visible,
.pad-nac button:focus-visible,
.pad-nac a:focus-visible,
.pad-nac summary:focus-visible {
    outline: 3px solid #dcaf32;
    outline-offset: 3px;
}

.pad-nac .pad-nac-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    border: 0;
    border-radius: 9px;
    margin-top: 18px;
    padding: 13px 18px;
    color: #fff;
    background: #216fa3;
    font: inherit;
    font-weight: 750;
    cursor: pointer;
}

.pad-nac .pad-nac-btn:hover {
    background: #165b86;
}

.pad-nac .pad-nac-btn:disabled {
    background: #9bb3c2;
    cursor: not-allowed;
}

.pad-nac .pad-nac-note {
    color: #647e91;
    font-size: 12px;
    margin-top: 16px;
}

.pad-nac .pad-nac-message {
    border-radius: 10px;
    padding: 13px 16px;
    margin: 14px 0;
}

.pad-nac .pad-nac-ok {
    background: #e6f6ed;
    border: 1px solid #9bd2b3;
    color: #155f3b;
}

.pad-nac .pad-nac-error {
    background: #fff0f0;
    border: 1px solid #e5b1b1;
    color: #8b2c2c;
}

.pad-nac .pad-nac-counter {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding: 14px 16px;
    border-radius: 10px;
    background: #edf6fb;
    margin: 15px 0 24px;
}

.pad-nac .pad-nac-counter strong {
    color: #14577e;
    font-size: 26px;
}

.pad-nac .pad-nac-counter span {
    display: block;
    font-size: 12px;
    color: #5e798c;
}

.pad-nac .pad-ranking {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: 15px;
}

.pad-nac .pad-ranking li {
    margin: 0;
    min-width: 0;
}

.pad-nac .pad-ranking-title {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    gap: 10px;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 7px;
}

.pad-nac .pad-ranking-title span {
    min-width: 0;
    overflow-wrap: anywhere;
}

.pad-nac .pad-ranking-title strong {
    flex-shrink: 0;
    color: #165e87;
    font-variant-numeric: tabular-nums;
}

.pad-nac .pad-ranking-track {
    height: 10px;
    background: #edf4f8;
    border-radius: 20px;
    overflow: hidden;
}

.pad-nac .pad-ranking-fill {
    display: block;
    height: 100%;
    border-radius: 20px;
    background: linear-gradient(
        90deg,
        #216fa3,
        #16865d
    );
}

.pad-nac details {
    margin-top: 20px;
    border-top: 1px solid #d6e5ed;
    padding-top: 15px;
}

.pad-nac summary {
    font-weight: 750;
    color: #155e88;
    cursor: pointer;
}

.pad-nac .pad-nac-honey {
    position: absolute;
    left: -10000px;
    width: 1px;
    height: 1px;
    overflow: hidden;
}

.pad-nac .pad-nac-alerta {
    margin-top: 30px;
    padding: 16px 20px;
    border: 1px solid #cddfeb;
    border-radius: 11px;
    color: #577286;
    background: #f0f7fb;
    font-size: 13px;
}

@media (max-width: 780px) {
    .pad-nac .pad-nac-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 520px) {
    .pad-nac {
        margin-top: 30px;
    }

    .pad-nac .pad-nac-card {
        padding: 20px;
    }
}

@media (prefers-reduced-motion: no-preference) {
    .pad-nac .pad-nac-btn,
    .pad-nac .pad-ranking-fill {
        transition:
            background .2s,
            width .3s;
    }
}
</style>


<main id="conteudo" class="pad-nac">

    <span class="pad-nac-tag">
        PARTICIPAÇÃO VOLUNTÁRIA · PAD
    </span>

    <h1>
        De que países são os participantes da PAD?
    </h1>

    <p class="pad-nac-sub">
        Selecione apenas o país da sua nacionalidade.
        Não pedimos nome, comentário, e-mail ou
        documentos. As participações são apresentadas
        em totais por país, sem identificação individual.
    </p>


    <div class="pad-nac-grid">

        <!-- FORMULÁRIO -->

        <section
            class="pad-nac-card pad-nac-form"
            aria-labelledby="pad-nac-form-titulo"
        >

            <h2 id="pad-nac-form-titulo">
                Participar é simples
            </h2>

            <p>
                Com uma seleção, ajuda-nos a conhecer
                as nacionalidades das pessoas que
                utilizam os conteúdos da PAD.
            </p>


            <?php if ($sucesso): ?>

                <div
                    class="pad-nac-message pad-nac-ok"
                    role="status"
                >
                    Obrigado! A sua participação
                    foi contabilizada no ranking.
                </div>

            <?php endif; ?>


            <?php if ($erros !== []): ?>

                <div
                    class="pad-nac-message pad-nac-error"
                    role="alert"
                >

                    <ul>

                        <?php foreach (
                            $erros as $mensagem
                        ): ?>

                            <li>
                                <?= padPaisEscapar(
                                    $mensagem
                                ) ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>


            <form
                method="post"
                action="avaliar.php#ranking"
                accept-charset="UTF-8"
            >

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= padPaisEscapar(
                        $_SESSION['pad_csrf_pais']
                    ) ?>"
                >


                <!-- Campo invisível contra spam -->

                <div
                    class="pad-nac-honey"
                    aria-hidden="true"
                >

                    <label for="website">
                        Website
                    </label>

                    <input
                        type="text"
                        id="website"
                        name="website"
                        tabindex="-1"
                        autocomplete="off"
                    >

                </div>


                <!-- ÚNICA PERGUNTA -->

                <label for="pais">
                    Qual é o país da sua nacionalidade?
                </label>

                <select
                    name="pais"
                    id="pais"
                    required
                    <?= $jaParticipou ? 'disabled' : '' ?>
                >

                    <option value="">
                        Selecione um país
                    </option>

                    <?php foreach (
                        $paises as $codigo => $nomePais
                    ): ?>

                        <option
                            value="<?= padPaisEscapar(
                                $codigo
                            ) ?>"
                            <?= $paisSelecionado === $codigo
                                ? 'selected'
                                : ''
                            ?>
                        >
                            <?= padPaisEscapar(
                                $nomePais
                            ) ?>
                        </option>

                    <?php endforeach; ?>

                </select>


                <button
                    type="submit"
                    class="pad-nac-btn"
                    <?= $jaParticipou ? 'disabled' : '' ?>
                >
                    <?= $jaParticipou
                        ? 'Participação já registada'
                        : 'Confirmar participação'
                    ?>
                </button>

            </form>


            <p class="pad-nac-note">
                A participação é opcional.
                O contador guarda apenas o país
                selecionado e o número total de
                participações por país.

                Nesta sessão é permitido um envio.
            </p>

        </section>


        <!-- RANKING PÚBLICO -->

        <section
            class="pad-nac-card pad-nac-stats"
            id="ranking"
            aria-labelledby="pad-nac-ranking-titulo"
        >

            <h2 id="pad-nac-ranking-titulo">
                Nacionalidades mais representadas
            </h2>

            <p class="pad-nac-sub">
                Ranking atualizado com base nas
                participações voluntárias recebidas.
            </p>


            <?php if ($erroEstatisticas): ?>

                <div
                    class="pad-nac-message pad-nac-error"
                    role="alert"
                >
                    Não foi possível carregar as
                    estatísticas. Verifique a ligação
                    ao banco e a tabela de participações.
                </div>


            <?php elseif ($totalParticipacoes === 0): ?>

                <div class="pad-nac-message pad-nac-ok">
                    Ainda não há participações.
                    O ranking aparecerá aqui quando
                    alguém selecionar o país.
                </div>


            <?php else: ?>

                <div class="pad-nac-counter">

                    <div>

                        <strong>
                            <?= $totalParticipacoes ?>
                        </strong>

                        <span>
                            participações registadas
                        </span>

                    </div>

                    <div>

                        <strong>
                            <?= count($ranking) ?>
                        </strong>

                        <span>
                            países e territórios
                            representados
                        </span>

                    </div>

                </div>


                <ol class="pad-ranking">

                    <?php foreach (
                        array_slice($ranking, 0, 10)
                        as $indice => $item
                    ): ?>

                        <?php

                        $largura = $maiorContagem > 0
                            ? (int) round(
                                $item['total']
                                / $maiorContagem
                                * 100
                            )
                            : 0;

                        ?>

                        <li>

                            <div class="pad-ranking-title">

                                <span>
                                    <?= $indice + 1 ?>.º

                                    <?= padPaisEscapar(
                                        $item['pais']
                                    ) ?>
                                </span>

                                <strong>
                                    <?= (int) $item['total'] ?>
                                </strong>

                            </div>


                            <div
                                class="pad-ranking-track"
                                aria-hidden="true"
                            >

                                <span
                                    class="pad-ranking-fill"
                                    style="width: <?= $largura ?>%"
                                ></span>

                            </div>

                        </li>

                    <?php endforeach; ?>

                </ol>


                <?php if (count($ranking) > 10): ?>

                    <details>

                        <summary>
                            Mostrar os restantes países
                            (<?= count($ranking) - 10 ?>)
                        </summary>

                        <ol
                            class="pad-ranking"
                            start="11"
                            style="margin-top: 18px;"
                        >

                            <?php foreach (
                                array_slice($ranking, 10)
                                as $indice => $item
                            ): ?>

                                <?php

                                $largura = $maiorContagem > 0
                                    ? (int) round(
                                        $item['total']
                                        / $maiorContagem
                                        * 100
                                    )
                                    : 0;

                                ?>

                                <li>

                                    <div class="pad-ranking-title">

                                        <span>
                                            <?= $indice + 11 ?>.º

                                            <?= padPaisEscapar(
                                                $item['pais']
                                            ) ?>
                                        </span>

                                        <strong>
                                            <?= (int) $item['total'] ?>
                                        </strong>

                                    </div>


                                    <div
                                        class="pad-ranking-track"
                                        aria-hidden="true"
                                    >

                                        <span
                                            class="pad-ranking-fill"
                                            style="width: <?= $largura ?>%"
                                        ></span>

                                    </div>

                                </li>

                            <?php endforeach; ?>

                        </ol>

                    </details>

                <?php endif; ?>

            <?php endif; ?>

        </section>

    </div>


    <!-- INFORMAÇÃO SOBRE AS ESTATÍSTICAS -->

    <div class="pad-nac-alerta">

        <strong>
            Como interpretar estes números:
        </strong>

        O ranking mostra as nacionalidades declaradas
        por quem decidiu participar.

        Não representa a quantidade de visitas,
        de pessoas únicas nem a nacionalidade
        de todos os visitantes.

        Os registos técnicos da hospedagem
        são explicados na

        <a
            href="privacidade.php"
            style="text-decoration: underline;"
        >
            Política de Privacidade
        </a>.

    </div>

</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
