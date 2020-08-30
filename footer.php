      <footer id="Footer">
        <nav id="FooterMenu" class="p_only">
          <?php wp_nav_menu(array(
            'theme_location' => 'footer',
            'fallback_cb' => ''));
          ?>
        </nav>
        <div id="BlogInformation">
          <?php bloginfo('name'); ?>
        </div>
        <?php wp_footer(); ?>
      </footer>
    </div>
    <?php get_template_part('tp_body_scriptloader'); ?>
  </body>
</html>
