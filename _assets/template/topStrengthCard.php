<div class="c-cards-club">
<?php
// 「club」というスラッグの固定ページのIDを取得
$parent_page = get_page_by_path('club');
$parent_id = $parent_page ? $parent_page->ID : 0;

$args = array(
  'post_type'      => 'page',
  'post_parent'    => $parent_id,
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
);

$child_pages = new WP_Query($args);

if ($child_pages->have_posts()) :
  while ($child_pages->have_posts()) : $child_pages->the_post();
?>

  <div class="c-cards-club__item" style="border:2px solid <?php the_field('cf-area-color'); ?>">
    <a href="<?php the_permalink(); ?>">
      <div class="c-cards-club__corporation"><?php the_field('cf-corporation'); ?></div>
      <div class="c-cards-club__name"><?php the_field('cf-name'); ?></div>
    </a>
  </div>

<?php
  endwhile;
  wp_reset_postdata();
else :
  echo '<p>現在、子ページはありません。</p>';
endif;
?>


</div>
