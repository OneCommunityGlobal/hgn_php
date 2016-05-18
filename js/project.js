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
var Project = function () {
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
    renderProject : function () {
        var colArray = ["title", "description", "creatorId", "ownerId", "type", "categoryId",
            "priority", "startDateEstimate", "startDateActual", "endDateEstimate", "endDateActual", "dueDate", "status",
            "active", "timeRequiredEstimate", "timeRequiredActual"];
        var colTitleArray = ["Task Title", "Description", "Creator", "Owner", "Type", "Category",
            "Priority", "Est. Start", "Act. Start", "Est. End", "Actual End", "Due Date", "Status",
            "Active", "Est. Hours", "Act. Hours"];
        var colSizeArray = [20,2,2,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10];
        var task = this.tasksObj[1];
        renderTaskHeader(task);

        for(var pidx in this.tasksObj) {
            renderTask(this.tasksObj, this.tasksObj[pidx]);
        }

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

        function renderTask(taskObj, task) {
            if(task["id"] === null) {
                return;
            }

            if(document.getElementById(task["id"])) {
                return;
            }

            if(+(task["parentId"]) !== 0 && !document.getElementById(task["parentId"])) {
                var parentElem = taskObj[task["parentId"]];
                renderTask(taskObj, parentElem);
            }

            var tasksTbody = document.getElementById('tasksTbody');

            var tempRow = document.createElement('tr');
            tempRow.setAttribute("data-sequence", task.position);
            tempRow.setAttribute("id", task["id"]);
            for(var tidx in colArray) {
                var tempCol = document.createElement('td');
                var tempInp = document.createElement("input");
                tempInp.setAttribute('type', "text");
                tempInp.id = task[colArray[tidx]] + ':' + colArray[tidx];
                tempInp.name = task[colArray[tidx]] + ':' + colArray[tidx];
                tempInp.value = task[colArray[tidx]];
                tempInp.setAttribute('size', colSizeArray[tidx]);
                tempCol.appendChild(tempInp);
                tempRow.appendChild(tempCol);
            }

            if(+(task.parentId) === 0) {
                tasksTbody.appendChild(tempRow);
            }else {
                var parentElement = document.getElementById(task.parentId);
                var parentElementId = parentElement.id;
                var nextSequence = +(task.position) + 1;
                var qs1 = '[data-sequence="' + nextSequence + '"]';
                var qs2 = '[id="' + parentElementId + '"] > [data-sequence="' + nextSequence + '"]';
                var beforeElem = document.querySelector(qs2);
                tasksTbody.insertBefore(tempRow, beforeElem);
            }
            return;
        }

    }
};