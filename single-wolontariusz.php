<script>
    /*
    window.onload = function(){
        var iloscGodzinForm = document.getElementById('ilosc_godzin_form');
        var praktykantRadioChecked = document.getElementById('praktykant').checked;
        if(praktykantRadioChecked){
            iloscGodzinForm.style.display = 'block';
        }
        console.log(praktykantRadioChecked);
        console.log(iloscGodzinForm);
    }
    */
    var allowInputEdit = function(event){
        console.log(event);
        var parentDiv = event.parentNode.parentNode;
        console.log(parentDiv);
        var inputElement = parentDiv.firstChild;
        var cancel = false;
        if(!inputElement.disabled){
            cancel = true;
        }
        toogleEditButton(event, inputElement, cancel)
    }
    var allowRadioEdit = function(event){
       var parentDiv = event.parentNode.parentNode;
       var radioSpan = parentDiv.getElementsByTagName('input');
       var cancel = false;
       for(var i=0; i<radioSpan.length; i++ ){
           if(!radioSpan[i].disabled){
               cancel = true;
           }
           toogleEditButton(event, radioSpan[i], cancel);
       }
    }
    var toogleEditButton = function (button, inputElement, cancel){
        button.innerHTML = '';
        var icon = document.createElement('i');
        icon.className = 'glyphicon ';
        if(cancel){
            inputElement.disabled = true;
            icon.className += 'glyphicon-pencil ';
            var textElement = document.createTextNode('Edytuj ');
            button.className = 'btn btn-warning'
            button.appendChild(textElement);
            button.appendChild(icon);
        }
        else if(!cancel){
            inputElement.disabled = false;
            icon.className += 'glyphicon-remove ';
            var textElement = document.createTextNode('Anuluj ');
            button.className = 'btn btn-danger'
            button.appendChild(textElement);
            button.appendChild(icon);
        }
    }
    
</script>
<?php //acf_form_head(); ?>
<?php get_header(); ?>
<?php
    $user = 0;
    $user_validated = false;
    $user_is_admin = false;
    if(is_user_logged_in()){
        $user_id = get_current_user_id();
        $user = get_user_by('id', $user_id);
        $wolontariusz_id = get_user_meta($user_id, 'wolontariusz_id', true);
        if($wolontariusz_id == get_the_ID() || current_user_can('delete_posts')){
            $user_validated = true;
        }
        else{
            //TODO SERVE PROPER 403 page
            http_response_code(403);
            //include_once("/pages/403.html");
            echo '<h1>403 FORBIDDEN</h1>';
            exit;
        }
        $user_is_admin  = (current_user_can('delete_posts')) ? true : false;
        }
    else{
        //echo "Please log in";
        //auth_redirect();
        //header("HTTP/1.1 302 Moved Temporary");
        //header("Location: http://localhost/wordpress/wp-login");
        exit();
        //TODO Add loging page redirect
    }
    if(isset($_POST['submit'])){
       try{
           update_wolontariusz_data($wolontariusz_id, $_POST);
       }
       catch(Exception $e){
           echo 'Unexpected error' , $e->getMessage();
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
            $data = get_fields();
                $user_meta = get_userdata($data['uzytkownik_id']);
                var_dump($data);
                var_dump($user_meta);
                echo $user_meta->user_email;
                $preferencja_dni_dziedzictwa = get_fields($data['preferencja']->ID);
                var_dump($preferencja_dni_dziedzictwa);
                $data_objects = get_field_objects($current_post_id);
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
                     <!-- Can be switch to a loop using get_field_objects() or not there is a problem with empty fields - I am unable to retrive the object if it's empty 
                    <form enctype="multipart/form-data" method="post" action="">
                        <div class="form-group">
                          <label for="Imie">Imie</label>
                          <input name="imie" type="text" class="form-control" id="Imie" value="<?php echo (isset($data['imie']) ? $data['imie'] : '');?>" placeholder="Imie">
                        </div>
                        <div class="form-group">
                          <label for="Nazwisko">Nazwisko</label>
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
                          <input name="uczelnia" type="text" class="form-control" id="uczelnia" value="<?php echo (isset($data['nazwa_uczelni']) ? $data['nazwa_uczelni'] : '');?>" placeholder="Uczelnia">
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
                     -->
                    
                     <form enctype="multipart/form-data" method="post" action="">
                     
                     <?php 
                     foreach ($data_objects as $key => $value){
                         //var_dump($key);
                         //var_dump($value);
                        if(empty($value['value'])){
                             $input_value = '""';
                         }
                        else{
                            $input_value = $value['value'];     
                        }
                        if($value['name'] == 'typ_uzytkownika'){
                            if($value['value'] == 'praktykant'){
                                $praktykant = true;
                            }
                            elseif($value['value'] == 'wolontariusz'){
                                $wolontariusz = true;
                            }
                            echo display_ACF_radio_group($value);
                        }
                        elseif ($value['name'] == 'preferencja') {
                            if($value['value'] == NULL){
                                echo "<hr><div class='form-group'><label style='color:red'>Preferencja nie wypełniona</label></div>";
                            }
                            else{
                                echo "<hr><div class='form-group'><label style='color:green'>Preferencja dni dziedzictwa</label></div>";
                                $preferencja_id = $value['value']->ID;
                                $preferencja_post_object = get_field_objects($preferencja_id);
                                foreach ($preferencja_post_object as $key1 => $value1){
                                    if(empty($value1['value'])){
                                        $input_value = '""';
                                    }
                                    else{
                                       $input_value = $value1['value'];     
                                    }
                                    if($value1['type'] == 'radio'){
                                        echo display_ACF_radio_group($value1);
                                    }
                                    else{
                                        echo display_ACF_input_group($value1, $input_value);
                                    }
                                }
                            }
                        }
                        else{
                            echo display_ACF_input_group($value, $input_value);
                        }     
                    }
                     ?>
                       <div>
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                        </div>  
                     </form>
                 </div>       
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>

