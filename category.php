<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/27/2016
 * Time: 5:21 PM
 */
// set rendered posts = 20
get_header();
$category = get_the_category();
$cat_color = get_category_color( $category[0]->term_id ) ;
?>
<div id="content" class="site-content">
    <div class="main_posts">
        <h2 style="color:<?php echo $cat_color ; ?>"><?php echo $category[0]->name ; ?> Tutorials</h2>
        <div class="posts-section">
            <?php
            $begin_number_of_posts = 30 ;

            $posts = idevelop_get_posts($begin_number_of_posts ,0 , $category[0]->term_id);
            $context['posts'] = $posts;
            $context['loaded_posts'] = $begin_number_of_posts ;
            $context['link_ajax'] =  admin_url( 'admin-ajax.php' );
            $context['category'] =  $category[0]->term_id ;
            Timber::render('posts_section.twig', $context);

            ?>
        </div>
        <div class="loader">
            <img src="<?php echo get_template_directory_uri() ."/assets/img/loader.gif" ?>" " alt=""/>
        </div>
    </div>
<?php
get_footer(); ?>
