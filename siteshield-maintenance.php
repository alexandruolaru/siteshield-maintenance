<?php
/*
Plugin Name: SiteShield Maintenance Mode
Description: A custom maintenance mode plugin with flexible settings.
Version: 1.0
Author: Alexandru Olaru
Author URI: https://github.com/alexandruolaru/
*/

// Activation hook to initialize options
register_activation_hook(__FILE__, 'siteshield_maintenance_activate');
function siteshield_maintenance_activate() {
    add_option('siteshield_maintenance_active', 0);
    add_option('siteshield_maintenance_title', __('Site is under maintenance', 'siteshield-maintenance'));
    add_option('siteshield_maintenance_content', __('<h1>We will be back soon!</h1>', 'siteshield-maintenance'));
    add_option('siteshield_maintenance_allowed_roles', ['administrator']); // Admin role preselected
}

// Load text domain for translations
function siteshield_maintenance_load_textdomain() {
    load_plugin_textdomain('siteshield-maintenance', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'siteshield_maintenance_load_textdomain');

// Add settings page in WordPress admin
add_action('admin_menu', 'siteshield_maintenance_menu');
function siteshield_maintenance_menu() {
    add_options_page(
        __('Maintenance Settings', 'siteshield-maintenance'),
        __('SiteShield Maintenance Mode', 'siteshield-maintenance'),
        'manage_options',
        'siteshield-maintenance',
        'siteshield_maintenance_admin_page'
    );
}

// Include the admin page file
require_once(plugin_dir_path(__FILE__) . 'admin-page.php');

// Check if maintenance mode is active
add_action('template_redirect', 'siteshield_maintenance_check');
function siteshield_maintenance_check() {
    if (get_option('siteshield_maintenance_active')) {
        $current_user = wp_get_current_user();
        $allowed_roles = get_option('siteshield_maintenance_allowed_roles', []);

        // Always allow administrators
        if (in_array('administrator', $current_user->roles)) {
            return;
        }

        // Check if current user has any allowed role
        foreach ($current_user->roles as $role) {
            if (in_array($role, $allowed_roles)) {
                return;
            }
        }

        // Display the maintenance page
        wp_die(get_option('siteshield_maintenance_content'), get_option('siteshield_maintenance_title'));
    }
}

// Add a 'Settings' link on the plugin page
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'siteshield_maintenance_add_settings_link');
function siteshield_maintenance_add_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=siteshield-maintenance">' . __('Settings', 'siteshield-maintenance') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
