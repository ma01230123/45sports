<?php 
/** 
 Template Name:LineUPページ用 
 **/
?>
<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail c-thumbnail--lineup">
  <div class="c-thumbnail__img">
    <?php the_post_thumbnail(); ?>
  </div>
  <div class="c-thumbnail__skew"></div>
  <div class="c-thumbnail__skew c-thumbnail__skew--right"></div>
  <div class="c-thumbnail__body c-inner">
  <div class="c-thumbnail__title-en c-ttl-thumbnail-lineup">
    LINE UP
  </div>
  <h1 class="c-thumbnail__title c-ttl-thumbnail c-ttl-thumbnail--black u-fwm">
  <?php
$title = get_the_title(); // タイトルを取得

// "ラ"の前で改行を挿入
$position = mb_strpos($title, 'ラ', 0, 'UTF-8');
if ($position !== false) {
    $title = mb_substr($title, 0, $position, 'UTF-8') . '<br>' . mb_substr($title, $position, null, 'UTF-8');
}

echo $title;
?>
    <!-- <?php the_title(); ?> -->
  </h1>
</div>
</div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div class="c-inner l-page">
  <?php the_content(); ?>
</div>
<div style="height:8rem"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>

<?php get_footer(); ?>