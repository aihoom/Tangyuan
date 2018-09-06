<?php
/**
 * 显示404页的模板
 *
 *
 * @package Mousin.CN
 * @subpackage Tangyuan
 * @since Tangyuan 1.0.0
 */
 get_header();
?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container">
    <div class="t-tc">
      <h1 class="f-fs50">404</h1>
      <p>
        <?php echo _e('Sorry, but the page you are looking for has moved or no longer exists.', 'tangyuan') ?>
      </p>
    </div>
  </div>
</main>
<?php 
 get_footer();
