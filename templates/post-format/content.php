<?php
/**
 * 默认文章输出模板
 */
?>
<article class="article" itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
  <?php 
    $article_media_position_at = get_theme_mod('article_media_position_at', 'article-media--block');

    $is_limit_line = in_array($article_media_position_at, array('article-media--at-left', 'article-media--at-right'));

    if ('none' != $article_media_position_at):
      if (get_post_thumbnail_id()):
  ?>
  <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail('article-media '.$article_media_position_at, array('title' => the_title_attribute('echo=0'))); ?>
  </a>
  <?php 
      endif;
    endif;
  ?>

  <header class="article-header">
    <h2 class="article-title" itemprop="headline"><a href="<?php the_permalink(); ?>"
        title="<?php the_title_attribute(); ?>" itemprop="url">
        <?php the_title_attribute(); ?></a></h2>
  </header>
  <div class="article-text<?php echo $is_limit_line ? ' limit_line' : ''; ?>"
    itemprop="description">
    <?php the_excerpt(); ?>
  </div>
  <footer class="article-footer">
    <div class="article-info">
      <ul class="subnav">
        <li class="hide" itemprop="author">
          <?php the_author(); ?>
        </li>
        <li>
          <time class="info-date" itemprop="datePublished" datetime="<?php the_date(DATE_W3C); ?>">
            <?php echo esc_html(get_the_date()); ?>
          </time>
        </li>
        <li class="l-fr">
          <a class="info-comments-count" href="<?php echo esc_url(get_comments_link()); ?>">
            <?php 
            $comments_number = get_comments_number();
            if ('0' === $comments_number) {
                printf(_x('0 Comment', 'Comment Count', 'tangyuan'), get_the_title());
            } else {
                printf(
                _nx(
                  '%1$s Comment',
                  '%1$s Comments',
                  $comments_number,
                  'Comment Count',
                  'tangyuan'
                ),
                number_format_i18n($comments_number)
              );
            }
          ?>
          </a>
        </li>
      </ul>
    </div>
  </footer>

</article>