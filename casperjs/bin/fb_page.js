var userAgent = 'Chrome/37.0.2049.0';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent
    },
    logLevel: "info",
    verbose: true  
});

var XPath = require('casper').selectXPath;

 // print out all the messages in the headless browser context
casper.on('remote.message', function(msg) {
   this.echo('remote message caught: ' + msg);
});

// print out all the messages in the headless browser context
casper.on("page.error", function(msg, trace) {
   this.echo("Page Error: " + msg, "ERROR");
});

casper.start('https://www.facebook.com/AcerThailand/likes',function(){
	casper.waitForSelector('#u_0_6 > div > div._4m5x > div:nth-child(2) > div > canvas',function(){
			this.captureSelector('ssss.png','#PagesLikesTabController_147818843085 > div > div > div._2q5c > div._1lot > div._1lox');
		});
	});

casper.run();