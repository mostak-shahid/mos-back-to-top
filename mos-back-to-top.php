<?php
/*
Plugin Name: Mos Back to top
Description: Base of future plugin
Version: 0.0.1
Author: Md. Mostak Shahid
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define MOS_BTT_FILE.
if ( ! defined( 'MOS_BTT_FILE' ) ) {
	define( 'MOS_BTT_FILE', __FILE__ );
}
// Define MOS_BTT_SETTINGS.
if ( ! defined( 'MOS_BTT_SETTINGS' ) ) {
  //define( 'MOS_BTT_SETTINGS', admin_url('/edit.php?post_type=post_type&page=plugin_settings') );
	define( 'MOS_BTT_SETTINGS', admin_url('/options-general.php?page=mos_btt_settings') );
}
$mos_btt_option = get_option( 'mos_btt_option' );

$plugin = plugin_basename(MOS_BTT_FILE); 
require_once ( plugin_dir_path( MOS_BTT_FILE ) . 'mos-btt-functions.php' );
require_once ( plugin_dir_path( MOS_BTT_FILE ) . 'mos-btt-settings.php' );


require_once('plugins/update/plugin-update-checker.php');
$pluginInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mos-btt.json',
	MOS_BTT_FILE,
	'mos-btt'
);


register_activation_hook(MOS_BTT_FILE, 'mos_btt_activate');
add_action('admin_init', 'mos_btt_redirect');
 
function mos_btt_activate() {
    $mos_btt_option = array();
    // $mos_btt_option['mos_login_type'] = 'basic';
    // update_option( 'mos_btt_option', $mos_btt_option, false );
    add_option('mos_btt_do_activation_redirect', true);
}
 
function mos_btt_redirect() {
    if (get_option('mos_btt_do_activation_redirect', false)) {
        delete_option('mos_btt_do_activation_redirect');
        if(!isset($_GET['activate-multi'])){
            wp_safe_redirect(MOS_BTT_SETTINGS);
        }
    }
}

// Add settings link on plugin page
function mos_btt_settings_link($links) { 
  $settings_link = '<a href="'.MOS_BTT_SETTINGS.'">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
} 
add_filter("plugin_action_links_$plugin", 'mos_btt_settings_link' );



