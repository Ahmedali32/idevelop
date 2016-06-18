<?php

////////////////////////////////////////////////////////////////////////////////////
// add category color "edit form"

    // lets add a text field in edit taxonomy page
    function idevelop_edit_category_field( $term ){
        $term_id = $term->term_id;
        $term_meta = get_option( "cat_color_$term_id" );
        ?>
        <tr class="form-field">

            <th scope="row">

                <label for="cat_color"><?php echo "color" ; ?></label>

                <td>
                    <input type="text" name="cat_color" id="cat_color" class="form-control" value="<?php echo $term_meta ; ?>" />
                </td>

            </th>

        </tr>
        <br/><br/>
    <?php
    }


    add_action( 'category_edit_form_fields', 'idevelop_edit_category_field' );
    ////////////////////////////////////////////////////////////////////////////////////

//save category color "edit form"

    function idevelop_save_color_meta_edit_form( $term_id ){

        if ( isset( $_POST['cat_color'] ) ) {
            // Be careful with the intval here. If it's text you could use sanitize_text_field()
            $term_meta = $_POST['cat_color'] ;

            // Save the option array.
            update_option( "cat_color_$term_id", $term_meta );

        }
    }

    add_action( 'edited_category', 'idevelop_save_color_meta_edit_form', 10, 2 );

//save category color "create form"
    add_action( 'category_add_form_fields', 'idevelop_edit_category_field_create' );
    add_action( 'create_category', 'idevelop_save_color_meta_edit_form', 10, 2 );

    function idevelop_edit_category_field_create( $term ){
        ?>
        <tr class="form-field">

            <th scope="row">

                <label for="cat_color"><?php echo "color" ; ?></label>

            <td>
                <input type="text" name="cat_color" id="cat_color" class="form-control" />
            </td>

            </th>

        </tr>
        <br/><br/>
    <?php
    }


////////////////////////////////////////////////////////////////////////////////////
// get posts for the home page add action
add_action( 'wp_ajax_idevelop_get_posts_home', 'idevelop_get_posts_for_home_page' );
add_action( 'wp_ajax_nopriv_idevelop_get_posts_home', 'idevelop_get_posts_for_home_page', 10, 2 );

function idevelop_get_posts_for_home_page(){
    $loaded_posts = (int)$_REQUEST['number'];
    $cat = $_REQUEST['cat'];
    $number = 30 ;

    $posts = idevelop_get_posts( $number , $loaded_posts, $cat) ;

    if( !empty( $posts ) ){
        $html_data = '';
        $num = 0 ;
        foreach( $posts as $post_chunk ){
            foreach($post_chunk as $post){
                $html_data.='<div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 idevelop-col animated fadeInLeft">';
                    $html_data.='<div class="post-column">';
                        $html_data.=sprintf('<div class="post-cat" style="background-color:%s"><a href="%s">%s</a></div>',$post->color ,$post->cat_name,$post->cat_name );
                            $html_data.='<h3>';
                                $html_data.=sprintf('<a href="%s">%s</a>',$post->post_link ,$post->post_title);
                            $html_data.='</h3>';
                            $html_data.='<p>';
                                $html_data.=$post->content;
                            $html_data.='</p>';
                        $html_data.='</div>';
                    $html_data.='</div>';
                $html_data.='</div>';

                $num++;
            }
        }

        $loaded_posts = $loaded_posts + $num ;
        wp_send_json_success( array( json_encode( $html_data ), $loaded_posts ) );
    }else{
        wp_send_json_error();
    }

}

function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');