<?php
/*
 * PAD - PLATAFORMA DE AUXÍLIO DOCUMENTAL
 *
 * Arquivo: retirar_avaliacao.php
 *
 * FINALIDADE:
 * Permitir que participantes da versão
 * antiga retirem as suas avaliações.
 *
 * O sistema atual utiliza apenas
 * contadores agregados por nacionalidade.
 *
 * Esta página não recebe novas avaliações.
 */


// ============================================
// 1. CABEÇALHOS DE SEGURANÇA
// ============================================

header('Referrer-Policy: no-referrer');

header('X-Content-Type-Options: nosniff');

header('X-Frame-Options: DENY');

header(
    'Cache-Control: no-store, no-cache, must-revalidate, max-age=0'
);

header('Pragma: no-cache');


// ============================================
// 2. INICIAR SESSÃO
// ============================================

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


// ============================================
// 3. CARREGAR CONFIGURAÇÕES
// ============================================

require_once __DIR__ . '/includes/config.php';


// ============================================
// 4. FUNÇÃO DE ESCAPE
// ============================================

function padRetiradaEscapar($valor): string
{
    return htmlspecialchars(
        (string) $valor,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}


// ============================================
// 5. TOKEN CSRF
// ============================================

if (empty($_SESSION['pad_csrf_retirada'])) {

    $_SESSION['pad_csrf_retirada'] =
        bin2hex(random_bytes(32));
}


// ============================================
// 6. RECEBER CÓDIGO PRIVADO
// ============================================

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$codigoRecebido = $metodo === 'POST'
    ? ($_POST['codigo'] ?? '')
    : ($_GET['codigo'] ?? '');

$codigo = is_string($codigoRecebido)
    ? $codigoRecebido
    : '';


// O código privado possui 64 caracteres
// hexadecimais minúsculos.

$codigoValido = preg_match(
    '/\A[a-f0-9]{64}\z/',
    $codigo
) === 1;

$erro = '';


// ============================================
// 7. CONFIRMAÇÃO DE ELIMINAÇÃO
// ============================================

/*
 * Mostrar a confirmação somente quando
 * a eliminação tiver sido realizada
 * anteriormente nesta mesma sessão.
 */

$apagada =
    isset($_GET['concluido'])
    && $_GET['concluido'] === '1'
    && !empty(
        $_SESSION['pad_retirada_concluida']
    );

unset(
    $_SESSION['pad_retirada_concluida']
);


// ============================================
// 8. PROCESSAR PEDIDO DE ELIMINAÇÃO
// ============================================

if ($metodo === 'POST') {

    $csrf =
        isset($_POST['csrf_token'])
        && is_string($_POST['csrf_token'])
            ? $_POST['csrf_token']
            : '';


    // Verificar proteção CSRF.

    if (!hash_equals(
        (string) $_SESSION['pad_csrf_retirada'],
        $csrf
    )) {

        $erro =
            'Sessão inválida. Reabra o link privado '
            . 'e tente novamente.';


    // Validar código de retirada.

    } elseif (!$codigoValido) {

        $erro =
            'O código de retirada não é válido.';


    // Eliminar avaliação antiga.

    } else {

        try {

            require_once __DIR__ .
                '/includes/conexao.php';


            // Produzir o hash do código recebido.

            $hash = hash(
                'sha256',
                $codigo
            );


            // Eliminar somente o registo
            // correspondente ao código privado.

            $stmt = $conn->prepare(
                'DELETE FROM avaliacoes
                 WHERE retirada_hash = ?
                 LIMIT 1'
            );

            $stmt->bind_param(
                's',
                $hash
            );

            $stmt->execute();


            // Verificar se houve eliminação real.

            $encontrada =
                $stmt->affected_rows === 1;

            $stmt->close();


            if ($encontrada) {

                // Guardar confirmação na sessão.

                $_SESSION[
                    'pad_retirada_concluida'
                ] = true;


                // Renovar o token de segurança.

                $_SESSION['pad_csrf_retirada'] =
                    bin2hex(random_bytes(32));


                // Redirecionar sem o código privado.

                header(
                    'Location: retirar_avaliacao.php?concluido=1',
                    true,
                    303
                );

                exit;
            }


            $erro =
                'A avaliação já foi retirada '
                . 'ou não foi encontrada.';


        } catch (Throwable $excecao) {

            error_log(
                '[PAD] Erro ao retirar avaliação antiga: '
                . $excecao->getMessage()
            );

            $erro =
                'Não foi possível concluir a retirada '
                . 'neste momento.';
        }
    }
}


// ============================================
// 9. INFORMAÇÕES DA PÁGINA
// ============================================

$titulo =
    'Retirar avaliação antiga | ' . PAD_NOME;

$descricao =
    'Eliminação de avaliações enviadas '
    . 'na versão anterior da PAD.';

$paginaIndexavel = false;


// ============================================
// 10. CABEÇALHO DA PAD
// ============================================

require_once __DIR__ .
    '/includes/header.php';

?>


<!-- ==========================================
     ESTILO DA PÁGINA
========================================== -->

<style>

.pad-retirada {
    max-width: 720px;
    margin: 45px auto 65px;
    padding: 0 20px;
    color: #183b55;
}

.pad-retirada h1 {
    font-size: clamp(28px, 4vw, 39px);
    color: #123c5d;
}

.pad-retirada .caixa {
    background: white;
    border: 1px solid #c7dce8;
    border-top: 4px solid #16865d;
    border-radius: 13px;
    padding: 28px;
    line-height: 1.7;
}

.pad-retirada .erro {
    background: #fff0f0;
    border: 1px solid #e2a5a5;
    padding: 13px;
    border-radius: 8px;
}

.pad-retirada .sucesso {
    background: #e9f7ee;
    border: 1px solid #9bceb0;
    padding: 13px;
    border-radius: 8px;
}

.pad-retirada .botao {
    background: #216fa3;
    color: white;
    border: 0;
    border-radius: 8px;
    padding: 12px 20px;
    font: inherit;
    font-weight: 700;
    cursor: pointer;
}

.pad-retirada .link {
    color: #216fa3;
    font-weight: 700;
}

.pad-retirada .nota {
    font-size: 13px;
    color: #5d7789;
}

.pad-retirada .botao:focus-visible,
.pad-retirada .link:focus-visible {
    outline: 3px solid #d8ac39;
    outline-offset: 3px;
}

@media (max-width: 560px) {

    .pad-retirada .caixa {
        padding: 20px;
    }

}

</style>


<!-- ==========================================
     CONTEÚDO PRINCIPAL
========================================== -->

<main
    id="conteudo"
    class="pad-retirada"
>

    <h1>
        Retirar uma avaliação antiga
    </h1>


    <div class="caixa">


        <!-- ELIMINAÇÃO CONCLUÍDA -->

        <?php if ($apagada): ?>

            <h2>
                Avaliação retirada
            </h2>

            <p
                class="sucesso"
                role="status"
            >
                A avaliação foi eliminada
                da base de dados ativa da PAD.
            </p>

            <p>

                <a
                    class="link"
                    href="inicio.php"
                >
                    Voltar à plataforma
                </a>

            </p>


        <!-- ERRO -->

        <?php elseif ($erro !== ''): ?>

            <p
                class="erro"
                role="alert"
            >
                <?= padRetiradaEscapar($erro) ?>
            </p>

            <p>
                Se tiver o link privado recebido
                anteriormente, abra-o novamente.
            </p>

            <p>

                <a
                    class="link"
                    href="privacidade.php"
                >
                    Consultar a Política de Privacidade
                </a>

            </p>


        <!-- SEM CÓDIGO PRIVADO -->

        <?php elseif (!$codigoValido): ?>

            <p>
                A PAD já não recebe avaliações
                ou comentários.
            </p>

            <p>
                Esta página existe apenas
                para quem enviou uma avaliação
                na versão anterior da plataforma
                e recebeu um link privado
                de retirada.
            </p>

            <p>
                Para retirar uma avaliação antiga,
                utilize esse link privado.
            </p>

            <p>
                Para questões relacionadas
                com informações anteriores,
                consulte a nossa
                <a
                    class="link"
                    href="privacidade.php"
                >
                    Política de Privacidade
                </a>.
            </p>

            <p>

                <a
                    class="link"
                    href="avaliar.php"
                >
                    Consultar o ranking de nacionalidades
                </a>

            </p>


        <!-- CONFIRMAÇÃO DE ELIMINAÇÃO -->

        <?php else: ?>

            <p>
                O código privado permite solicitar
                a eliminação da avaliação
                anteriormente enviada,
                incluindo os dados e o comentário
                associados, caso ainda existam
                na base de dados.
            </p>

            <p>

                <strong>
                    Esta ação não pode ser desfeita.
                </strong>

            </p>


            <form
                action="retirar_avaliacao.php"
                method="post"
            >

                <input
                    type="hidden"
                    name="codigo"
                    value="<?= padRetiradaEscapar($codigo) ?>"
                >

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= padRetiradaEscapar(
                        $_SESSION['pad_csrf_retirada']
                    ) ?>"
                >


                <button
                    class="botao"
                    type="submit"
                >
                    Confirmar eliminação da avaliação
                </button>

            </form>


            <p class="nota">
                Esta função destina-se exclusivamente
                às avaliações antigas.

                Os novos contadores de nacionalidades
                não possuem registos individuais
                para retirar.
            </p>


        <?php endif; ?>

    </div>

</main>


<?php

require_once __DIR__ .
    '/includes/footer.php';

?>
