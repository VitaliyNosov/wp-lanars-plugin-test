<p align="center">
    <img width="180" height="180"  src="https://i.ibb.co/MgLwYwP/Wordpress-logo-8-1.png">
</p> 

# Test WordPress Plugin Development
<p>
    <img src="https://i.ibb.co/7b7s0vJ/plugin-test-baner.png"alt="Baner">
</p>

> In the folder: site-dulicator find the entire site with the plugin. It can be deployed and tested to make sure it works.

### Start:

```php 

<?php

/**
 * Plugin Name:       Plugin Test
 * Plugin URI:        https://gifted-fermat-f7e371.netlify.app/
 * Description:       Plugin test for company LANARS
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Vitaliy Nosov
 * Author URI:        https://www.linkedin.com/in/vitaliy-nosov-5543a8173/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       plugin-test
 * Domain Path:       /languages
 */


// Basic plugin protection:

if( !defined('ABSPATH')){
    die;
}

// An alternative to this notation, you can use any:

// defined('ABSPATH') || exit;

// Display function in the admin panel menu

function plugin_test_show_item(){
    add_menu_page(
        esc_html__( 'Welcome to plugin page', 'plugin-test'),
        esc_html__('Plugin Test', 'plugin-test'),
        'manage_options',
        'plugin-test-options',
        'plugin_test_content',
        'dashicons-admin-plugins',
        6
    );
}

add_action('admin_menu','plugin_test_show_item');


// The function of displaying the plugin page in the admin panel

function plugin_test_content(){
    echo '
    <div class="content">
        <div class="border">
        <div class="info__text">
            <p>This plugin is a test development. Check the competence of the developer for the company:<img src="https://lanars.com/static/logo_icon.svg"></p> 
            <p>To make sure the plugin works, copy the shortcode and paste it on the page in the editor.</p>
        </div>
        </div>
            <div class="text">
                <span>Copy shortcode:</span>
            <div class="text__copy_link">[post-test-shortcode]</div>
        </div>
            <div class="copy__link_mess">Copied to clipboard</div>
        </div> ';
    
}

// Style and Script Registration Function

function plugin_register_assets(){
    wp_register_style('plugin_test_styles', plugins_url('assets/css/plugin-style.css', __FILE__));
    wp_register_script('plugin_test_jquery', plugins_url('assets/js/jquery.min.js', __FILE__));
    wp_register_script('plugin_test_scripts', plugins_url('assets/js/admin.js', __FILE__));
}

add_action('admin_enqueue_scripts','plugin_register_assets');

// The function of connecting styles and scripts

function plugin_load_assets($hook){
    if($hook != 'toplevel_page_plugin-test-options'){
        return;
    }
    wp_enqueue_style('plugin_test_styles');
    wp_enqueue_script('plugin_test_scripts');

    // If you need to use styles or scripts that are already built into WordPress: 

    // wp_enqueue_script('jquery-ui-tabs');


}

add_action('admin_enqueue_scripts','plugin_load_assets');

// Connecting styles for display on the frontend

function plugin_test_scripts() {
	wp_enqueue_style( 'style', plugins_url('assets/css/plugin-style.css', __FILE__) );
	wp_register_script('plugin_test_jquery', plugins_url('assets/js/jquery.min.js', __FILE__));
    wp_register_script('plugin_test_scripts', plugins_url('assets/js/admin.js', __FILE__));	
}

add_action( 'wp_enqueue_scripts', 'plugin_test_scripts' );

// We connect our shortcode:

require_once( dirname(__FILE__) . '/post-test-shortcode.php');

```







