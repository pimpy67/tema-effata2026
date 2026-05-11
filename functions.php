<?php

// CARICAMENTO TRADUZIONI
function tema_effata_load_textdomain() {
    load_theme_textdomain('tema-effata2026', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'tema_effata_load_textdomain');

// FUNZIONI PER CSS E SCRIPT JQUERY
function load_theme_scripts() {
    if (!is_admin()) {

        // CSS
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'));
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/all.css');

        // Rubik solo sulla pagina Privacy Policy
        if (is_page('privacy-policy')) {
            wp_enqueue_style('rubik-font', 'https://fonts.googleapis.com/css2?family=Rubik:wght@400;600;700&display=swap');
        }
        wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css'); // STILE DI AOS (non è jquery)

        //SCRIPTS
wp_deregister_script('jquery'); // DISABILITIAMO jQuery

wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.js', array(), null, true);
wp_enqueue_script('jquery');

wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery', 'swiper-js'), null, true);

wp_enqueue_script('aos-script', 'https://unpkg.com/aos@2.3.1/dist/aos.js', null, true); // script di AOS (non è jquery)

//Abilita supporto AJAX ai commenti
wp_enqueue_script( 'comment-reply');

    }
}
add_action('wp_enqueue_scripts', 'load_theme_scripts');

//TITLE (affianco alla favicon)
add_theme_support('title-tag');

//MENU
add_theme_support('menus');

// Permetti HTML nei titoli del menu (per icone FontAwesome)
add_filter('nav_menu_item_title', 'decode_html_menu_title', 10, 4);
function decode_html_menu_title($title, $item, $args, $depth) {
    return html_entity_decode($title);
}

//WIDGET  
add_theme_support('widgets');

//IMMAGINE IN EVIDENZA
add_theme_support('post-thumbnails');

// Supporto per allineamenti GUTENBERG
add_theme_support('align-wide');




//RIMUOVO BLOCCHI WIDGET
function tema_vf_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action('after_setup_theme', 'tema_vf_theme_support');


// ATTIVA MENU'
register_nav_menus(array(
'main-menu' => __('Menù principale del tema', 'tema-effata2026'),
'footer-menu' => __('Menu per il piè di pagina', 'tema-effata2026')
));

// MODIFICO LE IMPOSTAZIONI DI EXCERPT PER IL TAGLIO DEL TESTO NEL BLOG PREVIEW (mi ritorna un max di 20 parole su 999)
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// MODIFICO LE IMPOSTAZIONI DI EXCERPT PER LA FINE DEL TAGLIO DEL TESTO NEL BLOG PREVIEW
function wpdocs_excerpt_more( $more ) { 
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' ); 


// FUNZIONE PER LA REGISTRAZIONE DELLA SIDEBAR
if (function_exists('register_sidebar'))
{
    register_sidebar( array(
        'name'          => 'Colonna blog',
        'id'            => 'sidebar-blog',
        'description'   => 'Colonna visibile nel blog',
        'before_widget' => '<div class="widget" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}


// FUNZIONE PER LA REGISTRAZIONE DI EVENTUALE SIDEBAR NEL FOOTER
if (function_exists('register_sidebar'))
{
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'tema-effata2026' ),
        'id'            => 'footer-left',
        'description'   => esc_html__( 'Footer credits', 'tema-effata2026' ),
        'before_widget' => '<div class="widget" id="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}
 
if (function_exists('register_sidebar'))
{
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'tema-effata2026' ),
        'id'            => 'footer-right',
        'description'   => esc_html__( 'Footer credits', 'tema-effata2026' ),
        'before_widget' => '<div class="widget" id="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}




// FUNZIONE PER INSERIRE IL PLACEHOLDER in un search con id=s

function aggiungi_placeholder_search() {
    ?>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('s');
        if (input) {
            input.setAttribute('placeholder', 'Search...');
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'aggiungi_placeholder_search' );



// CAROSELLO GUTERNBERG


function carica_swiper_assets() {
    // Carichiamo i CSS di Swiper da CDN
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    
    // Carichiamo il JS di Swiper
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'carica_swiper_assets');


// ═══════════════════════════════════════════════════════
// NEWSLETTER — ISCRITTI
// ═══════════════════════════════════════════════════════

// 1. CREA TABELLA al primo caricamento (o se mancante)
function effata_crea_tabella_iscritti() {
    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_iscritti';
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $tabella (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        nome varchar(100) NOT NULL,
        cognome varchar(100) NOT NULL DEFAULT '',
        email varchar(200) NOT NULL,
        privacy tinyint(1) NOT NULL DEFAULT 0,
        data_iscrizione datetime DEFAULT CURRENT_TIMESTAMP,
        ip varchar(45) DEFAULT '',
        esportato tinyint(1) NOT NULL DEFAULT 0,
        data_esportazione datetime DEFAULT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_switch_theme', 'effata_crea_tabella_iscritti');
add_action('admin_init', 'effata_crea_tabella_iscritti'); // sicurezza: crea se mancante

// 2. GESTIONE FORM (prima di qualsiasi output)
function effata_gestisci_iscrizione() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['effata_iscrivi_nonce'])) return;
    if (!wp_verify_nonce($_POST['effata_iscrivi_nonce'], 'effata_iscrivi')) return;

    $nome    = sanitize_text_field(trim($_POST['nome'] ?? ''));
    $cognome = sanitize_text_field(trim($_POST['cognome'] ?? ''));
    $email   = sanitize_email(trim($_POST['email'] ?? ''));
    $privacy = isset($_POST['privacy']) ? 1 : 0;

    // Validazione
    if (empty($nome) || empty($cognome) || !is_email($email) || !$privacy) {
        wp_safe_redirect(add_query_arg('esito', 'errore', get_permalink()));
        exit;
    }

    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_iscritti';

    // Controlla se email già presente
    $esiste = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $tabella WHERE email = %s", $email));
    if ($esiste) {
        wp_safe_redirect(add_query_arg('esito', 'giaiscritto', get_permalink()));
        exit;
    }

    // Salva nel database
    $wpdb->insert($tabella, array(
        'nome'    => $nome,
        'cognome' => $cognome,
        'email'   => $email,
        'privacy' => $privacy,
        'ip'      => $_SERVER['REMOTE_ADDR'] ?? '',
    ), array('%s', '%s', '%s', '%d', '%s'));

    // Invia email di notifica a Effata
    $admin_email = get_option('admin_email');
    $oggetto = 'Nuova iscrizione newsletter Effata: ' . $nome . ' ' . $cognome;
    $messaggio = "Nuovo iscritto alla newsletter:\n\nNome: $nome\nCognome: $cognome\nEmail: $email\nData: " . current_time('mysql');
    wp_mail($admin_email, $oggetto, $messaggio);

    wp_safe_redirect(add_query_arg('esito', 'ok', get_permalink()));
    exit;
}
add_action('init', 'effata_gestisci_iscrizione');

// SHORTCODE [effata_form_newsletter]
function effata_shortcode_form_newsletter() {
    $esito = $_GET['esito'] ?? '';
    ob_start();

    if ($esito === 'ok'): ?>
      <div style="background:#fff; border-radius:12px; padding:48px 40px; text-align:center; box-shadow:0 4px 20px rgba(0,0,0,0.08);">
        <div style="margin-bottom:20px;"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_rosso.jpg" alt="Effatà Italia" style="max-width:160px; height:auto;"></div>
        <h2 style="color:#ed1c23; font-size:1.6rem; font-weight:900; margin-bottom:12px;">Benvenuto/a nella famiglia Effatà!</h2>
        <p style="color:#555; line-height:1.8; margin-bottom:24px;">La tua iscrizione è avvenuta con successo.<br>Riceverai presto gli aggiornamenti da Silvia e dal team di Effatà Italia!</p>
        <a href="<?php echo home_url('/'); ?>" style="display:inline-block; background:#ed1c23; color:#fff; padding:14px 36px; border-radius:50px; font-weight:700; font-size:14px; text-transform:uppercase; letter-spacing:1px; text-decoration:none;">Torna al sito</a>
      </div>
    <?php elseif ($esito === 'giaiscritto'): ?>
      <div style="background:#fff; border-radius:12px; padding:48px 40px; text-align:center; box-shadow:0 4px 20px rgba(0,0,0,0.08);">
        <h2 style="color:#3b8c6e; font-size:1.4rem; font-weight:900; margin-bottom:12px;">Sei già tra i nostri!</h2>
        <p style="color:#555; line-height:1.8;">Questa email è già iscritta alla newsletter di Effatà.<br>Controlla la tua casella per i prossimi aggiornamenti.</p>
      </div>
    <?php else: ?>
      <?php if ($esito === 'errore'): ?>
        <div style="background:#fff0f0; border-left:4px solid #ed1c23; border-radius:4px; padding:14px 20px; margin-bottom:24px; color:#c0392b; font-size:14px;">⚠ Controlla i campi: nome, email valida e consenso privacy sono obbligatori.</div>
      <?php endif; ?>
      <div style="background:#fff; border-radius:12px; padding:56px 64px; box-shadow:0 8px 40px rgba(0,0,0,0.12); border-top:4px solid #ed1c23;">
        <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px;">
          <img src="<?php echo get_template_directory_uri(); ?>/img/logo_rosso.jpg" alt="Effatà Italia" style="width:48px; height:48px; object-fit:contain;">
          <p style="font-size:1rem; color:#555; line-height:1.7; margin:0;">Compila il form qui sotto e riceverai storie, novità dai nostri progetti, eventi e approfondimenti direttamente!</p>
        </div>
        <hr style="border:none; border-top:1px solid #eee; margin:0 0 32px;">
        <form method="POST" action="">
          <?php wp_nonce_field('effata_iscrivi', 'effata_iscrivi_nonce'); ?>
          <div style="margin-bottom:20px;">
            <label for="nome" style="display:block; font-size:15px; font-weight:600; color:#313131; margin-bottom:6px;">Nome <span style="color:#ed1c23;">*</span></label>
            <input type="text" id="nome" name="nome" required placeholder="Il tuo nome" autocomplete="given-name" style="width:100%; padding:12px 16px; border:2px solid #e5e5e5; border-radius:8px; font-size:15px; font-family:inherit; color:#313131; outline:none; box-sizing:border-box;">
          </div>
          <div style="margin-bottom:20px;">
            <label for="cognome" style="display:block; font-size:15px; font-weight:600; color:#313131; margin-bottom:6px;">Cognome <span style="color:#ed1c23;">*</span></label>
            <input type="text" id="cognome" name="cognome" required placeholder="Il tuo cognome" autocomplete="family-name" style="width:100%; padding:12px 16px; border:2px solid #e5e5e5; border-radius:8px; font-size:15px; font-family:inherit; color:#313131; outline:none; box-sizing:border-box;">
          </div>
          <div style="margin-bottom:24px;">
            <label for="email" style="display:block; font-size:15px; font-weight:600; color:#313131; margin-bottom:6px;">Email <span style="color:#ed1c23;">*</span></label>
            <input type="email" id="email" name="email" required placeholder="la-tua@email.it" autocomplete="email" style="width:100%; padding:12px 16px; border:2px solid #e5e5e5; border-radius:8px; font-size:15px; font-family:inherit; color:#313131; outline:none; box-sizing:border-box;">
          </div>
          <div style="margin-bottom:28px; display:flex; align-items:flex-start; gap:12px;">
            <input type="checkbox" id="privacy" name="privacy" required style="width:18px; height:18px; margin-top:2px; accent-color:#ed1c23; flex-shrink:0; cursor:pointer;">
            <label for="privacy" style="font-size:12px; color:#666; line-height:1.6; cursor:pointer;">Ho letto e accetto la <a href="<?php echo home_url('/privacy-policy'); ?>" target="_blank" style="color:#ed1c23; text-decoration:underline;">Privacy Policy</a> di Effatà Italia. <span style="color:#ed1c23;">*</span></label>
          </div>
          <div style="text-align:center;"><button type="submit" class="btn-newsletter-submit" style="display:inline-block; background:#ed1c23; color:#fff; border:none; padding:14px 32px; border-radius:50px; font-size:15px; font-weight:700; text-transform:uppercase; letter-spacing:1px; cursor:pointer; font-family:inherit; box-shadow:0 6px 20px rgba(237,28,35,0.30);">Sì, voglio unirmi a Effatà</button></div>
        </form>
      </div>
      <p style="text-align:center; font-size:12px; color:#aaa; margin-top:20px; line-height:1.7;">Effatà Italia Charity Organization ODV · C.F. 92050910261<br>Nessuno spam · Disiscrizione in qualsiasi momento</p>
    <?php endif;
    return ob_get_clean();
}
add_shortcode('effata_form_newsletter', 'effata_shortcode_form_newsletter');

// 3. MENU ADMIN — Iscritti Newsletter
function effata_admin_iscritti_menu() {
    add_menu_page(
        'Iscritti Newsletter',
        'Iscritti Newsletter',
        'manage_options',
        'effata-iscritti',
        'effata_admin_iscritti_page',
        'dashicons-email-alt',
        30
    );
}
add_action('admin_menu', 'effata_admin_iscritti_menu');

// 4. PAGINA ADMIN — Lista + Esporta CSV
function effata_admin_iscritti_page() {
    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_iscritti';

    // Esportazione CSV (tutti o solo nuovi)
    $export = $_GET['export'] ?? '';
    if (in_array($export, array('csv', 'csv_nuovi')) && current_user_can('manage_options')) {
        $solo_nuovi = ($export === 'csv_nuovi');
        $where = $solo_nuovi ? "WHERE esportato = 0" : "";
        $iscritti = $wpdb->get_results("SELECT id, nome, cognome, email, data_iscrizione FROM $tabella $where ORDER BY data_iscrizione DESC", ARRAY_A);

        // Segna come esportati
        $ids = array_column($iscritti, 'id');
        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '%d'));
            $wpdb->query($wpdb->prepare(
                "UPDATE $tabella SET esportato = 1, data_esportazione = %s WHERE id IN ($placeholders)",
                array_merge(array(current_time('mysql')), $ids)
            ));
        }

        $suffisso = $solo_nuovi ? '-nuovi' : '-tutti';
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="iscritti-newsletter-effata' . $suffisso . '-' . date('Y-m-d') . '.csv"');
        header('Pragma: no-cache');
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8
        fputcsv($output, array('Nome', 'Cognome', 'Email', 'Data Iscrizione'), ';');
        foreach ($iscritti as $riga) {
            unset($riga['id']);
            fputcsv($output, $riga, ';');
        }
        fclose($output);
        exit;
    }

    $iscritti  = $wpdb->get_results("SELECT * FROM $tabella ORDER BY data_iscrizione DESC");
    $totale    = count($iscritti);
    $nuovi     = $wpdb->get_var("SELECT COUNT(*) FROM $tabella WHERE esportato = 0");
    $export_tutti_url  = admin_url('admin.php?page=effata-iscritti&export=csv');
    $export_nuovi_url  = admin_url('admin.php?page=effata-iscritti&export=csv_nuovi');
    ?>
    <div class="wrap">
        <h1>Iscritti Newsletter Effata</h1>
        <p style="display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-top:12px;">
            <span>Totale: <strong><?php echo $totale; ?></strong></span>
            <span style="background:#ed1c23; color:#fff; padding:3px 10px; border-radius:20px; font-size:13px; font-weight:700;">
                <?php echo $nuovi; ?> nuovi da esportare
            </span>
            <a href="<?php echo esc_url($export_nuovi_url); ?>" class="button button-primary">
                ⬇ Esporta NUOVI (<?php echo $nuovi; ?>) per Vereifico
            </a>
            <a href="<?php echo esc_url($export_tutti_url); ?>" class="button">
                ⬇ Esporta tutti
            </a>
        </p>
        <p style="color:#888; font-size:12px; margin-top:0;">
            Dopo l'esportazione gli iscritti vengono segnati come "Esportato" automaticamente.
        </p>
        <?php if ($totale === 0): ?>
            <p>Nessun iscritto ancora.</p>
        <?php else: ?>
        <table class="widefat striped" style="margin-top:16px">
            <thead>
                <tr>
                    <th>#</th><th>Nome</th><th>Cognome</th><th>Email</th><th>Data Iscrizione</th><th>Stato</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($iscritti as $i => $r): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo esc_html($r->nome); ?></td>
                    <td><?php echo esc_html($r->cognome); ?></td>
                    <td><?php echo esc_html($r->email); ?></td>
                    <td><?php echo esc_html($r->data_iscrizione); ?></td>
                    <td>
                        <?php if ($r->esportato): ?>
                            <span style="color:#3b8c6e; font-size:12px; font-weight:600;">
                                ✓ Esportato<br>
                                <span style="color:#aaa; font-weight:400;"><?php echo esc_html(substr($r->data_esportazione, 0, 10)); ?></span>
                            </span>
                        <?php else: ?>
                            <span style="background:#ed1c23; color:#fff; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700;">NUOVO</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
    <?php
}

// ═══════════════════════════════════════════════════════
// 5x1000 PROMEMORIA — BACKEND
// ═══════════════════════════════════════════════════════

// 1. Crea tabella promemoria
function effata_crea_tabella_promemoria() {
    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_promemoria';
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $tabella (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        nome varchar(100) NOT NULL,
        cognome varchar(100) NOT NULL DEFAULT '',
        email varchar(200) NOT NULL,
        privacy tinyint(1) NOT NULL DEFAULT 0,
        data_iscrizione datetime DEFAULT CURRENT_TIMESTAMP,
        ip varchar(45) DEFAULT '',
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_switch_theme', 'effata_crea_tabella_promemoria');
add_action('admin_init', 'effata_crea_tabella_promemoria');

// 2. Gestione form (admin-post.php)
function effata_process_promemoria() {
    $nome    = sanitize_text_field(trim($_POST['nome'] ?? ''));
    $cognome = sanitize_text_field(trim($_POST['cognome'] ?? ''));
    $email   = sanitize_email(trim($_POST['email'] ?? ''));
    $privacy = isset($_POST['privacy']) ? 1 : 0;

    $referer       = wp_get_referer();
    $redirect_base = $referer ? remove_query_arg('esito', $referer) : home_url('/5x1000/');

    if (empty($nome) || empty($cognome) || !is_email($email) || !$privacy) {
        wp_safe_redirect(add_query_arg('esito', 'errore', $redirect_base));
        exit;
    }

    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_promemoria';

    $esiste = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $tabella WHERE email = %s", $email));
    if ($esiste) {
        wp_safe_redirect(add_query_arg('esito', 'giaiscritto', $redirect_base));
        exit;
    }

    $wpdb->insert($tabella, array(
        'nome'    => $nome,
        'cognome' => $cognome,
        'email'   => $email,
        'privacy' => $privacy,
        'ip'      => $_SERVER['REMOTE_ADDR'] ?? '',
    ), array('%s', '%s', '%s', '%d', '%s'));

    // Email di conferma all'utente — HTML con allegati
    $oggetto    = 'Il tuo promemoria 5×1000 — Effatà Italia';
    $tpl_path   = get_template_directory() . '/email-promemoria-5x1000.html';
    $corpo_html = file_get_contents($tpl_path);
    $corpo_html = str_replace('{NOME}', esc_html($nome), $corpo_html);
    $headers    = array('Content-Type: text/html; charset=UTF-8');
    $allegati   = array();
    $fronte     = get_template_directory() . '/img/5x1000_fronte_50x85.jpg';
    $retro      = get_template_directory() . '/img/5x1000_retro_50x85.png';
    if (file_exists($fronte)) $allegati[] = $fronte;
    if (file_exists($retro))  $allegati[] = $retro;
    wp_mail($email, $oggetto, $corpo_html, $headers, $allegati);

    // Notifica admin
    $admin_email = get_option('admin_email');
    $oggetto_admin  = 'Nuovo promemoria 5×1000: ' . $nome . ' ' . $cognome;
    $corpo_admin    = "Nome: $nome\nCognome: $cognome\nEmail: $email\nData: " . current_time('mysql');
    wp_mail($admin_email, $oggetto_admin, $corpo_admin);

    wp_safe_redirect(add_query_arg('esito', 'ok', $redirect_base));
    exit;
}
add_action('admin_post_process_promemoria', 'effata_process_promemoria');
add_action('admin_post_nopriv_process_promemoria', 'effata_process_promemoria');

// ═══════════════════════════════════════════════════════
// ADOTTA ORA — BACKEND
// ═══════════════════════════════════════════════════════

// 1. Crea tabella adozioni
function effata_crea_tabella_adozioni() {
    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_adozioni';
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $tabella (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        nome varchar(100) NOT NULL,
        cognome varchar(100) NOT NULL DEFAULT '',
        email varchar(200) NOT NULL,
        telefono varchar(50) DEFAULT '',
        privacy tinyint(1) NOT NULL DEFAULT 0,
        data_richiesta datetime DEFAULT CURRENT_TIMESTAMP,
        ip varchar(45) DEFAULT '',
        PRIMARY KEY (id)
    ) $charset;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_switch_theme', 'effata_crea_tabella_adozioni');
add_action('admin_init', 'effata_crea_tabella_adozioni');

// 2. Gestione form
function effata_process_donation() {
    $nome     = sanitize_text_field(trim($_POST['first_name'] ?? ''));
    $cognome  = sanitize_text_field(trim($_POST['last_name'] ?? ''));
    $email    = sanitize_email(trim($_POST['email'] ?? ''));
    $telefono = sanitize_text_field(trim($_POST['phone'] ?? ''));
    $privacy  = isset($_POST['privacy']) ? 1 : 0;

    $referer       = wp_get_referer();
    $redirect_base = $referer ? remove_query_arg('esito', $referer) : home_url('/adotta-ora/');

    if (empty($nome) || empty($cognome) || !is_email($email) || !$privacy) {
        wp_safe_redirect(add_query_arg('esito', 'errore', $redirect_base));
        exit;
    }

    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_adozioni';
    $wpdb->insert($tabella, array(
        'nome'     => $nome,
        'cognome'  => $cognome,
        'email'    => $email,
        'telefono' => $telefono,
        'privacy'  => $privacy,
        'ip'       => $_SERVER['REMOTE_ADDR'] ?? '',
    ), array('%s', '%s', '%s', '%s', '%d', '%s'));

    // Email a Effatà con i dati del richiedente
    $oggetto_admin  = 'Nuova richiesta adozione scolastica — ' . $nome . ' ' . $cognome;
    $corpo_admin    = "Nuova richiesta di adozione scolastica:\n\n";
    $corpo_admin   .= "Nome: $nome\n";
    $corpo_admin   .= "Cognome: $cognome\n";
    $corpo_admin   .= "Email: $email\n";
    $corpo_admin   .= "Telefono: " . ($telefono ?: '—') . "\n";
    $corpo_admin   .= "Data: " . current_time('mysql') . "\n";
    wp_mail('effataitalia@gmail.com', $oggetto_admin, $corpo_admin);

    // Email di conferma all'utente
    $oggetto_utente  = 'Grazie per la tua richiesta — Effatà Italia';
    $corpo_utente    = "Ciao $nome,\r\n\r\n";
    $corpo_utente   .= "abbiamo ricevuto la tua richiesta di adozione scolastica.\r\n\r\n";
    $corpo_utente   .= "Silvia ti contatterà presto per guidarti nei prossimi passi.\r\n\r\n";
    $corpo_utente   .= "Nel frattempo puoi scriverci a effataitalia@gmail.com\r\n";
    $corpo_utente   .= "o contattare Silvia su WhatsApp al +39 347 4640302.\r\n\r\n";
    $corpo_utente   .= "Grazie di cuore,\r\n";
    $corpo_utente   .= "Effatà Italia Charity Organisation ODV\r\n";
    $corpo_utente   .= "Via Brustolon 1, 31044 Montebelluna (TV)";
    wp_mail($email, $oggetto_utente, $corpo_utente);

    wp_safe_redirect(add_query_arg('esito', 'ok', $redirect_base));
    exit;
}
add_action('admin_post_process_donation', 'effata_process_donation');
add_action('admin_post_nopriv_process_donation', 'effata_process_donation');

// 3. MENU ADMIN — Richieste Adozione
function effata_admin_adozioni_menu() {
    add_menu_page(
        'Richieste Adozione',
        'Richieste Adozione',
        'manage_options',
        'effata-adozioni',
        'effata_admin_adozioni_page',
        'dashicons-heart',
        31
    );
}
add_action('admin_menu', 'effata_admin_adozioni_menu');

// 4. PAGINA ADMIN — Lista + Esporta CSV
function effata_admin_adozioni_page() {
    global $wpdb;
    $tabella = $wpdb->prefix . 'effata_adozioni';

    // Esportazione CSV
    $export = $_GET['export'] ?? '';
    if ($export === 'csv' && current_user_can('manage_options')) {
        $richieste = $wpdb->get_results("SELECT id, nome, cognome, email, telefono, data_richiesta FROM $tabella ORDER BY data_richiesta DESC", ARRAY_A);

        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="richieste-adozione-effata-' . date('Y-m-d') . '.csv"');
        header('Pragma: no-cache');
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8
        fputcsv($output, array('Nome', 'Cognome', 'Email', 'Telefono', 'Data Richiesta'), ';');
        foreach ($richieste as $riga) {
            unset($riga['id']);
            fputcsv($output, $riga, ';');
        }
        fclose($output);
        exit;
    }

    $richieste = $wpdb->get_results("SELECT * FROM $tabella ORDER BY data_richiesta DESC");
    $totale    = count($richieste);
    $export_url = admin_url('admin.php?page=effata-adozioni&export=csv');
    ?>
    <div class="wrap">
        <h1>Richieste Adozione — Effatà Italia</h1>
        <p style="display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-top:12px;">
            <span>Totale: <strong><?php echo $totale; ?></strong></span>
            <a href="<?php echo esc_url($export_url); ?>" class="button button-primary">
                ⬇ Esporta CSV
            </a>
        </p>
        <?php if ($totale === 0): ?>
            <p>Nessuna richiesta ancora.</p>
        <?php else: ?>
        <table class="widefat striped" style="margin-top:16px">
            <thead>
                <tr>
                    <th>#</th><th>Nome</th><th>Cognome</th><th>Email</th><th>Telefono</th><th>Data Richiesta</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($richieste as $i => $r): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo esc_html($r->nome); ?></td>
                    <td><?php echo esc_html($r->cognome); ?></td>
                    <td><?php echo esc_html($r->email); ?></td>
                    <td><?php echo esc_html($r->telefono); ?></td>
                    <td><?php echo esc_html($r->data_richiesta); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
    <?php
}

// ═══════════════════════════════════════════════════════

// CAMPI ACF — Numeri di Impatto (pagina Accoglienza e Protezione)
add_action('acf/init', 'effata_register_impact_fields');
function effata_register_impact_fields() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key'   => 'group_impact_numeri',
        'title' => 'Numeri di Impatto',
        'fields' => array(
            array(
                'key'   => 'field_impact_titolo',
                'label' => 'Titolo sezione',
                'name'  => 'impact_titolo',
                'type'  => 'text',
                'default_value' => 'Il nostro impatto in Uganda',
            ),
            array(
                'key'   => 'field_impact_num1',
                'label' => 'Numero 1',
                'name'  => 'impact_num1',
                'type'  => 'text',
                'instructions' => 'Es: +500',
                'default_value' => '+500',
            ),
            array(
                'key'   => 'field_impact_label1',
                'label' => 'Etichetta 1',
                'name'  => 'impact_label1',
                'type'  => 'text',
                'default_value' => 'Bambini accolti dal 2008 ad oggi',
            ),
            array(
                'key'   => 'field_impact_location',
                'label' => 'Località (pin centrale)',
                'name'  => 'impact_location',
                'type'  => 'text',
                'default_value' => 'Kalagala Village, Mukono District, Uganda',
            ),
            array(
                'key'   => 'field_impact_num2',
                'label' => 'Numero 2',
                'name'  => 'impact_num2',
                'type'  => 'text',
                'instructions' => 'Es: 100%',
                'default_value' => '100%',
            ),
            array(
                'key'   => 'field_impact_label2',
                'label' => 'Etichetta 2',
                'name'  => 'impact_label2',
                'type'  => 'text',
                'default_value' => 'Trasparenza nella rendicontazione',
            ),
        ),
        'location' => array(array(array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'progetto-accoglienza-protezione.php',
        ))),
        'position' => 'normal',
        'style'    => 'default',
    ));
}

// Open Graph gestito da Yoast SEO (plugin attivo)

// CAMPI ACF — Timeline Storia (pagina Chi Siamo)
add_action('acf/init', 'effata_register_chi_siamo_timeline');
function effata_register_chi_siamo_timeline() {
    if (!function_exists('acf_add_local_field_group')) return;

    $tappe_fields = array();
    foreach (array(1, 2, 3) as $n) {
        $tappe_fields[] = array(
            'key'   => "field_tappa{$n}_anno",
            'label' => "Tappa {$n} — Anno",
            'name'  => "tappa{$n}_anno",
            'type'  => 'text',
        );
        $tappe_fields[] = array(
            'key'   => "field_tappa{$n}_titolo",
            'label' => "Tappa {$n} — Titolo",
            'name'  => "tappa{$n}_titolo",
            'type'  => 'text',
        );
        $tappe_fields[] = array(
            'key'           => "field_tappa{$n}_immagine",
            'label'         => "Tappa {$n} — Immagine",
            'name'          => "tappa{$n}_immagine",
            'type'          => 'image',
            'return_format' => 'url',
        );
        $tappe_fields[] = array(
            'key'           => "field_tappa{$n}_link",
            'label'         => "Tappa {$n} — Link (opzionale)",
            'name'          => "tappa{$n}_link",
            'type'          => 'url',
        );
    }

    acf_add_local_field_group(array(
        'key'   => 'group_chi_siamo_timeline',
        'title' => 'Timeline Storia',
        'fields' => array_merge(array(
            array(
                'key'           => 'field_timeline_titolo',
                'label'         => 'Titolo sezione',
                'name'          => 'timeline_titolo',
                'type'          => 'text',
                'default_value' => 'Le tappe di un grande sogno',
            ),
            array(
                'key'           => 'field_timeline_desc',
                'label'         => 'Descrizione',
                'name'          => 'timeline_desc',
                'type'          => 'textarea',
                'rows'          => 3,
                'default_value' => 'Lavoriamo ogni giorno per cambiare il futuro a partire dall\'Uganda.',
            ),
            array(
                'key'           => 'field_timeline_btn_testo',
                'label'         => 'Testo pulsante',
                'name'          => 'timeline_btn_testo',
                'type'          => 'text',
                'default_value' => 'Scopri la nostra storia',
            ),
            array(
                'key'           => 'field_timeline_btn_link',
                'label'         => 'Link pulsante',
                'name'          => 'timeline_btn_link',
                'type'          => 'url',
                'default_value' => '#',
            ),
        ), $tappe_fields),
        'location' => array(array(array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-chi-siamo.php',
        ))),
        'position' => 'normal',
        'style'    => 'default',
    ));
}

// Disabilita l'output Open Graph e Twitter Card di Yoast SEO
// (i tag OG sono gestiti manualmente in header.php)
add_filter( 'option_wpseo_social', function( $options ) {
    $options['opengraph'] = false;
    $options['twitter']   = false;
    return $options;
} );