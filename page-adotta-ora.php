<?php
/**
 * Template Name: Adotta Ora
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
                <h1><?php the_title(); ?></h1>
                <?php get_template_part('template-parts/breadcrumbs'); ?>
            </div>
        </div>

        <section class="spacer">
            <div class="content progetti">
                <h2 class="line green-title">Due mondi, <br> ma un legame unico.</h2>
            </div>
        </section>

        <?php
        $esito_ad = $_GET['esito'] ?? '';
        if ($esito_ad === 'ok'): ?>
            <div class="cpm-esito cpm-esito--ok" style="max-width:1160px; margin:0 auto 0;">
                <strong>Grazie!</strong> Abbiamo ricevuto la tua richiesta. Silvia ti contatterà presto.
            </div>
        <?php elseif ($esito_ad === 'errore'): ?>
            <div class="cpm-esito cpm-esito--errore" style="max-width:1160px; margin:0 auto 0;">
                <strong>Attenzione:</strong> Compila tutti i campi obbligatori e accetta la Privacy Policy.
            </div>
        <?php endif; ?>

        <span id="adozione-form" style="display:block; height:0; visibility:hidden;"></span>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>
