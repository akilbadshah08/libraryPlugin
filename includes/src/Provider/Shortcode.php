<?php
/**
 * @package  Cloudwords_Wordpress
 * @link       http://www.cloudwords.com
 * @package    Cloudwords_WordPress
 * @subpackage Cloudwords_WordPress/includes
 * @since      1.0.0
 *
 * *****************************************************************************
 * Copyright (c) 2018 Cloudwords, Inc.
 * All rights reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Cloudwords Incorporated. The intellectual and technical
 * concepts contained herein are proprietary to Cloudwords Incorporated and
 * may be covered by U.S. and Foreign Patents, patents in process, and are
 * protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material in any form is strictly forbidden unless prior
 * written permission is obtained from Cloudwords Incorporated.
 * *****************************************************************************
 */
namespace BookSearch\Provider;

class Shortcode
{
 private $name;
 private $template;
 private $data;
 public function register(){
    $name=$this->name;
 	add_shortcode($name,[$this,'createShortcode']);
     
 }
 public function setName($name){
 	$this->name=$name;
 	return $this;
 }
 public function setTemplate($template){
 	$this->template=$template;
 	return $this;
 }
 public function setdata($data){
    $this->data=$data;
    return $this;
 }
 public function createShortcode($atts=[]) {
        $name = $this->name;
        $data = $this->data;
        $template = $this->template;
        ob_start();
        include BOOK_SEARCH_PATH."/templates/$template.php";
        $html .= ob_get_clean();
        return $html;
    }
}
