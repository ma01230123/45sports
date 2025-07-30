<!-- tab-loop.php start -->
<?php
$query = get_query_var('custom_query');
 // ページャー用
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if ($query && $query->have_posts()) :
  while ($query->have_posts()) : $query->the_post(); ?>
    <article class="c-post">
      <a href="<?php the_permalink(); ?>">
        <h2><?php the_title(); ?></h2>
      </a>
      <!-- <div class="c-post__content">
        <?php the_excerpt(); ?>
      </div> -->
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
