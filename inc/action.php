<?php
/**
 * 加载主题样式
 *
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since 1.0.0
 */

add_action('wp_enqueue_scripts', 'Tangyuan_load_styles');

function Tangyuan_load_styles()
{
    wp_enqueue_style('dafault-style', get_stylesheet_uri(), false, THEME_VERSION, 'all');

    $filepath = get_stylesheet_directory() . '/assets/manifest.json';
    if (file_exists($filepath)) {
        $current_assets = json_decode(file_get_contents($filepath), true);
    }

    if (isset($current_assets['/styles/tangyuan.css'])) {
        wp_enqueue_style('tangyuan-style', get_stylesheet_directory_uri() . '/assets' . $current_assets['/styles/tangyuan.css'], array(), null);
    }

}


/**
 * 加载主题脚本
 *
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since 1.0.0
 */

add_action('wp_enqueue_scripts', 'Tangyuan_load_scripts');

function Tangyuan_load_scripts()
{
    wp_enqueue_script('jquery');

    $filepath = get_stylesheet_directory() . '/assets/manifest.json';
    if (file_exists($filepath)) {
        $current_assets = json_decode(file_get_contents($filepath), true);
    }


    if (isset($current_assets['/scripts/manifest.js'])) {
        wp_enqueue_script('tangyuan-manifest', get_stylesheet_directory_uri() . '/assets' . $current_assets['/scripts/manifest.js'], array(), null);
    }

    if (isset($current_assets['/scripts/vendor.js'])) {
        wp_enqueue_script('tangyuan-vendor', get_stylesheet_directory_uri() . '/assets' . $current_assets['/scripts/vendor.js'], array(), null);
    }

    if (isset($current_assets['/scripts/tangyuan.js'])) {
        wp_enqueue_script('tangyuan-script', get_stylesheet_directory_uri() . '/assets' . $current_assets['/scripts/tangyuan.js'], array(), null);
    }

    if (is_singular()) {
        wp_enqueue_script("comment-reply");
    }
}
