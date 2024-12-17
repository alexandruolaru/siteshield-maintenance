<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

delete_option('siteshield_maintenance_active');
delete_option('siteshield_maintenance_title');
delete_option('siteshield_maintenance_content');
delete_option('siteshield_maintenance_allowed_roles');
