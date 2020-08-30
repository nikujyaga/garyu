<div id="Search">
  <form role="search" method="get" id="Searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="font-awesome" placeholder="&#xf002; 検索" value="<?php the_search_query(); ?>" name="s" id="s" />
    <input type="submit" id="SearchSubmit" value="検索" />
  </form>
</div>
