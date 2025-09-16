<?php 
/*
 * Plugin Name:       WP Job Portal
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Adds a job portal system to WordPress with custom job listings, frontend display, and application management.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Kabeer Ali Alvi
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wp-job-portal
 */


if (! defined('ABSPATH')) {
    exit; // Exit if access directly
}

if (! defined('JOB_PORTAL_VERSION')) {
    define('JOB_PORTAL_VERSION' , '1.0.0');
}

if (! defined('JOB_PORTAL_DIR_PATH')){
    define('JOB_PORTAL_DIR_PATH', plugin_dir_path(__FILE__));
}

if (! defined ('JOB_PORTAL_DIR_URL')) {
    define('JOB_PORTAL_DIR_URL' , plugin_dir_url(__FILE__));
}

if (! defined('JOB_PORTAL_DB_VERSION')) {
    define('JOB_PORTAL_DB_VERSION' , '1.0.0');
}







require_once JOB_PORTAL_DIR_PATH . 'inc/plugin.php';

