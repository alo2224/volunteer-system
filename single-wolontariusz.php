<script>
    window.onload = function(){
        var iloscGodzinForm = document.getElementById('ilosc_godzin_form');
        var praktykantRadioChecked = document.getElementById('praktykant').checked;
        if(praktykantRadioChecked){
            iloscGodzinForm.style.display = 'block';
        }
        console.log(praktykantRadioChecked);
        console.log(iloscGodzinForm);
    }
</script>
<?php get_header(); ?>
<?php
    $user = 0;
    $user_validated = false;
    $user_is_admin = false;
    if(is_user_logged_in()){
        $user_id = get_current_user_id();
      //  echo $user_id;
        $user = get_user_by('id', $user_id);
        $wolontariusz_id = get_user_meta($user_id, 'wolontariusz_id', true);
       // var_dump($user);
        //echo get_the_ID();
        //echo "\n";
        //echo $wolontariusz_id;
        if($wolontariusz_id == get_the_ID() || current_user_can('delete_posts')){
            $user_validated = true;
        }
        else{
            //TODO SERVE PROPER 403 page
            http_response_code(403);
            //include_once("/pages/403.html");
            echo '<h1>403 FORBIDDEN</h1>';
            exit;
         //   echo "h"
          //  $user_validated = false;
        }
        $user_is_admin  = (current_user_can('delete_posts')) ? true : false;
       // var_dump($user_is_admin);
       // var_dump($user_validated);
    }
    else{
        //echo "Please log in";
        auth_redirect();
        //header("HTTP/1.1 302 Moved Temporary");
       // header("Location: http://localhost/wordpress/wp-login");
       // exit();
        //TODO Add loging page redirect
    }
    if(isset($_POST['submit'])){
        $fields = array();
        $fields = array_map('sanitize_text_field', $_POST);
       // var_dump($fields);
       // var_dump(get_the_ID());
        foreach($fields as $key => $val){
            update_field($key,$val);
        }
    }
    do_action( 'bwsplgns_display_pdf_print_buttons', 'bottom' );
    ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <?php get_sidebar();?>
        </div>
        <div class="col-md-11">
            <div class="row text-center">
            <?php 
                $current_post_id = get_the_ID();
                $data = get_fields($current_post_id);
                $data_objects = get_field_objects($current_post_id);
            //    var_dump($data_objects);
            //    var_dump($data);
                $wolontariusz = false;
                $praktykant = false;
                if($data['typ_uzytkownika'] == 'wolontariusz'){
                    $wolontariusz = true;
                }
                elseif($data['typ_uzytkownika'] == 'praktykant'){
                    $praktykant = true;
                }
                if($user_is_admin){
                    $current_user_id  = get_field('uzytkownik_id');
                    echo '<h2>Dane wolontariusza ' . $data['imie'] . ' ' . $data['nazwisko'] . ' </h2>';                  
                }
                else{
                    echo '<h2>Twoje dane';                 
                }
            ?>
            </div>
            <div class="row">
                 <div class="col-md-offset-4 col-md-4">
                     <!-- Can be switch to a loop using get_field_objects() or not there is a problem with empty fields - I am unable to retrive the object if it's empty-->
                    <form enctype="multipart/form-data" method="post" action="">
                        <div class="form-group">
                          <label for="Imie">Imie</label>
                          <input name="imie" type="text" class="form-control" id="Imie" value="<?php echo (isset($data['imie']) ? $data['imie'] : '');?>" placeholder="Imie">
                        </div>
                        <div class="form-group">
                          <label for="Nazwisko">Password</label>
                          <input name="nazwisko" type="text" class="form-control" id="Nazwisko" value="<?php echo (isset($data['nazwisko']) ? $data['nazwisko'] : '');?>" placeholder="Nazwisko">
                        </div>
                        <div class="form-group">
                          <label for="Pesel">Pesel</label>
                          <input name="pesel" type="text" class="form-control" id="Pesel" value="<?php echo (isset($data['pesel']) ? $data['pesel'] : '');?>" placeholder="Pesel">
                        </div>
                        <div class="form-group">
                          <label for="Adres">Adres</label>
                          <input name="adres" type="text" class="form-control" id="Adres" value="<?php echo (isset($data['adres']) ? $data['adres'] : '');?>" placeholder="Adres">
                        </div>
                        <div class="form-group">
                          <label for="kod_pocztowy">Kod pocztowy</label>
                          <input name="kod_pocztowy" type="text" class="form-control" id="kod_pocztowy" value="<?php echo (isset($data['kod_pocztowy']) ? $data['kod_pocztowy'] : '');?>"placeholder="Kod pocztowy">
                        </div>
                        <div class="form-group">
                          <label for="numer_dowodu">Numer dowodu</label>
                          <input name="numer_dowodu" type="text" class="form-control" id="numer_dowodu" value="<?php echo (isset($data['numer_dowodu']) ? $data['numer_dowodu'] :  '');?>" placeholder="Numer dowodu">
                        </div>
                        <div class="form-group">
                          <label for="numer_konta">Numer konta</label>
                          <input name="numer_konta" type="text" class="form-control" id="numer_konta" value="<?php echo (isset($data['numer_konta']) ? $data['numer_konta'] : '');?>" placeholder="Numer konta">
                        </div>
                        <div class="form-group">
                          <label for="uczelnia">Uczelnia</label>
                          <input name="uczelnia" type="text" class="form-control" id="uczelnia" value="<?php echo (isset($data['uczelnia']) ? $data['uczelnia'] : '');?>" placeholder="Uczelnia">
                        </div>
                        <div class="form-group">
                          <label for="kierunek_studiow">Kierunek studiow</label>
                          <input name="kierunek_studiow" type="text" class="form-control" id="kierunek_studiow" value="<?php echo (isset($data['kierunek_studiow']) ? $data['kierunek_studiow'] : '');?>" placeholder="Kierunek studiow">
                        </div>
                        <div class="form-group">
                          <label for="rok_studiow">Rok studiow</label>
                          <input name="rok_studiow" type="text" class="form-control" id="rok_studiow" value="<?php echo (isset($data['rok_studiow']) ? $data['rok_studiow'] : '');?>" placeholder="Rok studiow">
                        </div>
                        <div>
                        <label class="radio-inline">
                            <input type="radio" name="typ_uzytkownika" id="wolontariusz" value="wolontariusz" <?php if($wolontariusz){ echo 'checked';}?>> Wolontariusz
                        </label> 
                        <label class="radio-inline">
                            <input type="radio" name="typ_uzytkownika" id="praktykant" value="praktykant" <?php if($praktykant){ echo 'checked';}?> > Praktykant
                        </label>
                        </div>
                        <div class="form-group" id="ilosc_godzin_form" hidden>
                            <label for="ilosc_godzin_wolontariatu">Ilosc godzin wolontariatu</label>
                            <input name="ilosc_godzin_wolontariatu" type="text" class="form-control" id="ilosc_godzin_wolontariatu" value="<?php echo (isset($data['ilosc_godzin_wolontariatu']) ? $data['ilosc_godzin_wolontariatu'] : '');?>" placeholder="Ilosc godzin wolontariatu">
                        </div>
                        <div>
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                     <!--
                     <form enctype="multipart/form-data" method="post" action="">
                     <?php 
                     foreach ($data_objects as $key => $value){
                         //var_dump($key);
                         //var_dump($value);
                         echo '<div class="form-group"><label for=' . $value["name"] . '>' . $value["label"] . '</label><input name=' . $value["name"] . ' type=. ' . $value["type"] . ' class="form-control" id=. ' . $value["label"] . ' value=' . $value["value"] . ' placeholder=. ' . $value["label"] . '></div>';
                     }
                     ?>
                    -->
                 </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>
