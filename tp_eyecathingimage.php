            <?php if (has_post_thumbnail()) : ?>
            <?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
            <img class="eyeCatchingImage" src="<?php echo $img[0]; ?>" alt="<?php the_title();?>">
            <?php elseif (preg_match('/wp-image-(\d+)/s', $post->post_content, $match)) : ?>
            <?php $img = wp_get_attachment_image_src($match[1], $size); ?>
            <img class="eyeCatchingImage" src="<?php echo $img[0]; ?>" alt="<?php the_title();?>">
            <?php elseif (file_exists(get_stylesheet_directory().'/images/noimage.png')) : ?>
            <img class="eyeCatchingImage" src="<?php echo get_stylesheet_directory_uri().'/images/noimage.png' ?>" alt="<?php the_title();?>">
            <?php else : ?>
            <img class="eyeCatchingImage" src="<?php echo get_template_directory_uri().'/images/noimage.png' ?>" alt="<?php the_title();?>">
            <?php endif; ?>
