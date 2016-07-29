<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Sample Comment
|--------------------------------------------------------------------------
|
| Text
| etc
|
*/

//paths
defined("BASE_URL") or define("BASE_URL", "http://hgn_dev.loc/");
defined("BASE_SURL") or define("BASE_SURL", "https://hgn_dev.loc/");

//not currently used: alternate method to indicate system is down for repair. Use .htaccess instead.
defined("SYSTEM_DOWN") or define("SYSTEM_DOWN", TRUE);

// Development related flags
define("DEBUG", TRUE);
define("ERROR_LOGGING", FALSE);

//Use caching
define("CACHE", FALSE);

//Page titles etc
define("COMPANY_NAME", "One Community");
define("COMPANY_ABBREV", "HGN");
define("PAGE_TITLE", "Highest Good Network");

//Error logging related flags
define("ERROR_EMAIL_FROM", "errors@ochgc.loc");
define("ERROR_EMAIL_TO", "msgjobs@gmail.com");
define("ERROR_REDIRECT_LOCATION_1", BASE_URL . "index.php/error");
define("ERROR_REDIRECT_LOCATION_2", BASE_URL . "error.html");  // must be 100% static
define("ERROR_SEND_EMAIL", "0");  // 0: don't email; 1: always email; 2: email only if db write fails

//Define Bootstrap and jQuery library names
define("BOOTSTRAP", "bootstrap_v3.3.6");
define("JQUERY", "jquery-1.9.1");
define("SPARKLINE", "jquery.sparkline");
define("FLOT", "flot/jquery.flot");

//Display a header and/or footer block on all pages?  Can set individually in controllers as well.
define("DISPLAY_HEADER", FALSE);
define("DISPLAY_FOOTER", TRUE);

//Not used yet because users are entered by an admin, but can allow users to signup if turned on.
define("ALLOW_USER_SIGNUP", FALSE);

//Define location of profile pictures and avatars
define("PROFILE_PICS_DIR", BASE_URL . 'media/photos/users/');
define("AVATAR_DIR", BASE_URL . 'media/avatars/');










