var userAgent = 'Chrome/37.0.2049.0';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js',
    'bootstrap.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent,
        waitTimeout:20000,
        timeout: 20000
    },
    logLevel: "debug",              // Only "info" level messages will be logged
    verbose: true  
});
var XPath = require('casper').selectXPath;
var page = "acerthailand";
var user="thothreport@gmail.com";
var pass="thothreport!";
var date1 = "1406826000000";
var date2 = "1414083600000";

LoginFacebook(user,pass);
captureLikeChart();
captureInsightsOverview();
captureInsightLikes();

function LoginFacebook(username,password){
	casper.start("https://facebook.com/"+page);

	casper.then(function(){
		casper.sendKeys("#email",username);
		casper.sendKeys("#pass",password);
	});
	casper.thenClick(XPath('//*[@id="u_0_0"]'));
	casper.waitForSelector("#fbProfileCover",function(){
		casper.captureSelector(page+"/Cover_"+page+".jpg","#fbProfileCover");
	});
}

function captureLikeChart(){
	casper.thenOpen("https://facebook.com/"+page+"/likes");

	casper.waitForSelector(XPath('//*[@id="pagelet_timeline_main_column"]/div/div/div/div[2]/div[2]/div'),function(){
		this.captureSelector(page+"/LikeChart_"+page+".jpg",XPath('//*[@id="pagelet_timeline_main_column"]/div/div/div/div[2]/div[2]/div'));
	});
}

function captureInsightsOverview(){
	casper.thenOpen("https://facebook.com/"+page+"/insights");
	
	casper.waitForSelector('#u_0_x > div > div._5don > div > div:nth-child(2) > div',function(){
		this.captureSelector(page+'/Overview_PageLikes.jpg',"#u_0_x > div > div._5don > div > div:nth-child(2) > div > a:nth-child(1)");
		this.captureSelector(page+'/Overview_PostReach.jpg',"#u_0_x > div > div._5don > div > div:nth-child(2) > div > a:nth-child(2)");
		this.captureSelector(page+'/Overview_Engagement.jpg',"#u_0_x > div > div._5don > div > div:nth-child(2) > div > a:nth-child(3)");
	});
}

function captureInsightLikes(){
	casper.thenOpen("https://facebook.com/"+page+"/insights?section=navLikes");

	// Daily data is recorded in the Pacific time zone.
	casper.waitForSelector('div._5nw8',function(){
		this.thenClick('input[name="sinceCalendar"]',function(){
			// this.sendKeys('input[name="sinceCalendar"]',"08/1/2014");
			// this.sendKeys('input[name="untilCalendar"]',"10/1/2014");
			this.captureSelector(page+'/Likes_Daily.jpg',"div._5nw8");
		});
	});

	// Total Page Likes as of Today
	casper.then(function(){
		var Total_Likes = "div._5dop._4-u2:nth-child(2)";
		this.captureSelector(page+'/Likes_TotalPageLikes.jpg',Total_Likes);
		
		this.thenClick("span._53py",function(){
			this.wait(2000);
			this.captureSelector(page+'/Likes_TotalPageLikes-Average.jpg',Total_Likes);
		});
	});

	// Net Likes
	casper.then(function(){
		var Net_Likes = "div._5dop._4-u2:nth-child(3)";

		this.captureSelector(page+'/Likes_NetLikes.jpg',Net_Likes);
		
		this.clickLabel("Unlikes","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_NetLikes_Unlikes.jpg',Net_Likes);

		this.clickLabel("Organic Likes","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_NetLikes_OrganicLikes.jpg',Net_Likes);

		this.clickLabel("Paid Likes","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_NetLikes_PaidLikes.jpg',Net_Likes);
	});

	// Where Your Page Likes Happened
	casper.then(function(){
		var Likes_Happened = "div._5dop._4-u2:nth-child(4)";
		this.captureSelector(page+'/Likes_LikesHappened.jpg',Likes_Happened);
	
		this.clickLabel("Ads","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_LikesHappened_Ads.jpg',Likes_Happened);

		this.clickLabel("Page Suggestions","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_LikesHappened_PageSuggestions.jpg',Likes_Happened);

		this.clickLabel("On Your Page","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes__LikesHappened_OnYourPage.jpg',Likes_Happened);

		this.clickLabel("Uncategorized Mobile","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_LikesHappened_UncategorizedMobile.jpg',Likes_Happened);

		this.clickLabel("Others","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_LikesHappened_Others.jpg',"div._5dop._4-u2:nth-child(4)");

	});
}


casper.run();