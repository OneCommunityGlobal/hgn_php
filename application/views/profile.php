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
<main class="container">
    <div class="col-md-3">
        <div class="row"><?php $this->load->view('blocks/user_thumb', $headerData); ?></div>
        <div class="row"><?php $this->load->view('blocks/user_photo', $headerData); ?></div>
        <div class="row"><?php $this->load->view('blocks/user_avatar', $headerData); ?></div>
    </div>
    <div class="col-md-6"><?php $this->load->view('blocks/user_profile', $headerData); ?></div>
</main>