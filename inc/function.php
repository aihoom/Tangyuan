<?php

/**
 * 单页获取顶部特色图像.
 *
 * @since 1.1.0
 *
 * @param string|array $classes body元素类
 *
 * @return string html
 */
function featured_image($class = '')
{
    $classes[] = 'featured-image';

    if (!empty($class)) {
        if (!is_array($class)) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge($classes, $class);
    }

    $classes = join(' ', array_unique($classes));

    if ((is_single() || is_page()) && has_post_thumbnail(get_queried_object_id())) :
    echo '<div class="'.$classes.'">';
    the_post_thumbnail(get_queried_object_id(), array('title' => the_title_attribute('echo=0')));
    echo '</div>';
    endif;
}

/**
 * 获取站点图标.
 *
 * @since 1.0.0
 *
 * @return string html 返回logo html
 */
function tangyuan_logo()
{
    $logo = get_theme_mod('custom_logo');
    if ($logo) {
        the_custom_logo(array('itemprop' => 'logo'));
    } else {
        echo '<a class="custom-logo-link" href="'.home_url().'" title="'.get_bloginfo('name').'" itemprop="url" rel="homepage">
            <h1 class="logo" itemprop="headline">'.get_bloginfo('name').'</h1>
        </a>';
    }
}

/**
 * 获取指定数量的分类项下的条目.
 *
 * @param int    $limit 数量
 * @param string $type  类型
 *
 * @since 1.0.0
 *
 * @return string html 返回某文章指定数量的分类项条目
 */
function get_the_terms_limit($type, $limit = 0)
{
    $type = (string) $type;

    $limit = (int) $limit;

    if ($limit < 0) {
        return;
    }

    if (!in_array($type, array('category', 'post_tag'))) {
        return;
    }

    $uncategorized = false;

    if ('category' === $type) {
        $uncategorized = true;
    }

    $post_tags = get_the_terms(0, $type);

    if ($post_tags) {
        $output = '';
        foreach ($post_tags as $key => $term) {
            if ($uncategorized) {
                if ('uncategorized' == $term->slug) {
                    ++$limit;
                    continue;
                }
            }

            if ($key === $limit && 0 != $limit) {
                break;
            }

            $link = get_term_link($term);
            if (is_wp_error($link)) {
                return $link;
            }
            $output .= '<a href="'.esc_url($link).'" rel="tag" itemscope itemtype="http://schema.org/keywords" itemprop="text">'.$term->name.'</a>';
        }

        return $output;
    }
}

/**
 * 返回分类项的封面图片.
 *
 * @param int $term_id 分类id
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_term_image($term_id)
{
    return TaxonomyImage::get_taxonomy_image_url($term_id);
}

/**
 * 获取分类下的文章数量.
 *
 * @param int $term_id 分类id
 *
 * @since 1.0.0
 *
 * @return int 返回某分类下文章总数量
 */
function get_category_post_count($term_id)
{
    // 获取当前分类信息
    $category = get_category($term_id);

    // 当前分类文章数
    $count = (int) $category->count;

    $tax_terms = get_terms('category', array('child_of' => $term_id));

    foreach ($tax_terms as $tax_term) {
        $count += $tax_term->count;
    }

    return $count;
}

/**
 * 默认菜单处理.
 *
 * @since 1.0.0
 *
 * @return string html [<输出所有的链接处理后的HTML>]
 */
function link_to_menu_editor($args)
{
    if (!current_user_can('manage_options')) {
        return;
    }

    extract($args);

    $link = '<a href="'.admin_url('nav-menus.php').'">'.__('Add Menu', 'tangyuan').'</a>';

    if (false !== stripos($items_wrap, '<ul') or false !== stripos($items_wrap, '<ol')) {
        $link = "<li>$link</li>";
    }

    $output = sprintf($items_wrap, $menu_id, $menu_class, $link);
    if (!empty($container)) {
        $output = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ($echo) {
        echo $output;
    }

    return $output;
}

/**
 * 查询友情链接内容.
 *
 * @since 1.0.0
 *
 * @return string html 返回所有的链接处理后的HTML
 */
function get_tangyuan_links()
{
    $linkcats = get_terms('link_category');

    $result = '';
    if (!empty($linkcats)) {
        foreach ($linkcats as $linkcat) {
            $result .= '<h3 class="link-title">'.$linkcat->name.'</h3>';
            if ($linkcat->description) {
                $result .= '<div class="link-description">'.$linkcat->description.'</div>';
            }
            $result .= get_the_link_items($linkcat->term_id);
        }
    }

    return $result;
}

/**
 * 查询某链接分类.
 *
 * @param int $term_id 链接分类ID
 *
 * @since 1.0.0
 *
 * @return string html 返回当前查询的某分类链接已进行过处理的HTML
 */
function get_the_link_items($term_id = null)
{
    $style = get_theme_mod('tangyuan_link_style', 1);

    switch ($style) {
   case 1:
   $container = '<div class="userItems">{template}</div>';
   $template = <<<EOF

   <div class="userItem" itemscope itemtype="http://data-vocabulary.org/Person">
   <div class="userItem--inner">
       <div class="userItem-content">
           {link_avatar}
           <div class="userItem-name">
               <a class="link link--primary" href="{link_url}" target="_blank" itemprop="url"><strong itemprop="nickname">{link_name}</strong></a>
           </div>
       </div>
   </div>
</div>
EOF;
   break;
   case 2:
   $container = '<ul class="row">{template}</ul>';
   $template = <<<EOF
EOF;
     break;

   default:
   }

    $bookmarks = get_bookmarks('orderby=date&category='.$term_id);
    $output = '';
    if (!empty($bookmarks)) {
        foreach ($bookmarks as $bookmark) {
            $temp_template = $template;
            $output .= str_replace(array(
                '{link_avatar}',
                '{link_url}',
                '{link_name}',
                '{link_notes_notes}',
            ), array(
                get_avatar($bookmark->link_image, 60),
                $bookmark->link_url,
                $bookmark->link_name,
                $bookmark->link_notes,
            ), $temp_template);
        }
    } else {
        $output = '暂无链接。';
    }

    return str_replace('{template}', $output, $container);
}
