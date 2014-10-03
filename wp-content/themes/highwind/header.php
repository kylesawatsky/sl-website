<?php
/**
 * The header template.
 * @package highwind
 * @since 1.0
 */
?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?><?php highwind_html_before(); ?><!doctype html><!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<?php
		if (isset($_SERVER['HTTP_USER_AGENT']) &&
			(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
				header('X-UA-Compatible: IE=edge,chrome=1');
	?>
	
	<?php highwind_head_top(); ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<?php do_action( 'wpe_gce_head' ); ?>

	<title><?php wp_title( '/', true, 'right' ); ?></title>

	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="icon" type="image/png" href="<?php echo content_url(); ?>/uploads/2014/02/Safetyline_favicon_32.png">

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="//use.typekit.net/wkp6wug.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
			/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
			   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
		</style>

	<?php highwind_head_bottom(); ?>

	<?php wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42071672-4', 'safetylineloneworker.com');
  ga('require', 'linkid', 'linkid.js');
  ga('send', 'pageview');

</script>

<script type="text/javascript"> 
var vv_account_id = 'gvrL2hli6c'; 
var vv_BaseURL = (("https:" == document.location.protocol) ? "https://frontend.id-visitors.com/FrontEndWeb/" : "http://frontend.id-visitors.com/FrontEndWeb/");
(function () { 
var va = document.createElement('script'); va.type = 'text/javascript'; va.async = true; 
va.src = vv_BaseURL + 'Scripts/liveVisitAsync.js'; 
var sv = document.getElementsByTagName('script')[0]; sv.parentNode.insertBefore(va, sv); 
})(); 
</script>
<script type='text/javascript'>
window.__wtw_lucky_site_id = 27001;

(function() {
				var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
				wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://cdn') + '.luckyorange.com/w.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
  })();
</script>


</head>

<body <?php body_class(); ?>>

<?php highwind_body_top(); ?>

<div class="outer-wrap" id="top">

	<?php highwind_title_header(); ?>

	<div class="slider-wrap">

	<?php safetyline_slider(); ?>

	<div class="inner-wrap">

	<?php highwind_header_before(); ?>

	<!-- <header class="header content-wrapper" role="banner" style="background-image:url(<?php echo header_image(); ?>);"> -->

		

	<!-- </header> -->

	<div class="content-wrapper">

	<?php highwind_header_after(); ?>