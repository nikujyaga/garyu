<?php get_header(); ?>

<main id="CenterBlock" class="clearfix">
  <?php get_template_part('tp_breadcrumb'); ?>
  <div id="ContentsBlock">
    <div id="ContentsWrapper">
      <?php if (have_posts()) : ?>
        <?php gr_SetTitleTag(1); ?>
        <?php while (have_posts()) : the_post(); ?>
          <article>
            <section>
              <div class="articleHeader">
                <?php get_template_part('tp_articletitle'); ?>
              </div>
              <div class="articleContents">
                <?php the_content(); ?>
              </div>
              <?php get_template_part('tp_articletaxonomies'); ?>
            </section>
          </article>
          <?php
            $show_profile = get_option('show_profile');
            if ($show_profile != '0') :
              get_template_part('tp_profile');
            endif;
          ?>
          <?php global $widget02; if (is_active_sidebar($widget02)) : ?>
            <div id="SingleWidget">
              <?php global $widget02; dynamic_sidebar($widget02); ?>
            </div>
          <?php endif; ?>
          <nav id="PreviousAndNextArticles" class="clearfix">
            <?php
              $prevpost = get_adjacent_post(true, '', true);
              $nextpost = get_adjacent_post(true, '', false);
              $noPrev = empty($prevpost) ? ' class="noPrev"' : '';
              $noNext = empty($nextpost) ? ' class="noNext"' : '';
              if ($prevpost || $nextpost) :
                if ($prevpost) :
                  echo '<a href="'.get_permalink($prevpost->ID).'" id="PrevArticle"'.$noNext.'><dl><dt><i class="fa fa-chevron-left fa-inverse"></i></dt><dd>'.get_the_title($prevpost->ID).'</dd></dl></a>';
                endif;
                if ($nextpost) :
                  echo '<a href="'.get_permalink($nextpost->ID).'" id="NextArticle"'.$noPrev.'><dl><dt><i class="fa fa-chevron-right fa-inverse"></i></dt><dd>'.get_the_title($nextpost->ID).'</dd></dl></a>';
                endif;
              endif;
            ?>
          </nav>
          <aside id="Comments">
            <?php if (comments_open()) : ?>
              <div class="postComments">
                <?php comments_template(); ?>
              </div>
            <?php endif; ?>
          </aside>
        <?php endwhile; ?>
        <nav id="Pagination">
          <?php gr_Pagination(); ?>
        </nav>
      <?php endif; ?>
      <?php get_template_part('tp_pagetop'); ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php if (!is_user_logged_in() && !is_robots()) setPostViews(); ?>
<?php get_footer(); ?>
