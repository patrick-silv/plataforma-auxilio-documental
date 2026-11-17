<?php

/*
 * PAD - PLATAFORMA DE AUXÍLIO DOCUMENTAL
 *
 * Arquivo: avaliacoes.php
 *
 * REDIRECIONAMENTO DE COMPATIBILIDADE
 *
 * O sistema antigo de avaliações e
 * comentários foi descontinuado.
 *
 * A participação atual permite apenas
 * selecionar a nacionalidade e consultar
 * estatísticas agregadas por país.
 *
 * Este arquivo não consulta o banco
 * de dados nem apresenta comentários.
 */


// Impedir a conservação da página em cache.

header(
    'Cache-Control: no-store, no-cache, must-revalidate, max-age=0'
);

header('Pragma: no-cache');


// Proteções de segurança.

header('X-Content-Type-Options: nosniff');

header('Referrer-Policy: no-referrer');


// Encaminhar para o novo ranking de nacionalidades.

header(
    'Location: avaliar.php',
    true,
    302
);

exit;
