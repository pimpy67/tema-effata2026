<?php get_header(); ?>

    <main role="main">
        <div class="hero-progetti">
            <div class="content">
                    <h1><?php printf( esc_html__( 'Risultati per: %s', 'tema-effata2026' ), get_search_query() ); ?></h1>

                <?php get_template_part('template-parts/breadcrumbs'); ?>

            </div> <!-- End content -->
        </div>


        <section class="spacer">

            <div class="content">

                    <div class="section-title">
                        <h2 class="line green-title"><?php esc_html_e('Risultati della ricerca', 'tema-effata2026'); ?>
                        </h2>
                    </div>

                    <div class="divider"></div>

            <div class="flex blog-card">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>


                        <div class="card">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('full', array( 'class' => 'img-bg')); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/default.png" alt="<?php the_title_attribute(); ?>" class="img-bg">
                                <?php endif; ?>
                                </a>
                            </figure>

                            <div class="card-title">

                                <div class="post-meta">
                                    <span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                    <span class="post-author">• <?php esc_html_e('di', 'tema-effata2026'); ?> <?php the_author_posts_link(); ?></span>
                                </div>

                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>

                            </div> <!--End card-title-->
                        </div>

                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="no-results">
                        <p><?php esc_html_e('Nessun risultato trovato. Prova con altre parole chiave.', 'tema-effata2026'); ?></p>
                    </div>
                <?php endif; ?>

            </div><!--End Flex-->


            </div> <!-- End Content -->

        </section>


        <div class="pagination">
            <?php the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Prev', 'tema-effata2026'),
                'next_text' => __( 'Next', 'tema-effata2026'),
            )
            );
             ?>

        </div>
    </main> <!-- End main -->


<?php get_footer(); ?>
