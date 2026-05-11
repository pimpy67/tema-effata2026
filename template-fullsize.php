<?php
/**
 * Template Name: Fullsize
 */
get_header(); ?>

    <main role="main">
        <div class="hero-progetti">
            <div class="content">
                <h1><?php the_title(); ?></h1>

                <?php get_template_part('template-parts/breadcrumbs'); ?>

            </div>
        </div>

        <section class="spacer gray">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="featured-image-wrapper">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php endif;?>

                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_content(); ?>

                    <?php endwhile; ?>
                <?php endif; ?>

        </section>
    </main>

<?php get_footer(); ?>
