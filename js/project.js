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
    this.useHtml5 = false;

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
        var colArray = ["", "title", "description", "creatorId", "ownerId", "type", "categoryId",
            "priority", "startDateEstimate", "startDateActual", "endDateEstimate", "endDateActual", "dueDate", "status",
            "active", "timeRequiredEstimate", "timeRequiredActual"];
        var colTitleArray = ["+/-", "Task Title", "Description", "Creator", "Owner", "Type", "Category",
            "Priority", "Est. Start", "Act. Start", "Est. End", "Actual End", "Due Date", "Status",
            "Active", "Est. Hours", "Act. Hours"];
        var colSizeArray = [10, 20, 2, 2, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
        var task = this.tasksObj[1];
        renderTaskHeader(task);

        hgnPage.renderTabularData(this.tasksObj,colArray, colTitleArray, colSizeArray);

        return;

        function renderTaskHeader(task) {
            //display header
            var tHead = document.getElementById("tasksThead");
            var headerRow = document.createElement('tr');
            for(var tidx in colArray) {
                var tempCol = document.createElement('th');
                tempCol.innerHTML = colTitleArray[tidx];
                headerRow.appendChild(tempCol);
            }
            tHead.appendChild(headerRow);
        }
    }
};