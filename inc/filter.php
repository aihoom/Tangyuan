<?php

/**
 * 自定义摘要长度.
 *
 * @since 1.0.0
 */
function tangyuan_excerpt_length($length)
{
    $length = (int) (get_theme_mod('tangyuan_excerpt_length', 120));

    return $length;
}

add_filter('excerpt_length', 'tangyuan_excerpt_length');

/**
 * 移除菜单多余的字段.
 *
 * @since 1.0.0
 */
function tangyuan_menu_remove_attributes($attributes)
{
    return is_array($attributes) ? array() : '';
}

function tangyuan_menu_remove_attributes_class($attributes)
{
    $class_in = array(
        'has-child',
        'current-menu-item',
        'current_page_item',
        'menu-item-has-children',
    );
    foreach ($attributes as $key => $value) {
        if (!in_array($value, $class_in)) {
            unset($attributes[$key]);
        }
    }

    return $attributes;
}

add_filter('nav_menu_css_class', 'tangyuan_menu_remove_attributes_class', 100, 1);
add_filter('nav_menu_item_id', 'tangyuan_menu_remove_attributes', 100, 1);

/**
 * 评论加@字样.
 *
 * @since 1.0.0
 */
function tangyuan_comment_add_at($comment_text, $comment = '')
{
    if ($comment->comment_parent > 0) {
        $comment_text = '<div class="at-author"><b class="f-fs20 t-vam">@</b><a class="comment-parent-author-name" href="#comment-'.$comment->comment_parent.'">'.get_comment_author($comment->comment_parent).'</a> </div>'.$comment_text;
    }

    return $comment_text;
}

add_filter('comment_text', 'tangyuan_comment_add_at', 20, 2);
