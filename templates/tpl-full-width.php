<?php
/**
 * Template Name: 全宽模板
 * Template Post Type: post.
 */
?>
<?php get_header(); ?>
<main id="main" class="single" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<?php featured_image(); ?>
	<div class="container">
		<div class="w860 full-width">
			<?php
            if (have_posts()):
                    while (have_posts()):
                            the_post(); ?>
									<article class="article" itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
										<header class="article-header">
											<h2 class="article-title" itemprop="headline">
												<?php the_title_attribute(); ?>
											</h2>
										</header>
										<div class="article-meta">
											<span class="article-author-vcard">
												<b itemprop="author">
													<?php echo get_the_author(); ?>
												</b>
												<time class="info-date" itemprop="datePublished" datetime="<?php the_date(DATE_W3C); ?>">
													<?php printf(__('wrote %s', 'tangyuan'), get_the_date()); ?>
												</time>
											</span>
										</div>
										<div class="article-content" itemprop="text">
											<?php the_content(); ?>
											<?php
                            wp_link_pages(array(
                                    'before' => '<div class="pagination article-pages">',
                                    'after' => '</div>',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                            ));
                            ?>
										</div>
										<footer class="article-footer">
											<?php if (has_tag()): ?>
											<div class="article-tags">
												<?php echo get_the_terms_limit('post_tag'); ?>
											</div>
											<?php endif; ?>
									</footer>
								</article>
								<?php
            endwhile;
            endif;
            ?>
			<?php comments_template(); ?>
		</div>
	</div>
</main>
<?php get_footer();
