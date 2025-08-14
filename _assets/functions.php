<?php
/**
 * @ Wordpress -> セキュリティ設定
 *
 */

// カスタム投稿タイプ（post-01〜post-06）の設定
function get_custom_post_types(): array
{
  return [
    'post-01',
    'post-02',
    'post-03',
    'post-04',
    'post-05',
    'post-06',
    'post-07',
    'post-08',
    'post-09',
    'post-10',
    'post-11',
    'post-12',
    'post-13',
    'post-14',
    'post-15',
    'post-16',
    'post-17',
    'post-18',
  ];
}



//wp_head部分からバージョン情報を削除する
remove_action('wp_head', 'wp_generator');

/* 絵文字表示用のスクリプトとスタイル差所 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');

// EditURI 削除
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

//フィードにもWordPressのバージョン情報を出さない
remove_action('rss2_head', 'the_generator');
remove_action('rss_head', 'the_generator');
remove_action('rdf_header', 'the_generator');
remove_action('atom_head', 'the_generator');

//wp_head、wp_footerから自動で吐き出されるCSSとJSのバージョン情報を出さない
function vc_remove_wp_ver_css_js($src)
{
  if (strpos($src, 'ver='))
    $src = remove_query_arg('ver', $src);
  return $src;
}
add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);

//wp_headが自動で吐き出す、絵文字表示用のスクリプトとスタイルの掃き出しを停止
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles', 10);

//「Wordpressを更新してください」を、管理者以外には非表示
if (!current_user_can('edit_users')) {
  add_action('admin_menu', 'wphidenag');
  function wphidenag()
  {
    remove_action('admin_notices', 'update_nag', 3);
  }
}

//投稿者アーカイブ（/?author=X）を空欄化
add_filter('author_rewrite_rules', '__return_empty_array');
//URLを非表示化
function disable_author_archive()
{
  if (isset($_GET['author']) || preg_match('#/author/.+#', $_SERVER['REQUEST_URI'])) {
    wp_redirect(home_url('/404.php'));
    exit;
  }
}
add_action('init', 'disable_author_archive');


// 管理画面における不要メニューの非表示（必要ならON）
add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php'); // コメントを非表示にしたい場合
});












/**
 * テーマのセットアップ
 * 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support#HTML5
 **/
function my_setup()
{
  add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
  add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
  add_theme_support('title-tag'); // タイトルタグ自動生成
  add_theme_support(
    'html5',
    array( //HTML5でマークアップ
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );
}

add_action('after_setup_theme', 'my_setup');

/**
 * CSSとJavaScriptの読み込み
 */
function my_script_init()
{
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0', 'all');


  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11');

  wp_enqueue_style('my', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all');
  wp_enqueue_style('status', get_template_directory_uri() . '/assets/css/appendix.css', array(), '1.0.0', 'all');






  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);

  wp_enqueue_script('myscript', get_template_directory_uri() . '/assets/js/app.js', array());
  if (is_front_page()) {
    wp_enqueue_script('top_script', get_template_directory_uri() . '/assets/js/top.js', array());

  }
}
add_action('wp_enqueue_scripts', 'my_script_init');



/**
 * メニューの登録
 */

function my_menu_init()
{
  register_nav_menus(
    array(
      'header_menu' => 'ヘッダーメニュー',
      'footer_menu_top' => 'フッターメニュー（上の方）',
      'footer_menu_bottom' => 'フッターメニュー（住所の下）',
      // 'test_menu' => 'テストメニュー',

    )
  );
}
add_action('init', 'my_menu_init');


//bodyにslackのクラス名をつける
add_filter('body_class', 'add_page_slug_class_name');
function add_page_slug_class_name($classes)
{
  if (is_page()) {
    $page = get_post(get_the_ID());
    $classes[] = $page->post_name;
  }
  return $classes;
}

// 管理バーのバンプ処理を無効化
function disable_admin_bar_bump()
{
  if (is_admin_bar_showing()) {
    remove_action('wp_head', '_admin_bar_bump_cb');
  }
}
add_action('get_header', 'disable_admin_bar_bump');

/**
 * Gutenbergのカラーパレット設定
 */
function aktk_editor_color_palette()
{
  add_theme_support('editor-color-palette', array(
    array(
      'name' => 'Main',
      'slug' => 'main',
      'color' => '#E95B3C',
    ),
    array(
      'name' => 'Accent',
      'slug' => 'accent',
      'color' => '#222',
    ),
    array(
      'name' => 'Gray',
      'slug' => 'gray',
      'color' => '#F2F3F1',
    ),
    array(
      'name' => 'Light Gray',
      'slug' => 'light-gray',
      'color' => '#efefef',
    ),
    array(
      'name' => 'Text',
      'slug' => 'text-black',
      'color' => '#000',
    ),
    array(
      'name' => 'White',
      'slug' => 'white',
      'color' => '#ffffff',
    ),
  ));
}

add_action('after_setup_theme', 'aktk_editor_color_palette');




//Snow Monkey FormsでGoogle Analyticsのコンバージョンを設定
//お問い合わせページ
add_filter('snow_monkey_template_part_render_footer', function ($html, $name, $vars) {
  if (is_page('contact')) {
    $html .= "<script>
const form = document.querySelector( '.snow-monkey-form' )
form.addEventListener( 'smf.complete', ( event ) => gtag('event', 'form_contact_submit', {
  'event_category': 'form',
  'event_label': 'submit',
}))
</script>";
  }
  return $html;
}, 10, 3);

//求人申し込みページ
add_filter('snow_monkey_template_part_render_footer', function ($html, $name, $vars) {
  if (is_page('recruit-form')) {
    $html .= "<script>
const form = document.querySelector( '.snow-monkey-form' )
form.addEventListener( 'smf.complete', ( event ) => gtag('event', 'form_recruit_submit', {
  'event_category': 'form',
  'event_label': 'submit',
}))
</script>";
  }
  return $html;
}, 10, 3);

//ショートコードを使ったphpファイルの呼び出し方法
function Include_my_php($params = array())
{
  extract(shortcode_atts(array(
    'file' => 'default'
  ), $params));
  ob_start();
  include(get_theme_root() . '/' . get_template() . "/template/$file.php");
  return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');


// デフォルトのカテゴリーとタグを非表示にする
add_action('init', 'remove_default_taxonomies', 20);
function remove_default_taxonomies()
{
  // 投稿から「カテゴリー」を外す
  unregister_taxonomy_for_object_type('category', 'post');
  // 投稿から「タグ」を外す
  unregister_taxonomy_for_object_type('post_tag', 'post');

  // 管理メニューの「カテゴリー」「タグ」も非表示に
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}

// 投稿編集画面のサイドボックスも消す
add_action('admin_menu', 'remove_default_taxonomy_metaboxes');
function remove_default_taxonomy_metaboxes()
{
  remove_meta_box('categorydiv', 'post', 'side');
  remove_meta_box('tagsdiv-post_tag', 'post', 'side');
}





// カスタム投稿タイプを登録（ラベルに「投稿-01」形式を使う）
add_action('init', 'register_custom_post_types', 0);
function register_custom_post_types()
{
  foreach (get_custom_post_types() as $post_type) {
    // "post-01" → "投稿-01" に変換
    $label_name = str_replace('post', '投稿', $post_type);

    register_post_type($post_type, [
      'labels' => [
        'name' => $label_name,
        'singular_name' => $label_name,
      ],
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'menu_position' => null,
      'show_in_rest' => true,
      'supports' => ['title', 'editor', 'excerpt', 'custom-fields'],
      'capability_type' => $post_type,
      'map_meta_cap' => true,
    ]);
  }
}




// タクソノミー「カスタムカテゴリー」の作成
add_action('init', 'register_custom_category_taxonomy', 0);
function register_custom_category_taxonomy()
{
  // デフォルト投稿'post' と上記カスタム投稿をマージ
  $post_types = array_merge(['post'], get_custom_post_types());

  $labels = [
    'name' => 'カスタムカテゴリー',
    'singular_name' => 'カスタムカテゴリー',
    'search_items' => 'カスタムカテゴリーを検索',
    'all_items' => 'すべてのカスタムカテゴリー',
    'parent_item' => '親カスタムカテゴリー',
    'parent_item_colon' => '親カスタムカテゴリー：',
    'edit_item' => 'カスタムカテゴリーを編集',
    'update_item' => 'カスタムカテゴリーを更新',
    'add_new_item' => '新しいカスタムカテゴリーを追加',
    'new_item_name' => '新しいカスタムカテゴリー名',
    'menu_name' => 'カスタムカテゴリー',
  ];

  $args = [
    'labels' => $labels,
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'rewrite' => ['slug' => 'custom_category'],
    'capabilities' => [
      'manage_terms' => 'manage_custom_category',
      'edit_terms' => 'edit_custom_category',
      'delete_terms' => 'delete_custom_category',
      'assign_terms' => 'assign_custom_category',
    ],
    'default_term' => [
      'name' => 'お知らせ',
      'slug' => 'cat-notice',
      'description' => '未選択時に自動付与される既定のカテゴリ',
    ],
  ];

  register_taxonomy('custom_category', $post_types, $args);
}








// 他人のメディアを表示しない
add_filter('ajax_query_attachments_args', 'filter_media_library_for_current_user');
function filter_media_library_for_current_user($query)
{
  // 管理者には制限しない
  if (current_user_can('manage_options')) {
    return $query;
  }

  $user_id = get_current_user_id();
  if ($user_id) {
    $query['author'] = $user_id;
  }

  return $query;
}




// add_action( 'admin_head', function() {
//   echo '<style>
//   /* 投稿編集画面本体のカスタムタクソノミー「なし」を非表示 */
//   #taxonomy-custom_category ul > li:first-child {
//       display: none !important;
//   }
//   /* クイック編集の「なし」も再度隠す */
//   .inline-edit-col.column-custom_category input[type="radio"][value="0"],
//   .inline-edit-col.column-custom_category label[for*="custom_category-0"],
//   .quick-edit-row input[type="radio"][value="0"],
//   .quick-edit-row label[for*="custom_category-0"],
//   .quick-edit-row li#custom_category-0,
//   .editor-editor-interface fieldset#inspector-radio-control-0 {
//       display: none !important;
//   }
//   </style>';
// } );



// SCFのメタキーをREST公開。画像はURLを入れるので type:string
add_action('init', function () {
  $map = [
    'cf-corporation' => 'string',
    'cf-name' => 'string',
    'cf-area-name' => 'string',
    'cf-area-color' => 'string',
    'cf-slide' => 'integer', // 画像ID
    'cf-look' => 'integer', // 画像ID
  ];
  foreach ($map as $key => $type) {
    register_post_meta('page', $key, [
      'single' => true,
      'type' => $type,
      'show_in_rest' => true,
      'auth_callback' => fn() => current_user_can('edit_pages'),
    ]);
  }
});



// 投稿ページ（/news/）のメインクエリを調整
add_action('pre_get_posts', function ($q) {
  if (is_admin() || !$q->is_main_query())
    return;

  if ($q->is_home()) { // 設定 > 表示 で「投稿ページ」が /news の想定
    if (function_exists('get_custom_post_types')) {
      $q->set('post_type', array_merge(['post'], get_custom_post_types()));
    }
    $q->set('orderby', 'date');
    $q->set('order', 'DESC');
    $q->set('posts_per_page', 5); // タブ1と同じ件数に
  }
});


// アップロード時の中間サイズを一切生成しない
add_filter('intermediate_image_sizes_advanced', function ($sizes) {
  return []; // すべての登録サイズを無効化
});

/**
 * Pages 一覧に「地区名」「地区カラー」「順序」を追加（club の子ページのみ表示）
 */

function my_get_club_page_id(): int
{
  $p = get_page_by_path('club', OBJECT, 'page');
  return $p ? (int) $p->ID : 0;
}

// 列の追加：タイトル直後に差し込む
add_filter('manage_edit-page_columns', function ($columns) {
  $new = [];
  foreach ($columns as $key => $label) {
    $new[$key] = $label;
    if ($key === 'title') {
      $new['cf_area_name'] = '地区名';
      $new['cf_area_color'] = '地区カラー';
      $new['menu_order_col'] = '順序';
    }
  }
  return $new;
});

// 各セルの中身
add_action('manage_page_posts_custom_column', function ($column, $post_id) {
  if (!in_array($column, ['cf_area_name', 'cf_area_color', 'menu_order_col'], true)) {
    return;
  }

  // club の“直下の子ページ”のみ表示（それ以外はダッシュ）
  $club_id = my_get_club_page_id();
  $parent_id = wp_get_post_parent_id($post_id);
  if (!$club_id || $parent_id !== $club_id) {
    echo '—';
    return;
  }

  if ($column === 'cf_area_name') {
    $name = get_post_meta($post_id, 'cf-area-name', true);
    echo $name !== '' ? esc_html($name) : '—';
    return;
  }

  if ($column === 'cf_area_color') {
    $color_raw = (string) get_post_meta($post_id, 'cf-area-color', true);
    if ($color_raw === '') {
      echo '—';
      return;
    }

    $color_raw = '#' . ltrim($color_raw, "# \t\n\r\0\x0B");
    $color = sanitize_hex_color($color_raw);
    if (!$color) {
      echo '<code>' . esc_html($color_raw) . '</code>';
      return;
    }

    printf(
      '<span aria-label="%1$s" style="display:inline-block;width:1.2em;height:1.2em;border:1px solid #ccc;border-radius:3px;vertical-align:middle;background:%1$s;margin-right:.4em;"></span><code>%2$s</code>',
      esc_attr($color),
      esc_html($color)
    );
    return;
  }

  if ($column === 'menu_order_col') {
    // ページ属性 > 並び順（menu_order）
    $order = (int) get_post_field('menu_order', $post_id);
    echo esc_html($order);
    return;
  }
}, 10, 2);

// 列幅の調整（任意）
add_action('admin_head-edit.php', function () {
  $screen = get_current_screen();
  if ($screen && $screen->id === 'edit-page') {
    echo '<style>
          .column-cf_area_name{ width: 14em; }
          .column-cf_area_color{ width: 10em; }
          .column-menu_order_col{ width: 6em; text-align:right; }
          .column-menu_order_col a{ display:inline-block; width:100%; text-align:right; }
      </style>';
  }
});

// 「順序」列を並び替え可能に
add_filter('manage_edit-page_sortable_columns', function ($sortable) {
  $sortable['menu_order_col'] = 'menu_order';
  return $sortable;
});

// 並び替え実行（管理画面のページ一覧のみ）
add_action('pre_get_posts', function ($query) {
  if (!is_admin() || !$query->is_main_query())
    return;
  if ($query->get('post_type') !== 'page')
    return;

  if ($query->get('orderby') === 'menu_order') {
    // 数値の昇順（必要なら DESC に）
    $query->set('orderby', 'menu_order');
    if (!$query->get('order')) {
      $query->set('order', 'ASC');
    }
  }
});


/**
 * オリジナル パンくず
 * - club 直下の子ページは「cf-corporation + cf-name」で表示
 * - 投稿(single post)は「ホーム > 投稿ページ(あれば) > 記事タイトル」
 * - それ以外は基本的なページ階層/アーカイブに対応（簡易版）
 */

if (!function_exists('my_get_club_page_id')) {
  function my_get_club_page_id(): int
  {
    $p = get_page_by_path('club', OBJECT, 'page');
    return $p ? (int) $p->ID : 0;
  }
}

if (!function_exists('my_get_club_child_label')) {
  /**
   * club 直下の子ページならカスタムラベル（cf-corporation + cf-name）を返す
   * それ以外は null
   */
  function my_get_club_child_label(int $post_id): ?string
  {
    $club_id = my_get_club_page_id();
    if (!$club_id)
      return null;
    if ((int) wp_get_post_parent_id($post_id) !== $club_id)
      return null;

    $corp = (string) get_post_meta($post_id, 'cf-corporation', true);
    $name = (string) get_post_meta($post_id, 'cf-name', true);
    $joined = trim($corp . (($corp && $name) ? ' ' : '') . $name);
    return $joined !== '' ? wp_strip_all_tags($joined) : null;
  }
}


/**
 * オリジナル パンくず（テンプレ判定 安定版）
 * - club.php テンプレのページは「cf-corporation + cf-name」で表示
 * - 投稿(single post)は「ホーム > 記事タイトル」
 * - schema.org 対応
 */

/** 指定した post_id のページテンプレが club.php かを判定 */
if (!function_exists('my_is_club_template_by_id')) {
  function my_is_club_template_by_id(int $post_id): bool {
      $slug = (string) get_page_template_slug($post_id); // 例: 'club.php' / 'templates/club.php' / ''(default)
      if ($slug === '' || $slug === 'default') return false;
      $base = function_exists('wp_basename') ? wp_basename($slug) : basename($slug);
      return ($base === 'club.php');
  }
}

/** ページ用ラベル: club.php なら cf-corporation + cf-name、なければ通常タイトル */
if (!function_exists('my_page_label')) {
  function my_page_label(int $post_id): string {
      if (my_is_club_template_by_id($post_id)) {
          $corp = (string) get_post_meta($post_id, 'cf-corporation', true);
          $name = (string) get_post_meta($post_id, 'cf-name', true);
          $joined = trim($corp . (($corp && $name) ? ' ' : '') . $name);
          if ($joined !== '') {
              return wp_strip_all_tags($joined);
          }
      }
      return get_the_title($post_id);
  }
}

/** パンくず出力 */
if (!function_exists('my_breadcrumbs')) {
  function my_breadcrumbs(array $args = []): void {
      if (is_front_page()) return;

      $home_label = $args['home_label'] ?? 'ホーム';
      $home_url   = home_url('/');

      $crumbs   = [];
      $crumbs[] = ['url' => $home_url, 'label' => $home_label];

      // ※順番が重要：投稿 → 固定ページ → その他
      if (is_single('')) {
          // 投稿は「ホーム > 記事タイトル」
          $crumbs[] = ['url' => '', 'label' => get_the_title(get_the_ID())];

      } elseif (is_page()) {
          $post_id   = get_the_ID();
          $ancestors = array_reverse(get_post_ancestors($post_id)); // 祖先を上位→下位へ

          foreach ($ancestors as $aid) {
              $crumbs[] = [
                  'url'   => get_permalink($aid),
                  'label' => my_page_label($aid),
              ];
          }
          $crumbs[] = ['url' => '', 'label' => my_page_label($post_id)];

      } elseif (is_post_type_archive()) {
          $crumbs[] = ['url' => '', 'label' => wp_strip_all_tags(get_the_archive_title())];

      } elseif (is_tax() || is_category() || is_tag()) {
          $crumbs[] = ['url' => '', 'label' => wp_strip_all_tags(get_the_archive_title())];

      } elseif (is_search()) {
          $crumbs[] = ['url' => '', 'label' => '検索結果: ' . get_search_query(false)];

      } elseif (is_404()) {
          $crumbs[] = ['url' => '', 'label' => 'ページが見つかりません'];

      } elseif (is_date()) {
          $crumbs[] = ['url' => '', 'label' => wp_strip_all_tags(get_the_archive_title())];

      } elseif (is_home()) {
          $title = get_the_title((int) get_option('page_for_posts')) ?: 'ブログ';
          $crumbs[] = ['url' => '', 'label' => $title];
      }

      // 出力
      echo '<nav class="breadcrumbs" aria-label="breadcrumb">';
      echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';
      $pos = 1; $last = count($crumbs) - 1;
      foreach ($crumbs as $i => $c) {
          $label = esc_html($c['label']);
          $url   = trim((string) ($c['url'] ?? ''));
          $is_last = ($i === $last);

          echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
          if ($url && !$is_last) {
              printf('<a itemprop="item" href="%s"><span itemprop="name">%s</span></a>', esc_url($url), $label);
          } else {
              printf('<span itemprop="name" aria-current="page">%s</span>', $label);
          }
          printf('<meta itemprop="position" content="%d">', $pos++);
          echo '</li>';
      }
      echo '</ol>';
      echo '</nav>';
  }
}
