<!-- club-map.php start -->
  <?php
      $allowed_tags = array(
        'iframe' => array(
          'src' => true,
          'width' => true,
          'height' => true,
          'frameborder' => true,
          'allowfullscreen' => true,
        ),
        'p' => array(),
        'br' => array(),
        'strong' => array(),
        'em' => array(),
        'ul' => array(),
        'li' => array(),
      );

      echo wp_kses(get_field('cf-map'), $allowed_tags);
      ?>
<!-- club-map.php end -->
