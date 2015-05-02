<?php
/**
 * WPshed Theme Options - Form Fields
 */

// Define the current tab
$current_tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : $options[0]['tab'];

foreach ( $options as $option ) {

    // Define the input field values
    if ( $option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help' ) {

        // Option value variable
        $real_value = '';

        // Option default value
        $default_value = ( isset( $option['std'] ) ) ? $option['std'] : '';

        // User defined value
        $user_defined_value = ( isset( $option['id'] ) ) ? get_option( $option['id'] ) : '';

        // Define the real value based on default or user defined value
        $real_value = ( $user_defined_value == '' ) ? $default_value : $user_defined_value;

    }


    // Switch between option types and populate the form fields according to the option type
    switch ( $option['type'] ) {


        // Text Field
        case 'text':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";
			$tabs .= '<input type="text" name="'. $option['id'] .'" id="'. $option['id'] .'" class="regular-text" value="'. $real_value .'" />'."\n";
            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // Text area field output
        case 'textarea':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";
			$tabs .= '<textarea class="textarea" class="large-text code" cols="50" rows="10" name="'.$option['id'].'" id="'.$option['id'].'">'.$real_value.'</textarea>'."\n";
            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // Select field output
        case 'select':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                $tabs .= '<select class="select" name="'.$option['id'].'" id="'.$option['id'].'" style="padding-right: 10px;">'."\n";

                    // Which options should be selected
                    foreach ( $option['options'] as $key => $value ) {

                        $active_attr = ( $key == $real_value ) ? 'selected' : '';

                        // Options
                        $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="'.$key.'" '.$active_attr.'>'.$value.'</option>'."\n";

                    }

                $tabs .= '</select>'."\n";

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // Checkbox field output
        case 'checkbox':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                // Checked value
                $checked = ( $user_defined_value == 'checked' ) ? 'checked="checked"' : '' ;
                
                // The checkbox field
                $tabs .= '<p class="checkbox"><input type="checkbox" name="'.$option['id'].'" id="'.$option['id'].'" value="checked" '.$checked.'>&nbsp;&nbsp;<label for="'.$option['id'].'">'.$option['desc'].'</labe></p>'."\n";

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // Radio field output
        case 'radio':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                // Which options should be selected
                foreach ( $option['options'] as $key => $value ) {

                    $active_attr = ( $key == $real_value ) ? 'checked' : '';

                    // The radio field
                    $tabs .= '<p class="radio"><input type="radio" name="'.$option['id'].'" value="'.$key.'" id="'.$key.'" '.$active_attr.'>&nbsp;&nbsp;<label for="'.$key.'">'.$value.'</label></p>'."\n";

                }

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // WP categories select field output
        case 'categories':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                // The select field
                $tabs .= '<select class="select" name="'.$option['id'].'" id="'.$option['id'].'" style="padding-right: 10px;">'."\n";

                    // Access WP categories via an Array
                    $wto_categories = array();
                    $wto_categories = get_categories('hide_empty=0');

                    $no_cat = ( $real_value == '' ) ? 'selected' : '';
                    $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="" '.$no_cat.'>'. __( 'Select Category', 'wto' ) .'</option>'."\n";

                    // Which category should be selected
                    foreach ( $wto_categories as $cat ) {

                        $active_attr = ( $cat->cat_ID == $real_value ) ? 'selected' : '';

                        // Options
                        $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="'.$cat->cat_ID.'" '.$active_attr.'>'.$cat->cat_name.'</option>'."\n";

                    }

                $tabs .= '</select>'."\n";

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // WP page select field output
        case 'pages':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                $tabs .= '<select class="select" name="'.$option['id'].'" id="'.$option['id'].'" style="padding-right: 10px;">'."\n";

                    $no_page = ( $real_value == '' ) ? 'selected' : '';
                    $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="" '.$no_page.'>'. __( 'Select Page', 'wto' ) .'</option>'."\n";

                    // Access WP pages via an Array
                    $wto_pages = array();
                    $wto_pages = get_pages('sort_column=post_parent,menu_order');

                    // Which page should be selected
                    foreach ( $wto_pages as $page ) {

                        $active_attr = ( $page->ID == $real_value ) ? 'selected' : '';

                        // Options
                        $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="'.$page->ID.'" '.$active_attr.'>'.$page->post_title.'</option>'."\n";

                    }

                $tabs .= '</select>'."\n";

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // WP post select field output
        case 'posts':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                $tabs .= '<select class="select" name="'.$option['id'].'" id="'.$option['id'].'" style="padding-right: 10px;">'."\n";

                    //Access WP posts via an Array
                    $wto_posts = array();
                    $wto_posts = get_posts('numberposts=100');

                    $no_post = ( $real_value == '' ) ? 'selected' : '';
                    $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="" '.$no_post.'>'. __( 'Select Post', 'wto' ) .'</option>'."\n";


                    // Which post should be selected
                    foreach ( $wto_posts as $post ) {

                        $active_attr = ( $post->ID == $real_value ) ? 'selected' : '';

                        // Options
                        $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;max-width: 330px;" value="'.$post->ID.'" '.$active_attr.'>'.$post->post_title.'</option>'."\n";

                    }

                $tabs .= '</select>'."\n";

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;


        // Image upload output
        case 'upload':

         	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                $tabs .= '<div class="upload-field">';

                // The image upload field
                $tabs .= '<input type="text" class="regular-text" name="'. $option['id'] .'" id="'.$option['id'].'" value="'.$real_value.'" />';
                // The upload image button
                $tabs .= '<input type="button" id="'. $option['id'] .'-button" class="wto-upload-button button" value="'. __( 'Upload', 'wto' ) .'" />'."\n";

                // The remove image button
                if ( $real_value ) {

                    $tabs .= '<input type="button" id="'. $option['id'] .'-remove" class="wto-remove-button button" value="'. __( 'Remove', 'wto' ) .'" />'."\n";
                    $tabs .= '<div id="'. $option['id'] .'-preview">';
                    $tabs .= '<img src="'.$real_value.'" style="max-width:300px;height:auto;margin-top:10px;border:3px solid #fff;" alt="" />'."\n";
                    $tabs .= '</div>';

                }

                $tabs .= '</div>';

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;




        // Color picker output
        case 'color':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
			$tabs .= '<td>'."\n";

                $tabs .= '<input type="text" class="textfield wto-color" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$real_value.'" />'."\n";

            if( isset($option['desc']) )
                $tabs .= '<p class="description">'.$option['desc'].'</p>'."\n";
            $tabs .= '</td>'."\n";
			$tabs .= '</tr>'."\n";

        break;




        // Info section
        case 'info':

        	$display = ( $current_tab == $option['tab'] ) ? '' : ' style="display:none;"';
			$tabs .= '<tr valign="top"'. $display .'>'."\n";
			$tabs .= '<th scope="row"></th>'."\n";
			$tabs .= '<td>'."\n";
            // If style is set add color class
            $color_class = ( isset($option['style']) ) ? $option['style'] : '' ;

            $tabs .= '<div class="info '.$color_class.'">'."\n";

                // Title
                if ( isset($option['title']) && $option['title'] != '' )
                    $tabs .= '<h3>'.$option['title'].'</h3>'."\n";

                // Description
                if ( isset($option['desc']) && $option['desc'] != '' )
                    $tabs .= '<p>'.$option['desc'].'</p>'."\n";

            $tabs .= '</div>'."\n";
            $tabs .= '<td>'."\n";
			$tabs .= '</tr>'."\n";


        break;



    } // End switch

} // End foreach