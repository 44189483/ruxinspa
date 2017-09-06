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
  <h1 class="pt50">Make An Appointment</h1>
  <p>Home | Appointment</p>
</div>
<div class="grid-row">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="center">
          <h3 class="font-arizonia gray-font">Welcome to</h3>
          <h2>Make An Appointment</h2>
          <p class="ce_sub_title"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon/flower.png" alt=""></p>
        </div>
        <div id="calendar" class="calendar"></div>
      </div>
    </div>
  </div>
</div>
<div class="grid-row-gray">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="center">
          <h3 class="font-arizonia gray-font">Spa Center</h3>
          <h2>Special Promo</h2>
          <p class="ce_sub_title"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon/flower.png" alt=""></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
          <?php
            global $wpdb;
            $special = $wpdb->get_results("SELECT * FROM rx_services WHERE type=1");
            foreach ($special as $key => $val):
          ?>
          <div class="item center <?php if($key == 0):?>active<?php endif;?>">
            <a href="/appointment/">
              <div class="circular">
                <img src="<?php echo $val->img; ?>" alt="" />
                <div class="btn">BOOK NOW</div>
              </div>
                <h3><?php echo $val->title; ?></h3>
                <h3 class="purple-font font-regular">
                  <?php if($val->id == 39):?>
                      free body scrub
                    <?php else:?>
                      <?php if($val->price > 0 ): echo 'S$ '.$val->price;endif;?>
                      <?php if($val->price > 0 && $val->times > 0): echo '/'; endif;?>
                      <?php if($val->times > 0 ): echo $val->times.' mins';endif;?>
                  <?php endif;?>
                </h3>
            </a>
          </div>
          <?php
            endforeach;
          ?>
        </div>
        <a class="carousel-control left" href="#myCarousel" 
           data-slide="prev"><i class="fa fa-arrow-circle-left"></i></a>
        <a class="carousel-control right" href="#myCarousel" 
           data-slide="next"><i class="fa fa-arrow-circle-right"></i></a>
      </div> 
    </div>
  </div>
</div>

<?php get_footer(); ?>
