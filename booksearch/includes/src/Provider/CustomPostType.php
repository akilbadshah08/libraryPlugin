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

class CustomPostType
{
 private $name;
 private $singular_name;
 public function register(){
 	add_action( 'init', array( $this, 'createCustomPostType' ) );

 }
 public function setName($name){
 	$this->name=$name;
 	return $this;
 }
 public function setSingularName($singular_name){
 	$this->singular_name=$singular_name;
 	return $this;
 }
 public function setCustomFields($custom_fields){
 	$this->custom_fields=$custom_fields;
 	return $this;
 }

 public function createCustomPostType() {
    $name = $this->name;
    $singular_name = $this->singular_name;
    register_post_type( 
        strtolower( $name ),
        array(
            'labels' => array(
                'name'               => _x( $name, 'post type general name' ),
                'singular_name'      => _x( $singular_name, 'post type singular name'),
                'menu_name'          => _x( $name, 'admin menu' ),
                'name_admin_bar'     => _x( $singular_name, 'add new on admin bar' ),
                'add_new'            => _x( 'Add New', strtolower( $name ) ),
                'add_new_item'       => __( 'Add New ' . $singular_name ),
                'new_item'           => __( 'New ' . $singular_name ),
                'edit_item'          => __( 'Edit ' . $singular_name ),
                'view_item'          => __( 'View ' . $singular_name ),
                'all_items'          => __( 'All ' . $name ),
                'search_items'       => __( 'Search ' . $name ),
                'parent_item_colon'  => __( 'Parent :' . $name ),
                'not_found'          => __( 'No ' . strtolower( $name ) . ' found.'),
                'not_found_in_trash' => __( 'No ' . strtolower( $name ) . ' found in Trash.' )
            ),
            'public'             => true,
            'has_archive'        => 'true',
            'hierarchical'       => false,
            'rewrite'            => array( 'slug' => $name ),
        )
    );
    
    }
}
