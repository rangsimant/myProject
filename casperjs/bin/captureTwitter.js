var userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36(KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js',
    'bootstrap.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent,
    },
    viewportSize:{width: 1366}, // Resolution for Display Labtop 1366x768
    logLevel: "debug",      
    verbose: true ,
    waitTimeout:20000
});
var XPath = require('casper').selectXPath;
var user="acerthailand";
var pass="acer2010";

loginTwitter(user,pass);
captureTweereach();

function loginTwitter(username,password) {
    casper.start("https://twitter.com/",function(){
        this.sendKeys("#signin-email",username);
        this.sendKeys("#signin-password",password);
        this.thenClick("button.submit.btn.primary-btn.flex-table-btn.js-submit",function(){
            this.wait(2000,function(){
                this.captureSelector("acerthailand/TW_stat/TW_stat_follower.png","#page-container > div.dashboard.dashboard-left > div.DashboardProfileCard.module");
            });
        });
    });
}

function captureTweereach(){
    casper.thenOpen("http://tweetreach.com/",function(){
        this.sendKeys("#q","acerthailand");
        var ClickGO ='#content > form > div > input[type="submit"]:nth-child(2)';
        this.thenClick(ClickGO,function(){
            this.wait(5000,function(){
                this.thenClick("#auth_required.oauth_modal > form > p.actions > input",function(){ // click comfirm login with twitter
                     this.thenClick("input#allow.submit.button.selected",function(){ // click accept app of tweetreach
                        this.waitForSelector("#rv2",function(){
                            this.capture("acerthailand/TW_stat/ESTIMATED REACH.png",{top:320,left:0,width:910,height:700}); //capture Size 910x700
                        });
                     });
                });
            });
        });
    });
}

casper.run();