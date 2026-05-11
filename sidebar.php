                    <div class="col-6 col-2">
                        <aside class="sidebar">

                            <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
                                <?php dynamic_sidebar( 'sidebar-blog' ); ?>
                            <?php else : ?>
                                <p><?php esc_html_e('Aggiungi widget da Aspetto > Widget', 'tema-effata2026'); ?></p>
                            <?php endif; ?>
                        
                        </aside>
                    </div> <!--End col-6-->
 