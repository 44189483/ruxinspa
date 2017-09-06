<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Ru_Xin_Spa
 * @since Ru Xin Spa 1.0
 */

get_header(); ?>

<div class="center banner white-font">
  <h1 class="pt50">Our Services</h1>
  <p>Home | Services</p>
</div>
<div class="grid-row-gray">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="center">
          <h3 class="font-arizonia gray-font">Ru Xin Spa</h3>
          <h2>Our Services</h2>
          <p class="ce_sub_title"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon/flower.png" alt=""></p>
        </div>
        <ul class="services">
          <?php
            global $wpdb;
            $services = $wpdb->get_results("SELECT * FROM rx_services WHERE type=0");
            foreach ($services as $key => $val):
          ?>
          <li>
            <div class="circular">
              <img src="<?php echo $val->img; ?>" alt="" />
            </div>
            <div class="sepanel">
              <div class="mt">
                <h4 class="black-font"><strong><?php echo $val->title; ?></strong></h4>
                <p><?php if($val->times == 0): echo '-'; else:?><?php echo $val->times.' mins'; endif;?></p>
                <p>S$<?php echo $val->price; ?></p>
              </div>
            </div>
            <div class="btn gradient"><a href="/appointment/">BOOK NOW</a></div>
          </li>
          <?php
            endforeach;
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
