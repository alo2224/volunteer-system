<?php	
//Add functions for volunteers 
require_once('includes/functions-wolontariusz.php');

//define('WP_DEBUG', true);
//define('WP_DEBUG_LOG', true);
/// Add custom fields to user registration

//1. Add a new form element...
add_action( 'register_form', 'wolontariat_register_form' );
function wolontariat_register_form() {

    $imie = ( ! empty( $_POST['imie'] ) ) ? trim( $_POST['imie'] ) : '';
    $nazwisko = ( ! empty( $_POST['nazwisko'] ) ) ? trim( $_POST['nazwisko'] ) : '';
    $pesel = ( ! empty( $_POST['pesel'] ) ) ? trim( $_POST['pesel'] ) : '';
    $numer_dowodu = ( ! empty( $_POST['numer_dowodu'] ) ) ? trim( $_POST['numer_dowodu'] ) : '';
    $adres = ( ! empty( $_POST['adres'] ) ) ? trim( $_POST['adres'] ) : '';
    $kod_pocztowy = ( ! empty( $_POST['kod_pocztowy'] ) ) ? trim( $_POST['kod_pocztowy'] ) : '';
    $telefon = ( ! empty( $_POST['telefon'] ) ) ? trim( $_POST['telefon'] ) : '';
    $numer_konta = ( ! empty( $_POST['numer_konta'] ) ) ? trim( $_POST['numer_konta'] ) : '';
    $nazwa_uczelni = ( ! empty( $_POST['nazwa_uczelni'] ) ) ? trim( $_POST['nazwa_uczelni'] ) : '';
    $kierunek_studiow = ( ! empty( $_POST['kierunek_studiow'] ) ) ? trim( $_POST['kierunek_studiow'] ) : '';
    $rok_studiow = ( ! empty( $_POST['rok_studiow'] ) ) ? trim( $_POST['rok_studiow'] ) : '';
    $typ_uzytkownika = ( ! empty( $_POST['typ_uzytkownika'] ) ) ? trim( $_POST['typ_uzytkownika'] ) : '';
    $ilosc_godzin_wolontariatu = ( ! empty( $_POST['ilosc_godzin_wolontariatu'] ) ) ? trim( $_POST['ilosc_godzin_wolontariatu'] ) : '';
    
        //Data validation done with esc_attr 
        ?>
        <script>
            window.onload = function(){
                var iloscGodzinForm = document.getElementById('ilosc_godzin_form');
                var praktykantRadioButton = document.getElementById('praktykant');
                var wolontariuszRadioButton = document.getElementById('wolontariusz');
                var iloscGodzinWolontariatuInput = document.getElementById('ilosc_godzin_wolontariatu');
                praktykantRadioButton.onclick = function(){
                    iloscGodzinForm.style.display = 'block';
                }
                wolontariuszRadioButton.onclick = function(){
                    iloscGodzinForm.style.display = 'none';
                    iloscGodzinWolontariatuInput.value = '';
                }
            }
        </script>
        <p>
            <label for="imie"><?php _e( 'Imie', 'mydomain' ) ?><br />
            <input type="text" name="imie" id="imie" class="input" value="<?php echo esc_attr( wp_unslash( $imie ) ); ?>" size="25" /></label>
        </p>

	<p>
            <label for="nazwisko"><?php _e( 'Nazwisko', 'mydomain' ) ?><br />
            <input type="text" name="nazwisko" id="nazwisko" class="input" value="<?php echo esc_attr( wp_unslash( $nazwisko ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="pesel"><?php _e( 'Pesel', 'mydomain' ) ?><br />
            <input type="text" name="pesel" id="pesel" class="input" value="<?php echo esc_attr( wp_unslash( $pesel ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="numer_dowodu"><?php _e( 'Numer dowodu', 'mydomain' ) ?><br />
            <input type="text" name="numer_dowodu" id="numer_dowodu" class="input" value="<?php echo esc_attr( wp_unslash( $numer_dowodu ) ); ?>" size="25" /></label>
        </p>
        <div>
            <h4>Dane kontaktowe</h4>
        <p>
            <label for="adres"><?php _e( 'Adres', 'mydomain' ) ?><br />
            <input type="text" name="adres" id="adres" class="input" value="<?php echo esc_attr( wp_unslash( $adres ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="kod_pocztowy"><?php _e( 'Kod pocztowy', 'mydomain' ) ?><br />
            <input type="text" name="kod_pocztowy" id="kod_pocztowy" class="input" value="<?php echo esc_attr( wp_unslash( $kod_pocztowy ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="telefon"><?php _e( 'Telefon', 'mydomain' ) ?><br />
            <input type="text" name="telefon" id="telefon" class="input" value="<?php echo esc_attr( wp_unslash( $telefon ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="numer_konta"><?php _e( 'Numer konta', 'mydomain' ) ?><br />
            <input type="text" name="numer_konta" id="numer_konta" class="input" value="<?php echo esc_attr( wp_unslash( $numer_konta ) ); ?>" size="25" /></label>
        </p>
        </div>
        <div>
            <h4>Uczelnia</h4>
            <p>
                <label for="nazwa_uczelni"><?php _e( 'Nazwa uczelni', 'mydomain' ) ?><br />
                <input type="text" name="nazwa_uczelni" id="nazwa_uczelni" class="input" value="<?php echo esc_attr( wp_unslash( $nazwa_uczelni ) ); ?>" size="25" /></label>
            <p>
                <label for="kierunek_studiow"><?php _e( 'Kierunek studiow', 'mydomain' ) ?><br />
                <input type="text" name="kierunek_studiow" id="kierunek_studiow" class="input" value="<?php echo esc_attr( wp_unslash( $kierunek_studiow ) ); ?>" size="25" /></label>
            </p>
            <p>
                <label for="rok_studiow"><?php _e( 'Rok studiow', 'mydomain' ) ?><br />
                <input type="text" name="rok_studiow" id="rok_studiow" class="input" value="<?php echo esc_attr( wp_unslash( $rok_studiow ) ); ?>" size="25" /></label>
            </p>
            
        </div>
        <div>
            <h4>Typ uzytkownika</h4>
            <p>
                <input <?php if($typ_uzytkownika == 'wolontariusz'){echo 'checked';}?> type="radio" name="typ_uzytkownika" id="wolontariusz"  value="<?php echo "wolontariusz" ?>" size="25" />
                <label for="typ_uzytkownika"><?php _e( 'Wolontariusz', 'mydomain' ) ?></label>
            </p>
            <p>
                <input <?php if($typ_uzytkownika == 'praktykant'){echo 'checked';}?> type="radio" name="typ_uzytkownika" id="praktykant"  value="<?php echo "praktykant" ?>" size="25" />
                <label for="typ_uzytkownika"><?php _e( 'Praktykant', 'mydomain' ) ?></label>
            </p>
            <p id="ilosc_godzin_form" <?php if($typ_uzytkownika != 'praktykant'){ echo 'style="display: none"';} ?>>
                <label for="ilosc_godzin_wolontariatu">Ilosc godzin wolontariatu</label>
                <input name="ilosc_godzin_wolontariatu" type="text" class="form-control" id="ilosc_godzin_wolontariatu" value="<?php echo esc_attr( wp_unslash( $ilosc_godzin_wolontariatu ) ); ?>">
            </p>
        </div>
        </div>
        <?php
    }

    //2. Add empty string validation errors. 
    add_filter( 'registration_errors', 'wol_registration_errors', 10, 3 );
    function wol_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        if ( empty( $_POST['imie'] ) || ! empty( $_POST['imie'] ) && trim( $_POST['imie'] ) == '' ) {
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać imie!.', 'mydomain' ) );
        }
	if ( empty( $_POST['nazwisko'] ) || ! empty( $_POST['nazwisko'] ) && trim( $_POST['nazwisko'] ) == '' ){
            $errors->add( 'nazwisko_error', __( '<strong>Blad!</strong>: Musisz wpisać nazwisko!.', 'mydomain' ) );
        }
        if ( empty( $_POST['pesel'] ) || ! empty( $_POST['pesel'] ) && trim( $_POST['pesel'] ) == '' ){
            $errors->add( 'pesel_error', __( '<strong>Blad!</strong>: Musisz wpisać pesel!.', 'mydomain' ) );
        }
        elseif (strlen($_POST['pesel']) != 11 && !is_numeric($_POST['pesel'])) {
            $errors->add( 'pesel_error', __( '<strong>Blad!</strong>: Podaj prawidłowy pesel!.', 'mydomain' ) );
        }
        if ( empty( $_POST['numer_dowodu'] ) || ! empty( $_POST['numer_dowodu'] ) && trim( $_POST['numer_dowodu'] ) == '' ){
            $errors->add( 'numer_dowodu_error', __( '<strong>Blad!</strong>: Musisz wpisać numer dowodu!.', 'mydomain' ) );
        }
        elseif(strlen($_POST['numer_dowodu']) != 9 && strlen($_POST['numer_dowodu']) != 10){
             $errors->add( 'numer_dowodu_error', __( '<strong>Blad!</strong>: Wpisz poprawny numer dowodu!.', 'mydomain' ) );
        }
        if ( empty( $_POST['adres'] ) || ! empty( $_POST['adres'] ) && trim( $_POST['adres'] ) == '' ){
            $errors->add( 'adres_error', __( '<strong>Blad!</strong>: Musisz wpisać adres!.', 'mydomain' ) );
        }
        if ( empty( $_POST['kod_pocztowy'] ) || ! empty( $_POST['kod_pocztowy'] ) && trim( $_POST['kod_pocztowy'] ) == '' ){
            $errors->add( 'kod_pocztowy_error', __( '<strong>Blad!</strong>: Musisz wpisać kod pocztowy!.', 'mydomain' ) );
        }
        elseif(strlen($_POST['kod_pocztowy']) != 6){
            $errors->add( 'kod_pocztowy_error', __( '<strong>Blad!</strong>:Wpisz poprawny kod pocztowy!.', 'mydomain' ) );
        }
        if ( empty( $_POST['telefon'] ) || ! empty( $_POST['telefon'] ) && trim( $_POST['telefon'] ) == '' ){
            $errors->add( 'telefon_error', __( '<strong>Blad!</strong>: Musisz wpisać telefon!.', 'mydomain' ) );
        }
        if ( empty( $_POST['numer_konta'] ) || ! empty( $_POST['numer_konta'] ) && trim( $_POST['numer_konta'] ) == '' ){
            $errors->add( 'numer_konta_error', __( '<strong>Blad!</strong>: Musisz wpisać numer konta!.', 'mydomain' ) );
        }
        elseif(strlen($_POST['numer_konta']) != 26 && !is_numeric($_POST['numer_konta'])){
            $errors->add( 'numer_konta_error', __( '<strong>Blad!</strong>: Wpisz poprawny numer konta', 'mydomain' ) );
        }
        if ( empty( $_POST['nazwa_uczelni'] ) || ! empty( $_POST['nazwa_uczelni'] ) && trim( $_POST['nazwa_uczelni'] ) == '' ){
            $errors->add( 'nazwa_uczelni_error', __( '<strong>Blad!</strong>: Musisz wpisać nazwe uczelni!.', 'mydomain' ) );
        }
        if ( empty( $_POST['kierunek_studiow'] ) || ! empty( $_POST['kierunek_studiow'] ) && trim( $_POST['kierunek_studiow'] ) == '' ){
            $errors->add( 'kierunek_studiow_error', __( '<strong>Blad!</strong>: Musisz wpisać kierunek studiow!.', 'mydomain' ) );
        }
        if ( empty( $_POST['rok_studiow'] ) || ! empty( $_POST['rok_studiow'] ) && trim( $_POST['rok_studiow'] ) == '' ){
            $errors->add( 'rok_studiow_error', __( '<strong>Blad!</strong>: Musisz wpisać rok studiow!.', 'mydomain' ) );
        }
        elseif(!is_numeric($_POST['rok_studiow'])){
            $errors->add( 'rok_studiow_error', __( '<strong>Blad!</strong>: Podaj poprawny rok studiow!.', 'mydomain' ) );
        }
        if ( empty( $_POST['typ_uzytkownika'] ) || ! empty( $_POST['typ_uzytkownika'] ) && trim( $_POST['typ_uzytkownika'] ) == '' ){
            $errors->add( 'typ_uzytkownika_error', __( '<strong>Blad!</strong>: Musisz podać typ uzytkownika!.', 'mydomain' ) );
        }
        if ( ($_POST['typ_uzytkownika'] == 'praktykant') && (empty( $_POST['ilosc_godzin_wolontariatu'] ) || ! empty( $_POST['ilosc_godzin_wolontariatu'] ) && trim( $_POST['ilosc_godzin_wolontariatu'] ) == '' )){
            $errors->add( 'ilosc_godzin_wolontariatu_error', __( '<strong>Blad!</strong>: Musisz wpisać ilosc godzin wolontariatu!.', 'mydomain' ) );
        }
        return $errors;
    }
    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'wol_user_register' );
    function wol_user_register( $user_id ) {
        if ( ! empty( $_POST['imie'] ) ) {
            sanitize_text_field($_POST['imie']);
            update_user_meta( $user_id, 'imie', trim( $_POST['imie'] ) );
        }	
        if ( ! empty( $_POST['nazwisko'] ) ) {
            sanitize_text_field($_POST['nazwisko']);
            update_user_meta( $user_id, 'nazwisko', trim( $_POST['nazwisko'] ) );
        }
        create_wolontariusz_post($user_id, $_POST);
    }
/*user meta in admin */
add_action( 'show_user_profile', 'display_wol_fields' );
add_action( 'edit_user_profile', 'display_wol_fields' );

function display_wol_fields( $user ) { ?>
    <h3>Twoja organizacja</h3>
    <table class="form-table">
        <tr>
            <th><label>Imie</label></th>
            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'imie', true ); ?>" class="regular-text" readonly=readonly /></td>
        </tr>
	<tr>
            <th><label>Nazwisko</label></th>
            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'nazwisko', true ); ?>" class="regular-text" readonly=readonly /></td>
        </tr>
	<tr>
            <th><label>ID wolontariusza</label></th>
            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'wolontariusz_id', true ); ?>" class="regular-text" readonly=readonly /></td>
        </tr>
    </table>
    <?php
}

//Adds a new custom post to the Admin menu
function custom_post_type_preferencja() {

	$labels = array(
		'name'                => 'Preferencja',
		'singular_name'       => 'Preferencje',
		'menu_name'           => 'Preferencje',
		'parent_item_colon'   => 'Nadrzedna preferencja',
		'all_items'           => 'Wszystkie preferencje',
		'view_item'           => 'Pokaz preferencje',
		'add_new_item'        => 'Dodaj nowa preferencjae',
		'add_new'             => 'Nowa preferencja',
		'edit_item'           => 'Edytuj preferencje',
		'update_item'         => 'Zaktualizuj preferencje',
		'search_items'        => 'Szukaj preferencji',
		'not_found'           => 'Nie znaleziono',
		'not_found_in_trash'  => 'Nie znaleziono w koszu',
	);
	$args = array(
		'label'               => 'preferencja',
		'description'         => 'Wszystkie preferencje dotyczace dni dziedzictwa',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'post-formats', ),
		'taxonomies'          => array( 'category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-businessman',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'preferencja', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_preferencja', 0 );	
//Adds a new custom post to the Admin menu
function custom_post_type_wolontariusz() {

	$labels = array(
		'name'                => 'Wolontariusze',
		'singular_name'       => 'Wolontariusz',
		'menu_name'           => 'Wolontariusze',
		'parent_item_colon'   => 'Nadrzedny wolontariusz:',
		'all_items'           => 'Wszyscy wolontariusze',
		'view_item'           => 'Pokaz wolontariusza',
		'add_new_item'        => 'Dodaj nowego wolontariusza',
		'add_new'             => 'Nowy wolontariusz',
		'edit_item'           => 'Edytuj wolontariusza',
		'update_item'         => 'Zaktualizuj wolontariusza',
		'search_items'        => 'Szukaj wolontariusza',
		'not_found'           => 'Nie znaleziono',
		'not_found_in_trash'  => 'Nie znaleziono w koszu',
	);
	$args = array(
		'label'               => 'wolontariusz',
		'description'         => 'Wszyscy pracownicy i wspolpracownicy',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'post-formats', ),
		'taxonomies'          => array( 'category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-businessman',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wolontariusz', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_wolontariusz', 0 );
register_post_type(
    'komunikat',
        array (
        'can_export'          => TRUE
    ,   'exclude_from_search' => FALSE
    ,   'has_archive'         => TRUE
    ,   'hierarchical'        => TRUE
    ,   'label'               => 'Komunikaty'
    ,   'menu_position'       => 5
    ,   'public'              => TRUE
    ,   'publicly_queryable'  => TRUE
    ,   'query_var'           => 'komunikat'
    ,   'rewrite'             => array ( 'slug' => 'komunikat' )
    ,   'show_ui'             => TRUE
    ,   'show_in_menu'        => TRUE
    ,   'show_in_nav_menus'   => TRUE
    ,   'supports'            => array ( 'editor', 'title' )
    )
);
add_action( 'init', 'create_komunikat_taxonomies', 0 );

//Creates Tags for komunikat post type in order to create a hierarchy
function create_komunikat_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Priorytet', 'taxonomy general name' ),
    'search_items' =>  __( 'Szukaj priorytetu' ),
    'all_items' => __( 'Wszystkie priorytety' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edytuj priorytet' ), 
    'update_item' => __( 'Aktualizuj priorytet' ),
    'add_new_item' => __( 'Dodaj priorytet' ),
    'new_item_name' => __( 'Nazwa priorytetu' ),
    'add_or_remove_items' => __( 'Dodaj lub usuń priorytet' ),
    'choose_from_most_used' => __( 'Wybierz z najczesciej uzywanych' ),
    'menu_name' => __( 'Priorytety' ),
  ); 
//used for priretization of alerts
  register_taxonomy(
          'priorytet',
          'komunikat',
          array(
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array( 'slug' => 'priorytet' ),
          ));
  register_taxonomy_for_object_type('wazne', 'komunikat');
}
add_filter( 'registration_redirect', 'my_redirect_to_form' );
function my_redirect_to_form( $registration_redirect ) {
	return home_url('wp-login.php');
}
/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if (in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return home_url();
		} else {
			return home_url();
		}
	} else {
		return home_url();
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
// Redefine user notification function - send mail after registration 
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);
        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
        $message  = sprintf(__('New user registration on your blog %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";
       // @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);
        if ( empty($plaintext_pass) )
            return;
        $message  = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
        $message .= wp_login_url() . "\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n\r\n";
        $message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Adios!');
       // wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);

    }
}
//defines the template for pdf creation
add_filter('bwsplgns_get_pdf_print_content', 
    function( $content ) {
        $current_post_id = get_the_ID();
        $current_post_type = get_post_type($current_post_id);
        $my_content = '';
        if($current_post_type == 'wolontariusz'){
            $dane_wolontariusza = get_fields($current_post_id);
            $dane_uzytkownika = get_userdata($dane_wolontariusza['uzytkownik_id']);
            $preferencja_dni_dziedzictwa = get_fields($dane_wolontariusza['preferencja']->ID);
            $my_content .= '<style>table{font-family: "Times New Roman";}</style>';
            $my_content .= '<table style="width:100%">';
            /*
            foreach($dane_wolontariusza as $key => $value){
                if(is_string($value)){
                    $my_content .= '<tr>';
                    $my_content .= '<td>';
                    $my_content .= $key;
                    $my_content .= '</td>';
                    $my_content .= '<td>';
                    $my_content .= $value;
                    $my_content .= '</td>';
                    $my_content .= '</tr>';
                }
            }
            //$my_content .= var_dump($dane_wolontariusza);
             * 
             */
            $my_content .= '<tr style="background:lightblue"><th colspan="4">DANE OSOBOWE</th></tr>';
            $my_content .= '<tr><td style="width:30%">Imie i Nazwisko</td><td colspan="3">';
            $my_content .= $dane_wolontariusza['imie'] . ' ' . $dane_wolontariusza['nazwisko'];
            $my_content .= '</td></tr>';
            $my_content .= '<tr><td style="width:30%">Nr dowodu osobistego</td><td colspan="3">';
            $my_content .= $dane_wolontariusza['numer_dowodu'];
            $my_content .= '</td></tr>';
            $my_content .= '<tr><td style="width:30%">PESEL</td><td colspan="3">';
            $my_content .= $dane_wolontariusza['pesel'];
            $my_content .= '</td></tr>';
            $my_content .= '<tr><td style="width:30%">E-mail</td><td colspan="3">';
            $my_content .= $dane_uzytkownika->user_email;
            $my_content .= '</td></tr>';
            $my_content .= '<tr><td style="width:30%">Telefon</td><td colspan="3">';
            $my_content .= $dane_wolontariusza['telefon'];
            $my_content .= '</td></tr>';
            $my_content .= '<tr><td style="width:30%">Numer konta bankowego</td><td colspan="3">';
            $my_content .= $dane_wolontariusza['numer_konta'];
            $my_content .= '</td></tr>';
            $my_content .= '<tr style="background:lightblue"><th colspan="4">DANE O WOLONTARIACIE</th></tr>';
            $my_content .= '<tr><td style="width:30%">Obsługa punktu</td><td style="width:30%; text-align:left">Pierwszy raz: ';
            if($preferencja_dni_dziedzictwa['czy_uczestniczyl'] == 'nie'){
                $my_content .= 'Tak';
            }
            $my_content .= '</td><td style="width:40%" colspan="2">Drugi raz/kolejny (wpisz liczbę edycji MDDK): ';
            if($preferencja_dni_dziedzictwa['czy_uczestniczyl'] == 'tak'){
                $my_content .= PHP_EOL . $preferencja_dni_dziedzictwa['liczba_udzialow'];
            }
            $my_content .= '</td></tr>';
            $my_content .= '<tr><td style="width:30%">Preferowany weekend</td><td colspan = "3">';
            $my_content .= $preferencja_dni_dziedzictwa['pref_weekend'];
            $my_content .= '</td></tr>';
            $my_content .= '<tr><td style="width:30%">Uwagi (osoby, które mieszkają w pobliżu któregoś obiektu na trasie pn-zach lub pd-wsch, mogą je wpisać jako preferowane miejsce odbycia wolontariatu)</td><td colspan = "3">';
            $my_content .= $preferencja_dni_dziedzictwa['uwagi'];
            $my_content .= '</td></tr>';
            $my_content .= '<tr style="background:lightgreen"><th colspan="4">DZIAŁANIA DODATKOWE</th></tr>';
            $my_content .= '<tr><td style="width:60%">Pakowanie materiałów promocyjnych</td><td colspan = "3">TAK/NIE*</td></tr>';
            $my_content .= '<tr><td style="width:60%">Dystrybucja materiałów promocyjnych</td><td colspan = "3">TAK/NIE</td></tr>';
            $my_content .= '<tr><td style="width:60%">Przygotowanie materiałów na punkty info</td><td colspan = "3">TAK/NIE</td></tr>';
            $my_content .= '<tr><td style="width:60%">Infolinia</td><td colspan = "3">TAK/NIE</td></tr>';
            $my_content .= '<tr><td style="width:60%">Ankiety</td><td colspan = "3">TAK/NIE</td></tr>';
            $my_content .= '<tr style="background:lightgreen"><th colspan="4">WYNIKI REKRUTACJI</th></tr>';
            $my_content .= '<tr><td style="width:30%">Data</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:30%">Obiekt</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:30%">Koordynator miejsca (MIK)</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:30%">Funkcja</td><td colspan = "3">Obsługa punktu informacyjnego</td></tr>';
            $my_content .= '<tr><td style="width:30%">Transport</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr style="background:lightgreen"><th colspan="4">DZIAŁANIA DODATKOWE</th></tr>';
            $my_content .= '<tr><td colspan = "2" style="width:40%"></td><td>DATA</td><td>GODZINY</td></tr>';
            $my_content .= '<tr><td colspan = "2" style="width:40%">Pakowanie materiałów promocyjnych</td><td style="width:40%">&nbsp;</td><td style="width:20%">&nbsp;</td></tr>';
            $my_content .= '<tr><td colspan = "2" style="width:40%">Dystrybucja materiałów promocyjnych</td><td style="width:40%">&nbsp;</td><td style="width:20%">&nbsp;</td></tr>';
            $my_content .= '<tr><td colspan = "2" style="width:40%">Infolinia</td><td style="width:40%">&nbsp;</td><td style="width:20%">&nbsp;</td></tr>';
            $my_content .= '<tr><td colspan = "2" style="width:40%">Przygotowanie materiałów na punkty info</td><td style="width:40%">&nbsp;</td><td style="width:20%">&nbsp;</td></tr>';
            $my_content .= '<tr><td colspan = "2" style="width:40%">Ankiety</td><td style="width:40%">&nbsp;</td><td style="width:20%">&nbsp;</td></tr>';
            $my_content .= '<tr><td colspan = "2" style="width:40%">UWAGI:</td><td style="width:40%">&nbsp;</td><td style="width:20%">&nbsp;</td></tr>';
            $my_content .= '<tr style="background:lightgreen"><th colspan="4">UDZIAŁ W SPOTKANIACH</th></tr>';
            $my_content .= '<tr><td style="width:40%">Spotkanie I, 31.03</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:40%">Spotkanie II, 13.04</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:40%">Spotkanie III, 27.04</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:40%">Szkolenie z Wikimedia</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:40%">Odprawa z koordynatorką trasy</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '<tr><td style="width:40%">Spotkanie ewaluacyjne, 15.06</td><td colspan = "3">&nbsp;</td></tr>';
            $my_content .= '</table>';
            $my_content .='<div style="margin-top:30px"><p>*Podreślić właściwe</p></div>';
            return $my_content;
        }
        //Pages can be filtered using post_name attribute f.e ["post_name"]=> string(15) "dni-dziedzictwa" 
        elseif ($current_post_type == 'page') {    
            $my_content = 'PAGE';
            return $my_content;
        }
        else{
            $my_content = 'TEST';
            return $my_content;
        }
    }
);
?>
