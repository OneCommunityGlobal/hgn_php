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
<main class="col-md-12">
    <div class="row col-md-12 text-center"><h1><?php echo ucfirst($module) . ' ' ?>Admin Page</h1></div>
    <div class="row">
        <div class="col-md-3"></div>
        <div id="selectorDiv" class="col-md-5">
            <form action="/admin/display/system_setting" method="POST">
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
            <form id="dataForm" name="dataForm" action="/admin/update/system_setting" method="POST">
                <?php if ($action === 'display' or $action === 'add') { ?>
                    <input id="id" name="id" type="hidden" value="<?php echo $tableData['id']; ?>"/>
                    <div class="col-md-12">
                        <div class="col-md-4">Title</div>
                        <div class="col-md-6"><input name="title" value="<?php echo $tableData['title']; ?>"/></div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-4">Description</div>
                        <div class="col-md-6"><textarea name="description" rows="1" cols="30" ><?php echo $tableData['description']; ?></textarea></div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">Value Type</div>
                        <div class="col-md-6">
                            <select name="valueType">
                                <option value="0">Select</option>
                                <?php
                                $tableLookup = $tableLookups['Value Type'];
                                foreach ($tableLookup as $k => $v) {
                                    echo '<option value= "' . $v["value"] . '"';
                                    if ($tableData['valueType'] === $v["value"]) echo 'selected="true"';
                                    echo '>' . $v['title'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">Value</div>
                        <div class="col-md-6"><input name="value" value="<?php echo $tableData['value']; ?>"/></div>
                    </div>
                    <div class="col-md-12">
                        <td colspan="2" class="text-center"><input id="dataSubmitButton" type="submit" name="Submit" value="Submit">
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
