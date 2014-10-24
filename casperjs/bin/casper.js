var userAgent = 'Chrome/37.0.2049.0';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent
    },
    logLevel: "info",              // Only "info" level messages will be logged
    verbose: true  
});


 // print out all the messages in the headless browser context
// casper.on('remote.message', function(msg) {
//    this.echo('remote message caught: ' + msg);
// });

// // print out all the messages in the headless browser context
// casper.on("page.error", function(msg, trace) {
//    this.echo("Page Error: " + msg, "ERROR");
// });

var XPath = require('casper').selectXPath;

casper.start('https://facebook.com/');


casper.then(function(){
    this.sendKeys('#email','fakelow@facebook.com');
    this.sendKeys('#pass','onimushasun');
    casper.capture('facebook login.png')
});

casper.thenClick(XPath('//*[@id="u_0_l"]'),function(){
    console.log('Login Sucess!');   
});

casper.wait(5000,function(){
    casper.then(function(){
        this.sendKeys('#q','acer');
        casper.capture("search fanpage.png");
        casper.captureSelector('Selector.png','#u_ac_0 > div');
    });
});

casper.thenClick(XPath('//*[@id="u_0_d"]/span/button'),function(){
    console.log('Click Search!');  
    casper.capture('search.png') 
});


'';

casper.run();