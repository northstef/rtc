<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$cta = '';
$video = '';

get_header();
?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
    <div class="featured-image">
        <img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>" width="100%">
    </div>
<?php endif; ?>

<main class="site-main single-body py-5" id="main">

    <?php while ( have_posts() ) : the_post(); ?>
        <article <?php post_class('container-fluid'); ?> id="post-<?php the_ID(); ?>">

            <div class="row">
                <div class="col-lg-8 col-md-6 col">

                    <header class="entry-header p-5">

                        <h6 class="entry-category">
                            <?php
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                                echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                            }
                            ?>
                        </h6>

                        <?php the_title( '<h1 class="entry-title my-3">', '</h1>' ); ?>

                        <div class="entry-meta">

                            <?php 
                            $authors = get_field('authors'); 
                            $organizations = get_field('organizations'); 
                            $content_type = get_field('content_type');
                            if($content_type == 'PDF' || $content_type == 'Link') {
                                $cta = get_field('cta-buttons');
                            }
                            $date = get_the_date();

                            if($authors){
                                echo '<h6>Authors: '.$authors.'</h6>';
                            }
                            if($organizations) {
                                echo '<h6>Organisations: '.$organizations.'</h6>';
                            }
                            echo '<h6>Date Published: '.$date.'</h6>';
                            echo '<h6>Content Format: '.$content_type.'</h6>';

                            if(have_rows('cta_buttons')) :
                                echo '<div class="pt-3">';
                                while(have_rows('cta_buttons')) : the_row();
                                    $text = get_sub_field('text');
                                    $link = get_sub_field('link');
                                    echo do_shortcode('[cta-btn title="'.$text.'" url="'.$link['url'].'" newtab="yes"]');
                                endwhile;
                                echo '</div>';
                            endif;
                            ?>

                        </div><!-- .entry-meta -->

                    </header><!-- .entry-header -->

                </div>
            </div>

            <div class="entry-content container mt-5">

                <?php
                if(have_rows('content')) :
                    ?>
                    <?php
                        //toc
                    $section_title_array = array();
                    $num = 0;
                    while(have_rows('content')) : the_row();
                        $section_title = get_sub_field('section_title');
                        if($section_title) :
                            $section_id = str_replace(' ', '_', $section_title);
                            $section_title_array[$num]['id'] = $section_id;
                            $section_title_array[$num]['title'] = $section_title;
                            $num++;
                        endif;
                    endwhile;

                        //flexible content
                    while(have_rows('content')) : the_row();
                        if(get_row_layout() == 'toc') :
                            $toc_confirm = get_sub_field('toc_confirm');
                            if($toc_confirm) :
                                echo '<div class="row p-3">';
                                echo '<div class="col-12">';
                                echo '<div class="toc-container">';
                                echo '<h5>Table of Contents</h5>';
                                echo '<ol class="">';
                                foreach($section_title_array as $each) {
                                    echo '<a href="#'.$each['id'].'"><li>'.$each['title'].'</li></a>';
                                }
                                echo '</ol>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            endif;
                        elseif(get_row_layout() == 'text_only') :
                            $section_title = get_sub_field('section_title');
                            $text = get_sub_field('text');
                            if($section_title) :
                                $section_id = str_replace(' ', '_', $section_title);
                                echo '<div class="row p-3">';
                                echo '<div class="col-12 mt-3" id="'.$section_id.'">';
                                echo '<h2>'.$section_title.'</h2>';
                            else:
                                echo '<div class="row p-3">';
                                echo '<div class="col-12">';
                            endif;
                            echo $text;
                            echo '</div>';
                            echo '</div>';
                        elseif(get_row_layout() == 'lirt') :
                            $section_title = get_sub_field('section_title');
                            $image = get_sub_field('image');
                            $text = get_sub_field('text');
                            echo '<div class="row p-3">';
                            echo '<div class="col-lg-6 col-12">';
                            echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
                            echo '<div class="wp-caption">'.$image['caption'].'</div>';
                            echo '</div>';
                            if($section_title) :
                                $section_id = str_replace(' ', '_', $section_title);
                                echo '<div class="col-lg-6 col-12 mt-3" id="'.$section_id.'">';
                                echo '<h2>'.$section_title.'</h2>';
                            else:
                                echo '<div class="col-lg-6 col-12">';
                            endif;
                            echo $text;
                            echo '</div>';
                            echo '</div>';
                        elseif(get_row_layout() == 'ltri') :
                            $section_title = get_sub_field('section_title');
                            $text = get_sub_field('text');
                            $image = get_sub_field('image');
                            if($section_title) :
                                $section_id = str_replace(' ', '_', $section_title);
                                echo '<div class="row p-3">';
                                echo '<div class="col-lg-6 col-12 mt-3" id="'.$section_id.'">';
                                echo '<h2>'.$section_title.'</h2>';
                            else:
                                echo '<div class="row p-3">';
                                echo '<div class="col-lg-6 col-12">';
                            endif;
                            echo $text;
                            echo '</div>';
                            echo '<div class="col-lg-6 col-12">';
                            echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
                            echo '<div class="wp-caption">'.$image['caption'].'</div>';
                            echo '</div>';
                            echo '</div>';
                        elseif(get_row_layout() == 'video') :
                            $section_title = get_sub_field('section_title');
                            $video = get_sub_field('video');
                            if($section_title) :
                                $section_id = str_replace(' ', '_', $section_title);
                                echo '<div class="row p-3">';
                                echo '<div class="col-12 mt-3" id="'.$section_id.'">';
                                echo '<h2>'.$section_title.'</h2>';
                            else:
                                echo '<div class="row p-3">';
                                echo '<div class="col-12">';
                            endif;
                            echo '<div class="embed-container">';
                            echo $video;
                            echo '</div>';
                            echo '</div>';
                        endif;
                    endwhile;
                endif;
                ?>

                <div class="row">

                    <div class="col text-center">
                        <?php 

                        if(have_rows('cta_buttons')) :
                            echo '<div class="pt-3">';
                            while(have_rows('cta_buttons')) : the_row();
                                $text = get_sub_field('text');
                                $link = get_sub_field('link');
                                echo do_shortcode('[cta-btn title="'.$text.'" url="'.$link['url'].'" newtab="yes"]');
                            endwhile;
                            echo '</div>';
                        endif;
                        ?>
                    </div>

                </div>

            </div><!-- .entry-content -->
        </div>

        <footer class="container entry-footer py-3">

            <?php yarpp_related(); ?>

        </footer><!-- .entry-footer -->

    </article><!-- #post-## -->
<?php endwhile; ?>

</main><!-- #main -->

<?php
get_footer();
