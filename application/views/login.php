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
<link rel="stylesheet" type="text/css" href="/themes/default/user.css" />

<div id="loginContainer" class="userForm">

    <form action="login" method="post" accept-charset="utf-8" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <div>
            <label for="userName" class="sr-only">User Name</label>
            <input type="text" id="userName" name="userName" value="" class="form-control"
                   placeholder="User Name" autofocus tabindex="1">
        </div>
        <div>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" value=""
                   class="form-control" placeholder="Password" tabindex="2">
        </div>
        <div>
            <label for="persist">Stay Logged In</label>
            <input type="checkbox" name="persist" value="persist" id="persist" tabindex="3"  />
        </div>
        <?php
        if (isset($message) and $message) {
            echo '<div class="message">';
            echo $message;
            echo '</div>';
        }
        ?>
        <div class="divCenter">
            <button type="submit" name="submit" value="submit"
                    class="btn btn-lg btn-primary btn-block">Sign in</button>
        </div>
        <!--
                <div class="divCenter">
                    <a href="signup" class="pull-right">Sign Up</a>
                </div>-->
    </form>
</div>
