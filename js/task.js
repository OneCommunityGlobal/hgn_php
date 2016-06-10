var Task = function() {
    this.hoursDisplay = document.getElementById("hours");
    this.minutesDisplay = document.getElementById("minutes");
    this.secondsDisplay = document.getElementById("seconds");
    this.recording = false;
};

Task.prototype = {
    startTimer : function() {
        this.setTimespace(undefined, new Date());
        this.startRecord();
        this.recording = true;
    },
    stopTimer : function() {
        this.stopRecord();
    },
    setTimespace : function(fromDate, toDate) {

        timespace = '';

        if(fromDate != undefined) {
            this.setValueDateTimeStart(fromDate);
            timespace += strftime('%m-%d-%Y', fromDate);
        }else {
            timespace += "0-0-0";
        }

        timespace += "|";

        if(toDate != undefined) {
            this.setValueDateTimeEnd(toDate);
//            timespace += strftime('%m-%d-%Y', toDate);
        }else {
            timespace += "0-0-0";
        }

//        $.post("processor.php", {axAction : "setTimespace", axValue : timespace, id : 0},
//                function (response) {
//                    hook_tss();
//                }
//        );
    },
    startRecord : function() {
        hour = 0;
        min = 0;
        sec = 0;
        now = Math.floor(((new Date()).getTime()) / 1000);
        offset = now;
        startsec = 0;
        this.updateClock();
//        value = pct_ID + "|" + evt_ID;
//        $.post("processor.php", {axAction : "startRecord", axValue : value, id : user_ID},
//                function (response) {
//                    ts_ext_reload();
//                    $("#secondstopwatch_edit_comment").show();
//                }
//        );
    },
    stopRecord : function() {
//        $("#zeftable>table>tbody>tr>td>a.stop>img").attr("src", "../skins/" + skin + "/grfx/loading13_red.gif");
//        $("#zeftable>table>tbody>tr:first-child>td").css("background-color", "#F00");
//        $("#zeftable>table>tbody>tr:first-child>td").css("color", "#FFF");
//        this.show_selectors();
//        $.post("processor.php", {axAction : "stopRecord", axValue : 0, id : 0},
//                function () {
//                    if(recording == 0) {
//                        ts_ext_reload();
//                        document.title = default_title;
//                    }
//                }
//        );
        this.stopDisplay()
    },
    updateClock : function() {
        sek = Math.floor((new Date()).getTime() / 1000) - startsec - offset;
        hour = Math.floor(sek / 3600);
        min = Math.floor((sek - hour * 3600) / 60);
        sec = Math.floor(sek - hour * 3600 - min * 60);

        if(sec == 60) {
            sec = 0;
            min++;
        }
        if(min > 59) {
            min = 0;
            hour++;
        }
        if(sec == 0) this.secondsDisplay.innerHTML = "00";
        else {
            $("#seconds").html(((sec < 10) ? "0" : "") + sec);
        }
        if(min == 0) this.minutesDisplay.innerHTML = "00";
        else {
            $("#minutes").html(((min < 10) ? "0" : "") + min);
        }
        if(hour == 0) this.hoursDisplay.innerHTML = "00";
        else {
            $("#hours").html(((hour < 10) ? "0" : "") + hour);
        }

        htmp = $("#hours").html();
        mtmp = $("#minutes").html();
        stmp = $("#seconds").html();
        titleclock = htmp + ":" + mtmp + ":" + stmp;
        document.title = titleclock;
        that = this;
        timeoutTicktack = setTimeout("that.updateClock()", 1000);
    },
    setValueDateTimeStart : function(fromDate) {
//        $('#ts_in').html(strftime(timespaceDateFormat, fromDate));
//        $('#pick_in').val(strftime('%m/%d/%Y', fromDate));
//        $('#pick_out').datepicker("option", "minDate", fromDate);
    },
    setValueDateTimeEnd : function(toDate) {
//        $('#ts_out').html(strftime(timespaceDateFormat, toDate));
//        $('#pick_out').val(strftime('%m/%d/%Y', toDate));
//        $('#pick_in').datepicker("option", "maxDate", toDate);
    },
    stopDisplay : function() {
        if(timeoutTicktack) {
            clearTimeout(timeoutTicktack);
            timeoutTicktack = 0;
            hours.innerHTML = "00";
            minutes.innerHTML = "00";
            seconds.innerHTML = "00";
        }
    }

};
