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
 * HGN Admin user view
 *
 * Manage users 
 *
 * This class contains any methods for managing data in the user module.
 * I added the standard CRUD (create, read, update, delete) methods for database
 * functions to the CodeIgniter model parent class (system/core/model) since they are consistent across 
 * all models
 * 
 * @package     HGN
 * @subpackage	
 * @category	views
 * @author	HGN Dev Team
 */
?>
<main class="container adminMain">
    <div id="titleDiv" class="row text-center"><h1><?php echo $moduleRecord['label']?></h1></div>
    <div id="buttonsDiv" class="row text-right">
        <button id="addButton" type="button" title="Add" onclick="hgnPage.addData()">
            <img src="/images/icons/plus_sign.jpg" alt="Add"/>
        </button>
        <button id="deleteButton" class="" type="button" title="Delete" onclick="hgnPage.deleteData()">
            <img src="/images/icons/minus_sign.jpg" alt="Delete"/>
        </button>
    </div>
    <div id="selectorDiv" class="row">
        <form class="form-horizontal" role="form" action="/admin/display/<?php echo ucfirst($module) ?>" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-2" for="hgnSelect"><?php echo $moduleRecord['label'] ?>:</label>
                <div class="col-sm-6">
                    <select id="hgnSelect" name="hgnSelect" class="form-control" onchange='this.form.submit()'>
                        <option value="0">Select</option>
                        <?php foreach($tableSelectors as $tsk => $tsv) { ?>
                            <option value="<?php echo $tsv['value'] ?>">
                                <?php echo $tsv['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div id="dataDiv">
        <form id="dataForm" name="dataForm" class="form-horizontal" role="form" 
              action="/admin/update/<?php echo ucfirst($module) ?>" method="POST">
                  <?php if($action === 'display' or $action === 'add'){ ?>

                <input id="id" name="id" type="hidden" value="<?php echo $headerData['id']; ?>"/>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="title"><?php echo $tableMeta['title']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="title" value="<?php echo $headerData['title']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="description"><?php echo $tableMeta['description']['label']; ?></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" rows="1" ><?php echo $headerData['description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="userName"><?php echo $tableMeta['userName']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="userName" value="<?php echo $headerData['userName']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password"><?php echo $tableMeta['password']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" value="<?php echo $headerData['password']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="type"><?php echo $tableMeta['type']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="type">
                            <option value="0">Select</option>
                            <option value="1" <?php if($headerData['type'] == 1) echo 'selected="true"'; ?>>Admin</option>
                            <option value="2" <?php if($headerData['type'] == 2) echo 'selected="true"'; ?>>Manager</option>
                            <option value="3" <?php if($headerData['type'] == 3) echo 'selected="true"'; ?>>User</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="firstName"><?php echo $tableMeta['firstName']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="firstName" value="<?php echo $headerData['firstName']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="lastName"><?php echo $tableMeta['lastName']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="lastName" value="<?php echo $headerData['lastName']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email"><?php echo $tableMeta['email']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="email" value="<?php echo $headerData['email']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="phoneHome"><?php echo $tableMeta['phoneHome']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="phoneHome" value="<?php echo $headerData['phoneHome']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="phoneMobile"><?php echo $tableMeta['phoneMobile']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="phoneMobile" value="<?php echo $headerData['phoneMobile']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="language"><?php echo $tableMeta['language']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="language">
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
                    <label class="control-label col-sm-2" for="timezone"><?php echo $tableMeta['timezone']['label']; ?></label>
                    <div class="col-sm-10">
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
                    <label class="control-label col-sm-2" for="role"><?php echo $tableMeta['role']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $tableLookups[5];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($headerData['role'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="disableNotifications"><?php echo $tableMeta['disableNotifications']['label']; ?></label>
                    <div class="radio-inline col-sm-10">
                        <label class="radio-inline"><input type="radio" name="disableNotifications" value="0" <?php if($headerData['disableNotifications'] == 0) echo 'checked'; ?>>False</label>
                        <label class="radio-inline"><input type="radio" name="disableNotifications" value="1" <?php if($headerData['disableNotifications'] == 1) echo 'checked'; ?>>True</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="disableLogin"><?php echo $tableMeta['disableLogin']['label']; ?></label>
                    <div class="radio-inline col-sm-10">
                        <label class="radio-inline"><input type="radio" name="disableLogin" value="0" <?php if($headerData['disableLogin'] == 0) echo 'checked'; ?>>False</label>
                        <label class="radio-inline"><input type="radio" name="disableLogin" value="1" <?php if($headerData['disableLogin'] == 1) echo 'checked'; ?>>True</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="admin"><?php echo $tableMeta['admin']['label']; ?></label>
                    <div class="radio-inline col-sm-10">
                        <label class="radio-inline"><input type="radio" name="admin" value="0" <?php if($headerData['admin'] == 0) echo 'checked'; ?>>False</label>
                        <label class="radio-inline"><input type="radio" name="admin" value="1" <?php if($headerData['admin'] == 1) echo 'checked'; ?>>True</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="active"><?php echo $tableMeta['active']['label']; ?></label>
                    <div class="radio-inline col-sm-10">
                        <label class="radio-inline"><input type="radio" name="active" value="0" <?php if($headerData['active'] == 0) echo 'checked'; ?>>False</label>
                        <label class="radio-inline"><input type="radio" name="active" value="1" <?php if($headerData['active'] == 1) echo 'checked'; ?>>True</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="photoProfile"><?php echo $tableMeta['photoProfile']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="photoProfile" value="<?php echo $headerData['photoProfile']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="photoThumb"><?php echo $tableMeta['photoThumb']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="photoThumb" value="<?php echo $headerData['photoThumb']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="avatar"><?php echo $tableMeta['avatar']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="avatar" value="<?php echo $headerData['avatar']; ?>"/>
                    </div>
                </div>

                <div id="submitDiv">
                    <input id="dataSubmitButton" class="btn btn-primary" type="submit" name="Submit" value="Submit" />
                </div>

            <?php } ?>
        </form>
    </div>
</main>
<script type="text/javascript">
    hgnPage.module = "<?php echo $module; ?>";
    hgnPage.init();
</script>
