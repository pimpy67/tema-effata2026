<?php
/**
 * Blocco "Come fare le donazioni" con link alla pagina Dona
 */
?>
<section class="spacer gray">
    <div class="content">
        <div class="cta-donazione">
            <h2>Come fare le donazioni</h2>
            <p><a href="<?php echo esc_url(home_url('/progetti/')); ?>">Scegli il progetto</a> che vuoi sostenere</p>
            <p>Scegli il metodo di pagamento che preferisci: bonifico, carta di credito, bancomat tramite POS</p>
            <a href="<?php echo esc_url(home_url('/dona/')); ?>" class="button adotta">Scopri come donare</a>
        </div>
    </div>
</section>
