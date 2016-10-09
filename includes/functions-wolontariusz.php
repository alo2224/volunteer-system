<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function get_wolontariusz_data($user_id){
    $user = get_user_by('id', $user_id);
    $wolontariusz_id = $user->wolontariusz_id;
    $data = array();
    $data['imie'] = get_user_meta($user_id,'imie',true);
    $data['nazwisko'] = get_user_meta($user_id,'nazwisko',true);
    $data['wolontariusz_id'] = $wolontariusz_id;
    return $data;
}
function get_wolontariusz_id($user_id){
    $user = get_user_by('id', $user_id);
    $wolontariusz_id = $user->wolontariusz_id;
    return $wolontariusz_id;
}
function update_wolontariusz_data($wolontariusz_id, $data){
    //Not doing a loop to aviod POST attack where POST with random stuff is being send
        $fields_ACF = array(
                        'imie' => 'field_57adb7f8d4faa',
                        'nazwisko' => 'field_57adb828d4fab',
                        'pesel' => 'field_57cedc82c56fc',
                        'numer_dowodu' => 'field_57cedccac56ff',
                        'adres' => 'field_57cedca8c56fd',
                        'kod_pocztowy' => 'field_57cedcbbc56fe',
                        'telefon' => 'field_57f9320f27f8e',
                        'numer_konta' => 'field_57cedcd9c5700',
                        'nazwa_uczelni' => 'field_57cedcdec5701',
                        'kierunek_studiow' => 'field_57cedce5c5702',
                        'rok_studiow' => 'field_57cedcf0c5703',
                        'typ_uzytkownika' => 'field_57adb830d4fac',
                        'uzytkownik_id' => 'field_57b304b1020f1',
                        'ilosc_godzin_wolontariatu' => 'field_57d8502222571'
        );
        try{
            if ( isset($data['imie']) && ! empty( $data['imie'] ) ) {
                sanitize_text_field($data['imie']);
                update_field( $fields_ACF['imie'], $data['imie'] , $wolontariusz_id);
            }	
            if ( isset($data['nazwisko']) && ! empty( $data['nazwisko'] ) ) {
                sanitize_text_field($data['nazwisko']);
                update_field( $fields_ACF['nazwisko'], $data['nazwisko'], $wolontariusz_id );
            }
            if ( isset($data['pesel']) && ! empty( $data['pesel'] ) ) {
                sanitize_text_field($data['pesel']);
                update_field( $fields_ACF['pesel'], $data['pesel'], $wolontariusz_id );
            }
            if ( isset($data['numer_dowodu']) && ! empty( $data['numer_dowodu'] ) ) {
                sanitize_text_field($data['numer_dowodu']);
                update_field( $fields_ACF['numer_dowodu'], $data['numer_dowodu'] , $wolontariusz_id);
            }
            if ( isset($data['adres']) && ! empty( $data['adres'] ) ) {
                sanitize_text_field($data['adres']);
                update_field( $fields_ACF['adres'], $data['adres'], $wolontariusz_id );
            }
            if ( isset($data['kod_pocztowy']) && ! empty( $data['kod_pocztowy'] ) ) {
                sanitize_text_field($data['kod_pocztowy']);
                update_field( $fields_ACF['kod_pocztowy'], $data['kod_pocztowy'] , $wolontariusz_id);
            }
            if ( isset($data['telefon']) && ! empty( $data['telefon'] ) ) {
                sanitize_text_field($data['telefon']);
                update_field( $fields_ACF['telefon'], $data['telefon'] , $wolontariusz_id);
            }
            if ( isset($data['numer_konta']) && ! empty( $data['numer_konta'] ) ) {
                sanitize_text_field($data['numer_konta']);
                update_field( $fields_ACF['numer_konta'], $data['numer_konta'] , $wolontariusz_id );
            }
            if ( isset($data['nazwa_uczelni']) && ! empty( $data['nazwa_uczelni'] ) ) {
                sanitize_text_field($data['nazwa_uczelni']);
                update_field( $fields_ACF['nazwa_uczelni'], $data['nazwa_uczelni']  ,$wolontariusz_id );
            }
            if ( isset($data['kierunek_studiow']) && ! empty( $data['kierunek_studiow'] ) ) {
                sanitize_text_field($data['kierunek_studiow']);
                update_field( $fields_ACF['kierunek_studiow'], $data['kierunek_studiow'] ,$wolontariusz_id );
            }
            if ( isset($data['rok_studiow']) && ! empty( $data['rok_studiow'] ) ) {
                sanitize_text_field($data['rok_studiow']);
                update_field( $fields_ACF['rok_studiow'], $data['rok_studiow'] ,$wolontariusz_id );
            }
            if ( isset($data['typ_uzytkownika']) && ! empty( $data['typ_uzytkownika'] ) ) {
                sanitize_text_field($data['typ_uzytkownika']);
                update_field( $fields_ACF['typ_uzytkownika'], $data['typ_uzytkownika'] ,$wolontariusz_id );
            }
            if ( isset($data['ilosc_godzin_wolontariatu']) && $data['typ_uzytkownika'] == 'praktykant' && ! empty( $data['ilosc_godzin_wolontariatu'] ) ) {
                sanitize_text_field($data['ilosc_godzin_wolontariatu']);
                update_field( $fields_ACF['ilosc_godzin_wolontariatu'], $data['ilosc_godzin_wolontariatu'] ,$wolontariusz_id );
            }
            return 0;
        }
        catch(Exception $e){
            return $e;
        }
}
function create_wolontariusz_post($user_id, $data){
    array_map('sanitize_text_field', $data);
	$tytul = $data['imie'] . ' ' . $data['nazwisko'];
        //Ratrrives a post with given title
	if(get_page_by_title( $tytul ) == null) {
		// Set the post ID so that we know the post was created successfully
                try{
                    $post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				'post_title'		=>	$tytul,
				'post_content' 		=> 	'Utworzono: '. date('d.m.y G:i:s') .'-'. time(),
				'post_status'		=>	'publish',
				'post_type'		=>      'wolontariusz'
			)
                    );
                    //update_post_meta( $post_id, 'imie', $imie );
                    //Unfortunatly the data update has to be done using the field keys here is a map of them
                    $fields_ACF = array(
                        'imie' => 'field_57adb7f8d4faa',
                        'nazwisko' => 'field_57adb828d4fab',
                        'pesel' => 'field_57cedc82c56fc',
                        'numer_dowodu' => 'field_57cedccac56ff',
                        'adres' => 'field_57cedca8c56fd',
                        'kod_pocztowy' => 'field_57cedcbbc56fe',
                        'telefon' => 'field_57f9320f27f8e',
                        'numer_konta' => 'field_57cedcd9c5700',
                        'nazwa_uczelni' => 'field_57cedcdec5701',
                        'kierunek_studiow' => 'field_57cedce5c5702',
                        'rok_studiow' => 'field_57cedcf0c5703',
                        'typ_uzytkownika' => 'field_57adb830d4fac',
                        'uzytkownik_id' => 'field_57b304b1020f1',
                        'ilosc_godzin_wolontariatu' => 'field_57d8502222571'
                    );
                    update_field( $fields_ACF['imie'], $data['imie'] , $post_id);
                    update_field( $fields_ACF['nazwisko'], $data['nazwisko'], $post_id );
                    update_field( $fields_ACF['pesel'], $data['pesel'], $post_id );
                    update_field( $fields_ACF['numer_dowodu'], $data['numer_dowodu'] , $post_id);
                    update_field( $fields_ACF['adres'], $data['adres'], $post_id );
                    update_field( $fields_ACF['kod_pocztowy'], $data['kod_pocztowy'] , $post_id);
                    update_field( $fields_ACF['telefon'], $data['telefon'] , $post_id);
                    update_field( $fields_ACF['numer_konta'], $data['numer_konta'] , $post_id );
                    update_field( $fields_ACF['nazwa_uczelni'], $data['nazwa_uczelni']  ,$post_id );
                    update_field( $fields_ACF['kierunek_studiow'], $data['kierunek_studiow'] ,$post_id );
                    update_field( $fields_ACF['rok_studiow'], $data['rok_studiow'] ,$post_id );
                    update_field( $fields_ACF['typ_uzytkownika'], $data['typ_uzytkownika'] ,$post_id );
                    update_field( $fields_ACF['ilosc_godzin_wolontariatu'], $data['ilosc_godzin_wolontariatu'] ,$post_id );
                    update_field( $fields_ACF['uzytkownik_id'], $user_id ,$post_id);
                    acf_form_head();
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
