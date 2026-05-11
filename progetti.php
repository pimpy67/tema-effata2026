<?php
/**
 * Template Name: Progetti
 */
get_header(); ?>


    <main role="main">
        <div class="hero-progetti">
            <div class="content">
                <h1><?php the_title(); ?></h1>

                <?php get_template_part('template-parts/breadcrumbs'); ?>
          
            </div> <!-- End content -->
        </div>

        <section class="spacer">

            <div class="content progetti">

                    <h2 class="line green-title"><?php esc_html_e("Cosa facciamo", 'tema-effata2026'); ?></h2>
            </div>
        </section>


        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="content"><?php the_content(); ?></div>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

<?php get_footer(); ?>


