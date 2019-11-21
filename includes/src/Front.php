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
class Front
{
	function register(){
	    self::registerShortcode();
	    add_action('wp_enqueue_scripts',[$this,'registerScripts']);
		add_action("wp_ajax_book_search", [$this,'ajaxBookSearch']);
		add_action("wp_ajax_nopriv_book_search", [$this,'ajaxBookSearch']);	    	
	}
	static function registerShortcode(){
		$shortcode=new Shortcode();
		$shortcode->setName('searchform')->setTemplate('search-form')->register();
	}
	static function ajaxBookSearch(){
		parse_str($_POST['serialize_data'], $serialize_data);
	     $args = array(
		    'post_type' => 'books',
		    'posts_per_page' => -1,
		);
	    if(isset($serialize_data['bookname']) && $serialize_data['bookname']!=''){
	    	$args['s']=$serialize_data['bookname'];
	    } 
	    if(isset($serialize_data['publisher'])  && $serialize_data['publisher']!=''){
	    	$args['tax_query'][]=array(
            'taxonomy' => 'publishers',
            'field'    => 'term_id',
            'terms'    => $serialize_data['publisher']
        	);
	    }
	    if(isset($serialize_data['author'])  && $serialize_data['author']!=''){
	    	$args['tax_query'][]=array(
            'taxonomy' => 'authors',
            'field'    => 'term_id',
            'terms'    => $serialize_data['author']
        	);
	    }
	    if(isset($serialize_data['rating'])){
	    	$args['meta_query'][]=array(
            'key' => 'rating',
            'value'    => $serialize_data['rating'],
        	);
	    } 	
	    $args['meta_query'][]=array(
            'key' => 'price',
            'value'    => (int)$serialize_data['min_price'],
            'type'    => 'numeric',
            'compare' => '>='
        	);
	   	$args['meta_query'][]=array(
            'key' => 'price',
            'value'    => (int)$serialize_data['max_price'],
            'type'    => 'numeric',
            'compare' => '<='
        	);
		query_posts($args);
        ob_start();
        include BOOK_SEARCH_PATH."/templates/ajax-book-search.php";
        $html .= ob_get_clean();
        echo $html;
        die;
	}
	public function registerScripts(){
			wp_enqueue_script ( 'ajax-search', BOOK_SEARCH_PLUGIN_URL . '/assets/js/ajax-search.js',array('jquery') );
			wp_enqueue_style ( 'book-search', BOOK_SEARCH_PLUGIN_URL . '/assets/css/book-search.css' );
			wp_enqueue_script ( 'ui-jquery', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',array('jquery') );
			wp_enqueue_style( 'ui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
			
	}
}
