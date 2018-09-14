<?php
/**
 * 显示分类单页模板
 */
?>
<?php get_header(); ?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container">
    <div class="row">
      <div class="col-gold-lg">
        <?php $current_category = get_category(get_queried_object_id()); ?>
        <div class="category-info clearfix">
          <div class="category-meta">
            <h3 class="category-name">
            <?php echo $current_category->name; ?>
          </h3>
            <div class="category-description">
              <?php echo $current_category->description; ?>
            </div>
            <div class="post-count">
              <?php _e('Post Count', 'tangyuan'); ?>：
              <?php echo get_category_post_count($current_category->term_id); ?>
            </div>
          </div>
        </div>
        <?php if (have_posts()):
            while (have_posts()): the_post();
                get_template_part('templates/post-format/content');
            endwhile;
        endif; ?>
        <div class="pagination">
          <?php echo paginate_links(['before_page_number' => null, 'mid_size' => 2]); ?>
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</main>
<?php get_footer();
