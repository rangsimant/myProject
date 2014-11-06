var userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36(KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js',
    'bootstrap.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent,
    },
    viewportSize:{width: 1366,height:1080}, // Resolution for Display Labtop 1366x768
    logLevel: "debug",      
    verbose: true ,
    waitTimeout:20000
});

casper.echo("DateStart : "+casper.cli.get('datefrom')+" DateEnd : "+casper.cli.get('dateto'));

var XPath = require('casper').selectXPath;
var user="acerthailand";
var pass="acer2010";

// // format date MMDDYYYY or MM/DD/YYYY
var dateStart = casper.cli.get('datefrom');
var dateEnd = casper.cli.get('dateto');


loginTwitter(user,pass);
captureTweereach();
captureTwittercounter(dateStart,dateEnd)

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
    casper.thenOpen("http://tweetreach.com/",function(){ // connect http://tweetreach.com
        this.sendKeys("#q","acerthailand"); // send key "acerthailand"
        var ClickGO ='#content > form > div > input[type="submit"]:nth-child(2)';
        this.thenClick(ClickGO,function(){ // click button GO
            this.wait(5000,function(){ // wait 5sec
                this.thenClick("#auth_required.oauth_modal > form > p.actions > input",function(){ // click comfirm login with twitter
                     this.thenClick("input#allow.submit.button.selected",function(){ // click accept app of tweetreach
                        this.waitForSelector("#rv2",function(){
                            this.capture("acerthailand/TW_stat/TW_stat_ESTIMATED REACH.png",{top:320,left:190,width:970,height:700}); //capture Size 910x700
                        });
                     });
                });
            });
        });
    });
}


function captureTwittercounter(datefrom,dateto){

    casper.thenOpen("http://twittercounter.com/remote/login.php?referer=twittercounter",function(){
        this.wait(3000,function(){
            this.click("#allow")
        });
    });

    casper.thenOpen("http://twittercounter.com/pages/you",function(){
        this.viewport(1920,1080);
        this.wait(3000,function(){
            this.capture("dsyyyyy.png");
            this.waitForSelector("#graph-timeframe",function(){
                this.thenClick("#graph-timeframe",function(){
                    this.capture("click.png");
                    this.fillSelectors("div.range_inputs",{
                        "#daterangepicker_start":datefrom, // format date MMDDYYYY or MM/DD/YYYY
                        "#daterangepicker_end":dateto // format date MMDDYYYY or MM/DD/YYYY
                    },true);
                    this.capture("fill.png");
                    this.thenClick("div.range_inputs > button",function(){
                        this.thenOpen("http://twittercounter.com/pages/you",function(){ //wait for render graph
                            // this.waitForSelector("#sel2-clear",function(){
                                this.thenClick("#sel2-clear > i.flaticon.solid",function(){
                                    this.wait(5000,function(){
                                        this.capture("ChangeDate.png",{top:500,left:580,width:760,height:440});
                                    });
                                });
                            // });
                        });
                    });
                });
            });
        });
    });
}
casper.run();