<?php
/*
YARPP Template: Custom Template
Description: Custom Template displaying 3 columns with thumbnail images and titles.
Author: North Interactive
*/
?>

<div class="row">
	<div class="col text-center">
		<h3>Articles That May Interest You</h3>
	</div>
</div>
<div class="yarpp row mt-3">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) : the_post(); ?>
			<div class="col-lg-4 col">
				<div class="card">
					<div class="card-body">
						<a href="<?php the_permalink(); ?>" rel="bookmark norewrite" title="<?php the_title_attribute(); ?>" ><h4 class="mb-3"><?php echo get_the_title(); ?></h4></a><!-- (<?php the_score(); ?>)-->
						<?php echo get_field('abstract'); ?>
						<span>
							<?php
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
							}
							?>
						</span>
						<span class="float-right"><?php echo get_field('content_type'); ?></span>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<div class="col text-center">
			<p>No related posts.</p>
		</div>
	<?php endif; ?>
</div>