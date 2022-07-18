<?php
/**
 * Plugin Name: Yet Another Sermon Host
 * Plugin URI: mychurchplugin.com
 * Description: Adds dynamic shortcodes to your WordPress site to display your churches sermons when using https://yetanothersermon.host/
 * Version: 1.0.0
 * Author: myCHURCH Plugin
 * Author URI: mychurchplugin.com
 */

/**
 * Activate
 * I want to add the functionality to redirect after activation.
 * See this link: https://wearnhardt.com/2020/03/redirecting-after-plugin-activation/
 */
function yash_plugin_activation(){
    do_action( 'yash_add_admin_page' );
}
register_activation_hook( __FILE__, 'yash_plugin_activation' );

/**
 * Deactivate
 */
function yash_plugin_deactivation(){
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'yash_plugin_deactivation' ); 

// Uninstall

/**
 * Included files
 */
// Enqueue Styles
function yash_style_enqueue() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style',  $plugin_url . "/style.css");
    wp_enqueue_style( 'style', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css');
    wp_enqueue_style( 'style', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');

//     <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
// <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
}

add_action( 'admin_print_styles', 'yash_style_enqueue' );

/**
 * Register the Sermons menu page.
 */
function yash_add_admin_page(){
    add_menu_page( 
        __( 'Sermons', 'textdomain' ),
        'Sermons',
        'manage_options',
        'yet-another-sermon-host.php',
        'yash_admin_page',
        'dashicons-media-audio',
        2
    );

    add_submenu_page( 
        'yet-another-sermon-host.php', //$parent_slug
        'Settings', //$page_title
        'Settings', //$menu_title
        'manage_options', //$capability
        'settings', //$menu_slug
        'yash_settings_page', //$callback
        null //$position
    );

}
add_action( 'admin_menu', 'yash_add_admin_page' );
 
/**
 * Display Sermons page content
 */
function yash_admin_page(){
    esc_html_e( '', 'textdomain' );
    
    // Builds the content
    function yash_admin_content(){
        $plugin_url = plugin_dir_url( __FILE__ );
        
        include('yash_admin_content.php') ;
    }

    // Call and display the content
    yash_admin_content();
}

/**
 * Display Settings page content
 */
function yash_settings_page(){
    esc_html_e( '', 'textdomain' );
    
    // Builds the content
    function yash_admin_content(){
        echo '<div><h1>Yet Another Sermon Host Plugin Settings</h1></div>';
        echo '<form>
                <input type="text"></input>
                <input type="submit" value="Update"></input>
            </form>';
        echo ( test() );
    }

    function test(){
        echo '<div style="color:green;">test successful</div>';
    }

    // Call and display the content
    yash_admin_content();
}



/**
 * Shortcodes
 */
// [sermon_latest]
function yash_sermon_latest(){
    $yash_church_id = "sppcabing";

    echo '<div id="yash-embed-sermon-latest" data-url="https://yetanothersermon.host/_/',$yash_church_id,'/embed_v2/sermon/latest/"></div>
  <script src="https://yetanothersermon.host/js/embed.js" defer data-id="yash-embed-sermon-latest"></script>';
}
add_shortcode( 'sermon_latest', 'yash_sermon_latest' );

// [sermon_page]
function yash_sermon_page(){
    $yash_church_id = "sppcabing";

    echo '<div id="yash-embed-sermons" data-url="https://yetanothersermon.host/_/',$yash_church_id,'/embed_v2/"></div>
    <script src="https://yetanothersermon.host/js/embed.js" defer data-id="yash-embed-sermons"></script>';
}
add_shortcode( 'sermon_page', 'yash_sermon_page' );



