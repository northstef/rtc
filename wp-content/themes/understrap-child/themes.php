<?php
/**
* Template Name: Themes
*
* @package understrap
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$cover = get_field('cover');
$page_category = get_field('page_category');
if($page_category === 'equity-diversity-inclusion') {
	$featured = get_field('featured_equity_diversity_inclusion');
} else if($page_category === 'health-nutrition-wellbeing') {
	$featured = get_field('featured_health_nutrition_wellbeing');
} else if($page_category === 'housing-sustainable-development') {
	$featured = get_field('featured_housing_sustainable_development');
} else if($page_category === 'life-in-public-housing') {
	$featured = get_field('featured_life_in_public_housing');
}

$featured_id = '';
$content = get_field('content');
$contenttypesearch = array();

if(isset($_GET['submit'])) {
	$filter_title = '';
	if(isset($_GET['search']) && $_GET['search'] !== '') {
		$keywordsearch = $_GET['search'];
		$haskeyword = true;
		// $filter_title .= 'Keywords: '.$keywordsearch.'<br>';
	}

	if(isset($_GET['contenttype'])) {
		$contenttypesearch = $_GET['contenttype'];
		$hascontenttype = true;
		// $filter_title .= 'Content Type: ';
	}

	if($haskeyword) {
		echo '1';
		$args = array(
			'category_name' => $page_category,
			'order' => 'ASC',
			'orderby' => 'title',
			'paged' => $paged,
			's' => $search,
			'meta_query' => array(
				array(
					'key' => 'content_type',
					'value' => $contenttypesearch,
					'compare' => 'IN',
				),
			)
		);
	} else {
		$args = array(
			'category_name' => $page_category,
			'order' => 'ASC',
			'orderby' => 'title',
			'paged' => $paged,
			'meta_query' => array(
				array(
					'key' => 'content_type',
					'value' => $contenttypesearch,
					'compare' => 'IN',
				),
			)
		);
	}
} else {
	$args = array(
		'post_type' => 'post',
		'category_name' => $page_category,
		'paged' => $paged,
	);
}

$clear_url = strtok($_SERVER["REQUEST_URI"], '?');

get_header(); ?>

<div class="theme-header container-fluid d-flex flex-column justify-content-center" style="background:url(<?=$cover?>);background-position: center center; background-size: cover;">
	<div class="row">
		<?php if($featured) : ?>
			<div class="featured col-lg-4 p-5">
				<?php
				$featured_id = $featured->ID;
				$featured_title = $featured->post_title;
				$featured_permalink = get_permalink($featured_id);
				$featured_excerpt = get_the_excerpt($featured_id);
				$featured_category = get_the_category($featured_id);
				$featured_content_type = get_field('content_type', $featured_id);
				$featured_abstract = get_field('abstract', $featured_id);
				$featured_authors = get_field('authors', $featured_id);
				$featured_organizations = get_field('organizations', $featured_id);
				?>
				<p>Featured</p>
				<a href="<?=$featured_permalink?>"><h2><?=$featured_title?></h2></a>
				<?=$featured_abstract?>
				<div class="mb-2"></div>
				<?php 
				if($featured_authors) echo '<span>'.$featured_authors.'</span><br>';
				if($featured_organizations) echo '<span>'.$featured_organizations.'</span>';
				?>
				<span class="float-right"><?=$featured_content_type?></span>
			</div>
		<?php endif; ?>
	</div>
</div>

<div class="theme-body">
	<div class="container">
		<div class="row">
			<div class="offset-lg-1 col-lg-10 col py-5">
				<?=$content?>
			</div>
		</div>
	</div>
</div>

<div class="theme-articles">
	<div class="container py-5">
		<div class="row">
			<div class="col-lg-8 col order-xs-2 list-group list-group-flush">
				<?php
				$the_query = new WP_Query($args);
				if($the_query->have_posts()) :
					while($the_query->have_posts() ) : $the_query->the_post();
						$post_ID = get_the_ID();
						$post_title = get_the_title();
						$post_link = get_the_permalink();
						$post_abstract = get_field('abstract');
						$post_authors = get_field('authors');
						$post_organizations = get_field('organizations');
						$post_content_type = get_field('content_type');
						?>
						<div class="article list-group-item py-3">
							<a href="<?=$post_link?>"><h3 class="mb-3"><?=$post_title?></h3></a>
							<?=$post_abstract?>
							<div class="mb-2"></div>
							<?php 
							if($post_authors) echo '<span>'.$post_authors.'</span><br>';
							if($post_organizations) echo '<span>'.$post_organizations.'</span>';
							?>
							<span class="float-right"><?=$post_content_type?></span>
						</div>
						<?php
					endwhile;

					$pages = paginate_links( array(
						'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'format'       => '?paged=%#%',
						'total'        => $the_query->max_num_pages,
						'current'      => max( 1, get_query_var( 'paged' ) ),
						'type'         => 'array',
						'prev_text'    => sprintf( '<i></i> %1$s', __( '<', 'text-domain' ) ),
						'next_text'    => sprintf( '%1$s <i></i>', __( '>', 'text-domain' ) ),
					) );
					if( !empty( $pages ) ) :
						$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
						echo '<div class="pagination-wrap mt-3 d-flex justify-content-center"><ul class="pagination">';
						foreach ( $pages as $key => $page_link ) : 
							echo '<li class="page-item';
							if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; }
							echo '">';
							echo str_replace( 'page-numbers', 'page-link', $page_link );
							echo '</li>';
						endforeach;
						echo '</ul></div>';
					endif;

				else :
					echo '<h3>No articles found. Try a different search.</h3>';
				endif;
				?>
			</div>
			<div class="col-lg-4 col order-xs-1">				
				<form method="get" id="searchform" action="<?php $_PHP_SELF ?>" role="search">
					<label class="sr-only" for="search"><?php esc_html_e( 'Search', 'understrap' ); ?></label>
					<div class="input-group searchgroup d-flex flex-row align-items-center">
						<input class="field form-control searchbox" id="search" name="search" type="text" placeholder="<?php esc_attr_e( 'Search here', 'understrap' ); ?>" value="<?=$search?>">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search-black.png" alt="search icon" class="searchicon">
					</div>
					<div class="filter-box mt-3">
						<h4 class="mb-3">Filter Options</h4>
						<h5>Content Format</h5>
						<div class="input-group">
							<div class="input-group-text flex-column align-items-start">
								<label for="content1"><input type="checkbox" class="mr-2" aria-label="HTML" name="contenttype[]" id="content1" value="html" <?php if(in_array('html',$contenttypesearch)) echo 'checked'; ?>>HTML</label>
								<label for="content2"><input type="checkbox" class="mr-2" aria-label="PDF" name="contenttype[]" id="content2" value="pdf" <?php if(in_array('pdf',$contenttypesearch)) echo 'checked'; ?>>PDF</label>
								<label for="content3"><input type="checkbox" class="mr-2" aria-label="Video" name="contenttype[]" id="content3" value="video" <?php if(in_array('video',$contenttypesearch)) echo 'checked'; ?>>Video</label>
								<label for="content4"><input type="checkbox" class="mr-2" aria-label="Link" name="contenttype[]" id="content4" value="link" <?php if(in_array('link',$contenttypesearch)) echo 'checked'; ?>>Link</label>
							</div>
						</div>
						<span class="input-group-append mt-3">
							<input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit" value="<?php esc_attr_e( 'Submit', 'understrap' ); ?>">
							<a href="<?=$clear_url?>" class="btn btn-secondary clear-filter">Clear</a>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>