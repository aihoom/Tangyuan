<?php

/**
 * 设置请求错误.
 *
 * @return json
 *
 * @since 1.0.0
 */
function tangyuan_request_fail($return)
{
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    $result = array('state' => 'fail', 'content' => $return);
    exit(json_encode($result));
}

/**
 * 设置请求成功
 *
 * @return json
 *
 * @since 1.0.0
 */
function tangyuan_request_success($return)
{
    $result = array('state' => 'success', 'data' => $return);
    exit(json_encode($result));
}

add_action('wp_ajax_nopriv_ajax_comment', 'Tangyuan_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'Tangyuan_ajax_comment_callback');
/**
 * 自定义你的评论展示方式.
 *
 * @param Comment $comment_fields 评论表单字段
 *
 * @return srting HTML
 *
 * @since 1.0.0
 */
function Tangyuan_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    if (1 == $comment->comment_approved) {
        ?>

<li class="comment" id="comment-<?php comment_ID(); ?>" itemscope itemtype="http://schema.org/Comment"
    itemprop="comment">
    <article class="comment-body">
        <div class="comment-container">

            <div class="comment-author-info">
                <div class="comment-author vcard">
                    <a href="<?php comment_author_url(); ?>">
                        <?php if (function_exists('get_avatar') && get_option('show_avatars')) {
            echo get_avatar($comment, 40);
        } ?>
                    </a>
                </div>

                <div class="comment-meta">
                    <b itemprop="author">
                        <?php comment_author(); ?></b>
                    <time datetime="<?php comment_date(DATE_W3C); ?>"
                        itemprop="datePublished">
                        <?php comment_date(); ?></time>
                    <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'tangyuan'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </div>
            </div>

            <div class="comment-content" itemprop="description">
                <?php comment_text(); ?>
            </div>


        </div>
    </article>

</li>

<?php
    }
}

/**
 * 评论回复回调.
 *
 * @return error json | success srting HTML
 *
 * @since 1.0.0
 */
function Tangyuan_ajax_comment_callback()
{
    $comment = wp_handle_comment_submission(wp_unslash($_POST));
    // $comment_count=get_post($comment->comment_post_ID)->comment_count;
    if (is_wp_error($comment)) {
        $data = $comment->get_error_data();

        if (!empty($data)) {
            tangyuan_request_fail($comment->get_error_message());
        } else {
            exit;
        }
    }
    $user = wp_get_current_user();

    do_action('set_comment_cookies', $comment, $user);
    $GLOBALS['comment'] = $comment;

    if (function_exists('get_avatar') && get_option('show_avatars')) {
        $avatar = get_avatar($comment, 50);
    } ?>

<li class="comment" id="comment-<?php comment_ID(); ?>">
    <article class="comment-body">
        <div class="comment-container">
            <div class="comment-author-info">
                <div class="comment-author vcard">
                    <a href="<?php comment_author_url(); ?>">
                        <?php if (function_exists('get_avatar') && get_option('show_avatars')) {
        echo get_avatar($comment, 40);
    } ?>
                    </a>
                </div>
                <div class="comment-meta">

                    <b>
                        <?php comment_author(); ?></b>
                    <time data-date="<?php comment_date(get_option('date_format')); ?>">
                        <?php echo get_comment_time(); ?></time>
                </div>
            </div>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'tangyuan'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
    </article>

</li>

<?php
exit;
}
