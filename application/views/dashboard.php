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
$userHours = '';
$userBadges = '';
?>

<main>
    <div class="row">
        <div class="col-md-4"><?php $this->load->view('blocks/user_profile', $masterData); ?></div>
        <div class="col-md-4"><?php $this->load->view('blocks/user_hours', $userHours); ?></div>
        <div class="col-md-4"><?php $this->load->view('blocks/user_badges', $userBadges); ?></div>
    </div>
</main>