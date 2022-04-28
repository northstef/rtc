<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

$footer_page = get_page_by_path('footer');
$footer_page_id = $footer_page->ID;

$subscribe = get_field('subscribe', $footer_page_id);
?>

<!-- <div id="subscribe-section" class="py-5">
	<div class="container">
		<div class="row">
			<div class="col">
				<?=$subscribe?>
			</div>
		</div>
	</div>	
</div> -->

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="py-2">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info text-center">

						<span>&copy; Copyright <?php echo date('Y'); ?> Think City Sdn. Bhd.</span>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

