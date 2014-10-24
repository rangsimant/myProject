var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js'],
    pageSettings: {
        loadImages:  false,        // The WebPage instance used by Casper will
        loadPlugins: false         // use these settings
    },
    logLevel: "info",              // Only "info" level messages will be logged
    verbose: true  
});
var XPath = require('casper').selectXPath;

casper.userAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11');

casper.start('http://www.22webdev.com/sundev/wordpress/cmo/');


casper.then(function(){
    casper.capture('CMO.png')
});


casper.run();