<?php

/**
 *
 * 注册主题定制器
 * @since 1.0.0
 * @version 1.0
 */

add_action('customize_register', 'tangyuan_theme_customize');

 function tangyuan_theme_customize($wp_customize)
 {
     $site_title        = $wp_customize->get_section('title_tagline');
     $site_title->panel = 'Tangyuan_panel';
     $site_title->priority = 1;
    
     $site_background_image        = $wp_customize->get_section('background_image');
     $site_background_image->panel = 'null';

     $site_background_image        = $wp_customize->get_section('colors');
     $site_background_image->panel = 'null';

     $site_background_image        = $wp_customize->get_control('background_image');
     $site_background_image->section = 'tangyuan_layout';
     $site_background_image->priority = 4;

     $site_page        = $wp_customize->get_section('static_front_page');
     $site_page->panel = 'Tangyuan_panel';
     $site_page->priority = 2;

     $wp_customize->get_control('header_image')->section = 'tangyuan_layout';

     // 添加移动设备下图标图像最大宽度的设置。
     $wp_customize->add_setting('tangyuan_mobile_logo_size', array(
        'default'           => '',
        'sanitize_callback' => '',
        'transport'      => 'refresh',
    ));
 
     $wp_customize->add_control('tangyuan_mobile_logo_size', array(
        'label'    => __('Mobile Logo Image Maximum Width', 'tangyuan'),
        'section'  => 'title_tagline',
        'priority' => 8,
        'settings' => 'tangyuan_mobile_logo_size',
        'type'     => 'number',
        'input_attrs' => array(
            'min'      => 0,
            'max'      => 1000,
            'step' => 1
        ),
    ));

     //添加平板电脑下图标最大宽度的设置。
     $wp_customize->add_setting('tangyuan_tablet_logo_size', array(
        'default'           => '',
        'sanitize_callback' => '',
        'transport'      => 'refresh',
    ));
 
     $wp_customize->add_control('tangyuan_tablet_logo_size', array(
        'label'    => __('Tablet Logo Image Maximum Width', 'tangyuan'),
        'section'  => 'title_tagline',
        'priority' => 8,
        'settings' => 'tangyuan_tablet_logo_size',
        'type'     => 'number',
        'input_attrs' => array(
            'min'      => 0,
            'max'      => 1000,
            'step' => 1
        ),
    ));

     //添加桌面下图标最大宽度的设置。
     $wp_customize->add_setting('tangyuan_desktop_logo_size', array(
        'default'           => '',
        'sanitize_callback' => '',
        'transport'      => 'refresh',
    ));
 
     $wp_customize->add_control('tangyuan_desktop_logo_size', array(
        'label'    => __('Desktop Logo Image Maximum Width', 'tangyuan'),
        'section'  => 'title_tagline',
        'priority' => 8,
        'settings' => 'tangyuan_desktop_logo_size',
        'type'     => 'number',
        'input_attrs' => array(
            'min'      => 0,
            'max'      => 1000,
            'step' => 1
        ),
    ));

     $wp_customize->add_panel('Tangyuan_panel', array(
        'priority' 			=> 4,
        'theme_supports' 	=> '',
        'title'    => __('Theme Settings', 'tangyuan'),
    ));

     $wp_customize->add_section('tangyuan_layout', array(
        'title'    => __('Background, Typesetting And Text.', 'tangyuan'),
        'panel'=>'Tangyuan_panel',
        'priority' => 3,
    ));

     // 添加文章摘要文本长度的设置。
     $wp_customize->add_setting('tangyuan_excerpt_length', array(
        'default'           => 120,
        'sanitize_callback' => '',
        'transport'      => 'refresh',
    ));
 
     $wp_customize->add_control('tangyuan_excerpt_length', array(
        'label'    => __('Excerpt Length', 'tangyuan'),
        'section'  => 'tangyuan_layout',
        'settings' => 'tangyuan_excerpt_length',
        'type'     => 'number'
    ));

     $wp_customize->selective_refresh->add_partial('tangyuan_excerpt_length', array(
        'selector'            => '.article .article-text'
    ));

     // 添加文章列表媒体位置的设置。
     $wp_customize->add_setting('article_media_position_at', array(
        'default'           => 'none',
        'sanitize_callback' => '',
        'transport'      => 'refresh',
    ));
 
     $wp_customize->add_control('article_media_position_at', array(
        'label'    => __('Media Position', 'tangyuan'),
        'section'  => 'tangyuan_layout',
        'settings' => 'article_media_position_at',
        'type'     => 'select',
        'choices'  => array(
            'none' => __('Hide', 'tangyuan'),
            'article-media--block' => __('Block', 'tangyuan'),
            'article-media--at-left' => __('Leftward', 'tangyuan'),
            'article-media--at-right' => __('Rightward', 'tangyuan'),
        )
    ));

     $wp_customize->selective_refresh->add_partial('article_media_position_at', array(
        'selector'            => 'article.article'
    ));

     //添加回复表单模块的标题的设置。
     $wp_customize->add_setting('tangyuan_reply_title', array(
        'default'           => __('Leave a Reply', 'tangyuan')
    ));
     
     $wp_customize->add_control('tangyuan_reply_title', array(
        'label'    => __('Reply Form Title', 'tangyuan'),
        'section'  => 'tangyuan_layout',
        'settings' => 'tangyuan_reply_title',
        'type'     => 'text'
    ));

     $wp_customize->selective_refresh->add_partial('tangyuan_reply_title', array(
        'selector'            => '#reply-title'
    ));

     //添加回复表单回复按钮文本的设置。
     $wp_customize->add_setting('tangyuan_reply_button_text', array(
        'default'           => __('Post Comment', 'tangyuan')
    ));
     
     $wp_customize->add_control('tangyuan_reply_button_text', array(
        'label'    => __('Reply Form Submit Button Text', 'tangyuan'),
        'section'  => 'tangyuan_layout',
        'settings' => 'tangyuan_reply_button_text',
        'type'     => 'text'
    ));

     $wp_customize->selective_refresh->add_partial('tangyuan_reply_button_text', array(
        'selector'            => '#comment-submit'
    ));
 }


/**
 *
 * 添加标志最大宽度样式
 *
 * @since 1.0.0
 */
function tangyuan_logo_max_width()
{
    if (get_theme_mod('custom_logo')) {
        $mobile_logo_size = get_theme_mod('tangyuan_mobile_logo_size');

        $tablet_logo_size = get_theme_mod('tangyuan_tablet_logo_size');
        
        $desktop_logo_size = get_theme_mod('tangyuan_desktop_logo_size');
        
        $css = '';

        if ($mobile_logo_size) {
            $css.= <<<EOF
            .custom-logo{
                max-width: {$mobile_logo_size}px;
            }
EOF;
        }

        if ($tablet_logo_size) {
            $css.= <<<EOF
            \n
            @media (min-width: 768px) {
                .custom-logo {
                    max-width: {$tablet_logo_size}px;
                }
            }
EOF;
        }
    
        if ($desktop_logo_size) {
            $css.= <<<EOF
            \n
            @media (min-width: 992px){
                .custom-logo{
                    max-width: {$desktop_logo_size}px;
                }
            }
EOF;
        }
        wp_add_inline_style('tangyuan-style', $css);
    }
}
add_action('wp_enqueue_scripts', 'tangyuan_logo_max_width');
