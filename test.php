<?php
/* Template Name: Test
 * 
 */

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<div>
    <?php 
    if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<h2><?php the_title();  ?></h2>
		
		<div class="post">
				<?php the_content();  ?>
		</div>
	
	<?php endwhile; ?>
	<?php else:  ?>
		
		<h3>Sorry, nothing to show</h3>

	
	
	<?php endif; ?>
	
?>
</div>