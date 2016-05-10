<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main>
    <div class="row">
        <div class="col-md-4"><?php $this->load->view('blocks/user_photo', $user); ?></div>
        <div class="col-md-4"><?php $this->load->view('blocks/user_profile', $user); ?></div>
        <div class="col-md-4"><?php $this->load->view('blocks/user_thumb', $user); ?></div>
        <div class="col-md-4"><?php $this->load->view('blocks/user_avatar', $user); ?></div>
d    </div>
</main>