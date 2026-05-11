<?php
/**
 * Template Name: Template Hero
 */
get_header(); ?>
 
    <main role="main">
/**QUESTO PER CAMBIARE E LA IMMAGINE IN EVIDENZA CAMBIANDO L'IMMAGINE DELLA HERO */
    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

        <div class="hero-progetti" style="background-image: url(<?php echo $url; ?>);">

            <div class="content">
                <h1><?php the_title(); ?></h1>

                <?php get_template_part('template-parts/breadcrumbs'); ?>

            </div>
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
