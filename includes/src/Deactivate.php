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
class Deactivate{
	function register(){
	    self::deactivateHook();
	}
	public static function deactivateHook() {

	}
}