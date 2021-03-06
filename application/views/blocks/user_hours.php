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
<p><h4>Hours</h4></p>

<!--Include the Flot graphing library-->
<script type="text/javascript" src="/js/flot/jquery.flot.js"></script>

<script type="text/javascript">
    $(function () {
//        /** This code runs when everything has been loaded on the page */
//        /* Inline sparklines take their values from the contents of the tag */
//        $('.inlinesparkline').sparkline();
//
//        /* Sparklines can also take their values from the first argument 
//         passed to the sparkline() function */
//        var myvalues = [10, 8, 5, 7, 4, 4, 1];
//        $('.dynamicsparkline').sparkline(myvalues);
//
//        /* The second argument gives options such as chart type */
//        $('.dynamicbar').sparkline(myvalues, {type : 'bar', barColor : 'green'});
//
//        /* Use 'html' instead of an array of values to pass options 
//         to a sparkline with data in the tag */
//        $('.inlinebar').sparkline('html', {type : 'bar', barColor : 'red'});

        //values: target, performance, range values
        $('.bullet').sparkline([10,5,12,9,7],
        {type : 'bullet', width:'200px', height:'20px', targetColor : 'f03030',
            targetWidth:2, performanceColor:'black', rangeColors:['#d3dafe','#a8b6ff','#7f94ff']}
        );
    });
</script>

<!--<p>
    Inline Sparkline: <span class="inlinesparkline">1,4,4,7,5,9,10</span>.
</p>
<p>
    Sparkline with dynamic data: <span class="dynamicsparkline">Loading..</span>
</p>
<p>
    Bar chart with dynamic data: <span class="dynamicbar">Loading..</span>
</p>
<p>
    Bar chart with inline data: <span class="inlinebar">1,3,4,5,3,5</span>
</p>-->
<p>
    Performance: <span class="bullet">Loading...</span>
</p>