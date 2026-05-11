<?php get_header(); ?>

    <main role="main">
        <div class="hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/above.png');">
            <div class="content">
                <div class="hero-content">
                    <h1><?php bloginfo('name'); ?></h1>
                    <h2><?php bloginfo('description'); ?></h2>

                    <p><?php esc_html_e('Con solo 0,5 euro al giorno garantisci cure, cibo, acqua e istruzione.', 'tema-effata2026'); ?> <br>
                    <?php esc_html_e('Lontani ma uniti: dona oggi, cambia un domani', 'tema-effata2026'); ?></p>

                            <div class="button-hero">

                                <a href="<?php echo get_permalink(get_page_by_path('adotta-ora')); ?>" class="button adotta"><?php esc_html_e('Adotta ora', 'tema-effata2026'); ?></a>

                            </div>

                </div> <!-- End hero content -->
            </div> <!-- End content -->
        </div>



        <section class="spacer">
                <div class="content">

                            <div class="section-title">
                                <h2 class="line green-title"><?php esc_html_e('Cosa facciamo', 'tema-effata2026'); ?></h2>
                            </div>
                </div> <!-- End Content -->




            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; ?>
            <?php endif; ?>

        </section>





        <section class="spacer gray">
                <div class="content">

                    <div class="section-title">
                        <h2 class="line green-title"><?php esc_html_e('In primo piano dal blog', 'tema-effata2026'); ?></h2>
                    </div>
 

                    <div class="flex blog-card">


                    <?php
                        
                        $args = array(
                            'post_type'      => 'post',      // Tipo di contenuto
                            'posts_per_page' => 3,             // Quanti vederne (-1 per tutti)
                            // 'category_name'  => 'news',        // Slug della categoria
                            'orderby'        => 'date',        // Ordina per data
                            'order'          => 'DESC',        // Dal più recente al più vecchio
                            'post__not_in' => get_option( 'sticky_posts')
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                    ?>        
                            
                            <div class="card">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('width' => 372, 'height' => 250)); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/adozione.png" alt="<?php the_title_attribute(); ?>" width="372" height="250">
                                        <?php endif; ?>
                                    </a>
                                </figure>
                                <div class="card-title">
                                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                </div> <!--End card-title-->
                            </div>

                    <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>




                        
                    </div><!--End Flex-->

                </div> <!-- End Content -->
        </section>

    </main>
<?php get_footer(); ?>
