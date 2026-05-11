<?php get_header(); ?>
    
<main role="main">
        <div class="hero-progetti">
            <div class="content">
                <h1><?php esc_html_e('404 - Pagina non trovata', 'tema-effata2026'); ?></h1>

                <?php get_template_part('template-parts/breadcrumbs'); ?>

            </div> <!-- End content -->
        </div>



        <section class="spacer">
                <div class="content error-404">

                <h2><?php esc_html_e('404 - Pagina non trovata', 'tema-effata2026'); ?></h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/error.jpg" alt="<?php esc_attr_e('Errore', 'tema-effata2026'); ?>" width="550" height="300">
            </div>
        </section>

</main>

<?php get_footer(); ?>
