<?php
/**
 * 显示评论与回复模块
 *
 *
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since Tangyuan 1.0.0
 */

if (! post_password_required()) :
?>
<?php if (comments_open()) : ?>
<div class="comment-area">
  <?php if (have_comments()) : ?>
  <ol id="comments" class="comments-list">
    <?php wp_list_comments('type=comment&callback=Tangyuan_comment'); ?>
  </ol>
  <?php endif; ?>
  <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
  <nav class="navigation comment-navigation clearfix" role="navigation">
    <div class="nav-previous">
      <?php previous_comments_link(__('&larr; Older Comments', 'tangyuan')); ?>
    </div>
    <div class="nav-next">
      <?php next_comments_link(__('Newer Comments &rarr;', 'tangyuan')); ?>
    </div>
  </nav>
  <?php endif;  ?>
  <?php 

            if (comments_open()) {
                comment_form(
                                array(
                                'comment_notes_before'  => '',
                                'comment_notes_after'   => null,
                                'title_reply'           => get_theme_mod('tangyuan_reply_title', __('Leave a Reply', 'tangyuan')),
                                'label_submit'          => get_theme_mod('tangyuan_reply_button_text', __('Post Comment', 'tangyuan')),
                                'id_submit'            => 'comment-submit',
                                'fields'                => array(
                                'author'                => '<div id="author-info"><div class="comment-form-input"><i icon="user, 16"></i><input type="text" name="author" id="author" value="' . esc_attr($commenter['comment_author']) .'" ></div>',
                                'email'                 => '<div class="comment-form-input"><i icon="message,16"></i><input type="email" name="email" id="email" value="' . esc_attr($commenter['comment_author_email']) .'"></div>',
                                'url'                   => '<div class="comment-form-input"><i icon="link,16"></i><input type="url" name="url" id="url" value="' . esc_attr($commenter['comment_author_url']) .'"></div></div>',
                                    ),
                                'comment_field'         => '<textarea name="comment" id="comment" rows="10" tabindex="4"></textarea>'
                                    )
                );
            }

        ?>
</div>
<?php endif; ?>
<?php endif;
