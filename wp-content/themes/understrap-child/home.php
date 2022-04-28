<?php
/**
* Template Name: Home
*
* @package understrap
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$carousel = get_field('carousel');

get_header();
?>

<main class="site-main" id="main">

	<div class="carousel">
		<?php echo do_shortcode($carousel); ?>
	</div>

	<div class="our-themes py-5">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<h2>Our Themes</h2>
				</div>
			</div>
			<div class="row mt-5">
				<?php
				if(have_rows('our-themes')) :
					while(have_rows('our-themes')) : the_row();
						$image = get_sub_field('image');
						$text = get_sub_field('text');
						?>
						<div class="col-lg-3 col-6 text-center">
							<img class="mb-4" src="<?=$image?>">
							<p><?=$text?></p>
						</div>
						<?php
					endwhile;
				endif;
				?>
			</div>
		</div>
	</div>

	<div class="latest py-5">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<h2>Latest</h2>
				</div>
			</div>
			<div class="row my-5">
				<?php
				$args = array(
					'posts_per_page' => 3,
					'post_type' => 'post',
				);
				$the_query = new WP_Query($args);
				if($the_query->have_posts()) :
					while($the_query->have_posts() ) : $the_query->the_post();
						$post_ID = get_the_ID();
						$post_title = get_the_title();
						$post_link = get_the_permalink();
						$post_abstract = get_field('abstract');
						$post_content_type = get_field('content_type');
						?>
						<div class="col-lg-4 col-12 d-flex align-items-stretch">
							<div class="article card">
								<div class="card-body">
									<a href="<?=$post_link?>"><h3 class="mb-3"><?=$post_title?></h3></a>
									<?=$post_abstract?>
									<div class="mb-2"></div>
									<span class="float-left">
										<?php
										$categories = get_the_category();
										if ( ! empty( $categories ) ) {
											echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
										}
										?>
									</span>
									<span class="float-right"><?=$post_content_type?></span>
								</div>
							</div>
						</div>
						<?php
					endwhile;
				endif;
				?>
			</div>
			<div class="row">
				<div class="col text-center">
					<a href="<?php echo home_url('/view-all')?>" class="btn btn-primary">View All</a>
				</div>
			</div>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
