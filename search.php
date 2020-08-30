<?php get_header(); ?>

<main id="CenterBlock" class="clearfix">
  <?php get_template_part('tp_breadcrumb'); ?>
  <div id="ContentsBlock">
    <div id="ContentsWrapper">
      <?php if (have_posts()) : ?>
        <?php gr_SetTitleTag(2); ?>
        <div id="PageTitle"><h1>「<?php echo get_search_query(); ?>」  の検索結果 <span>（<?php echo $wp_query->found_posts; ?> 件）</span></h1></div>
        <?php get_template_part('tp_postlists'); ?>
        <div id="Pagination">
          <?php gr_Pagination(); ?>
        </div>
      <?php else : ?>
        <div id="PageTitle">
          <h1>「<?php echo get_search_query(); ?>」  の検索結果は見つかりませんでした</h1>
          <p>検索するキーワードを変更してみてください。</p>
        </div>
      <?php endif; ?>
      <?php get_template_part('tp_pagetop'); ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
