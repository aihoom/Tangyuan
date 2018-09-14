<?php
/**
 * 显示主页的模板
 */
?>
<?php get_header(); ?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <?php if (get_header_image()): ?>
  <div id="header-media" class="featured-image" style="background-image: url(<?php header_image(); ?>);"></div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-gold-lg">
        <?php if (have_posts()):
                while (have_posts()): the_post();
                    get_template_part('templates/post-format/content');
                endwhile;
            endif;
      ?>
        <div class="pagination posts-list-pagination">
          <?php echo paginate_links(
  array(
      'before_page_number' => null,
      'mid_size' => 2,
      'prev_text' => '<i icon="angle-left-l, 12"></i>',
      'next_text' => '<i icon="angle-right-l, 12"></i>',
  )
); ?>
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</main>
<?php get_footer();
