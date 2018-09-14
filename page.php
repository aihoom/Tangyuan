<?php
/**
 * 显示默认页面的模板
 */
?>
<?php get_header(); ?>
<main id="main" class="single" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <?php featured_image(); ?>
  <div class="container w860">
    <header class="page-header">
      <h2 class="page-title" itemprop="headline">
            <?php the_title_attribute(); ?>
          </h2>
    </header>
    <div class="page-content">
      <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
        ?>
                  <?php the_content(); ?>
                  <?php
            endwhile;
        endif;

        ?>
    </div>
    <?php comments_template(); ?>
  </div>
</main>
<?php get_footer();
