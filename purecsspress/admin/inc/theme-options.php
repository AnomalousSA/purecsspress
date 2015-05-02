<?php
/*
    Plugin Name: WPshed Theme Options
    Plugin URI: http://wpshed.com/
    Description: Create an easy to use admin panel for your WordPress theme.
    Version: 1.1
    Author: Stefan I.
    Author URI: http://istefan.me/
    License: GNU General Public License v2 or later
    License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/**
 * This function defines the WTO constants
 */
function wto_constants() {

    define( 'WTO_DIR',          trailingslashit( get_template_directory() ) . 'admin' );
    define( 'WTO_URL',          trailingslashit( get_template_directory_uri() ) . 'admin' );

    define( 'WTO_INC_DIR',      trailingslashit( WTO_DIR ) . 'inc' );
    define( 'WTO_JS_DIR',       trailingslashit( WTO_DIR ) . 'js' );
    define( 'WTO_CSS_DIR',      trailingslashit( WTO_DIR ) . 'css' );
    define( 'WTO_IMAGES_DIR',   trailingslashit( WTO_DIR ) . 'images' );
    
    define( 'WTO_JS_URL',       trailingslashit( WTO_URL ) . 'js' );
    define( 'WTO_CSS_URL',      trailingslashit( WTO_URL ) . 'css' );
    define( 'WTO_IMAGES_URL',   trailingslashit( WTO_URL ) . 'images' );

    define( 'WTO_THEME_SETTINGS',           trailingslashit( WTO_DIR ) . 'theme-settings.php' );
    define( 'WTO_THEME_SETTINGS_SAMPLE',    trailingslashit( WTO_DIR ) . 'theme-settings-sample.php' );

    define( 'WTO_FORMS',                    trailingslashit( WTO_INC_DIR ) . 'forms.php' ); 

    define( 'WTO_PAGE_SLUG',                'theme-options' ); 
    define( 'WTO_PAGE_NAME',                __( 'Theme Options', 'wto' ) );   

}
add_action( 'wto_init', 'wto_constants' );


/**
 * Define WTO settings file
 */
function wto_settings_file() {

    if ( file_exists( WTO_THEME_SETTINGS ) ) {
        $theme_settings = WTO_THEME_SETTINGS;
    } else {
        $theme_settings = WTO_THEME_SETTINGS_SAMPLE;
    }

    return $theme_settings;

}


/**
 * Add a "Theme Options" menu to admin bar
 */
function wto_admin_bar_menu() { 
    global $wp_admin_bar, $wpdb;

    if ( !is_super_admin() || !is_admin_bar_showing() )
        return;

    $wp_admin_bar->add_menu( array(
        'id'    => 'wto_theme_options',
        'title' => WTO_PAGE_NAME,
        'href'  => get_option( 'siteurl' ).'/wp-admin/themes.php?page=' . WTO_PAGE_SLUG
    ) );

}
add_action( 'admin_bar_menu', 'wto_admin_bar_menu', 1000 );


/**
 * Generate a message with a link to the options page on theme activation
 */
function wto_activation_message() { ?>

    <script type="text/javascript">
    jQuery(function(){
        var message = '<p><strong>New theme activated!</strong> This theme supports custom settings, please visit the <a href="<?php echo admin_url( 'themes.php?page=' . WTO_PAGE_SLUG ); ?>">theme options</a> page to configure them.</p>';
        jQuery('.themes-php #message2').html( message );
    });
    </script>

<?php 

}
add_action( 'admin_head', 'wto_activation_message' );


/**
 * Load necessary JavaScript and CSS files
 */
function wto_scripts() {

    if ( isset($_GET['page']) && $_GET['page'] == WTO_PAGE_SLUG ) {

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_script( 'wto-admin',         trailingslashit( WTO_JS_URL ) . 'admin.js', array( 'jquery' ) );
        wp_enqueue_script( 'wto-colorpicker',   trailingslashit( WTO_JS_URL ) . 'colorpicker.js', array( 'wp-color-picker' ) );
        wp_enqueue_script( 'wto-upload',        trailingslashit( WTO_JS_URL ) . 'upload.js', array( 'jquery' ) );

        wp_enqueue_style( 'wto-admin',          trailingslashit( WTO_CSS_URL ) . 'admin.css' );

    }

}
add_action('admin_print_scripts', 'wto_scripts');


/**
 * Register WTO Settings.
 */
function wto_register_settings() {

    include wto_settings_file();

    foreach ( $options as $option ) {
        if ( $option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help' ) {
            if ( ! get_option( $option['id'] ) ) {
                update_option( $option['id'], $option['std'] );
            }
        }
    }


}
add_action( 'after_switch_theme', 'wto_register_settings' );


/**
 * WTO Admin Notice.
 */
function wto_admin_notice() {

    if ( isset( $_GET['page'] ) && $_GET['page'] == WTO_PAGE_SLUG ) {

        // Settings saved message
        if ( isset( $_GET['saved'] ) && $_GET['saved'] == 'true' ) {
            printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                __( 'Settings Saved!', 'wto' )
            );
        }

        // Settings reset message
        if ( isset( $_GET['reset'] ) && $_GET['reset'] == 'true' ) {
            printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                __( 'All settings were reset to default values!', 'wto' )
            );
        }

        // Settings backup message
        if ( isset( $_GET['backup'] ) && $_GET['backup'] == 'ok' ) {
            printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                __( 'You made a successful backup of your theme settings!', 'wto' )
            );
        }

        // Settings restore message
        if ( isset( $_GET['restore'] ) && $_GET['restore'] == 'ok' ) {
            printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                __( 'All your settings were restored to default values!', 'wto' )
            );
        }

    }

}
add_action( 'admin_notices', 'wto_admin_notice' );


/**
 * Init WTO Page.
 */
function wto_page_init() { 

    // Include the theme settings
    include wto_settings_file();

    // Define the current tab
    $current_tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : $options[0]['tab'];

    // If the current user can manage options and the page is the options page
    // Save, Reset, Backup and Restore is possible
    if ( current_user_can( 'manage_options' ) && isset( $_GET['page'] ) && $_GET['page'] == WTO_PAGE_SLUG ) {

        // Save Options
        if ( isset( $_REQUEST['action'] ) && 'save' == $_REQUEST['action'] ) {

            foreach ( $options as $option ) {

                if ( $option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help' ) {

                    if ( isset( $_POST[$option['id']] ) ) {

                        if ( ! is_array( $_POST[$option['id']] ) ) {
                            $the_value = stripslashes( $_POST[$option['id']] );
                        } else {
                            $the_value = serialize( $_POST[$option['id']] );
                        }

                        update_option( $option['id'], $the_value );

                    } else {

                        delete_option( $option['id'] );
                        
                    }


                }

            }

            // Redirect to the theme options page
            wp_redirect( admin_url( 'themes.php?page='. WTO_PAGE_SLUG .'&tab='. $current_tab .'&saved=true' ) );
            die;

        }

        // Reset Options
        if ( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {

            foreach ( $options as $option ) {
                if ( $option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help' )
                    update_option( $option['id'], $option['std'] );
            }

            // Redirect to the theme options page
            wp_redirect( admin_url( 'themes.php?page='. WTO_PAGE_SLUG .'&tab='. $current_tab .'&reset=true' ) );
            die;

        }

        // Backup Options
        if ( isset($_GET['backup']) && $_GET['backup'] == 'true' ) {

    		$date           = date('l jS \of F Y h:i:s A');
            $panel_options  = array();

    		foreach ( $options as $option ) {
    		    if ( $option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help' ) {

                    if ( !is_array(get_option($option['id'])) ) {
                        $the_value = stripslashes(get_option($option['id']));
                    } else {
                        $the_value = serialize(get_option($option['id']));
                    }
                    $panel_options[$option['id']] = $the_value;

    		    }
    		}
            update_option( $shortname.'_theme_backup', serialize($panel_options) );
            update_option( $shortname.'_theme_backup_date', $date );

            // Redirect to the theme options page
            wp_redirect( admin_url( 'themes.php?page='. WTO_PAGE_SLUG .'&tab='. $current_tab .'&backup=ok' ) );
            die;

        }

        // Import Options
        if ( isset($_REQUEST['action']) && 'restore' == $_REQUEST['action'] ) {

            $saved_options = get_option( $shortname.'_theme_backup' );
            $import_options = stripslashes($_POST['theme_update']);

            if ( $saved_options != $import_options ) {
                $panel_options = $import_options;
            } else {
                $panel_options = $saved_options;
            }
            $restore_data = unserialize($panel_options);

    		foreach ( $restore_data as $key => $value ) {
    		        update_option( $key, $value );
    		}

            // Redirect to the theme options page
            wp_redirect( admin_url( 'themes.php?page='. WTO_PAGE_SLUG .'&tab='. $current_tab .'&restore=ok' ) );
            die;

        }

    }


    // Generate the theme options menu
    $options_page = add_theme_page(
        WTO_PAGE_NAME,
        WTO_PAGE_NAME,
        'edit_themes',
        WTO_PAGE_SLUG,
        'wto_html_output',
        false,
        30
    );

    add_action( 'load-' . $options_page, 'wto_help_tab' );

}
add_action( 'admin_menu', 'wto_page_init' );


/**
 * TOF Help Page.
 */
function wto_help_tab () {

    global $options_page;

    $screen = get_current_screen();

    // Include the theme settings file
    include wto_settings_file();

    foreach ( $options as $option ) {
        if ( $option['type'] == 'help' ) {
            $screen->add_help_tab( array(
                'id'        => sanitize_title( $option['title'] ),
                'title'     => esc_attr( $option['title'] ),
                'content'   => $option['content']
            ) );           
        }
    }

}


/**
 * WPshed TOF HTML Output.
 */
function wto_html_output() {

    $tabs = '';

    // Include the theme settings file
    include wto_settings_file();

    // Include the options machine to populate the setting fields
    include WTO_FORMS;

?>

    <div class="wrap">

        <h2><?php echo $theme_name; ?></h2>

        <?php $current_tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : $options[0]['tab']; ?>
        <h2 class="nav-tab-wrapper">
            <?php

            foreach ( $options as $option ) {
                if ( $option['type'] == 'heading' ) {
                    $tab_class = ( $option['tab'] == $current_tab ) ? 'nav-tab-active' : '';
                    echo '<a href="?page='. WTO_PAGE_SLUG .'&tab='. $option['tab'] .'" class="nav-tab '. $tab_class .'">'. $option['title'] .'</a>'."\n";
                }
            }

            ?>
            <a href="?page=<?php echo WTO_PAGE_SLUG; ?>&tab=backup" class="nav-tab <?php echo $current_tab == 'backup' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Backup / Restore', 'wto' ); ?></a>
        </h2>

        <?php if ( $current_tab != 'backup' ) : ?>
        <form method="post" id="wto-form" enctype="multipart/form-data">
            
            <table class="form-table">
                <tbody>

                    <input type="hidden" name="action" value="save" />                    
                    <?php echo $tabs; ?>
       
                    <tr valign="top">
                    <th scope="row"></th>
                    <td><input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'wto' ); ?>" /></td>
                    </tr>
            
                </tbody>
            </table>
        </form>

        <!-- Form to reset options to default values -->
        <form method="post">
            <table class="form-table">
            <input type="hidden" name="action" value="reset" />

                <tr valign="top">
                <th scope="row"></th>
                <td>
                    <input type="submit" class="button-secondary" onclick="return confirm('<?php _e("This will reset all settings to default values! Consider updating your custom settings before reset. Are you sure you want to reset now?", "wto"); ?>')" value="<?php _e( 'Reset All Options', 'wto' ); ?>" />
                </td>
                </tr>
            
            </table>
        </form>
        <?php endif; ?>

        <?php if ( $current_tab == 'backup' ) : ?>

            <form method="post" id="restore-form" enctype="multipart/form-data">
            
            <input type="hidden" name="action" value="restore" />

            <?php

            $last_backup = ( get_option( $shortname.'_theme_backup_date') == '' ) ? __('never', 'wto' ) : get_option( $shortname . '_theme_backup_date' );

            printf( '<h3>%1$s</h3><p>%2$s<br>%3$s</p><p>%4$s: %5$s</p><p><a class="button-primary" href="%6$s">%7$s</a></p>',
                __( 'Backup & Restore', 'wto' ),
                __( 'You can backup your current options and restore it back at a later time.', 'wto' ),
                __( 'It is recommended to backup your options from time to time if you change some options but would like to keep the old settings as well in case you need it back.', 'wto' ),
                __( 'Your last backup', 'wto' ),
                $last_backup,
                admin_url( 'themes.php?page='. WTO_PAGE_SLUG .'&tab=backup&backup=true' ),
                __( 'Backup Settings', 'wto' ),
                __( 'You can use the below section to make local copies of your backup file (simply copy the information in a text file) or to transfer your settings to another site.', 'wto' ),
                __( 'To import a settings file from another site just paste your backup information below and hit the "Restore Settings" button.', 'wto' ),
                __( 'If no backup file will be pasted, the last local backup will be restored.', 'wto' )
            );

            printf( '<p>%1$s<br>%2$s</p><p>%3$s</p><p><textarea name="theme_update" class="large-text code" id="theme_update" rows="8" onClick="select(theme_update);">%4$s</textarea></p>',
                __( 'You can use the below section to make local copies of your backup file (simply copy the information in a text file) or to transfer your settings to another site.', 'wto' ),
                __( 'To import a settings file from another site just paste your backup information below and hit the "Restore Settings" button.', 'wto' ),
                __( 'If no backup file will be pasted, the last local backup will be restored.', 'wto' ),
                get_option( $shortname.'_theme_backup' ),
                __( 'Restore Settings', 'wto' )
            );

            ?>
            
            <br class="clear">
            <p><input type="submit" class="button-secondary restore-but" id="restore-but" value="<?php _e( 'Restore Settings', 'wto' ); ?>" /></p>
            
            </form>

        <?php endif; ?>

    </div><!-- .wrap -->


    <?php

}

/**
 * Run the wto_init hook.
 */
do_action( 'wto_init' );
