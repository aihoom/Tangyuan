<?php
/**
 * Template Name: 分类页面模板
 */
?>
<?php get_header(); ?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container w860">

    <header class="page-header">
            <h1 class="page-title" itemprop="headline">
              <?php the_title_attribute(); ?>
            </h1>
      </header>
      <div class="page-content">
          <div id="category">

                <?php $categories = get_categories(); ?>
                      <?php if ($categories): ?>
                      <div class="row">
                        <?php
foreach ($categories as $value):
    if ('uncategorized' !== $value->slug):
    ?>
		                        <div class="item">
		                          <a href="<?php echo get_category_link($value->term_id); ?>"
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
		                        <?php endif; endforeach; ?>
                      </div>
                      <?php endif; ?>

          </div>
      </div>



  </div>
</main>
<?php get_footer();
