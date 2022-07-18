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

    wp_enqueue_style( 'style',  $plugin_url . "includes/style.css");
}

add_action( 'admin_print_styles', 'yash_style_enqueue' );

/**
 * Add the Sermons menu page.
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
}
add_action( 'admin_menu', 'yash_add_admin_page' );
 
/**
 * Display Sermons page content
 */
function yash_admin_page(){
   // Builds the content
    function yash_admin_content(){
        $plugin_url = plugin_dir_url( __FILE__ );
        
        include('includes/yash_admin_content.php') ;
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