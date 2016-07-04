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
    <div id="titleDiv" class="row text-center">
        <div class="col-md-3"></div>
        <h1 class="col-md-6"><?php echo $moduleRecord['label'] ?></h1>
    </div>
    
    <div id="buttonsDiv" class="row text-right">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <button id="addButton" type="button" title="Add" onclick="hgnPage.addData()">
                <img src="/images/icons/plus_sign.jpg" alt="Add"/>
            </button>
            <button id="deleteButton" class="" type="button" title="Delete" onclick="hgnPage.deleteData()">
                <img src="/images/icons/minus_sign.jpg" alt="Delete"/>
            </button>
        </div>
    </div>
    
    <div id="selectorDiv" class="row">
        <div class="col-md-3"></div>
        <form class="form-horizontal col-md-6" role="form" action="/admin/display/<?php echo $module ?>" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-3" for="hgnSelect"><?php echo $moduleRecord['label'] ?>:</label>
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
    <div id="dataDiv" class="row">
        <div class="col-md-3"></div>
        <form id="dataForm" name="dataForm" class="form-horizontal col-md-6" role="form" 
              action="/admin/update/<?php echo $module ?>" method="POST">
                  <?php if($action === 'display' or $action === 'add'){ ?>

                <input id="id" name="id" type="hidden" value="<?php if(isset($headerData['id'])) echo $headerData['id']; ?>"/>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="title"><?php if(isset($tableMeta['title']['label']))echo$tableMeta['title']['label']; ?></label>
                    <div class="col-sm-6">
                        <input class="form-control" name="title" value="<?php if(isset($headerData['title']))echo $headerData['title']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="description"><?php if(isset($tableMeta['description']['label']))echo$tableMeta['description']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="description" rows="1" ><?php if(isset($headerData['description']))echo $headerData['description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="label"><?php if(isset($tableMeta['label']['label']))echo$tableMeta['label']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="label" rows="1" ><?php if(isset($headerData['label']))echo $headerData['label']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="model"><?php if(isset($tableMeta['model']['label']))echo$tableMeta['model']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="model" rows="1" ><?php if(isset($headerData['model']))echo $headerData['model']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="view"><?php if(isset($tableMeta['view']['label']))echo$tableMeta['view']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="view" rows="1" ><?php if(isset($headerData['view']))echo $headerData['view']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="headerTable"><?php if(isset($tableMeta['headerTable']['label']))echo$tableMeta['headerTable']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="headerTable" rows="1" ><?php if(isset($headerData['headerTable']))echo $headerData['headerTable']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="headerTableCol"><?php if(isset($tableMeta['headerTableCol']['label']))echo$tableMeta['headerTableCol']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="headerTableCol" rows="1" ><?php if(isset($headerData['headerTableCol']))echo $headerData['headerTableCol']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="headerMethod"><?php if(isset($tableMeta['headerMethod']['label']))echo$tableMeta['headerMethod']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="headerMethod" rows="1" ><?php if(isset($headerData['headerMethod']))echo $headerData['headerMethod']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="detailTable"><?php if(isset($tableMeta['detailTable']['label']))echo$tableMeta['detailTable']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="detailTable" rows="1" ><?php if(isset($headerData['detailTable']))echo $headerData['detailTable']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="detailTableCol"><?php if(isset($tableMeta['detailTableCol']['label']))echo$tableMeta['detailTableCol']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="detailTableCol" rows="1" ><?php if(isset($headerData['detailTableCol']))echo $headerData['detailTableCol']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="detailMethod"><?php if(isset($tableMeta['detailMethod']['label']))echo$tableMeta['detailMethod']['label']; ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="detailMethod" rows="1" ><?php if(isset($headerData['detailMethod']))echo $headerData['detailMethod']; ?></textarea>
                    </div>
                </div>
                <div class="text-center" id="submitDiv">
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
