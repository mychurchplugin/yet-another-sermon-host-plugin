<?php
/*
Plugin Name: Yet Another Sermon Host Shortcodes
Plugin URI: https://mychurchplugin.com
Description: Allows users to embed sermons from Yet Another Sermon Host using shortcodes
Version: 1.0
Author: myChurch Creative
Author URI: https://mychurchcreative.com
*/

// Register plugin settings
function yash_shortcode_register_settings() {
    add_option( 'yash_sermon_user_name', '' );
    add_settings_section( 'yash_sermon_settings_section', 'Yet Another Sermon Host Settings', 'yash_sermon_settings_callback', 'yash_sermon_settings' );
    add_settings_field( 'yash_sermon_user_name_field', 'Yet Another Sermon Host User Name', 'yash_sermon_user_name_field_callback', 'yash_sermon_settings', 'yash_sermon_settings_section' );
    register_setting( 'yash_sermon_settings', 'yash_sermon_user_name' );
}
add_action( 'admin_init', 'yash_shortcode_register_settings' );

// Enqueue plugin stylesheet
function yash_sermon_enqueue_styles() {
    wp_enqueue_style( 'yash-sermon-styles', plugins_url( 'style.css', __FILE__ ), array(), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'yash_sermon_enqueue_styles' );

// Enqueue plugin scripts
function yash_sermon_enqueue_scripts() {
    wp_enqueue_script( 'clipboard-js', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js', array(), '2.0.8', true );
    wp_enqueue_script( 'yash-sermon-script', plugin_dir_url( __FILE__ ) . 'script.js', array( 'clipboard-js' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'yash_sermon_enqueue_scripts' );


// Create settings section
function yash_sermon_settings_callback() {
    echo '<p>Enter your <a href="https://yetanothersermon.host/" target="_blank">Yet Another Sermon Host</a> username above.</p>';
}

// Create user name input field
function yash_sermon_user_name_field_callback() {
    $yash_sermon_user_name = get_option( 'yash_sermon_user_name' );
    echo '<input type="text" id="yash-sermon-user-name" name="yash_sermon_user_name" value="' . esc_attr( $yash_sermon_user_name ) . '" />';
}


// Generate click-to-copy field for [sermon-latest] and [sermon-page] shortcode
function yash_sermon_generate_copy_field() {
    $shortcode_latest = '[sermon-latest]';
    $shortcode_page = '[sermon-page]';
    $field_id_latest = 'yash-sermon-copy-field-latest';
    $field_id_page = 'yash-sermon-copy-field-page';

    echo '<div class="yash-sermon-copy-field">';
    echo '<input type="text" id="' . $field_id_latest . '" value="' . $shortcode_latest . '" readonly>';
    echo '<button class="copy-button button" data-clipboard-target="#' . $field_id_latest . '">Copy</button>';
    echo '</div>';

    echo '<div class="yash-sermon-copy-field">';
    echo '<input type="text" id="' . $field_id_page . '" value="' . $shortcode_page . '" readonly>';
    echo '<button class="copy-button button" data-clipboard-target="#' . $field_id_page . '">Copy</button>';
    echo '</div>';
}

// Create plugin options page
function yash_sermon_options_page() {
    $image_url = plugins_url( 'imgs/instructions-screenshot.png', __FILE__ );
    ?>
    <div class="wrap">
    <h1>Yet Another Sermon Host Shortcodes Settings</h1>    
        <div class="wrap two-third">
            <div class="username-paste-section">
                <form method="post" action="options.php">
                    <?php settings_fields( 'yash_sermon_settings' ); ?>
                    <?php do_settings_sections( 'yash_sermon_settings' ); ?>
                    <?php submit_button(); ?>
                </form>
            </div>
        </div>

        <div class="wrap one-third" id="callout-box">
            <div>
                <h2>Shortcodes</h2>
                <?php yash_sermon_generate_copy_field(); ?>
            </div>
        </div>

        <div class="wrap full">
            <div>
                <h2>Instructions</h2>
                <ol>
                    <li>Login to <a href="https://yetanothersermon.host/users/login/" target="_blank">yetanothersermon.host</a></li>
                    <li>Click <i>Integrate</i></li>
                    <li>Highlight your username in the URL (in this case, test1) and copy and paste it below</li>
                </ol>
                <img src="<?php echo $image_url; ?>" />
            </div>
        </div>
    </div>
    <?php
}

// Add options page to settings menu
function yash_sermon_add_options_page() {
    add_options_page( 'Yet Another Sermon Host Shortcodes Settings', 'Yet Another Sermon Host', 'manage_options', 'yash_sermon_settings', 'yash_sermon_options_page' );
}
add_action( 'admin_menu', 'yash_sermon_add_options_page' );

// Sermon Latest shortcode
function yash_sermon_latest_shortcode() {
    $yash_sermon_user_name = get_option( 'yash_sermon_user_name' );
    return '<div id="yash-embed-sermon-latest" data-url="https://yetanothersermon.host/_/' . esc_html( $yash_sermon_user_name ) . '/embed_v2/sermon/latest/"></div>
    <script src="https://yetanothersermon.host/js/embed.js" defer data-id="yash-embed-sermon-latest"></script>';
}
add_shortcode( 'sermon-latest', 'yash_sermon_latest_shortcode' );

// Sermon Page shortcode
function yash_sermon_page_shortcode() {
    $yash_sermon_user_name = get_option( 'yash_sermon_user_name' );
    return '<div id="yash-embed-sermons" data-url="https://yetanothersermon.host/_/' . esc_html( $yash_sermon_user_name ) . '/embed_v2/"></div>
    <script src="https://yetanothersermon.host/js/embed.js" defer data-id="yash-embed-sermons"></script>';
}
add_shortcode( 'sermon-page', 'yash_sermon_page_shortcode' );
