<?php
/**
 * 显示默认页面的模板
 *
 *
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since Tangyuan 1.0.0
 */
 get_header();
?>
<?php single_featured_image_header(); ?>
<main id="main" class="single" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container">
    <div class="row wrap">
      <div class="w860 full-width">
        <?php 
                  if (have_posts()):
                      while (have_posts()):
                          the_post(); ?>
        <div class="article" itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
          <div class="article-content" itemprop="text">
            <?php the_content(); ?>
          </div>
        </div>
        <?php 
                      endwhile;
                      endif;
                  
          ?>
        <?php comments_template(); ?>
      </div>
    </div>
  </div>
</main>
<?php 
 
 get_footer();
