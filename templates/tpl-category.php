<?php
/**
 * Template Name: 分类页面模板
 *
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since Tangyuan 1.0.0
 */
?>
<?php get_header(); ?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container">
    <header>
      <div class="page-description">
        <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; ?>
      </div>
    </header>
    <div class="wrap" id="category">
      <div class="container">
        <div class="row">
          <div class="wrap">
            <?php $categories=get_categories(); ?>
            <?php if ($categories) : ?>
            <div class="row">
              <?php 
                foreach ($categories as $value):
                if ($value->slug !=='uncategorized'):
              ?>
              <div class="col-pl-50 col-tp-33 col-tl-25">
                <a href="<?php echo get_category_link($value->term_id);?>"
                  title="<?php echo $value->name; ?>" class="item-content"
                  style="background-image: url( <?php echo get_term_image($value->term_id, 'thumbnail', true)['attachment_url']; ?> )">
                  <div class="item-meta">
                    <div>
                      <h2>
                        <?php echo $value->name; ?>
                      </h2>
                      <p>
                        <?php echo $value->count; ?> 篇文章</p>
                    </div>
                  </div>
                </a>
              </div>
              <?php endif; endforeach ?>
            </div>
            <?php endif; ?>
          </div>
          <!-- get_sidebar(); -->
        </div>
      </div>
    </div>
  </div>
</main>
<?php get_footer();
