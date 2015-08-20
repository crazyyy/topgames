<?php get_header(); ?>
  <div id="content">

    <div class="top-text">
      <h2 class="main-title"><?php the_category(', '); ?></h2>
    </div>
    <div class="block-holder">
      <?php get_template_part('loop'); ?>
      <?php get_template_part('pagination'); ?>
    </div>

  </div><!-- content -->

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
