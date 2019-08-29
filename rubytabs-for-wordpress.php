<?php
/**
 * RubyTabs WordPress Plugin
 * @package         RubyTabs
 * @author          HaiBach
 * @link            http://haibach.net/rubytabs
 *
 *
 * Plugin Name:     RubyTabs Insert Scripts
 * Plugin URI:      http://haibach.net/rubytabs
 * Description:     RubyTabs is one of best slider plug-in when integrated touch gestrue swipe, responsive, lazyload....
 * Version:         1.5
 * Author:          HaiBach
 * Author URI:      haibach.net
 * Tested up to:    4.6
 */




/**
 * CHECK FIRST!
 *  + Check plugin have running in wordpress : checking wpinc varible
 *  + Check workpress have upgrading : remove rubytabs loading
 */
if( !defined('WPINC') ) die();
if( defined('WP_INSTALLING') && WP_INSTALLING ) return;







/**
 * ACTIVED & DEACTIVED PLUGIN
 */
/* ACTIVED PLUGIN */
function rt01_activation() {

    $rubytabs = array(
        'info' => array(
                    'version'       => '1.5',
                    'author'        => 'HaiBach',
                    'description'   => 'RubyTabs for wordpress' )
    );

    // Register || update the main options of rubytabs
    update_option('rubytabs', $rubytabs, true);
}

/* DEACTIVED PLUGIN */
function rt01_deactivation() {

    // Remove options
    delete_option('rubytabs');
}

register_activation_hook(__FILE__, 'rt01_activation');
register_deactivation_hook(__FILE__, 'rt01_deactivation');








/**
 * INSERT SCRIPTS & STYLES
 *  + if not show version else version = NULL
 */
function rt01register_scripts() {

    // Varible and shortcut at first
    $version = get_option('rubytabs')['info']['version'];

    wp_register_style('rt01css-core', plugins_url('/ruby/rubytabs.css', __FILE__), array(), $version);

    wp_register_script('rt01js-animate', plugins_url('/ruby/rubyanimate.js', __FILE__), array(), $version);
    wp_register_script('rt01js-header', plugins_url('/ruby/rubytabs.js', __FILE__), array(), $version);
    wp_register_script('rt01js-footer', plugins_url('/ruby/rubytabs.js', __FILE__), array(), $version, true);
}

// INSERT STYLE + SCRIPT INTO FRONTS PAGE OF THEME
function rt01scripts_page_front() {
    global $post;


    // Check object have inherited of WP_Post class
    if( !is_a($post, 'WP_Post') ) return;


    // Continue insert style + script rubytabs
    wp_enqueue_style('rt01css-core');
    wp_enqueue_script('rt01js-animate');
    wp_enqueue_script('rt01js-header');
}

add_action('init', 'rt01register_scripts');
add_action('wp_enqueue_scripts', 'rt01scripts_page_front', 11);
