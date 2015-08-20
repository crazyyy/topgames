<?php get_header(); ?>
  <div id="content" class="c-inner">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
      <div class="post-title">
        <h2><?php the_title(); ?></h2>
      </div>
      <div class="post-entry">
        <?php the_content(); ?>
      </div>
      <br>
      <?php get_template_part('template-related-post'); ?>
    </div>

  <?php endwhile; else: ?>
    <article>
      <h2 class="page-title inner-title"><?php _e( 'Sorry, nothing to display.', 'wpeasy' ); ?></h2>
    </article>
  <?php endif; ?>
  </div><!-- content -->
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
