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
<link rel="stylesheet" type="text/css" href="/themes/default/user.css"/>
<main class="container adminMain">
    <div id="titleDiv" class="row text-center">
        <div class="col-md-3"></div>
        <h1 class="col-md-6 text-primary">Sign up</h1>
    </div>

<div id="signupContainer" class="form-group">
    <form action="signup" method="post" accept-charset="utf-8" name="signup" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3" for="username">User Name<span class="required-field">*</span></label>
                <div class="col-sm-4">
                    <input type="text" name="userName" value="<?php print $userName;?>" id="username" class="form-control" tabindex="6"  />
                </div>
         
        <span >
         <?php
        if (isset($_POST['signupButton'])) {
            if ($userName == NULL)
            {
                $message = "User Name is required";
            echo '<div class="has-error ">';
            
            echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
              }
        ?> 
        </span>
     </div>
        <div class="form-group  ">
            <div class="col-sm-3"></div>
            <div class="col-md-4">
            <?php
        if (isset($_POST['signupButton']) and $userName != NULL) {
            if(! $this->user_model->validateUsername($userName))
            {
                $message = "User Name is already taken.";
            echo '<div class="has-error ">';
            
            echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
              }
        ?>  
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="password">Password<span class="required-field">*</span></label>
               <div class="col-sm-4">
                 <input type="password" name="password" value="<?php print $password;?>" id="password" class="form-control" tabindex="7"  />
               </div>
             
        <span >
         <?php
        if (isset($_POST['signupButton'])) {
            if ( $password == NULL)
            {
                $message = "Password is required";
            echo '<div class="has-error ">';
            echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
        }
        ?> 
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="repassword">Confirm Password<span class="required-field">*</span></label>
               <div class="col-sm-4">
                 <input type="password" name="repassword" value="<?php print $repassword;?>" id="repassword" class="form-control" tabindex="8"  />
               </div>
             
        <span c>
         <?php
        if (isset($_POST['signupButton'])) {
            if ($repassword == NULL)
            {
                $message = "Confirm Password is required";
            echo '<div class="has-error ">';
           echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
            else if ($password != $repassword)
            {
                $message = "Passwords Must Match";
            echo '<div class="has-error ">';
            echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
        }
        ?> 
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="firstName">First Name<span class="required-field">*</span></label>
              <div class="col-sm-4">
               <input type="text" name="firstName" value="<?php print $firstName;?>" id="firstName" class="form-control" tabindex="9"  />
              </div>
             
        <span >
         <?php
        if (isset($_POST['signupButton'])) {
            if ( $firstName == NULL)
            {
                $message = "First Name is required";
            echo '<div class="has-error  ">';
            echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
        }
        ?> 
        </div>
       
        <div class="form-group">
            <label class="control-label col-sm-3"  for="lastName">Last Name<span class="required-field">*</span></label>
              <div class="col-sm-4">
               <input type="text" name="lastName" value="<?php print $lastName;?>" id="lastName" class="form-control" tabindex="10"  />
              </div>
             
        <span >
         <?php
        if (isset($_POST['signupButton'])) {
            if ($lastName == NULL)
            {
                $message = "Last Name is required";
            echo '<div class="has-error ">';
            echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
        }
        ?> 
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="email">Email Address<span class="required-field">*</span></label>
              <div class="col-sm-4">
               <input type="email" name="email" value="<?php print $email;?>" id="email" class="form-control" tabindex="11"  />
              </div>
             
        <span >
         <?php
        if (isset($_POST['signupButton'])) {
            if ($_POST['email'] == NULL)
            {
                $message = "User Name is required";
            echo '<div class="has-error ">';
            echo '<span class="control-label">'.$message . '</span>';
            echo '</div>';
            }
        }
        ?> 
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="homePhone">Home Phone</label>
              <div class="col-sm-4">
               <input type="text" name="homePhone" value="<?php print $homePhone;?>" id="homePhone" class="form-control" tabindex="11"  />
              </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="mobilePhone">Mobile Phone</label>
              <div class="col-sm-4">
               <input type="text" name="mobilePhone" value="<?php print $mobilePhone;?>" id="mobilePhone" class="form-control" tabindex="11"  />
              </div>
        </div>
       
       
    <?php
    /**  
     * <?
     *   if (isset($message) and $message) {
     
           echo '<div class="message">';
            echo $message;
            echo '</div>';
        }*/
        ?>
        
        <div class="text-center text-center">
            <button type="submit" name="signupButton" value="submit"  
                    class = "btn btn-lg btn-primary" />Sign up </button>
        </div>
    </form>
</div>

<!--<script type="text/javascript" src="/js/signup.js"></script>-->

