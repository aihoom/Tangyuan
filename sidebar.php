<?php
/**
 * 显示侧边栏的模块.
 */
?>

<?php if (is_active_sidebar('right-sidebar')): ?>
<aside id="sidebar" class="col-gold-sm" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
        <?php dynamic_sidebar('right-sidebar'); ?>
</aside>
<?php endif;
