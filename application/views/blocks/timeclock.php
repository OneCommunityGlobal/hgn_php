<div class = "form-group form-inline">
    <label class = "control-label col-sm-3" for = "startDate">Start Date/Time</label>
    <div class = "col-sm-7">
        <input class = "form-control" type = "text" size = "4" name = "startDate" value = "--/--/----"/>
        <input class = "form-control" type = "text" size = "2" name = "startTime" value = "--:--"/>
    </div>
</div>

<div class = "form-group form-inline">
    <label class = "control-label col-sm-3" for = "endDate">End Date/Time</label>
    <div class = "col-sm-7">
        <input class = "form-control" type = "text" size = "4" name = "endDate" value = "--/--/----"/>
        <input class = "form-control" type = "text" size = "2" name = "endTime" value = "--:--"/>
    </div>
</div>

<div id = "timeClock" class = "timeClock row col-md-12">
    <span>
        <span id = "hours">00</span>
        :
        <span id = "minutes">00</span>
        :
        <span id = "seconds">00</span>
    </span>
</div>
<div id = "timerButtons" class = "row col-md-12">
    <button id = "timerStart" class = "" type = "button" title = "Start" onclick = "hgnTask.startTimer()">
        <img src = "/images/icons/timer_start.jpg" alt = "Start Timer"/></button>
    <button id = "timerStop" class = "" type = "button" title = "Stop" onclick = "hgnTask.stopTimer()">
        <img src = "/images/icons/timer_stop.jpg" alt = "Stop Timer"/></button>
</div>

<div>
    <button type = "button" class = "btn btn-primary btn-block" onClick = "hgnTask.toggleTimer">Hide Stopwatch</button>
</div>

<script type="text/javascript" src="/js/task.js"></script>
<script type="text/javascript">
    hgnTask = new Task();
</script>
