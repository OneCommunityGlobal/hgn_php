<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * System Initialization File
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	CodeIgniter
 * @category	Front-controller
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/
 */
/**
 * CodeIgniter Version
 *
 * @var	string
 *
 */
define('CI_VERSION', '3.0rc3');

/*
 * ------------------------------------------------------
 *  Load the framework constants
 * ------------------------------------------------------
 */
if (file_exists(APPPATH . 'config/' . ENVIRONMENT . '/constants.php')) {
    require_once(APPPATH . 'config/' . ENVIRONMENT . '/constants.php');
}

require_once(APPPATH . 'config/constants.php');

/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
require_once(BASEPATH . 'core/Common.php');


/*
 * ------------------------------------------------------
 * Security procedures
 * ------------------------------------------------------
 */

if (!is_php('5.4')) {
    ini_set('magic_quotes_runtime', 0);

    if ((bool) ini_get('register_globals')) {
        $_protected = array(
            '_SERVER',
            '_GET',
            '_POST',
            '_FILES',
            '_REQUEST',
            '_SESSION',
            '_ENV',
            '_COOKIE',
            'GLOBALS',
            'HTTP_RAW_POST_DATA',
            'system_path',
            'application_folder',
            'view_folder',
            '_protected',
            '_registered'
        );

        $_registered = ini_get('variables_order');
        foreach (array('E' => '_ENV', 'G' => '_GET', 'P' => '_POST', 'C' => '_COOKIE', 'S' => '_SERVER') as $key => $superglobal) {
            if (strpos($_registered, $key) === FALSE) {
                continue;
            }

            foreach (array_keys($$superglobal) as $var) {
                if (isset($GLOBALS[$var]) && !in_array($var, $_protected, TRUE)) {
                    $GLOBALS[$var] = NULL;
                }
            }
        }
    }
}

/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
set_error_handler('_error_handler');
set_exception_handler('_exception_handler');
register_shutdown_function('_shutdown_handler');

/*
 * ------------------------------------------------------
 *  Instantiate the config class
 * ------------------------------------------------------
 *
 * Note: It is important that Config is loaded first as
 * most other classes depend on it either directly or by
 * depending on another class that uses it.
 *
 */
$CFG = & load_class('Config', 'core');

// Do we have any manually set config items in the index.php file?
if (isset($assign_to_config) && is_array($assign_to_config)) {
    foreach ($assign_to_config as $key => $value) {
        $CFG->set_item($key, $value);
    }
}

/*
 * ------------------------------------------------------
 *  Instantiate the URI class
 * ------------------------------------------------------
 */
$URI = & load_class('URI', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the routing class and set the routing
 * ------------------------------------------------------
 */
$RTR = & load_class('Router', 'core', isset($routing) ? $routing : NULL);

/*
 * ------------------------------------------------------
 *  Instantiate the output class
 * ------------------------------------------------------
 */
$OUT = & load_class('Output', 'core');

/*
 * ------------------------------------------------------
 *  Load the Input class and sanitize globals
 * ------------------------------------------------------
 */
$IN = & load_class('Input', 'core');

/*
 * ------------------------------------------------------
 *  Load the app controller and local controller
 * ------------------------------------------------------
 *
 */
// Load the base controller class
require_once BASEPATH . 'core/Controller.php';

/**
 * Reference to the CI_Controller method.
 *
 * Returns current CI instance object
 *
 * @return object
 */
function &get_instance() {
    return CI_Controller::get_instance();
}

if (file_exists(APPPATH . 'core/' . $CFG->config['subclass_prefix'] . 'Controller.php')) {
    require_once APPPATH . 'core/' . $CFG->config['subclass_prefix'] . 'Controller.php';
}

/*
 * ------------------------------------------------------
 *  Sanity checks
 * ------------------------------------------------------
 *
 *  The Router class has already validated the request,
 *  leaving us with 3 options here:
 *
 * 	1) an empty class name, if we reached the default
 * 	   controller, but it didn't exist;
 * 	2) a query string which doesn't go through a
 * 	   file_exists() check
 * 	3) a regular request for a non-existing page
 *
 *  We handle all of these as a 404 error.
 *
 *  Furthermore, none of the methods in the app controller
 *  or the loader class can be called via the URI, nor can
 *  controller methods that begin with an underscore.
 */

$e404 = FALSE;
//Removed by Sen ucfirst from class name
// $class = ucfirst($RTR->class);
$class = $RTR->class;
$method = $RTR->method;
//here
if (empty($class) OR ! file_exists(APPPATH . 'controllers/' . $RTR->directory . $class . '.php')) {
    $e404 = TRUE;
} else {

    require_once(APPPATH . 'controllers/' . $RTR->directory . $class . '.php');

    if (!class_exists($class, FALSE) OR $method[0] === '_' OR method_exists('CI_Controller', $method)) {
        $e404 = TRUE;
    } elseif (method_exists($class, '_remap')) {
        $params = array($method, array_slice($URI->rsegments, 2));
        $method = '_remap';
    }
    // WARNING: It appears that there are issues with is_callable() even in PHP 5.2!
    // Furthermore, there are bug reports and feature/change requests related to it
    // that make it unreliable to use in this context. Please, DO NOT change this
    // work-around until a better alternative is available.
    elseif (!in_array(strtolower($method), array_map('strtolower', get_class_methods($class)), TRUE)) {
        $e404 = TRUE;
    }
}
//here
if ($e404) {
    if (!empty($RTR->routes['404_override'])) {
        if (sscanf($RTR->routes['404_override'], '%[^/]/%s', $error_class, $error_method) !== 2) {
            $error_method = 'index';
        }

        $error_class = ucfirst($error_class);

        if (!class_exists($error_class, FALSE)) {
            if (file_exists(APPPATH . 'controllers/' . $RTR->directory . $error_class . '.php')) {
                require_once(APPPATH . 'controllers/' . $RTR->directory . $error_class . '.php');
                $e404 = !class_exists($error_class, FALSE);
            }
            // Were we in a directory? If so, check for a global override
            elseif (!empty($RTR->directory) && file_exists(APPPATH . 'controllers/' . $error_class . '.php')) {
                require_once(APPPATH . 'controllers/' . $error_class . '.php');
                if (($e404 = !class_exists($error_class, FALSE)) === FALSE) {
                    $RTR->directory = '';
                }
            }
        } else {
            $e404 = FALSE;
        }
    }

    // Did we reset the $e404 flag? If so, set the rsegments, starting from index 1
    if (!$e404) {
        $class = $error_class;
        $method = $error_method;

        $URI->rsegments = array(
            1 => $class,
            2 => $method
        );
    } else {
        show_404($RTR->directory . $class . '/' . $method);
    }
}

if ($method !== '_remap') {
    $params = array_slice($URI->rsegments, 2);
}

/*
 * ------------------------------------------------------
 *  Instantiate the requested controller
 * ------------------------------------------------------
 */

$CI = new $class();

/*
 * ------------------------------------------------------
 *  Call the requested method
 * ------------------------------------------------------
 */
call_user_func_array(array(&$CI, $method), $params);

/*
 * ------------------------------------------------------
 *  Send the final rendered output to the browser
 * ------------------------------------------------------
 */
$OUT->_display();
