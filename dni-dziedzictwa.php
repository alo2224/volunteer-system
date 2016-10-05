<?php

/*

Template name: dni-dziedzictwa

*/

?>
<script>
    window.onload = function(){
        var radioButtonTak = document.getElementById('para_tak');
        var radioButtonNie = document.getElementById('para_nie');
        var daneInputForm = document.getElementById('dane_pary_form');
        radioButtonTak.onclick = function(){
            daneInputForm.style.display = "block";
        };
        radioButtonNie.onclick = function(){
            daneInputForm.style.display = "none";
            var daneInputField = document.getElementById('dane_pary');
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
if(isset($_POST['submit'])){
    $fields = array();
    $fields = array_map('sanitize_text_field', $_POST);
    var_dump($fields);
   // var_dump(get_the_ID());
    /*
    foreach($fields as $key => $val){
        update_field($key,$val);
    }
     * 
     */
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
                                        <input type="radio" name="pref_weekend" id="pierwszy" value="pierwszy" <?php //if($wolontariusz){ echo 'checked';}?>> Pierwszy
                                    </label> 
                                    <label class="radio-inline">
                                        <input type="radio" name="pref_weekend" id="drugi" value="drugi" <?php //if($praktykant){ echo 'checked';}?> > Drugi
                                    </label>
                                </div>
                            </div>
                            <div>
                                <p>
                                    Czy uczestniczyłeś już w Dniach Dziedzictwa jako wolontariusz?
                                </p>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="czy_uczestniczyl" id="tak" value="tak" <?php //if($wolontariusz){ echo 'checked';}?>> Tak
                                    </label> 
                                    <label class="radio-inline">
                                        <input type="radio" name="czy_uczestniczyl" id="nie" value="nie" <?php //if($praktykant){ echo 'checked';}?> > Nie
                                    </label>
                                </div>
                            </div>
                            <div>
                                <p>
                                    Czy chcesz wskazać osobę z którą chciałbyś współpracować?
                                </p>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="para" id="para_tak" value="tak" <?php //if($wolontariusz){ echo 'checked';}?>> Tak
                                    </label> 
                                    <label class="radio-inline">
                                        <input type="radio" name="para" id="para_nie" value="nie" <?php //if($praktykant){ echo 'checked';}?> > Nie
                                    </label>
                                </div>
                                <div hidden class="form-group" id="dane_pary_form">
                                    <label>Podaj imię i nazwisko tej osoby</label>
                                    <input class="form-control" name="dane_pary" id="dane_pary" value="">
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





