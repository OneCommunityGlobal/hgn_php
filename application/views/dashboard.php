<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$userHours = '';
$userBadges = '';
?>

<main>
    <div class="row">
        <div class="col-md-4"><?php $this->load->view('blocks/user_profile', $user); ?></div>
        <div class="col-md-4"><?php $this->load->view('blocks/user_hours', $userHours); ?></div>
        <div class="col-md-4"><?php $this->load->view('blocks/user_badges', $userBadges); ?></div>
    </div>
</main>