<?php
/**
 * Barra fissa in basso per invitare all'iscrizione alla newsletter.
 * Compare dopo 1,5 secondi, si chiude con la X e non ricompare (localStorage).
 * Esclusa dalla pagina iscriviti e dalle landing / pagine di raccolta fondi.
 */

function effata_barra_newsletter_escluse() {
    $escluse = array( 'page-iscriviti.php', 'page-landing.php', 'page-5x1000.php', 'page-adotta-ora.php' );
    foreach ( $escluse as $template ) {
        if ( is_page_template( $template ) ) return true;
    }
    return is_page( 'iscriviti' ) || is_404();
}

function effata_barra_newsletter() {
    if ( is_admin() || effata_barra_newsletter_escluse() ) return;
    // FASE DI TEST: visibile solo agli amministratori. Rimuovere questa riga per renderla pubblica.
    if ( ! current_user_can( 'manage_options' ) ) return;
    $url = esc_url( home_url( '/iscriviti/#form-iscrizione' ) );
    ?>
    <style>
        #effata-barra-news {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9990;
            background: rgba(59, 140, 110, .92);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            color: #fff;
            font-family: 'Noto Sans', sans-serif;
            box-shadow: 0 -2px 12px rgba(0,0,0,.18);
            animation: effata-barra-in .5s ease 1.5s both;
        }
        @keyframes effata-barra-in { from { transform: translateY(100%); } to { transform: translateY(0); } }
        @media (prefers-reduced-motion: reduce) { #effata-barra-news { animation: none; transform: none; } }
        #effata-barra-news.is-chiusa { display: none; }
        #effata-barra-news .effata-barra-news__inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px 48px 10px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px 20px;
            flex-wrap: wrap;
            font-size: 15px;
            line-height: 1.4;
        }
        #effata-barra-news .effata-barra-news__testo { margin: 0; }
        #effata-barra-news .effata-barra-news__link {
            color: #ffd23f;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }
        #effata-barra-news .effata-barra-news__link:hover,
        #effata-barra-news .effata-barra-news__link:focus { text-decoration: underline; }
        #effata-barra-news .effata-barra-news__freccia {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            margin-left: 8px;
            border-radius: 50%;
            background: #ffd23f;
            vertical-align: middle;
        }
        #effata-barra-news .effata-barra-news__chiudi {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: 0;
            color: #fff;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            padding: 6px;
            opacity: .85;
        }
        #effata-barra-news .effata-barra-news__chiudi:hover { opacity: 1; }
        @media (max-width: 600px) {
            #effata-barra-news .effata-barra-news__inner { font-size: 14px; padding: 8px 40px 8px 12px; gap: 4px 10px; }
        }
    </style>
    <div id="effata-barra-news" role="region" aria-label="Iscrizione newsletter">
        <div class="effata-barra-news__inner">
            <p class="effata-barra-news__testo">
                Scopri tutti i contenuti e le novità di effataitalia.it.
                <a class="effata-barra-news__link" href="<?php echo $url; ?>">Iscriviti: non costa nulla, ma per noi è tanto<span class="effata-barra-news__freccia" aria-hidden="true"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#3b8c6e" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></a>
            </p>
        </div>
        <button type="button" class="effata-barra-news__chiudi" aria-label="Chiudi">&times;</button>
    </div>
    <script>
    (function () {
        var barra = document.getElementById('effata-barra-news');
        if (!barra) return;
        var chiave = 'effata-barra-news-chiusa';
        try {
            if (window.localStorage && localStorage.getItem(chiave) === '1') {
                barra.classList.add('is-chiusa');
                return;
            }
        } catch (e) {}

        barra.querySelector('.effata-barra-news__chiudi').addEventListener('click', function () {
            barra.classList.remove('is-visibile');
            barra.classList.add('is-chiusa');
            try { localStorage.setItem(chiave, '1'); } catch (e) {}
        });
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'effata_barra_newsletter', 20 );
