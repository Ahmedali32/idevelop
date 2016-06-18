<?php

/**
 * get number of posts in category with their color
 * @param $number
 * @param $start_from
 * @param $category
 * @return array
 */
function idevelop_get_posts( $number ,$start_from , $category){
    global $wpdb;

    $args = array(
                    'posts_per_page' => $number ,
                    'offset'           => $start_from
    );
    if($category != "all"){
        $args['category'] = array($category);
    }
    $posts = idevelop_get_post_color( get_posts( $args ) );

    return $posts ;
}


/**
 * get me the color of this posts before returning them
 * @param $posts
 * @return mixed
 */
function idevelop_get_post_color($posts){
    // this number will be increase untill it reach 3 then make it 1 again and assign to the post a margin none
    $num = 1 ;
    foreach($posts as $index=>$post ){
        $post_categories = wp_get_post_categories( $post->ID );
        $cat_color = get_category_color( $post_categories[0] ) ;
        $cat_name = get_cat_name( $post_categories[0] ) ;
        $cat_link = get_category_link( $post_categories[0] ) ;
        $posts[$index]->color = $cat_color ;
        $posts[$index]->cat_name = $cat_name ;
        $posts[$index]->cat_link = $cat_link ;
        $posts[$index]->post_link = get_permalink($post->ID) ;
        $posts[$index]->content = substr($posts[$index]->post_content ,0, 200)." ..." ;
    }
    $posts = array_chunk($posts , 4);

    return $posts ;
}

/**
 * get category color
 * @param $cat
 * @return mixed|option
 */
function get_category_color($cat){
    $color = get_option( "cat_color_$cat" );
    return $color ;
}

/**
 * get all categories in the site
 * @return array
 */
function get_all_categories(){
    $args = array(
        'type'                     => 'post',
        'child_of'                 => 0,
        'orderby'                  => 'name',
        'order'                    => 'ASC',
        'hide_empty'               => 0,
        'taxonomy'                 => 'category',
        'exclude'                  =>array(1)
    );
    return $categories = get_categories( $args );
}
