<?php
/**
 * Krank Woocommerce Support
 * @package Krank
*/

// Theme support decleration
add_theme_support( 'woocommerce' );

// remove the WooCommerce page headers.
add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);