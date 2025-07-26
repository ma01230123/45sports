<?php get_header(); ?>
<div class="u-headerHight"></div>

<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail c-thumbnail--mini">
  <div class="c-thumbnail__body c-inner">
    <h1 class="c-thumbnail__title c-ttl-thumbnail c-ttl-thumbnail--black">
    <?php 
       $current_category = get_queried_object();
       $category_name = $current_category->name;
      echo esc_html($category_name);
      ?>
      &emsp;<span class="c-ttl-orange c-ttl-orange--22 ">NEWS</span>
    </h1>
  </div><!-- /.c-thumbnail__body -->
</div>

<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>

<div class="c-inner">
<div class="l-archive">
  <ul class="c-category ">
    <li class="c-category__item"><a href="<?php echo esc_url(home_url('/')); ?>new">すべて</a></li>
    <?php
    $post_obj = $wp_query->get_queried_object();
    $cat_slug = $post_obj->category_nicename;
$categories = get_categories();
if ( $categories ) {
  foreach ( $categories as $category ) {
    echo '<li class="c-category__item ';
    if ($cat_slug === $category->slug){
      echo 'c-category__item-current';
    }
    echo ' "><a href="'.get_category_link($category).'">'.$category->name .'</a></li>';
  }
}
?>
  </ul>
  <div style="height:4rem" aria-hidden="true" class="wp-block-spacer"></div>
  <?php get_template_part('template/newsContent'); ?>
</div>
</div><!-- /.c-inner -->

<div style="height:8rem"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<?php get_footer(); ?>