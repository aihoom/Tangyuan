<?php
/**
 * 显示底部的模块
 *
 *
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since Tangyuan 1.0.0
 */
?>
<footer class="footer" itemscope itemtype="http://schema.org/WPFooter">
  <div class="container">
    <?php
if (is_active_sidebar('footer-widgets-left') ||
    is_active_sidebar('footer-widgets-center')  ||
    is_active_sidebar('footer-widgets-right')) :
?>
    <div class="row">
      <?php if (is_active_sidebar('footer-widgets-left')) : ?>
      <aside id="footer-widgets-first" class="l-fl">
        <?php dynamic_sidebar('footer-widgets-left'); ?>
      </aside>
      <?php endif; ?>
      <?php if (is_active_sidebar('footer-widgets-center')) : ?>
      <aside id="footer-widgets-second" class="l-fl">
        <?php dynamic_sidebar('footer-widgets-center'); ?>
      </aside>
      <?php endif; ?>
      <?php if (is_active_sidebar('footer-widgets-right')) : ?>
      <aside id="footer-widgets-last" class="l-fr">
        <?php dynamic_sidebar('footer-widgets-right'); ?>
      </aside>
      <?php endif; ?>
    </div>
    <?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>

</html>

