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

casper.echo("FBUser: "+casper.cli.get("u"));
casper.echo("FBPass: "+casper.cli.get("p"));
casper.echo("Status: "+casper.cli.get("msg"));

var fbuser = casper.cli.get("u");
var fbpass = casper.cli.get("p");
var msg = casper.cli.get("msg");
var url = 'https://www.facebook.com';
var userNickName = 'fakelow';
var userPage = url+'/'+userNickName;

casper.start();

casper.thenOpen(url, function(){
	this.echo('\nNow at: '+this.getTitle()+'\n');
	this.fill('form#login_form', {
        email: fbuser,
        pass: fbpass
    }, true);
});

casper.thenOpen(userPage, function(){

	var FBform = '';
	for(var i=0; i<30; i++)
	{
		//var formName = 'form#'+formNames[i];
		findElement = 'textarea.uiTextareaAutogrow.autofocus:nth-child('+i+')'
		if(casper.exists(findElement))
		{
			this.echo('**** Found: '+findElement);
			this.sendKeys(findElement, msg);
			this.capture('wall.png');
			if(casper.exists('button.selected:nth-child('+i+')')) 
			{
				this.echo('**** Found ****');
				require('utils').dump(this.getElementInfo('button.selected:nth-child('+i+')'));
			}
			this.click('button.selected:nth-child('+i+')');
			this.wait(4000);
			this.capture('wallAfter.png');
		}
		else
		{
			//this.echo('Not found: '+findElement);
		}
	}
	// if(FBform!='')
	// {
	// 	this.fill(FBform, {
	// 	        xhpc_message_text: msg
	// 	}, true);
	// }
});

casper.run();
