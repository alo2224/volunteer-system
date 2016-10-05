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
        //Data validation done with esc_attr 
        ?>
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
            <label for="adres"><?php _e( 'Adres', 'mydomain' ) ?><br />
            <input type="text" name="adres" id="adres" class="input" value="<?php echo esc_attr( wp_unslash( $adres ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="kod_pocztowy"><?php _e( 'Kod pocztowy', 'mydomain' ) ?><br />
            <input type="text" name="kod_pocztowy" id="kod_pocztowy" class="input" value="<?php echo esc_attr( wp_unslash( $kod_pocztowy ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="numer_dowodu"><?php _e( 'Numer dowodu', 'mydomain' ) ?><br />
            <input type="text" name="numer_dowodu" id="numer_dowodu" class="input" value="<?php echo esc_attr( wp_unslash( $numer_dowodu ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="numer_dowodu"><?php _e( 'Numer dowodu', 'mydomain' ) ?><br />
            <input type="text" name="numer_dowodu" id="numer_dowodu" class="input" value="<?php echo esc_attr( wp_unslash( $numer_dowodu ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="numer_dowodu"><?php _e( 'Numer dowodu', 'mydomain' ) ?><br />
            <input type="text" name="numer_dowodu" id="numer_dowodu" class="input" value="<?php echo esc_attr( wp_unslash( $numer_dowodu ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="numer_dowodu"><?php _e( 'Numer dowodu', 'mydomain' ) ?><br />
            <input type="text" name="numer_dowodu" id="numer_dowodu" class="input" value="<?php echo esc_attr( wp_unslash( $numer_dowodu ) ); ?>" size="25" /></label>
        </p>
        <?php
    }

    //2. Add empty string validation errors. 
    add_filter( 'registration_errors', 'wol_registration_errors', 10, 3 );
    function wol_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
        if ( empty( $_POST['imie'] ) || ! empty( $_POST['imie'] ) && trim( $_POST['imie'] ) == '' ) {
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać imie!.', 'mydomain' ) );
        }
		
	if ( empty( $_POST['nazwisko'] ) || ! empty( $_POST['nazwisko'] ) && trim( $_POST['nazwisko'] ) == '' ){
            $errors->add( 'imie_error', __( '<strong>Blad!</strong>: Musisz wpisać nazwisko!.', 'mydomain' ) );
        }

        return $errors;
    }
    //ADD SANITIZE TEXT FIELD
    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'wol_user_register' );
    function wol_user_register( $user_id ) {
        if ( ! empty( $_POST['imie'] ) ) {
            update_user_meta( $user_id, 'imie', trim( $_POST['imie'] ) );
        }
		
        if ( ! empty( $_POST['nazwisko'] ) ) {
            update_user_meta( $user_id, 'nazwisko', trim( $_POST['nazwisko'] ) );
        }
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
            <th><label>Plec</label></th>
            <td><input type="text" value="<?php echo get_user_meta( $user->ID, 'plec', true ); ?>" class="regular-text" readonly=readonly /></td>
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
//Creates new custom post after user successfuly registers 
function create_wolontariusz_post($user_id) {
	$user = get_user_by('id', $user_id);
	$post_id = -1;
	$author_id = 1;
	$imie = get_user_meta( $user_id, 'imie', true );
	$nazwisko = get_user_meta( $user_id, 'nazwisko', true );
	$tytul = $imie . ' ' . $nazwisko;
        //Ratrrives a post with given title
	if(get_page_by_title( $tytul ) == null) {
		// Set the post ID so that we know the post was created successfully
                try{
                    $post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				'post_author'		=>	$author_id,
				'post_title'		=>	$tytul,
				'post_content' 		=> 	'Utworzono: '. date('d.m.y G:i:s') .'-'. time(),
				'post_status'		=>	'publish',
				'post_type'		=>      'wolontariusz'
			)
                    );
                    add_post_meta( $post_id, 'imie', $imie );
                    add_post_meta( $post_id, 'nazwisko', $nazwisko );
                    add_post_meta( $post_id, 'uzytkownik_id', $user->id);
                } catch (Exception $ex) {
                    //TODO Add exception behavior - unable to create post
                    $post_id = -3;
                    error_log( "Exception while creating new user with ID " .  $user->id);
                }
	} else {
    		$post_id = -2;
	}
        //Wolontariusz_id is the id of post that was created when new user registered 
	add_user_meta( $user_id, 'wolontariusz_id', $post_id );
}
add_action( 'user_register', 'create_wolontariusz_post', 100 );
add_filter( 'registration_redirect', 'my_redirect_to_form' );
function my_redirect_to_form( $registration_redirect ) {
	return home_url('/formularz.php');
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