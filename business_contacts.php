<?php
/*
 
Plugin Name: Business Contacts - Authentic & Verifiable Business Leads
Plugin URI: https://requested.live/wpplugin
Description: We help to fetch verifiable business contacts around the world that could be beneficiary to your business!
Version: 1.0
Author: Requested
Author URI: https://requested.live/
License: GPLv2 or later
Text Domain: business_contacts
}
 
*/
//Declare
define( 'business_contacts', 'Business Contacts' );


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

//Load jQuery
function business_contacts_load_jquery() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {

        //Enqueue
        wp_enqueue_script( 'jquery' );

    }
}
add_action( 'wp_enqueue_scripts', 'business_contacts_load_jquery' );

//Enqueue styles
function business_contacts_styles() {

     wp_enqueue_style( 'business_contacts_stylesheet',  plugin_dir_url( __FILE__ ) . 'css/style.css'); 
     
    wp_enqueue_style( 'business_contacts_core',  plugin_dir_url( __FILE__ ) . 'css/core.css'); 
 
    wp_enqueue_style( 'business_contacts_jquery.dataTables',  plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css'); 

    wp_enqueue_style( 'business_contacts_buttons.dataTables',  plugin_dir_url( __FILE__ ) . 'css/buttons.dataTables.min.css');    

        // Enqueue my scripts. 
    wp_enqueue_script( 'dataTables', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array(), null, true );

    wp_enqueue_script( 'dataTablesButtons', plugin_dir_url( __FILE__ ) . 'js/dataTables.buttons.min.js', array(), null, true );

    wp_enqueue_script( 'business_contacts_bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array(), null, true ); 
     
    wp_enqueue_script( 'business_contacts_jszip', plugin_dir_url( __FILE__ ) . 'js/jszip.min.js', array(), null, true );

    wp_enqueue_script( 'business_contacts_pdfmake', plugin_dir_url( __FILE__ ) . 'js/pdfmake.min.js', array(), null, true );

    wp_enqueue_script( 'business_contacts_vfs_fonts', plugin_dir_url( __FILE__ ) . 'js/vfs_fonts.js', array(), null, true );

    wp_enqueue_script( 'business_contacts_buttons', plugin_dir_url( __FILE__ ) . 'js/buttons.html5.min.js', array(), null, true );

    wp_enqueue_script( 'business_contacts_print', plugin_dir_url( __FILE__ ) . 'js/buttons.print.min.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'business_contacts_styles' );


//Create menu item  
add_action('admin_menu', 'business_contacts_plugin_setup_menu'); 

function business_contacts_plugin_setup_menu(){
    add_menu_page('Business Contacts', 'Business Contacts', 'manage_options', 'business_contacts', 'business_contacts_init', 'dashicons-image-filter', 29 );

    add_submenu_page('business_contacts_my', 'My Contacts', 'Settings', 'manage_options', 'my_contacts', 'business_contacts_mylist_init' ); 
}

//Acton links
function business_contacts_action_links( $links ) {

    $links = array_merge( array(
        '<a href="' . esc_url( admin_url( '/admin.php?page=business_contacts' ) ) . '">' . __( 'Business Contacts', 'textdomain' ) . '</a>',
         '<a href="' . esc_url( admin_url( '/admin.php?page=my_contacts' ) ) . '">' . __( 'My Contacts', 'textdomain' ) . '</a>' 
    ), $links );

    return $links;

}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'business_contacts_action_links' );

  
//Print main page 
function business_contacts_init(){
    include( plugin_dir_path( __FILE__ ) . 'includes/dashboard.php');
}

function business_contacts_mylist_init(){
    include( plugin_dir_path( __FILE__ ) . 'includes/mycontacts.php');
}