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

    <div id="headerDiv" class="row">
        <div class="col-md-4">Project</div>
        <div class="col-md-6"><?php echo $projectData['title']; ?></div>
    </div>
    <div id="messageArea" class="row col-md-12 text-center"></div>
    <div id="dataDiv" style="width:1200px;">
    </div>
</main>
<script src="/js/project.js"></script>
<script src="/js/test.js"></script>
<script type="text/javascript">
    var hgntest = new Test();
    hgntest.headerData = <?php echo json_encode($projectData); ?>;
    hgntest.detailData = <?php echo json_encode($tasksData); ?>;
    hgntest.headerMeta = <?php echo json_encode($projectsMeta); ?>;
    hgntest.detailMeta = <?php echo json_encode($tasksMeta); ?>;
    hgntest.headerLookups = <?php echo json_encode($projectsLookups); ?>;
    hgntest.detailLookups = <?php echo json_encode($tasksLookups); ?>;
    hgntest.colArr = <?php echo json_encode($colArr); ?>;
    hgntest.init();
    hgntest.renderData('table');
</script>
