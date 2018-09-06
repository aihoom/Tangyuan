<?php
/**
 * 显示文章单页的模板
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
    <div class="wrap row">
      <div class="col-gold-lg">
        <?php 
                  if (have_posts()):
                      while (have_posts()):
                          the_post(); ?>
        <article class="article" itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
          <h2 class="article-title text-truncate" itemprop="headline">
            <?php the_title_attribute(); ?>
          </h2>
          <div class="article-info l-mb20">
            <b itemprop="author">
              <?php echo get_the_author(); ?>
            </b>
            <time class="info-date" itemprop="datePublished" datetime="<?php the_date(DATE_W3C) ?>">
              <?php printf(__("wrote %s", 'tangyuan'), get_the_date()) ?>
            </time>
          </div>
          <div class="article-content" itemprop="text">
            <?php the_content(); ?>
          </div>
          <?php 
              wp_link_pages(array(
                'before'           => '<div class="pagination post-peges t-tl">',
                'after'            => '</div>',
                'link_before'      => '<span>',
                'link_after'       => '</span>',
              ));
            ?>
          <div class="info-tags l-mt80">
            <?php echo get_the_terms_limit('post_tag'); ?>
          </div>

        </article>
        <?php 
                  endwhile;
                  endif;
                  
          ?>
        <?php comments_template(); ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</main>
<?php 
 
 get_footer();
