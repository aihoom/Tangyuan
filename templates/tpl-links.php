<?php
/**
 * Template Name: 友情链接页面模板
 */
?>
<?php get_header(); ?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container">
    <header class="page-header">
      <h2 class="page-title" itemprop="headline">
            <?php the_title_attribute(); ?>
      </h2>
    </header>
    <div class="page-content">
      <?php while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
      <?php endwhile; ?>

      <?php echo get_tangyuan_links(); ?>
    </div>

  </div>
</main>
<?php get_footer();
