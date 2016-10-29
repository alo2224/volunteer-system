<style>
    .center{text-align: center}
</style>
<?php get_header();?>
<?php if(!is_user_logged_in()){
        echo "Please log in";
        auth_redirect();
       // header("HTTP/1.1 302 Moved Temporary");
      //  header("Location: http://localhost/wordpress/wp-login");
      //  exit();
        //TODO Add loging page redirect
}
else{
    $user_is_admin  = (current_user_can('delete_posts')) ? true : false;
}
?>
<div class="row">
    <div class="col-md-1">
    <?php get_sidebar(); ?>
    </div>
    <div class="col-md-11">
<?php 
if($user_is_admin): 
    $posts = get_posts(array(
            'posts_per_page'	=> -1,
            'post_type'		=> 'wolontariusz'
    ));
    if( $posts ): ?>

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

    <?php endif; 
else:
    echo "<div class='center'><h4>Witaj w systemie zarządzania wolontariuszami!</h4></div>";
endif;
?>
    </div>
</div>
<div class="row">
    <div id="delimiter">
    </div>
</div>
<div class="row">
<?php get_footer(); ?>
</div>