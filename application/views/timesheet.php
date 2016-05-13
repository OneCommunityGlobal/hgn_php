<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="col-md-12">
    <div class="row col-md-12 text-center"><h1>Time Sheet</h1></div>

    <div class="row">
        <div class="col-md-3"></div>
        <div id="dataDiv" class="col-md-6">
            <form id="dataForm" name="dataForm" action="/project/timesheet/" method="POST">
                <div class="col-md-12">
                    <div class="col-md-4">User Name</div>
                    <div class="col-md-6"><input name="userName" value="<?php echo $userData['userName']; ?>" disabled/></div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">Project</div>
                    <div class="col-md-6">
                        <select name="project">
                            <?php
                            foreach ($projectsData as $k => $v) {
                                echo '<option value= "' . $v["id"] . '"';
//                                        if ($projectsData['id'] === $v["id"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">Task</div>
                    <div class="col-md-6">
                        <select name="task">
                            <?php
                            foreach ($tasksData as $k => $v) {
                                echo '<option value= "' . $v["id"] . '"';
//                                        if ($projectsData['id'] === $v["id"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">Sub-Task</div>
                    <div class="col-md-6">
                        <select name="subTask">
                            <?php
                            foreach ($subTasksData as $k => $v) {
                                echo '<option value= "' . $v["id"] . '"';
//                                        if ($projectsData['id'] === $v["id"]) echo 'selected="true"';
                                echo '>' . $v['title'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">Start Date</div>
                    <div class="col-md-6"><input name="startDate" value="<?php echo '12/01/2001'; ?>"/></div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">Hours Spent</div>
                    <div class="col-md-6"><input name="description" value="<?php echo '0.00'; ?>"/></div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">Start Date/Time</div>
                    <div class="col-md-3"><input name="startDate" value="<?php echo '12/01/2001'; ?>"/>  </div>
                    <div class="col-md-3"><input name="startTime" value="<?php echo '10:43'; ?>"/></div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">End Date/Time</div>
                    <div class="col-md-3"><input name="endDate" value="<?php echo '12/01/2001'; ?>"/>  </div>
                    <div class="col-md-3"><input name="endTime" value="<?php echo '10:43'; ?>"/></div>
                </div>
                <div class="text-center col-md-12"><input id="dataSubmitButton" type="submit" name="Submit" value="Submit"></div>
            </form>
        </div>
    </div>
</main>