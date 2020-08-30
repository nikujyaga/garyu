<nav id="Breadcrumb">
  <?php if (!is_home() && !is_front_page()) : ?>
    <a href="<?php echo home_url(); ?>">Home</a>
    <?php
    $sep = ' > ';
    echo $sep;

    if (is_page()) {
        // 固定ページの階層を表示
        foreach (array_reverse(get_post_ancestors($post->ID)) as $id) {
            echo '<a href="'.get_page_link($id).'">'.get_page($id)->post_title.'</a>'.$sep;
        }
    } elseif (is_single() || is_category()) {
        // 投稿記事ページとカテゴリーページでの、カテゴリーの階層を表示
        $cats = '';
        $cat_id = '';
        if (is_single()) {
            $cats = get_the_category();
            if (isset($cats[0]->term_id)) {
                $cat_id = $cats[0]->term_id;
            }
        } elseif (is_category()) {
            $cats = get_queried_object();
            $cat_id = $cats->parent;
        }
        $cat_list = array();
        while ($cat_id != 0) {
            $cat = get_category($cat_id);
            $cat_link = get_category_link($cat_id);
            array_unshift($cat_list, '<a href="'.$cat_link.'">'.$cat->name.'</a>');
            $cat_id = $cat->parent;
        }
        foreach ($cat_list as $value) {
            echo $value.$sep;
        }
    }

    //現在のページ名を表示
    if (is_singular()) {
        if (is_attachment()) {
            previous_post_link('%link');
        }
        the_title();
    } elseif (is_archive()) {
        if (is_category()) {
            single_cat_title('', true);
        } elseif (is_tag()) {
            single_tag_title('', true);
        } else {
            the_archive_title();
        }
    } elseif (is_author()) {
        echo '<span class="vCard">'.get_the_author().'</span>';
    } elseif (is_search()) {
        echo '検索 : '.get_search_query();
    } elseif (is_404()) {
        echo 'ページが見つかりません';
    }
    ?>
  <?php endif; ?>
</nav>