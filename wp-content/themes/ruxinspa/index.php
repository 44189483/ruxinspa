<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Ru_Xin_Spa
 * @since Ru Xin Spa 1.0
 */

get_header(); ?>
	  <div class="grid-row-gray">
	    <div class="container">
	      <div class="row">
	        <div class="col-sm-12">
	          <div class="center">
	            <h3 class="font-arizonia gray-font">Welcome to</h3>
	            <h2>Ru Xin Spa</h2>
	            <p class="ce_sub_title"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon/flower.png" alt=""></p>
	            <p>
	              <h3>Massage Promotes Quality Sleep!</h3>
	              <span class="gray-font font16">Come to Envy Spa for all of your massage needs.</span>
	            </p>
	          </div>
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-sm-3 center mb40">
	          <div class="circular wh100 gradient active">
	            <div class="cirline circular">
	              <span class="ti-heart-broken"></span>
	            </div>
	          </div>
	          <p>
	            <h4>Variety of Care</h4>
	            <span class="gray-font font14">Our Spa is unique among other Spas</span>
	          </p>
	        </div>
	        <div class="col-sm-3 center mb40">
	          <div class="circular wh100 gradient active">
	            <div class="cirline circular">
	              <span class="ti-user"></span>
	            </div>
	          </div>
	          <p>
	            <h4>Qualified Staff</h4>
	            <span class="gray-font font14">Our Spa all staff is after trained</span>
	          </p>
	        </div>
	        <div class="col-sm-3 center mb40">
	          <div class="circular wh100 gradient active">
	            <div class="cirline circular">
	              <span class="ti-face-smile"></span>
	            </div>
	          </div>
	          <p>
	            <h4>Relaxation Centric</h4>
	            <span class="gray-font font14">Our Spa is an insurmountable relaxation choices</span>
	          </p>
	        </div>
	        <div class="col-sm-3 center">
	          <div class="circular wh100 gradient active">
	            <div class="cirline circular">
	              <span class="ti-folder"></span>
	            </div>
	          </div>
	          <p>
	            <h4>Reasonable Costs</h4>
	            <span class="gray-font font14">Our charge are competitive in the market</span>
	          </p>
	        </div>
	      </div>
	    </div>
	  </div>
	  <div class="grid-row">
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