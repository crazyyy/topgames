<?php /* Template Name: Home Page */ get_header(); ?>
  <div id="content">

    <div class="top-text">
      <h2 class="main-title">Топ онлайн игр за <span>2015 год!</span></h2>
      <?php the_content(); ?>
    </div>
    <div class="block-holder">
    <?php query_posts( array( 'showposts' => '50', 'meta_key' => 'ratings_average', 'orderby' => 'meta_value_num', 'order' => 'DESC' ) ); ?>
        <?php get_template_part('loop'); ?>
      <?php wp_reset_query(); ?>
    </div>

  </div><!-- content -->

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
