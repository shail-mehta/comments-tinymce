<?php
/**
 * Plugin Name:       Comment Form Editor with TinyMCE
 * Plugin URI:        https://wordpress.org/plugins/comments-tinymce
 * Description:       Users can easily add TinyMCE Editor in Comment Form in just one click.
 * Version:           1.0.8
 * Author:            Shail Mehta
 * Author URI:        https://profiles.wordpress.org/shailu25
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       comments-tinymce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COMMENTS_TINYMCE_VERSION', '1.0.8' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-comments-tinymce-activator.php
 */
function activate_comments_tinymce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-comments-tinymce-activator.php';
	Comments_Tinymce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-comments-tinymce-deactivator.php
 */
function deactivate_comments_tinymce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-comments-tinymce-deactivator.php';
	Comments_Tinymce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_comments_tinymce' );
register_deactivation_hook( __FILE__, 'deactivate_comments_tinymce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-comments-tinymce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_comments_tinymce() {

	$plugin = new Comments_Tinymce();
	$plugin->run();

}
run_comments_tinymce();
