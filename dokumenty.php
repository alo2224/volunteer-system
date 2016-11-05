<?php get_header();?>
<div class="row">
    <div class="col-md-1">
    <?php get_sidebar(); ?>
    </div>
    <div class="col-md-11">
<?php 

/*

Template name: dokumenty

*/

$posts = get_posts(array(
	'posts_per_page'	=> -1,
	'post_type'		=> 'attachment'
));
if( $posts ): ?>	
	<ul>		
	<?php foreach( $posts as $post ): 
                //Documents that were created via media library and are not assigned to any post 
                if($post->post_parent == 0):
		$id = get_the_ID();
		?>
		<li>
			<a href="<?php echo wp_get_attachment_url($id); ?>"><?php the_title(); ?></a>
		</li>
	
	<?php endif;
        endforeach; ?>	
	</ul>	
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
    </div>
</div>
<div class="row">
    <div id="delimiter">
    </div>
</div>
<div class="row">
<?php get_footer(); ?>
</div>