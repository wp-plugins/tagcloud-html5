<?php
/*
Plugin Name: TagCloud html5
Plugin URI: http://www.derflash.de
Description: Tag cloud on html5 steroids based on tagcanvas-JS from www.goat1000.com
Version: 1.1
Author: Bjoern Teichmann
Author URI: http://www.derflash.de
Update Server: http://www.derflash.de
Min WP Version: 2.9
License: LGPL v3
*/


add_action('wp_head', 'tagCloudHeadCB');
function tagCloudHeadCB() {
	if (!strpos($_SERVER['HTTP_USER_AGENT'],'iPad')) { ?>

	<script src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/tagcloud-html5/tagcanvas.js" type="text/javascript"></script>	
	
    <script type="text/javascript">
	<!--
	
	function addLoadEvent(your_function) {
		if (window.attachEvent) {window.attachEvent('onload', your_function);}
		else if (window.addEventListener) {window.addEventListener('load', your_function, false);}
		else {document.addEventListener('load', your_function, false);}
	}
	
	function tweetfeed_load() {
		// IE8 doesn't support html5 canvas, so better just "try" to show it (else show standard tag widget)
		try {
			TagCanvas.maxSpeed = 0.035;
			TagCanvas.textColour = '#2d83d5';
			TagCanvas.outlineColour = '#2d83d5';
		    TagCanvas.Start('tagCloudh5');
	    } catch(err) {
	    }
	}
	
	addLoadEvent(tweetfeed_load);
	
	-->
    </script>
    <?php
    }
}




/*********** WIDGETS ***********/

add_action('plugins_loaded', 'tagCloudLoad');
function tagCloudLoad() {
	if (!function_exists('register_sidebar_widget')) return;	
	register_sidebar_widget('Tag Cloud html5', 'widget_tagCloud');	
}
function widget_tagCloud() {

	echo $before_widget;
	?>
	<li><div id="tch5" class="widget widget_tagCloud_h5">
	<?php echo $before_title; ?>
	
	<h2 class="title">Tag Cloud</h2>
	<?php
	
	// show standard tag widget on ipad until the html5 cloud is fixed
	if (strpos($_SERVER['HTTP_USER_AGENT'],'iPad')) { ?>
		<div width="260" height="260">
			<?php wp_tag_cloud(); ?>
		</div>
	<?php } else { ?>
		<canvas width="260" height="260" id="tagCloudh5">
			<?php wp_tag_cloud(); ?>
		</canvas>
	<?php }
	
	?>
	</div>
	</li>
	<?php
	echo $after_widget;
}

?>
