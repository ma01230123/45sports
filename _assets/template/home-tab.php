<!-- home-tab.php start -->
<!-- php で動くタブ -->
<?php
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'tab01'; // デフォルトは tab01
?>
<div class="c-tab">
  <div class="c-tab__btn-wrap">
    <a class="c-tab__btn <?php if ($active_tab === 'tab01')
      echo 'is-active'; ?>" href="?tab=tab01">最新</a>
    <a class="c-tab__btn <?php if ($active_tab === 'tab02')
      echo 'is-active'; ?>" href="?tab=tab02">お知らせ</a>
    <a class="c-tab__btn <?php if ($active_tab === 'tab03')
      echo 'is-active'; ?>" href="?tab=tab03">教室・<br class="u-hidden-pc u-hidden-tab">イベント</a>
  </div>

  <div class="c-tab__contents">
     <!-- 最新のコンテンツ -->
    <div style=" border-bottom: none" class="c-tab__content <?php if ($active_tab === 'tab01')
      echo 'is-active'; ?>">
      <?php
      // ページャー用
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => array_merge(['post'], get_custom_post_types()),
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
      );

      $custom_query = new WP_Query($args);
      // 変数をテンプレートに渡す
      set_query_var('custom_query', $custom_query);
      // ループテンプレートを呼び出す
      get_template_part('template/tab-loop');
      ?>
    </div>
 <!-- お知らせのコンテンツ -->
    <div style=" border-bottom: none" class="c-tab__content <?php if ($active_tab === 'tab02')
      echo 'is-active'; ?>">
      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => array_merge(['post'], get_custom_post_types()),
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
        'tax_query' => array(
          array(
            'taxonomy' => 'custom_category',   // タクソノミーのスラッグ
            'field' => 'slug',              // 'term_id' でも可
            'terms' => 'cat-notice',        // 絞り込みたいタームのスラッグ
          ),
        ),
      );
      $custom_query = new WP_Query($args);
      set_query_var('custom_query', $custom_query);
      get_template_part('template/tab-loop');
      ?>
    </div>

    <!-- 教室・イベントのコンテンツ -->
    <div style=" border-bottom: none" class="c-tab__content <?php if ($active_tab === 'tab03')
      echo 'is-active'; ?>">
      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => array_merge(['post'], get_custom_post_types()),
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
        'tax_query' => array(
          array(
            'taxonomy' => 'custom_category',   // タクソノミーのスラッグ
            'field' => 'slug',              // 'term_id' でも可
            'terms' => 'cat-event',        // 絞り込みたいタームのスラッグ
          ),
        ),
      );
      $custom_query = new WP_Query($args);
      
      set_query_var('custom_query', $custom_query);
      get_template_part('template/tab-loop');
      ?>
    </div>
  </div>
</div>
<!-- home-tab.php end -->
