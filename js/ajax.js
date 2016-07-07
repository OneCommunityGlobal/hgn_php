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
 * HGN AJAX library
 *
 * This class performs the basic AJAX functions of sending or receiving data asynchronously
 *
 * @package     HGN
 * @subpackage	
 * @category	javascript libraries
 * @author	HGN Dev Team
 */
'use strict';
var Ajax = function() {
    var data = null;
};

Ajax.prototype = {
    callBack : function(httpResponse) {
        this.messageArea = document.getElementById('messageArea');
        var data = {};
        try {
            data = JSON.parse(httpResponse);
            var response = data['response'];
        } catch (err) {
            this.messageArea.innerHTML = 'Failed';
            return;
        }
        if(response['success']) {
            var cbObject = window[response['cbObject']];
            var cbMethod = response['cbMethod'];
            this.messageArea.innerHTML = 'Success';
            cbObject[cbMethod]();
        }else {
            this.messageArea.innerHTML = 'Failed';
        }
        return;
    },
    getDataById : function(cbObject, cbMethod, table, id) {
        if(!id || id === null) return false;
        var uri = '/ajax/readById/' + cbObject + '/' + cbMethod + '/' + table + '/' + id + '/parm1/parm2/parm3';
        var data = this.getJsonData(this, this.callBack, uri);
        return;
    },
    getData : function(model, method, table, lookupColumn, lookupValue) {
//TODO  Make this logic better (string vs numeric)
        if(!lookupValue || lookupValue == 'null') return;
        var cbMethod = this.callBack;
        var data = hgnAjax.getJsonData(this, cbMethod, '/ajax/index/' + model + '/' + method + '/' + table + '/' + lookupColumn + '/' + lookupValue);
        return;
    },
    sendData : function(module, method, data) {
        var myAjax = new Ajax();
        var cbObject = hgnView;
        var cbMethod = hgnView.callBack;
        var phpUri = '/ajax/index/' + module + '/' + method;
        data = JSON.stringify(data);
        hgnAjax.sendJsonData(cbObject, cbMethod, phpUri, data);
        return;
    },
    /**
     * Get data using AJAX
     * 
     * Sends an http request for data to a server. The request is processed asynch, in other
     * words processing continues before data is returned. Once the status indicates the data has been
     * returned successfully, the callback method in the callback object is triggered
     * 
     * @param object callBackObject
     * @param method callBackMethod
     * @param string model which is a php mvc model in the form "/ajax/index/model/method/table/lookupColumn/lookupValue"
     * @returns mixed JSON encoded data
     */
    getJsonData : function(callBackObject, callBackMethod, uri) {
        var httpRequest;
        httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function() {
            if(httpRequest.readyState === 4 && httpRequest.status === 200)
            {
                callBackMethod.call(callBackObject, httpRequest.responseText);
            }
        };
        ;
        httpRequest.open("POST", uri, true);
        httpRequest.send();
    },
    /**
     * Send data using AJAX
     
     * Sends an http request with data to a server. The request is processed asynch, in other
     * words processing continues before data is processed on the back end. Once the status indicates the data has been
     * processed successfully, the callback method in the callback object is triggered
     * 
     * @param object callBackObject
     * @param method callBackMethod
     * @param string phpUri in the form '/ajax/index/model/method/table'
     * @param JSON   data
     * @returns boolean Success or failure code
     */
    sendJsonData : function(callBackObject, callBackMethod, phpUri, data) {
        var params = "data=" + encodeURIComponent(data);
        var httpRequest2 = new XMLHttpRequest();
        httpRequest2.open("POST", phpUri, true);
        httpRequest2.onreadystatechange = function() {
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