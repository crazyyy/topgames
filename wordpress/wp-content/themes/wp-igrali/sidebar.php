<div id="sidebar">
  <div class="cat-box-left">

  <?php if ( is_active_sidebar('widgetarea1') ) : ?>
    <?php dynamic_sidebar( 'widgetarea1' ); ?>
  <?php else : ?>
  <?php endif; ?>

  </div><!-- cat-box-left -->

  <div class="vbox">
    <h2>Новые игры</h2>
    <ol class="games">
    <?php query_posts("showposts=5&cat=-1"); ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
          <noindex>
            <a rel="nofollow" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php if ( has_post_thumbnail()) :
                the_post_thumbnail('medium');
              else: ?>
                <img src="<?php echo catchFirstImage(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
              <?php endif; ?>
              <span><?php the_title(); ?></span>
            </a>
          </noindex>
        </li>
      <?php endwhile; endif; ?>
    <?php wp_reset_query(); ?>
    </ol>
  </div>

  <div class="vbox">
    <h2>Новости и статьи</h2>
    <ol class="games">
      <?php query_posts("showposts=4&cat=1"); ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <li>
        <noindex>
          <a rel="nofollow" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php if ( has_post_thumbnail()) :
                the_post_thumbnail('medium');
              else: ?>
                <img src="<?php echo catchFirstImage(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
              <?php endif; ?>
            <span><?php the_title(); ?></span>
          </a>
        </noindex>
      </li>
      <?php endwhile; endif; ?>
      <?php wp_reset_query(); ?>
    </ol>
  </div>

</div><!-- sidebar -->

