// Script from http://ftp.apixml.net/
// Copyright 2017 http://ftp.apixml.net/, DO NOT REMOVE THIS COPYRIGHT NOTICE
var Ftp = {
    createCORSRequest: function (method, url) {
        var xhr = new XMLHttpRequest();
        if ("withCredentials" in xhr) {
            // Check if the XMLHttpRequest object has a "withCredentials" property.
            // "withCredentials" only exists on XMLHTTPRequest2 objects.
            xhr.open(method, url, true);
        } else if (typeof XDomainRequest != "undefined") {
            // Otherwise, check if XDomainRequest.
            // XDomainRequest only exists in IE, and is IE's way of making CORS requests.
            xhr = new XDomainRequest();
            xhr.open(method, url);
        } else {
            // Otherwise, CORS is not supported by the browser.
            xhr = null;
        }
        return xhr;
    },
    upload: function(token, files) {
        var file = files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.addEventListener("load",
            function() {
                var base64 = this.result;               
                var xhr = Ftp.createCORSRequest('POST', "http://ftp.apixml.net/upload.aspx");
                if (!xhr) {
                    throw new Error('CORS not supported');
                }
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						Ftp.callback(file);
					}
				};
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("token=" + token + "&data=" + encodeURIComponent(base64) + "&file=" + file.name);
            },
            false);
    },
	callback: function(){}
};
