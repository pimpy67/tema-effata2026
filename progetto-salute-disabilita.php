<?php
/**
 * Template Name: Progetto Salute e Disabilità
 */
get_header(); ?>


    <main role="main">
        <div class="hero-progetti">
            <div class="content">
                <h1><?php esc_html_e('I nostri progetti', 'tema-effata2026'); ?></h1>

                <?php get_template_part('template-parts/breadcrumbs'); ?>

            </div> <!-- End content -->
        </div>


            <div class="content progetti">

                    <h2 class="line green-title"><?php esc_html_e('Salute e Assistenza Disabilità', 'tema-effata2026'); ?></h2>

            </div>


        <section class="spacer gray">
                <div class="content">


            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; ?>
            <?php endif; ?>


            </div>
        </section>
    </main>

<?php get_footer(); ?>
