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

class CustomTaxonomy
{
 private $name;
 private $singular_name;
 private $post_name;	
 public function register(){
 	add_action( 'init', array( $this, 'createCustomTaxonomy' ) );
 }
 public function setName($name){
 	$this->name=$name;
 	return $this;
 }
 public function setSingularName($singular_name){
 	$this->singular_name=$singular_name;
 	return $this;
 }
 public function setPostType($post_name){
    $this->post_name=$post_name;
    return $this;
 }
 public function createCustomTaxonomy() {
    $name = $this->name;
    $singular_name = $this->singular_name;
    $post_type=$this->post_name;
    register_taxonomy( 
        strtolower( $name ),
        $post_type,
        array(
            'labels' => array(
                'name'                       => _x( $name, 'taxonomy general name', 'textdomain' ),
                'singular_name'              => _x( $singular_name, 'taxonomy singular name', 'textdomain' ),
                'search_items'               => __( 'Search '.$name, 'textdomain' ),
                'popular_items'              => __( 'Popular '.$name, 'textdomain' ),
                'all_items'                  => __( 'All '.$name, 'textdomain' ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __( 'Edit '.$singular_name, 'textdomain' ),
                'update_item'                => __( 'Update '.$singular_name, 'textdomain' ),
                'add_new_item'               => __( 'Add New '.$singular_name, 'textdomain' ),
                'new_item_name'              => __( 'New '.$singular_name.' Name', 'textdomain' ),
                'separate_items_with_commas' => __( 'Separate ' . strtolower( $name ) . ' with commas', 'textdomain' ),
                'add_or_remove_items'        => __( 'Add or remove ',$singular_name, 'textdomain' ),
                'choose_from_most_used'      => __( 'Choose from the most used '.strtolower( $name ), 'textdomain' ),
                'not_found'                  => __( 'No ' . strtolower( $name ) . '  found.', 'textdomain' ),
                'menu_name'                  => __( $name, 'textdomain' ),
            ),
            'hierarchical'          => true,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => $singular_name ),
        )
    );
    
    }
}
