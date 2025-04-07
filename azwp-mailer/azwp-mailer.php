<?php
/**
 * Plugin Name: AZ's WP SMTP Mailer
 * Description: A plugin to configure SMTP settings for sending emails in WordPress.
 * Version: 0.2.0
 * Author: Arthur Z.
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Add menu page for SMTP settings.
add_action('admin_menu', 'azwp_mailer_add_admin_menu');
add_action('admin_init', 'azwp_mailer_settings_init');

function azwp_mailer_add_admin_menu() {
    add_options_page('AZ\'s WP SMTP Mailer', 'AZWP SMTP Mailer', 'manage_options', 'azwp_mailer', 'azwp_mailer_options_page');
}

function azwp_mailer_settings_init() {
    register_setting('pluginPage', 'azwp_mailer_settings', 'azwp_mailer_validate_settings');

    add_settings_section(
        'azwp_mailer_pluginPage_section',
        __('SMTP Settings', 'azwp_mailer'),
        'azwp_mailer_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'azwp_mailer_smtp_host',
        __('SMTP Server Address', 'azwp_mailer'),
        'azwp_mailer_smtp_host_render',
        'pluginPage',
        'azwp_mailer_pluginPage_section'
    );

    add_settings_field(
        'azwp_mailer_encryption_method',
        __('Encryption Method', 'azwp_mailer'),
        'azwp_mailer_encryption_method_render',
        'pluginPage',
        'azwp_mailer_pluginPage_section'
    );

    add_settings_field(
        'azwp_mailer_smtp_port',
        __('SMTP Port', 'azwp_mailer'),
        'azwp_mailer_smtp_port_render',
        'pluginPage',
        'azwp_mailer_pluginPage_section'
    );

    add_settings_field(
        'azwp_mailer_smtp_username',
        __('SMTP Username', 'azwp_mailer'),
        'azwp_mailer_smtp_username_render',
        'pluginPage',
        'azwp_mailer_pluginPage_section'
    );

    add_settings_field(
        'azwp_mailer_smtp_password',
        __('SMTP Password', 'azwp_mailer'),
        'azwp_mailer_smtp_password_render',
        'pluginPage',
        'azwp_mailer_pluginPage_section'
    );

    add_settings_field(
        'azwp_mailer_from_name',
        __('From Name', 'azwp_mailer'),
        'azwp_mailer_from_name_render',
        'pluginPage',
        'azwp_mailer_pluginPage_section'
    );

    add_settings_field(
        'azwp_mailer_from_email',
        __('From Email Address', 'azwp_mailer'),
        'azwp_mailer_from_email_render',
        'pluginPage',
        'azwp_mailer_pluginPage_section'
    );
}

// Input rendering functions
function azwp_mailer_smtp_host_render() {
    $options = get_option('azwp_mailer_settings');
    ?>
    <input type='text' name='azwp_mailer_settings[azwp_mailer_smtp_host]' value='<?php echo esc_attr($options['azwp_mailer_smtp_host']); ?>' required>
    <?php
}

function azwp_mailer_encryption_method_render() {
    $options = get_option('azwp_mailer_settings');
    ?>
    <select name='azwp_mailer_settings[azwp_mailer_encryption_method]'>
        <option value='none' <?php selected($options['azwp_mailer_encryption_method'], 'none'); ?>>None</option>
        <option value='ssl' <?php selected($options['azwp_mailer_encryption_method'], 'ssl'); ?>>SSL</option>
        <option value='tls' <?php selected($options['azwp_mailer_encryption_method'], 'tls'); ?>>TLS</option>
    </select>
    <?php
}

function azwp_mailer_smtp_port_render() {
    $options = get_option('azwp_mailer_settings');
    ?>
    <input type='text' name='azwp_mailer_settings[azwp_mailer_smtp_port]' value='<?php echo esc_attr($options['azwp_mailer_smtp_port']); ?>' required>
    <?php
}

function azwp_mailer_smtp_username_render() {
    $options = get_option('azwp_mailer_settings');
    ?>
    <input type='text' name='azwp_mailer_settings[azwp_mailer_smtp_username]' value='<?php echo esc_attr($options['azwp_mailer_smtp_username']); ?>' required>
    <?php
}

function azwp_mailer_smtp_password_render() {
    $options = get_option('azwp_mailer_settings');
    ?>
    <input type='password' name='azwp_mailer_settings[azwp_mailer_smtp_password]' value='<?php echo esc_attr($options['azwp_mailer_smtp_password']); ?>' required>
    <?php
}

function azwp_mailer_from_name_render() {
    $options = get_option('azwp_mailer_settings');
    ?>
    <input type='text' name='azwp_mailer_settings[azwp_mailer_from_name]' value='<?php echo esc_attr($options['azwp_mailer_from_name']); ?>' required>
    <?php
}

function azwp_mailer_from_email_render() {
    $options = get_option('azwp_mailer_settings');
    ?>
    <input type='email' name='azwp_mailer_settings[azwp_mailer_from_email]' value='<?php echo esc_attr($options['azwp_mailer_from_email']); ?>' required>
    <?php
}

// Validate required fields
function azwp_mailer_validate_settings($input) {
    $errors = [];

    $required_fields = [
        'azwp_mailer_smtp_host'    => 'SMTP Server Address',
        'azwp_mailer_smtp_port'    => 'SMTP Port',
        'azwp_mailer_smtp_username'=> 'SMTP Username',
        'azwp_mailer_smtp_password'=> 'SMTP Password',
        'azwp_mailer_from_name'    => 'From Name',
        'azwp_mailer_from_email'   => 'From Email Address',
    ];

    foreach ($required_fields as $key => $label) {
        if (empty($input[$key])) {
            $errors[] = sprintf(__('%s is required to ensure proper email delivery.', 'azwp_mailer'), $label);
        }
    }

    if (!empty($errors)) {
        add_settings_error('azwp_mailer_settings', 'settings_updated', implode('<br>', $errors), 'error');
        return get_option('azwp_mailer_settings'); // Return existing settings if validation fails.
    }

    return $input;
}

function azwp_mailer_settings_section_callback() {
    echo __('Configure your outgoing mail server settings below. These settings will apply to all emails sent from your WordPress site.', 'azwp_mailer');
}

function azwp_mailer_options_page() {
    ?>
    <div class="wrap">
        <h2>AZ's WordPress SMTP Mailer Configuration</h2>
        <h2 class="nav-tab-wrapper">
            <a href="?page=azwp_mailer&tab=smtp_config" class="nav-tab <?php echo azwp_mailer_get_active_tab('smtp_config'); ?>">Mail Server Settings</a>
            <a href="?page=azwp_mailer&tab=other_settings" class="nav-tab <?php echo azwp_mailer_get_active_tab('other_settings'); ?>">Other Options</a>
        </h2>
        <form action='options.php' method='post'>
            <?php
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'smtp_config';

            if ($active_tab === 'smtp_config') {
                settings_fields('pluginPage');
                do_settings_sections('pluginPage');
            } else {
                echo '<p>' . __('Other settings can be configured here.', 'azwp_mailer') . '</p>';
                azwp_mailer_render_remove_plugin_section();
            }

            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function azwp_mailer_render_remove_plugin_section() {
    ?>
    <h3><?php _e('Plugin Removal Options', 'azwp_mailer'); ?></h3>
    <p><?php _e('This action will permanently delete all SMTP settings and deactivate the plugin.', 'azwp_mailer'); ?></p>
    <p><?php _e('Your email configuration will revert to WordPress defaults.', 'azwp_mailer'); ?></p>

    <!-- Button that opens the modal -->
    <button type="button" class="button azwp-button-danger-outline" id="azwp-remove-trigger">
        <?php _e('Delete Settings & Deactivate', 'azwp_mailer'); ?>
    </button>

    <!-- Modal -->
    <div id="azwp-remove-modal" class="azwp-modal-overlay">
        <div class="azwp-modal-content">
            <form method="post">
                <?php wp_nonce_field('azwp_mailer_remove_plugin', 'azwp_mailer_remove_plugin_nonce'); ?>
                <input type="hidden" name="azwp_mailer_remove_plugin_action" value="remove_plugin">

                <h2><?php _e('Confirm', 'azwp_mailer'); ?></h2>
                <p><?php _e('Are you sure you want to remove all SMTP settings? This action cannot be undone and may affect email delivery on your site.', 'azwp_mailer'); ?></p>
                <p><?php _e('After configuration data is deleted, the plugin will be automatically deactivated. You can then remove it from the Plugins page.', 'azwp_mailer'); ?></p>

                <div class="azwp-modal-buttons">
                    <!-- Cancel: primary WP blue -->
                    <button type="button" class="button button-primary" id="azwp-cancel-remove">
                        <?php _e('Cancel', 'azwp_mailer'); ?>
                    </button>

                    <!-- Confirm: custom hollow red -->
                    <button type="submit" class="button azwp-button-danger-outline">
                        <?php _e('Delete Settings & Deactivate', 'azwp_mailer'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .azwp-modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }

        .azwp-modal-overlay.show {
            display: flex;
        }

        .azwp-modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .azwp-modal-content h2 {
            margin-top: 0;
        }

        .azwp-modal-buttons {
            margin-top: 25px;
            text-align: right;
        }

        .azwp-modal-buttons .button {
            margin-left: 10px;
        }

        .azwp-button-danger-outline {
            background: transparent;
            color: #b32d2e !important;
            border: 1px solid #b32d2e !important;
            box-shadow: none;
        }

        .azwp-button-danger-outline:hover {
            background: #fbeaea;
            color: #aa0000;
            border-color: #aa0000;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('azwp-remove-modal');
            const openBtn = document.getElementById('azwp-remove-trigger');
            const cancelBtn = document.getElementById('azwp-cancel-remove');

            openBtn.addEventListener('click', function () {
                modal.classList.add('show');
            });

            cancelBtn.addEventListener('click', function () {
                modal.classList.remove('show');
            });
        });
    </script>
    <?php
}

// Handle plugin removal
function azwp_mailer_handle_remove_plugin() {
    if (
        isset($_POST['azwp_mailer_remove_plugin_action']) &&
        $_POST['azwp_mailer_remove_plugin_action'] === 'remove_plugin' &&
        check_admin_referer('azwp_mailer_remove_plugin', 'azwp_mailer_remove_plugin_nonce')
    ) {
        // Delete plugin options
        delete_option('azwp_mailer_settings');

        // Deactivate the plugin
        deactivate_plugins(plugin_basename(__FILE__));

        // Redirect to plugins page with a success message
        wp_redirect(admin_url('plugins.php?deactivate=true&removed=true'));
        exit;
    }
}
add_action('admin_init', 'azwp_mailer_handle_remove_plugin');

function azwp_mailer_get_active_tab($tab_name) {
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'smtp_config';
    return $active_tab === $tab_name ? 'nav-tab-active' : '';
}

// Force 'From' Name and Email for all outgoing emails (including core emails)
function azwp_mailer_force_from_email($original_email) {
    $options = get_option('azwp_mailer_settings');
    return $options['azwp_mailer_from_email'];
}
add_filter('wp_mail_from', 'azwp_mailer_force_from_email');

function azwp_mailer_force_from_name($original_name) {
    $options = get_option('azwp_mailer_settings');
    return $options['azwp_mailer_from_name'];
}
add_filter('wp_mail_from_name', 'azwp_mailer_force_from_name');

// Set up the mailer using the configured SMTP settings.
function azwp_mailer_configure_mailer($phpmailer) {
    $options = get_option('azwp_mailer_settings');

    $phpmailer->isSMTP();
    $phpmailer->Host = $options['azwp_mailer_smtp_host'];
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = $options['azwp_mailer_smtp_port'];
    $phpmailer->Username = $options['azwp_mailer_smtp_username'];
    $phpmailer->Password = $options['azwp_mailer_smtp_password'];
    $phpmailer->SMTPSecure = ($options['azwp_mailer_encryption_method'] !== 'none') ? $options['azwp_mailer_encryption_method'] : '';

    // Always force 'From' email and name to be set.
    $phpmailer->setFrom($options['azwp_mailer_from_email'], $options['azwp_mailer_from_name']);

    // Enable SMTP debugging for testing
    $phpmailer->SMTPDebug = 0; // 0 = Off, 1 = Commands, 2 = Data
    $phpmailer->Debugoutput = 'error_log';
}
add_action('phpmailer_init', 'azwp_mailer_configure_mailer');

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'azwp_mailer_add_settings_link');

function azwp_mailer_add_settings_link($links) {
    $settings_url = admin_url('options-general.php?page=azwp_mailer');
    $settings_link = '<a href="' . esc_url($settings_url) . '">' . __('Settings', 'azwp_mailer') . '</a>';
    array_unshift($links, $settings_link); // add it to the beginning

    return $links;
}

require 'update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/arisdla/azwp-mailer/releases/download/latest/azwp-mailer.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'azwp-mailer' //Unique plugin slug (used as the option name and prefix for other internal identifiers
);
