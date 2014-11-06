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
    waitTimeout:20000,
    onWaitTimeout:function(){
    	console.log("wait selector timeout !");
    	var step = casper.getStepNumber();
    	casper.gotoStep(step+1);
    },
    onStepTimeout:function(){
    	this.echo("Step timed out");
    	var step = casper.getStepNumber();
    	casper.gotoStep(step+1);
    },
    onTimeout:function(){
    	this.echo("timed out");
    	var step = casper.getStepNumber();
    	casper.gotoStep(step+1);
    }
});
var XPath = require('casper').selectXPath;
var mouse = require("mouse").create(casper);

casper.echo("DateFrom : "+casper.cli.get("datefrom"));
casper.echo("DateTo : "+casper.cli.get("dateto"));

var page = "acerthailand";
var user = "thothreport@gmail.com";
var pass = "thothreport!";

// fotmat date MM/DD/YYYY
var dateFrom = casper.cli.get("datefrom");
var dateTo = casper.cli.get("dateto");

LoginFacebook(user,pass);
captureLikeChart();
captureInsightsOverview();
CalendarDateLikes(dateFrom,dateTo);
CalendarDateReach(dateFrom,dateTo);
CalendarDateVisits(dateFrom,dateTo);
captureInsightPosts();
captureInsightPeople();
captureTopPosts();


function LoginFacebook(username,password){
	casper.start("https://facebook.com/"+page+"/");

	casper.then(function(){
		casper.sendKeys("#email",username);
		casper.sendKeys("#pass",password);
	});
	casper.thenClick(XPath('//*[@id="u_0_0"]'));
	casper.waitForSelector("#fbProfileCover",function(){
		casper.captureSelector(page+"/FB_stat/FB_stat_coverPage.png","#fbProfileCover");
	});
}

function captureLikeChart(){
	casper.thenOpen("https://facebook.com/"+page+"/likes");

	casper.waitForSelector(XPath('//*[@id="pagelet_timeline_main_column"]/div/div/div/div[2]/div[2]/div'),function(){
		this.captureSelector(page+"/FB_stat/FB_stat_talkAbout.png",XPath('//*[@id="pagelet_timeline_main_column"]/div/div/div/div[2]/div[2]/div'));
	});
}

function captureInsightsOverview(){
	casper.thenOpen("https://facebook.com/"+page+"/insights");
	
	casper.waitForSelector('#u_0_y > div > div._5don > div > div:nth-child(2) > div',function(){
		this.captureSelector(page+'/Overview_PageLikes.png',"#u_0_y > div > div._5don > div > div:nth-child(2) > div > a:nth-child(1)");
		this.captureSelector(page+'/Overview_PostReach.png',"#u_0_y > div > div._5don > div > div:nth-child(2) > div > a:nth-child(2)");
		this.captureSelector(page+'/Overview_Engagement.png',"#u_0_y > div > div._5don > div > div:nth-child(2) > div > a:nth-child(3)");
	});
}

function captureInsightLikes(){
	// Daily data is recorded in the Pacific time zone.
	casper.waitForSelector('div._5nw8',function(){
			this.capture(page+'/Likes_Daily.png',{top:420,left:0,height:110,width:926});
	});

	// Total Page Likes as of Today
	casper.then(function(){
		var Total_Likes = "div._5dop._4-u2:nth-child(2)";
		this.captureSelector(page+'/Likes_TotalPageLikes.png',Total_Likes);
		
		this.thenClick("span._53py",function(){
			this.wait(2000);
			this.captureSelector(page+'/Likes_TotalPageLikes-Average.png',Total_Likes);
		});
	});

	// Net Likes
	casper.then(function(){
		var Net_Likes = "div._5dop._4-u2:nth-child(3)";

		this.captureSelector(page+'/Likes_NetLikes.png',Net_Likes);
		
		this.clickLabel("Unlikes","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_NetLikes_Unlikes.png',Net_Likes);

		this.clickLabel("Organic Likes","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_NetLikes_OrganicLikes.png',Net_Likes);

		this.clickLabel("Paid Likes","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_NetLikes_PaidLikes.png',Net_Likes);
	});

	// Where Your Page Likes Happened
	casper.then(function(){
		var Likes_Happened = "div._5dop._4-u2:nth-child(4)";
		this.captureSelector(page+'/FB_stat_ads/FB_stat_ads_whereYourPageLike.png',Likes_Happened);
	
		this.clickLabel("Ads","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_LikesHappened_Ads.png',Likes_Happened);

		this.clickLabel("Page Suggestions","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_LikesHappened_PageSuggestions.png',Likes_Happened);

		this.clickLabel("On Your Page","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes__LikesHappened_OnYourPage.png',Likes_Happened);

		if (this.exists("span[text=Uncategorized Mobile]")) {
			this.clickLabel("Uncategorized Mobile","span");
			this.wait(2000);
			this.captureSelector(page+'/Likes_LikesHappened_UncategorizedMobile.png',Likes_Happened);
		}else if (this.exists("span[text=API]")) {
			this.clickLabel("API","span");
			this.wait(2000);
			this.captureSelector(page+'/Likes_LikesHappened_API.png',Likes_Happened);
		}else  if (this.exists("span[text=Uncategorized Desktop]")){
			this.clickLabel("Uncategorized Desktop","span");
			this.wait(2000);
			this.captureSelector(page+'/Likes_LikesHappened_Uncategorized Desktop.png',Likes_Happened);
		}else{
			this.clickLabel("On Your Page","span");
			this.wait(2000);
			this.captureSelector(page+'/Likes_LikesHappened_On Your Page.png',Likes_Happened);
		};

		this.clickLabel("Others","span");
		this.wait(2000);
		this.captureSelector(page+'/Likes_LikesHappened_Others.png',"div._5dop._4-u2:nth-child(4)");

	});
}

function captureInsightReach(){
	// Daily data is recorded in the Pacific time zone.
	casper.then(function(){
		this.waitForSelector("div._5nw8",function(){
			this.captureSelector(page+'/Reach_Daily.png',"div._5nw8");
			this.captureSelector(page+'/Reach_Daily.png',"div._5nw8");
		});
	});

	// Post Reach
	casper.then(function(){
		var PostReach = "div._5dop._4-u2:nth-child(2)";
		this.captureSelector(page+"/Reach_PostReach.png",PostReach);

		this.clickLabel("Organic","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_PostReach_Organic.png',PostReach);

		this.clickLabel("Paid","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_PostReach_Paid.png',PostReach);
	});

	// Likes, Comments, and Shares
	casper.then(function(){
		var LikesCommentsShares = "div._5dop._4-u2:nth-child(3)";
		var Likes="#u_0_y > div > div._5don > div > div:nth-child(3) > div._532o > div._532u > div > div._5npp > a:nth-child(1) > span";
		var Comments = "#u_0_y > div > div._5don > div > div:nth-child(3) > div._532o > div._532u > div > div._5npp > a:nth-child(2) > span";
		var Shares = "#u_0_y > div > div._5don > div > div:nth-child(3) > div._532o > div._532u > div > div._5npp > a:nth-child(3) > span";
		this.captureSelector(page+"/FB_stat/Reach_LikesCommentsShares.png",LikesCommentsShares);

		this.thenClick(Likes,function(){
			this.wait(2000);
			this.captureSelector(page+'/FB_stat/FB_stat_like.png',LikesCommentsShares);
		});

		this.thenClick(Comments,function(){
			this.wait(2000);
			this.captureSelector(page+'/FB_stat/FB_stat_coment.png',LikesCommentsShares);
		});

		this.clickLabel("Shares","span");
		this.wait(2000);
		this.captureSelector(page+'/FB_stat/FB_stat_share.png',LikesCommentsShares);
	});

	// Hide, Report as Spam, and Unlikes
	casper.then(function(){
		var HideSpamUnlikes = "div._5dop._4-u2:nth-child(4)";
		this.captureSelector(page+"/Reach_HideSpamUnlikes.png",HideSpamUnlikes);

		this.clickLabel("Hide Post","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_HideSpamUnlikes_HidePost.png',HideSpamUnlikes);

		this.clickLabel("Hide All Posts","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_HideSpamUnlikes_HideAllPosts.png',HideSpamUnlikes);

		if(this.exists("span[text=Report as Spam]")) {
			this.clickLabel("Report as Spam","span");
			this.wait(2000);
			this.captureSelector(page+'/Reach_HideSpamUnlikes_ReportasSpam.png',HideSpamUnlikes);
		};

		this.clickLabel("Unlike Page","span");
		this.wait(2000);
		this.captureSelector(page+'/Reach_HideSpamUnlikes_UnlikePage.png',HideSpamUnlikes);
	});

	// Total Reach
	casper.then(function(){
		var TotalReach = "div._5dop._4-u2:nth-child(5)";
		var Organic = "#u_0_y > div > div._5don > div > div:nth-child(5) > div._532o > div._532u > div > div._5npp > a:nth-child(1) > span";
		var Paid = "#u_0_y > div > div._5don > div > div:nth-child(5) > div._532o > div._532u > div > div._5npp > a:nth-child(2) > span"
		this.captureSelector(page+"/FB_stat/Reach_TotalReach.png",TotalReach);

		this.thenClick(Organic,function(){
			this.wait(2000);
			this.captureSelector(page+'/FB_stat/Reach_TotalReach_Organic.png',TotalReach);
		});

		this.thenClick(Paid,function(){
			this.wait(2000);
			this.captureSelector(page+'/FB_stat/Reach_TotalReach_Paid.png',TotalReach);
		});
	});
}

function captureInsightVisits(){
	// Daily data is recorded in the Pacific time zone.
	casper.waitForSelector("div._5nw8",function(){
		this.captureSelector(page+'/Visits_Daily.png',"div._5nw8");
		this.captureSelector(page+'/Visits_Daily.png',"div._5nw8");
	});

	// Page and Tab Visits
	casper.then(function(){
		var div = "div._5dop._4-u2:nth-child(2)"; 
		var totalmenu = casper.evaluate(function(){
				var Menu = "#u_0_y > div > div._5don > div > div:nth-child(2) > div._532o > div._532u > div > div._5npp > a"; // find count element a
				return document.querySelectorAll(Menu).length;
			});

		this.captureSelector(page+"/Visits_PageTabVisits.png",div);

		ClickAndCapture(div,"PageTabVisits",2,totalmenu);

	});

	// External Referrers
	casper.then(function(){
		var div = "div._5dop._4-u2:nth-child(3)";

		var kid = casper.evaluate(function(){
			return document.querySelectorAll("div._5npp > a._53px");
		});
		var totalmenu = kid.length/2;

		this.captureSelector(page+"/Visits_ExternalReferrers.png",div);

		ClickAndCapture(div,"ExternalReferrers",3,totalmenu);
	});
}

function captureInsightPosts(){
	casper.thenOpen("https://facebook.com/"+page+"/insights?section=navPosts");

	// When Your Fans Are Online
	var WhenYourFansAreOnline = "#u_0_y > div > div._5don > div > div._5nzo > div:nth-child(2)";
	casper.waitForSelector(WhenYourFansAreOnline,function(){
		this.captureSelector(page+'/FB_stat/FB_stat_whenYourFanAreOnline.png',WhenYourFansAreOnline);
	});

	// Post Types
	casper.then(function(){
		var PostTypes = "#u_0_y > div > div._5don > div > div._5nzo > div._5nwo._5cmi > a._5nwp._5cmf._5nwq._5cmg > span";
		var waitGraph = "#u_0_y > div > div._5don > div > div._5nzo > div:nth-child(2) > div > div:nth-child(2) > table > tbody > tr:nth-child(1) > td:nth-child(2) > div > div > div._5kn4 > div._5abm > div._352g";

		this.clickLabel("Post Types","span");
		this.waitForSelector(waitGraph,function(){
			this.captureSelector(page+'/FB_stat/FB_stat_postType.png',"#u_0_y > div > div._5don > div > div._5nzo > div:nth-child(2)");
		});
	});
}

function captureInsightPeople(){
	casper.thenOpen("https://facebook.com/"+page+"/insights?section=navPeople");

	var waitGraph = "#u_0_y > div > div._5don > div > div:nth-child(2) > div > div > div:nth-child(2)";
	casper.waitForSelector(waitGraph,function(){
		this.capture(page+'/FB_stat/FB_stat_yourFan.png',{top:420,left:0,height:450,width:926});
	});

	casper.then(function(){
		var waitGraph = "#u_0_y > div > div._5don > div > div:nth-child(2) > div > div > div:nth-child(2) > div._55q5.clearfix > div > div:nth-child(1) > canvas";
		
		this.clickLabel("People Reached","span");
		this.waitForSelector(waitGraph,function(){
			this.capture(page+'/FB_stat/FB_stat_peopleReach.png',{top:420,left:0,height:450,width:926});

			this.clickLabel("People Engaged","span");
				this.waitForSelector(waitGraph,function(){
					this.capture(page+'/FB_stat/FB_stat_peopleEngaged.png',{top:420,left:0,height:450,width:926});
			});
		});
	});
}

function captureTopPosts(){
	var ReachSort = "#u_0_y > div > div._5don > div > div._5dop._4-u2 > div._532o > div._5b9o > table > thead > tr > th:nth-child(5)";
	var PostDetail = "div._4-u2.mbm._5jmm._5pat._5v3q._5x16";
	var PostAyalytics = "body > div.uiLayer._3qw._55vx > div:nth-child(2) > div > div > div > div > div > div._55ii > div > div._ohf.rfloat > div";
	var maxTop=5;

	casper.thenOpen("https://www.facebook.com/"+page+"/insights?section=navPosts",function(){
		this.waitForText('All Posts Published',function(){
			if (this.exists(ReachSort)) {
				this.thenClick(ReachSort,function(){
					this.wait(15000,function(){
						var top1 = "div > div._5don > div > div._5dop._4-u2 > div._532o > div._5b9o > table > tbody > tr:nth-child(1) > td:nth-child(2) > div > div > div:nth-child(2) > div > div";
						var top2 = "div > div._5don > div > div._5dop._4-u2 > div._532o > div._5b9o > table > tbody > tr:nth-child(2) > td:nth-child(2) > div > div > div:nth-child(2) > div > div";
						var top3 = "div > div._5don > div > div._5dop._4-u2 > div._532o > div._5b9o > table > tbody > tr:nth-child(3) > td:nth-child(2) > div > div > div:nth-child(2) > div > div";
						var top4 = "div > div._5don > div > div._5dop._4-u2 > div._532o > div._5b9o > table > tbody > tr:nth-child(4) > td:nth-child(2) > div > div > div:nth-child(2) > div > div";
						var top5 = "div > div._5don > div > div._5dop._4-u2 > div._532o > div._5b9o > table > tbody > tr:nth-child(5) > td:nth-child(2) > div > div > div:nth-child(2) > div > div";
						if (casper.getHTML("div > div._5don > div > div._5dop._4-u2 > div._532o > div > div") != "No posts were published during this period") {
							this.thenClick(top1,function(){
								this.waitForSelector(PostDetail,function(){
									this.wait(3000,function(){
										this.captureSelector(page+"/FB_top5_posts/topPosts_Post_1.png",PostDetail);
										this.captureSelector(page+"/FB_top5_posts/topPosts_Analytics_1.png",PostAyalytics);
										this.wait(2000,function(){
											this.click("body > div.uiLayer._3qw._55vx > div:nth-child(2) > div > div > div > div > div > div._55m4 > button");
										});
									});
								});
							});

							this.thenClick(top2,function(){
								this.waitForSelector(PostDetail,function(){
									this.wait(3000,function(){
										this.captureSelector(page+"/FB_top5_posts/topPosts_Post_2.png",PostDetail);
										this.captureSelector(page+"/FB_top5_posts/topPosts_Analytics_2.png",PostAyalytics);
										this.wait(2000,function(){
											this.click("body > div.uiLayer._3qw._55vx > div:nth-child(2) > div > div > div > div > div > div._55m4 > button");
										});
									});
								});
							});

							this.thenClick(top3,function(){
								this.waitForSelector(PostDetail,function(){
									this.wait(3000,function(){
										this.captureSelector(page+"/FB_top5_posts/topPosts_Post_3.png",PostDetail);
										this.captureSelector(page+"/FB_top5_posts/topPosts_Analytics_3.png",PostAyalytics);
										this.wait(2000,function(){
											this.click("body > div.uiLayer._3qw._55vx > div:nth-child(2) > div > div > div > div > div > div._55m4 > button");
										});
									});
								});
							});

							this.thenClick(top4,function(){
								this.wait(3000,function(){
									this.waitForSelector(PostDetail,function(){
										this.captureSelector(page+"/FB_top5_posts/topPosts_Post_4.png",PostDetail);
										this.captureSelector(page+"/FB_top5_posts/topPosts_Analytics_4.png",PostAyalytics);
										this.wait(2000,function(){
											this.click("body > div.uiLayer._3qw._55vx > div:nth-child(2) > div > div > div > div > div > div._55m4 > button");
										});
									});
								});
							});

							this.thenClick(top5,function(){
								this.wait(3000,function(){
									this.waitForSelector(PostDetail,function(){
										this.captureSelector(page+"/FB_top5_posts/topPosts_Post_5.png",PostDetail);
										this.captureSelector(page+"/FB_top5_posts/topPosts_Analytics_5.png",PostAyalytics);
										this.wait(2000,function(){
											this.click("body > div.uiLayer._3qw._55vx > div:nth-child(2) > div > div > div > div > div > div._55m4 > button");
										});
									});
								});
							});
						};

						// for (var count = 1; count <= maxTop; count++) {
						// 	var linktop = "#u_0_y > div > div._5don > div > div._5dop._4-u2 > div._532o > div._5b9o > table > tbody > tr:nth-child("+count+") > td:nth-child(2) > div > div > div:nth-child(2) > div > div";
						// 	this.thenClick(linktop,function(){
						// 		this.waitForSelector(PostDetail,function(){
						// 			this.captureSelector(page+"/FB_top5_posts/topPosts_Post_"+count+".png",PostDetail);
						// 			this.captureSelector(page+"/FB_top5_posts/topPosts_Analytics"+count+".png",PostAyalytics);
						// 			this.wait(2000,function(){
						// 				this.click("body > div.uiLayer._3qw._55vx > div:nth-child(2) > div > div > div > div > div > div._55m4 > button");
						// 			});
						// 		});
						// 	});
						// }; // end for
					});
				});
			}; // end if
		});
	});

}

function ClickAndCapture(element,title,numElement,totalmenu){
	console.log("################# "+totalmenu+" ###################")
	for (var Menu = 1; Menu <= totalmenu; Menu++) {
		var Clickbtn = "#u_0_y > div > div._5don > div > div:nth-child("+numElement+") > div._532o > div._532u > div > div._5npp > a:nth-child("+Menu+") > span"
		var namefile = casper.getHTML(Clickbtn);
		casper.click(Clickbtn);
		casper.wait(2000);
		casper.captureSelector(page+'/'+title+"_"+namefile+'.png',element);
	};
}

function CalendarDateLikes(dateFrom,dateTo){
	casper.thenOpen("https://www.facebook.com/"+page+"/insights?section=navLikes",function(){
		this.waitForSelector("div._5nwa",function(){
			this.fillSelectors("div._5nwa",{
				'span[name="sinceCalendar"] > input._5qcz': dateFrom,
				'span[name="untilCalendar"] > input._5qcz': dateTo
			},true);
			this.wait(2000,function(){
				captureInsightLikes();
			});
		});
	});
}

function CalendarDateReach(dateFrom,dateTo){
	casper.thenOpen("https://www.facebook.com/"+page+"/insights?section=navReach",function(){
		this.waitForSelector("div._5nwa",function(){
			this.fillSelectors("div._5nwa",{
				'span[name="sinceCalendar"] > input._5qcz': dateFrom,
				'span[name="untilCalendar"] > input._5qcz': dateTo
			},true);
			this.wait(2000,function(){
				captureInsightReach();
			});
		});
	});
}

function CalendarDateVisits(dateFrom,dateTo){
	casper.thenOpen("https://www.facebook.com/"+page+"/insights?section=navVisits",function(){
		this.waitForSelector("div._5nwa",function(){
			this.fillSelectors("div._5nwa",{
				'span[name="sinceCalendar"] > input._5qcz': dateFrom,
				'span[name="untilCalendar"] > input._5qcz': dateTo
			},true);
			this.wait(2000,function(){
				captureInsightVisits();
			});
		});
	});
}

casper.run();