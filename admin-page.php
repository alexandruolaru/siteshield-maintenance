<?php

function siteshield_maintenance_admin_page()
{
    $message = '';

    if (isset($_POST['siteshield_maintenance_save'])) {
        update_option('siteshield_maintenance_active', isset($_POST['siteshield_maintenance_active']) ? 1 : 0);
        update_option('siteshield_maintenance_title', sanitize_text_field($_POST['siteshield_maintenance_title']));
        update_option('siteshield_maintenance_content', wp_kses_post($_POST['siteshield_maintenance_content']));

        $allowed_roles = isset($_POST['siteshield_maintenance_allowed_roles']) ? (array)$_POST['siteshield_maintenance_allowed_roles'] : [];
        $allowed_roles[] = 'administrator'; // Always include the administrator role
        update_option('siteshield_maintenance_allowed_roles', $allowed_roles);

        $message = __('Settings saved successfully!', 'siteshield-maintenance');
    }

    // Get all roles
    global $wp_roles;
    $roles = $wp_roles->roles;
    $allowed_roles = get_option('siteshield_maintenance_allowed_roles', []);

?>
    <div class="wrap">
        <h1><?php _e('SiteShield Maintenance Mode Settings', 'siteshield-maintenance'); ?></h1>
        <?php if ($message) : ?>
            <div id="message" class="updated notice is-dismissible">
                <p><?php echo esc_html($message); ?></p>
            </div>
        <?php endif; ?>

        <form method="POST">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Enable Maintenance Mode', 'siteshield-maintenance'); ?></th>
                    <td><input type="checkbox" name="siteshield_maintenance_active" <?php checked(get_option('siteshield_maintenance_active'), 1); ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Maintenance Page Title', 'siteshield-maintenance'); ?></th>
                    <td><input type="text" name="siteshield_maintenance_title" value="<?php echo esc_attr(get_option('siteshield_maintenance_title')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Maintenance Page Content', 'siteshield-maintenance'); ?></th>
                    <td>
                        <?php
                        $content = get_option('siteshield_maintenance_content');
                        wp_editor($content, 'siteshield_maintenance_content');
                        ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Allowed User Roles', 'siteshield-maintenance'); ?></th>
                    <td>
                        <?php foreach ($roles as $role_key => $role) : ?>
                            <label>
                                <input type="checkbox" name="siteshield_maintenance_allowed_roles[]" value="<?php echo esc_attr($role_key); ?>" <?php checked(in_array($role_key, $allowed_roles)); ?>>
                                <?php echo esc_html($role['name']); ?>
                            </label><br>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="siteshield_maintenance_save" class="button-primary" value="<?php _e('Save Changes', 'siteshield-maintenance'); ?>" />
            </p>
        </form>
    </div>
<?php
}
