<!-- news-tab.php start -->
<div class="c-tab">
  <div class="c-tab__btn-wrap">
    <button class="c-tab__btn is-active" data-tab="tab1">最新</button>
    <button class="c-tab__btn" data-tab="tab2">お知らせ</button>
    <button class="c-tab__btn" data-tab="tab3">教室・イベント</button>
  </div>

  <div id="tab1" class="c-tab__content is-active">
    <?php
    // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'post_type' => array_merge(['post'], get_custom_post_types()),
      'posts_per_page' => 5,
      'orderby' => 'date',
      'order' => 'DESC',
    );

    $custom_query = new WP_Query($args);
    // 変数をテンプレートに渡す
    set_query_var('custom_query', $custom_query);
    // ループテンプレートを呼び出す
    get_template_part('template/tab-loop');
    ?>
  </div>

  <div id="tab2" class="c-tab__content">
    <?php
    $args = array(
      'post_type' => array_merge(['post'], get_custom_post_types()),
      'posts_per_page' => 5,
      'orderby' => 'date',
      'order' => 'DESC',
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

  <div id="tab3" class="c-tab__content">
  <?php
    $args = array(
      'post_type' => array_merge(['post'], get_custom_post_types()),
      'posts_per_page' => 5,
      'orderby' => 'date',
      'order' => 'DESC',
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
<!-- news-tab.php end -->
