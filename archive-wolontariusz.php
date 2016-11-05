<?php get_header(); ?>
<style>
    .table-container{
        width: 50%;
        margin: 0 auto;
    }
</style>
<div class="row">
    <div class="col-md-1">
    <?php get_sidebar(); ?>
    </div>
    <div class="col-md-11">
<?php 
$user_is_admin  = (current_user_can('delete_posts')) ? true : false;
do_action( 'bwsplgns_display_pdf_print_buttons', 'top' );
    if($user_is_admin):
        $posts = get_posts(array(
                'posts_per_page'	=> -1,
                'post_type'		=> 'wolontariusz'
        ));
        if( $posts ): ?>
            <div class="table-container">	
                    <table class="table table-hover">
                        <tr>
                            <th>Imie</th>
                            <th>Naziwsko</th>
                            <th>Strona wolontariusza</th>
                        </tr>
                        <?php 
                            foreach( $posts as $post ): 
                                setup_postdata( $post );
                                $current_user_id = get_field('uzytkownik_id', $post->id);
                                $data = get_fields($post->id);
                        ?>
                        <tr>
                            <td><?php echo $data['imie']?></td>
                            <td><?php echo $data['nazwisko']?></td>
                            <td style="width:20%"><a href = "<?php echo the_permalink();?>">Profil</a></td>
                        </tr>  
                        <?php endforeach; ?>
                    </table>
                 </div>
                <?php wp_reset_postdata(); ?>
        <?php endif; 
        else: ?>
        <!--TO DO ADD 403!-->
        <h3>Forbidden!</h3>
    <?php endif;?>
    </div>
</div>
<div class="row">
<?php get_footer(); ?>
</div>