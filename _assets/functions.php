<?php
/**
 * @ Wordpress -> セキュリティ設定
 *
 */

// カスタム投稿タイプ（post-01〜post-06）の設定
function get_custom_post_types(): array {
  return [
      'post-01',
      'post-02',
      'post-03',
      'post-04',
      'post-05',
      'post-06',
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
add_action('admin_menu', function() {
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
function disable_admin_bar_bump() {
  if ( is_admin_bar_showing() ) {
      remove_action( 'wp_head', '_admin_bar_bump_cb' );
  }
}
add_action( 'get_header', 'disable_admin_bar_bump' );

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
add_action( 'init', 'remove_default_taxonomies', 20 );
function remove_default_taxonomies() {
    // 投稿から「カテゴリー」を外す
    unregister_taxonomy_for_object_type( 'category', 'post' );
    // 投稿から「タグ」を外す
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );

    // 管理メニューの「カテゴリー」「タグ」も非表示に
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
}

// 投稿編集画面のサイドボックスも消す
add_action( 'admin_menu', 'remove_default_taxonomy_metaboxes' );
function remove_default_taxonomy_metaboxes() {
    remove_meta_box( 'categorydiv',       'post', 'side' );
    remove_meta_box( 'tagsdiv-post_tag',  'post', 'side' );
}





// カスタム投稿タイプを登録（ラベルに「投稿-01」形式を使う）
add_action( 'init', 'register_custom_post_types', 0 );
function register_custom_post_types() {
    foreach ( get_custom_post_types() as $post_type ) {
        // "post-01" → "投稿-01" に変換
        $label_name = str_replace( 'post', '投稿', $post_type );

        register_post_type( $post_type, [
            'labels'        => [
                'name'          => $label_name,
                'singular_name' => $label_name,
            ],
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => false,
            'menu_position' => null,
            'show_in_rest'  => true,
            'supports'      => [ 'title', 'editor', 'excerpt', 'custom-fields' ],
            'capability_type' => $post_type,
            'map_meta_cap'    => true,
        ] );
    }
}




// タクソノミー「カスタムカテゴリー」の作成
add_action( 'init', 'register_custom_category_taxonomy', 0 );
function register_custom_category_taxonomy() {
    // デフォルト投稿'post' と上記カスタム投稿をマージ
    $post_types = array_merge( [ 'post' ], get_custom_post_types() );

    $labels = [
        'name'              => 'カスタムカテゴリー',
        'singular_name'     => 'カスタムカテゴリー',
        'search_items'      => 'カスタムカテゴリーを検索',
        'all_items'         => 'すべてのカスタムカテゴリー',
        'parent_item'       => '親カスタムカテゴリー',
        'parent_item_colon' => '親カスタムカテゴリー：',
        'edit_item'         => 'カスタムカテゴリーを編集',
        'update_item'       => 'カスタムカテゴリーを更新',
        'add_new_item'      => '新しいカスタムカテゴリーを追加',
        'new_item_name'     => '新しいカスタムカテゴリー名',
        'menu_name'         => 'カスタムカテゴリー',
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'custom_category' ],
        'capabilities'      => [
            'manage_terms' => 'manage_custom_category',
            'edit_terms'   => 'edit_custom_category',
            'delete_terms' => 'delete_custom_category',
            'assign_terms' => 'assign_custom_category',
        ],
    ];

    register_taxonomy( 'custom_category', $post_types, $args );
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




add_action( 'admin_head', function() {
  echo '<style>
  /* 投稿編集画面本体のカスタムタクソノミー「なし」を非表示 */
  #taxonomy-custom_category ul > li:first-child {
      display: none !important;
  }
  /* クイック編集の「なし」も再度隠す */
  .inline-edit-col.column-custom_category input[type="radio"][value="0"],
  .inline-edit-col.column-custom_category label[for*="custom_category-0"],
  .quick-edit-row input[type="radio"][value="0"],
  .quick-edit-row label[for*="custom_category-0"],
  .quick-edit-row li#custom_category-0,
  .editor-editor-interface fieldset#inspector-radio-control-0 {
      display: none !important;
  }
  </style>';
} );
