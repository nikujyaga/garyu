  <aside id="SideBar">
    <?php global $sidebar00; if ((is_home() || is_front_page()) && is_active_sidebar($sidebar00)) : ?>
      <div id="TopPageSidebarBlock">
        <?php global $sidebar00; dynamic_sidebar($sidebar00); ?>
      </div>
    <?php endif; ?>
    <?php global $sidebar01; if (is_active_sidebar($sidebar01)) : ?>
      <div id="SidebarBlock">
        <?php global $sidebar01; dynamic_sidebar($sidebar01); ?>
      </div>
    <?php endif; ?>
    <?php global $sidebar02; if (is_active_sidebar($sidebar02)) : ?>
      <div id="ScrollSidebarBlock" class="p_only">
        <?php global $sidebar02; dynamic_sidebar($sidebar02); ?>
      </div>
    <?php endif; ?>
  </aside>
