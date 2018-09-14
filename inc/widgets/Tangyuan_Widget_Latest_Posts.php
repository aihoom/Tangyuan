<?php
/**
 * 加载主题脚本.
 *
 * @since 1.0.0
 *
 * @version 1.1.0
 */
add_action('widgets_init', 'Tangyuan_Widget_Latest_Posts');
function Tangyuan_Widget_Latest_Posts()
{
    register_widget('Tangyuan_Widget_Latest_Posts');
}
class Tangyuan_Widget_Latest_Posts extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('description' => esc_html__('Displays a number of the latest posts.', 'tangyuan'));
        parent::__construct('latest-posts', __('Latest Posts', 'tangyuan'), $widget_ops);
    }

    private function posts_list($orderby, $limit)
    {
        $args = array(
            'order' => 'DESC',
            'orderby' => $orderby,
            'showposts' => $limit,
            'ignore_sticky_posts' => 1,
        );
        query_posts($args);
        $index = 0;
        while (have_posts()): the_post(); ?>
	  <?php
        $article_media_source = wp_get_attachment_url(get_post_thumbnail_id()); ?>
	    <li<?php if (0 == $index) {
            echo ' class="frist-item"';
        } ?>>
	      <a class="article-media" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="background-image: url(<?php echo $article_media_source; ?>) ">
	        <?php the_title_attribute(); ?>
	      </a>
	      <div class="article-main">
	        <h4 class="article-title">
		        <a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
		    </h4>
	        <span class="info-date"><?php the_time('Y-m-d'); ?></span>
	    </li>
      <?php
      ++$index;
        endwhile;
        wp_reset_query();
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = isset($instance['title']) && !empty($instance['title']) ? $instance['title'] : '';

        if ($title) {
            $title = apply_filters('widget_name', $title);
            $title = $before_title.$title.$after_title;
        }

        $limit = isset($instance['limit']) && !empty($instance['limit']) ? $instance['limit'] : 4;
        $orderby = isset($instance['orderby']) && !empty($instance['orderby']) ? $instance['orderby'] : 'date';

        $style = '';
        echo $before_widget;
        echo $title;
        echo '<ul class="article-list">';
        echo $this->posts_list($orderby, $limit);
        echo '</ul>';
        echo $after_widget;
    }

    public function form($instance)
    {
        $title = isset($instance['title']) && !empty($instance['title']) ? $instance['title'] : '';
        $limit = isset($instance['limit']) && !empty($instance['limit']) ? $instance['limit'] : 4;
        $orderby = isset($instance['orderby']) && !empty($instance['orderby']) ? $instance['orderby'] : 'date'; ?>
      <p>
        <label>
          标题：
          <input style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </label>
      </p>
      <p>
        <label>
          排序：
          <select style="width:100%;" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
            <option value="date" <?php selected('date', $orderby); ?>>
              <?php _e('Latest', 'tangyuan'); ?>
            </option>
            <option value="comment_count" <?php selected('comment_count', $orderby); ?>>
              <?php _e('Most Comment', 'tangyuan'); ?>
            </option>
            <option value="rand" <?php selected('rand', $orderby); ?>>
              <?php _e('Random', 'tangyuan'); ?>
            </option>
          </select>
        </label>
      </p>
      <p>
        <label>
          显示数目：
          <input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit; ?>" size="24" />
        </label>
      </p>
      <?php
    }
}
