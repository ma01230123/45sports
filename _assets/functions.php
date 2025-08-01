<?php
/**
 * @ Wordpress -> セキュリティ設定
 *
 */

// 有効にする ID配列
function get_custom_users()
{
  return ['01', '02', '03', '04', '05', '06'];
}

// カスタム投稿タイプ（post-k01〜post-k06）
function get_custom_post_types()
{
  return array_map(fn($user) => 'post-' . $user, get_custom_users());
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


  wp_enqueue_style('my-slick-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');

  wp_enqueue_style('my', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all');
  wp_enqueue_style('status', get_template_directory_uri() . '/assets/css/appendix.css', array(), '1.0.0', 'all');



  wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js', array());




  wp_enqueue_script('my-slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.8.1', true);

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
      'footer_menu01' => 'フッターメニュー01',
      'footer_menu02' => 'フッターメニュー02',
      'footer_menu03' => 'フッターメニュー03',
      'footer_menu04' => 'フッターメニュー04',
      'footer_menu-bottom' => 'フッターメニューボトム',
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




function register_custom_post_types() {
  $custom_post_types = ['post-01', 'post-02', 'post-03', 'post-04', 'post-05', 'post-06'];

  foreach ($custom_post_types as $post_type) {
    register_post_type($post_type, [
      'labels' => [
        'name' => strtoupper($post_type),
        'singular_name' => strtoupper($post_type),
      ],
      'public' => true,
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'show_in_rest' => true,
      'supports' => ['title', 'editor', 'excerpt', 'custom-fields'],
      'capability_type' => $post_type, // 各投稿タイプごとの権限識別子
      'map_meta_cap' => true,         // 権限マッピングを有効にする
    ]);
  }
}
add_action('init', 'register_custom_post_types');



// functions.php に入れる
add_action( 'init', 're_register_custom_category_taxonomy', 0 );
function re_register_custom_category_taxonomy() {
    // 既に存在する custom_category を一旦削除（必要なら）
    // unregister_taxonomy( 'custom_category' );

    $post_types = [ 'post', 'post-01', 'post-02', 'post-03', 'post-04', 'post-05', 'post-06' ];
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

        // ← 権限をカスタム名にマッピング
        'capabilities'      => [
            'manage_terms' => 'manage_custom_category',
            'edit_terms'   => 'edit_custom_category',
            'delete_terms' => 'delete_custom_category',
            'assign_terms' => 'assign_custom_category',
        ],
    ];

    register_taxonomy( 'custom_category', $post_types, $args );
}



// function add_category_cap_to_custom_roles() {
//   $roles = ['author-01', 'author-02', 'author-03', 'author-04', 'author-05', 'author-06'];

//   foreach ($roles as $role_slug) {
//     $role = get_role($role_slug);
//     if ($role) {
//       $role->add_cap('assign_categories');
//       $role->add_cap('edit_categories'); // 必要に応じて
//     }
//   }
// }
// add_action('init', 'add_category_cap_to_custom_roles');


// カスタム投稿タイプの権限を調整
// add_filter('register_post_type_args', 'modify_post_type_capabilities', 10, 2);
// function modify_post_type_capabilities($args, $post_type)
// {

//   if (in_array($post_type, get_custom_post_types(), true)) {
//     $args['capability_type'] = $post_type;  // 例：post-k01
//     $args['map_meta_cap'] = true;           // 権限を細かく制御できるように
//   }

//   return $args;
// }

// add_action('init', 'custom_taxonomy_cat');
// function custom_taxonomy_cat(){
//   register_taxonomy( // カスタムタクソノミーの追加関数
//     'news-cat', // カテゴリーの名前（半角英数字の小文字）
//     'post-01',     // カテゴリーを追加したいカスタム投稿タイプ名
//     array(      // オプション（以下
//       'label' => 'ニュースカテゴリー', // 表示名称
//       'public' => true, // 管理画面に表示するかどうかの指定
//       'hierarchical' => true, // 階層を持たせるかどうか
//       'show_in_rest' => true, // REST APIの有効化。ブロックエディタの有効化。
//     )
//   );
// }





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

//adminにカスタム投稿の権限を付与
// function add_caps_to_administrator()
// {
//   $role = get_role('administrator');
//   if (!$role)
//     return;
//   //get_custom_post_types()で全てのカスタム投稿を呼び出し
//   foreach (get_custom_post_types() as $pt) {
//     $role->add_cap("edit_{$pt}");
//     $role->add_cap("edit_{$pt}s");
//     $role->add_cap("edit_others_{$pt}s");
//     $role->add_cap("edit_private_{$pt}s");
//     $role->add_cap("edit_published_{$pt}s");
//     $role->add_cap("publish_{$pt}s");
//     $role->add_cap("delete_{$pt}s");
//     $role->add_cap("delete_others_{$pt}s");
//     $role->add_cap("delete_private_{$pt}s");
//     $role->add_cap("delete_published_{$pt}s");
//     $role->add_cap("read_{$pt}");
//     $role->add_cap("read_private_{$pt}s");
//   }
// }
// add_action('init', 'add_caps_to_administrator');

// 管理者にカテゴリーの割り当て権限を付与
// function add_assign_categories_cap() {
//   $role = get_role('administrator');
//   if ($role && !$role->has_cap('assign_categories')) {
//     $role->add_cap('assign_categories');
//   }
// }
// add_action('init', 'add_assign_categories_cap');

// function add_assign_categories_to_custom_roles() {
//   $custom_roles = [
//       'author-01',
//       'author-02',
//       'author-03',
//       'author-04',
//       'author-05',
//       'author-06',
//   ];

//   foreach ( $custom_roles as $role_slug ) {
//       $role = get_role( $role_slug );
//       if ( $role ) {
//           $role->add_cap( 'assign_categories' ); // ← カテゴリー選択を許可
//           $role->remove_cap( 'edit_categories' ); // ← 編集はさせない
//           $role->remove_cap( 'delete_categories' ); // ← 削除もさせない
//           $role->remove_cap( 'manage_categories' ); // ← 管理画面へのフルアクセスを防ぐ
//       }
//   }
// }
// add_action( 'init', 'add_assign_categories_to_custom_roles' );

// add_action('init', function () {
//   $role = get_role('author-01');
//   if ($role && !$role->has_cap('assign_categories')) {
//       $role->add_cap('assign_categories');
//   }
// });


// function register_custom_post_type_post_01() {
//   register_post_type('post-01', [
//       'labels' => [
//           'name' => '投稿01',
//           'singular_name' => '投稿01',
//       ],
//       'public' => true,
//       'has_archive' => true,
//       'show_in_menu' => true,
//       'hierarchical' => false,
//       'menu_position' => 5,
//       'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author'],
//       'taxonomies' => ['category'], // ← カテゴリー使用
//       'capability_type' => 'post-01', // 独自の capability base
//       'map_meta_cap' => true,
//       'capabilities' => [
//           'edit_post'           => 'edit_post-01',
//           'read_post'           => 'read_post-01',
//           'delete_post'         => 'delete_post-01',
//           'edit_posts'          => 'edit_post-01s',
//           'edit_others_posts'   => 'edit_others_post-01s',
//           'publish_posts'       => 'publish_post-01s',
//           'read_private_posts'  => 'read_private_post-01s',
//           'delete_posts'        => 'delete_post-01s',
//           'delete_private_posts'=> 'delete_private_post-01s',
//           'delete_published_posts' => 'delete_published_post-01s',
//           'delete_others_posts' => 'delete_others_post-01s',
//           'edit_private_posts'  => 'edit_private_post-01s',
//           'edit_published_posts'=> 'edit_published_post-01s',

//           // ← これがないとカテゴリーを選べません
//           'assign_terms'        => 'assign_categories',

//       ]
//   ]);
// }
// add_action('init', 'register_custom_post_type_post_01');

// add_action('init', function () {
//   // カスタムロール author-01 ～ author-06 に assign_categories 権限を付与
//   $roles = ['author-01', 'author-02', 'author-03', 'author-04', 'author-05', 'author-06'];
//   foreach ($roles as $role_slug) {
//     $role = get_role($role_slug);
//     if ($role && !$role->has_cap('assign_categories')) {
//       $role->add_cap('assign_categories');
//     }
//   }
// });


// function register_custom_post_types() {
//   $custom_post_types = ['post-01', 'post-02', 'post-03', 'post-04', 'post-05', 'post-06'];

//   foreach ($custom_post_types as $post_type) {
//     register_post_type($post_type, [
//       'labels' => [
//         'name' => strtoupper($post_type),
//         'singular_name' => strtoupper($post_type),
//       ],
//       'public' => true,
//       'has_archive' => true,
//       'hierarchical' => false,
//       'menu_position' => null,
//       'show_in_rest' => true,
//       'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
//       'taxonomies' => ['category'], // ← ここでカテゴリーを有効化
//       'capability_type' => $post_type, // 各投稿タイプごとの権限識別子
//       'map_meta_cap' => true,         // 権限マッピングを有効にする
//     ]);
//   }
// }
// add_action('init', 'register_custom_post_types');


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
