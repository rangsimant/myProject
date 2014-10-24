/*
    userAgent: userAgent,
    viewportSize: {width: 1349, height: 768}
*/

var userAgent = 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36';
var x = require('casper').selectXPath;
var casper = require('casper').create({   
    verbose: true, 
    logLevel: 'debug',
    userAgent: userAgent
});



// // print out all the messages in the headless browser context
// casper.on('remote.message', function(msg) {
//     this.echo('remote message caught: ' + msg);
// });

// // print out all the messages in the headless browser context
// casper.on("page.error", function(msg, trace) {
//     this.echo("Page Error: " + msg, "ERROR");
// });

casper.echo("FBUser: "+casper.cli.get("u"));
casper.echo("FBPass: "+casper.cli.get("p"));

var delay = 1000;
var fbuser = casper.cli.get("u");
var fbpass = casper.cli.get("p");
var url = 'https://www.facebook.com';
var pageName = url+'/AcerThailand';

//var timeID = new Date().getTime()+'_';
var timeID = '_';

function captureSelectorIfExist(casperPage, selector, imageName)
{
	if(casper.exists(selector))
	{
		casperPage.captureSelector(imageName, selector);
	}
	else
	{
		casperPage.echo('\n' + selector +' is not found\n');
	}
}


casper.start();

casper.thenOpen(url, function(){
	this.echo('\nNow at: '+this.getTitle()+'\n');
	this.fill('form#login_form', {
        email: fbuser,
        pass: fbpass
    }, true);
});

casper.thenOpen(pageName, function(){
	this.waitForText('Acer Thailand', function(){
		var selector = '#PageHeaderPageletController_147818843085';
		var imageName = timeID+'AcerCover.png';
		captureSelectorIfExist(this, selector, imageName);
	});
});

casper.thenOpen(pageName+'/likes', function(){
	this.waitForText('People Talking About This', function(){
		var selector = 'div._1lox';
		var imageName = timeID+'TalksAboutAndTotalPageLikes.png';
		captureSelectorIfExist(this, selector, imageName);
	});
});

casper.thenOpen(pageName+'/insights?section=navLikes', function(){
	this.waitForText('Where Your Page Likes Happened', function(){
		for(var i=2;i<=4;i++)
		{
			selector = 'div._5dop:nth-child('+i+')';
			imageName = timeID+'navLikes_'+i+'.png';
			captureSelectorIfExist(this, selector, imageName)
		}
	});
});

casper.thenOpen(pageName+'/insights?section=navReach', function(){
	this.waitForText('Total Reach', function(){
		for(var i=1;i<=4;i++)
		{
			chartSelector = 'div._5dop:nth-child('+i+')';
			imageName = timeID+'navReach_'+i+'.png';
			captureSelectorIfExist(this, chartSelector, imageName);
			if(i==3) //3 = Section: Likes, Comments and Shares 
			{
				for(var j=4;j<=6;j++)
				{
					//then click each label and capture sub-graph 
					labelSelector = 'a._53px:nth-child('+i+')';
					if(casper.exists(labelSelector))
					{
						this.click(labelSelector);
						imageName = timeID+'navReach_'+i+'_'+j+'.png';
						captureSelectorIfExist(this, selector, imageName);
					}
				}
			}
		}
	});
});

//https://www.facebook.com/AcerThailand/insights?section=navPeople

casper.run();
