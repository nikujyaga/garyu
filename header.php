<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv='x-dns-prefetch-control' content='on'>
  <link rel='dns-prefetch' href='//pagead2.googlesyndication.com'>
  <link rel='dns-prefetch' href='//googleads.g.doubleclick.net'>
  <link rel='dns-prefetch' href='//tpc.googlesyndication.com'>
  <link rel='dns-prefetch' href='//www.gstatic.com'>
  <link rel='dns-prefetch' href='//adservice.google.com'>
  <link rel='dns-prefetch' href='//adservice.google.ca'>
  <link rel='dns-prefetch' href='//www.google.com'>
  <link rel='dns-prefetch' href='//stats.wp.com'>
  <link rel='dns-prefetch' href='//cse.google.com'>
  <link rel='dns-prefetch' href='//www.googletagmanager.com'>

  <link rel='preconnect dns-prefetch' href='www.google.com/analytics/analytics/'>
  <link rel='preconnect dns-prefetch' href='developers.google.com/speed/libraries/'>
  <link rel='preconnect dns-prefetch' href='developers.google.com/apis-explorer/#p'>
  <link rel='preconnect dns-prefetch' href='www.bootstrapcdn.com/'>
  <link rel='preconnect dns-prefetch' href='marketingplatform.google.com/about/tag-manager/'>
  <link rel='preconnect dns-prefetch' href='fontawesome.com/'>
  <link rel='preconnect dns-prefetch' href='www.doubleclickbygoogle.com/'>
  <?php
      $tracking_id = get_option('tracking_id');
      if (!is_user_logged_in() && !empty($tracking_id)) : get_template_part('tp_analyticstracking'); endif;
      $site_manager_id = get_option('site_manager_id');
      if (!empty($site_manager_id)) : get_template_part('tp_googleadsense'); endif;
    ?>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <?php if (is_home() || is_front_page()) : ?>
  <meta name="description"
    content="<?php bloginfo('description'); ?>">
  <?php elseif (is_singular() && has_excerpt()) : ?>
  <meta name="description"
    content="<?php echo get_the_excerpt(); ?>">
  <?php endif; ?>
  <?php
      $twitter_card_account = get_option('twitter_card_account');
      if (!empty($twitter_card_account)) : get_template_part('tp_twittercard'); endif;
    ?>
  <?php if (is_home() || is_front_page() || !is_singular()) : ?>
  <?php if (!is_home() && !is_front_page()) : ?>
  <meta name="robots" content="noindex, follow">
  <?php endif; ?>
  <title><?php bloginfo('name'); ?>
  </title>
  <?php else : ?>
  <title><?php echo get_the_title(); ?> | <?php bloginfo('name'); ?>
  </title>
  <?php endif; ?>
  <?php wp_head(); ?>
  <?php get_template_part('tp_header_scriptloader'); ?>
</head>

<body>
  <div id="Wrapper" class="clearfix">
    <header>
      <nav id="HeaderMenu" class="p_only">
        <?php wp_nav_menu(array(
            'theme_location' => 'header',
            'fallback_cb' => ''));
          ?>
      </nav>
      <?php $headerImage = get_header_image(); ?>
      <?php if (!empty($headerImage)) : ?>
      <div id="HeaderImage">
        <?php if (is_home() || is_front_page()) : ?>
        <h1><a href="<?php echo home_url(); ?>"><img
              src="<?php header_image(); ?>"
              alt="<?php bloginfo('name'); ?>" /></a>
        </h1>
        <?php else : ?>
        <a href="<?php echo home_url(); ?>"><img
            src="<?php header_image(); ?>"
            alt="<?php bloginfo('name'); ?>" /></a>
        <?php endif;?>
      </div>
      <?php else : ?>
      <div id="HeaderTitle">
        <?php if (is_home() || is_front_page()) : ?>
        <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php else : ?>
        <p><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>
        <?php endif;?>
      </div>
      <?php endif;?>
      <nav id="MainMenu" class="p_only clearfix">
        <?php wp_nav_menu(array(
            'theme_location' => 'main',
            'fallback_cb' => ''));
          ?>
      </nav>
      <nav id="MobileMenu" class="m_only">
        <div id="Trigger">
          <span id="TriggerName"><i class="fa fa-bars"></i>&nbsp;メニュー</span>
        </div>
        <div id="AccordionTree">
          <?php wp_nav_menu(array(
              'theme_location' => 'main',
              'fallback_cb' => ''));
            ?>
        </div>
      </nav>
    </header>