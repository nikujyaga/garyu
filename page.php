<?php get_header(); ?>

<main id="CenterBlock" class="clearfix">
  <?php get_template_part('tp_breadcrumb'); ?>
  <div id="ContentsBlock">
    <div id="ContentsWrapper">
      <?php if (have_posts()) : ?>
        <?php $headerLebel = (is_home() || is_front_page()) ? 2 : 1; gr_SetTitleTag($headerLebel);?>
        <?php while (have_posts()) : the_post(); ?>
          <article>
            <section>
              <?php if (!is_home() && !is_front_page()) : ?>
                <div class="articleHeader">
                  <?php get_template_part('tp_articletitle'); ?>
                </div>
              <?php endif; ?>
              <div class="articleContents">
                <?php the_content(); ?>
              </div>
            </section>
          </article>
          <?php get_template_part('tp_articletaxonomies'); ?>
        <?php endwhile; ?>
        <?php if (is_home() || is_front_page()) : ?>
          <?php global $widget00; if (is_active_sidebar($widget00)) : ?>
            <div id="SingleWidget">
              <?php global $widget00; dynamic_sidebar($widget00); ?>
            </div>
          <?php endif; ?>
        <?php else : ?>
          <?php global $widget01; if (is_active_sidebar($widget01)) : ?>
            <div id="SingleWidget">
              <?php global $widget01; dynamic_sidebar($widget01); ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      <?php endif; ?>
      <?php get_template_part('tp_pagetop'); ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php if ((!is_home() && !is_front_page()) && !is_user_logged_in() && !is_robots()) setPostViews(); ?>
<?php get_footer(); ?>
