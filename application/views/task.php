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
        <h1 class="col-md-6">Task</h1>
    </div>

    <div id="dataDiv">
        <form id="dataForm" name="dataForm" class="form-horizontal" role="form">
            <input id="projectId" name="projectId" type="hidden" value="<?php echo $projectData['id']; ?>"/>
            <input id="userId" name="projectId" type="hidden" value="<?php echo $userId; ?>"/>

            <div class="form-group">
                <label class="control-label col-sm-3" for="project">Project</label>
                <div class="col-sm-7">
                    <select name="project" class="form-control">
                        <option value="0">Select</option>
                        <?php
                        $tableLookup = $projectsData;
                        foreach($tableLookup as $k => $v) {
                            echo '<option value= "' . $v["id"] . '"';
//                            if($projectsData['project'] === $v["value"]) echo 'selected="true"';
                            echo '>' . $v['title'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="task">Task</label>
                <div class="col-sm-7">
                    <select name="task" class="form-control">
                        <option value="0">Select</option>
                        <?php
                        $tableLookup = $tasksData;
                        foreach($tableLookup as $k => $v) {
                            echo '<option value= "' . $v["id"] . '"';
//                            if($tasksData['task'] === $v["value"]) echo 'selected="true"';
                            echo '>' . $v['title'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="type">Type</label>
                <div class="col-sm-7">
                    <select name="type" class="form-control">
                        <option value="0">Select</option>
                        <?php
                        $tableLookup = $tasksLookups[15];
                        foreach($tableLookup as $k => $v) {
                            echo '<option value= "' . $v["value"] . '"';
//                            if($tasksData['type'] === $v["value"]) echo 'selected="true"';
                            echo '>' . $v['title'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="category">Category</label>
                <div class="col-sm-7">
                    <select name="category" class="form-control">
                        <option value="0">Select</option>
                        <?php
                        $tableLookup = $tasksLookups[16];
                        foreach($tableLookup as $k => $v) {
                            echo '<option value= "' . $v["value"] . '"';
//                            if($tasksData['category'] === $v["value"]) echo 'selected="true"';
                            echo '>' . $v['title'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="priority">Priority</label>
                <div class="col-sm-7">
                    <select name="priority" class="form-control">
                        <option value="0">Select</option>
                        <?php
                        $tableLookup = $tasksLookups[17];
                        foreach($tableLookup as $k => $v) {
                            echo '<option value= "' . $v["value"] . '"';
//                            if($tasksData['priority'] === $v["value"]) echo 'selected="true"';
                            echo '>' . $v['title'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="description">Description</label>
                <div class="col-sm-7">
                    <textarea cols="1" class="form-control" name="description"><?php //echo $userData['userName'];   ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="startDate">Start Date</label>
                <div class="col-sm-7">
                    <input class="form-control" name="startDate" value="<?php echo date('m/d/Y'); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="hoursSpent">Hours Spent</label>
                <div class="col-sm-7">
                    <input class="form-control" name="hoursSpent" value="<?php echo '0.00'; ?>"/>
                </div>
            </div>
            <div class="col-md-10"><?php $this->load->view('blocks/timeclock'); ?></div>
        </form>
    </div>
</main>
