<style>
#submit{margin-top:7px;}
</style>
<?php get_header();?>
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
        
        <?php
        $posts = get_posts(array(
	'posts_per_page'	=> -1,
	'post_type'		=> 'komunikat'
        ));
        if($posts): ?>
        <div id="content" class="col-md-11">
            <div class="row">
                <div class="col-md-4 col-md-offset-0">
                    <ul>

                    <?php foreach( $posts as $post ): 

                            setup_postdata( $post )

                            ?>
                            <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>

                    <?php endforeach; ?>

                    </ul>
                    <?php wp_reset_postdata(); ?>
                </div>
        <?php endif; 
        if($user_is_admin): 
                if(isset($_POST['submit'])){
                    $fields = array();
                    $fields = array_map('sanitize_text_field', $_POST);
                    var_dump($fields);
                    $post_data = array(
                        'post_title' => $fields['title'],
                        'post_content' => $fields['content'],
                        'post_type' => 'komunikat',
                        'post_status'   => 'publish',
                    );
                    $created_post_id = wp_insert_post($post_data);
                    var_dump($created_post_id);
                    //Add page reload - either in PHP or JS - the header stuff doesn't seem to work
                    //header("Refresh:0");
                }
            ?>
                <div class="col-md-4 col-md-offset-2">
                    <form enctype="multipart/form-data" method="post" action="">
                    <div class="row">
                        <div class="form-group input-group">
                          <label for="Title">Tytul</label>
                          <input name="title" type="text" class="form-control" id="kom_title" placeholder="Tytul komunikatu">
                        </div>
                    </div>
                    <label for="content">Tresc komunikatu</label>
                    <div class="row form-group">
                        <textarea rows="4" cols="45" name="content" id="kom_content">
                        </textarea>
                    </div>
                    <div class="row form-group">
                        <button type="submit" name="submit" id="submit" class="btn btn-default">Dodaj</button>
                    </div>
                    </form>
                </div>
        <?php endif;?>
        </div>
    </div>
<div class="row">
<?php get_footer(); ?>
</div>