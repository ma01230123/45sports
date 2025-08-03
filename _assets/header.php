<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="u-headerHight"></div>
  <!-- header -->
  <header id="header" class="l-header">
    <div class="c-inner c-inner--header">

      <div class="l-header__flex">
        <div class="l-header__left">
          <!-- トップページ用タグの設定 -->
          <?php
            if(is_front_page()){
              $tag_start = '<h1 class="l-header__left-logo">';
              $tag_end = '</h1>';
            }else{
              $tag_start = '<div class="l-header__left-logo">';
              $tag_end = '</div>';
            }?>
          <?php echo $tag_start; ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="l-header__left-logo-link">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-black.svg" alt="総合型地域スポーツクラブ兵庫県協議会のロゴ"
                class="l-header__left-logo-img">
          </a>
          <?php echo $tag_end; ?>
        </div><!-- /.l-header__left -->

        <div class="l-header__right u-hidden-sp">
          <nav class="c-nav-header">
            <!-- メニューより表示 -->
            <?php wp_nav_menu( array('theme_location' => 'header_menu' )); ?>
          </nav>
          <div class="l-header__right-mail">
            <a href="#" class="l-header__right-mail-link"><i class="fa-regular fa-envelope"></i></a>
          </div><!-- /.l-header__right-mail -->
        </div><!-- /.l-header__right -->
      </div><!-- /.l-header__flex -->
    </div><!-- /.c-inner -->


    <!-- sp用ヘッダー（他では非表示） -->
    <!-- ハンバーガーボタン -->
    <button class="c-drawer__icon js-icon u-hidden-pc u-hidden-tab">
      <span class="c-drawer__bars">
        <span class="c-drawer__bar"></span>
        <span class="c-drawer__bar"></span>
        <span class="c-drawer__bar"></span>
      </span>
    </button>
    <div class="c-drawer__background js-background"></div>


    <div class="c-drawer__content js-content" role="navigation">
      <nav class="c-drawer__menus">
        <!-- メニューより表示 -->
        <?php wp_nav_menu( array('theme_location' => 'header_menu' )); ?>
      </nav>
    </div>
  </header>
