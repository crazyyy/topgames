

<?php $orig_post = $post; global $post;
  $categories = get_the_category($post->ID);
    if ($categories) {
      $category_ids = array();
      foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
      $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=> 3, // Number of related posts that will be shown.
        'caller_get_posts'=>1
        );
      $my_query = new wp_query( $args );
       if( $my_query->have_posts() ) { ?>

      <div class="wp_rp_wrap  wp_rp_vertical_m" id="wp_rp_first">
        <div class="wp_rp_content">
          <h3 class="related_post_title">Похожие записи:</h3>
          <ul class="related_post wp_rp">

          <?php while( $my_query->have_posts() ) { $my_query->the_post();?>

<li data-position="0" data-poid="in-4177" data-post-type="none">
        <a href="<? the_permalink()?>" class="wp_rp_thumbnail"><?php if ( has_post_thumbnail()) :
        the_post_thumbnail('medium');
      else: ?>
        <img src="<?php echo catchFirstImage(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
      <?php endif; ?></a><a href="<? the_permalink()?>" class="wp_rp_title"><?php the_title(); ?></a> <small class="wp_rp_excerpt"><?php wpeExcerpt('wpeExcerpt10'); ?></small></li>

<? } ?>

    </ul>
  </div>
</div>

<? }
  }
  $post = $orig_post;
  wp_reset_query();
?>

