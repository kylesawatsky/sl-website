<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

/** Actions 
add_action('pre_get_posts', 'sl_add_cpt_to_search');*/
add_action('safetyline_slider', 'sl_search_overlay');
add_action('highwind_footer', 'sl_footer_content');
add_action('safetyline_superfooter', 'sl_superfooter_content');
add_Action('highwind_comments_after', 'blog_newsletter_signup');

/** Shortcodes */
add_shortcode('safetylinesearch', 'get_search_form');
add_shortcode('safetylinesitemap', 'sl_sitemap');
add_shortcode('content', 'sl_content_block');
add_shortcode('tour', 'sl_tour_block');
add_shortcode('company-testimonials', 'sl_company_testimonials');
add_shortcode('company-testimonials2', 'sl_company_testimonials2');
add_shortcode('resources', 'sl_resources');
add_shortcode('tryit', 'sl_tryit');

/** Loading up scripts and styles */
add_action( 'wp_enqueue_scripts', 'safetyline_load_javascript' );
add_action( 'wp_enqueue_scripts', 'safetyline_load_styles' );

/** Filters 
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop' );*/
add_filter( 'salesforce_w2l_post_args', 'salesforce_form_newsletter_signup' );
add_filter('highwind_featured_image_size', 'sl_set_featured_image_size');
 
function safetyline_load_javascript() {
 
  wp_register_script( 'safetyline-flexslider', get_stylesheet_directory_uri() . '/libraries/FlexSlider/jquery.flexslider.custom.js', array('jquery'), '347d4', true );
  wp_register_script( 'safetyline-front-custom', get_stylesheet_directory_uri() . '/js/safetyline-front.js', array('jquery'), '0001', true );
  wp_register_script( 'safetyline-waypoints', get_stylesheet_directory_uri() . '/js/waypoints.min.js', array('jquery'), '2.0.3', true );
  wp_register_script( 'safetyline-waypoints-sticky', get_stylesheet_directory_uri() . '/js/waypoints-sticky.min.js', array('jquery'), '2.0.3', true );
  wp_register_script( 'safetyline-waypoints-custom', get_stylesheet_directory_uri() . '/js/safetyline-waypoints.js', array('jquery'), '0001', true );
  wp_register_script( 'safetyline-common', get_stylesheet_directory_uri() . '/js/safetyline-common.js', array('jquery'), '0002', true );
  wp_register_script( 'safetyline-readmore', get_stylesheet_directory_uri() . '/js/readmore.js', array('jquery'), '0001', true );
  wp_register_script( 'safetyline-customReadmore', get_stylesheet_directory_uri() . '/js/customReadmore.js', array('jquery'), '0001', true );
  wp_register_script( 'safetyline-modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '0001', true );
  wp_register_script( 'safetyline-magnific', get_stylesheet_directory_uri() . '/js/jquery.magnific.js', array('jquery'), '0001', true );
  wp_register_script( 'safetyline-respond', get_stylesheet_directory_uri() . '/js/respond.min.js', array('jquery'), '0001', true );

  wp_enqueue_script('safetyline-respond');
  wp_enqueue_script('safetyline-modernizr');
  wp_enqueue_script('safetyline-readmore');
  wp_enqueue_script('safetyline-customReadmore');
  wp_enqueue_script('safetyline-magnific');
  wp_enqueue_script('safetyline-waypoints');
  
  if ( is_front_page() ) {
    wp_enqueue_script('safetyline-flexslider');
    wp_enqueue_script('safetyline-front-custom');
  }
  else {
    wp_enqueue_script('safetyline-waypoints-sticky');
    wp_enqueue_script('safetyline-waypoints-custom');
  }

  wp_enqueue_script('safetyline-common'); 
}

function safetyline_load_styles() {
 
  wp_register_style( 'safetyline-flexslider', get_stylesheet_directory_uri() . '/libraries/FlexSlider/flexslider.css', array(), '347d4', 'all' );
  wp_register_style( 'safetyline-magnific', get_stylesheet_directory_uri() . '/css/magnific-popup.css', array(), '1', 'all' );
  
  wp_enqueue_style('safetyline-magnific');

  if ( is_front_page() ) {
    wp_enqueue_style('safetyline-flexslider');
  }
 
}

function sl_set_featured_image_size($val) {
	return array(650, 300);
}

function highwind_navigation_toggle() {
	?>
	<p class=" header toggle-container">
		<a href="#navigation" class="nav-toggle button">
			<?php _e( 'Skip to navigation', 'highwind' ); ?>
		</a>
		<a href="http://www.safetylineloneworker.com">
			<img class="main-logo" src="<?php echo content_url(); ?>/uploads/2013/12/SL-menu-logo-ORANGE.png" alt="SafetyLine">
		</a>
	</p>
	<?php highwind_header(); ?>
	<?php	
}

/**
 * Main Navigation
 * Displays the main navigation
 * Hooked into highwind_header()
 * @since 1.0
 */
if ( ! function_exists( 'highwind_main_navigation' ) ) {
	function highwind_main_navigation() {
		?>

		<?php do_action( 'highwind_navigation_before' ); ?>

		<div class="mfp-hide mfp-inline white-popup" id="demo-form">
			<h2>Schedule Your Free Demo</h2>
			<?php echo do_shortcode('[salesforce form="1"]'); ?>
		</div>
		
		<div class="mfp-hide mfp-inline white-popup" id="contact-form">
			<h2>Contact Us</h2>
			<div>info@safetylineloneworker.com</div>
			<div>1-888-975-2563</div>
			<?php echo do_shortcode('[salesforce form="2"]'); ?>
		</div>

		<nav class="main-nav" id="navigation" role="navigation">

			<?php do_action( 'highwind_navigation_top' ); ?>


			<a href="<?php echo home_url(); ?>"><img class="main-logo" src="<?php echo content_url(); ?>/uploads/2013/12/SL-menu-logo-ORANGE.png" alt="SafetyLine" /></a>

			<ul class="buttons">
				<li class="home"><a href="<?php echo home_url(); ?>" class="nav-home button"><span><?php _e( 'Home', 'highwind' ); ?></span></a></li>
				<li class="close"><a href="#top" class="nav-close button"><span><?php _e( 'Return to Content', 'highwind' ); ?></span></a></li>
			</ul>
			<hr />
			<h2><?php echo highwind_get_menu_name( 'main' ); ?></h2>
			<?php wp_nav_menu( array(
				'theme_location' => 'main',
				'menu_class' => 'menu',
				'container' => false,
				'container_class' => 'highwind-navigation',
				'fallback_cb' => '' )
			); ?>

			<?php do_action( 'highwind_navigation_bottom' ); ?>

		</nav><!-- /.main-nav -->

		<div class="side-nav">
			<ul class="menu">
				<li class="menu-item menu-item-newsletter">
					<a id="newsletter-button" class="lightbox-popup" href="#newsletter-form">Newsletter</a>
					<a id="newsletter-icon" class="lightbox-popup" href="#newsletter-form"><i class="fa"></i></a>
				</li>
				<li class="menu-item menu-item-demo">
					<a id="demo-button" class="lightbox-popup" href="#demo-form">Free Demo</a>
					<a id="demo-icon" class="lightbox-popup" href="#demo-form"><i class="fa"></i></a>
				</li>
				<li class="menu-item menu-item-contact"><a id="contact-button" class="lightbox-popup" href="#contact-form"><span id="contact">Contact</span><i id="contact-icon" class="fa"></i></a></li>
		<?php if (is_front_page()) { ?>
				<li class="menu-item menu-item-login"><a href="https://www.slmonitor.com/login" target="_blank"><span>Login</span><i class="fa"></i></a></li>
				<!--<li class="menu-item menu-item-support"><a href="https://safetyline.zendesk.com/home" target="_blank"><span>Support</span><i class="fa"></i></a></li>-->

		<?php } ?>
				<li class="menu-item"><i class="fa fa-search search-button"></i></li>
			</ul>
		</div>
<?php do_action( 'highwind_navigation_after' ); ?>

		<?php
	}
}

function highwind_site_title() {
		if (is_front_page()) {
		?>
			<!--<div class="flexslider">
  				<ul class="slides">
				    	<li class="slide-one">
				      		<div class="flex-background"><img src="<?php echo content_url(); ?>/uploads/2014/01/1-background.jpg" alt="" /></div>
							<div class="flex-slide-wrap">
								<div class="flex-caption slide-one caption-side">
									<img class="caption-logo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_white.png" alt="" />
									<div class="caption-blue">
										Are your workers<br /><span class="caption-bold">safe</span> right now?
										<a href="/"><img src="<?php echo content_url(); ?>/uploads/2014/01/1-arrow.png" alt="" /></a>
									</div>
								</div>
								<div class="flex-illustration slide-one caption-side">
									<img src="<?php echo content_url(); ?>/uploads/2014/01/1-man.png" alt="" />
								</div>
							</div>
				    	</li>
				    	<li class="slide-two">
				      		<div class="flex-background"><img src="<?php echo content_url(); ?>/uploads/2014/01/2-background.jpg" alt="" /></div>
							<div class="flex-slide-wrap">
								<div class="flex-illustration slide-two">
									<img class="spacer" src="<?php echo content_url(); ?>/uploads/2014/02/2-smartphones.png" alt="" />
									<img class="first secondary" src="<?php echo content_url(); ?>/uploads/2014/02/2-smartphones.png" alt="" />
									<img class="second secondary" src="<?php echo content_url(); ?>/uploads/2014/02/2-computerTablet.png" alt="" />
									<img class="third secondary" src="<?php echo content_url(); ?>/uploads/2014/02/2-spotInReach.png" alt="" />
								</div>
								<div class="flex-caption slide-two">
									<div class="caption-clear">
										<span class="caption-bold">Work Alone Safety</span><br />with all your Devices
										<a href="/"><img src="<?php echo content_url(); ?>/uploads/2014/01/2-arrow.png" alt="" /></a>
									</div>
								</div>
							</div>
				    	</li>
						<li class="slide-three">
				      		<div class="flex-background"><img src="<?php echo content_url(); ?>/uploads/2014/01/3-background.jpg" alt="" /></div>
							<div class="flex-slide-wrap">
								<div class="flex-caption slide-three">
									<img class="caption-logo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_white.png" alt="" />
									<div class="caption-orange">
										Do you have a<br />Working Alone <span class="caption-bold">plan?</span>
										<a href="/solutions#block-compliance"><img src="<?php echo content_url(); ?>/uploads/2014/01/1-arrow.png" alt="" /></a>
									</div>
								</div>
								<div class="flex-illustration slide-three">
									<img src="<?php echo content_url(); ?>/uploads/2014/01/3-nurse.png" alt="" />
								</div>
							</div>
				    	</li>
						<li class="slide-four">
				      		<div class="flex-background"><img src="<?php echo content_url(); ?>/uploads/2014/02/4-background.jpg" alt="" /></div>
							<div class="flex-slide-wrap">
								<div class="flex-caption slide-four">
									<div class="caption-clear">
										<p class="quote-text">"I have had several families call me directly to say that they were<br />
										<span class="caption-bold">very happy that we implemented Safetyline...</span><br />It is a very
										cost effective way to ensure that we are complying with working alone legislation, easy for
										our workers to use, and well worth the money. I have, and will continue to promote Safetyline
										to everyone I know who can benefit from it."</p><p class="quote-source">- Roni Green (HSE Manager)
										<br /><span class="caption-bold">Meridian Directional Services Inc.</span></p>
									</div>
								</div>
								<div class="flex-illustration slide-four">
									<img src="<?php echo content_url(); ?>/uploads/2014/02/4-logo.png" alt="" />
								</div>
							</div>
				    	</li>
				</ul>
			</div>-->
			<div class="top-page front-page">
				<div class="top-page-title front-title">
					<div class="top-page-title-text front-title-text">Work Alone Monitoring</div>
					<!--<div class="top-page-subtitle-text front-subtitle-text">We help you get a complete safety network on your existing devices: check-in, detect, monitor, locate and respond.</div>-->
				</div>
				<img class="top-page-sidelogo" src="<?php echo content_url(); ?>/uploads/2014/09/SafetyLine-Logo.jpg" alt="" />
				<img class="top-page-banner front-banner" src="<?php echo content_url(); ?>/uploads/2014/09/Main_Page_graphic.jpg" alt="" />
			</div>
		<?php
		}
		
		if (is_page(479)) { ?>
			<div class="top-page regulations-page">
				<div class="top-page-title regulations-title">
					<div class="top-page-title-text regulations-title-text">Work Alone Regulations</div>
				</div>
				<img class="top-page-sidelogo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_white.png" alt="" />
				<img class="top-page-banner regulations-banner" src="<?php echo content_url(); ?>/uploads/2014/02/regulations-page.jpg" alt="" />
			</div>
		<?php 
		}
		
		if (is_page(760)) { ?>
			<div class="top-page regulations-page">
				<div class="top-page-title regulations-title">
					<div class="top-page-title-text regulations-title-text">Take A Tour</div>
				</div>
				<img class="top-page-sidelogo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_white.png" alt="" />
				<img class="top-page-banner regulations-banner" src="<?php echo content_url(); ?>/uploads/2014/02/regulations-page.jpg" alt="" />
			</div>
		<?php 
		}
		
		if (is_page(9)) { ?>
			<div class="top-page benefits-page">
				<div class="top-page-title benefits-title">
					<img class="top-page-title-logo benefits-title-logo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_white.png" alt="" />
					<div class="top-page-title-text benefits-title-text">Benefits & Features</div>
				</div>
				<img class="top-page-banner benefits-banner" src="<?php echo content_url(); ?>/uploads/2014/02/benefits-page.jpg" alt="" />
			</div>
		<?php 
		}
		
		if (is_page(7)) { ?>
			<div class="top-page devices-page">
				<div class="top-page-title devices-title">
					<img class="top-page-title-logo devices-title-logo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_white.png" alt="" />
					<div class="top-page-title-text devices-title-text">Supported Devices</div>
				</div>
				<img class="top-page-banner devices-banner" src="<?php echo content_url(); ?>/uploads/2014/02/devices-page.jpg" alt="" />
			</div>
		<?php 
		}
		
		if (is_page(11)) { ?>
			<div class="top-page solutions-page">
				<div class="top-page-title solutions-title">
					<div class="top-page-title-text solutions-title-text">Solutions for Your Needs</div>
				</div>
				<img class="top-page-sidelogo solutions-title-logo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_white.png" alt="" />
				<img class="top-page-banner solutions-banner" src="<?php echo content_url(); ?>/uploads/2014/02/solutions-field.jpg" alt="" />
			</div>
		<?php 
		}
		
		if (is_home()) { ?>
			<div class="top-page blog-page">
				<div class="top-page-title blog-title">
					<div class="top-page-title-text blog-title-text">SafetyLine Blog</div>
				</div>
				<img class="top-page-sidelogo" src="<?php echo content_url(); ?>/uploads/2014/02/safetyline_logo_black.png" alt="" />
				<img class="top-page-banner blog-banner" src="<?php echo content_url(); ?>/uploads/2014/02/blog-page.jpg" alt="" />
			</div>
		<?php 
		}
}

function sl_search_overlay() { ?>
	<div class="side-nav-search"><?php echo do_shortcode('[safetylinesearch]') ?></div>
<?php 
} 

function sl_footer_content() { ?>
<div class="footer-wrapper">
	<div class="grid links">
		<ul class="link-column">
			<li><a href="/us">About Us</a></li>
			<li><a class="lightbox-popup" href="#contact-form">Contact Us</a></li>
			<li><a href="/blog">Blog</a></li>
		</ul>

		<ul class="link-column">
			<li><a href="/regulations">Work Alone Regulations</a></li>
			<li><a href="/downloads">Downloads</a></li>
			<li><a href="https://safetyline.zendesk.com/home" target="_blank">Support</a></li>
		</ul>

		<ul class="link-column">
			<li><a href="/subscriber-agreement">Subscriber Agreement</a></li>
			<li><a href="/terms-use">Terms of Use</a></li>
			<li><a href="/privacy-statement">Privacy Policy</a></li>
		</ul>
	</div>

	<div class="grid other">
		<div class="newsletter-signup">
			<form action="https://app.getresponse.com/add_contact_webform.html?u=ZTov" method="post">
				<input class="newsletter-email" type="text" name="email" placeholder="Newsletter">
				<input type="submit" class="newsletter button" title="Newsletter Signup" />
				<input type="hidden" name="webform_id" value="6718305">
			</form>
		</div>
		<div class="social">
			<a href="http://www.linkedin.com/company/safetyline-loneworker" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>
			<a href="https://twitter.com/SafetyLineLW" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
			<a href="https://www.youtube.com/user/SafetyLineLoneworker" target="_blank"><i class="fa fa-youtube fa-2x"></i></a>
			<a href="https://vimeo.com/safetyline" target="_blank"><i class="fa fa-vimeo-square fa-2x"></i></a>
		</div>
		<div class="copyright">©<?php echo date("Y") ?> Tsunami Solutions Ltd. All Rights Reserved.</div>
	</div>
	
	<div class="mfp-hide mfp-inline white-popup" id="newsletter-form">
		<?php echo do_shortcode('[xyz-ihs snippet="newsletter-signup-form"]'); ?>
	</div>
</div>
<?php 
} 

function sl_superfooter_content() { ?>
<div class="superfooter-wrapper">
<?php
	if(is_front_page()) {
		echo sl_company_testimonials(); 
	}
	if(is_page(9)) {
		echo sl_company_testimonials2();
	}
	if(is_page(760)) {
		echo "<aside class='interstitial interstitial-response'><div class='interstitial-text width-wrap'><span class='interstitial-text-quote'>\"The daily operation of Safetyline has been excellent...<br />I feel that our workers are safer with Safetyline.\"</span><span class='interstitial-text-source'>- Jeff Holmberg (Conoco)</span></div></aside>";
	}
	if(is_page(7)) {
		echo "<aside class='interstitial interstitial-business'><div class='interstitial-text width-wrap'><span class='interstitial-text-quote'>\"I just wanted to let you know how impressed we are with your company's lone worker monitoring program...<br />Add to that the excellent customer service and willingness to accommodate changes for set up and we are extremely happy customers.\"</span><span class='interstitial-text-source'>- Brent Crack (Encana)</span></div></aside>";
	}
	if(is_page(11)) {
		echo "<aside class='interstitial interstitial-managerial'><div class='interstitial-text width-wrap'><span class='interstitial-text-quote'>\"It is a very reliable and cost effective means of being in compliance with the Occupational Health & Safety regulations. I would recommend the system to anyone who has workers who are working alone.\"</span><span class='interstitial-text-source'>- Perry Walz (Husky Energy)</span></div></aside>";
	}
?>
</div>
<?php } ?>

<?php
//[safetylinesitemap]
function sl_sitemap($atts) {
	$pageContents = new SplObjectStorage();

	$pages = get_pages();
	foreach ($pages as $page) {
		if($page->ID == 81)
			continue;
		$content = do_shortcode($page->post_content);
libxml_use_internal_errors(true);
		$dom = new DOMDocument;
		$dom->loadHTML($content);
		$finder = new DOMXPath($dom);
		$classname = "anchor";
		$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
		
		$pageContents[$page] = $nodes;
	}

	$html = "<div class='sitemap'><h2>Sitemap</h2><ul>";

	foreach ($pageContents as $slpage) {
		$nodes = $pageContents[$slpage];
		$html .= "<li><a href='" . get_site_url() . "/" . $slpage->post_name . "'>" . $slpage->post_title . "</a>";
		$html .= "<ul>";
		foreach ($nodes as $node) {
			$html .= "<li><a href='" . get_site_url() . "/" . $slpage->post_name . "#" . $node->getAttribute('id') . "'>" . $node->getAttribute('data-title') . "</li>";
		}
		$html .= "</ul></li>";
	}

	$html .= "</ul></div>";
	
	return $html;
}
?>

<?php
//[content]
function sl_content_block($atts) {
	extract(shortcode_atts(array(
		'id' => 'REQUIRED',
		'title' => 'Content',
		'class' => ''
	), $atts));

	$page = get_page_by_title(wp_specialchars_decode($title), "OBJECT", "sl_content_block");
	$meta = get_post_meta($page->ID, "metaattached", false);
	$anchor = $meta[0][0]["anchor-name"];
	$meta = get_post_meta($page->ID, "initial_text", false);
	$initialTitle = $meta[0][0]["block-title"];
	$initialText = $meta[0][0]["block-initial-text"];
	$meta = get_post_meta($page->ID, "initial_image", false);
	$supplementImage = $meta[0][0]["content-block-image"];
	
	$leftImage = (strpos($class, 'leftimg') !== false);
	
	$html = "<section id='section-" . $id . "' class='content-block " . $class . "'>";
	$html .= "<div class='info-section'>";
	$html .= "<a id='block-" . $anchor . "' class='anchor' data-location='" . $id . "' data-title='" . $title . "'></a>";
	if($title != "Smartphones") {
		if ($leftImage) {
			blockSide($html, $supplementImage, "");
		}
		else {
			blockSide($html, $supplementImage, "compressed");
		}
	}
	
	$html .= "<div class='info-description'>";

	$html .= "<p class='content-heading'>" . $initialTitle . "</p>";
	$html .= "<p class='content-subheading'>" . $initialText . "</p>";
	
	//added
	if($page->post_content != "") {
		$html .= "<div class='content'>" . $page->post_content . "</div>";
	}
	
	if($class == "devices") {
		addButton($html, $class);
	}

	$html .= "</div>";

	//added
	//blockSide($html, $supplementImage, "");
	if (!$leftImage && $title != "Smartphones") {
		blockSide($html, $supplementImage, "full");
	}
	
	if($title == "Smartphones") {
		blockSide($html, $supplementImage, "");
	}

	$html .= "</div>";
	
	if($page->post_content != "") {
		$html .= "<div class='expand-section'>";

		//$html .= $page->post_content;
		
		if($class == "works") {
			//addButton($html, $class);
		}

		$html .= "</div>";
	}
	
	if($class == "features") {
		addButton($html, $class);
	}
	
	$html .= "</section>";
	
	return $html;
}

function blockSide(&$html, $supplementImage, $positionClass) {
	$html .= "<div class='info-image" . " " . $positionClass . "'>";
	$html .= wp_specialchars_decode($supplementImage);
	$html .= "</div>";
}

function addButton(&$html, $class) {
	if($class == "devices") {
		$html .= "<a href='/devices' class='button'>Learn More</a>";
	}
	else if($class == "works") {
		$html .= "<div class='works'><a href='/benefits' class='button'>See some features & benefits</a></div>";
	}
	else {
		$html .= "<a href='#' class='button'>Try it Free!</a>";
	}
}
?>

<?php
//[tour]
function sl_tour_block($atts) {
	$page = get_page_by_title("Tour", "OBJECT", "sl_content_block");
	$meta = get_post_meta($page->ID, "metaattached", false);
	$anchor = $meta[0][0]["anchor-name"];
	$meta = get_post_meta($page->ID, "initial_text", false);
	$initialTitle = $meta[0][0]["block-title"];
	$initialText = $meta[0][0]["block-initial-text"];
	$meta = get_post_meta($page->ID, "initial_image", false);
	
	$dom = new DOMDocument();
	$dom->loadHTML($page->post_content);
	$domx = new DOMXPath($dom);
	$entries = $domx->evaluate("//div");
	$arr = array();
	foreach ($entries as $entry) {
		$arr[] = "<" . $entry->tagName . ">" . get_inner_html($entry) . "</" . $entry->tagName . ">";
	}
	
	$html = do_shortcode('[content id="2" title="How it Works" class="works"]');

	$html .= "<section class='content-block width-wrap'>";
	$html .= "<div class='info-section'>";		
	
	$html .= "<div class='info-image'>";
	$html .= "<img alt='' src='" . content_url() . "/uploads/2014/02/how-it-works-diagram.png' />";
	$html .= "</div>";
	
	$html .= "<div class='info-description'>";
	$html .= "<p class='content-heading'>Know that your People are Safe</p>";
	$html .= "<p class='content-subheading'>Effective 24/7 monitoring without manual procedures, call centers, or costly devices</p>";
	$html .= "<div class='content'>" . "
				Workers will regularly check-in throughout their shifts. If someone is in distress and misses a check-in, signals a panic, or triggers a ManDown alarm, SafetyLine will start notifying their monitors, who will get calls by phone, text messages and email. Once a monitor gets a call they will have access to full information about the worker in distress, including personal profile, history, GPS location maps, voice messages, AND be prompted to follow each of your Emergency Response Procedure steps. 
SafetyLine logs all events, and reports can be created on demand online. Administrators also have full access to setup and configure the system to match your organization’s needs. SafetyLine’s staff will consult with you to setup the most appropriate working alone program for your needs, and your people will get training and ongoing support – and that’s just the bare bones. 
Explore more to find out how SafetyLine can help you provide a safer working environment for your staff, and an easy answer to work alone regulation compliance.
			  </div>";
	$html .= "</div>";
	
	$html .= "</div>";
	$html .= "</section>";
	
	
	$html .= "<section class='content-block width-wrap'>";
	$html .= "<div class='info-section'>";	
	
	$html .= "<div class='info-description'>";
	$html .= "<p class='content-heading'>Workers</p>";
	$html .= "<div class='content'>" . $arr[0] . "</div>";
	$html .= "</div>";
	
	$html .= "<div class='info-image'>";
	$html .= "<img alt='' src='" . content_url() . "/uploads/2014/02/workers1.png' />";
	$html .= "</div>";
	
	$html .= "</div>";
	$html .= "</section>";
	
	
	$html .= "<section class='content-block width-wrap'>";
	$html .= "<div class='info-section'>";	
	
	$html .= "<div class='info-description'>";
	$html .= "<p class='content-heading'>Monitors</p>";
	$html .= "<div class='content'>" . $arr[1] . "</div>";
	$html .= "</div>";
	
	$html .= "<div class='info-image'>";
	$html .= "<img alt='' src='" . content_url() . "/uploads/2014/02/monitor.png' />";
	$html .= "</div>";
	
	$html .= "</div>";
	$html .= "</section>";
	
	
	$html .= "<section class='content-block width-wrap'>";
	$html .= "<div class='info-section'>";	
	
	$html .= "<div class='info-description'>";
	$html .= "<p class='content-heading'>Administrators</p>";
	$html .= "<div class='content'>" . $arr[2] . "</div>";
	$html .= "</div>";
	
	$html .= "<div class='info-image'>";
	$html .= "<img alt='' src='" . content_url() . "/uploads/2014/02/administrator.png' />";
	$html .= "</div>";
	
	$html .= "</div>";
	$html .= "</section>";
	
	return $html;
}
?>

<?php
function get_inner_html($node) {
	$innerHTML = '';
	$children = $node->childNodes;
	foreach ($children as $child) {
		$innerHTML .= $child->ownerDocument->saveXML($child);
	}
	return $innerHTML;
}
?>

<?php
function sl_company_testimonials() {
	$html = "<h2 class='company-testimonials-heading'>Serving Canada's leaders in safety</h2>";
	$html .= "<section class='company-testimonials'>";
	$html .= "<div class='company-icons'><img alt='' src='" . content_url() . "/uploads/2014/02/safetyline_customers_11.jpg' /></div>";
	$html .= "</section>";
	
	return $html;
}
?>

<?php
function sl_company_testimonials2() {
	$html = "<h2 class='company-testimonials-heading'>Serving Canada's leaders in safety</h2>";
	$html .= "<section class='company-testimonials'>";
	$html .= "<div class='company-icons'><img src='" . content_url() . "/uploads/2014/02/safetyline_customers_2.jpg' /></div>";
	$html .= "</section>";
	
	return $html;
}
?>

<?php
function sl_tryit() {
	$html = "<div class='trial'><div class='trial-text'><div class='trial-text-header'>What are you waiting for?</div><div class='trial-text-subheader'>Talk to us to see how easy it can be.</div></div><div class='trial-button'><a href='#demo-form' class='button lightbox-popup'>Try it Free!</a></div></div><p>";
	
	return $html;
}
?>

<?php
function sl_resources($atts) {
	extract(shortcode_atts(array(
		'type' => 'REQUIRED'
	), $atts));
	
	$html = '';
	if ($type == 'whitepapers')
		$html = sl_whitepaper_resources();
	if ($type == 'regulations')
		$html = sl_regulations_resources();
	if ($type == 'videos')
		$html = sl_videos_resources();
	if ($type == 'info')
		$html = sl_info_resources();
	
	return $html;
}

function sl_whitepaper_resources() {
	$args = array(
		'post_type' => 'sl_whitepapers',
		'post_status' => 'publish'
	);
	
	$query = new WP_Query($args);
	$html = '';
	
	if($query -> have_posts()) {
		while($query -> have_posts()) : $query -> the_post();
			$meta = get_post_meta(get_the_ID(), "resource_info", false);
			$title = $meta[0][0]["resource-title"];
			$description = $meta[0][0]["resource-description"];
			$image = $meta[0][0]["resource-image"];
			$resource = $meta[0][0]["resource"];
			
			$html .= "<div class='resources-resource resources-whitepapers-whitepaper'>";
			$html .= "<img class='resources-resource-image resources-whitepapers-whitepaper-image' alt='' src='" . wp_get_attachment_url($image) ."' />";
			$html .= "<h3 class='resources-resource-title resources-whitepapers-whitepaper-title'>" . $title . "</h3>";
			$html .= "<p class='resources-resource-description resources-whitepapers-whitepaper-description'>" . $description . "</p>";
			$html .= "<a class='resources-resource-link resources-whitepapers-whitepaper-link' target='_blank' href='" . wp_get_attachment_url($resource) . "'>Get the White Paper</a>";
			$html .= "</div>";
		endwhile;
	}
	
	return $html;
}

function sl_regulations_resources() {
	$args = array(
		'post_type' => 'sl_regulations',
		'post_status' => 'publish'
	);
	
	$query = new WP_Query($args);
	$html = '';
	
	if($query -> have_posts()) {
		while($query -> have_posts()) : $query -> the_post();
			$meta = get_post_meta(get_the_ID(), "resource_info_regs", false);
			$title = $meta[0][0]["resource-title"];
			$description = $meta[0][0]["resource-description"];
			$image = $meta[0][0]["resource-image"];
			$resource = $meta[0][0]["resource"];
			
			$html .= "<div class='resources-resource resources-regulations-regulation'>";
			$html .= "<img class='resources-resource-image resources-regulations-regulation-image' alt='' src='" . wp_get_attachment_url($image) ."' />";
			$html .= "<h3 class='resources-resource-title resources-regulations-regulation-title'>" . $title . "</h3>";
			$html .= "<p class='resources-resource-description resources-regulations-regulation-description'>" . $description . "</p>";
			$html .= "<a class='resources-resource-link resources-regulations-regulation-link' target='_blank' href='" . wp_get_attachment_url($resource) . "'>See the regulations</a>";
			$html .= "</div>";
		endwhile;
	}
	
	return $html;
}

function sl_videos_resources() {
	$args = array(
		'post_type' => 'sl_videos',
		'post_status' => 'publish'
	);
	
	$query = new WP_Query($args);
	$html = '';
	
	if($query -> have_posts()) {
		while($query -> have_posts()) : $query -> the_post();
			$meta = get_post_meta(get_the_ID(), "resource_info_vids", false);
			$title = $meta[0][0]["resource-title"];
			$description = $meta[0][0]["resource-description"];
			$image = $meta[0][0]["resource-image"];
			$resource = $meta[0][0]["resource"];
			
			$html .= "<div class='resources-resource resources-videos-video'>";
			$html .= "<img class='resources-resource-image resources-videos-video-image' alt='' src='" . wp_get_attachment_url($image) ."' />";
			$html .= "<h3 class='resources-resource-title resources-videos-video-title'>" . $title . "</h3>";
			$html .= "<p class='resources-resource-description resources-videos-video-description'>" . $description . "</p>";
			$html .= "<a class='resources-resource-link resources-videos-video-link' target='_blank' href='" . wp_get_attachment_url($resource) . "'>Watch the video</a>";
			$html .= "</div>";
		endwhile;
	}
	
	return $html;
}

function sl_info_resources() {
	$args = array(
		'post_type' => 'sl_info',
		'post_status' => 'publish'
	);
	
	$query = new WP_Query($args);
	$html = '';
	
	if($query -> have_posts()) {
		while($query -> have_posts()) : $query -> the_post();
			$meta = get_post_meta(get_the_ID(), "resource_info_info", false);
			$title = $meta[0][0]["resource-title"];
			$description = $meta[0][0]["resource-description"];
			$image = $meta[0][0]["resource-image"];
			$resource = $meta[0][0]["resource"];
			
			$html .= "<div class='resources-resource resources-info-info'>";
			$html .= "<img class='resources-resource-image resources-info-info-image' alt='' src='" . wp_get_attachment_url($image) ."' />";
			$html .= "<h3 class='resources-resource-title resources-info-info-title'>" . $title . "</h3>";
			$html .= "<p class='resources-resource-description resources-info-info-description'>" . $description . "</p>";
			$html .= "<a class='resources-resource-link resources-info-info-link' target='_blank' href='" . wp_get_attachment_url($resource) . "'>Read the info sheet</a>";
			$html .= "</div>";
		endwhile;
	}
	
	return $html;
}
?>

<?php 
function salesforce_form_newsletter_signup($args) {
	$wantsNewsletter = $args['body']['newsletter'];
	$emailAddress = $args['body']['email'];
	
	if($wantsNewsletter) {
		wp_remote_post("https://app.getresponse.com/add_contact_webform.html?u=ZTov", array(
			'body' => array('email' => $emailAddress)
			)
		);
	}
	
	return $args;
}
?>

<?php
function blog_newsletter_signup() { ?>
<div id="WFItem" class="wf-formTpl">
	<form accept-charset="utf-8" action="https://app.getresponse.com/add_contact_webform.html?u=ZTov" method="post">
		<div class="wf-box">
			<div id="WFIcenter" class="wf-body">
				<ul class="wf-sortable" id="wf-sort-id">
					<li>
						Like this post? Get more great content by signing up for our SafetyLine Newsletter!
					</li>
					<li class="wf-email" rel="undefined">
						<div class="wf-contbox">
							<div class="wf-labelpos">
								<label class="wf-label">Email:</label>
							</div>
							<div class="wf-inputpos">
								<input class="wf-input wf-req wf-valid__email" type="text" name="email">
							</div>
							<em class="clearfix clearer"></em>
						</div>
					</li>
					<li class="wf-submit" rel="undefined">
						<div class="wf-contbox">
							<div class="wf-inputpos">
								<input type="submit" class="wf-button" name="submit" value="Sign Up!">
							</div>
							<em class="clearfix clearer"></em>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<input type="hidden" name="webform_id" value="6718305">
	</form>
</div>
<?php } ?>