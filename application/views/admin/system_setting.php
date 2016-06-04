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
<main class="adminMain col-sm-6">
    <div id="titleDiv" class="row text-center"><h1><?php echo $moduleRecord['label'] . ' - '?>Admin Page</h1></div>
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

                <input id="id" name="id" type="hidden" value="<?php echo $masterData['id']; ?>"/>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="title"><?php echo $tableMeta['title']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="title" value="<?php echo $masterData['title']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="description"><?php echo $tableMeta['description']['label']; ?></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" rows="1" ><?php echo $masterData['description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="valueType"><?php echo $tableMeta['valueType']['label']; ?></label>
                    <div class="col-sm-10">
                        <select class="form-control" name="valueType">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $tableLookups[9];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($masterData['valueType'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="value"><?php echo $tableMeta['value']['label']; ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="value" value="<?php echo $masterData['value']; ?>"/>
                    </div>
                </div>

                <div id="submitDiv">
                    <input id="dataSubmitButton" class="btn btn-default" type="submit" name="Submit" value="Submit" />
                </div>

            <?php } ?>
        </form>
    </div>
</main>
<script type="text/javascript">
    hgnPage.module = "<?php echo $module; ?>";
    hgnPage.init();
</script>
