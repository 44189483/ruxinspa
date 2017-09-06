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
  <h1 class="pt50">Our Gallery</h1>
  <p>Home | Gallery</p>
</div>
<div class="grid-row">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="center">
          <h3 class="font-arizonia gray-font">Ru Xin Spa</h3>
          <h2>Our Gallery</h2>
          <p class="ce_sub_title"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon/flower.png" alt=""></p>
          <p>
            <h3 style="margin-top:75px">FOLLOW ON INSTAGRAM</h3>
          </p>
        </div>
        <ul class="gallery">
          <li>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/1.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/2.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li class="nomr">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/3.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/4.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/5.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li class="nomr">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/6.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/7.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/8.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
          <li class="nomr">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/masseuse/9.png" alt="" />
            <div class="title">
              <a href="#">
                <i class="fa fa-times-rectangle-o"></i>
                <br/>
                VISIT INSTAGRAM
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="grid-row-gray">
  <div id="facebook_list" class="scroll_horizontal">
    <div class="box">
      <ul class="list center">
        <li>
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/avatar.jpg" alt="" width="80" height="80" />
          <div class="fbpanel">
            <h4 class="name">
                Kelly Liu - <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </h4>
            <div class="content">
              <span class="purple-font font75">“</span><br/><p style="margin-top:-35px">Visited RuXin spa last Thursday night for the first time with my buddy. I was served by MIKI who did a very good job and make me feel refreshed after the session. Will go again Ru Xin Spa</p></div>
          </div>
        </li>
        <li>
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/avatar1.jpg" alt="" width="80" height="80" />
          <div class="fbpanel">
            <h4 class="name">
                Lu Lu - <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </h4>
            <div class="content">
              <span class="purple-font font75">“</span><br/><p style="margin-top:-35px">Enjoyed 1.5h massage at the outlet, staff was friendly and really relax session. Will definitely go again</p></div>
          </div>
        </li>
        <li>
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/avatar2.jpg" alt="" width="80" height="80" />
          <div class="fbpanel">
            <h4 class="name">
                Muhammad Imran - <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </h4>
            <div class="content">
              <span class="purple-font font75">“</span><br/><p style="margin-top:-35px">Interior was well decorated and the overall experience was a warm and friendly one. Highly recommended for those looking for authentic massage. Price was competitive as well with occasional promotions.</p></div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

<?php get_footer(); ?>
