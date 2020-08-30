                  <div class="articleTitle">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                      <?php global $titleformat; echo sprintf($titleformat, get_the_title()); ?>
                    </a>
                  </div>
