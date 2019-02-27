<?php

/*
 * Plugin Name: AMP HTML Sitemap
 * Version: 2.3
 * Plugin URI: https://jaaadesign.nl/en/blog/amp-sitemap/
 * Description: Generates a customizable list of links to your AMP posts, pages and custom post types for SEO/indexing benefits. To be added to the content by customizable shortcode.
 * Author: Nick van de Veerdonk
 * Author URI: https://jaaadesign.nl/
 */
 
 function amp_sitem_function($atts) {



   extract(shortcode_atts(array(
    	  'append' => 'amp',
	      'heading' => null,
		  'max' => 5000,
	      'cpt1' => null,
	      'cpt2' => null,
	      'cpt3' => null,
), $atts));


   $return_string = '<ul>';
   query_posts(array('post_type' => array('post', $cpt1, $cpt2, $cpt3), 'orderby' => 'type', 'order' => 'DESC', 'showposts' => $max, 'append' => $append, 'heading' => $heading));
  $return_string = '<h2>'.$heading.'</h2>';
 if (have_posts()) :
      while (have_posts()) : the_post();

        $return_string .= '<li><a href="'.get_permalink().'/'.$append.'/">'.get_the_title().'</a></li>';
		 
		 
		 
		 
      endwhile;
   endif;
   $return_string .= '</ul>';

   wp_reset_query();
   return $return_string;

}

function register_shortcode_amp_sitemap(){

   add_shortcode('amp-sitemap', 'amp_sitem_function');

}
add_action( 'init', 'register_shortcode_amp_sitemap');