<?php 

if (! isset($content_width)) {
    $content_width = 830;
}

if (! function_exists('Tangyuan_setup')) :

/**
 * 设置支持功能
 *
 * @since 1.0.0
 */
function Tangyuan_setup()
{
    load_theme_textdomain('tangyuan', get_template_directory() . '/languages');

    add_theme_support('custom-logo');
    add_theme_support('custom-header');
    add_theme_support('post-thumbnails');
    add_theme_support(
        'html5',
        array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
            'caption',
        )
    );
    add_theme_support('title-tag');
    add_theme_support('post-formats', array( 'section','image', 'audio','video','gallery'  ));
    add_filter('pre_option_link_manager_enabled', '__return_true');
    add_theme_support('customize-selective-refresh-widgets');


    register_nav_menus(array(
        'header_menu' => __('Main Menu', 'tangyuan')
    ));


    $starter_content = array(

        'widgets' => array(

            'right-sidebar' => array(
                'search_form' => array('search'),
                'latest_posts' => array('latest-posts', array(
                    'title' => __('Latest Posts', 'tangyuan')
                )),
                'archives' => array('archives'),
                'meta' => array('meta')
            ),

            'footer-widgets-left' => array(
                'text_about_me' => array('text', array(
                    'title' => '',
                    'text' => '
                    <p><img src="https://mousin.cn/themes/Tangyuan/logo.svg" width="150"></p>
                    <p>雾仙亦慕仙，记录生活小点滴，一篇短文、一幅画、一首诗、一首音乐。</p>
                    '
                )),
                'text_social' => array('text', array(
                    'title' => __('Follow Me', 'tangyuan'),
                    'text' => '
                    <div class="widget_nav_menu">
                    <ul class="subnav">
                    <li><a target="_blank" rel="nofollow" href="https://weibo.com"><i icon="weibo,18"></i></a></li>
                    <li><a target="_blank" rel="nofollow" href="https://weixin.com"><i icon="weixin,18"></i></a></li>
                    <li><a target="_blank" rel="nofollow" href="https://qq.com"><i icon="qq,18"></i></a></li>
                    <li><a target="_blank" rel="nofollow" href="https://github.com"><i icon="github-logo, 18"></i></a></li>
                    <li><a target="_blank" rel="nofollow" href="https://youtube.com"><i icon="youtube,18"></i></a></li>
                    <li><a target="_blank" rel="nofollow" href="https://twitter.com"><i icon="twitter,18"></i></a></li>
                    <li><a target="_blank" rel="nofollow" href="https://instagram.com"><i icon="instagram,18"></i></a></li>
                    </ul>
                    </div>
                    '
                )),
                'text_tag' => array('text', array(
                    'title' => '',
                    'text' => '<a href="'.esc_url('https://mousin.cn').'"><kbd class="f-tw" style="color: #fff; background: #000">Theme by Mousin.CN</kbd></a>
                    '
                )),
            ),

            'footer-widgets-center' => array(
                'recent-posts',
            ),
            
            'footer-widgets-right' => array(
                'recent-comments',
            ),

        ),

        'theme_mods' => array(
            'article_media_position_at' => 'none'
        )

    );

    $starter_content = apply_filters('tangyuan_starter_content', $starter_content);

    add_theme_support('starter-content', $starter_content);
}

endif;

add_action('after_setup_theme', 'Tangyuan_setup');



/**
 * 注册主题小工具
 *
 * @since 1.0.0
 */

function Tangyuan_widgets_init()
{
    register_sidebar(array(
        'name'          => __('Right Sidebar', 'tangyuan'),
        'id'            => 'right-sidebar',
        'description'   => __('Add widgets here to appear in your right sidebar.', 'tangyuan'),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Left', 'tangyuan'),
        'id'            => 'footer-widgets-left',
        'description'   => __('Add widgets here to appear in your footer left.', 'tangyuan'),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));


    register_sidebar(array(
        'name'          => __('Footer Center', 'tangyuan'),
        'id'            => 'footer-widgets-center',
        'description'   => __('Add widgets here to appear in your footer center.', 'tangyuan'),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));


    register_sidebar(array(
        'name'          => __('Footer Right', 'tangyuan'),
        'id'            => 'footer-widgets-right',
        'description'   => __('Add widgets here to appear in your footer right.', 'tangyuan'),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'Tangyuan_widgets_init');
