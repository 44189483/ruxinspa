<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Ru_Xin_Spa
 * @since Ru Xin Spa 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	  <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
    <?php if ( is_home() ) {
  		bloginfo('name'); echo " - "; bloginfo('description');
  	} elseif ( is_category() ) {
  		single_cat_title(); echo " - "; bloginfo('name');
  	} elseif (is_single() || is_page() ) {
  		single_post_title();
  	} elseif (is_search() ) {
  		echo "搜索结果"; echo " - "; bloginfo('name');
  	} elseif (is_404() ) {
  		echo '页面未找到!';
  	} else {
  		wp_title('',true);
  	} ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
	  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php bloginfo('template_url'); ?>/css/themify-icons.css" rel="stylesheet" />
    <link href="<?php bloginfo('template_url'); ?>/css/elegant-icons.css" rel="stylesheet" />
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" media="screen" />
    <link href="<?php bloginfo('template_url'); ?>/css/calendar.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php bloginfo('template_url'); ?>/js/html5shiv.min.js"></script>
      <script src="<?php bloginfo('template_url'); ?>/js/respond.min.js"></script>
      <script src="<?php bloginfo('template_url'); ?>/js/html5.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
</head>

<body>
<header>

  <div class="header-top">
    <span class="logo font-arizonia pull-left"><a href="<?php bloginfo('url'); ?>">Ru Xin Spa</a></span>
    <ul class="top-bar pull-left">
      <li>
        <img src="<?php bloginfo('template_url'); ?>/images/icon/sign.png" />
        <div class="pull-right">
          <a href="https://www.google.ro/maps/place/L.R.H.+Pte+Ltd/@1.4244896,103.8303206,17z/data=!3m1!4b1!4m5!3m4!1s0x31da14720ffe9c91:0x445e898898b8792b!8m2!3d1.4244896!4d103.8325093" target="_blank">
            <strong>Blk417 Yishun Ave ll</strong><br/>
            <span style="text-indent:50px">#01-323 S760417</span>
          </a>
        </div>
      </li>
      <li>
        <img src="<?php bloginfo('template_url'); ?>/images/icon/email.png" />
        <div class="pull-right">
          <strong><a href="tel:62571829">+(65) 6257 1829</a></strong><br/>
          <span style="text-indent:50px;"><a href="mailto:contact@ruxinspa.com">contact@ruxinspa.com</a></span>
        </div>
      </li>
    </ul>
    <span class="appointment gradient"><a href="/appointment/">MAKE AN APPOINTMENT</a></span>
  </div>
  <nav class="navbar navbar-inverse navbar-fixed-top gradient">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand logo font-arizonia" href="<?php bloginfo('url'); ?>">Ru Xin Spa</a>
        <a class="appointment" href="/appointment/">MAKE AN APPOINTMENT</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li <?php if (is_home()) { echo 'class="active"';} ?>><a title="<?php bloginfo('name'); ?>"  href="<?php echo get_option('home'); ?>/">HOME</a></li>
          <?php 
          	foreach (get_all_menu() as $key => $val):
          		if($_SERVER['REQUEST_URI'] == '/'.$val->post_name.'/'){
          			$class = 'class="active"';
          		}
          		echo "<li {$class}><a href=\"/{$val->post_name}/\">{$val->post_title}</a></li>";
          	endforeach;
          ?>
          <li>
            <ul class="icon-network">
              <li class="wh40"><a href="http://www.facebook.com/ruxinspa" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <li class="wh40"><a href="#"><i class="fa fa-google"></i></a></li>
              <li class="wh40"><a href="https://twitter.com/RuXinSpa" target="_blank"><i class="fa fa-twitter"></i></a></li>
              <li class="wh40"><a href="https://www.instagram.com/ruxinspa/" target="_blank"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<div id="main">
<?php if (is_home() || is_front_page()) { putRevSlider('ruxinspa'); } ?> 