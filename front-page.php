<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/27/2016
 * Time: 5:21 PM
 */
// set rendered posts = 20
get_header();
?>
<div id="content" class="site-content">
    <div class="main_posts">
        <h2 class="hidden-xs">Welcome To Developers Zone Here we have tutorials<br/> that will teach you  <span id="changing-text" data-typist="Javascript,Design,Jquery,SEO,Laravel,Javascript">Wordpress</span> </h2>
        <h2 class="hidden-sm hidden-md hidden-lg"><span class="header-logo">Developers Zone</span><br/> Learn <span id="changing-text-mobile" data-typist="Javascript,Design,Jquery,SEO,Laravel,Javascript">Wordpress</span> </h2>
        <div class="posts-section" >
            <?php
                $begin_number_of_posts = 30 ;
                $posts = idevelop_get_posts($begin_number_of_posts ,0 , 'all');
                $context['posts'] = $posts;
                $context['loaded_posts'] = $begin_number_of_posts ;
                $context['link_ajax'] =  admin_url( 'admin-ajax.php' );
                $context['category'] =  'all' ;
                Timber::render('posts_section.twig', $context);
            ?>
        </div>
        <div class="loader">
            <img src="<?php echo get_template_directory_uri() ."/assets/img/loader.gif" ?>" " alt=""/>
        </div>
    </div>
<?php
get_footer(); ?>
