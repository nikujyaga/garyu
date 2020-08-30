            <div class="postList">
              <div class="postHeader clearfix">
                <?php get_template_part('tp_articleinformation'); ?>
                <div class="postImage">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php get_template_part('tp_eyecathingimage'); ?></a>
                </div>
              </div>
              <?php the_excerpt(); ?>
            </div>
