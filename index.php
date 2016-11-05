<style>
    .center{text-align: center}
</style>
<?php get_header();
$user_is_admin  = (current_user_can('delete_posts')) ? true : false;
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