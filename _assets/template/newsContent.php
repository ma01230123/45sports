<?php
    /* 現在のページ数を取得 */
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $myposts = get_posts(array(
      'post_type' => 'post', // 投稿タイプ
      'posts_per_page' => 3, // 3件を取得
      'paged' => $paged,  
      'orderby' => 'DESC',
      'no_found_rows' => false,
    ));
    ?>
    <div class="c-card-newsContent">
      <?php foreach ($myposts as $post) : setup_postdata($post); ?>
      <article class="c-card-newsContent__item">
          <time class="c-card-newsContent__item-published"
            datetime="<?php the_time('c'); ?>"><?php the_time('Y年m月d日'); ?></time>
      <span class="c-card-newsContent__category">
              <?php the_category(); ?>
            </span>
        <a href="<?php echo esc_url(get_permalink($post)); ?>" class="c-card-newsContent__item-link">
          <h2 class="c-card-newsContent__item-title">
            <?php echo esc_html(get_the_title()); ?>
          </h2>
        </a>
      </article>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>

    <div style="height:4rem" aria-hidden="true" class="wp-block-spacer"></div>

    <div class="c-pagenavi">
      <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
    </div><!-- /.c-pagenavi -->