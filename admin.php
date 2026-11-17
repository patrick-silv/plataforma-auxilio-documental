<?php
/*
 * PAD - PLATAFORMA DE AUXÍLIO DOCUMENTAL
 * PAINEL ADMINISTRATIVO
 *
 * Autenticação por e-mail e senha.
 *
 * Banco: pad_plataforma
 * Tabelas:
 * - pad_admins
 * - pad_participacoes_paises
 */

// ============================================
// CABEÇALHOS DE SEGURANÇA
// ============================================

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: no-referrer');

header(
    'Cache-Control: no-store, no-cache, must-revalidate, max-age=0'
);

header('Pragma: no-cache');

// ============================================
// SESSÃO ADMINISTRATIVA INDEPENDENTE
// ============================================

ini_set('session.use_strict_mode', '1');

session_name('PAD_ADMIN_SESS');

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => !empty($_SERVER['HTTPS'])
        && $_SERVER['HTTPS'] !== 'off',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

require_once __DIR__ . '/includes/conexao.php';

// ============================================
// FUNÇÕES AUXILIARES
// ============================================

function padAdminH($texto): string
{
    return htmlspecialchars(
        (string) $texto,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

function padAdminVoltar(): void
{
    header('Location: admin.php', true, 303);
    exit;
}

function padAdminEmailValido(string $email): bool
{
    return strlen($email) <= 254
        && filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        ) !== false;
}

// ============================================
// NOMES DOS PAÍSES
// ============================================

function padNomePais(string $codigo): string
{
    $nomes = [
        'AL' => 'Albânia',
        'AO' => 'Angola',
        'AR' => 'Argentina',
        'BE' => 'Bélgica',
        'BO' => 'Bolívia',
        'BR' => 'Brasil',
        'CA' => 'Canadá',
        'CH' => 'Suíça',
        'CN' => 'China',
        'CO' => 'Colômbia',
        'CV' => 'Cabo Verde',
        'DE' => 'Alemanha',
        'DO' => 'República Dominicana',
        'ES' => 'Espanha',
        'FR' => 'França',
        'GB' => 'Reino Unido',
        'GW' => 'Guiné-Bissau',
        'IN' => 'Índia',
        'IT' => 'Itália',
        'JP' => 'Japão',
        'MA' => 'Marrocos',
        'MZ' => 'Moçambique',
        'NG' => 'Nigéria',
        'NP' => 'Nepal',
        'PE' => 'Peru',
        'PK' => 'Paquistão',
        'PT' => 'Portugal',
        'RO' => 'Roménia',
        'RU' => 'Rússia',
        'ST' => 'São Tomé e Príncipe',
        'TL' => 'Timor-Leste',
        'TR' => 'Turquia',
        'UA' => 'Ucrânia',
        'US' => 'Estados Unidos',
        'VE' => 'Venezuela',
        'XK' => 'Kosovo'
    ];

    if (isset($nomes[$codigo])) {
        return $nomes[$codigo];
    }

    if (class_exists('Locale')) {

        $nome = Locale::getDisplayRegion(
            'und_' . $codigo,
            'pt_PT'
        );

        if (
            is_string($nome)
            && $nome !== ''
            && strcasecmp($nome, $codigo) !== 0
        ) {
            return ucfirst($nome);
        }
    }

    return 'País (' . $codigo . ')';
}

// ============================================
// TOKEN CSRF
// ============================================

if (empty($_SESSION['pad_admin_csrf'])) {

    $_SESSION['pad_admin_csrf'] =
        bin2hex(random_bytes(32));
}

$erro = '';

$sucesso = is_string(
    $_SESSION['pad_admin_mensagem'] ?? null
)
    ? $_SESSION['pad_admin_mensagem']
    : '';

unset($_SESSION['pad_admin_mensagem']);

// ============================================
// VERIFICAR ADMINISTRADORES EXISTENTES
// ============================================

$totalAdmins = (int) $conn->query(
    'SELECT COUNT(*) FROM pad_admins'
)->fetch_row()[0];

// A criação inicial só fica disponível
// no ambiente local.

$ipLocal = in_array(
    $_SERVER['REMOTE_ADDR'] ?? '',
    ['127.0.0.1', '::1'],
    true
);

$servidorLocal = in_array(
    strtolower($_SERVER['SERVER_NAME'] ?? ''),
    ['localhost', '127.0.0.1', '::1'],
    true
);

$ambienteLocal = strtolower(
    (string) (getenv('PAD_AMBIENTE') ?: 'local')
) !== 'producao';

$podeCriar =
    $totalAdmins === 0
    && $ipLocal
    && $servidorLocal
    && $ambienteLocal;

// ============================================
// VERIFICAR SESSÃO DO ADMINISTRADOR
// ============================================

$admin = null;

if (!empty($_SESSION['pad_admin_id'])) {

    $idSessao = (int) $_SESSION['pad_admin_id'];

    $consulta = $conn->prepare(
        'SELECT id, email
         FROM pad_admins
         WHERE id = ?
         LIMIT 1'
    );

    $consulta->bind_param('i', $idSessao);
    $consulta->execute();

    $admin = $consulta
        ->get_result()
        ->fetch_assoc() ?: null;

    $consulta->close();

    if ($admin === null) {
        unset($_SESSION['pad_admin_id']);
    }
}

// ============================================
// CONTROLO DE TENTATIVAS DE LOGIN
// ============================================

$agora = time();

if (!isset($_SESSION['pad_admin_tentativas'])) {
    $_SESSION['pad_admin_tentativas'] = 0;
}

if (!isset($_SESSION['pad_admin_bloqueio_ate'])) {
    $_SESSION['pad_admin_bloqueio_ate'] = 0;
}

if (
    $agora >=
    (int) $_SESSION['pad_admin_bloqueio_ate']
) {

    $_SESSION['pad_admin_bloqueio_ate'] = 0;

    if (
        (int) $_SESSION['pad_admin_tentativas'] >= 5
    ) {
        $_SESSION['pad_admin_tentativas'] = 0;
    }
}

// ============================================
// PROCESSAR FORMULÁRIOS
// ============================================

if (
    ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST'
) {

    $acao = is_string($_POST['acao'] ?? null)
        ? $_POST['acao']
        : '';

    $csrfRecebido = is_string(
        $_POST['csrf'] ?? null
    )
        ? $_POST['csrf']
        : '';

    if (!hash_equals(
        (string) $_SESSION['pad_admin_csrf'],
        $csrfRecebido
    )) {

        $erro =
            'Sessão inválida. Atualize a página '
            . 'e tente novamente.';

    }

    // ========================================
    // TERMINAR SESSÃO
    // ========================================

    elseif ($acao === 'sair' && $admin !== null) {

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $p = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                [
                    'expires' => time() - 42000,
                    'path' => $p['path'],
                    'domain' => $p['domain'],
                    'secure' => $p['secure'],
                    'httponly' => $p['httponly'],
                    'samesite' => 'Lax'
                ]
            );
        }

        session_destroy();

        padAdminVoltar();
    }

    // ========================================
    // CRIAR PRIMEIRO ADMINISTRADOR
    // ========================================

    elseif ($acao === 'criar' && $podeCriar) {

        $email = strtolower(trim(
            is_string($_POST['email'] ?? null)
                ? $_POST['email']
                : ''
        ));

        $senha = is_string($_POST['senha'] ?? null)
            ? $_POST['senha']
            : '';

        $confirmacao = is_string(
            $_POST['confirmacao'] ?? null
        )
            ? $_POST['confirmacao']
            : '';

        if (!padAdminEmailValido($email)) {

            $erro =
                'Introduza um endereço de e-mail válido.';

        } elseif (
            strlen($senha) < 12
            || strlen($senha) > 72
        ) {

            $erro =
                'A senha deve ter entre 12 e 72 bytes.';

        } elseif (!hash_equals(
            $senha,
            $confirmacao
        )) {

            $erro =
                'As senhas não coincidem.';

        } else {

            try {

                $senhaHash = password_hash(
                    $senha,
                    PASSWORD_DEFAULT
                );

                $stmt = $conn->prepare(
                    'INSERT INTO pad_admins
                     (email, senha_hash)
                     VALUES (?, ?)'
                );

                $stmt->bind_param(
                    'ss',
                    $email,
                    $senhaHash
                );

                $stmt->execute();
                $stmt->close();

                $_SESSION['pad_admin_mensagem'] =
                    'Administrador criado. Entre '
                    . 'com o seu e-mail e senha.';

                padAdminVoltar();

            } catch (mysqli_sql_exception $excecao) {

                error_log(
                    '[PAD] Falha ao criar administrador: '
                    . $excecao->getMessage()
                );

                $erro =
                    'Não foi possível criar o '
                    . 'administrador. Verifique '
                    . 'a configuração do banco.';
            }
        }
    }

    // ========================================
    // LOGIN COM E-MAIL
    // ========================================

    elseif (
        $acao === 'entrar'
        && $totalAdmins > 0
        && $admin === null
    ) {

        if (
            $agora <
            (int) $_SESSION['pad_admin_bloqueio_ate']
        ) {

            $erro =
                'Muitas tentativas. Aguarde '
                . '15 minutos antes de tentar novamente.';

        } else {

            $email = strtolower(trim(
                is_string($_POST['email'] ?? null)
                    ? $_POST['email']
                    : ''
            ));

            $senha = is_string(
                $_POST['senha'] ?? null
            )
                ? $_POST['senha']
                : '';

            $registo = null;

            if (padAdminEmailValido($email)) {

                $stmt = $conn->prepare(
                    'SELECT id, senha_hash
                     FROM pad_admins
                     WHERE email = ?
                     LIMIT 1'
                );

                $stmt->bind_param('s', $email);
                $stmt->execute();

                $registo = $stmt
                    ->get_result()
                    ->fetch_assoc() ?: null;

                $stmt->close();
            }

            if (
                $registo
                && password_verify(
                    $senha,
                    $registo['senha_hash']
                )
            ) {

                session_regenerate_id(true);

                $_SESSION['pad_admin_id'] =
                    (int) $registo['id'];

                $_SESSION['pad_admin_csrf'] =
                    bin2hex(random_bytes(32));

                $_SESSION['pad_admin_tentativas'] = 0;
                $_SESSION['pad_admin_bloqueio_ate'] = 0;

                padAdminVoltar();
            }

            $_SESSION['pad_admin_tentativas'] =
                (int) $_SESSION['pad_admin_tentativas']
                + 1;

            if (
                $_SESSION['pad_admin_tentativas'] >= 5
            ) {

                $_SESSION['pad_admin_bloqueio_ate'] =
                    time() + 900;

                $erro =
                    'Muitas tentativas. Aguarde '
                    . '15 minutos antes de tentar novamente.';

            } else {

                $erro =
                    'E-mail ou senha incorretos.';
            }
        }

    } else {

        $erro = 'Operação não autorizada.';
    }
}

// ============================================
// CONSULTAR RANKING DE NACIONALIDADES
// ============================================

$ranking = [];

$totalParticipacoes = 0;
$totalPaises = 0;

if ($admin !== null) {

    $resultado = $conn->query(
        'SELECT codigo_pais, total
         FROM pad_participacoes_paises
         ORDER BY total DESC, codigo_pais ASC'
    );

    while ($linha = $resultado->fetch_assoc()) {

        $codigo = strtoupper(
            (string) $linha['codigo_pais']
        );

        $total = (int) $linha['total'];

        $ranking[] = [
            'codigo' => $codigo,
            'pais' => padNomePais($codigo),
            'total' => $total
        ];

        $totalParticipacoes += $total;
        $totalPaises++;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="robots"
        content="noindex, nofollow"
    >

    <title>Administração | PAD</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eaf4fa;
            color: #113a59;
            font-family: Arial, Helvetica, sans-serif;
        }

        header {
            background: #0c2e49;
            color: #fff;
            border-bottom: 3px solid #18976c;
            padding: 24px 20px;
        }

        header .limite {
            max-width: 1080px;
            margin: auto;
            font-weight: 700;
        }

        main {
            max-width: 1080px;
            margin: 48px auto 70px;
            padding: 0 20px;
        }

        h1 {
            font-size: clamp(28px, 4vw, 38px);
            margin: 0 0 16px;
        }

        h2 {
            margin: 0 0 18px;
            font-size: 22px;
        }

        p {
            line-height: 1.6;
        }

        .subtitulo {
            font-size: 14px;
            color: #527994;
            margin-bottom: 25px;
        }

        .caixa {
            background: #fff;
            border: 1px solid #bfdaeb;
            border-radius: 14px;
            padding: 26px;
            max-width: 580px;
        }

        .caixa.larga {
            max-width: none;
        }

        label {
            display: block;
            font-weight: 700;
            font-size: 14px;
            margin: 16px 0 8px;
        }

        input {
            display: block;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            border: 1px solid #a4c4d9;
            font: inherit;
        }

        button {
            cursor: pointer;
            display: inline-block;
            border: 0;
            border-radius: 8px;
            background: #216fa3;
            color: white;
            font-size: 14px;
            font-weight: 700;
            padding: 13px 18px;
            margin-top: 16px;
        }

        button:hover {
            background: #185b89;
        }

        .alerta {
            padding: 16px;
            border-radius: 9px;
            margin: 0 0 18px;
        }

        .erro {
            background: #fff4df;
            border: 1px solid #edc881;
            color: #4c3c1a;
        }

        .sucesso {
            background: #e5f7e9;
            border: 1px solid #a6d7b5;
            color: #22563a;
        }

        .topo-painel {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .topo-painel form {
            margin: 0;
        }

        .topo-painel button {
            margin: 0;
        }

        .metricas {
            display: grid;
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .metrica {
            background: white;
            border: 1px solid #bfdaeb;
            border-radius: 12px;
            padding: 20px;
        }

        .metrica strong {
            display: block;
            font-size: 32px;
            margin-bottom: 6px;
        }

        .metrica span {
            color: #527994;
            font-size: 14px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            border-bottom: 1px solid #d9e8f0;
            padding: 13px 9px;
        }

        th {
            font-size: 13px;
            color: #476f8a;
        }

        .num {
            text-align: right;
        }

        .nota {
            color: #617d91;
            font-size: 13px;
            line-height: 1.7;
        }

        @media (max-width: 650px) {

            main {
                margin-top: 30px;
            }

            .metricas {
                grid-template-columns: 1fr;
            }

            .caixa {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="limite">
        PAD · Área administrativa
    </div>
</header>

<main>

<?php if ($admin !== null): ?>

    <!-- PAINEL AUTENTICADO -->

    <div class="topo-painel">

        <div>
            <h1>Painel administrativo</h1>

            <p class="subtitulo">
                Sessão:
                <?= padAdminH($admin['email']) ?>
            </p>
        </div>

        <form action="admin.php" method="post">

            <input
                type="hidden"
                name="csrf"
                value="<?= padAdminH(
                    $_SESSION['pad_admin_csrf']
                ) ?>"
            >

            <input
                type="hidden"
                name="acao"
                value="sair"
            >

            <button type="submit">
                Terminar sessão
            </button>
        </form>

    </div>

    <?php if ($erro !== ''): ?>

        <p class="alerta erro" role="alert">
            <?= padAdminH($erro) ?>
        </p>

    <?php endif; ?>

    <p class="subtitulo">
        Estatísticas das participações voluntárias
        por nacionalidade. Não representam visitas
        nem pessoas únicas.
    </p>

    <div class="metricas">

        <div class="metrica">
            <strong><?= $totalParticipacoes ?></strong>
            <span>Participações registadas</span>
        </div>

        <div class="metrica">
            <strong><?= $totalPaises ?></strong>
            <span>Países e territórios representados</span>
        </div>

    </div>

    <section class="caixa larga">

        <h2>Ranking de nacionalidades</h2>

        <?php if (!$ranking): ?>

            <p>
                Ainda não existem participações
                voluntárias registadas.
            </p>

        <?php else: ?>

            <table>

                <thead>
                    <tr>
                        <th>Posição</th>
                        <th>País / território</th>
                        <th class="num">
                            Participações
                        </th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($ranking as $indice => $item): ?>

                    <tr>
                        <td>
                            <?= $indice + 1 ?>.º
                        </td>

                        <td>
                            <?= padAdminH($item['pais']) ?>
                        </td>

                        <td class="num">
                            <?= $item['total'] ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </section>

    <p class="nota">
        Os resultados são contadores agregados
        de escolhas voluntárias.
        Não permitem identificar visitantes
        individuais.
    </p>

<?php elseif ($podeCriar): ?>

    <!-- CADASTRO DO PRIMEIRO ADMINISTRADOR -->

    <h1>Criar administrador</h1>

    <p class="subtitulo">
        A administração apresenta apenas
        contadores de participações por país.
    </p>

    <?php if ($erro !== ''): ?>

        <p class="alerta erro" role="alert">
            <?= padAdminH($erro) ?>
        </p>

    <?php endif; ?>

    <section class="caixa">

        <h2>Configurar o primeiro acesso</h2>

        <p>
            Introduza o seu e-mail e crie uma
            senha exclusiva. Este formulário
            deixará de aparecer após o cadastro.
        </p>

        <form action="admin.php" method="post">

            <input
                type="hidden"
                name="acao"
                value="criar"
            >

            <input
                type="hidden"
                name="csrf"
                value="<?= padAdminH(
                    $_SESSION['pad_admin_csrf']
                ) ?>"
            >

            <label for="email">
                E-mail do administrador
            </label>

            <input
                id="email"
                type="email"
                name="email"
                maxlength="254"
                autocomplete="email"
                placeholder="exemplo@dominio.com"
                required
            >

            <label for="senha">
                Senha (mínimo de 12 caracteres)
            </label>

            <input
                id="senha"
                type="password"
                name="senha"
                minlength="12"
                autocomplete="new-password"
                required
            >

            <label for="confirmacao">
                Confirmar senha
            </label>

            <input
                id="confirmacao"
                type="password"
                name="confirmacao"
                minlength="12"
                autocomplete="new-password"
                required
            >

            <button type="submit">
                Criar administrador
            </button>

        </form>

    </section>

<?php elseif ($totalAdmins > 0): ?>

    <!-- LOGIN COM E-MAIL -->

    <h1>Entrar na administração</h1>

    <p class="subtitulo">
        Acesso exclusivo ao painel de estatísticas
        da PAD.
    </p>

    <?php if ($sucesso !== ''): ?>

        <p class="alerta sucesso" role="status">
            <?= padAdminH($sucesso) ?>
        </p>

    <?php endif; ?>

    <?php if ($erro !== ''): ?>

        <p class="alerta erro" role="alert">
            <?= padAdminH($erro) ?>
        </p>

    <?php endif; ?>

    <section class="caixa">

        <h2>Iniciar sessão</h2>

        <form action="admin.php" method="post">

            <input
                type="hidden"
                name="acao"
                value="entrar"
            >

            <input
                type="hidden"
                name="csrf"
                value="<?= padAdminH(
                    $_SESSION['pad_admin_csrf']
                ) ?>"
            >

            <label for="email">
                E-mail
            </label>

            <input
                id="email"
                type="email"
                name="email"
                maxlength="254"
                autocomplete="username"
                required
            >

            <label for="senha">
                Senha
            </label>

            <input
                id="senha"
                type="password"
                name="senha"
                autocomplete="current-password"
                required
            >

            <button type="submit">
                Entrar
            </button>

        </form>

    </section>

<?php else: ?>

    <!-- BLOQUEIO DE CRIAÇÃO REMOTA -->

    <h1>Administração indisponível</h1>

    <p>
        O primeiro administrador deve ser
        configurado localmente antes da publicação.

        Não é permitido criar a primeira conta
        pela Internet.
    </p>

<?php endif; ?>

</main>

</body>
</html>
