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
namespace BookSearch;
use BookSearch\Provider\CustomPostType;
use BookSearch\Provider\CustomTaxonomy;
use BookSearch\Provider\CustomField;
use BookSearch\Provider\CustomMenuPage;
class Admin
{

function register(){
    self::registerPostTypes();
    self::registerTaxonomies();
    self::registerGetMenuPages();

}

static function registerPostTypes(){
	$post_types	= self::getPostTypes();
	foreach ($post_types as $key => $post_type) {
		(new CustomPostType())->setName($post_type['name'])->setSingularName($post_type['singular_name'])->register();
		foreach ($post_type['custom_fields'] as $key => $custom_field) {
			$field=new CustomField();
			$field->setName($custom_field['name']);
			$field->setLabel($custom_field['label']);
			$field->setPostType($post_type['name']);
			$field->setType($custom_field['type']);
			if($custom_field['type']=='select'){	
				$field->setOptions($custom_field['options']);
			}
			$field->register();
		}

	}	
}
static function registerTaxonomies(){
	$taxnomies	= self::getTaxonomies();
	foreach ($taxnomies as $key => $taxonomy) {
		(new CustomTaxonomy())->setName($taxonomy['name'])->setSingularName($taxonomy['singular_name'])->setPostType($taxonomy['post_type'])->register();
	}	
}

static function registerGetMenuPages(){
	$menu_pages	= self::getMenuPages();
	foreach ($menu_pages as $key => $menu_page) {
		(new CustomMenuPage())->setTitle($menu_page['title'])->setSlug($menu_page['slug'])->setTemplate($menu_page['template'])->register();
	}	
}

static function getPostTypes(){
	return [
		[
			'name' => 'Books', 
			'singular_name' => 'Book',
			'custom_fields' => [
				[
					'name' => 'price', 
					'label' => 'Price',
					'type' => 'text'
				], 
				[
					'name' => 'rating',
					'label' => 'Rating',
					'type' => 'select',
					'options' => [
						'1' => '1' , 
						'2' => '2', 
						'3'	=> '3',
						'4' => '4',
						'5' => '5'
					]
				]
			]
		],	
	];
}
static function getMenuPages(){
	return [
			['title' => 'Library Book Search Setting', 'slug' => 'library-book-searc-setting','template' => 'admin-setting'],
			];
}
static function getTaxonomies(){
	return [
		['name' => 'Publishers', 'singular_name' => 'Publisher','post_type' => 'books'],
		['name' => 'Authors', 'singular_name' => 'Author','post_type' => 'books'],	
	];
}

}
