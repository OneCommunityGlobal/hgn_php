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
<p><h4>Profile</h4></p>
<div class="userProfileBlock">
    <form class="userProfileForm form-horizontal" action="/user/doSomething" method="post">
        <div class="form-group">
            <label class="control-label col-sm-3" for="title"><?php echo $tableMeta['title']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="title" value="<?php echo $headerData['title']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="description"><?php echo $tableMeta['description']['colHeader']; ?></label>
            <div class="col-sm-7">
                <textarea class="form-control" name="description" rows="1" ><?php echo $headerData['description']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="userName"><?php echo $tableMeta['userName']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="userName" value="<?php echo $headerData['userName']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="firstName"><?php echo $tableMeta['firstName']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="firstName" value="<?php echo $headerData['firstName']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="lastName"><?php echo $tableMeta['lastName']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="lastName" value="<?php echo $headerData['lastName']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email"><?php echo $tableMeta['email']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="email" value="<?php echo $headerData['email']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="phoneHome"><?php echo $tableMeta['phoneHome']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="phoneHome" value="<?php echo $headerData['phoneHome']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="phoneMobile"><?php echo $tableMeta['phoneMobile']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="phoneMobile" value="<?php echo $headerData['phoneMobile']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="language"><?php echo $tableMeta['language']['colHeader']; ?></label>
            <div class="col-sm-7">
                <select class="form-control" name="language" disabled>
                    <option value="0">Select</option>
                    <?php
                    $tableLookup = $tableLookups[10];
                    foreach($tableLookup as $k => $v) {
                        echo '<option value= "' . $v["value"] . '"';
                        if($headerData['language'] === $v["value"]) echo 'selected="true"';
                        echo '>' . $v['title'];
                        echo '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="timezone"><?php echo $tableMeta['timezone']['colHeader']; ?></label>
            <div class="col-sm-7">
                <select class="form-control" name="timezone">
                    <option value="0">Select</option>
                    <?php
                    $tableLookup = $tableLookups[11];
                    foreach($tableLookup as $k => $v) {
                        echo '<option value= "' . $v["value"] . '"';
                        if($headerData['timezone'] === $v["value"]) echo 'selected="true"';
                        echo '>' . $v['title'];
                        echo '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="photoProfile"><?php echo $tableMeta['photoProfile']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="photoProfile" value="<?php echo $headerData['photoProfile']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="photoThumb"><?php echo $tableMeta['photoThumb']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="photoThumb" value="<?php echo $headerData['photoThumb']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="avatar"><?php echo $tableMeta['avatar']['colHeader']; ?></label>
            <div class="col-sm-7">
                <input class="form-control" name="avatar" value="<?php echo $headerData['avatar']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="disableNotifications"><?php echo $tableMeta['disableNotifications']['colHeader']; ?></label>
            <div class="col-sm-7">
                <label class="radio-inline"><input class="radio-inline" type="radio" name="disableNotifications" value="0" <?php if($headerData['disableNotifications'] == 0) echo 'checked'; ?>>Off</label>
                <label class="radio-inline"><input class="radio-inline" type="radio" name="disableNotifications" value="1" <?php if($headerData['disableNotifications'] == 1) echo 'checked'; ?>>On</label>
            </div>
        </div>
    </form>
    <div class="form-group invisible">
        <label class="control-label col-sm-3" for="password"><?php echo $tableMeta['password']['colHeader']; ?></label>
        <div class="col-sm-7">
            <input class="form-control" type="password" name="password" 
                   value="<?php echo $headerData['password']; ?>" disabled/>
        </div>
    </div>
</div>