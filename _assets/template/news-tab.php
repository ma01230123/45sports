<!-- news-tab.php start -->
<div class="c-tab">
  <div class="c-tab__btn-wrap">
    <button class="c-tab__btn is-active" data-tab="tab1">タブ1</button>
    <button class="c-tab__btn" data-tab="tab2">タブ2</button>
    <button class="c-tab__btn" data-tab="tab3">タブ3</button>
    <button class="c-tab__btn" data-tab="tab4">タブ4</button>
  </div>

  <div id="tab1" class="c-tab__content is-active">
    <h2>タブ1の内容</h2>
    <?php
    // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
      'post_type' => array_merge(['post'], get_custom_post_types()),
      'posts_per_page' => 5,
      // 'paged' => $paged,
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
    <?php get_template_part('template/club-news'); ?>
  </div>

  <div id="tab3" class="c-tab__content">
    <?php get_template_part('template/club-map'); ?>
  </div>

  <div id="tab4" class="c-tab__content">
    <?php get_template_part('template/club-map'); ?>
  </div>
</div>
<!-- news-tab.php end -->
