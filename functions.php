<?php

define('THEME_NAME', 'Tangyuan');
define('THEME_AUTHOR', 'Mousin');
define('THEME_VERSION', '1.1.0');

/*
 *  Tangyuan 只工作在Wordpress 4.7或更高版本
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory().'/inc/back-compat.php';
}

/**
 * 初始化.
 */
require_once get_template_directory().'/inc/setup.php';

/**
 * 函数库.
 */
require_once get_template_directory().'/inc/function.php';

/**
 * 过滤器.
 */
require_once get_template_directory().'/inc/filter.php';

/**
 * 动作.
 */
require_once get_template_directory().'/inc/action.php';

/**
 * 主题定制器.
 */
require_once get_template_directory().'/inc/customizer.php';

/**
 * AJAX请求回调.
 */
require_once get_template_directory().'/inc/callback.php';

/**
 * 小工具.
 */
require_once get_template_directory().'/inc/widgets/Tangyuan_Widget_Latest_Posts.php';

/**
 * 分类项图像.
 */
require_once get_template_directory().'/inc/libs/TaxonomyImage.php';

/**
 * 主题版本检测.
 *
 * @since 1.1.0
 */
require get_template_directory().'/inc/libs/plugin-update-checker.php';

Puc_v4_Factory::buildUpdateChecker(
    'https://mousin.cn/themes/Tangyuan/update.json',
    __FILE__,
    'Tangyuan'
);
