<?php
/**
 * Plugin Name: AZ's WP SMTP Mailer
 * Description: A plugin to configure SMTP settings for sending emails in WordPress.
 * Version: 0.1.1
 * Author: Aris Z.
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Add menu page for SMTP settings.
add_action('admin_menu', 'azwp_mailer_add_admin_menu');
add_action('admin_init', 'azwp_mailer_settings_init');

function azwp_mailer_add_admin_menu() {
    add_options_page('Mailer Settings', 'Mailer Settings', 'manage_options', 'azwp_mailer', 'azwp_mailer_options_page');
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
        __('SMTP Host', 'azwp_mailer'),
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
        'azwp_mailer_smtp_host'    => 'SMTP Host',
        'azwp_mailer_smtp_port'    => 'SMTP Port',
        'azwp_mailer_smtp_username'=> 'SMTP Username',
        'azwp_mailer_smtp_password'=> 'SMTP Password',
        'azwp_mailer_from_name'    => 'From Name',
        'azwp_mailer_from_email'   => 'From Email Address',
    ];

    foreach ($required_fields as $key => $label) {
        if (empty($input[$key])) {
            $errors[] = sprintf(__('%s is required.', 'azwp_mailer'), $label);
        }
    }

    if (!empty($errors)) {
        add_settings_error('azwp_mailer_settings', 'settings_updated', implode('<br>', $errors), 'error');
        return get_option('azwp_mailer_settings'); // Return existing settings if validation fails.
    }

    return $input;
}

function azwp_mailer_settings_section_callback() {
    echo __('Configure your SMTP settings below.', 'azwp_mailer');
}

function azwp_mailer_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>AZ's WP SMTP Mailer</h2>
        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
        submit_button();
        ?>
    </form>
    <?php
}

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

    // Ensure 'From' email and name are properly set
    if (!empty($options['azwp_mailer_from_email']) && !empty($options['azwp_mailer_from_name'])) {
        $phpmailer->setFrom($options['azwp_mailer_from_email'], $options['azwp_mailer_from_name']);
    } elseif (!empty($options['azwp_mailer_from_email'])) {
        $phpmailer->setFrom($options['azwp_mailer_from_email']);
    }

    // Enable SMTP debugging for testing
    $phpmailer->SMTPDebug = 0; // 0 = Off, 1 = Commands, 2 = Data
    $phpmailer->Debugoutput = 'error_log';
}
add_action('phpmailer_init', 'azwp_mailer_configure_mailer');

