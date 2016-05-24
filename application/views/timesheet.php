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
    <div class="row col-md-12 text-center"><h1>Time Sheet</h1></div>

    <div class="row">
        <div class="col-md-3"></div>
        <div id="dataDiv" class="col-md-6">
            <form id="dataForm" name="dataForm" action="/project/timesheet/" method="POST">
                <div class="row col-md-12">
                    <div class="col-md-4">User Name</div>
                    <div class="col-md-6"><input name="userName" value="<?php echo $userData['userName']; ?>" disabled/></div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">Project</div>
                    <div class="col-md-6">
                        <select name="project">
                            <?php
                            foreach ($projectsData as $k => $v) {
                                echo '<option value= "' . $v["id"] . '"';
//                                  if ($projectsData['id'] === $v["id"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">Task</div>
                    <div class="col-md-6">
                        <select name="task">
                            <?php
                            foreach ($tasksData as $k => $v) {
                                echo '<option value= "' . $v["id"] . '"';
//                                        if ($tasksData['id'] === $v["id"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">Start Date</div>
                    <div class="col-md-6"><input name="startDate" value="<?php echo date('m/d/Y'); ?>"/></div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">Hours Spent</div>
                    <div class="col-md-6"><input name="hoursSpent" value="<?php echo '0.00'; ?>"/></div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">In Date/Time</div>
                    <div class="col-md-2"><input type="text" size="4" name="startDate" disabled="true" value="<?php echo '--/--/----'; ?>"/></div>
                    <div class="col-md-2"><input type="text" size="2" name="startTime" disabled="true" value="<?php echo '--:--'; ?>"/></div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">Out Date/Time</div>
                    <div class="col-md-2"><input type="text" size="4" name="endDate" disabled="true" value="<?php echo '--/--/----'; ?>"/>  </div>
                    <div class="col-md-2"><input type="text" size="2" name="endTime" disabled="true" value="<?php echo '--:--'; ?>"/></div>
                </div>
                <!--<div class="text-center col-md-12"><input id="dataSubmitButton" type="submit" name="Submit" value="Submit"></div>-->
                <div id="timeClock" class="timeClock row col-md-12">
                    <span>
                        <span id="hours">00</span>
                        :
                        <span id="minutes">00</span>
                        :
                        <span id="seconds">00</span>
                    </span>
                </div>
                <div id="timerButtons" class="row col-md-12">
                    <button id="timerStart" class="" type="button" title="Start" onclick="hgnTimesheet.startTimer()">
                        <img src="/images/icons/timer_start.jpg" alt="Start Timer"/></button>
                    <button id="timerStop" class="" type="button" title="Stop" onclick="hgnTimesheet.stopTimer()">
                        <img src="/images/icons/timer_stop.jpg" alt="Stop Timer"/></button>
                </div>
                <div id="timerCheckBox" class="row col-md-12">
                    <div class="col-md-4">Show Clock</div>
                    <div class="col-md-6"><input id="showClock" type="checkbox" checked="TRUE" /></div>
                </div>
            </form>
        </div>
    </div>
</main>

<script type="text/javascript" src="/js/timesheet.js"></script>
<script type="text/javascript">
                        hgnTimesheet = new Timesheet();
</script>
