<?php

require __DIR__ . '/includes/dados_documentos.php';

$titulo = 'Documentação | PAD';

$q = isset($_GET['q']) && is_string($_GET['q'])
    ? substr(trim($_GET['q']), 0, 100)
    : '';

require __DIR__ . '/includes/header.php';

?>

<main id="conteudo">

    <section class="pagina-topo">

        <div class="container">

            <div class="breadcrumb">
                <a href="index.php">Início</a>
                / Documentação
            </div>

            <span class="etiqueta">
                CATÁLOGO DOCUMENTAL
            </span>

            <h1>
                Encontre o documento que precisa
            </h1>

            <p>
                Consulte quem pode pedir,
                quais documentos preparar,
                como solicitar e onde confirmar
                as informações oficiais.
            </p>

        </div>

    </section>


    <section class="secao">

        <div class="container">

            <div class="filtros">

                <div>

                    <label for="buscaDocumento">
                        Pesquisar
                    </label>

                    <input
                        type="search"
                        id="buscaDocumento"
                        value="<?= e($q) ?>"
                        placeholder="Ex.: saúde, NIF, residência">

                </div>

                <div>

                    <label for="filtroCategoria">
                        Categoria
                    </label>

                    <select id="filtroCategoria">

                        <option value="">
                            Todas as categorias
                        </option>

                        <option value="Fiscal">
                            Fiscal
                        </option>

                        <option value="Segurança Social">
                            Segurança Social
                        </option>

                        <option value="Saúde">
                            Saúde
                        </option>

                        <option value="Morada">
                            Morada
                        </option>

                        <option value="Imigração">
                            Imigração
                        </option>

                    </select>

                </div>

            </div>

            <p id="contadorDocumentos"
               class="contador"
               role="status"
               aria-live="polite">

                <?= count($documentos) ?> guias disponíveis

            </p>

            <div class="grid-cards">

                <?php foreach ($documentos as $slug => $doc): ?>

                    <article
                        class="cartao documento-card"
                        data-categoria="<?= e($doc['categoria']) ?>">

                        <div class="cartao-topo">

                            <span class="sigla">
                                <?= e($doc['sigla']) ?>
                            </span>

                            <small>
                                <?= e($doc['categoria']) ?>
                            </small>

                        </div>

                        <h2><?= e($doc['titulo']) ?></h2>

                        <p class="subtitulo">
                            <?= e($doc['subtitulo']) ?>
                        </p>

                        <p><?= e($doc['resumo']) ?></p>

                        <a class="cartao-link"
                           href="documento.php?doc=<?= e($slug) ?>">

                            Ver documentos e passos
                            <span aria-hidden="true">→</span>

                        </a>

                    </article>

                <?php endforeach; ?>

            </div>

            <div id="semResultados"
                 class="sem-resultados"
                 hidden>

                <h2>Nenhum documento encontrado</h2>

                <p>
                    Experimente outro termo
                    ou selecione todas as categorias.
                </p>

            </div>

        </div>

    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>