<?php get_header();?>
<style>
#submit{margin-top:7px;}
.alert{padding:5px; margin-bottom: 5px;}
</style>
<?php if(!is_user_logged_in()){
        //echo "Please log in";
        auth_redirect();
        header("HTTP/1.1 302 Moved Temporary");
        header("Location: http://localhost/wordpress/wp-login");
        exit();
        //TODO Add loging page redirect
}
    else{
        $user_is_admin  = (current_user_can('delete_posts')) ? true : false;
    }
?>
<div id="main" class="site-main container-fluid">
    <div class="row">
        <div class="col-md-1">
            <?php get_sidebar(); ?>
        </div>
        <div id="content" class="col-md-11">
            <div class="row">
                <?php if($user_is_admin): 
                if(isset($_POST['submit'])){
                    $fields = array();
                    $error = '';
                    if(isset($_POST['title']) && !empty(trim($_POST['title']))){
                        $fields['title'] = sanitize_text_field($_POST['title']);
                    }
                    else{
                        $error .= "Podaj tytuł komunkatu! </br>";
                    }
                    if(isset($_POST['priority']) && !empty(trim($_POST['priority']))){
                        $fields['priority'] = sanitize_text_field($_POST['priority']);
                    }
                    else{
                       $error .= "Podaj priorytet komunkatu! </br>";
                    }
                    if(isset($_POST['content']) && !empty(trim($_POST['content']))){
                        $fields['content'] = sanitize_text_field($_POST['content']);
                    }
                    else{
                        $error .= "Podaj treść komunkatu! </br>";
                    }
                    if(empty($error)){
                        try{
                            $post_data = array(
                                'post_title' => $fields['title'],
                                'post_content' => $fields['content'],
                                'post_type' => 'komunikat',
                                'post_status'   => 'publish',
                            );
                            $created_post_id = wp_insert_post($post_data);
                            wp_set_object_terms($created_post_id, $fields['priority'], 'priorytet');
                            var_dump($created_post_id);
                        }
                        catch(Exception $e){
                            echo 'Unexpected error', $e->getMessage(), "\n";
                        }
                    }
                    else{
                        echo $error;
                    }
                }
                ?>
                <div class="col-md-3">
                    <form id="komunikat_form" enctype="multipart/form-data" method="post" action="">
                        <div class="form-group">
                          <label for="Title">Tytuł</label>
                          <input name="title" type="text" class="form-control" id="kom_title" placeholder="Tytul komunikatu">
                        </div>
                    <div class="form-group">
                            <label for="priority_select">Priorytet komunikatu</label>
                            <select id='priority_select' name="priority" form="komunikat_form" class="form-control">
                                <?php 
                                $terms = get_terms('priorytet');
                                foreach($terms as $term): 
                                    //var_dump($term);
                                    echo '<option value="' . $term->name . '">' . $term->name . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="kom_content">Treść komunikatu</label>
                        <textarea class="form-control" rows="4" name="content" id="kom_content"></textarea>
                        
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" id="submit" class="btn btn-default">Dodaj</button>
                    </div>
                    </form>
                </div>
                <?php endif;
                $posts = get_posts(array(
                'posts_per_page'	=> -1,
                'post_type'		=> 'komunikat'
                ));
                if($posts): ?>
                <div class="col-md-3 col-md-offset-1">
                    <ul>
                    <?php foreach( $posts as $post ): 
                            setup_postdata( $post );
                            if(has_term('wazne','priorytet')):?>
                            <div class="alert alert-danger" role="alert">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <?php elseif(has_term('normalny','priorytet')):?>
                            <div class="alert alert-warning" role="alert">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <?php elseif(has_term('informacyjny','priorytet')):?>
                            <div class="alert alert-info" role="alert">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <?php endif;?>
                    <?php endforeach; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                </div>
        <?php endif;?> 
        </div>
    </div>
<div class="row">
<?php get_footer(); ?>
</div>