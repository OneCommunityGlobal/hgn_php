<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="/login" method="post" accept-charset="utf-8" class="form-inline col-lg-4 pull-right">
    <div class="col-lg-5">
        <input name="title" id="title" tabindex="1" type="text"
               class="form-control input-sm" placeholder="User Name">
    </div>

    <div class="col-lg-5">
        <input name="password" id="password" tabindex="2" type="password"
               class="form-control input-sm" placeholder="Password">
    </div>
    <div class="col-lg-2">
        <button type="submit" class="btn btn-sm btn-default pull-left" tabindex="3">Log In</button>
    </div>

    <div class="col-lg-6">
        <div class="checkbox">
            <label><input type="checkbox">Remember me</label>
        </div>
    </div>
    <div class="col-lg-3">
        <a href="/signup" class="pull-right">Sign Up</a>
    </div>
</form>