<?php
/**
 * Template predefinito per le pagine
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
            <div class="content">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail('full', array( 'class' => 'img-bg')); ?>
            <?php endif;?>

                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_content(); ?>

                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </section>
    </main>

<?php get_footer(); ?>
