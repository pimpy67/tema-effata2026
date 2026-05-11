<?php
/**
 * Template Name: 5x1000
 */
get_header(); ?>

    <main role="main">
        <?php
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
        $style = $url ? ' style="background-image: url(' . esc_url($url) . ');"' : '';
        ?>
        <div class="hero-progetti"<?php echo $style; ?>>
            <div class="content">
                <p class="hero-5x1000-org">Effatà Italia Charity Organisation ODV</p>
                <h1><?php the_title(); ?></h1>
                <?php get_template_part('template-parts/breadcrumbs'); ?>
                <p class="hero-5x1000-sub">Con il tuo 5×1000 sostieni un futuro</p>
                <p class="hero-5x1000-cf">Basta una firma e il codice fiscale <strong>92050910261</strong></p>
            </div>
        </div>

        <section class="spacer">
            <div class="content progetti">
                <h2 class="line green-title">Costa zero. Vale tutto.</h2>
            </div>
        </section>

        <?php
        $esito_pm = $_GET['esito'] ?? '';
        if ($esito_pm === 'ok'): ?>
            <div class="cpm-esito cpm-esito--ok">
                <strong>Perfetto!</strong> Ti abbiamo inviato il promemoria via email. Controlla la tua casella!
            </div>
        <?php elseif ($esito_pm === 'giaiscritto'): ?>
            <div class="cpm-esito cpm-esito--info">
                <strong>Sei già tra i nostri!</strong> Questa email ha già ricevuto il promemoria. Controlla la tua casella.
            </div>
        <?php elseif ($esito_pm === 'errore'): ?>
            <div class="cpm-esito cpm-esito--errore">
                <strong>Attenzione:</strong> Compila tutti i campi e accetta la Privacy Policy.
            </div>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="cpm-content-wrap">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>
