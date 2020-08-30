<?php get_header(); ?>

<main id="CenterBlock" class="clearfix">
  <?php get_template_part('tp_breadcrumb'); ?>
  <div id="ContentsBlock">
    <div id="ContentsWrapper">
      <?php if (have_posts()) : ?>
        <?php gr_SetTitleTag(2); ?>
        <div id="PageTitle"><h1><?php the_archive_title('', ' の記事');?></h1></div>
        <?php get_template_part('tp_postlists'); ?>
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
