<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package idevelop
 */
get_header(); ?>

    <?php
        $id = get_the_ID();
        $post_categories = wp_get_post_categories( $id );
        $cat_color = get_category_color( $post_categories[0] ) ;
        $cat_name = get_cat_name( $post_categories[0] ) ;
        $cat_link = get_category_link( $post_categories[0] ) ;
        $post_date = get_the_date();
    ?>
    <div id="content" class="site-content no-padding">
        <div class="single_post_data">

            <div class="header-banner-section" style="background-color: <?php echo $cat_color ?>">
                <div class="arrow-back">
                    <a href="<?php echo $cat_link ; ?>">
                        <i class="fa fa-arrow-circle-left"></i>
                    </a>
                </div>
                <div class="post-title">
                    <h3><?php the_title(); ?></h3>
                </div>
            </div>

            <div class="likes-section" >
                <span class="hidden-xs" >Do You like this post </span>
                <i class="likes_button fa fa-thumbs-o-down" ></i>
                <i class="likes_button fa fa-thumbs-o-up" ></i>
                <div class="post-date" >
                    <i class="fa fa-calendar"></i>
                    <span><?php echo $post_date ; ?></span>
                </div>
            </div>

            <div class="post-content">
                <?php the_content(); ?>
            </div>


        </div>


<?php
get_footer();
