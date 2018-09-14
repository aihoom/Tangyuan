<?php
/**
 * 显示头部的模块.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui, viewport-fit=cover" />
  <?php wp_head(); ?>
</head>
<body itemscope itemtype="http://schema.org/WebPage">
  <header id="header" class="site-header" role="banner" itemscope itemtype="http://schema.org/Organization">
    <div class="container">
      <?php tangyuan_logo(); ?>
    </div>
  </header>
  <div id="J-nav-sticky" class="navigation-bar">
    <div class="navigation-inner container">
      <div class="navbar-toggle close">
        <div class="p-pr">
          <span class="icon-bar bar1"></span>
          <span class="icon-bar bar2"></span>
          <span class="icon-bar bar3"></span>
        </div>
      </div>
      <nav class="header-menu" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'header_menu',
                'menu_class' => 'menu',
                'menu_id' => '',
                'container' => '',
                'fallback_cb' => 'link_to_menu_editor',
            )
        );
      ?>
      </nav>
      <i id="scrollToTop" icon="angle-up-l,22"></i>
    </div>
  </div>
