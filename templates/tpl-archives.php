<?php
/**
 * Template Name: 归档页面模板
 */
?>
<?php get_header(); ?>
<main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
  <div class="container w860">


    <header class="page-header">
            <h2 class="page-title" itemprop="headline">
              <?php the_title_attribute(); ?>
            </h2>
    </header>
    <div class="page-content">

            <div class="archive">
          <?php
$previous_year = $year = 0;
$previous_month = $month = 0;
$previous_day = $day = 0;
$ul_open = false;

$myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');

foreach ($myposts as $post):
    setup_postdata($post);

    $year = date('Y', strtotime($post->post_date));
    $month = date('m', strtotime($post->post_date));
    $day = date('d', strtotime($post->post_date));

    if ($year != $previous_year):
        if (true == $ul_open):
            echo '</ul>';
        endif;

        echo '<h3 class="heading-line t-tl">';
        echo '<span>'.$year.'</span>';
        echo '</h3>';
        echo '<ul class="archives-monthlisting">';
        $ul_open = true;

    endif;

    $previous_year = $year;

    if ($month != $previous_month):
        echo '<li class="archive-mouth">'.$month.'</li>';
    endif;
    $previous_month = $month;

    ?>
	          <li>
	            <span>
	              <?php echo $day; ?></span>
	            <span class="archive-title">
	              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	                <?php the_title_attribute(); ?>

	                <?php if ('' == $post->post_status) {
    }?>
	              </a>
	            </span>
	          </li>
	          <?php
    $previous_year = $year;
    $previous_month = $month;
endforeach;
wp_reset_postdata();
?>
        </div>
    </div>



  </div>
</main>
<?php get_footer();
