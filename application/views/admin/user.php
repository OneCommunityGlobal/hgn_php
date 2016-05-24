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
<main class="col-md-12">
    <div class="row col-md-12 text-center"><h1><?php echo ucfirst($module) . ' ' ?>Admin Page</h1></div>
    <div class="row">
        <div class="col-md-3"></div>
        <div id="selectorDiv" class="col-md-5">
            <form action="/admin/display/user" method="POST">
                <span class = "">Select <?php echo ucfirst($module) ?></span>
                <select id="mySelect" name="hgnSelect" onchange='this.form.submit()'> <?php echo $model ?>
                    <option value="0">---</option>
                    <?php foreach ($tableSelectors as $tsk => $tsv) { ?>
                        <option value="<?php echo $tsv['value'] ?>">
                            <?php echo $tsv['title'] ?></option>
                    <?php } ?>
                </select>
            </form>
        </div>
        <div id="buttonsDiv" class="col-md-4">
            <button id="addButton" class="" type="button" title="Add" onclick="hgnPage.addData()">
                <img src="/images/icons/plus_sign.jpg" alt="Add"/></button>
            <?php if (isset($tableData)) { ?>
                <button id="deleteButton" class="" type="button" title="Delete" onclick="hgnPage.deleteData()">
                    <img src="/images/icons/minus_sign.jpg" alt="Delete"/></button>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div id="dataDiv" class="col-md-5">
            <form id="dataForm" name="dataForm" action="/admin/update/user" method="POST">
                <?php if ($action === 'display' or $action === 'add') { ?>
                    <input id="id" name="id" type="hidden" value="<?php echo $tableData['id']; ?>"/>
                    <div class='col-md-12'>
                        <div class="col-md-4">Title</div>
                        <div class="col-md-6"><input name="title" value="<?php echo $tableData['title']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Description</div>
                        <div class="col-md-6"><textarea name="description" rows="1" cols="30" ><?php echo $tableData['description']; ?></textarea></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">User Name</div>
                        <div class="col-md-6"><input name="userName" value="<?php echo $tableData['userName']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Password</div>
                        <div class="col-md-6"><input name="password" value="<?php echo $tableData['password']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Type</div>
                        <div class="col-md-6">
                            <select name="type">
                                <option value="0">Select</option>
                                <option value="1" <?php if ($tableData['type'] == 1) echo 'selected="true"'; ?>>Admin</option>
                                <option value="2" <?php if ($tableData['type'] == 2) echo 'selected="true"'; ?>>Manager</option>
                                <option value="3" <?php if ($tableData['type'] == 3) echo 'selected="true"'; ?>>User</option>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">First Name</div>
                        <div class="col-md-6"><input name="firstName" value="<?php echo $tableData['firstName']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Last Name</div>
                        <div class="col-md-6"><input name="lastName" value="<?php echo $tableData['lastName']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Email</div>
                        <div class="col-md-6"><input name="email" value="<?php echo $tableData['email']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Home Phone</div>
                        <div class="col-md-6"><input name="phoneHome" value="<?php echo $tableData['phoneHome']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Mobile Phone</div>
                        <div class="col-md-6"><input name="phoneMobile" value="<?php echo $tableData['phoneMobile']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Language</div>
                        <div class="col-md-6">
                            <select name="language">
                                <option value="0">Select</option>
                                <?php
                                $tableLookup = $tableLookups['Language'];
                                foreach ($tableLookup as $k => $v) {
                                    echo '<option value= "' . $v["value"] . '"';
                                    if ($tableData['language'] === $v["value"]) echo 'selected="true"';
                                    echo '>' . $v['title'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Time Zone</div>
                        <div class="col-md-6">
                            <select name="timezone">
                                <option value="0">Select</option>
                                <?php
                                $tableLookup = $tableLookups['Timezone'];
                                foreach ($tableLookup as $k => $v) {
                                    echo '<option value= "' . $v["value"] . '"';
                                    if ($tableData['timezone'] === $v["value"]) echo 'selected="true"';
                                    echo '>' . $v['title'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Role</div>
                        <div class="col-md-6">
                            <select name="role">
                                <option value="0">Select</option>
                                <?php
                                $tableLookup = $tableLookups['User Role'];
                                foreach ($tableLookup as $k => $v) {
                                    echo '<option value= "' . $v["value"] . '"';
                                    if ($tableData['role'] === $v["value"]) echo 'selected="true"';
                                    echo '>' . $v['title'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Disable Notific.</div>
                        <div class="col-md-6">
                            <input type="radio" name="disableNotifications" value="0" <?php if ($tableData['disableNotifications'] == 0) echo 'checked'; ?>>False
                            <input type="radio" name="disableNotifications" value="1" <?php if ($tableData['disableNotifications'] == 1) echo 'checked'; ?>>True
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Disable Login</div>
                        <div class="col-md-6">
                            <input type="radio" name="disableLogin" value="0" <?php if ($tableData['disableLogin'] == 0) echo 'checked'; ?>>False
                            <input type="radio" name="disableLogin" value="1" <?php if ($tableData['disableLogin'] == 1) echo 'checked'; ?>>True
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Admin</div>
                        <div class="col-md-6">
                            <input type="radio" name="admin" value="0" <?php if ($tableData['admin'] == 0) echo 'checked'; ?>>False
                            <input type="radio" name="admin" value="1" <?php if ($tableData['admin'] == 1) echo 'checked'; ?>>True
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Active</div>
                        <div class="col-md-6">
                            <input type="radio" name="active" value="0" <?php if ($tableData['active'] == 0) echo 'checked'; ?>>False
                            <input type="radio" name="active" value="1" <?php if ($tableData['active'] == 1) echo 'checked'; ?>>True
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Profile Photo</div>
                        <div class="col-md-6"><input name="photoProfile" value="<?php echo $tableData['photoProfile']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Thumb Photo</div>
                        <div class="col-md-6"><input name="photoThumb" value="<?php echo $tableData['photoThumb']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Avatar</div>
                        <div class="col-md-6"><input name="avatar" value="<?php echo $tableData['avatar']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div colspan="2" class="text-center"><input id="dataSubmitButton" type="submit" name="Submit" value="Submit" /></div>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<script type="text/javascript">
    hgnPage.module = "<?php echo $module; ?>";
    hgnPage.init();
</script>
