<?php
  if (!defined('ABSPATH')) {
      exit;
  }

  /* グルーバル変数の定義
  ----------------------------------------------- */
  $titleformat = '';
  $h1format = '<h1>%s</h1>';
  $h2format = '<h2>%s</h2>';
  $h3format = '<h3>%s</h3>';
  $widget00 = 'widget00';
  $widget01 = 'widget01';
  $widget02 = 'widget02';
  $sidebar00 = 'sidebar00';
  $sidebar01 = 'sidebar01';
  $sidebar02 = 'sidebar02';
  $views_count_key = 'views_count';

  if (!is_admin()) {
      /* CSSの読み込み
      ----------------------------------------------- */
      function add_stylesheet()
      {
          wp_register_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css', array(), '8.0.0');
          wp_register_style('lightbox2css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css', array(), '2.11.1');
          wp_register_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
          wp_register_style('parent-style', get_template_directory_uri().'/styleß.css', array());
          wp_enqueue_style('normalize');
          wp_enqueue_style('lightbox2css');
          wp_enqueue_style('fontawesome');
          wp_enqueue_style('parent-style');
      }
      add_action('wp_enqueue_scripts', 'add_stylesheet');

      /* スクリプトの読み込み
      ----------------------------------------------- */
      function add_jquery()
      {
          wp_deregister_script('jquery');
          wp_deregister_script('jquery-core');
          wp_deregister_script('jquery-migrate');
          wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), '1.12.4');
          wp_register_script('lightbox2', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js', array(), '2.11.1');
          wp_register_script('lazysizes', 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.0.0/lazysizes.min.js', array(), '5.0.0');
          wp_enqueue_script('jquery');
          wp_enqueue_script('lightbox2');
          wp_enqueue_script('lazysizes');
      }
      add_action('wp_enqueue_scripts', 'add_jquery');

      function add_script()
      {
          wp_register_script('functions', get_template_directory_uri().'/js/functions.min.js', array());
          wp_enqueue_script('functions');
      }
      add_action('wp_print_scripts', 'add_script');

      /* スクリプトの読み込みタイミング調整
      ----------------------------------------------- */
      if (!function_exists('replace_script_tag')) {
          function replace_script_tag($tag)
          {
              if (strpos($tag, 'jquery.min.js')) {
                  return str_replace("type='text/javascript' ", '', $tag);
              } else {
                  return str_replace("type='text/javascript'", 'async', $tag);
              }
          }
          add_filter('script_loader_tag', 'replace_script_tag');
      }
  }

  /* カスタムヘッダ―
  ----------------------------------------------- */
  $customHeader = array(
    'default-image' => '',
    'random-default' => false,
    'width' => 0,
    'height' => 0,
    'flex-height' => false,
    'flex-width' => false,
    'default-text-color' => '',
    'header-text' => true,
    'uploads' => true,
    'wp-head-callback' => '',
    'admin-head-callback' => '',
    'admin-preview-callback' => '',
    'video' => false,
    'video-active-callback' => 'is_front_page',
  );
  add_theme_support('custom-header', $customHeader);

  /* アイキャッチ画像を使用できるようにする
  ----------------------------------------------- */
  add_theme_support('post-thumbnails');

  /* 「プロフィール情報」にHTMLタグを使えるようにする
  ----------------------------------------------- */
  remove_filter('pre_user_description', 'wp_filter_kses');
  
  /* ウィジェットでショートコードを使用可能にする
  ----------------------------------------------- */
  add_filter('widget_text', 'do_shortcode');

  /* 固定ページで抜粋を使用可能にする
  ----------------------------------------------- */
  add_post_type_support('page', 'excerpt');

  /* ウィジェットエリア定義
  ----------------------------------------------- */
  register_sidebar(array(
    'name' => 'サイドバー（ホームページのみ）',
    'id' => $sidebar00,
    'description' => 'サイドバーに表示されます。ホームページのみに表示され、サイドバーウィジェットの先頭に配置されます。',
    'before_widget' => '<div id="%1$s" class="sidebar00 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="sidebar00Title"><span>',
    'after_title' => '</span></div>',
  ));

  register_sidebar(array(
    'name' => 'サイドバー',
    'id' => $sidebar01,
    'description' => 'サイドバーに表示されます。',
    'before_widget' => '<div id="%1$s" class="sidebar01 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="sidebar01Title"><span>',
    'after_title' => '</span></div>',
  ));

  register_sidebar(array(
    'name' => 'サイドバー（スクロール追従）',
    'id' => $sidebar02,
    'description' => 'サイドバーに表示されます。サイドバーウィジェットの後尾に配置されます。※画面サイズにより非表示になります。※未承認のGoogle AdSenseは設置できません。',
    'before_widget' => '<div id="%1$s" class="sidebar02 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="sidebar02Title"><span>',
    'after_title' => '</span></div>',
  ));

  register_sidebar(array(
    'name' => 'ホームページの下',
    'id' => $widget00,
    'description' => 'ホームページに設定した固定記事の下に表示されます。',
    'before_widget' => '<div id="%1$s" class="widget00 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget00Title"><span>',
    'after_title' => '</span></div>',
  ));

  register_sidebar(array(
    'name' => '固定記事の下',
    'id' => $widget01,
    'description' => '固定記事の下に表示されます。',
    'before_widget' => '<div id="%1$s" class="widget01 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget01Title"><span>',
    'after_title' => '</span></div>',
  ));

  register_sidebar(array(
    'name' => '投稿記事の下',
    'id' => $widget02,
    'description' => '投稿記事の下に表示されます。',
    'before_widget' => '<div id="%1$s" class="widget02 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget02Title"><span>',
    'after_title' => '</span></div>',
  ));

  /* メニュー定義
  ----------------------------------------------- */
  register_nav_menus(array(
    'header' => 'ヘッダーメニュー',
    'main' => 'メインメニュー',
    'footer' => 'フッターメニュー',
  ));

  /* ウィジェット：関連する記事の表示
  ----------------------------------------------- */
  class RelatedPost extends WP_Widget
  {
      public function __construct()
      {
          $widget_ops = array('description' => '関連する記事をサムネイル付きで表示します。投稿記事の下のみ有効です。');
          parent::__construct('RelatedPost', '関連記事の表示', $widget_ops);
      }

      public function widget($args, $instance)
      {
          if (!is_home() && !is_front_page() && is_single()) {
              global $post;
              $widget_title = $instance['title'];
              $count = !empty($instance['count']) ? $instance['count'] : get_option('posts_per_page');
              $cat_array = array();
              $tag_array = array();

              $categories = get_the_category($post->ID);
              if (!empty($categories)) {
                  foreach ($categories as $catkey => $cat) {
                      $cat_array[$catkey] = $cat->slug;
                  }
              }
              $tags = get_the_tags($post->ID);
              if (!empty($tags)) {
                  foreach ($tags as $tagkey => $tag) {
                      $tag_array[$tagkey] = $tag->slug;
                  }
              }

              if ($cat_array || $tag_array) {
                  $myposts = get_posts(array(
              'post_status' => 'publish',
              'posts_per_page' => $count,
              'post__not_in' => array($post->ID),
              'orderby' => 'rand',
              'tax_query' => array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'category',
                  'field' => 'slug',
                  'terms' => $cat_array,
                  'include_children' => false
                ),
                array(
                  'taxonomy' => 'post_tag',
                  'field' => 'slug',
                  'terms' => $tag_array,
                  )
                  )));

                  if (!empty($myposts)) {
                      gr_SetTitleTag(3);
                      echo $args['before_widget'];
                      if (!empty($widget_title)) {
                          echo $args['before_title'].$widget_title.$args['after_title'];
                      }
                      echo '<nav class="relatedPost">';
                      foreach ($myposts as $post) {
                          setup_postdata($post);
                          get_template_part('tp_relatedpostlist');
                      }
                      wp_reset_postdata();
                      echo '</nav>';
                      echo $args['after_widget'];
                  }
              }
          }
      }

      public function form($instance)
      {
          $defaults = array(
            'title' => '関連する記事',
            'count' => get_option('posts_per_page'),
          );
          $instance = wp_parse_args((array)$instance, $defaults);

          $title = sanitize_text_field($instance['title']);
          $count = sanitize_text_field($instance['count']); ?>
<p>
  <label
    for="<?php echo $this->get_field_id('title'); ?>">タイトル</label>
  <input
    id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>"
    type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('count'); ?>">表示件数</label>
  <input
    id="<?php echo $this->get_field_id('count'); ?>"
    name="<?php echo $this->get_field_name('count'); ?>"
    type="text" value="<?php echo esc_attr($count); ?>" />
</p>
<?php
      }

      public function update($new_instance, $old_instance)
      {
          $instance = $old_instance;
          $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
          $instance['count'] = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';
          return $instance;
      }
  }

  /* ウィジェット：SNSボタン表示
  ----------------------------------------------- */
  class SNSButtons extends WP_Widget
  {
      public function __construct()
      {
          $widget_ops = array('description' => 'SNSボタンを表示します。サイトバーでは正常に動作しないため、固定記事・投稿ページいずれかに設置してください。');
          parent::__construct('SNSButtons', 'SNSボタンの表示', $widget_ops);
      }

      public function widget($args, $instance)
      {
          if (!is_home() && !is_front_page()) {
              $encode_url = urlencode(get_permalink());
              $encode_title = urlencode(get_the_title()).' | '.urlencode(get_bloginfo('name'));
              $widget_title = $instance['title'];

              echo $args['before_widget'];
              if (!empty($widget_title)) {
                  echo $args['before_title'].$widget_title.$args['after_title'];
              } ?>
<div id="SNSButtons">
  <ul>
    <li class="tweet">
      <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"
        onclick="javascript:window.open(this.href, '', 'menubar=no, toolbar=no, resizable=yes, scrollbars=yes, width=600, height=300');return false;"><i
          class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
    </li>
    <li class="facebook">
      <a href="https://www.facebook.com/sharer/sharer.php?src=bm&u=<?php the_permalink(); ?>&t=<?php the_title(); ?>"
        onclick="javascript:window.open(this.href, '', 'menubar=no, toolbar=no, resizable=yes, scrollbars=yes, width=600, height=300');return false;"><i
          class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
    </li>
    <li class="hatena">
      <a href="https://b.hatena.ne.jp/add?mode=confirm&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"
        onclick="javascript:window.open(this.href, '', 'menubar=no, toolbar=no, resizable=yes, scrollbars=yes, width=600, height=300');return false;"><span
          class="icon-hatebu"></span> はてブ</a>
    </li>
    <li class="pocket">
      <a href="https://getpocket.com/edit?title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
        onclick="window.open(this.href, '', 'menubar=no, toolbar=no, resizable=yes, scrollbars=yes, width=550, height=350'); return false;"><i
          class="fa fa-get-pocket" aria-hidden="true"></i> Pocket</a>
    </li>
    <li class="rss">
      <a
        href="<?php echo bloginfo('rss2_url'); ?>"><i
          class="fa fa-rss-square" aria-hidden="true"></i> RSS</a>
    </li>
  </ul>
</div>
<?php echo $args['after_widget'];
          }
      }

      public function form($instance)
      {
          $defaults = array('title' => 'SNSボタン',);
          $instance = wp_parse_args((array)$instance, $defaults);

          $title = sanitize_text_field($instance['title']); ?>
<p>
  <label
    for="<?php echo $this->get_field_id('title'); ?>">タイトル</label>
  <input
    id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>"
    type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<?php
      }

      public function update($new_instance, $old_instance)
      {
          $instance = $old_instance;
          $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
          return $instance;
      }
  }

  /* ウィジェット：新着記事の表示
  ----------------------------------------------- */
  class NewPost extends WP_Widget
  {
      public function __construct()
      {
          $widget_ops = array('description' => '新着記事をサムネイル付きで表示します。');
          parent::__construct('NewPost', '新着記事の表示', $widget_ops);
      }

      public function widget($args, $instance)
      {
          global $post;
          $widget_title = $instance['title'];
          $count = !empty($instance['count']) ? $instance['count'] : get_option('posts_per_page');
          $is_views_thumbnail = $instance['is_views_thumbnail'];
          $is_views_info = $instance['is_views_info'];
          $is_views_excerpt = $instance['is_views_excerpt'];

          $myposts = get_posts(array(
            'post_status' => 'publish',
            'posts_per_page' => $count,
            'orderby' => 'post_date',
            'order' => 'desc'));

          if (!empty($myposts)) {
              gr_SetTitleTag(3);
              echo $args['before_widget'];
              if (!empty($widget_title)) {
                  echo $args['before_title'].$widget_title.$args['after_title'];
              }
              echo '<nav class="newPost">';
              foreach ($myposts as $post) {
                  setup_postdata($post); ?>
<div class="postList">
  <div class="postHeader clearfix">
    <div class="articleInformation">
      <?php get_template_part('tp_articletitle'); ?>
      <?php if ($is_views_info) {
                      get_template_part('tp_articletaxonomies');
                  } ?>
    </div>
    <?php if ($is_views_thumbnail) : ?>
    <div class="postImage">
      <a href="<?php the_permalink(); ?>"
        title="<?php the_title(); ?>"><?php get_template_part('tp_eyecathingimage'); ?></a>
    </div>
    <?php endif; ?>
  </div>
  <?php if ($is_views_excerpt) {
                      the_excerpt();
                  } ?>
</div>
<?php
              }
              wp_reset_postdata();
              echo '</nav>';
              echo $args['after_widget'];
          }
      }

      public function form($instance)
      {
          $defaults = array(
            'title' => '新着記事',
            'count' => get_option('posts_per_page'),
            'is_views_thumbnail' => 1,
            'is_views_info' => 1,
            'is_views_excerpt' => 1,
          );
          $instance = wp_parse_args((array)$instance, $defaults);

          $title = sanitize_text_field($instance['title']);
          $count = sanitize_text_field($instance['count']);
          $is_views_thumbnail = $instance['is_views_thumbnail'];
          $is_views_info = $instance['is_views_info'];
          $is_views_excerpt = $instance['is_views_excerpt']; ?>
<p>
  <label
    for="<?php echo $this->get_field_id('title'); ?>">タイトル</label>
  <input
    id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>"
    type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('count'); ?>">表示件数</label>
  <input
    id="<?php echo $this->get_field_id('count'); ?>"
    name="<?php echo $this->get_field_name('count'); ?>"
    type="text" value="<?php echo esc_attr($count); ?>" />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('is_views_thumbnail'); ?>">サムネイルを表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_thumbnail'); ?>"
    name="<?php echo $this->get_field_name('is_views_thumbnail'); ?>"
    type="checkbox" value="on" <?php echo($is_views_thumbnail ? ' checked="checked"' : ''); ?>
  />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('is_views_info'); ?>">投稿日・カテゴリ・タグを表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_info'); ?>"
    name="<?php echo $this->get_field_name('is_views_info'); ?>"
    type="checkbox" value="on" <?php echo($is_views_info ? ' checked="checked"' : ''); ?>
  />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('cois_views_excerptunt'); ?>">記事抜粋を表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_excerpt'); ?>"
    name="<?php echo $this->get_field_name('is_views_excerpt'); ?>"
    type="checkbox" value="on" <?php echo($is_views_excerpt ? ' checked="checked"' : ''); ?>
  />
</p>
<?php
      }

      public function update($new_instance, $old_instance)
      {
          $instance = $old_instance;
          $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
          $instance['count'] = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';
          $instance['is_views_thumbnail'] = $new_instance['is_views_thumbnail'];
          $instance['is_views_info'] = $new_instance['is_views_info'];
          $instance['is_views_excerpt'] = $new_instance['is_views_excerpt'];
          return $instance;
      }
  }

  /* ウィジェット：人気記事の表示
  ----------------------------------------------- */
  class PopularPost extends WP_Widget
  {
      public function __construct()
      {
          $widget_ops = array('description' => '人気記事をサムネイル付きで表示します。');
          parent::__construct('PopularPost', '人気記事の表示', $widget_ops);
      }

      public function widget($args, $instance)
      {
          global $post;
          global $views_count_key;
          $widget_title = $instance['title'];
          $count = !empty($instance['count']) ? $instance['count'] : get_option('posts_per_page');
          $is_views_thumbnail = $instance['is_views_thumbnail'];
          $is_views_info = $instance['is_views_info'];
          $is_views_excerpt = $instance['is_views_excerpt'];
          $is_views_count = $instance['is_views_count'];
          $is_views_same_categoly = $instance['is_views_same_categoly'];

          if ($is_views_same_categoly && ((!is_home() && !is_front_page() && is_single()) || (is_archive() && (is_category() || is_tag())))) {
              $cat_array = array();
              $tag_array = array();
              if (is_archive() && (is_category() || is_tag())) {
                  $catId = get_query_var('cat');
                  $cat = get_category($catId, false);
                  $cat_array[0] = $cat->slug;
                  //
                  $tagId = get_query_var('tag_id');
                  $tag = get_tag($tagId, false);
                  $tag_array[0] = $tag->slug;
              } else {
                  $categories = get_the_category($post->ID);
                  if (!empty($categories)) {
                      foreach ($categories as $catkey => $cat) {
                          $cat_array[$catkey] = $cat->slug;
                      }
                  }
                  $tags = get_the_tags($post->ID);
                  if (!empty($tags)) {
                      foreach ($tags as $tagkey => $tag) {
                          $tag_array[$tagkey] = $tag->slug;
                      }
                  }
              }

              $myposts = get_posts(array(
              'post_status' => 'publish',
              'posts_per_page' => $count,
              'meta_key' => $views_count_key,
              'orderby' => 'meta_value_num',
              'order' => 'desc',
              'tax_query' => array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'category',
                  'field' => 'slug',
                  'terms' => $cat_array,
                  'include_children' => false
                ),
                array(
                  'taxonomy' => 'post_tag',
                  'field' => 'slug',
                  'terms' => $tag_array,
                  )
            )));
          } else {
              $myposts = get_posts(array(
              'post_status' => 'publish',
              'posts_per_page' => $count,
              'meta_key' => $views_count_key,
              'orderby' => 'meta_value_num',
              'order' => 'desc'
            ));
          }

          if (!empty($myposts)) {
              gr_SetTitleTag(3);
              echo $args['before_widget'];
              if (!empty($widget_title)) {
                  echo $args['before_title'].$widget_title.$args['after_title'];
              }
              echo '<nav class="popularPost">';
              foreach ($myposts as $post) {
                  setup_postdata($post); ?>
<div class="postList">
  <div class="postHeader clearfix">
    <div class="articleInformation">
      <?php get_template_part('tp_articletitle'); ?>
      <?php if ($is_views_info) {
                      get_template_part('tp_articletaxonomies');
                  } ?>
      <?php if ($is_views_count) : ?>
      <div class="postCount">
        <?php echo number_format(getPostViews(get_the_ID())).' Views'; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php if ($is_views_thumbnail) : ?>
    <div class="postImage">
      <a href="<?php the_permalink(); ?>"
        title="<?php the_title(); ?>"><?php get_template_part('tp_eyecathingimage'); ?></a>
    </div>
    <?php endif; ?>
  </div>
  <?php if ($is_views_excerpt) {
                      the_excerpt();
                  } ?>
</div>
<?php
              }
              wp_reset_postdata();
              echo '</nav>';
              echo $args['after_widget'];
          }
      }

      public function form($instance)
      {
          $defaults = array(
            'title' => '人気記事',
            'count' => get_option('posts_per_page'),
            'is_views_thumbnail' => 1,
            'is_views_info' => 1,
            'is_views_excerpt' => 1,
            'is_views_count' => 1,
            'is_views_same_categoly' => 1,
          );
          $instance = wp_parse_args((array)$instance, $defaults);

          $title = sanitize_text_field($instance['title']);
          $count = sanitize_text_field($instance['count']);
          $is_views_thumbnail = $instance['is_views_thumbnail'];
          $is_views_info = $instance['is_views_info'];
          $is_views_excerpt = $instance['is_views_excerpt'];
          $is_views_count = $instance['is_views_count'];
          $is_views_same_categoly = $instance['is_views_same_categoly']; ?>
<p>
  <label
    for="<?php echo $this->get_field_id('title'); ?>">タイトル</label>
  <input
    id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>"
    type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('count'); ?>">表示件数</label>
  <input
    id="<?php echo $this->get_field_id('count'); ?>"
    name="<?php echo $this->get_field_name('count'); ?>"
    type="text" value="<?php echo esc_attr($count); ?>" />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('is_views_thumbnail'); ?>">サムネイルを表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_thumbnail'); ?>"
    name="<?php echo $this->get_field_name('is_views_thumbnail'); ?>"
    type="checkbox" value="on" <?php echo($is_views_thumbnail ? ' checked="checked"' : ''); ?>
  />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('is_views_info'); ?>">投稿日・カテゴリ・タグを表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_info'); ?>"
    name="<?php echo $this->get_field_name('is_views_info'); ?>"
    type="checkbox" value="on" <?php echo($is_views_info ? ' checked="checked"' : ''); ?>
  />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('is_views_excerpt'); ?>">記事抜粋を表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_excerpt'); ?>"
    name="<?php echo $this->get_field_name('is_views_excerpt'); ?>"
    type="checkbox" value="on" <?php echo($is_views_excerpt ? ' checked="checked"' : ''); ?>
  />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('is_views_count'); ?>">ビュー数を表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_count'); ?>"
    name="<?php echo $this->get_field_name('is_views_count'); ?>"
    type="checkbox" value="on" <?php echo($is_views_count ? ' checked="checked"' : ''); ?>
  />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('is_views_same_categoly'); ?>">記事ページ、カテゴリー一覧・タグ一覧ページで同じカテゴリ、タグに限定した人気記事を表示する</label>
  <input
    id="<?php echo $this->get_field_id('is_views_same_categoly'); ?>"
    name="<?php echo $this->get_field_name('is_views_same_categoly'); ?>"
    type="checkbox" value="on" <?php echo($is_views_same_categoly ? ' checked="checked"' : ''); ?>
  />
</p>
<?php
      }

      public function update($new_instance, $old_instance)
      {
          $instance = $old_instance;
          $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
          $instance['count'] = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';
          $instance['is_views_thumbnail'] = $new_instance['is_views_thumbnail'];
          $instance['is_views_info'] = $new_instance['is_views_info'];
          $instance['is_views_excerpt'] = $new_instance['is_views_excerpt'];
          $instance['is_views_count'] = $new_instance['is_views_count'];
          $instance['is_views_same_categoly'] = $new_instance['is_views_same_categoly'];
          return $instance;
      }
  }

  /* ウィジェット：目次表示
  ----------------------------------------------- */
  class OutlineWidget extends WP_Widget
  {
      public function __construct()
      {
          $widget_ops = array('description' => '目次を表示します。サイトバーでの使用を想定しています。記事本文を取得できない場合は表示されません。');
          parent::__construct('OutlineWidget', '目次表示', $widget_ops);
      }

      public function widget($args, $instance)
      {
          if (!is_home() && !is_front_page() && is_single()) {
              global $post;
              $widget_title = $instance['title'];
              $widget_id = $instance['id'];

              $post_id = get_the_ID();
              $content = get_post($post_id)->post_content;
              $result = CreateOutline($content);

              if (!empty($result)) {
                  gr_SetTitleTag(3);
                  echo $args['before_widget'];
                  if (!empty($widget_title)) {
                      echo $args['before_title'].$widget_title.$args['after_title'];
                  }
                  echo '<div id="'.$widget_id.'">';
                  echo $result;
                  echo '</div>';
                  echo $args['after_widget'];
              }
          }
      }

      public function form($instance)
      {
          $defaults = array(
            'title' => '目次',
            'id' => 'SideOutline',
          );
          $instance = wp_parse_args((array)$instance, $defaults);

          $title = sanitize_text_field($instance['title']);
          $id = sanitize_text_field($instance['id']); ?>
<p>
  <label
    for="<?php echo $this->get_field_id('title'); ?>">タイトル</label>
  <input
    id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>"
    type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label
    for="<?php echo $this->get_field_id('id'); ?>">ID名</label>
  <input
    id="<?php echo $this->get_field_id('id'); ?>"
    name="<?php echo $this->get_field_name('id'); ?>"
    type="text" value="<?php echo esc_attr($id); ?>" />
</p>
<?php
      }

      public function update($new_instance, $old_instance)
      {
          $instance = $old_instance;
          $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
          $instance['id'] = (!empty($new_instance['id'])) ? strip_tags($new_instance['id']) : '';
          return $instance;
      }
  }

  /* ウィジェットの登録
  ----------------------------------------------- */
  if (!function_exists('theme_register_widget')) {
      function theme_register_widget()
      {
          register_widget('RelatedPost');
          register_widget('SNSButtons');
          register_widget('NewPost');
          register_widget('PopularPost');
          register_widget('OutlineWidget');
      }
      add_action('widgets_init', 'theme_register_widget');
  }

  /* ページネーション
  ----------------------------------------------- */
  if (!function_exists('gr_Pagination')) {
      function gr_Pagination()
      {
          global $wp_query;
      
          $big = 999999999;
          echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'prev_text' => '&lt;',
            'next_text' => '&gt;',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
          ));
      }
  }

  /* 画像挿入時、aタグに rel="lightbox[group]" class="lightboxImage"とtitleにaltを
     imgタグのtitleにaltを設定するようにする
  ---------------------------------------------------------------------------------------------------- */
  if (!function_exists('image_send_alt_title_rel_lightbox')) {
      function image_send_alt_title_rel_lightbox($html, $id='', $caption='', $title='', $align='', $url='', $size='', $alt = '')
      {
          if (strpos($html, 'rel=') === false) {
              $html = preg_replace('#><img #', ' rel="lightbox[group]" class="lightboxImage"><img ', $html, 1);
          }
          if ($alt !== '') {
              $html = preg_replace('#><img #', ' title="'.$alt.'"><img title="'.$alt.'" ', $html, 1);
          }
          return $html;
      }
      add_filter('image_send_to_editor', 'image_send_alt_title_rel_lightbox', 1, 8);
  }

  /* 前後ページ記事へのリンクにクラスを追加
  ----------------------------------------------- */
  if (!function_exists('add_prev_posts_link_class')) {
      function add_prev_posts_link_class()
      {
          return 'class="font-awesome"';
      }
      add_filter('previous_posts_link_attributes', 'add_prev_posts_link_class');
  }
  if (!function_exists('add_next_posts_link_class')) {
      function add_next_posts_link_class()
      {
          return 'class="font-awesome"';
      }
      add_filter('next_posts_link_attributes', 'add_next_posts_link_class');
  }

  /* 抜粋終端文字の変更
  ----------------------------------------------- */
  if (!function_exists('new_excerpt_more')) {
      function new_excerpt_more($more)
      {
          return '……';
      }
      add_filter('excerpt_more', 'new_excerpt_more');
  }

  /* ページタイトルタグ特定
  ----------------------------------------------- */
  if (!function_exists('gr_SetTitleTag')) {
      function gr_SetTitleTag($level)
      {
          global $titleformat;
          global $h1format;
          global $h2format;
          global $h3format;

          switch ($level) {
            case 1:
                $titleformat = $h1format;
                break;
            case 2:
                $titleformat = $h2format;
                break;
            case 3:
                $titleformat = $h3format;
                break;
        }
      }
  }

  /* garyu設定
  ----------------------------------------------- */
  add_action('admin_menu', 'garyu_menu');

  function garyu_menu()
  {
      add_options_page(
          'garyu設定',
          'garyu設定',
          'administrator',
          'garyu-options',
          'garyu_options_page'
      );
      add_action(
          'admin_init',
          'register_garyu_settings'
      );
  }

  function register_garyu_settings()
  {
      register_setting(
          'garyu-settings-group',
          'show_profile'
      );
      register_setting(
          'garyu-settings-group',
          'show_profile_image'
      );
      register_setting(
          'garyu-settings-group',
          'show_profile_imagesize'
      );
      register_setting(
          'garyu-settings-group',
          'site_manager_id'
      );
      register_setting(
          'garyu-settings-group',
          'tracking_id'
      );
      register_setting(
          'garyu-settings-group',
          'twitter_card_account'
      );
      register_setting(
          'garyu-settings-group',
          'twitter_card_type'
      );
      register_setting(
          'garyu-settings-group',
          'blog_card_type'
      );
      register_setting(
          'garyu-settings-group',
          'blog_card_class'
      );
      register_setting(
          'garyu-settings-group',
          'blog_card_title'
      );
      register_setting(
          'garyu-settings-group',
          'show_outline'
      );
      register_setting(
          'garyu-settings-group',
          'show_outline_count'
      );
  }

  function garyu_options_page()
  {
      ?>
<div class="wrap">
  <h1>garyu設定</h1>
  <form method="post" action="options.php">
    <?php
          settings_fields('garyu-settings-group');
      do_settings_sections('garyu-settings-group');
      $imagesize = get_option('show_profile_imagesize');
      if (empty($imagesize)) {
          $imagesize = 100;
      }
      $outline_count = get_option('show_outline_count');
      if (empty($outline_count)) {
          $outline_count = 0;
      } ?>
    <hr>
    <h2 class="title">プロフィール表示</h2>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="show_profile">投稿者情報を表示する</label></th>
          <td>
            <select name="show_profile" id="show_profile">
              <option value="0" <?php selected(0, get_option('show_profile')); ?>
                >表示しない</option>
              <option value="1" <?php selected(1, get_option('show_profile')); ?>
                >投稿記事に表示</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="show_profile_image">プロフィール画像</label></th>
          <td><input type="text" id="show_profile_image" class="regular-text" name="show_profile_image"
              value="<?php echo get_option('show_profile_image'); ?>">
            <p>プロフィール画像のURLを入力してください。未入力の場合、ユーザーのプロフィール写真が使用されます。</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="show_profile_imagesize">プロフィール画像サイズ</label></th>
          <td><input type="number" id="show_profile_imagesize" class="regular-text" name="show_profile_imagesize"
              value="<?php echo $imagesize; ?>">
            <p>プロフィール画像のサイズ（ピクセル数）を入力してください。</p>
          </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <h2 class="title">Google アドセンス（自動広告）</h2>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="site_manager_id">サイト運営者ID</label></th>
          <td><input type="text" id="site_manager_id" class="regular-text" name="site_manager_id"
              value="<?php echo get_option('site_manager_id'); ?>">
          </td>
        </tr>
      </tbody>
    </table>
    <h2 class="title">Google アナリティクス</h2>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="tracking_id">トラッキングID</label></th>
          <td><input type="text" id="tracking_id" class="regular-text" name="tracking_id"
              value="<?php echo get_option('tracking_id'); ?>">
          </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <h2 class="title">Twitterカード</h2>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="twitter_card_account">アカウント</label></th>
          <td><input type="text" id="twitter_card_account" class="regular-text" name="twitter_card_account"
              value="<?php echo get_option('twitter_card_account'); ?>">
            <p>TwitterページURLのXXXXXXX部分を入力してください。＠は不要です。</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="twitter_card_account">カードの種類</label></th>
          <td>
            <select name="twitter_card_type" id="twitter_card_type">
              <option value="0" <?php selected(0, get_option('twitter_card_type')); ?>
                >Summary Card（標準）</option>
              <option value="1" <?php selected(1, get_option('twitter_card_type')); ?>
                >Summary Card with Large Image（大きな画像）</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <h2 class="title">ブログカード</h2>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="blog_card_type">カードの種類</label></th>
          <td>
            <select name="blog_card_type" id="blog_card_type">
              <option value="0" <?php selected(0, get_option('blog_card_type')); ?>
                >サムネイル・タイトル・抜粋記事</option>
              <option value="1" <?php selected(1, get_option('blog_card_type')); ?>
                >タイトルのみ</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="blog_card_class">クラス名</label></th>
          <td><input type="text" id="blog_card_class" class="regular-text" name="blog_card_class"
              value="<?php echo get_option('blog_card_class', 'blogCardStyle'); ?>">
            <p>ブログカード全体をまとめる &lt;article&gt; タグに設定されるクラス名を入力してください。</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="blog_card_title">カードタイトル</label></th>
          <td>
            <select name="blog_card_title" id="blog_card_title">
              <option value="0" <?php selected(0, get_option('blog_card_title')); ?>
                >&lt;span&gt;タグで囲む</option>
              <option value="1" <?php selected(1, get_option('blog_card_title')); ?>
                >&lt;h1&gt;タグで囲む</option>
            </select>
            <p>目次を作成するプラグインなどを使用する場合、&lt;h1&gt;タグで囲むと体裁が崩れる場合があります。</p>
          </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <h2 class="title">目次表示</h2>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="show_outline">目次の表示</label></th>
          <td>
            <select name="show_outline" id="show_outline">
              <option value="0" <?php selected(0, get_option('show_outline')); ?>
                >表示しない</option>
              <option value="1" <?php selected(1, get_option('show_outline')); ?>
                >[outline]が書かれた場所に表示する（書いてない場合は最初のヘッダタグの直上に表示する）</option>
              <option value="2" <?php selected(2, get_option('show_outline')); ?>
                >[outline]が書かれた場所に表示する（書いてない場合は表示しない）</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="show_outline_count">目次の表示条件</label></th>
          <td>
            <input type="number" id="show_outline_count" class="regular-text" name="show_outline_count"
              value="<?php echo $outline_count; ?>">つ以上見出しがある時
          </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <?php submit_button(); ?>
  </form>
</div>
<?php
  }

  /* 表示件数を記録する（人気記事の記録で使用）
  ----------------------------------------------- */
  if (!function_exists('getPostViews')) {
      function setPostViews()
      {
          global $views_count_key;
          $post_id = get_the_ID();
          $view_count = get_post_meta($post_id, $views_count_key, true);
          if ($view_count === '') {
              delete_post_meta($post_id, $views_count_key);
              add_post_meta($post_id, $views_count_key, '1');
          } else {
              $view_count++;
              update_post_meta($post_id, $views_count_key, $view_count);
          }
      }
  }

  /* 表示件数を取得する（人気記事の表示で使用）
  ----------------------------------------------- */
  if (!function_exists('getPostViews')) {
      function getPostViews($post_id = null)
      {
          global $views_count_key;
          $post_id = $post_id ? $post_id : get_the_ID();
          $view_count = get_post_meta($post_id, $views_count_key, true);
          if ($view_count === '') {
              $view_count = 0;
              delete_post_meta($post_id, $views_count_key);
              add_post_meta($post_id, $views_count_key, $view_count);
          }
          return $view_count;
      }
  }
  /* ブログカード表示ショートコード
    指定IDの記事をブログカードで表示する
    引数：blog_id 記事ID
          blog_type カードの種類
          blog_class ブログカード全体をまとめる <section> タグに設定されるクラス名
          blog_title タイトルを囲むタグの種類
  -------------------------------------------------------------------------------- */
  if (!function_exists('GetBlogCard')) {
      function GetBlogCard($atts)
      {
          if (!is_page() && !is_single()) {
              return;
          }
          $blog_card_type = get_option('blog_card_type');
          $blog_card_class = get_option('blog_card_class');
          $blog_card_title = get_option('blog_card_title');
          extract(shortcode_atts(array(
            'blog_id' => -1,
            'blog_type' => $blog_card_type,
            'blog_class' => $blog_card_class,
            'blog_title'  => $blog_card_title,
          ), $atts));

          global $post;
          $result = '';
          $my_id = get_the_ID();
          if ($blog_id != -1 && get_post_status($blog_id) == 'publish' && $my_id != $blog_id) {
              $post = get_post($blog_id);
              if (!empty($post)) {
                  setup_postdata($post);
                  $header = $blog_title == 0 ? '<span class="title">'.get_the_title($blog_id).'</span>' : '<h1 class="title">'.get_the_title($blog_id).'</h1>';
                  $result .= '<article class="'.$blog_class.'"><section><a href="'.get_post_permalink($blog_id).'" class="clearfix">';
                  if ($blog_type != 1) {
                      $result .= '<div class="postImage">';
                      if (has_post_thumbnail()) {
                          $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                          $result .= '<img class="eyeCatchingImage" src="'.$img[0].'" alt="'.get_the_title($blog_id).'">';
                      } elseif (preg_match('/wp-image-(\d+)/s', $post->post_content, $match)) {
                          $img = wp_get_attachment_image_src($match[1], $size);
                          $result .= '<img class="eyeCatchingImage" src="'.$img[0].'" alt="'.get_the_title($blog_id).'">';
                      } elseif (file_exists(get_stylesheet_directory().'/images/noimage.png')) {
                          $result .= '<img class="eyeCatchingImage" src="'.get_stylesheet_directory_uri().'/images/noimage.png" alt="'.get_the_title($blog_id).'">';
                      } else {
                          $result .= '<img class="eyeCatchingImage" src="'.get_template_directory_uri().'/images/noimage.png" alt="'.get_the_title($blog_id).'">';
                      }
                      $result .= '</div>';
                      $result .= '<div class="excerpt">';
                      $result .= $header;
                      $result .= '<p>'.get_the_excerpt().'</p>';
                      $result .= '</div>';
                  } else {
                      $result .= $header;
                  }
                  $result .= '</a></section></article>';
              }
              wp_reset_postdata();
          }
          return $result;
      }
      add_shortcode('BlogCard', 'GetBlogCard');
  }
  /* ブログ記事表示ショートコード
    指定IDの記事全文を表示する
    引数：blog_id 記事ID
          blog_wrap 全体をまとめる <div> タグに設定されるクラス名
  -------------------------------------------------------------------------------- */
  if (!function_exists('GetBlogContent')) {
      function GetBlogContent($atts)
      {
          extract(shortcode_atts(array(
            'blog_id' => -1,
            'blog_wrap' => 'blogContent',
          ), $atts));

          global $post;
          $result = '';
          if ($blog_id != -1 && get_post_status($blog_id) == 'publish') {
              $post = get_post($blog_id);
              if (!empty($post)) {
                  setup_postdata($post);
                  $result .= '<div class="'.$blog_wrap.'">';
                  $result .= apply_filters('the_content', get_the_content());
                  $result .= '</div>';
              }
              wp_reset_postdata();
          }
          return $result;
      }
      add_shortcode('BlogContent', 'GetBlogContent');
  }

  /* lazysizes.js
     クラスに lazyload を追加
     img src を img data-src に
  -------------------------------------------------------------------------------- */
  if (!function_exists('Add_lazysizes_attribute')) {
      function Add_lazysizes_attribute($content)
      {
          $re_content = $content;
          $re_content = preg_replace('/(<img[^>]*)\s+class="([^"]*)"/', '$1 class="$2 lazyload"', $content);
          $re_content = preg_replace('/(<img[^>]*)\s+src=/', '$1 data-src=', $re_content);
          return $re_content;
      }
      add_filter('the_content', 'Add_lazysizes_attribute');
  }

  /* 目次生成
    見出し位置は記事本文中にショートコード [outline] を記載すると、その位置に
    ない場合、最初に見つかった見出しタグの直上とする
  -------------------------------------------------------------------------------- */
  if (!function_exists('AddOutline')) {
      function AddOutline($content)
      {
          if (!is_single() && !is_page()) {
              return $content;
          }

          $shortcode = '[outline]';
          $show_outline = get_option('show_outline');
          $show_outline_count = get_option('show_outline_count');
          if (!$show_outline || ($show_outline == '2' && strpos($content, $shortcode) === false)) {
              return $content;
          }
          $outline = CreateOutline($content, $show_outline_count);

          if ($outline != '') {
              $decorated_outline = sprintf('<div id="outline"><div class="outline_header">目次</div>%s</div>', $outline);

              if (strpos($content, $shortcode) !== false) {
                  $content = str_replace($shortcode, $decorated_outline, $content);
              } elseif (preg_match('/<h[1-6].*>/', $content, $matches, PREG_OFFSET_CAPTURE)) {
                  $pos = $matches[0][1];
                  $content = substr($content, 0, $pos) . $decorated_outline . substr($content, $pos);
              }
          }
          return $content;
      }
      add_filter('the_content', 'AddOutline');
  }
  /* 目次作成
    文章中のHeadingタグを抽出し、目次を生成する。
    本文中は AddOutline フィルターが適用されるため、当ショートコードは不要。
    引数：content 見出しを抽出する文章
          show_outline_count 目次を出力する条件
  -------------------------------------------------------------------------------- */
  if (!function_exists('CreateOutline')) {
      function CreateOutline(&$content, $show_outline_count=0)
      {
          $outline = '';
          if (preg_match_all('/<h([1-6]).*?>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER)) {
              $isSetOutline = ($show_outline_count <= count($matches)) ? true : false;
              $top_level = min(array_map(function ($lv) {
                  return $lv[1];
              }, $matches));
              $counter = array(0, 0, 0, 0, 0, 0, 0);
              $current_level = $top_level - 1;

              foreach ($matches as $match) {
                  $level = $match[1];
                  while ($level < $current_level) {
                      $current_level--;
                      $outline .= '</li></ul>';
                  }

                  if ($current_level == $level) {
                      $outline .= '</li><li>';
                  } else {
                      while ($current_level < $level) {
                          $current_level++;
                          $outline .= sprintf('<ul class="indent_%s"><li>', $current_level - $top_level + 1);
                      }
                      for ($i = $current_level; $i < count($counter); $i++) {
                          $counter[$i] = 0;
                      }
                  }
      
                  $counter[$current_level]++;
                  $level_array = array();
                  for ($i = $top_level; $i <= $level; $i++) {
                      $level_array[]  = $counter[$i];
                  }
                  $target_anchor = 'outline_'.implode('_', $level_array);
                  $outline .= sprintf('<a href="#%s">%s. %s</a>', $target_anchor, implode('.', $level_array), $match[2]);
                  $content = preg_replace('/<h([1-6])>/', '<h\1 id="'.$target_anchor.'">', $content, 1);
              }

              while ($top_level <= $current_level) {
                  $current_level--;
                  $outline .= '</li></ul>';
              }
          }
          return $isSetOutline ? $outline : '';
      }
  }
