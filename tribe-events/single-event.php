<style>
    #tribe-events-pg-template{
        max-width:inherit;
    }
    .form-control{
        display: inline;
        width: inherit;
    }
</style>
<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();
$event_fields = get_fields();
$post_meta = get_post_meta($event_id);
$wolontariusz_id = get_user_meta(get_current_user_id(), 'wolontariusz_id', true);
if(isset($_POST['submit'])){
       try{
           $ilosc_godzin = $_POST['ilosc_godzin'];
           $result = add_attendee_to_event( $wolontariusz_id, $ilosc_godzin, $event_id);
       }
       catch(Exception $e){
           echo 'Unexpected error' , $e->getMessage();
       }
    }
$bool_wolontariusz_zapisany = false;
$uczestnicy = (get_post_meta($event_id, 'uczestnicy', true));
if(!empty($uczestnicy)){
    foreach($uczestnicy as $key => $value){
        if($key == $wolontariusz_id){
           // echo "Jesteś juz zapisany na to wydarzenie!";
            $bool_wolontariusz_zapisany = true;
        }
    }
}
?>
<div class="container-fluid">
<div class="row">
    <div class="col-md-1">
    <?php get_sidebar(); ?>
    </div>
    <div class="col-md-11">
        <div id="tribe-events-content" class="tribe-events-single">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' );?>

	<div class="tribe-events-schedule tribe-clearfix">
		<?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
		<?php endif; ?>
	</div>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content();?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
               
	<?php endwhile; ?>
                <?php if(!$bool_wolontariusz_zapisany):?>
                <p> Jeśli chcesz zapisać się na wydarzenie, podaj ilość godzin i kliknij Zapisz Się!</p>
                <form enctype="multipart/form-data" method="post" action="">
                     <div class="form-group">
                                    <label>Ilość godzin</label>
                                    <input class="form-control" name="ilosc_godzin" id="ilosc_godzin" value="">
                                    <button type="submit" name="submit" class="btn btn-default">Zapisz się!</button>
                    </div>
                </form>
                <?php else:?>
                <h5><b>Jesteś już zapisany na to wydarzenie! </b></p>
               <?php endif;?>
	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
    </div><!-- col-md-11-->
</div> <!-- row-->
</div><!-- container-->