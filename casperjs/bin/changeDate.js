/*
    userAgent: userAgent,
    viewportSize: {width: 1349, height: 768}
*/

var userAgent = 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36';
var x = require('casper').selectXPath;
var casper = require('casper').create({   
    verbose: true, 
    logLevel: 'debug',
    userAgent: userAgent,
    waitTimeout:20000
});

casper.echo("FBUser: "+casper.cli.get("u"));
casper.echo("FBPass: "+casper.cli.get("p"));

var delay = 1000;
var fbuser = casper.cli.get("u");
var fbpass = casper.cli.get("p");
var url = 'https://www.facebook.com';
var pageName = url+'/AcerThailand';


casper.start();

casper.thenOpen(url, function(){
	this.echo('\nNow at: '+this.getTitle()+'\n');
	this.fill('form#login_form', {
        email: fbuser,
        pass: fbpass
    }, true);
});

// click calendar and fill-in value
// format = d/m/yyyy
var calendarValueFrom = '1/1/2014';
var calendarValueTo = '7/16/2014';
var calendarInputSelecter = 'input._5qcz';

casper.thenOpen(pageName+'/insights?section=navLikes', function(){
	// wait for calendar label first
	this.waitForText('Daily data is recorded in the Pacific time zone.', function(){
		calendarBoxSelector = 'input._5qcz';
		if(this.exists(calendarBoxSelector))
		{
			// pass arguments to evaluate function
			// selector = calendarInputSelecter
			// fromValue = calendarValueFrom
			// toValue = calendarValueTo
			this.evaluate(function(selector, fromValue, toValue) {
				// get all input with class e.g class = "_5qcz"
				var calendarInputs = __utils__.findAll(selector);
				var from = calendarInputs[0];
				var to = calendarInputs[1];
				from.value = fromValue;
				to.value = toValue;
		    }, calendarInputSelecter, calendarValueFrom, calendarValueTo);
		    this.click('#u_0_y > div > div._5don > div > div._5nw8 > div._5nw9 > a:nth-child(3)');

		    //capture to see the result
		    this.capture('calendarChanged.png');
		}
	});
});

casper.run();