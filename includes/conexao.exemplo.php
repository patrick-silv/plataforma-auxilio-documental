<?php
/*
 * PAD - Plataforma de Auxílio Documental
 *
 * Arquivo: includes/conexao.exemplo.php
 * Copie este arquivo para includes/conexao.php antes de executar.
 * Nunca publique a sua cópia de conexao.php com credenciais reais.
 *
 * LOCAL:
 * Ligação ao MySQL do XAMPP.
 *
 * PRODUÇÃO:
 * Credenciais configuradas no ambiente
 * da hospedagem, fora deste arquivo.
 *
 * Nunca colocar senhas da hospedagem
 * diretamente no código público.
 */

mysqli_report(
    MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT
);


// ============================================
// 1. IDENTIFICAR O AMBIENTE
// ============================================

$ambienteConfigurado = getenv('PAD_AMBIENTE');

$ambiente = (
    $ambienteConfigurado === false
    || trim($ambienteConfigurado) === ''
)
    ? 'local'
    : strtolower(trim($ambienteConfigurado));


// Aceitar somente ambientes conhecidos.

if (!in_array(
    $ambiente,
    ['local', 'producao'],
    true
)) {

    error_log(
        '[PAD] Ambiente de banco de dados inválido.'
    );

    http_response_code(503);

    exit(
        'Configuração do sistema indisponível.'
    );
}


// ============================================
// 2. CONFIGURAÇÃO LOCAL - XAMPP
// ============================================

if ($ambiente === 'local') {

    /*
     * Impedir a utilização acidental
     * da configuração de desenvolvimento
     * em acessos externos.
     */

    $ipVisitante =
        $_SERVER['REMOTE_ADDR'] ?? '';

    $acessoLocal =
        PHP_SAPI === 'cli'
        || in_array(
            $ipVisitante,
            ['127.0.0.1', '::1'],
            true
        );

    if (!$acessoLocal) {

        error_log(
            '[PAD] Configuração local bloqueada '
            . 'para acesso externo.'
        );

        http_response_code(503);

        exit(
            'A ligação ao banco de dados '
            . 'ainda não foi configurada '
            . 'para publicação.'
        );
    }


    // Dados originais do seu XAMPP.

    $servidor = '127.0.0.1';

    $usuario = 'root';

    $senha = '';

    $banco = 'pad_plataforma';

    $porta = 3306;


// ============================================
// 3. CONFIGURAÇÃO DE PRODUÇÃO
// ============================================

} else {

    /*
     * As variáveis serão configuradas
     * na hospedagem quando tivermos
     * as credenciais definitivas.
     */

    $servidor = trim(
        (string) (
            getenv('PAD_DB_HOST') ?: ''
        )
    );

    $usuario = trim(
        (string) (
            getenv('PAD_DB_USER') ?: ''
        )
    );

    $senhaVariavel = getenv(
        'PAD_DB_PASSWORD'
    );

    $senha = $senhaVariavel === false
        ? ''
        : $senhaVariavel;

    $banco = trim(
        (string) (
            getenv('PAD_DB_NAME') ?: ''
        )
    );

    $portaVariavel = getenv(
        'PAD_DB_PORT'
    );

    $porta = (
        $portaVariavel === false
        || $portaVariavel === ''
    )
        ? 3306
        : filter_var(
            $portaVariavel,
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'min_range' => 1,
                    'max_range' => 65535
                ]
            ]
        );


    // Impedir uma ligação incompleta.

    if (
        $servidor === ''
        || $usuario === ''
        || $senha === ''
        || $banco === ''
        || $porta === false
    ) {

        error_log(
            '[PAD] Variáveis de conexão '
            . 'da hospedagem incompletas.'
        );

        http_response_code(503);

        exit(
            'A ligação ao banco de dados '
            . 'ainda não está configurada.'
        );
    }
}


// ============================================
// 4. ESTABELECER A CONEXÃO MYSQL
// ============================================

try {

    $conn = new mysqli(
        $servidor,
        $usuario,
        $senha,
        $banco,
        $porta
    );


    // Suportar corretamente o português.

    $conn->set_charset('utf8mb4');


} catch (mysqli_sql_exception $erro) {

    /*
     * Registar o erro no servidor,
     * sem exibir detalhes técnicos
     * ao visitante.
     */

    error_log(
        '[PAD] Falha na ligação MySQL: '
        . $erro->getMessage()
    );

    http_response_code(503);

    exit(
        'Não foi possível aceder aos '
        . 'dados da PAD neste momento.'
    );
}
