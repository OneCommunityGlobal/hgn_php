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
<main class="container">
    <div class="row col-md-12 text-center"><h1>System Lookups</h1></div>

    <div class="row">
        <div id="selectorDiv" class="col-md-5">
            <form  class="form-inline" role="form" action="/project/display" method="POST">
                <div class="form-group">
                    <label for="hgnSelect">Select Project:</label>
                    <select id="hgnSelect" name="hgnSelect" class="form-control"
                            onchange='this.form.submit()'> <?php echo $model ?>
                        <option value="0">---</option>
                        <?php foreach($tableSelectors as $tsk => $tsv) { ?>
                            <option value="<?php echo $tsv['value'] ?>">
                                <?php echo $tsv['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </form>
        </div>
        <div id="buttonsDiv" class="col-md-4">
            <button id="addButton" class="" type="button" title="Add" onclick="hgnView.addData()">
                <img src="/images/icons/plus_sign.jpg" alt="Add"/></button>
            <?php if(isset($tableData)){ ?>
                <button id="deleteButton" class="" type="button" title="Delete" onclick="hgnView.deleteData()">
                    <img src="/images/icons/minus_sign.jpg" alt="Delete"/></button>
            <?php } ?>
        </div>
    </div>

    <div id="headerDiv">
        <form id="headerForm" class="form-inline" role="form">
            </div>-->
        </form>
    </div>

    <div id="messageArea" class="row col-md-12 text-center"></div>
    <div id="detailDiv" style="width:1900px;">
        <form id="detailForm" class="form-inline" role="form">
        </form>            
    </div>
</main>
    <script src="/js/view.js"></script>
    <script type="text/javascript">
        var hgnView = new View();
    </script>

<?php if($action !== 'home'){ ?>
    <script type="text/javascript">
        hgnView.headerColArr = <?php echo json_encode($headerColArr); ?>;
        hgnView.detailColArr = <?php echo json_encode($detailColArr); ?>;
        hgnView.headerData = <?php echo json_encode($projectData); ?>;
        hgnView.detailData = <?php echo json_encode($tasksData); ?>;
        hgnView.headerMeta = <?php echo json_encode($projectsMeta); ?>;
        hgnView.detailMeta = <?php echo json_encode($tasksMeta); ?>;
        hgnView.headerLookups = <?php echo json_encode($projectsLookups); ?>;
        hgnView.detailLookups = <?php echo json_encode($tasksLookups); ?>;
        hgnView.renderData('table');
    </script>
<?php } ?>
