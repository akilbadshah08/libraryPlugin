<?php
/**
 * @package  bookserch_Wordpress
 * @link       http://www.bookserch.com
 * @package    bookserch_WordPress
 * @subpackage bookserch_WordPress/includes
 * @since      1.0.0
 *
 * *****************************************************************************
 * Copyright (c) 2018 bookserch, Inc.
 * All rights reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of bookserch Incorporated. The intellectual and technical
 * concepts contained herein are proprietary to Cloudwords Incorporated and
 * may be covered by U.S. and Foreign Patents, patents in process, and are
 * protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material in any form is strictly forbidden unless prior
 * written permission is obtained from Cloudwords Incorporated.
 * *****************************************************************************
 */
use BookSearch\Admin;
use BookSearch\Front;

final class Init
{

    /**
     * Store all the classes inside an array
     *
     * @return array Full list of classes
     */
    public static function getServices()
    {
        return [
            Admin::class,
            Front::class,
        ];
    }

    /**
     * Loop through the classes, initialize them,
     * and call the register() method if it exists
     *
     * @return
     */
    public static function registerServices()
    {
        foreach (self::getServices() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     *
     * @param  class $class    class from the services array
     * @return class instance  new instance of the class
     */
    private static function instantiate($class)
    {
        $service = new $class();

        return $service;
    }
}
