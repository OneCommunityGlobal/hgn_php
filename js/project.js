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

/**
 * HGN Project object
 *
 * This class contains methods for managing the projects page, e.g. adding/deleting tasks
 *
 * @package     HGN
 * @subpackage	
 * @category	javascript
 * @author	HGN Dev Team
 */
var Project = function() {

};

Project.prototype = {
    /**
     * Render a project
     * 
     * Displays the project info in a header block and tasks in a detail block in tabular form
     * 
     * @todo    Code is currently being roughed in. Needs most functionality added
     *
     * @access	public
     * @global 	object  tasksObj Contains all the tasks for this project
     * @return	null
     */
    renderProject : function() {
        var colArr = [
            "position", "title", "description",
            "creatorId", "ownerId", "type", "categoryId",
            "priority", "startDateEstimate", "startDateActual", "endDateEstimate",
            "endDateActual", "dueDate", "status", "active",
            "timeRequiredEstimate", "timeRequiredActual"
        ];

//***
        test.init(this.projectData, this.tasksData, this.projectsMeta, this.tasksMeta, colArr);
        test.renderData('table');

        return;
    }
};