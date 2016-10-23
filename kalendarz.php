<?php
/*

Template name: kalendarz

*/
?>
<?php get_header();?>
<?php if(!is_user_logged_in()){
        //echo "Please log in";
        header("HTTP/1.1 302 Moved Temporary");
        header("Location: http://localhost/wordpress/wp-login");
        exit();
        //TODO Add loging page redirect
}
?>
<div id="main" class="site-main container-fluid">
    <div class="row">
        <div class="col-md-1">
            <?php get_sidebar(); ?>
        </div>
        <div id="content" class="site-content col-md-11">
            <?php 
            if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="row">
                    <div class="col-md-offset-0">
                        <h2 class="text-center"><?php the_title();  ?></h2>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-6 col-md-offset-3">

                        <?php the_content(); ?>
                         
                        <?php endwhile; ?>
                        <?php else:  ?>

                        <h3>Sorry, nothing to show</h3>



                        <?php endif; ?>
                        <!--<iframe src="https://calendar.google.com/calendar/embed?src=oqo3b1ea4d6goqlk9uig69ab08%40group.calendar.google.com&ctz=Europe/Warsaw" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                    -->
                    </div>
                </div>
            </div>
    </div>
<div class="row">
<?php get_footer(); ?>
</div>



