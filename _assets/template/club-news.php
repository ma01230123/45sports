<!-- club-news.php start  不要かも -->

      <?php
      // 固定ページのスラッグ（例：club-k01）
      $slug = get_post_field('post_name', get_post());

      // club-*** → post-*** に変換
      $custom_post_type = str_replace('club-', 'post-', $slug);

      // ページャー用
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      // クエリ
      $args = array(
        'post_type' => $custom_post_type,
        'posts_per_page' => 5,
        'paged' => $paged,
      );

      $custom_query = new WP_Query($args);

      if ($custom_query->have_posts()):
        echo '<ul class="c-post-k01-list__items">';
        while ($custom_query->have_posts()):
          $custom_query->the_post(); ?>
          <li class="c-post-k01-list__item"
            style="margin-bottom: 1.5rem; border-bottom: 1px solid #ccc; padding-bottom: 1rem;">
            <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
              <h3><?php the_title(); ?></h3>
            </a>
          </li>
        <?php endwhile;
        echo '</ul>';

        // WP-PageNaviを使ったページャー表示
        if (function_exists('wp_pagenavi')) {
          wp_pagenavi(array('query' => $custom_query));
        }

        wp_reset_postdata();
      else:
        echo '<p>投稿が見つかりませんでした。</p>';
      endif;
      ?>

<!-- club-news.php end -->
