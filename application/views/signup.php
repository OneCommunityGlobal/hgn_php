<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" type="text/" href="/themes/default/user.css"/>

<div id="signupContainer" class="userForm">
    <form action="/signup" method="post" accept-charset="utf-8">
        <div>
            <label for="username">User Name</label>
            <input type="text" name="username" value="" id="username" class="inputtext" tabindex="6"  />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" value="" id="password" class="inputtext" tabindex="7"  />
        </div>
        <div>
            <label for="repassword">Confirm Password</label>
            <input type="password" name="repassword" value="" id="repassword" class="inputtext" tabindex="8"  />
        </div>
        <div>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" value="" id="firstName" class="inputtext" tabindex="9"  />
        </div>
        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" value="" id="lastName" class="inputtext" tabindex="10"  />
        </div>
        <div>
            <label for="email">Email Address</label>
            <input type="text" name="email" value="" id="email" class="inputtext" tabindex="11"  />
        </div>
        <div class="divCenter">
            <input type="submit" name="signupButton" value="Sign Up" id="signupButton" class="button" tabindex="12"  />
        </div>
    </form>
</div>