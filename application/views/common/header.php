<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<header class="col-lg-12">
    <div class="row">
        <div class="media col-lg-8">
            <a href="/home">
                    <img src = 'images/logo.jpg' alt = 'Logo' class = 'media-object' />
            </a>
            <div class="media-body pull-left">
                <h2><?php echo PAGE_TITLE?></h2>
            </div>
        </div>

        <?php
        //If user is logged in already, display the welcome username message in the header.
        if ($loggedIn) {
            include "welcome_msg.php";
        }
        ?>
    </div>
</header>
