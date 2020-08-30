            <div class="postList">
              <div class="postHeader clearfix">
                <div class="articleInformation">
                    <?php get_template_part('tp_articletitle'); ?>
                    <?php if ($post->post_type != 'page') : ?>
                    <div class="postInformationTime">
                      <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php the_time('Y/m/d'); ?>
                      <?php if (get_the_time('Y/m/d') !== get_the_modified_time('Y/m/d')) : ?>
                        &nbsp;<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;<?php the_modified_date('Y/m/d'); ?>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="postImage">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php get_template_part('tp_eyecathingimage'); ?></a>
                </div>
              </div>
              <?php the_excerpt(); ?>
            </div>
