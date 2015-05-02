<?php
/**
 * WPshed Theme Options
 */


 /** This will be displayed in the options panel header */
$theme_name = wp_get_theme() . ' - ' . __( 'Theme Options', 'textdomain' );

/** The short name gives a unique element to each options id. */
$shortname = 'my_theme';


/** Below are few sample arrays that we can use in our options. */

// Advanced Array Example
$advanced_array = array(
    'value_1' => 'Option Name 1',
    'value_2' => 'Option Name 2',
    'value_3' => 'Option Name 3',
    'value_4' => 'Option Name 4'
);


/**
 * Here we will set the options we are going to have in the theme options panel.
 */
$options = array(); // If you delete this line, the sky will fall down! So you better don't.



/* ---------------------------------------------------------------------------------------------------
    Headings (tabs)
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title'   => __( 'General Settings', 'textdomain' ), // Tab name
                    'tab'     => 'options', // Tab slug (unique)
                    'type'    => 'heading'); // type = Heading

$options[] = array( 'title'   => __( 'Example Options', 'textdomain' ),
                    'tab'     => 'tools',
                    'type'    => 'heading');


/* ---------------------------------------------------------------------------------------------------
    First Tab
--------------------------------------------------------------------------------------------------- */


// Info (title - description)
$options[] = array( 'title'   => __( 'WPshed Theme Options', 'textdomain' ), // optional
					'tab'     => 'options', // must be the same slug as the heading it's belongs to
                    'desc'    => __( 'A simple Settings API to create advanced WordPress Theme option pages!', 'textdomain' ), // optional
                    'type'    => 'info' );

$options[] = array( 'title'   => __( 'Select Example', 'textdomain' ), // title
                    'tab'     => 'options', // tab
                    'desc'    => __( 'Select field example.', 'textdomain' ), // optional - description
                    'id'      => $shortname . '_select_example',
                    'options' => array(
                                'text' => 'Text',
                                'image' => 'Image'
                                ),
                    'std'     => 'image', // default value
                    'type'    => 'select' );

$options[] = array( 'title'   => __( 'Text Field Example', 'textdomain' ),
					'tab'     => 'options',
                    'desc'    => __( 'Text field example with default value.', 'textdomain' ),
                    'id'      => $shortname . '_text_field_1',
                    'std'     => 'This is a default value',
                    'type'    => 'text' );

$options[] = array( 'title'   => __( 'Image Upload Example', 'textdomain' ),
					'tab'     => 'options',
                    'desc'    => __( 'This is an example of the image upload function.', 'textdomain' ),
                    'id'      => $shortname . '_img_upload_1',
                    'std'     => '',
                    'type'    => 'upload' );

$options[] = array( 'title'   => __( 'Textarea Field Example', 'textdomain' ),
					'tab'     => 'options',
                    'desc'    => __( 'Place some cool information here.', 'textdomain' ),
                    'id'      => $shortname . '_textarea_field_1',
                    'std'     => '',
                    'type'    => 'textarea' );


/* ---------------------------------------------------------------------------------------------------
    Second Tab
--------------------------------------------------------------------------------------------------- */


$options[] = array( 'title'   => '',
					'tab'     => 'tools',
                    'desc'    => __( 'I am an info field with no title. Check out how many cool options you can set!', 'textdomain' ),
                    'style'   => 'grey',
                    'type'    => 'info' );

$options[] = array( 'title'   => __( 'Text Field', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Text field example.', 'textdomain' ),
                    'id'      => $shortname . '_text_field_example',
                    'std'     => '',
                    'type'    => 'text' );

$options[] = array( 'title'   => __( 'Color Picker', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Select a color.', 'textdomain' ),
                    'id'      => $shortname . '_color_picker',
                    'std'     => '#b4c1f0',
                    'type'    => 'color' );

$options[] = array( 'title'   => __( 'WP Category Select', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Category select example.', 'textdomain' ),
                    'id'      => $shortname . '_category',
                    'std'     => '',
                    'type'    => 'categories' );

$options[] = array( 'title'   => __( 'Wp Page Select', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Page select example.', 'textdomain' ),
                    'id'      => $shortname . '_page',
                    'std'     => '',
                    'type'    => 'pages' );

$options[] = array( 'title'   => __( 'WP Post Select', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Post select example.', 'textdomain' ),
                    'id'      => $shortname . '_post',
                    'std'     => '',
                    'type'    => 'posts' );

$options[] = array( 'title'   => __( 'Image Upload', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Image upload example.', 'textdomain' ),
                    'id'      => $shortname . '_img_upload',
                    'std'     => '',
                    'type'    => 'upload' );

$options[] = array( 'title'   => __( 'Textarea Field', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Textarea field example.', 'textdomain' ),
                    'id'      => $shortname . '_textarea_field',
                    'std'     => '',
                    'type'    => 'textarea' );

$options[] = array( 'title'   => __( 'Select Field', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Select field example using predefined advanced array.', 'textdomain' ),
                    'id'      => $shortname . '_select_field',
                    'options' => $advanced_array,
                    'std'     => '',
                    'type'    => 'select' );

$options[] = array( 'title'   => __( 'Select Field 2', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Select field example.', 'textdomain' ),
                    'id'      => $shortname . '_select_field',
                    'options' => array(
                                'option_value_1' => 'Option Title 1',
                                'option_value_2' => 'Option Title 2'
                                ),
                    'std'     => 'option_value_1',
                    'type'    => 'select' );

$options[] = array( 'title'   => __( 'Radio Field', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Radio field example.', 'textdomain' ),
                    'id'      => $shortname . '_radio_field',
                    'options' => array(
                                'option_value_1' => 'Hey! Select me!',
                                'option_value_2' => 'No, no! Select me!'
                                ),
                    'std'     => 'option_value_1',
                    'type'    => 'radio' );

$options[] = array( 'title'   => __( 'Checkbox Field', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Checkbox field example - checked by default.', 'textdomain' ),
                    'id'      => $shortname . '_checkbox_field',
                    'std'     => 'checked',
                    'type'    => 'checkbox' );

$options[] = array( 'title'   => __( 'Checkbox Field 2', 'textdomain' ),
					'tab'     => 'tools',
                    'desc'    => __( 'Checkbox field example - unckecked  by default.', 'textdomain' ),
                    'id'      => $shortname . '_checkbox_field_2',
                    'std'     => '',
                    'type'    => 'checkbox' );


/* ---------------------------------------------------------------------------------------------------
    Help Tabs
--------------------------------------------------------------------------------------------------- */

$options[] = array( 'title'   => __( 'Help Tab', 'textdomain' ),
                    'content' => sprintf( '<p>%1$s</p>', 
                                    __( 'This is a help tab example.', 'textdomain' )
                                    ),
                    'type'    => 'help' );
                    
/* ---------------------------------------------------------------------------------------------------
    End Options Tabs
--------------------------------------------------------------------------------------------------- */

// Do not edit or delete below. This will include any child theme options.
if ( file_exists(get_stylesheet_directory() .'/theme-settings.php') ) {
    include get_stylesheet_directory() .'/theme-settings.php';
}
