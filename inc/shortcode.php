<?php


class LogoShortcodeS {

  function __construct() {
    add_shortcode('logo-s', array($this, 'shortcode_callback'));
    add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts_cb'));
    //add_action('wp_head', array($this, 'hook_css'));
  }


  function shortcode_callback($atts){

    extract( shortcode_atts( array(
        'post_type'       => 'logo-s',
        'numberposts'     => 7,
      	'offset'          => 0,
      	'class_wrapper'   => 'logo-sc-s-wrapper',
      	'orderby'         => 'post_date',
      	'order'           => 'DESC',
      	'include'         => '',
      	'exclude'         => '',
      	'meta_key'        => '',
      	'meta_value'      => '',
      	'post_parent'     => '',
      	'post_status'     => 'publish',
        'slides_per_view' => 5,
        'size'            => 'thumbnail',
        'url'             => '',
        'space_between'   => 15,
  	 ), $atts ) );

   $posts = get_posts(array(
     'post_type'       => $post_type,
     'numberposts'     => $numberposts,
     'offset'          => $offset,
     'category'        => $category,
     'orderby'         => $orderby,
     'order'           => $order,
     'include'         => $include,
     'exclude'         => $exclude,
     'meta_key'        => $meta_key,
     'meta_value'      => $meta_value,
     'post_parent'     => $post_parent,
     'post_status'     => $post_status,
   ));



     ob_start();
     ?>
      <div class="<?php echo $class_wrapper ?>">
        <div class="logo-slider-slick-wrapper" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
          <?php foreach($posts as $post): setup_postdata($post); ?>
            <div class="logo-slide-s">

              <?php if($url): ?>
                <a href="<?php echo get_the_permalink($post->ID); ?>">
              <?php endif; ?>

              <div class="post-logo-thumbnail">
                <?php echo get_the_post_thumbnail( $post->ID, 'team-thumb' ); ?>
              </div>
              <div class="post-logo-text">
                <div class="post-logo-title">
                  <strong><?php echo $post->post_title; ?></strong>
                </div>
                <div class="post-logo-content">
                  <span><?php echo $post->post_content; ?></span>
                </div>

                <?php if($url): ?>
                  </a>
                <?php endif; ?>

              </div>
            </div>

          <?php endforeach; wp_reset_postdata(); ?>

        </div>

        <!-- Initialize Swiper -->
        <script>
          jQuery(document).ready(function($) {
            $('.<?php echo $class_wrapper ?> .logo-slider-slick-wrapper').slick();
          });
        </script>
      </div>
     <?php
    $html = ob_get_contents();
    ob_get_clean();
    return $html;
  }

  function wp_enqueue_scripts_cb(){
    wp_register_style( 'slick', plugin_dir_url(__FILE__).'slick-master/slick/slick.css', '', $ver = '3.1.0', $media = 'all' );
    wp_register_style( 'slick-theme', plugin_dir_url(__FILE__).'slick-master/slick/slick-theme.css', '', $ver = '3.1.0', $media = 'all' );
    wp_register_style( 'slick-style', plugin_dir_url(__FILE__).'style.css', '', $ver = '3.1.0', $media = 'all' );

    wp_register_script( 'slick', plugin_dir_url(__FILE__).'slick-master/slick/slick.min.js', array('jquery'), $ver = '3.1.0' );
    wp_enqueue_style( 'slick' );
    wp_enqueue_style( 'slick-theme' );
    wp_enqueue_style( 'slick-style' );
    wp_enqueue_script( 'slick' );
  }


  function hook_css(){

      ?>
        <style>

        </style>
      <?php
    }
} $TheLogoShortcodeS = new LogoShortcodeS;
