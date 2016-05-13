<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="col-md-12">
    <div class="row col-md-12 text-center"><h1>Project</h1></div>

    <div class="row">
        <div id="dataDiv" class="col-md-12">
            <div class="col-md-12">
                <div class="col-md-4">Project</div>
                <div class="col-md-6"><?php echo $projectData['title']; ?></div>
            </div>
            <div class="container">
                    <?php foreach ($tasksData as $k => $v) { ?>
                        <div class="col-md-12">
                            <div class="col-xs-1"><button>+</button><button>-</button></div>
                            <div class="col-md-1"><?php echo $v['title']; ?></div>
                            <div class="col-md-1"><?php echo $v['description']; ?></div>
                            <div class="col-md-1"><?php echo $v['startDateEstimate']; ?></div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
</main>