<?php get_header(); ?>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div class="l-single">
  <div class="c-inner">
    <h1 class="c-ttl c-ttl--30">
      <?php the_title(); ?>
    </h1>
    <div class="l-single__icon">
      <time class="c-btn-date">
        <?php
        // 投稿日時の Unix タイムスタンプを取得
        $timestamp = get_post_time('U');
        // PHP の date() で英語の曜日付きフォーマット
        echo date('Y.m.d (D)', $timestamp);
        ?>
      </time>
      <?php
      $terms = get_the_terms(get_the_ID(), 'custom_category');
      if (!is_wp_error($terms) && !empty($terms)) {
        $t = $terms[0];                       // 1つだけ付くので先頭を使う
        echo '<span class="c-btn-category">' . esc_html($t->name) . '</span>';
      }
      ?>
      <?php
      $author_id = get_post_field('post_author', get_the_ID());
      $first_name = get_the_author_meta('first_name', $author_id); // 名（First Name）

      if ($first_name) {
        echo '<span class="c-btn-author">' . esc_html($first_name) . '</span>';
      }
      ?>
    </div>

    <div class="l-single__content">
      <?php the_content(); ?>
    </div><!-- /.l-single__content -->



    <div style="height:8rem"></div>
    <div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
    <div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>




  </div>
</div>





<?php get_footer(); ?>

