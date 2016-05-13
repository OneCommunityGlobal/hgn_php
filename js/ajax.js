var Ajax = function () {
    var data = null;
};

Ajax.prototype = {
    getJsonData : function (callBackObject, callBackMethod, model) {
        var httpRequest;
        httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function () {
            if(httpRequest.readyState === 4 && httpRequest.status === 200)
            {
                callBackMethod.call(callBackObject, httpRequest.responseText);
            }
        };
        ;

        httpRequest.open("POST", model, true);
        httpRequest.send();
    },
    sendJsonData : function (callBackObject, callBackMethod, phpUri, data) {
        var params = "data=" + encodeURIComponent(data);
        var httpRequest2 = new XMLHttpRequest();
        httpRequest2.open("POST", phpUri, true);
        httpRequest2.onreadystatechange = function () {
            if(httpRequest2.readyState === 4 && httpRequest2.status === 200) {
                callBackMethod.call(callBackObject, httpRequest2.responseText);
            }else {
            }
        };
        httpRequest2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest2.setRequestHeader("Content-length", params.length);
        httpRequest2.setRequestHeader("Connection", "close");
        httpRequest2.send(params);
    }
};