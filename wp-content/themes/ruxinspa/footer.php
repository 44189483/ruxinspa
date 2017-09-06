<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Ru_Xin_Spa
 * @since Ru Xin Spa 1.0
 */
?>
		<div class="grid-row">
		  <div class="container">
		    <div class="row">
		      <div class="col-sm-12">
		        <div class="center">
		          <h3 class="font-arizonia font50">Ru Xin Spa</h3>
		          <p class="ce_sub_title"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon/flower.png" alt=""></p>
		          <div class="network-link">
		            <span class="circular wh40 gradient"><a href="http://www.facebook.com/ruxinspa"><i class="fa fa-facebook"></i></a></span>
		            <span class="circular wh40 gradient"><a href="#"><i class="fa fa-google"></i></a></span>
		            <span class="circular wh40 gradient"><a href="https://twitter.com/RuXinSpa"><i class="fa fa-twitter"></i></a></span>
		            <span class="circular wh40 gradient"><a href="https://www.instagram.com/ruxinspa/"><i class="fa fa-instagram"></i></a></span>
		          </div>
		          <span class="gray-font font16">Opening Hour 10:00am - 4:00am<br/><br/>Monday - Sunday</span>
		        </div>
		      </div>
		    </div>
		    <div class="row center" style="margin-top:-40px;">
		      <div class="col-sm-4">
		        <div class="border"><a href="https://www.google.ro/maps/place/L.R.H.+Pte+Ltd/@1.4244896,103.8303206,17z/data=!3m1!4b1!4m5!3m4!1s0x31da14720ffe9c91:0x445e898898b8792b!8m2!3d1.4244896!4d103.8325093" target="_blank">Blk417 Yishun Ave 11,#01-323 S760417</a></div>
		      </div>
		      <div class="col-sm-4">
		        <div class="border"><a href="tel:62571829">Phone:+(65)6257 1829</a></div>
		      </div>
		      <div class="col-sm-4">
		        <div class="border"><a href="mailto:contact@ruxinspa.com">Email:contact@ruxinspa.com</a></div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
    <footer>
      <div class="container">
        <div class="pull-left">
          Copyright <i class="fa fa-copyright"></i> 2017 Ru Xin Spa.
        </div>
        <div class="pull-right">
          All Rights Reserved. Website Design & Marketing By <a href="http://www.microuniver.com">MICROUNIVER</a>
        </div>
      </div>
    </footer>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header gradient">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title">Request an Appointment</h4>
          </div>
          <div class="modal-body">
            <div class="hr-heading">Please confirm that you would like to request the following apppointment:</div>
            <h3>Your Information <span class="red-font">*</span>:</h3>
            <form id="ajax-appointment" action="<?php bloginfo('template_directory'); ?>/send.php" method="POST">
              <div class="form-group">
                <label class="sr-only" for="mdInputDate">Amount (in dollars)</label>
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                  <input type="text" class="form-control" id="mdInputDate" name="field_Date" readonly="readonly"/>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="mdInputName" name="field_Name" placeholder="Name*:" required="required" />
              </div>
              <div class="form-group">
                <input type="tel" class="form-control" id="mdInputPhone" name="field_Phone" placeholder="Phone*:" required="required" pattern="^(8|9)\d{7}$"/>
              </div>
              <h4>Where you know us <span class="red-font">*</span>:</h4>
              <div class="checkbox know">
                <input type="hidden" id="mdCheckKnow" name="field_Know"/>
                <p data-value="Friends">
	                <label>
	                  <i class="fa fa-square-o purple-font"></i>
	                  <span class="span">Friends</span>
	                <label>
                </p>
                <p data-value="Facebook">
                	<label>
	                  <i class="fa fa-square-o purple-font"></i>
	                  <span class="span">Facebook(Online Advertsing)</span>
                   	</label>
                </p>
                <p data-value="Others">
                	 <label>
	                  <i class="fa fa-square-o purple-font"></i>
	                  <span class="span">Others</span>
                   	</label>
                  	<input type="text" class="form-control" id="mdInputOthers" name="field_Others" />
                </p>
              </div>
              <div class="checkbox isrobot">
                <input id="mdCheckRot" name="field_robot" type="hidden" value="1"/>
                <p>
                  <i class="fa fa-square"></i>
                  <span class="span">I Not a Robot</span>
                </p>
              </div>
              <div class="load-warp"></div>
              <button type="submit" id="submit" name="submit" class="btn gradient white-font"> RQUEST AN APPOINTMENT </button>
              <button type="button" class="btn btn-default white-font" data-dismiss="modal" style="background:#000"> CANCEL </button>
            </form>
          </div>
          
        </div>
      </div>
    </div>


    <div class="modal fade" id="modalTip" tabindex="-1" role="dialog" aria-labelledby="modalTipLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <div class="modal-title" id="myModalLabel">
            </div>
          </div>
          <div class="modal-body" id="formMessages">
          </div>
        </div>
      </div>
    </div>

    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.cxscroll.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/calendar.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>