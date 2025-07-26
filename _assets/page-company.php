<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail">
  <div class="c-thumbnail__img">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/company-bg.jpg" alt="会社の外観の画像" />
  </div>
  <div class="c-thumbnail__skew"></div>
  <div class="c-thumbnail__skew c-thumbnail__skew--right"></div>
  <div class="c-thumbnail__body c-inner">
    <h1 class="c-thumbnail__title c-ttl-thumbnail">
      <?php the_title(); ?>
    </h1>
    <div class="c-thumbnail__title-en c-ttl-thumbnail-en">
      <?php echo strtoupper(get_post_field( 'post_name', get_the_ID() )); ?>
    </div>
  </div>
</div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>

<!-- /*会社概要　メッセージ*/ -->
<section class="p-company-message" id="message">
  <div class="c-inner">
    <div class="p-company-message__inner c-inner--700">
      <h2 class="p-company-message__title c-ttl-line2color">
        トップメッセージ
      </h2>
      <div class="p-company-message__subtitle c-ttl-orange  c-ttl-orange--29">
        新しい幸せをわかすこと。
      </div>
      <p class="p-company-message__text">
        信和工業株式会社は1975年の創業以来、株式会社ノーリツのグループ会社として数々の業務を担当してきました。現在給湯器の品質上重要なガス通路部、水通路部のメカ制御部品と樹脂加工部品の製造を事業として成長しております。<br>
        生産しております製品は、給湯器の安全・品質を左右する重要な制御部品となります。これらの重要部品を製造するにあたり品質第一のものづくりを掲げ、その品質を向上させるため何よりも整理・整頓・整備されたものづくり現場と、その現場を維持・向上できる人づくりに日々取り組んでいます。安心・安全な職場から、給湯器制御装置の世界一品質を目指してまいります。<br>
        これからもお客様に使ってよかったと思われる製品、豊かな生活を届けられる製品を作り続けられる、明るく活気ある会社を社員一丸となって作ってまいりますので、皆様のご指導、ご支援を賜りますようお願い申しあげます。
      </p>
      <div class="p-company-message__signature">
        代表取締役社長<br>
        <span class="c-text-19">長田 光弘</span>
      </div>
    </div><!-- /.c-inner -->
  </div><!-- /.p-company-message__inner -->
</section><!-- /.p-company-message -->



<!-- /*会社概要　経営理念とビジョン*/ -->
<div class="p-company-flex" id="vision">
  <section class="p-company-flex__left">
    <div class="p-company-flex__body">
      <h2 class="p-company-flex__title c-ttl-line2color c-ttl-line2color--fz20">
        経営理念
      </h2>
      <p class="p-company-flex__text">
        私たちは<br>
        品質とより高度な技術革新で<br>
        社会に愛される企業を目指します
    </div><!-- /.p-company-flex__body -->
    </h2>
  </section><!-- /.p-company-flex__left -->
  <section class="p-company-flex__right">
    <div class="p-company-flex__body">
      <h2 class="p-company-flex__title c-ttl-line2color c-ttl-line2color--fz20">
        Vision
      </h2>
      <p class="p-company-flex__text">
        環境・社会の変化を捉え、<br>
        持続的成長の基盤を構築する
      </p>
    </div><!-- /.p-company-flex__body -->
  </section><!-- /.p-company-flex__left -->
</div>


<!-- /*会社概要　会社概要*/ -->
<section class="p-company-profile" id="profile">
  <div class="c-inner">
    <h2 class="p-company-profile__title c-ttl-line2color c-ttl-line2color--orange">
      会社概要
    </h2><!-- /.p-company-profile__title -->
    <div class="p-company-profile__content c-inner--600">
      <table class="p-company-profile__table c-table-2col">
        <tr>
          <th>商号</th>
          <td>信和工業株式会社</td>
        </tr>
        <tr>
          <th>創立</th>
          <td>1975年(昭和50年)</td>
        </tr>
        <tr>
          <th>代表取締役社長</th>
          <td>長田 光弘</td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>
            〈本社住所〉<br>
            〒674-0093兵庫県明石市二見町南二見5<br>
            TEL：078-941-4039(代表)<br>
            FAX：078-941-4029<br>
            <br>
            〈加古川工場〉<br>
            〒675-1201兵庫県加古川市八幡町宗佐576<br>
            TEL：079-438-3130<br>
            FAX：079-438-3134
          </td>
        </tr>
        <tr>
          <th>年間売上高</th>
          <td>6,528百万円（2023年度）</td>
        </tr>
        <tr>
          <th>資本金</th>
          <td>10百万円</td>
        </tr>
        <tr>
          <th>従業員数</th>
          <td>330人（2023年12月末現在）</td>
        </tr>
        <tr>
          <th>株主</th>
          <td>株式会社ノーリツ</td>
        </tr>
      </table>
    </div>
  </div>
</section>

<!-- /*会社概要　主要取引先*/ -->
<section class="p-company-partner" id="partner">
  <div class="c-inner">
    <h2 class="p-company-partner__title c-ttl-line2color c-ttl-line2color--orange">
      主要取引先
    </h2><!-- /.p-company-partner__title -->
    <div class="p-company-partner__content c-inner--600">
      <ul class="p-company-partner__itemization c-itemization c-itemization--orange">
        <li>株式会社ノーリツ</li>
        <li>株式会社ハーマン</li>
        <li>株式会社アールビー</li>
        <li>橋本金属工業株式会社</li>
        <li>株式会社千石</li>
      </ul>
      <ul class="p-company-partner__itemization c-itemization c-itemization--orange">
        <li>株式会社多田スミス</li>
        <li>マツイ機器工業株式会社</li>
        <li>株式会社ダンレイ</li>
        <li> 株式会社ワイ・ジェー・エス</li>
        <li>三相電機株式会社</li>
      </ul>
    </div>
  </div>
</section>

<!-- /*会社概要　沿革*/ -->
<section class="p-company-history" id="history">
  <div class="c-inner">
    <div class="p-company-history__inner">
      <div class="p-company-history__bordering c-ttl-bordering">
        HISTORY
      </div><!-- /.p-company-history__bordering -->
      <div class="p-company-history__content">
        <h2 class="p-company-history__title c-ttl-line2color">
          沿革
        </h2>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1975年02月</dt>
          <dd class="p-company-history__text">株式会社ノーリツの子会社として設立(資本金500万円) ガス給湯器部品の生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1980年10月</dt>
          <dd class="p-company-history__text">石油給湯器の生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1980年11月</dt>
          <dd class="p-company-history__text">社団法人日本水道協会指定検査工場になる</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1987年10月</dt>
          <dd class="p-company-history__text">資本金1000万円に増資し、株式会社ノーリツのグループ会社となる</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1991年05月</dt>
          <dd class="p-company-history__text">ジェットバスユニットの生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1994年05月</dt>
          <dd class="p-company-history__text">樹脂成形・加工品の生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1996年08月</dt>
          <dd class="p-company-history__text">コイル・ソレノイド・ガスメカユニットの生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">1999年11月</dt>
          <dd class="p-company-history__text">ISO9001の認証取得</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2000年03月</dt>
          <dd class="p-company-history__text">ISO14001の認証取得</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2002年08月</dt>
          <dd class="p-company-history__text">水メカユニットの生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2006年07月</dt>
          <dd class="p-company-history__text">環境配慮商品への取り組み(環境負荷物質の使用禁止)</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2007年07月</dt>
          <dd class="p-company-history__text">株式会社ノーリツの100%子会社となる</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2009年11月</dt>
          <dd class="p-company-history__text">プラスチックマグネット成形</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2010年02月</dt>
          <dd class="p-company-history__text">低電圧コイル生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2013年12月</dt>
          <dd class="p-company-history__text">株式会社テラ・テックをグループ化(100％資本)</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2015年10月</dt>
          <dd class="p-company-history__text">ノーリツ本社工場(NAM)3号棟2階へ本社・本社工場を移転</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2020年01月</dt>
          <dd class="p-company-history__text">循環アダプター生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2021年05月</dt>
          <dd class="p-company-history__text">お掃除浴槽生産開始</dd>
        </dl>
        <dl class="p-company-history__warp">
          <dt class="p-company-history__date">2023年05月</dt>
          <dd class="p-company-history__text">株式会社テラ・テックを吸収合併</dd>
        </dl>
      </div><!-- /.p-company-history__content -->
    </div>
  </div>
</section><!-- /.p-company-history -->

<!-- /*会社概要　工場所在地*/ -->
<section class="p-company-location" id="location">
  <div class="c-inner">
    <h2 class="p-company-location__title c-ttl-line2color c-ttl-line2color--orange">
      工場所在地
    </h2>
    <div class="p-company-location__flex">
      <div class="p-company-location__body">
        <h3 class="p-company-location__body-title">
          本社・本社工場
        </h3>
        <address class="p-company-location__body-address">
          〒674-0093 兵庫県明石市二見町南二見5
        </address>
        <div class="p-company-location__body-tel">
          TEL 078-941-4039(代表)
        </div>
        <div class="p-company-location__body-img">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/company-location-left.jpg"
            alt="本社・工場の外観の画像" />
        </div>
      </div>
      <div class="p-company-location__map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52485.871498320965!2d134.83315634679442!3d34.6959230134576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3554d7451e337f97%3A0xa64c6223deecfe99!2z5L-h5ZKM5bel5qWtKOagqinmnKznpL7jg7vmnKznpL7lt6XloLQ!5e0!3m2!1sja!2sjp!4v1709351815366!5m2!1sja!2sjp"
          width="553" height="392" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div><!-- /.p-company-location__flex -->
    <div class="p-company-location__flex">
      <div class="p-company-location__body">
        <h3 class="p-company-location__body-title">
          加古川工場
        </h3>
        <address class="p-company-location__body-address">
          〒675-1201 兵庫県加古川市八幡町宗佐576
        </address>
        <div class="p-company-location__body-tel">
          TEL 079-438-3130
        </div>
        <div class="p-company-location__body-img">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/company-location-right.jpg"
            alt="加古川工場の外観の画像" />
        </div>
      </div>
      <div class="p-company-location__map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3276.4569142738706!2d134.92280097613678!3d34.79444487288666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35552be27f0b4549%3A0xc7cc4cb9c8255565!2z44CSNjc1LTEyMDEg5YW15bqr55yM5Yqg5Y-k5bed5biC5YWr5bmh55S65a6X5L2Q77yV77yX77yW!5e0!3m2!1sja!2sjp!4v1709351982254!5m2!1sja!2sjp"
          width="553" height="392" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div><!-- /.p-company-location__flex -->
  </div><!-- /.c-inner -->
</section><!-- /.p-company-location -->




<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>

<?php get_footer(); ?>