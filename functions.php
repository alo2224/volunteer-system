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
                    console.log(iloscGodzinForm);
                    iloscGodzinWolontariatuInput.value = '';
                }
                console.log(iloscGodzinForm);
                console.log(wolontariuszRadioButton);
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
        /*
        if ( empty( $_POST['imie'] ) || ! empty( $_POST['imie'] ) && trim( $_POST['imie'] ) == '' ) {
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać imie!.', 'mydomain' ) );
        }
	if ( empty( $_POST['nazwisko'] ) || ! empty( $_POST['nazwisko'] ) && trim( $_POST['nazwisko'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać nazwisko!.', 'mydomain' ) );
        }
        if ( empty( $_POST['pesel'] ) || ! empty( $_POST['pesel'] ) && trim( $_POST['pesel'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać pesel!.', 'mydomain' ) );
        }
        if ( empty( $_POST['numer_dowodu'] ) || ! empty( $_POST['numer_dowodu'] ) && trim( $_POST['numer_dowodu'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać numer dowodu!.', 'mydomain' ) );
        }
        if ( empty( $_POST['adres'] ) || ! empty( $_POST['adres'] ) && trim( $_POST['adres'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać adres!.', 'mydomain' ) );
        }
        if ( empty( $_POST['kod_pocztowy'] ) || ! empty( $_POST['kod_pocztowy'] ) && trim( $_POST['kod_pocztowy'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać kod pocztowy!.', 'mydomain' ) );
        }
        if ( empty( $_POST['telefon'] ) || ! empty( $_POST['telefon'] ) && trim( $_POST['telefon'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać telefon!.', 'mydomain' ) );
        }
        if ( empty( $_POST['numer_konta'] ) || ! empty( $_POST['numer_konta'] ) && trim( $_POST['numer_konta'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać numer konta!.', 'mydomain' ) );
        }
        if ( empty( $_POST['nazwa_uczelni'] ) || ! empty( $_POST['nazwa_uczelni'] ) && trim( $_POST['nazwa_uczelni'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać nazwe uczelni!.', 'mydomain' ) );
        }
        if ( empty( $_POST['kierunek_studiow'] ) || ! empty( $_POST['kierunek_studiow'] ) && trim( $_POST['kierunek_studiow'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać kierunek studiow!.', 'mydomain' ) );
        }
        if ( empty( $_POST['rok_studiow'] ) || ! empty( $_POST['rok_studiow'] ) && trim( $_POST['rok_studiow'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać rok studiow!.', 'mydomain' ) );
        }
        if ( empty( $_POST['typ_uzytkownika'] ) || ! empty( $_POST['typ_uzytkownika'] ) && trim( $_POST['typ_uzytkownika'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz podać typ uzytkownika!.', 'mydomain' ) );
        }
        if ( ($_POST['typ_uzytkownika'] == 'praktykant') && (empty( $_POST['ilosc_godzin_wolontariatu'] ) || ! empty( $_POST['ilosc_godzin_wolontariatu'] ) && trim( $_POST['ilosc_godzin_wolontariatu'] ) == '' )){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać ilosc godzin wolontariatu!.', 'mydomain' ) );
        }
         * 
         */
        return $errors;
    }
    //ADD SANITIZE TEXT FIELD
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
            <th><label>ID strony pracownika w systemie</label></th>
            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'wolontariusz_id', true ); ?>" class="regular-text" readonly=readonly /></td>
        </tr>
    </table>
    <?php
}

//Adds a new custom post to the Admin menu
function custom_post_type_wolontariusz() {

	$labels = array(
		'name'                => 'Wolontariusz',
		'singular_name'       => 'Wolontariusz',
		'menu_name'           => 'Wolontariusz',
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

add_filter('bwsplgns_get_pdf_print_content', 
    function( $content ) {
        $current_post_id = get_the_ID();
       
        $current_post_type = get_post_type($current_post_id);
        $my_content = '';
        if($current_post_type == 'wolontariusz'){
            $dane = get_fields($current_post_id);
            foreach($dane as $key => $value){
                $my_content .= $key;
                $my_content .= "<br />";
                $my_content .= $value;
                $my_content .= "<br />";
            }
            $my_content .= var_dump($dane);
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
