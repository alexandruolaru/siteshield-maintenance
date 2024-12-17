# SiteShield Maintenance Mode

**SiteShield Maintenance Mode** is a custom WordPress plugin designed to enable easy and flexible maintenance mode management for your website. It allows you to set a custom maintenance page title, HTML content, and selectively grant access to specific user roles while the site is under maintenance.

## Features

- **Custom Maintenance Page Title**: Set your own title for the maintenance mode page.
- **Custom HTML Content**: Use an intuitive WordPress HTML editor (TinyMCE) to design and customize the content of your maintenance page.
- **User Role Access Control**: Grant specific user roles access to the site even when the maintenance mode is active. The administrator role has default access.
- **Easy Maintenance Mode Toggle**: Enable or disable maintenance mode from a simple checkbox in the admin settings.

## Requirements

- **WordPress Version**: 5.0 or higher
- **PHP Version**: 7.4 or higher

## Installation

1. Download or clone the repository to your WordPress plugins folder:
    ```bash
    git clone https://github.com/alexandruolaru/siteshield-maintenance.git wp-content/plugins/siteshield-maintenance
    ```
2. In your WordPress admin dashboard, navigate to **Plugins** and activate **SiteShield Maintenance Mode**.

## Usage

1. Go to **Settings** > **SiteShield Maintenance Mode** in your WordPress admin dashboard.
2. Set the title and content for the maintenance page.
3. Select the user roles that should be allowed to bypass maintenance mode (administrators are always allowed).
4. Check the box to enable or disable maintenance mode.

## License

This project is licensed under the MIT License. See the [LICENSE](license.txt) file for details.


