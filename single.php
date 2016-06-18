<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ."/style.css" ?>" />

    <?php wp_head(); ?>

</head>

<body>

<?php
    $site_name = "Arab Developers Community";
    $category =  get_the_category();
    $post_title = get_the_title();
    $post_content = get_the_content();

    $categories = get_all_categories();

    $list = "";
    foreach($categories as $index=>$cat) {
        $title = $cat->name;
        $url = get_category_link($cat->term_id);

        $cat_color = get_category_color( $cat->term_id ) ;

        $list .= sprintf('<li class="nav-li"><a href="%s" style="color:%s;border-top:2px solid %s ;border-bottom:2px solid %s  ">%s</a></li>',$url ,$cat_color,$cat_color,$cat_color, $title);
    }

    $id = get_the_ID();
    $post_categories = wp_get_post_categories( $id );
    $cat_color = get_category_color( $post_categories[0] ) ;
    $cat_name = get_cat_name( $post_categories[0] ) ;
    $cat_link = get_category_link( $post_categories[0] ) ;
    $post_date = get_the_date();

    // post thumbnail
    $thumb = has_post_thumbnail ( $id );
    if($thumb){
        $image = get_post_thumbnail_id();
        $image = wp_get_attachment_image_src( $image, 'full' ) ;
    }

?>

<div class="single_post_page">
    <!--  section one the nav menu   -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand single-title" href="#">Arab Developers Community</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <?php echo $list ; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <!--  section two the like and breadcrumb   -->
    <div class="container-fluid nav-like-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="#" style="color:grey">Home</a></li>
                        <?php printf('<li><a href="%s">%s</a></li>',$cat_link  ,$cat_name); ?>
                        <li class="active" style="color: <?php echo $cat_color; ?>">Data</li>
                    </ol>
                </div>
                <div class="col-xs-6">
                    <p class="pull-right">
                        <span class="hidden-xs">Do you like this post</span>
                        <button class="btn btn-success">
                            <i class="fa fa-thumbs-o-up"></i>
                            <span class="btn-like-dislike">like</span>
                        </button>
                        <button class="btn btn-danger">
                            <i class="fa fa-thumbs-o-down">
                                <span class="btn-like-dislike">dislike</span>
                            </i>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!--  section two the container   -->
    <div class="container-fluid wrapper-single-page">
        <div class="container">
            <div class="row post-title-section">
                <div class="col-ms-12 text-center">
                    <h1><?php echo $post_title ; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="post-content-single">
                    <?php
                    if($thumb){
                        printf('<img src="%s" class="image-thumbnail-single">',$image[0]);
                    }
                    ?>
                    <?php echo $post_content ; ?>
                </div>
                <div class="col-sm-4 sidebar">

                </div>
            </div>

        </div>
    </div>

</div>
<?php
get_footer();
