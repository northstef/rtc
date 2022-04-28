<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
	<div class="featured-image">
		<img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>" width="100%">
	</div>
<?php endif; ?>

<main class="site-main" id="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article <?php post_class('container py-5'); ?> id="post-<?php the_ID(); ?>">

			<div class="entry-content">

				<?php the_content(); ?>

			</div><!-- .entry-content -->

		</article><!-- #post-## -->

	<?php endwhile; ?>

</main><!-- #main -->

<?php
get_footer();
