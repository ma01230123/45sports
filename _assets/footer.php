<!-- footer-contact -->

<!-- footer -->
<footer class="l-footer">
  <div class="l-footer__inner c-inner">

    <div class="l-footer__address">
      <div class="l-footer__address-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-white.svg" alt="総合型地域スポーツクラブ兵庫県協議会のロゴ">
        </a>
      </div>
      <div class="l-footer__address-item">
        〒651-0083<br>
        兵庫県神戸市中央区浜辺通5-1-14<br>
        神戸商工貿易センタービル 5階<br>
        TEL：078-200-4165<br>
        FAX：078-200-4166<br>
        業務時間：9時～12時、13時～17時30分<br>
      </div><!-- /.l-footer__address-item -->
      <div class="l-footer__address-link u-hidden-sp">
        <!-- メニューより表示 -->
        <?php wp_nav_menu(array('theme_location' => 'footer_menu_bottom')); ?>
      </div><!-- /.l-footer__address-item-link -->
    </div>
    <div class="l-footer__menu">
      <div class="l-footer__menu-top">
        <!-- メニューより表示 -->
        <?php wp_nav_menu(array('theme_location' => 'footer_menu_top')); ?>
      </div><!-- /.l-footer__bottom -->
      <div class="l-footer__menu-club">
        <div class="l-footer__menu-club-title c-text-18 js-footer-btn">
          各クラブのご紹介
          <?php
          // slug が "club" の固定ページを取得
          $club_page = get_page_by_path('club');

          if ($club_page) {

            // 子ページを取得するクエリ
            $club_children = new WP_Query(array(
              'post_type' => 'page',
              'post_parent' => $club_page->ID,
              'posts_per_page' => -1,
              'orderby' => 'menu_order',
              'order' => 'ASC',
            ));

            if ($club_children->have_posts()): ?>
              <ul class="l-footer__menu-club-warp js-footer-menu">
                <?php while ($club_children->have_posts()):
                  $club_children->the_post(); ?>
                  <li>
                    <a href="<?php the_permalink(); ?>">
                      <?php
                      // the_field() は ACF の関数です。
                      // cf-corporation と cf-name をタイトル代わりに出力します。
                      the_field('cf-corporation');
                      echo ' ';
                      the_field('cf-name');
                      ?>
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
              <?php
              wp_reset_postdata();
            endif;
          }
          ?>
        </div><!-- /.l-footer__menu-club-title -->
      </div><!-- /.l-footer__menu-club -->
      <div class="l-footer__menu-sp u-hidden-pc u-hidden-tab">
        <?php wp_nav_menu(array('theme_location' => 'footer_menu_bottom')); ?>
      </div>
    </div>


  </div>
  <div class="l-footer__copyright">
    <small>Copyright © Hyogo Sports Association.</small>
  </div>
</footer><!-- /footer -->

<div id="js-toTop" class="c-toTop">
  <a href="#"></a>
</div><!-- /.c-toTop -->




<?php wp_footer(); ?>

</body>

</html>
