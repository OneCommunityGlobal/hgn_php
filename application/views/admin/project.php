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
                    <label class="control-label col-sm-2" for="communityId"><?php echo $tableMeta['communityId']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="communityId">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $tableLookups[12];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($headerData['communityId'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="ownerId"><?php echo $tableMeta['ownerId']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="ownerId">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $tableLookups[8];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($headerData['ownerId'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="type"><?php echo $tableMeta['type']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="type">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $tableLookups[13];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($headerData['type'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="priority"><?php echo $tableMeta['priority']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="priority">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $tableLookups[19];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($headerData['priority'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="status"><?php echo $tableMeta['status']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $tableLookups[14];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($headerData['status'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="startDateEstimate"><?php echo $tableMeta['startDateEstimate']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="startDateEstimate" value="<?php echo $headerData['startDateEstimate']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="startDateActual"><?php echo $tableMeta['startDateActual']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="startDateActual" value="<?php echo $headerData['startDateActual']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="endDateEstimate"><?php echo $tableMeta['endDateEstimate']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="endDateEstimate" value="<?php echo $headerData['endDateEstimate']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="endDateActual"><?php echo $tableMeta['endDateActual']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="endDateActual" value="<?php echo $headerData['endDateActual']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="timeRequiredEstimate"><?php echo $tableMeta['timeRequiredEstimate']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="timeRequiredEstimate" value="<?php echo $headerData['timeRequiredEstimate']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="timeRequiredActual"><?php echo $tableMeta['timeRequiredActual']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="timeRequiredActual" value="<?php echo $headerData['timeRequiredActual']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="percentComplete"><?php echo $tableMeta['percentComplete']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="percentComplete" value="<?php echo $headerData['percentComplete']; ?>"/>
                    </div>
                </div>

                <div class="form-group form-inline">
                    <label class="control-label col-sm-2" for="active"><?php echo $tableMeta['active']['label']; ?></label>
                    <div class="radio-inline col-sm-10">
                        <label class="radio-inline"><input type="radio" name="active" value="0" <?php if($headerData['active'] == 0) echo 'checked'; ?>>No</label>
                        <label class="radio-inline"><input type="radio" name="active" value="1" <?php if($headerData['active'] == 1) echo 'checked'; ?>>Yes</label>
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
