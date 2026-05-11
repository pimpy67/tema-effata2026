<?php
/**
 * Template Name: Progetto Educazione
 */
get_header(); ?>

<main role="main">

    <!-- Hero con immagine in evidenza -->
    <?php $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
    <div class="hero-progetti"<?php if ( $url ) echo ' style="background-image:url(' . esc_url($url) . ');"'; ?>>
        <div class="content">
            <h1><?php the_title(); ?></h1>
            <?php get_template_part('template-parts/breadcrumbs'); ?>
            <a href="/adotta-ora/" class="button adotta" style="margin-top:28px; position:relative; z-index:2;">Adotta uno Studente</a>
        </div>
    </div>

    <!-- Sottotitolo fisso (come le altre pagine progetto) -->
    <section class="spacer" style="padding-bottom:0;">
        <div class="content progetti">
            <h2 class="line green-title">Con il sostegno scolastico, trasformiamo il destino di migliaia di bambini.</h2>
        </div>
    </section>

    <!-- Contenuto Gutenberg (paragrafo intro + blocchi HTML) -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_content();
    endwhile; endif; ?>

</main>

<?php get_footer(); ?>
