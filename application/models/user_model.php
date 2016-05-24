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
 * @category	models
 * @author	HGN Dev Team
 */
class User_model extends CI_Model {

    public function isLoggedIn() {
        //check if session vars are set with username/password
        $userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : FALSE;
        if (!$userName) {
            $this->session->sess_destroy();
            return false;
        }

        $password = isset($_SESSION['password']) ? $_SESSION['password'] : FALSE;
        if ($userName and $password) {
            if (!$this->validateUsernamePassword($userName, $password)) {
                $this->session->sess_destroy();
                return false;
            }
        } else {
            $this->session->sess_destroy();
            return false;
        }
        return true;
    }

    public function validateUsernamePassword($userName = NULL, $password = NULL) {
        $sql = 'SELECT * from `users`';
        $sql .= ' where userName = "' . strtolower($userName) . '"';
        $result = $this->db->query($sql);
//TODO  Add password hashing
        if (isset($result->row_array()['password']) and $result->row_array()['password'] === $password) {
            foreach ($result->row_array() as $k => $v) {
                //this->set is in parent
                $this->set($k, $v);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Calculate user hours between dates
     * 
     * Calculates the hours spent on all projects and tasks 
     * between the given dates for a particular user
     * 
     * @author  Intern team
     * 
     * @todo
     *
     * @access	public
     * @global 	type    $globlvarname   Documents a global variable or its use in a function or method
     * @name    global  var name        Specifies an alias for a variable. For example, $GLOBALS['myvariable'] becomes $myvariable
     * @param	type    name            short description
     * @return	type    name            short description
     */
    public function calcHours($userId, $beginDate, $endDate) {
        $sql = 'SELECT';
        $sql .= ' SUM(hoursSpent) AS totalHours';
        $sql .= ' FROM timesheets';
        $sql .= ' WHERE startDate BETWEEN ' . $beginDate . ' AND ' . $endDate;
        $result = $this->db->query(sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['total_hours'] == NULL) {
                return 0;
            }
            return $row['total_hours'];
        } else {
            return 0;
        }
    }

    public function calcHoursByCategory($userId, $category, $begDate=null, $endDate=null) {
        $sql = 'SELECT';
        $sql .= ' t.categoryUserId, SUM(s.sub_task_time) AS hours_category';
        $sql .= ' FROM sub_task AS s';
        $sql .= ' LEFT JOIN user_task AS ut ON s.user_taskUserId = ut.user_taskUserId';
        $sql .= ' LEFT JOIN user AS u ON ut.userId = u.userId';
        $sql .= ' LEFT JOIN task AS t ON ut.taskUserId = t.taskUserId';
        $sql .= ' WHERE u.userId = ' . '"' . $userId . '" AND t.categoryUserId = "{$category}" AND s.sub_task_typeUserId = 1';
        $sql .= ' GROUP BY t.categoryUserId';
        $result = $this->db->query($sql);
        return $result;
    }

    public function get_hours($userId, $yearweek_get_hours) {
        $sql = 'SELECT';
        $sql .= ' YEARWEEK(s.sub_task_date) AS yearweek, SUM(s.sub_task_time) AS hours';
        $sql .= ' FROM sub_task AS s';
        $sql .= ' LEFT JOIN user_task AS ut ON s.user_taskUserId = ut.user_taskUserId';
        $sql .= ' LEFT JOIN user AS u ON ut.userId = u.userId';
        $sql .= ' WHERE u.userId = "{$userId}" AND YEARWEEK(s.sub_task_date) = {$yearweek_get_hours} AND s.sub_task_typeUserId = 1';
        $sql .= ' GROUP BY YEARWEEK(s.sub_task_date)';
        $result = $this->db->query($sql);
        return $result;
    }

    public function get_quant_lead($conn, $userId) {
        $sql = 'SELECT';
        $sql .= ' COUNT(ut.userId) AS quant_lead';
        $sql .= ' FROM user_team AS ut';
        $sql .= ' LEFT JOIN team AS t ON t.teamUserId = ut.teamUserId';
        $sql .= ' LEFT JOIN user AS u ON u.userId = ut.userId';
        $sql .= ' WHERE t.manager = "{$userId}"';
        $sql .= ' GROUP BY ut.userId';
        $result = $this->db->query($sql);
        return $result;
    }

    public function get_quant_cat($year, $week, $conn, $userId) {
        $sql = 'SELECT';
        $sql .= ' COUNT(t.categoryUserId) AS quant_cat';
        $sql .= ' FROM task AS t';
        $sql .= ' RIGHT JOIN user_task AS ut ON ut.taskUserId = t.taskUserId';
        $sql .= ' RIGHT JOIN sub_task AS s ON ut.user_taskUserId = s.user_taskUserId';
        $sql .= ' LEFT JOIN user AS u ON ut.userId = u.userId';
        $sql .= ' WHERE u.userId = "{$userId}" AND YEAR(s.sub_task_date) = "{$year}" AND WEEK(s.sub_task_date) = "{$week}"';
        $sql .= ' GROUP BY t.categoryUserId';
        $result = $this->db->query($sql);
        return $result;
    }

    public function get_quant_users_manager($conn, $userId) {
        $countTeams = 0;
        $countUsers = 0;

        $sql = 'SELECT';
        $sql .= ' teamUserId, visibility';
        $sql .= ' FROM user_team ';
        $sql .= ' WHERE userId = "{$userId}" AND visibility = 1';
        $result = $this->db->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = 'SELECT';
            $sql .= ' team_manager, visibility';
            $sql .= ' FROM team';
            $sql .= ' WHERE teamUserId = "{$row["teamUserId"]}" AND visibility = 1';
            $result = $this->db->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['team_manager'] == $userId) {
                    $sql = ' SELECT';
                    $sql .= ' userId, visibility';
                    $sql .= ' FROM user_team';
                    $sql .= ' WHERE teamUserId = "{$row["teamUserId"]}" AND visibility = 1';
                    $sql .= ' GROUP BY userId';
                    $result = $this->db->query($sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $countUsers++;
                    }
                }
            }

            $teams[$countTeams] = $countUsers;
            $countTeams++;
            $countUsers = 0;
        }

        return max($teams);
    }

    public function number_blue_squares($userId, $yearweek_max, $yearweek_min) {

        $count = 0;

        $sql = 'SELECT user_week_hrs FROM user WHERE userId = "{$userId}"';
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);
        $exHr = $row["user_week_hrs"];

        while ($yearweek_max > $yearweek_min) {
            if ($yearweek_max % 100 == 0) {
                $yearweek_max = $yearweek_max - 100 + 53;
            }

            $result = $this->db->query($sql);
            $row = mysqli_fetch_assoc($result);
            $hours = $row["hours"];

            if ($hours < $exHr) {
                $count++;
            }

            $yearweek_max--;
        }

        return $count;
    }

}
