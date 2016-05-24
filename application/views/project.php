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
<main>
    <img name="plusSign" src="/images/icons/plus_sign.jpg" alt="Add"/>
    <div class="row col-md-12 text-center"><h1>Project</h1></div>

    <div class="row">
        <div id="dataDiv" class="col-md-12">
            <div class="col-md-12">
                <div class="col-md-4">Project</div>
                <div class="col-md-6"><?php echo $projectData['title']; ?></div>
            </div>
        </div>
    </div>
    <div id="tasksDiv">
        <form id="tasksForm" class="tasksForm" name="tasksForm" action="/project/update" method="POST">
            <table id="tasksTable" class="table">
                <thead id="tasksThead">
                </thead>
                <tbody id="dataTbody">
                </tbody>
            </table>
            <div class='col-md-12 invisible'>
                <div colspan="2" class="text-center"><input id="submitButton" type="submit" name="Submit" value="Submit" /></div>
            </div>
        </form>
    </div>
</main>
<script src="/js/project.js"></script>
<script type="text/javascript">
    var project = new Project();
    project.projectObj = <?php echo json_encode($projectData); ?>;
    project.tasksObj = <?php echo json_encode($tasksData); ?>;
    project.renderProject();
    hgnPage.disableFormEdit('tasksForm');
</script>
