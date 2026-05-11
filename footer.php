    <a href="<?php echo esc_url(home_url('/chi-siamo/contatti/')); ?>" class="fascia-rossa-link">
        <div class="fascia-rossa">
            <h2><?php esc_html_e('Restiamo in contatto', 'tema-effata2026'); ?></h2>
        </div>
    </a>


    <footer>
        <div class="flex spacer">

            <div class="col-4">
                <div class="text-footer">
                    <h3><?php esc_html_e('Italia', 'tema-effata2026'); ?></h3>

                    <h5>Effatà Italia Charity Organisation ODV</h5>
                    <h6>effataitalia@gmail.com</h6>
                    <h6>Tel 3701421570<h6>
                    <h6>Via Brustolon, 1 - 31044 Montebelluna (TV)</h6>
                    <h6>C.F. 92050910261</h6>
                </div> <!--End text-->
            </div> <!--End col-4-->

            <div class="col-4 center">
                <div class="logo-footer">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="Effata"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo1.png" alt="Logo Effata" width="128" height="80"></a>
                </div> <!--logo-footer-->
            </div> <!--End col-4-->

            <div class="col-4">
                <div class="text-footer">
                    <h3><?php esc_html_e('Uganda', 'tema-effata2026'); ?></h3>

                    <h5>Effatà Charity Organisation (Uganda)</h5>
                    <h6>effatacharity@gmail.com</h6>
                    <h6>Tel +256706910841 (Silvia Marcolin)<h6>
                    <h6>Nakibanga, Ntenjeru, Mukono</h6>
                </div> <!--End text-->
            </div> <!--End col-4-->

            </div> <!-- end flex spacer -->


        <section class="footer social gray">
            <section class="flex-social">


                <div class="col-4 footer-link">
                    <h6><a href="<?php echo esc_url(home_url('/iscriviti/')); ?>" style="color:#ed1c23; font-weight:700;"><?php esc_html_e('📩 Iscriviti alla newsletter', 'tema-effata2026'); ?></a></h6>
                    <h6><a href="<?php the_permalink(3);?>"><?php esc_html_e('Privacy Policy', 'tema-effata2026'); ?></a></h6>
                    <h6><a href="#"><?php esc_html_e('Dichiarazione di accessibilità', 'tema-effata2026'); ?></a></h6>
                </div> <!--End col-4-->


                <div class="col-4 footer-link">
                    <h6><a href="#"><?php esc_html_e('Cookie Policy', 'tema-effata2026'); ?></a></h6>
                    <h6><a href="#"><?php esc_html_e('Agevolazioni fiscali per i donatori', 'tema-effata2026'); ?></a></h6>
                </div> <!--End col-4-->

                <div class="col-4">
                    <span><?php esc_html_e('Seguici sui social', 'tema-effata2026'); ?></span>

                    <a href="https://www.facebook.com/p/Effata-Charity-Organisation-100090196903244/" target="_blank" aria-label="Facebook" class="social-icon facebook">
                    <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/effata_charity_organisation/?hl=en" target="_blank" aria-label="Instagram" class="social-icon instagram">
                    <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/@EFFATAUGANDA" target="_blank" aria-label="YouTube" class="social-icon youtube">
                    <i class="fab fa-youtube"></i>
                    </a>
                </div> <!--End col-4-->

            </div>
        </section>
    </footer>

<?php wp_footer(); ?>

</body>
</html>
