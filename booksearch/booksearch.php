<?php
/**
 * A WordPress plugin that integrates booksearch translation platform.
 *
 * @link    http://www.booksearch.com
 * @package BOOK_SEARCH 
 * @since 1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Library Book Search
 * Plugin URI:        http://www.booksearch.com
 * Description:       A WordPress plugin that integrates booksearch translation platform.
 * Version:           1.0.0
 * License:           booksearch
 * License URI:       http://www.booksearch.com
 * Text Domain:       booksearch-wordpress
 */
define( 'BOOK_SEARCH_PATH', dirname( __FILE__ ) );
define( 'BOOK_SEARCH_PLUGIN_URL', plugins_url( '', __FILE__ ) );
 require_once( dirname( __FILE__ ).'/vendor/autoload.php' );

 require_once( dirname( __FILE__ ).'/init.php' );
 
 Init::registerServices();
