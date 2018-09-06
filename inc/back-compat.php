<?php

function tangyuan_switch_theme()
{
    switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);

    unset($_GET['activated']);

    add_action('admin_notices', 'tangyuan_upgrade_notice');
}
add_action('after_switch_theme', 'tangyuan_switch_theme');

function tangyuan_upgrade_notice()
{
    $message = sprintf(__('Tangyuan requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'tangyuan'), $GLOBALS['wp_version']);
    printf('<div class="error"><p>%s</p></div>', $message);
}

function tangyuan_customize()
{
    wp_die(
        sprintf(__('Tangyuan requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'tangyuan'), $GLOBALS['wp_version']),
        '',
        array(
            'back_link' => true,
        )
    );
}
add_action('load-customize.php', 'tangyuan_customize');

function tangyuan_preview()
{
    if (isset($_GET['preview'])) {
        wp_die(sprintf(__('Tangyuan requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'tangyuan'), $GLOBALS['wp_version']));
    }
}
add_action('template_redirect', 'tangyuan_preview');
