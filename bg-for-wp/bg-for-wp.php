<?php
/**
 * Plugin Name: My First Plugin
 * Plugin URI: https://www.bhargav.blog/bg-for-wp
 * Description: Hello World Shortcode plugin.
 * Version: 1.0
 * Author: Bhargav Mehta
 * Author URI: https://www.bhargav.blog
 */

 function bg_for_wp_shortcode(){
     $message = 'Hello World!' ;
     return $message;
 }

 add_shortcode( 'hello-world', 'bg_for_wp_shortcode' );