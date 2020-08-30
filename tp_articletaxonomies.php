                  <?php if ($post->post_type != 'page') : ?>
                    <div class="postInformationTime">
                      <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php the_time('Y/m/d'); ?>
                      <?php if (get_the_time('Y/m/d') !== get_the_modified_time('Y/m/d')) : ?>
                        &nbsp;<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;<?php the_modified_date('Y/m/d'); ?>
                      <?php endif; ?>
                    </div>
                    <div class="postInformationCategory"><i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;<?php the_category(', ') ?></div>
                    <?php if (has_tag()) : ?>
                      <div class="postInformationTag"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;<?php the_tags('', ', '); ?></div>
                    <?php endif; ?>
                  <?php endif; ?>
