var userAgent = 'Chrome/37.0.2049.0';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js',
    'bootstrap.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent,
    },
    logLevel: "debug",              // Only "info" level messages will be logged
    verbose: true ,
    waitTimeout:20000
});
var XPath = require('casper').selectXPath;
var page = "acerthailand";
var user = "thothreport@gmail.com";
var pass = "thothreport!";

LoginFacebook(user,pass);
captureLikeChart();
captureInsightsOverview();
captureInsightLikes();
captureInsightReach();
captureInsightVisits();
captureInsightPosts();
captureInsightPeople();

function LoginFacebook(username,password){
	casper.start("https://facebook.com/"+page+"/");

	casper.then(function(){
		casper.sendKeys("#email",username);
		casper.sendKeys("#pass",password);
	});
	casper.thenClick(XPath('//*[@id="u_0_0"]'));
	casper.waitForSelector("#fbProfileCover",function(){
		casper.captureSelector(page+"/Cover_.jpg","#fbProfileCover");
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
			this.captureSelector(page+'/Likes_Daily.jpg',"div._5nw8");
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

function captureInsightReach(){
	casper.thenOpen("https://facebook.com/"+page+"/insights?section=navReach");

	// Daily data is recorded in the Pacific time zone.
	casper.waitForSelector("div._5nw8",function(){
		this.captureSelector(page+'/Reach_Daily.jpg',"div._5nw8");
	});

	// Post Reach
	casper.then(function(){
		var PostReach = "div._5dop._4-u2:nth-child(2)";
		this.captureSelector(page+"/Reach_PostReach.jpg",PostReach);

		this.clickLabel("Organic","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_PostReach_Organic.jpg',PostReach);

		this.clickLabel("Paid","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_PostReach_Paid.jpg',PostReach);
	});

	// Likes, Comments, and Shares
	casper.then(function(){
		var LikesCommentsShares = "div._5dop._4-u2:nth-child(3)";
		var Likes="#u_0_x > div > div._5don > div > div:nth-child(3) > div._532o > div._532u > div > div._5npp > a:nth-child(1) > span";
		var Comments = "#u_0_x > div > div._5don > div > div:nth-child(3) > div._532o > div._532u > div > div._5npp > a:nth-child(2) > span";
		var Shares = "#u_0_x > div > div._5don > div > div:nth-child(3) > div._532o > div._532u > div > div._5npp > a:nth-child(3) > span";
		this.captureSelector(page+"/Reach_LikesCommentsShares.jpg",LikesCommentsShares);

		this.thenClick(Likes,function(){
			this.wait(2000);
			this.captureSelector(page+'/Reach_LikesCommentsShares_Likes.jpg',LikesCommentsShares);
		});

		this.thenClick(Comments,function(){
			this.wait(2000);
			this.captureSelector(page+'/Reach_LikesCommentsShares_Comments.jpg',LikesCommentsShares);
		});

		this.clickLabel("Shares","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_LikesCommentsShares_Shares.jpg',LikesCommentsShares);
	});

	// Hide, Report as Spam, and Unlikes
	casper.then(function(){
		var HideSpamUnlikes = "div._5dop._4-u2:nth-child(4)";
		this.captureSelector(page+"/Reach_HideSpamUnlikes.jpg",HideSpamUnlikes);

		this.clickLabel("Hide Post","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_HideSpamUnlikes_HidePost.jpg',HideSpamUnlikes);

		this.clickLabel("Hide All Posts","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_HideSpamUnlikes_HideAllPosts.jpg',HideSpamUnlikes);

		this.clickLabel("Report as Spam","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_HideSpamUnlikes_ReportasSpam.jpg',HideSpamUnlikes);

		this.clickLabel("Unlike Page","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_HideSpamUnlikes_UnlikePage.jpg',HideSpamUnlikes);
	});

	// Total Reach
	casper.then(function(){
		var TotalReach = "div._5dop._4-u2:nth-child(5)";
		var Organic = "#u_0_x > div > div._5don > div > div:nth-child(5) > div._532o > div._532u > div > div._5npp > a:nth-child(1) > span";
		var Paid = "#u_0_x > div > div._5don > div > div:nth-child(5) > div._532o > div._532u > div > div._5npp > a:nth-child(2) > span"
		this.captureSelector(page+"/Reach_TotalReach.jpg",TotalReach);

		this.thenClick(Organic,function(){
			this.wait(2000);
			this.captureSelector(page+'/Reach_TotalReach_Organic.jpg',TotalReach);
		});

		this.thenClick(Paid,function(){
			this.wait(2000);
			this.captureSelector(page+'/Reach_TotalReach_Paid.jpg',TotalReach);
		});
	});
}

function captureInsightVisits(){
	casper.thenOpen("https://facebook.com/"+page+"/insights?section=navVisits");

	// Daily data is recorded in the Pacific time zone.
	casper.waitForSelector("div._5nw8",function(){
		this.captureSelector(page+'/Visits_Daily.jpg',"div._5nw8");
	});

	// Page and Tab Visits
	casper.then(function(){
		var div = "div._5dop._4-u2:nth-child(2)"; 
		var totalmenu = casper.evaluate(function(){
				var Menu = "#u_0_x > div > div._5don > div > div:nth-child(2) > div._532o > div._532u > div > div._5npp > a"; // find count element a
				return document.querySelectorAll(Menu).length;
			});

		this.captureSelector(page+"/Visits_PageTabVisits.jpg",div);

		ClickAndCapture(div,"PageTabVisits",2,totalmenu);

	});

	// External Referrers
	casper.then(function(){
		var div = "div._5dop._4-u2:nth-child(3)";

		var kid = casper.evaluate(function(){
			return document.querySelectorAll("div._5npp > a._53px");
		});
		var totalmenu = kid.length/2;

		this.captureSelector(page+"/Visits_ExternalReferrers.jpg",div);

		ClickAndCapture(div,"ExternalReferrers",3,totalmenu);
	});
}

function captureInsightPosts(){
	casper.thenOpen("https://facebook.com/"+page+"/insights?section=navPosts");

	// When Your Fans Are Online
	var WhenYourFansAreOnline = "#u_0_x > div > div._5don > div > div._5nzo > div:nth-child(2)";
	casper.waitForSelector(WhenYourFansAreOnline,function(){
		this.captureSelector(page+'/Posts_Daily.jpg',WhenYourFansAreOnline);
	});

	// Post Types
	casper.then(function(){
		var PostTypes = "#u_0_x > div > div._5don > div > div._5nzo > div._5nwo._5cmi > a._5nwp._5cmf._5nwq._5cmg > span";
		var waitGraph = "#u_0_x > div > div._5don > div > div._5nzo > div:nth-child(2) > div > div:nth-child(2) > table > tbody > tr:nth-child(1) > td:nth-child(2) > div > div > div._5kn4 > div._5abm > div._352g";

		this.clickLabel("Post Types","span");
		this.waitForSelector(waitGraph,function(){
			this.captureSelector(page+'/Posts_PostTypes_AllPosts.jpg',"#u_0_x > div > div._5don > div > div._5nzo > div:nth-child(2)");
		});
	});
}

function captureInsightPeople(){
	casper.thenOpen("https://facebook.com/"+page+"/insights?section=navPeople");

	var waitGraph = "#u_0_x > div > div._5don > div > div:nth-child(2) > div > div > div:nth-child(2)";
	casper.waitForSelector(waitGraph,function(){
		this.capture(page+'/People_YourFans.jpg',{top:420,left:0,height:450,width:926});
	});

	casper.then(function(){
		var waitGraph = "#u_0_x > div > div._5don > div > div:nth-child(2) > div > div > div:nth-child(2) > div._55q5.clearfix > div > div:nth-child(1) > canvas";
		
		this.clickLabel("People Reached","span");
		this.waitForSelector(waitGraph,function(){
			this.capture(page+'/People_PeopleReached.jpg',{top:420,left:0,height:450,width:926});

			this.clickLabel("People Engaged","span");
				this.waitForSelector(waitGraph,function(){
					this.capture(page+'/People_PeopleEngaged.jpg',{top:420,left:0,height:450,width:926});
			});
		});
	});
}

function ClickAndCapture(element,title,numElement,totalmenu){
	console.log("################# "+totalmenu+" ###################")
	for (var Menu = 1; Menu <= totalmenu; Menu++) {
		var Clickbtn = "#u_0_x > div > div._5don > div > div:nth-child("+numElement+") > div._532o > div._532u > div > div._5npp > a:nth-child("+Menu+") > span"
		var namefile = casper.getHTML(Clickbtn);
		casper.click(Clickbtn);
		casper.wait(2000);
		casper.captureSelector(page+'/'+title+"_"+namefile+'.jpg',element);
	};
}


casper.run();