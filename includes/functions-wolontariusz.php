<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function update_wolontariusz_data($wolontariusz_id, $data){
    //Not doing a loop to aviod POST attack where POST with random stuff is being send
        $fields_ACF = array(
                        'imie' => 'field_57adb7f8d4faa',
                        'nazwisko' => 'field_57adb828d4fab',
                        'pesel' => 'field_57cedc82c56fc',
                        'numer_dowodu' => 'field_57cedccac56ff',
                        'adres' => 'field_57cedca8c56fd',
                        'kod_pocztowy' => 'field_58037619d17b0',
                        'telefon' => 'field_57f9320f27f8e',
                        'numer_konta' => 'field_57cedcd9c5700',
                        'nazwa_uczelni' => 'field_57cedcdec5701',
                        'kierunek_studiow' => 'field_57cedce5c5702',
                        'rok_studiow' => 'field_57cedcf0c5703',
                        'typ_uzytkownika' => 'field_57adb830d4fac',
                        'uzytkownik_id' => 'field_57b304b1020f1',
                        'ilosc_godzin_wolontariatu' => 'field_57d8502222571',
                        'skan_dowodu' => 'field_57dc03bbb6dba'
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
function upload_wolontariusz_file($wolontariusz_id, $files){
if(isset($files['skan_dowodu']) && !empty($files['skan_dowodu'])){
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    //var_dump($files['skan_dowodu']);
    //$movefile = wp_handle_upload( $files['skan_dowodu'], array('test_form' => false) );
    //var_dump($movefile);

    $attachment_id = media_handle_upload( 'skan_dowodu', $wolontariusz_id);
    $attachment_meta = array(
        'ID' => $attachment_id,
        'post_parent' => $wolontariusz_id
    );
    $result = wp_update_post($attachment_meta, true);
    update_field('skan_dowodu', $attachment_id, $wolontariusz_id);
    return $attachment_id;
}
else{
    return -1;
}

}
function create_wolontariusz_post($user_id, $data){
        array_map('sanitize_text_field', $data);
	$tytul = $data['imie'] . ' ' . $data['nazwisko'];
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
            //Unfortunatly the data update has to be done using the field keys here is a map of them
            $fields_ACF = array(
                'imie' => 'field_57adb7f8d4faa',
                'nazwisko' => 'field_57adb828d4fab',
                'pesel' => 'field_57cedc82c56fc',
                'numer_dowodu' => 'field_57cedccac56ff',
                'adres' => 'field_57cedca8c56fd',
                'kod_pocztowy' => 'field_58037619d17b0',
                'telefon' => 'field_57f9320f27f8e',
                'numer_konta' => 'field_57cedcd9c5700',
                'nazwa_uczelni' => 'field_57cedcdec5701',
                'kierunek_studiow' => 'field_57cedce5c5702',
                'rok_studiow' => 'field_57cedcf0c5703',
                'typ_uzytkownika' => 'field_57adb830d4fac',
                'uzytkownik_id' => 'field_57b304b1020f1',
                'ilosc_godzin_wolontariatu' => 'field_57d8502222571',
                'skan_dowodu' => 'field_57dc03bbb6dba',
                'preferencja' => 'field_57fd46a4ff0d9'
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
            update_field( $fields_ACF['skan_dowodu'], NULL, $post_id);
            update_field( $fields_ACF['preferencja'], NULL, $post_id);
        } catch (Exception $ex) {
            //TODO Add exception behavior - unable to create post
            $post_id = -3;
            error_log( "Exception while creating new user with ID " .  $user->id);
        }
        //Wolontariusz_id is the id of post that was created when new user registered 
	add_user_meta( $user_id, 'wolontariusz_id', $post_id );
        return $post_id;
}
function create_preferencja_post($user_id, $data){
$imie = get_user_meta($user_id,'imie',true);
$nazwisko = get_user_meta($user_id,'nazwisko',true);
$tytul = $imie . ' ' . $nazwisko;
// Set the post ID so that we know the post was created successfully
try{
    $post_id = wp_insert_post(
        array(
                'comment_status'	=>	'closed',
                'ping_status'		=>	'closed',
                'post_title'		=>	$tytul,
                'post_content' 		=> 	'Utworzono: '. date('d.m.y G:i:s') .'-'. time(),
                'post_status'		=>	'publish',
                'post_type'		=>      'preferencja'
        )
    );
    //Unfortunatly the data update has to be done using the field keys here is a map of them
    $fields_ACF = array(
        'pref_weekend' => 'field_57fd3c8f50062',
        'czy_uczestniczyl' => 'field_57fd3cbc50063',
        'liczba_udzialow' => 'field_57fd3cea50064',
        'uwagi' => 'field_57fd3da250065'
    );
    update_field( $fields_ACF['pref_weekend'], $data['pref_weekend'] , $post_id);
    update_field( $fields_ACF['czy_uczestniczyl'], $data['czy_uczestniczyl'], $post_id );
    update_field( $fields_ACF['liczba_udzialow'], $data['liczba_udzialow'], $post_id );
    update_field( $fields_ACF['uwagi'], $data['uwagi'] , $post_id);
} catch (Exception $ex) {
    //TODO Add exception behavior - unable to create post
    $post_id = -3;
    error_log( "Exception while creating new user with ID " .  $user->id);
}
return $post_id;
}
//Used in user data displaying - defines input template
function display_ACF_input_group($data, $input_data, $editable){
    $HTML_data = "<div class='form-group'><label for= '{$data['name']}'> {$data['label']} </label><div class='input-group'><input name={$data['name']} type= {$data['type']} class=form-control id= '{$data['name']}' value='{$input_data}' placeholder= '{$data['label']}' disabled>";
    if($editable){
        $HTML_data .= "<span class='input-group-btn'><button onclick='allowInputEdit(this)'class='btn btn-warning' type='button'>Edytuj <i class='glyphicon glyphicon-pencil'></i></button></span></div></div>";       
    }
    else{
        $HTML_data .= "</div></div>";
    }
    return $HTML_data;
}
//Used in user data displaying - defines input template
function display_ACF_radio_group($data, $editable){
    $HTML_data = "<div class='form-group'><label>{$data['label']}</label><div class='input-group'>";
    //var_dump($data);
    $radio_choices = $data['choices'];
    foreach($radio_choices as $value){
        $checked = false;
        if($value == $data['value']){
            $checked = true;
        }
        $HTML_data .= "<label class='radio-inline'><input disabled type='radio' name='{$data['name']}' id='{$data['name']}' value='{$value}' " .($checked == true ? "checked" : '') . ">{$value}</label>";
    }
    //Adds edit button that changes the enables the edit of input field
    if($editable){
        $HTML_data .= "<span class='input-group-btn'><button onclick='allowRadioEdit(this)'class='btn btn-warning' type='button'>Edytuj <i class='glyphicon glyphicon-pencil'></i></button></span></div>";
    }
    return $HTML_data;
}
//Used in user data displaying - defines file template
function display_ACF_file_attachment($data){   
    $HTML_data = "<div class='form-group'><label for= '{$data['name']}'> {$data['label']} </label>";
    if(empty($data['value'])){
        $HTML_data .= "<div class='input-group'>Brak pliku</div>";
        $HTML_data .= "<input name='{$data['name']}' type= '{$data['type']}' id= '{$data['name']}'{$data['label']}'>";
    }
    else{
        $HTML_data .= "<div class='input-group'><a href='{$data['value']['url']}'><img width='100%' height='300' src='{$data['value']['url']}' alt='{$data['value']['title']}'></a></div>";
    }  
    
    return $HTML_data;
}
//Adds attendee to an event by updating event post meta
function add_attendee_to_event($volunteer_id, $hours, $event_id ){
    $current_data = get_post_meta($event_id, 'uczestnicy', true);
    if(empty($current_data[$volunteer_id])){
        $current_data[$volunteer_id] = $hours;
        update_post_meta($event_id, 'uczestnicy', $current_data);
        $user_type = get_field('typ_uzytkownika', $volunteer_id);
        if($user_type == 'praktykant'){
            $number_of_hours = get_field('ilosc_godzin_wolontariatu', $volunteer_id);
            //ACF ID of ilosc_godzin_wolontariatu field = field_57d8502222571
            $hours_left = $number_of_hours - $hours;
            update_field('field_57d8502222571', $hours_left, $volunteer_id);
        }
    }
    else{
        return -1;
    }
    return 0;
}
//Function for creating event from front end - need additional development
/*
function create_event_post(){
$created_post_id = tribe_create_event(
        array(
                        'post_title'		=>	'TEST',
                        'post_content' 		=> 	'Utworzono: '. date('d.m.y G:i:s') .'-'. time(),
                        'post_status'		=>	'publish',
                        'EventStartDate'        =>      '2016-10-24 08:00:00',
                        'EventEndData'          =>      '2016-10-24 17:00:00',
                        'EventStartHour'        =>      '8',
                        'EventStartMinute'        =>    '60',
                        'EventStartMeridian'        =>  'am',
                        'EventEndHour'        =>      '17',
                        'EventEndMinute'        =>      '60',
                        'EventEndMeridian'        =>      'pm',
                        'EventShowMapLink'        =>      TRUE,
                )
        ); 
var_dump($created_post_id);
update_post_meta($created_post_id, '_EventStartDate', '2016-10-24 10:00:00' );
update_post_meta($created_post_id, '_EventStartDateUTC', '2016-10-24 08:00:00' );
update_post_meta($created_post_id, '_EventEndDate', '2016-10-24 19:00:00');  
update_post_meta($created_post_id, '_EventEndDateUTC', '2016-10-24 17:00:00'); 
update_post_meta($created_post_id, '_EventTimezone', 'UTC+1'); 
update_post_meta($created_post_id,
var_dump(get_post_meta($created_post_id));
*/
