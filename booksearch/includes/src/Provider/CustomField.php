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

class CustomField
{
     private $name;
     private $label;
     private $type;
     private $options=[];
     private $post_type;	
     public function register(){
     	$post_type=$this->post_type;
        add_action('add_meta_boxes', [$this, 'registerMetaboxes']);
        add_action( 'publish_'.$post_type, [$this, 'save_metadata']);
        add_action( 'save_post', [$this, 'save_metadata']);
     }
     public function setName($name){
     	$this->name=$name;
     	return $this;
     }
     public function setLabel($label){
     	$this->label=$label;
     	return $this;
     }
     public function setType($type){
        $this->type=$type;
        return $this;
     }
     public function setOptions($options){
        $this->options=$options;
        return $this;
     }
      public function setPostType($post_type){
        $this->post_type=$post_type;
        return $this;
     }
     public function registerMetaboxes() {
        $name = $this->name;
        $label = $this->label;
        $post_type=$this->post_type;
        add_meta_box(
            $name.'-'.$label.'-metabox',
            __($label, 'my-plugin'),
            [$this, 'registerField'],
            $post_type
        );
        
    }
    public function registerField(){  
        $name = $this->name;
        $label = $this->label;
        $type=$this->type;
        $options = $this->options;
        $meta_value='';
        if(isset($_GET['post'])){
            $meta_value=get_post_meta($_GET['post'],$this->name,true);
        }
        switch ($type) {
            case 'text':
            echo "<label>".$label."</label><br>";
            echo "<input type='text' name='".$name."' value='".$meta_value."'>";
            break;
            case 'select':
            echo "<label>".$label."</label><br>";
            echo "<select  name='".$name."' value='".$meta_value."'>";
            foreach ($options as $optionlabel => $value) {
                $selected=$value==$meta_value?"selected":"";
                echo "<option $selected value='$value'> $optionlabel </option>";
            }
            echo "</select>";
            break;
        }
    }
    public function save_metadata($ID){
          update_post_meta($ID,$this->name,$_POST[$this->name]);  
    }
}
