<!-- tab-loop.php start -->
<?php
$query = get_query_var('custom_query');
// ページャー用
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if ($query && $query->have_posts()):
  while ($query->have_posts()):
    $query->the_post();
    // ─── カスタムカテゴリー名を取得 ───
    $terms = get_the_terms(get_the_ID(), 'custom_category');
    $term_name = '';
    if ($terms && !is_wp_error($terms)) {
      $term_name = $terms[0]->name;
    }
    // ─── 投稿者の「名」を取得 ───
    // 投稿者ID を取得
    $author_id = get_the_author_meta('ID');
    // 「名」を取得（ユーザープロフィールの「名」フィールド）
    $first_name = get_the_author_meta('first_name', $author_id);
    ?>
    <article class="c-post">
      <time class="c-post__date">
        <?php
        // 投稿日時の Unix タイムスタンプを取得
        $timestamp = get_post_time('U');
        // PHP の date() で英語の曜日付きフォーマット
        echo date('Y.m.d (D)', $timestamp);
        ?>
      </time>
      <?php if ($term_name): ?>
        <span class="c-post__category"><?php echo esc_html($term_name); ?></span>
      <?php endif; ?>

      <a href="<?php the_permalink(); ?>" class="c-post__link">

        <h3>
          <?php if ($first_name): ?>
            <span class="c-post__author"><?php echo esc_html($first_name); ?></span>
          <?php endif; ?>
          <?php the_title(); ?>
        </h3>
      </a>
    </article>
    <?php endwhile;
  // WP-PageNaviを使ったページャー表示
  if (function_exists('wp_pagenavi') && !is_front_page()) {
    wp_pagenavi(array('query' => $query));
  }
  wp_reset_postdata();
else:
  echo '<p>投稿が見つかりませんでした。</p>';
endif;
?>
<!-- tab-loop.php end -->
