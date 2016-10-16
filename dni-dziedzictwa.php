<?php

/*

Template name: dni-dziedzictwa

*/

?>
<script>
    window.onload = function(){
        var radioButtonTak = document.getElementById('tak');
        var radioButtonNie = document.getElementById('nie');
        var daneInputForm = document.getElementById('liczba_udzialow_form');
        radioButtonTak.onclick = function(){
            daneInputForm.style.display = "block";
        };
        radioButtonNie.onclick = function(){
            daneInputForm.style.display = "none";
            var daneInputField = document.getElementById('liczba_udzialow');
            daneInputField.value='';
        }
    };
</script>
<?php get_header();?>
<?php 
if(!is_user_logged_in()){
        //echo "Please log in";
        header("HTTP/1.1 302 Moved Temporary");
        header("Location: http://localhost/wordpress/wp-login");
        exit();
        //TODO Add loging page redirect
}
var_dump(get_post(get_the_ID()));
$user_id = get_current_user_id();
if(isset($_POST['submit'])){
    $fields = array();
    $fields = array_map('sanitize_text_field', $_POST);
    var_dump($fields);
    $pref_id = create_preferencja_post($user_id, $fields);
    $wolontariusz_id = get_user_meta($user_id, 'wolontariusz_id', true);
    $preferencja_field = 'field_57fd46a4ff0d9';
    update_field($preferencja_field, $pref_id, $wolontariusz_id);
    echo $pref_id;
}
?>
<div id="main" class="site-main container-fluid">
    <div class="row">
        <div class="col-md-1">
            <?php get_sidebar(); ?>
        </div>
        <div id="content" class="site-content col-md-11">
                <div class="row">
                    <div class="col-md-offset-0 text-center">
                        <p>
                        W ramach zapisów na Dni Dziedzictwa prosimy o wypełnienie krótkiej ankiety preferencji, 
                        która pomoże nam przy doborze wolontariuszy.
                        </p>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-6 col-md-offset-0">
                        <form enctype="multipart/form-data" method="post" action="">
                            <div>
                                <p>
                                    Który weekend Dni Dziedzictwa preferujesz?
                                </p>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="pref_weekend" id="pierwszy" value="pierwszy" > Pierwszy
                                    </label> 
                                    <label class="radio-inline">
                                        <input type="radio" name="pref_weekend" id="drugi" value="drugi" > Drugi
                                    </label>
                                </div>
                            </div>
                            <div>
                                <p>
                                    Czy uczestniczyłeś już w Dniach Dziedzictwa jako wolontariusz?
                                </p>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="czy_uczestniczyl" id="tak" value="tak" > Tak
                                    </label> 
                                    <label class="radio-inline">
                                        <input type="radio" name="czy_uczestniczyl" id="nie" value="nie" > Nie
                                    </label>
                                </div>
                                <div hidden class="form-group" id="liczba_udzialow_form">
                                    <label>Ilosc udzialow</label>
                                    <input class="form-control" name="liczba_udzialow" id="liczba_udzialow" value="">
                                </div>
                            </div>
                            <div>
                                <div class="form-group" id="uwagi">
                                    <label>Dodatkowe uwagi (np. osoba do pary / preferowane miejsce wolontariatu)</label>
                                    <input class="form-control" name="uwagi" id="uwagi" value="">
                                </div>
                                    <p>
                                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
<div class="row">
<?php get_footer(); ?>
</div>





