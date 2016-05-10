<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="welcomeContainer" class="userForm">
    <div>
        Welcome <?php echo $this->session->userdata('title') ?>
    </div>
    <div>
        <a href="/logout">Log Out</a>
    </div>

</div>