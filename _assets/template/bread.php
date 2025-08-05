<!-- bread.php start-->
<div class="p-template-bread">
  <div class="c-inner">
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
      <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
    </div>
  </div>
</div>
<!-- bread.php end-->
