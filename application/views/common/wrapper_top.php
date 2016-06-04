<?php
/**
 * Highest Good Network
 *
 * An open source project management tool for managing global communities.
 *
 * @package	HGN
 * @author	The HGN Development Team
 * @copyright	Copyright (c) 2016.
 * @license     TBD
 * @link        https://github.com/OneCommunityGlobal/hgn_dev.git
 * @version	0.8a
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * HGN short description here
 *
 * This class long description here
 *
 * @package     HGN
 * @subpackage	
 * @category	views
 * @author	HGN Dev Team
 */
?>
<!DOCTYPE html5>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Per Bootstrap, The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title><?php echo PAGE_TITLE ?></title>

        <!-- Bootstrap core CSS -->
        <link href="/css/<?php echo BOOTSTRAP ?>.css" rel="stylesheet">

        <!--TODO convert to using themes
        <!-- Site base CSS -->
        <link href="/themes/default/base.css" rel="stylesheet">

        <!-- May have to load jquery here instead of bottom wrapper is some plugin needs it -->
        <!-- This should be loaded in wrapper bottom but flot doesn't work -->
        <script src="/js/<?php echo JQUERY ?>.js"></script>

        <!-- Load Sparkline inline charting jquery plugin-->
        <script src="/js/<?php echo SPARKLINE ?>.js"></script>

        <!-- Load Base JS Library-->
        <script src="/js/page.js"></script>
        <!-- Load AJAX JS Library-->
        <script src="/js/ajax.js"></script>
    </head>

    <body>
        <script>
            hgnPage = new Page();
            hgnAjax = new Ajax();
        </script>
        <div id="wrapper" class="container">