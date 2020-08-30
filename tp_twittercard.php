<?php
  $twitter_card_account = get_option('twitter_card_account');
  $twitter_card_type = get_option('twitter_card_type') == '1' ? 'summary_large_image' : 'summary';
  if (is_singular()) {
    $og_type = "article";
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        $twitter_description =  mb_strimwidth(get_the_excerpt(), 0, 100, '…', 'utf-8');
      }
    }
    $twitter_title = get_the_title();
    $twitter_url = get_permalink();
    //
    if (has_post_thumbnail()) {
      $twitter_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
      $twitter_img_url = $twitter_img[0];
    } elseif (preg_match('/wp-image-(\d+)/s', $post->post_content, $match)) {
      $twitter_img = wp_get_attachment_image_src($match[1], $size);
      $twitter_img_url = $twitter_img[0];
    } elseif (file_exists(get_stylesheet_directory().'/images/noimage.png')) {
      $twitter_img_url = get_stylesheet_directory_uri().'/images/noimage.png';
    } else {
      $twitter_img_url = get_template_directory_uri().'/images/noimage.png';
    }
  } else {
    if (is_home() || is_front_page()) {
      $og_type = "website";
    } else {
      $og_type = "article";
    }
    $twitter_description = mb_strimwidth(get_bloginfo('description'), 0, 100, '…', 'utf-8');
    $twitter_title = get_bloginfo('name');
    $twitter_url = get_bloginfo('url');
    //
    if (get_header_image()) {
      $twitter_img_url = get_header_image();
    } elseif (file_exists(get_stylesheet_directory_uri().'/screenshot.png')) {
      $twitter_img_url = get_stylesheet_directory_uri().'/screenshot.png';
    } else {
      $twitter_img_url = get_template_directory_uri().'/screenshot.png';
    }
  }
?>
<meta name="twitter:card" content="<?php echo $twitter_card_type; ?>" />
<meta name="twitter:site" content="@<?php echo $twitter_card_account; ?>" />
<meta name="twitter:url" content="<?php echo $twitter_url; ?>" />
<meta name="twitter:title" content="<?php echo $twitter_title; ?>" />
<meta name="twitter:description" content="<?php echo $twitter_description; ?>" />
<meta name="twitter:image" content="<?php echo $twitter_img_url; ?>" />
