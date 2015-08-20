<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<div class="block" id="block-13">
  <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

  <div class="pt-left">
    <a rel="nofollow" style="display: block;" class="block-img-holder" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php if ( has_post_thumbnail()) :
        the_post_thumbnail('medium');
      else: ?>
        <img src="<?php echo catchFirstImage(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
      <?php endif; ?>
    </a><!-- /post thumbnail -->

    <div id="post-ratings-13" class="post-ratings" data-nonce="0818aa8a52"></div>

  </div>

  <div class="pt-right clearfix">
    <div class="cat">
      <span>Жанр: </span><?php the_category(', '); // Separated by commas ?>
    </div>
    <?php wpeExcerpt('wpeExcerpt20'); ?>
  </div><!-- exertp -->
  <a rel="nofollow" class="start-play" target="_blank" href="#">ОТКРЫТЬ ИГРУ</a>
</div>
  <?php endwhile; else: ?>
<?php endif; ?>
