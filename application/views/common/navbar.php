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
<?php
$admin = $_SESSION["admin"];
$userName = $_SESSION["userName"];
?>

<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home"><?php echo COMPANY_ABBREV ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/home">Home</a></li>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/user/displayProfile">Profile</a></li>
                <li><a href="/project/home">Project</a></li>
                <li><a href="/project/timesheet">Timesheet</a></li>
                <li><a href="/report">Report</a></li>
                <?php if ($admin) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Master Data</li>
                            <li><a href="/admin/home/community">Manage Communities</a></li>
                            <li><a href="/admin/home/project">Manage Projects</a></li>
                            <li><a href="/admin/home/user">Manage Users</a></li>
                            <li><a href="/admin/home/user_preference">Manage User Preferences</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">System Data</li>
                            <li><a href="/admin/home/system_lookup">Manage Lookups</a></li>
                            <li><a href="/admin/home/system_table">Manage Tables</a></li>
                            <li><a href="/admin/home/system_setting">Manage System Settings</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown pull-xs-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $userName; ?>
                        <ul class="dropdown-menu">
                            <li><a href="/user/displayProfile">My Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/access/logout">Logout</a></li>
                        </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>