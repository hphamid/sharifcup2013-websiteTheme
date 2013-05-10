<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta name="keywords" content="" >
		<meta name="description" content="">
		<title>
			<?
			global $page, $paged;
			wp_title( '|', true, 'right' );
			echo bloginfo( 'name' );

			$site_description = get_bloginfo( 'description', 'display' );

			if ( $site_description && ( is_home() || is_front_page() ) )

			echo " | $site_description";

			if ( $paged >= 2 || $page >= 2 )

			echo ' | ' . sprintf(  __('page %s','seminar'), max( $paged, $page ) );
			?>
		</title>
		<style type="text/css">
			@font-face {
			font-family: 'BMitra';
			src: url('<?php echo get_template_directory_uri(); ?>/fonts/BMitra.eot?#') format('eot'),
			url('<?php echo get_template_directory_uri(); ?>/fonts/BMitra.woff') format('woff'),
			url('<?php echo get_template_directory_uri(); ?>/fonts/BMitra.ttf') format('truetype');
			font-weight: normal;
			}
			@font-face {
			font-family: 'BAban';
			src: url('<?php echo get_template_directory_uri(); ?>/fonts/BAban.ttf') format('truetype');
			font-weight: bold;
			}
		</style>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/Logo16-16.png">
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?echo get_template_directory_uri() ?>/slider/css/slider.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?echo get_template_directory_uri() ?>/news/css/accordionME.css" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Petit+Formal+Script">
		<link rel="stylesheet" type="text/css" media="all" href="<?echo get_template_directory_uri() ?>/gallery/css/style.css" />
		<style>
			#header{
				background-image:url("<?echo get_template_directory_uri() ?>/images/header.jpg");
			}
		</style>
		<? wp_head(); ?>
				<script type="text/javascript">
			$(document).ready(function(){
				jQuery("head").append("<style>body{"
					+"background-image:url(\"<?echo get_template_directory_uri() ?>/timthumb.php?src=./images/background.jpg&w="+$(window).width()+"&h="+$(window).height()+"&q=80\");"
					+"}"
					+"</style>"
					);
			});
		</script>
	</head>
	<body>
		<div id="main">
			<div id="loading">
				لطفا صبر کنید.
			</div>
			<div id="header">	
			</div> 
			<div id="topmenu">
				<div id="cmenu" class="cmenu">
					<div id="menuContent">
						<?php  $a=array('echo'=>0,'menu_class'=> 'menu','menu_id' =>'','container'=>false,'link_before'=>'<span class="melement">','link_after'=>'</span>','items_wrap'=> '<ul class="%2$s">%3$s</ul>');
						$men=wp_nav_menu( $a );
						echo $men; ?>
					</div>
				</div>
			</div>
			<div id="ajax" class="body">