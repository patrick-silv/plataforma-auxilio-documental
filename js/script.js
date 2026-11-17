
/* ============================================================
   PAD - INTERAÇÕES DAS PÁGINAS INTERNAS
   Arquivo: js/script.js

   Inclui:
   - Menu responsivo
   - Pesquisa e filtro de documentos
   - Checklist por perfil e grupos complementares
   - Progresso de itens assinalados
   - Impressão do guia ou somente da checklist

   A checklist não envia dados ao servidor e não usa
   armazenamento persistente.

   Marcar 100% não significa aprovação do pedido
   ou confirmação de documentação legal completa.
   ============================================================ */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    // ========================================================
    // 1. MENU RESPONSIVO
    // ========================================================

    const menuBotao = document.getElementById("menuBotao");
    const menu = document.getElementById("menu");

    function fecharMenu() {
        if (!menuBotao || !menu) return;

        menu.classList.remove("aberto");
        menuBotao.setAttribute("aria-expanded", "false");
        menuBotao.setAttribute("aria-label", "Abrir menu");
    }

    if (menuBotao && menu) {
        menuBotao.addEventListener("click", function () {
            const aberto = menu.classList.toggle("aberto");

            menuBotao.setAttribute(
                "aria-expanded",
                String(aberto)
            );

            menuBotao.setAttribute(
                "aria-label",
                aberto ? "Fechar menu" : "Abrir menu"
            );
        });

        menu.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", fecharMenu);
        });

        document.addEventListener("keydown", function (evento) {
            if (evento.key === "Escape") {
                fecharMenu();
            }
        });

        document.addEventListener("click", function (evento) {
            if (
                !menu.contains(evento.target) &&
                !menuBotao.contains(evento.target)
            ) {
                fecharMenu();
            }
        });
    }

    // ========================================================
    // 2. NORMALIZAÇÃO DE TEXTO
    // ========================================================

    function normalizar(texto) {
        return String(texto ?? "")
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .toLowerCase()
            .trim();
    }

    // ========================================================
    // 3. PESQUISA E FILTRO DOS DOCUMENTOS
    // ========================================================

    const campoBusca = document.getElementById("buscaDocumento");
    const campoCategoria = document.getElementById("filtroCategoria");

    const cards = Array.from(
        document.querySelectorAll(".documento-card")
    );

    const contador = document.getElementById("contadorDocumentos");
    const semResultados = document.getElementById("semResultados");

    function filtrarDocumentos() {
        const pesquisa = normalizar(
            campoBusca ? campoBusca.value : ""
        );

        const categoria = normalizar(
            campoCategoria ? campoCategoria.value : ""
        );

        let encontrados = 0;

        cards.forEach(function (card) {
            const texto = normalizar(card.textContent);
            const grupo = normalizar(card.dataset.categoria);

            const mostrar =
                texto.includes(pesquisa) &&
                (categoria === "" || categoria === grupo);

            card.hidden = !mostrar;

            if (mostrar) {
                encontrados++;
            }
        });

        if (contador) {
            contador.textContent =
                encontrados === 1
                    ? "1 guia encontrado"
                    : encontrados + " guias encontrados";
        }

        if (semResultados) {
            semResultados.hidden = encontrados > 0;
        }
    }

    if (campoBusca || campoCategoria) {
        if (campoBusca) {
            campoBusca.addEventListener(
                "input",
                filtrarDocumentos
            );
        }

        if (campoCategoria) {
            campoCategoria.addEventListener(
                "change",
                filtrarDocumentos
            );
        }

        filtrarDocumentos();
    }

    // ========================================================
    // 4. ELEMENTOS DA CHECKLIST
    // ========================================================

    const grupos = Array.from(
        document.querySelectorAll(
            "#gruposDocumentais .grupo-documentos"
        )
    );

    const checklist = document.getElementById("checklistItens");

    const progressoTexto = document.getElementById(
        "progressoTexto"
    );

    const barra = document.getElementById("barraProgresso");

    const preenchimento = document.getElementById(
        "progressoPreenchimento"
    );

    const imprimirChecklist = document.getElementById(
        "imprimirChecklist"
    );

    const imprimirGuia = document.getElementById(
        "imprimirGuia"
    );

    const limparChecklist = document.getElementById(
        "limparChecklist"
    );

    // Os itens assinalados existem apenas na memória desta página.

    const documentosMarcados = new Set();

    function seletorDoGrupo(grupo) {
        return grupo.querySelector(".grupo-seletor");
    }

    function perfilSelecionado() {
        return grupos.find(function (grupo) {
            const seletor = seletorDoGrupo(grupo);

            return (
                grupo.dataset.tipo === "perfil" &&
                seletor !== null &&
                seletor.checked
            );
        }) || null;
    }

    // ========================================================
    // 5. CONTADOR DE ITENS ASSINALADOS
    // ========================================================

    function atualizarProgresso() {
        if (!checklist) return;

        const caixas = Array.from(
            checklist.querySelectorAll(".documento-check")
        );

        const total = caixas.length;

        const assinalados = caixas.filter(function (caixa) {
            return caixa.checked;
        }).length;

        const percentual =
            total === 0
                ? 0
                : Math.round((assinalados / total) * 100);

        if (progressoTexto) {
            progressoTexto.textContent =
                assinalados + " de " + total + " itens marcados";
        }

        if (preenchimento) {
            preenchimento.style.width = percentual + "%";
        }

        if (barra) {
            barra.setAttribute(
                "aria-valuenow",
                String(percentual)
            );

            barra.setAttribute(
                "aria-valuetext",
                assinalados + " de " + total + " itens marcados"
            );
        }

        if (imprimirChecklist) {
            imprimirChecklist.disabled = total === 0;
        }
    }

    // ========================================================
    // 6. CONTROLAR GRUPOS COMPLEMENTARES
    // ========================================================

    function atualizarComplementos() {
        const temPerfil = perfilSelecionado() !== null;

        grupos.forEach(function (grupo) {
            if (grupo.dataset.tipo !== "complemento") {
                return;
            }

            const seletor = seletorDoGrupo(grupo);

            if (!seletor) return;

            seletor.disabled = !temPerfil;

            if (!temPerfil) {
                seletor.checked = false;
            }
        });
    }

    // ========================================================
    // 7. CONSTRUIR A CHECKLIST
    // ========================================================

    function construirChecklist() {
        if (!checklist) return;

        checklist.replaceChildren();

        const perfil = perfilSelecionado();

        if (!perfil) {
            const mensagem = document.createElement("p");

            mensagem.className = "checklist-vazia";

            mensagem.textContent =
                "Selecione primeiro uma situação principal " +
                "em Documentos necessários para gerar a checklist.";

            checklist.appendChild(mensagem);

            atualizarProgresso();

            return;
        }

        grupos.forEach(function (grupo, indiceGrupo) {
            const seletor = seletorDoGrupo(grupo);

            if (!seletor || !seletor.checked) {
                return;
            }

            const tituloOriginal = grupo.querySelector("h3");

            const itensOriginais = Array.from(
                grupo.querySelectorAll(".lista-check li")
            );

            if (itensOriginais.length === 0) {
                return;
            }

            const secao = document.createElement("section");
            secao.className = "checklist-grupo";

            const titulo = document.createElement("h3");

            titulo.textContent = tituloOriginal
                ? tituloOriginal.textContent.trim()
                : "Documentação";

            secao.appendChild(titulo);

            // Explicar a natureza do grupo selecionado.

            const explicacao = document.createElement("p");

            explicacao.className = "nota-checklist";

            explicacao.textContent =
                grupo.dataset.tipo === "perfil"
                    ? "Situação principal selecionada. " +
                      "Confirme os requisitos deste perfil " +
                      "no serviço oficial."
                    : "Grupo complementar ou condicional. " +
                      "Confirme quais itens são exigidos " +
                      "no seu caso.";

            secao.appendChild(explicacao);

            // Criar os itens sem usar innerHTML.

            itensOriginais.forEach(function (item, indiceItem) {
                const chave = indiceGrupo + ":" + indiceItem;

                const linha = document.createElement("label");
                linha.className = "checklist-item";

                const caixa = document.createElement("input");

                caixa.type = "checkbox";
                caixa.className = "documento-check";

                caixa.checked = documentosMarcados.has(chave);

                const texto = document.createElement("span");

                texto.textContent = item.textContent.trim();

                caixa.addEventListener("change", function () {
                    if (caixa.checked) {
                        documentosMarcados.add(chave);
                    } else {
                        documentosMarcados.delete(chave);
                    }

                    atualizarProgresso();
                });

                linha.appendChild(caixa);
                linha.appendChild(texto);

                secao.appendChild(linha);
            });

            checklist.appendChild(secao);
        });

        // Aviso de segurança documental:
        // 100% é apenas o progresso dos itens exibidos.

        const aviso = document.createElement("p");

        aviso.className = "nota-checklist";

        aviso.textContent =
            "O progresso contabiliza somente os itens marcados " +
            "nos grupos selecionados. Expressões como 'OU' " +
            "indicam alternativas documentais. Mesmo com 100%, " +
            "confirme a lista e as condições junto do " +
            "organismo oficial.";

        checklist.appendChild(aviso);

        atualizarProgresso();
    }

    // ========================================================
    // 8. ALTERAR PERFIL E COMPLEMENTOS
    // ========================================================

    if (checklist && grupos.length > 0) {
        grupos.forEach(function (grupo, indiceGrupo) {
            const seletor = seletorDoGrupo(grupo);

            if (!seletor) return;

            seletor.addEventListener("change", function () {
                if (grupo.dataset.tipo === "perfil") {

                    // Ao trocar o perfil principal, apagar as
                    // marcações e desmarcar os complementos antigos.

                    documentosMarcados.clear();

                    grupos.forEach(function (outro) {
                        if (outro.dataset.tipo !== "complemento") {
                            return;
                        }

                        const outroSeletor = seletorDoGrupo(outro);

                        if (outroSeletor) {
                            outroSeletor.checked = false;
                        }
                    });

                } else if (!seletor.checked) {

                    // Se o complemento for removido, apagar
                    // apenas as marcações pertencentes a ele.

                    for (const chave of documentosMarcados) {
                        if (chave.startsWith(indiceGrupo + ":")) {
                            documentosMarcados.delete(chave);
                        }
                    }
                }

                atualizarComplementos();
                construirChecklist();
            });
        });

        atualizarComplementos();
        construirChecklist();
    }

    // ========================================================
    // 9. LIMPAR TODA A SELEÇÃO
    // ========================================================

    if (limparChecklist) {
        limparChecklist.addEventListener("click", function () {
            grupos.forEach(function (grupo) {
                const seletor = seletorDoGrupo(grupo);

                if (seletor) {
                    seletor.checked = false;
                }
            });

            documentosMarcados.clear();

            atualizarComplementos();
            construirChecklist();
        });
    }

    // ========================================================
    // 10. IMPRIMIR O GUIA COMPLETO
    // ========================================================

    if (imprimirGuia) {
        imprimirGuia.addEventListener("click", function () {
            document.body.classList.remove(
                "imprimir-checklist"
            );

            window.print();
        });
    }

    // ========================================================
    // 11. IMPRIMIR APENAS A CHECKLIST
    // ========================================================

    if (imprimirChecklist) {
        imprimirChecklist.addEventListener("click", function () {
            if (imprimirChecklist.disabled) {
                return;
            }

            document.body.classList.add(
                "imprimir-checklist"
            );

            window.print();
        });
    }

    // Restaurar a visualização após fechar a impressão.

    window.addEventListener("afterprint", function () {
        document.body.classList.remove(
            "imprimir-checklist"
        );
    });
});
