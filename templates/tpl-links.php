<?php
/*
Template Name: 友情链接页面模板
*/
/**
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since Tangyuan 1.0.0
 */
?>
<?php get_header();?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container">

    <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>

    <?php echo get_tangyuan_links() ?>

  </div>
</main>
<?php get_footer();
