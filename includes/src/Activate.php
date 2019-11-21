<?php
/**
 * @package  booksearch_Wordpress
 * @link       http://www.booksearch.com
 * @package    booksearch_WordPress
 * @subpackage booksearch_WordPress/includes
 * @since      1.0.0
 *
 * *****************************************************************************
 * Copyright (c) 2018 booksearch, Inc.
 * All rights reserved.
 */
namespace BookSearch;
use BookSearch\Provider\Shortcode;
class Activate{
	function register(){
	   self::activateHook();
	}
	public static function activateHook() {
		set_transient( '_welcome_screen_activation_redirect_data', true, 30 );
        if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')),true) && !is_plugin_active_for_network('woocommerce/woocommerce.php')) {
            wp_die("<strong> WooCommerce Product Attachment</strong> Plugin requires <strong>WooCommerce</strong> <a href='" . esc_url(get_admin_url(null, 'plugins.php')) . "'>Plugins page</a>.");
        }
	}
}