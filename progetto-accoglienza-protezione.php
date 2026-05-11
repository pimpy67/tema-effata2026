<?php
/**
 * Template Name: Progetto Accoglienza e Protezione
 */
get_header(); ?>


    <main role="main">
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
        <div class="hero-progetti" style="background-image: url(<?php echo esc_url($url); ?>);">
            <div class="content">
                <h1><?php the_title(); ?></h1>

                <?php get_template_part('template-parts/breadcrumbs'); ?>

                <a href="https://calendario.effataitalia.it/" class="button adotta" style="margin-top:28px; position:relative; z-index:2;">Adotta un Giorno</a>

            </div> <!-- End content -->
        </div>

        <section class="spacer">
            <div class="content progetti">
                <h2 class="line green-title">Effatà Children's Home</h2>
            </div>
        </section>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="accoglienza-content"><?php the_content(); ?></div>

            <?php endwhile; ?>
        <?php endif; ?>

        <?php
        // Blocco 3 — Numeri di Impatto (valori da ACF)
        $titolo   = get_field('impact_titolo')   ?: 'Il nostro impatto in Uganda';
        $num1     = get_field('impact_num1')      ?: '+500';
        $label1   = get_field('impact_label1')    ?: 'Bambini accolti dal 2008 ad oggi';
        $location = get_field('impact_location')  ?: 'Kalagala Village, Mukono District, Uganda';
        $num2     = get_field('impact_num2')      ?: '100%';
        $label2   = get_field('impact_label2')    ?: 'Trasparenza nella rendicontazione';
        ?>
        <section class="impact-section spacer">
            <div class="content">
                <div class="impact-intro">
                    <h2><?php echo esc_html($titolo); ?></h2>
                </div>
                <div class="impact-grid">
                    <div class="impact-item">
                        <span class="impact-number counter-number"><?php echo esc_html($num1); ?></span>
                        <p><?php echo esc_html($label1); ?></p>
                    </div>
                    <div class="impact-item">
                        <span class="impact-number"><i class="fas fa-map-marker-alt"></i></span>
                        <p><?php echo esc_html($location); ?></p>
                    </div>
                    <div class="impact-item">
                        <span class="impact-number counter-number"><?php echo esc_html($num2); ?></span>
                        <p><?php echo esc_html($label2); ?></p>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php get_footer(); ?>
