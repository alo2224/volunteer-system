<style>
    #tribe-events-pg-template{
        max-width:inherit;
    }
</style>
<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$event_id = get_the_ID();
$event_fields = get_fields();
$post_meta = get_post_meta($event_id);
do_action( 'tribe_events_before_template' );
?>
<div class="container-fluid">
<div class="row">
    <div class="col-md-1">
    <?php get_sidebar(); ?>
    </div>
    <div class="col-md-11">
        <?php
// Tribe Bar
tribe_get_template_part( 'modules/bar' );

// Main Events Content
tribe_get_template_part( 'month/content' );
?>
    </div>
</div>
<?php do_action( 'tribe_events_after_template' );?>