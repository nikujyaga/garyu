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
              <div class="postList">
                <div class="postHeader clearfix">
                  <?php get_template_part('tp_articleinformation'); ?>
                  <div class="postImage">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php get_template_part('tp_eyecathingimage'); ?></a>
                  </div>
                </div>
                <div class="sectionContents">
                  <?php the_excerpt(); ?>
                </div>            
              </div>
            </section>
          </article>
        <?php endwhile; ?>
        <?php if (is_home() || is_front_page()) : ?>
          <?php global $widget00; if (is_active_sidebar($widget00)) : ?>
            <div id="SingleWidget">
              <?php global $widget00; dynamic_sidebar($widget00); ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
        <div id="Pagination">
          <?php gr_Pagination(); ?>
        </div>
      <?php endif; ?>
      <?php get_template_part('tp_pagetop'); ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
