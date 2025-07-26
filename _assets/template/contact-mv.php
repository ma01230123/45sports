<!-- 固定ページタイトル部分 contact-mv.php-->
<div class="c-thumbnail c-thumbnail--mini">
  <div class="c-thumbnail__body c-inner">
    <h1 class="c-thumbnail__title c-ttl-thumbnail">
      <?php the_title(); ?>&emsp;
      <span class="c-ttl-orange c-ttl-orange--22 ">
        <?php echo strtoupper(get_post_field( 'post_name', get_the_ID() )); ?>
        <span>
      </h1>
  </div><!-- /.c-thumbnail__body -->
</div>