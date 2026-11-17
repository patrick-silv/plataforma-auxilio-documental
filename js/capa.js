
/*
 * PAD - PLATAFORMA DE AUXÍLIO DOCUMENTAL
 *
 * Arquivo: js/capa.js
 *
 * Funcionalidades:
 * 1. Carrossel principal com três apresentações
 * 2. Alternância automática dos destaques
 * 3. Navegação por setas e indicadores
 * 4. Pausa e retomada
 * 5. Gestos de deslizar no telemóvel
 * 6. Navegação por teclado
 * 7. Roleta horizontal dos seis documentos
 * 8. Contador dos cartões visíveis
 * 9. Acessibilidade e redução de movimento
 *
 * O assistente de orientação documental
 * continua implementado no index.php.
 */

document.addEventListener('DOMContentLoaded', function () {

    'use strict';

    document.documentElement.classList.add(
        'js-enabled'
    );

    const reducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    );


    // ============================================
    // 1. CARROSSEL PRINCIPAL
    // ============================================

    const carousel = document.getElementById(
        'heroCarousel'
    );

    const slides = carousel
        ? Array.from(
            carousel.querySelectorAll('.hero-slide')
        )
        : [];

    const heroPrev = document.getElementById(
        'heroPrev'
    );

    const heroNext = document.getElementById(
        'heroNext'
    );

    const heroDots = Array.from(
        document.querySelectorAll(
            '#heroDots .carousel-dot'
        )
    );

    const heroCounter = document.getElementById(
        'heroCounter'
    );

    const heroToolbar = document.getElementById(
        'heroToolbar'
    );

    const heroPause = document.getElementById(
        'heroPause'
    );

    const pauseText = document.getElementById(
        'pauseText'
    );

    const pauseSymbol = document.getElementById(
        'pauseSymbol'
    );

    const slideAnnouncement = document.getElementById(
        'slideAnnouncement'
    );

    const heroArea = document.querySelector(
        '.hero-wrap'
    );


    // ============================================
    // 2. CONFIGURAÇÕES
    // ============================================

    const ROTATION_TIME = 7500;

    let activeSlide = 0;

    let timer = null;

    let manualPause = false;

    let pointerInside = false;

    let focusInside = false;

    let touchStartX = null;

    let touchStartY = null;

    const slideTitles = [
        'Documentação menos complicada',
        'Os seis guias documentais',
        'Compromisso social da PAD'
    ];


    // ============================================
    // 3. CONTROLAR A ROTAÇÃO AUTOMÁTICA
    // ============================================

    function stopTimer() {

        if (timer !== null) {

            window.clearInterval(timer);

            timer = null;
        }
    }


    function canAutoPlay() {

        return slides.length > 1
            && !manualPause
            && !pointerInside
            && !focusInside
            && !document.hidden
            && !reducedMotion.matches;
    }


    function startTimer() {

        stopTimer();

        if (!canAutoPlay()) {
            return;
        }

        timer = window.setInterval(
            function () {

                showSlide(
                    activeSlide + 1,
                    false
                );

            },
            ROTATION_TIME
        );
    }


    // ============================================
    // 4. BOTÃO DE PAUSAR E RETOMAR
    // ============================================

    function updatePauseButton() {

        if (!heroPause) {
            return;
        }

        if (reducedMotion.matches) {

            heroPause.disabled = true;

            heroPause.setAttribute(
                'aria-pressed',
                'true'
            );

            if (pauseText) {

                pauseText.textContent =
                    'Rotação automática desativada';
            }

            if (pauseSymbol) {

                pauseSymbol.textContent = 'Ⅱ';
            }

            return;
        }

        heroPause.disabled = false;

        heroPause.setAttribute(
            'aria-pressed',
            String(manualPause)
        );

        if (pauseText) {

            pauseText.textContent = manualPause
                ? 'Retomar apresentação'
                : 'Pausar apresentação';
        }

        if (pauseSymbol) {

            pauseSymbol.textContent =
                manualPause ? '▶' : 'Ⅱ';
        }
    }


    // ============================================
    // 5. MOSTRAR DESTAQUE SELECIONADO
    // ============================================

    function showSlide(index, manual) {

        if (slides.length === 0) {
            return;
        }

        activeSlide = (
            (index % slides.length) + slides.length
        ) % slides.length;

        slides.forEach(function (slide, i) {

            slide.hidden = i !== activeSlide;
        });


        // Atualizar os indicadores.

        heroDots.forEach(function (dot, i) {

            const selected = i === activeSlide;

            dot.classList.toggle(
                'is-active',
                selected
            );

            if (selected) {

                dot.setAttribute(
                    'aria-current',
                    'true'
                );

            } else {

                dot.removeAttribute(
                    'aria-current'
                );
            }

        });


        // Atualizar o contador.

        if (heroCounter) {

            const current = String(
                activeSlide + 1
            ).padStart(2, '0');

            const total = String(
                slides.length
            ).padStart(2, '0');

            heroCounter.textContent =
                current + ' / ' + total;
        }


        // Informação para leitores de ecrã.

        if (manual && slideAnnouncement) {

            slideAnnouncement.textContent =
                'Destaque ' +
                (activeSlide + 1) +
                ' de ' +
                slides.length +
                ': ' +
                (
                    slideTitles[activeSlide]
                    || 'Apresentação da PAD'
                );
        }

        startTimer();
    }


    // ============================================
    // 6. SETAS DO CARROSSEL PRINCIPAL
    // ============================================

    if (heroPrev) {

        heroPrev.addEventListener(
            'click',
            function () {

                showSlide(
                    activeSlide - 1,
                    true
                );
            }
        );
    }


    if (heroNext) {

        heroNext.addEventListener(
            'click',
            function () {

                showSlide(
                    activeSlide + 1,
                    true
                );
            }
        );
    }


    // ============================================
    // 7. INDICADORES DOS TRÊS DESTAQUES
    // ============================================

    heroDots.forEach(function (dot) {

        dot.addEventListener(
            'click',
            function () {

                const index = Number(
                    dot.dataset.target
                );

                if (
                    Number.isInteger(index)
                    && index >= 0
                    && index < slides.length
                ) {

                    showSlide(
                        index,
                        true
                    );
                }
            }
        );
    });


    // ============================================
    // 8. PAUSAR OU RETOMAR APRESENTAÇÃO
    // ============================================

    if (heroPause) {

        heroPause.addEventListener(
            'click',
            function () {

                if (reducedMotion.matches) {
                    return;
                }

                manualPause = !manualPause;

                updatePauseButton();

                startTimer();
            }
        );
    }


    // ============================================
    // 9. PAUSAR QUANDO O RATO ESTÁ NO DESTAQUE
    // ============================================

    if (carousel) {

        carousel.addEventListener(
            'pointerenter',
            function (event) {

                if (
                    event.pointerType === 'mouse'
                ) {

                    pointerInside = true;

                    stopTimer();
                }
            }
        );


        carousel.addEventListener(
            'pointerleave',
            function () {

                pointerInside = false;

                startTimer();
            }
        );


        // ========================================
        // 10. GESTOS DE DESLIZAR NO TELEMÓVEL
        // ========================================

        carousel.addEventListener(
            'touchstart',
            function (event) {

                if (event.touches.length !== 1) {
                    return;
                }

                touchStartX =
                    event.touches[0].clientX;

                touchStartY =
                    event.touches[0].clientY;

                stopTimer();

            },
            { passive: true }
        );


        carousel.addEventListener(
            'touchend',
            function (event) {

                if (
                    touchStartX === null
                    || touchStartY === null
                    || event.changedTouches.length !== 1
                ) {

                    touchStartX = null;

                    touchStartY = null;

                    startTimer();

                    return;
                }

                const deltaX =
                    event.changedTouches[0].clientX
                    - touchStartX;

                const deltaY =
                    event.changedTouches[0].clientY
                    - touchStartY;

                touchStartX = null;

                touchStartY = null;

                if (
                    Math.abs(deltaX) > 60
                    && Math.abs(deltaX)
                       > Math.abs(deltaY) * 1.3
                ) {

                    showSlide(
                        activeSlide + (
                            deltaX < 0 ? 1 : -1
                        ),
                        true
                    );

                } else {

                    startTimer();
                }

            },
            { passive: true }
        );


        // Se o gesto for interrompido,
        // permitir a continuação da rotação.

        carousel.addEventListener(
            'touchcancel',
            function () {

                touchStartX = null;

                touchStartY = null;

                startTimer();

            },
            { passive: true }
        );

    }


    // ============================================
    // 11. PAUSAR DURANTE NAVEGAÇÃO POR TECLADO
    // ============================================

    if (heroArea) {

        heroArea.addEventListener(
            'focusin',
            function () {

                focusInside = true;

                stopTimer();
            }
        );


        heroArea.addEventListener(
            'focusout',
            function (event) {

                if (
                    !event.relatedTarget
                    || !heroArea.contains(
                        event.relatedTarget
                    )
                ) {

                    focusInside = false;

                    startTimer();
                }
            }
        );
    }


    // ============================================
    // 12. PAUSA QUANDO A PÁGINA NÃO ESTÁ VISÍVEL
    // ============================================

    document.addEventListener(
        'visibilitychange',
        startTimer
    );


    // ============================================
    // 13. REDUÇÃO DE MOVIMENTO
    // ============================================

    function motionChanged() {

        updatePauseButton();

        startTimer();
    }


    if (
        typeof reducedMotion.addEventListener
        === 'function'
    ) {

        reducedMotion.addEventListener(
            'change',
            motionChanged
        );

    } else if (
        typeof reducedMotion.addListener
        === 'function'
    ) {

        reducedMotion.addListener(
            motionChanged
        );
    }


    // ============================================
    // 14. ATIVAR CARROSSEL PRINCIPAL
    // ============================================

    if (
        slides.length > 1
        && heroToolbar
    ) {

        heroToolbar.hidden = false;
    }

    updatePauseButton();

    if (slides.length > 0) {

        showSlide(
            0,
            false
        );
    }


    // ============================================
    // 15. ROLETA DOS SEIS DOCUMENTOS
    // ============================================

    const reel = document.getElementById(
        'documentReel'
    );

    const reelPrev = document.getElementById(
        'reelPrev'
    );

    const reelNext = document.getElementById(
        'reelNext'
    );

    const reelControls = document.getElementById(
        'reelControls'
    );

    const reelStatus = document.getElementById(
        'reelStatus'
    );


    if (
        reel
        && reelPrev
        && reelNext
    ) {

        const cards = Array.from(
            reel.querySelectorAll(
                '.document-tile'
            )
        );


        // ========================================
        // 16. LIMITES DA ROLAGEM
        // ========================================

        function maximumScroll() {

            return Math.max(
                0,
                reel.scrollWidth
                - reel.clientWidth
            );
        }


        // ========================================
        // 17. AVANÇAR OU VOLTAR UM CARTÃO
        // ========================================

        function scrollReel(direction) {

            const firstCard = cards[0];

            const styles = window.getComputedStyle(
                reel
            );

            const gap = parseFloat(
                styles.columnGap
                || styles.gap
                || '0'
            ) || 0;

            const distance = firstCard
                ? firstCard.getBoundingClientRect().width
                  + gap
                : 270;

            reel.scrollBy({

                left: direction * distance,

                behavior: reducedMotion.matches
                    ? 'auto'
                    : 'smooth'
            });
        }


        // ========================================
        // 18. CONTADOR DE CARTÕES VISÍVEIS
        // ========================================

        function visibleCardsText() {

            const area = reel.getBoundingClientRect();

            const visible = [];

            cards.forEach(function (card, index) {

                const rect =
                    card.getBoundingClientRect();

                const overlap = Math.max(
                    0,
                    Math.min(
                        rect.right,
                        area.right
                    ) -
                    Math.max(
                        rect.left,
                        area.left
                    )
                );

                if (
                    rect.width > 0
                    && overlap >= rect.width * 0.5
                ) {

                    visible.push(
                        index + 1
                    );
                }
            });


            if (visible.length === 0) {

                return cards.length +
                    ' documentos disponíveis';
            }

            const first = visible[0];

            const last = visible[
                visible.length - 1
            ];

            return first === last

                ? first + ' de ' + cards.length

                : first + '–' +
                  last + ' de ' + cards.length;
        }


        // ========================================
        // 19. ATUALIZAR SETAS E CONTADOR
        // ========================================

        function updateReel() {

            const maximum = maximumScroll();

            reelPrev.disabled =
                reel.scrollLeft <= 3;

            reelNext.disabled =
                reel.scrollLeft >= maximum - 3;

            if (reelControls) {

                reelControls.hidden =
                    maximum <= 3;
            }

            if (reelStatus) {

                reelStatus.textContent =
                    visibleCardsText();
            }
        }


        // ========================================
        // 20. CONTROLOS DA ROLETA
        // ========================================

        reelPrev.addEventListener(
            'click',
            function () {

                scrollReel(-1);
            }
        );


        reelNext.addEventListener(
            'click',
            function () {

                scrollReel(1);
            }
        );


        // ========================================
        // 21. ATUALIZAR DURANTE A ROLAGEM
        // ========================================

        reel.addEventListener(
            'scroll',
            updateReel,
            { passive: true }
        );


        // ========================================
        // 22. REAJUSTAR EM DIFERENTES ECRÃS
        // ========================================

        window.addEventListener(
            'resize',
            updateReel
        );


        // ========================================
        // 23. NAVEGAÇÃO POR TECLADO
        // ========================================

        reel.addEventListener(
            'keydown',
            function (event) {

                if (event.target !== reel) {
                    return;
                }

                if (
                    event.key === 'ArrowRight'
                ) {

                    event.preventDefault();

                    scrollReel(1);

                } else if (
                    event.key === 'ArrowLeft'
                ) {

                    event.preventDefault();

                    scrollReel(-1);

                } else if (
                    event.key === 'Home'
                ) {

                    event.preventDefault();

                    reel.scrollTo({
                        left: 0,
                        behavior: 'auto'
                    });

                } else if (
                    event.key === 'End'
                ) {

                    event.preventDefault();

                    reel.scrollTo({

                        left: maximumScroll(),

                        behavior: 'auto'
                    });
                }
            }
        );


        // ========================================
        // 24. INICIAR ROLETA DOCUMENTAL
        // ========================================

        updateReel();
    }

});
