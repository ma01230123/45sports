<!-- footer-contact -->

<!-- footer -->
<footer class="l-footer">
  <?php get_template_part('template/contact'); ?>
  <div class="l-footer__inner">
    <div class="c-inner">
      <div class="l-footer__nav">
        <nav class="c-nav-footer">
          <!-- メニューより表示 -->
          <?php wp_nav_menu( array('theme_location' => 'footer_menu01' )); ?>
          <?php wp_nav_menu( array('theme_location' => 'footer_menu02' )); ?>
          <?php wp_nav_menu( array('theme_location' => 'footer_menu03' )); ?>
          <?php wp_nav_menu( array('theme_location' => 'footer_menu04' )); ?>
        </nav>
      </div>
      <div class="l-footer__address">
        <div class="l-footer__address-logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-color.svg" alt="信和工業株式会社のロゴ">
          </a>
        </div>
        <div class="l-footer__address-item">
          〈本社・本社工場〉<br>
          〒674-0093　兵庫県明石市二見町南二見5<br>
          TEL 078-941-4039(代表)
        </div><!-- /.l-footer__address-item -->
        <div class="l-footer__address-item">
          〈加古川工場〉<br>
          〒675-1201　兵庫県加古川市八幡町宗佐576<br>
          TEL 079-438-3130
        </div><!-- /.l-footer__address-item -->
      </div>

      <div class="l-footer__bottom">
        <div class="l-footer__bottom-link">
          <?php wp_nav_menu( array('theme_location' => 'footer_menu-bottom' )); ?>
        </div><!-- /.l-footer__bottom-link -->
        <div class="l-footer__copyright">
          <small>Copyright(C) 2023 SHINWA INDUSTRY Co., Ltd All rights reserved.</small>
        </div>
      </div><!-- /.l-footer__bottom -->
    </div>
  </div>
</footer><!-- /footer -->

<div id="js-toTop" class="c-toTop">
  <a href="#"></a>
</div><!-- /.c-toTop -->




<?php wp_footer(); ?>

</body>

</html>