<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Asian Legacy Library Search Plugin
 * Description:       Add Shortcode to wordpress that enqueues and create the Asian Legacy Library Search App
 * Version:           0.2.7
 * Author:            Splice Digital
 */

define( 'ALLP_version', '0.2.7' );

/**
 * @description: Add shortcode to use in wordpress and associate to appropriate callback/content
 */
function registerSearchModuleShortcode(){

    add_shortcode("library", "searchLibraryModule");
    //ex. [library]

} add_action( "init", "registerSearchModuleShortcode" );

/**
 * @description: Callback to run when called, creates the HTML for the Asian Legacy Library Search App to hook into
 * @param array $atts
 * @return String
 */
function searchLibraryModule ( $atts ){
//    $atts = shortcode_atts(array(
//    ), $atts);

    $output = "<noscript>You need to enable JavaScript to run this app.</noscript>";
    $output .= "<div id='root'></div>";

    return $output;
}

/**
 * @description: Enqueue the Asian Legacy Library Search App Scripts and Styles to the different pages who makes a call to the library shortcode (registerSearchModuleShortcode) only.
 *  When updating the Asian Legacy Library Search App, ensure to change the build numbers of the scripts and style files and to increment the ALLP_version constant appropriately
 */
function enqueuesearchLibraryModuleScripts(){

    global $post;

    if(has_shortcode( $post->post_content, "library")){

        wp_enqueue_script("searchLibraryModuleMainScript",  plugin_dir_url( __FILE__ ) . "App/js/main.1f7a7d65.chunk.js",[], ALLP_version, true);
        wp_enqueue_script("searchLibraryModuleChunkScript",  plugin_dir_url( __FILE__ ) . "App/js/2.2d417fd9.chunk.js",[], ALLP_version, true);
        wp_enqueue_script("searchLibraryModuleRuntimeScript",  plugin_dir_url( __FILE__ ) . "App/js/runtime-main.26fbd41c.js",[], ALLP_version, true);
        wp_enqueue_style( "searchLibraryModuleStyle",  plugin_dir_url( __FILE__ ) . "App/css/main.b861af14.chunk.css", [], ALLP_version );

    }

} add_action('wp_enqueue_scripts', 'enqueuesearchLibraryModuleScripts');