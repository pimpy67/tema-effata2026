<?php
/**
 * Template Name: Come Aiutarci
 */
get_header(); ?>

<main role="main">

    <!-- Hero -->
    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
    <div class="hero-progetti"<?php if ($url) echo ' style="background-image: url(' . esc_url($url) . ');"'; ?>>
        <div class="content">
            <h1><?php the_title(); ?></h1>
            <?php get_template_part('template-parts/breadcrumbs'); ?>
        </div>
    </div>

    <!-- Contenuto Gutenberg -->
    <div class="come-aiutarci-wrap">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
        endwhile; endif; ?>
    </div>

    <!-- Come fare le donazioni -->
    <section class="donazioni">
        <div class="donazioni-inner">
            <h2>Come fare le donazioni</h2>

            <ol class="donazioni-steps">
                <li>Scegli il progetto che vuoi sostenere</li>
                <li>Scegli il metodo di pagamento che preferisci: bonifico, carta di credito, bancomat tramite POS</li>
            </ol>

            <div class="donazioni-metodi">
                <div class="donazioni-card">
                    <h3>Bonifico</h3>
                    <p>Da intestare a <strong>Effatà Italia Charity Organisation ODV</strong></p>
                    <p class="donazioni-iban">IBAN: IT 46W0200861720000106797497</p>
                    <p>Come causale indica il progetto scelto. Nel caso sia un'adozione riporta il nome del bambino.</p>
                    <p>Per garantirti la <strong>detrazione</strong> ricorda di riportare nella causale il codice fiscale (tuo o di chi beneficerà dell'agevolazione) e la dicitura <strong>DONAZIONE</strong>. Per saperne di più sulle detrazioni <a href="#detrazioni">leggi qui</a>.</p>
                </div>

                <div class="donazioni-card">
                    <h3>Carta di credito</h3>
                    <p>Puoi fare una donazione a distanza tramite carta di credito: invia la richiesta al nostro numero di segreteria <a href="tel:+393701421570">3701421570</a> e ti invieremo un link dal quale potrai eseguire il pagamento, come per qualsiasi altro pagamento online.</p>
                </div>
            </div>

            <p class="donazioni-contatti">Se vuoi maggiori informazioni su come donare o sui progetti puoi scriverci a <a href="mailto:effataitalia@gmail.com">effataitalia@gmail.com</a> o chiamare la nostra segreteria al <a href="tel:+393701421570">3701421570</a>.</p>
        </div>
    </section>

    <!-- Detrazioni e 5x1000 -->
    <section class="donazioni detrazioni" id="detrazioni">
        <div class="donazioni-inner">
            <h2>Detrazioni e 5×1000</h2>

            <p class="donazioni-intro">La nostra associazione italiana "Effatà Italia Charity Organisation ODV" è stata ufficialmente riconosciuta e registrata presso il RUNTS (Registro Unico Nazionale Terzo Settore). Questo riconoscimento ha due grandi vantaggi: rende <strong>detraibili al 35% per i privati (10% per le aziende)</strong> tutte le donazioni e permette di ricevere il 5×1000.</p>

            <div class="donazioni-metodi">
                <div class="donazioni-card">
                    <h3>Detrazioni: come fare per ottenerle</h3>
                    <ol class="donazioni-steps">
                        <li>Fai la tua donazione con metodi tracciabili (bonifico, assegno bancario, altri pagamenti elettronici)</li>
                        <li>Come causale, oltre al motivo specifico (es. Adozione scolastica di XXX) scrivi sempre la parola <strong>DONAZIONE</strong> e aggiungi il tuo <strong>codice fiscale</strong></li>
                        <li>Richiedi ad Effatà Italia (<a href="mailto:effataitalia@gmail.com">effataitalia@gmail.com</a>), a inizio anno, le ricevute delle tue donazioni dell'anno precedente (riconoscibili tramite codice fiscale) e inseriscile nel 730, alla stessa stregua di altre spese detraibili (es. mediche).</li>
                    </ol>
                    <p><strong>RICORDA:</strong> se non sei digitale (niente computer) chiamaci al <a href="tel:+393701421570">370 142 1570</a>: ti aiutiamo noi!</p>
                </div>

                <div class="donazioni-card">
                    <h3>Vuoi contribuire con il tuo 5×1000?</h3>
                    <p>Firma anche tu per il tuo 5 per mille a Effatà Italia Charity Organisation ODV: aggiungi la tua firma e il codice fiscale <strong>92050910261</strong> nel riquadro <strong>SOSTEGNO DEGLI ENTI DEL TERZO SETTORE</strong> della tua dichiarazione dei redditi.</p>
                    <p>Grazie 🙂</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
