<?php get_header();?>
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
                        <h4 class="text-center"><?php the_title();  ?></h4>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-12 col-md-offset-0">

                        <?php the_content();  
                            var_dump(the_terms(get_the_ID(),'priorytet'));
                            var_dump(has_term('wazne','priorytet'))
                        ?>

                        <?php endwhile; ?>
                        <?php else:  ?>

                        <h3>Sorry, nothing to show</h3>



                        <?php endif; ?>
                    </div>
                </div>
            </div>
    </div>
<div class="row">
<?php get_footer(); ?>
</div>