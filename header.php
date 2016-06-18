<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ."/style.css" ?>" />

<?php wp_head(); ?>

</head>

<body>
<div>

    <?php
    $category =  get_the_category();

    $categories = get_all_categories();

    $menu_list = '';
    if( empty( $category ) ){
        $menu_list .= '<li class="active"> All </li>';
    }else{
        $menu_list .= '<li><a href="/"> All </a></li>';
    }

    foreach($categories as $index=>$cat){
        $title = $cat->name;
        $url = get_category_link( $cat->term_id ) ;

        if( !empty( $category )){
            if( $category[0]->term_id == $cat->term_id ){
                $menu_list .= '<li class="active"><a href="'.$url.'">'.$title.'</a></li>';
            }else{
                $menu_list .= '<li><a href="'.$url.'">'.$title.'</a></li>';
            }

        }else{
            $menu_list .= '<li><a href="'.$url.'">'.$title.'</a></li>';
        }
    }

    $context = array();
    $context['menu'] = $menu_list;
    $context['site_title'] = get_bloginfo();
    Timber::render('header.twig', $context);

    ?>

