<?php get_header(); ?>

<main id="CenterBlock" class="clearfix">
  <?php get_template_part('tp_breadcrumb'); ?>
    <div id="ContentsBlock">
      <div id="ContentsWrapper">
      <article>
        <section>
          <h1>指定されたページは存在しませんでした。</h1>
          <div class="sectionContents">
            <p>このページの URL ：<span class="error_msg">http://<?php echo esc_html($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></span></p>
            <p>現在表示する記事がありません。</p>
            <p><a href="<?php echo home_url(); ?>">トップページへ戻る。</a></p>
          </div>
        </section>
      </article>
      </div>
    </div>
  <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>