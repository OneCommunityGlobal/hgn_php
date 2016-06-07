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
    <div class="row col-md-12 text-center"><h1>Project</h1></div>

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
            <button id="addButton" class="" type="button" title="Add" onclick="hgnPage.addData()">
                <img src="/images/icons/plus_sign.jpg" alt="Add"/></button>
            <?php if(isset($tableData)){ ?>
                <button id="deleteButton" class="" type="button" title="Delete" onclick="hgnPage.deleteData()">
                    <img src="/images/icons/minus_sign.jpg" alt="Delete"/></button>
            <?php } ?>
        </div>
    </div>

    <?php if($action === 'display'){ ?>
        <div id="headerDiv">
            <form class="form-inline" role="form">
                <div class="row">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input id="title" type="text" size="10"  class="form-control" 
                               name="title" value="<?php echo $projectData['title']; ?>"/>
                    </div>                    
                    <div class="form-group">
                        <label for="communityId">Community:</label>
                        <select name="communityId" class="form-control">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $projectsLookups[12];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($projectData['communityId'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ownerId">Owner:</label>
                        <select name="ownerId" class="form-control">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $projectsLookups[8];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($projectData['ownerId'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select name="type" class="form-control">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $projectsLookups[13];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($projectData['type'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select name="priority" class="form-control">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $projectsLookups[19];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($projectData['priority'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Status:</label>
                        <select name="status" class="form-control">
                            <option value="0">Select</option>
                            <?php
                            $tableLookup = $projectsLookups[14];
                            foreach($tableLookup as $k => $v) {
                                echo '<option value= "' . $v["value"] . '"';
                                if($projectData['status'] === $v["value"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="startDateEstimate">Est. Start:</label>
                        <input id="startDateEstimate" type="text" size="10"  class="form-control" 
                               name="startDateEstimate" value="<?php echo $projectData['startDateEstimate']; ?>"/>
                    </div>                    
                    <div class="form-group">
                        <label for="startDateActual">Act. Start:</label>
                        <input id="startDateActual" type="text" size="10"  class="form-control" 
                               name="startDateEstimate" value="<?php echo $projectData['startDateActual']; ?>"/>
                    </div>                                     
                    <div class="form-group">
                        <label for="endDateEstimate">Est. End:</label>
                        <input id="startDateActual" type="text" size="10"  class="form-control" 
                               name="endDateEstimate" value="<?php echo $projectData['endDateEstimate']; ?>"/>
                    </div>                                     
                    <div class="form-group">
                        <label for="endDateActual">Act. End:</label>
                        <input id="startDateActual" type="text" size="10"  class="form-control" 
                               name="endDateActual" value="<?php echo $projectData['endDateActual']; ?>"/>
                    </div>                                     
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="timeRequiredEstimate">Est. Time Required:</label>
                        <input id="timeRequiredEstimate" type="text" size="10"  class="form-control" 
                               name="timeRequiredEstimate" value="<?php echo $projectData['timeRequiredEstimate']; ?>"/>
                    </div>                    
                    <div class="form-group">
                        <label for="timeRequiredActual">Act. Time Required:</label>
                        <input id="timeRequiredActual" type="text" size="10"  class="form-control" 
                               name="timeRequiredActual" value="<?php echo $projectData['timeRequiredActual']; ?>"/>
                    </div>                                     
                    <div class="form-group">
                        <label for="percentComplete">Pct. Complete:</label>
                        <input id="percentComplete" type="text" size="10"  class="form-control" 
                               name="percentComplete" value="<?php echo $projectData['percentComplete']; ?>"/>
                    </div>                                     
                    <div class="form-group">
                        <label for="active">Active:</label>
                        <input id="active" type="text" size="10"  class="form-control" 
                               name="active" value="<?php echo $projectData['active']; ?>"/>
                    </div>                                     
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" type="text" cols="30" rows="1"  class="form-control" 
                                  name="description"><?php echo $projectData['description']; ?></textarea>
                    </div>      
                </div>
            </form>
        </div>
    
        <div id="messageArea" class="row col-md-12 text-center"></div>
        <div id="dataDiv" style="width:1900px;">
            <form id="dataForm" class="form-inline" role="form">
            </form>            
        </div>
    <?php } ?>
</main>
<?php if($action === 'display'){ ?>

    <script src="/js/view.js"></script>
    <script type="text/javascript">
                    var hgnView = new View();
                    hgnView.headerData = <?php echo json_encode($projectData); ?>;
                    hgnView.detailData = <?php echo json_encode($tasksData); ?>;
                    hgnView.headerMeta = <?php echo json_encode($projectsMeta); ?>;
                    hgnView.detailMeta = <?php echo json_encode($tasksMeta); ?>;
                    hgnView.headerLookups = <?php echo json_encode($projectsLookups); ?>;
                    hgnView.detailLookups = <?php echo json_encode($tasksLookups); ?>;
                    hgnView.colArr = <?php echo json_encode($colArr); ?>;
                    hgnView.renderData('table');
    </script>
<?php } ?>
