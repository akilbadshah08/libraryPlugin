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
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of booksearch Incorporated. The intellectual and technical
 * concepts contained herein are proprietary to booksearch Incorporated and
 * may be covered by U.S. and Foreign Patents, patents in process, and are
 * protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material in any form is strictly forbidden unless prior
 * written permission is obtained from booksearch Incorporated.
 * *****************************************************************************
 */
namespace BookSearch\Provider;

class CustomMenuPage
{
 private $name;
 private $template;
 private $slug;
 public function register(){
 	add_action( 'admin_menu', [$this,'createMenuPage'] );
     
 }
 public function setTitle($title){
 	$this->title=$title;
 	return $this;
 }
 public function setTemplate($template){
 	$this->template=$template;
 	return $this;
 }
 public function setSlug($slug){
    $this->slug=$slug;
    return $this;
 }

 public function createMenuPage($atts) {
        $title = $this->title;
        $slug = $this->slug;
        $template = $this->template;
        add_menu_page( $title, $title, 'manage_options', $slug, [$this,'menuCallback']);
    }
 public function menuCallback(){
        $template = $this->template;
        ob_start();
        include BOOK_SEARCH_PATH."/templates/admin/$template.php";
        $html .= ob_get_clean();
        echo  $html;
    }
}
