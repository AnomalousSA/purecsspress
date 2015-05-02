<?php
/**
 * WPshed Theme Options
 */


 /** This will be displayed in the options panel header */
$theme_name = wp_get_theme() . ' - ' . __( 'Theme Options', 'textdomain' );

/** The short name gives a unique element to each options id. */
$shortname = 'purecsspress';


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

$options[] = array( 'title'   => __( 'Styling', 'textdomain' ), // Tab name
                    'tab'     => 'styling', // Tab slug (unique)
                    'type'    => 'heading'); // type = Heading

$options[] = array( 'title'   => __( 'Header/Footer', 'textdomain' ), // Tab name
                    'tab'     => 'headfoot', // Tab slug (unique)
                    'type'    => 'heading'); // type = Heading

$options[] = array( 'title'   => __( 'Custom', 'textdomain' ), // Tab name
                    'tab'     => 'custom', // Tab slug (unique)
                    'type'    => 'heading'); // type = Heading

$options[] = array( 'title'   => __( 'Example Options', 'textdomain' ),
                    'tab'     => 'tools',
                    'type'    => 'heading');


/* ---------------------------------------------------------------------------------------------------
    First Tab
--------------------------------------------------------------------------------------------------- */


// Info (title - description)
$options[] = array( 'title'   => __( '', 'textdomain' ), // optional
					'tab'     => 'options', // must be the same slug as the heading it's belongs to
                    'desc'    => __( 'General Settings for the Purecss Press Theme', 'textdomain' ), // optional
                    'type'    => 'info' );


$options[] = array( 'title'   => __( 'Logo', 'textdomain' ),
					'tab'     => 'options',
                    'desc'    => __( 'Please select a logo for the website.', 'textdomain' ),
                    'id'      => $shortname . '_logo',
                    'std'     => '',
                    'type'    => 'upload' );

$options[] = array( 'title'   => __( 'Favicon', 'textdomain' ),
					'tab'     => 'options',
                    'desc'    => __( 'Please select a Favicon for the website.', 'textdomain' ),
                    'id'      => $shortname . '_favicon',
                    'std'     => '',
                    'type'    => 'upload' );

$options[] = array( 'title'   => __( 'Display Breadcrumbs', 'textdomain' ),
					'tab'     => 'options',
                    'desc'    => __( 'Should breadcrumbs be shown on the website.', 'textdomain' ),
                    'id'      => $shortname . '_breadcrumbs_visable',
                    'std'     => '',
                    'type'    => 'checkbox' );

$options[] = array( 'title'   => __( 'Textarea Field Example', 'textdomain' ),
					'tab'     => 'options',
                    'desc'    => __( 'Place some cool information here.', 'textdomain' ),
                    'id'      => $shortname . '_textarea_field_1',
                    'std'     => '',
                    'type'    => 'textarea' );


/*
 * 
 * Second Tab
 */

$options[] = array( 'title'   => __( 'Background', 'textdomain' ), // optional
					'tab'     => 'styling', // must be the same slug as the heading it's belongs to
                    'desc'    => __( 'Choose background options', 'textdomain' ), // optional
                    'type'    => 'info' );


$options[] = array( 'title'   => __( 'Background Colour', 'textdomain' ),
					'tab'     => 'styling',
                    'desc'    => __( 'Select a color.', 'textdomain' ),
                    'id'      => $shortname . '_background_color',
                    'std'     => '#ffffff',
                    'type'    => 'color' );

$options[] = array( 'title'   => __( 'Background Image', 'textdomain' ),
					'tab'     => 'styling',
                    'desc'    => __( 'Please select a backgroundimage.', 'textdomain' ),
                    'id'      => $shortname . '_background_image',
                    'std'     => '',
                    'type'    => 'upload' );

$options[] = array( 'title'   => __( 'Font Colours', 'textdomain' ), // optional
					'tab'     => 'styling', // must be the same slug as the heading it's belongs to
                    'desc'    => __( 'Change font options', 'textdomain' ), // optional
                    'type'    => 'info' );

$options[] = array( 'title'   => __( 'Main Colour', 'textdomain' ),
					'tab'     => 'styling',
                    'desc'    => __( 'Select a color.', 'textdomain' ),
                    'id'      => $shortname . '_font_color',
                    'std'     => '#000000',
                    'type'    => 'color' );
$options[] = array( 'title'   => __( 'Link Colour', 'textdomain' ),
					'tab'     => 'styling',
                    'desc'    => __( 'Select a color.', 'textdomain' ),
                    'id'      => $shortname . '_link_color',
                    'std'     => '#000000',
                    'type'    => 'color' );

$options[] = array( 'title'   => __( 'Link Hover Colour', 'textdomain' ),
					'tab'     => 'styling',
                    'desc'    => __( 'Select a color.', 'textdomain' ),
                    'id'      => $shortname . '_link_hover_color',
                    'std'     => '#000000',
                    'type'    => 'color' );

$options[] = array( 'title'   => __( 'Header Colour', 'textdomain' ),
					'tab'     => 'styling',
                    'desc'    => __( 'Select a color.', 'textdomain' ),
                    'id'      => $shortname . '_header_color',
                    'std'     => '#000000',
                    'type'    => 'color' );



$options[] = array( 'title'   => __( 'Font Sizes', 'textdomain' ), // optional
					'tab'     => 'styling', // must be the same slug as the heading it's belongs to
                    'desc'    => __( 'Please select the font size add the px, pt, em.', 'textdomain' ), // optional
                    'type'    => 'info' );

$options[] = array( 'title'   => __( 'Page font size', 'textdomain' ),
					'tab'     => 'styling',
                    //'desc'    => __( '', 'textdomain' ),
                    'id'      => $shortname . '_main_font_size',
                    'std'     => '0.875em',
                    'type'    => 'text' );

$options[] = array( 'title'   => __( 'H1 size', 'textdomain' ),
					'tab'     => 'styling',
                    //'desc'    => __( 'Please select the font size add the px, pt, em.', 'textdomain' ),
                    'id'      => $shortname . '_h_1_size',
                    'std'     => '2em',
                    'type'    => 'text' );
$options[] = array( 'title'   => __( 'H2 size', 'textdomain' ),
					'tab'     => 'styling',
                    //'desc'    => __( 'Please select the font size add the px, pt, em.', 'textdomain' ),
                    'id'      => $shortname . '_h_2_size',
                    'std'     => '1.5em',
                    'type'    => 'text' );
$options[] = array( 'title'   => __( 'H3 size', 'textdomain' ),
					'tab'     => 'styling',
                    //'desc'    => __( 'Please select the font size add the px, pt, em.', 'textdomain' ),
                    'id'      => $shortname . '_h_3_size',
                    'std'     => '1.17em',
                    'type'    => 'text' );
$options[] = array( 'title'   => __( 'H4 size', 'textdomain' ),
					'tab'     => 'styling',
                    //'desc'    => __( 'Please select the font size add the px, pt, em.', 'textdomain' ),
                    'id'      => $shortname . '_h_4_size',
                    'std'     => '1.12em',
                    'type'    => 'text' );
$options[] = array( 'title'   => __( 'H5 size', 'textdomain' ),
					'tab'     => 'styling',
                    //'desc'    => __( 'Please select the font size add the px, pt, em.', 'textdomain' ),
                    'id'      => $shortname . '_h_5_size',
                    'std'     => '0.83em',
                    'type'    => 'text' );
$options[] = array( 'title'   => __( 'H6 size', 'textdomain' ),
					'tab'     => 'styling',
                    //'desc'    => __( 'Please select the font size add the px, pt, em.', 'textdomain' ),
                    'id'      => $shortname . '_h_6_size',
                    'std'     => '0.75em',
                    'type'    => 'text' );

/*
 * Fith Tab
 */

$options[] = array( 'title'   => __( 'Custom Script', 'textdomain' ),
					'tab'     => 'custom',
                    'desc'    => __( 'Dont include the opening and closing script tags', 'textdomain' ),
                    'id'      => $shortname . '_script',
                    'std'     => '',
                    'type'    => 'textarea' );

$options[] = array( 'title'   => __( 'Custom Styling', 'textdomain' ),
					'tab'     => 'custom',
                    'desc'    => __( 'Dont include the opening and closing style tags', 'textdomain' ),
                    'id'      => $shortname . '_style',
                    'std'     => '',
                    'type'    => 'textarea' );
/* ---------------------------------------------------------------------------------------------------
    Third Tab
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
