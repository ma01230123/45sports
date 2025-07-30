<?php
/**
 * @ Wordpress -> セキュリティ設定
 *
 */

// k01〜k06 のユーザーID配列
function get_custom_users() {
  return ['k01', 'k02', 'k03', 'k04', 'k05', 'k06'];
}

// カスタム投稿タイプ（post-k01〜post-k06）
function get_custom_post_types() {
  return array_map(fn($user) => 'post-' . $user, get_custom_users());
}






//wp_head部分からバージョン情報を削除する
remove_action('wp_head', 'wp_generator');

/* 絵文字表示用のスクリプトとスタイル差所 */
remove_action('wp_head',             'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles',     'print_emoji_styles');
remove_action('admin_print_styles',  'print_emoji_styles');
add_filter( 'emoji_svg_url', '__return_false' );

// EditURI 削除
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

//フィードにもWordPressのバージョン情報を出さない
remove_action('rss2_head',  'the_generator');
remove_action('rss_head',   'the_generator');
remove_action('rdf_header', 'the_generator');
remove_action('atom_head',  'the_generator');

//wp_head、wp_footerから自動で吐き出されるCSSとJSのバージョン情報を出さない
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

//wp_headが自動で吐き出す、絵文字表示用のスクリプトとスタイルの掃き出しを停止
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );

//「Wordpressを更新してください」を、管理者以外には非表示
if (!current_user_can('edit_users')) {
    add_action('admin_menu','wphidenag');
    function wphidenag() {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}

//投稿者アーカイブ（/?author=X）を空欄化
add_filter( 'author_rewrite_rules', '__return_empty_array' );
//URLを非表示化
function disable_author_archive() {
    if( isset($_GET['author']) || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
        wp_redirect( home_url( '/404.php' ) );
        exit;
    }
}
add_action('init', 'disable_author_archive');















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
  if(is_front_page()){
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
function aktk_editor_color_palette() {
  add_theme_support( 'editor-color-palette', array(
      array(
          'name'  => 'Main',
          'slug'  => 'main',
          'color' => '#E95B3C',
      ),
      array(
          'name'  => 'Accent',
          'slug'  => 'accent',
          'color' => '#222',
      ),
      array(
          'name'  => 'Gray',
          'slug'  => 'gray',
          'color' => '#F2F3F1',
      ),
      array(
          'name'  => 'Light Gray',
          'slug'  => 'light-gray',
          'color' => '#efefef',
      ),
      array(
          'name'  => 'Text',
          'slug'  => 'text-black',
          'color' => '#000',
      ),
      array(
          'name'  => 'White',
          'slug'  => 'white',
          'color' => '#ffffff',
      ),
  ) );
}

add_action( 'after_setup_theme', 'aktk_editor_color_palette' );




//Snow Monkey FormsでGoogle Analyticsのコンバージョンを設定
//お問い合わせページ
add_filter( 'snow_monkey_template_part_render_footer', function( $html, $name, $vars ) {
  if ( is_page( 'contact') ) {
    $html .= "<script>
const form = document.querySelector( '.snow-monkey-form' )
form.addEventListener( 'smf.complete', ( event ) => gtag('event', 'form_contact_submit', {
  'event_category': 'form',
  'event_label': 'submit',
}))
</script>";
  }
  return $html;
}, 10, 3 );

//求人申し込みページ
add_filter( 'snow_monkey_template_part_render_footer', function( $html, $name, $vars ) {
  if ( is_page( 'recruit-form') ) {
    $html .= "<script>
const form = document.querySelector( '.snow-monkey-form' )
form.addEventListener( 'smf.complete', ( event ) => gtag('event', 'form_recruit_submit', {
  'event_category': 'form',
  'event_label': 'submit',
}))
</script>";
  }
  return $html;
}, 10, 3 );

//ショートコードを使ったphpファイルの呼び出し方法
function Include_my_php($params = array()) {
  extract(shortcode_atts(array(
      'file' => 'default'
  ), $params));
  ob_start();
  include(get_theme_root() . '/' . get_template() . "/template/$file.php");
  return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');



//カスタム投稿タイプの権限を調整
add_filter('register_post_type_args', 'modify_post_type_capabilities', 10, 2);
function modify_post_type_capabilities($args, $post_type) {

  if (in_array($post_type, get_custom_post_types(), true)) {
    $args['capability_type'] = $post_type;  // 例：post-k01
    $args['map_meta_cap'] = true;           // 権限を細かく制御できるように
  }

  return $args;
}



//各ユーザー用のカスタムロールを作成
function create_custom_roles_for_users() {
//get_custom_users()でユーザーを呼び出し
  foreach (get_custom_users() as $user) {
    $post_type = 'post-' . $user;
    $role_name = $user . '_author';

    // 既にあれば削除（再設定用）
    if (get_role($role_name)) {
      remove_role($role_name);
    }

    add_role($role_name, strtoupper($role_name), [
      // 基本の編集権限
      "read" => true,
      "edit_{$post_type}" => true,
      "edit_{$post_type}s" => true,
      "edit_others_{$post_type}s" => false,
      "publish_{$post_type}s" => true,
      "delete_{$post_type}s" => true,

      // 他投稿・固定ページを一切触れないように
      "edit_posts" => false,
      "edit_pages" => false,
      "delete_posts" => false,
      "delete_pages" => false,
      "publish_posts" => false,
      "publish_pages" => false,
    ]);
  }
}
add_action('init', 'create_custom_roles_for_users');

// 各ユーザーに専用ロールを割り当て
function assign_roles_to_custom_users() {
//get_custom_users()でユーザーを呼び出し
  foreach (get_custom_users() as $user_login) {
    $user = get_user_by('login', $user_login);
    if ($user) {
      $user->set_role($user_login . '_author');
    }
  }
}
add_action('init', 'assign_roles_to_custom_users');


// adminにカスタム投稿の権限を付与
function add_caps_to_administrator() {
  $role = get_role('administrator');
  if (!$role) return;
  //get_custom_post_types()で全てのカスタム投稿を呼び出し
  foreach (get_custom_post_types() as $pt) {
    $role->add_cap("edit_{$pt}");
    $role->add_cap("edit_{$pt}s");
    $role->add_cap("edit_others_{$pt}s");
    $role->add_cap("publish_{$pt}s");
    $role->add_cap("delete_{$pt}s");
    $role->add_cap("delete_others_{$pt}s");
    $role->add_cap("read_{$pt}");
    $role->add_cap("read_private_{$pt}s");
  }
}
add_action('init', 'add_caps_to_administrator');
