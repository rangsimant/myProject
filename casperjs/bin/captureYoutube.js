var userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36(KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js',
    'bootstrap.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent,
    },
    viewportSize:{width: 1366,height:6080}, // Resolution for Display Labtop 1366x768
    logLevel: "debug",      
    verbose: true ,
    waitTimeout:20000
});
var XPath = require('casper').selectXPath;
var channel = "acerthailand";
var username = "mkt.acerthailand@gmail.com";
var password = "acerthailand";

casper.echo("DateStart : "+casper.cli.get('datefrom')+" DateEnd : "+casper.cli.get('dateto'));
casper.echo("DateStartCompare : "+casper.cli.get('datefromcompare')+" DateEndCompare : "+casper.cli.get('datetocompare'));


// format date 10/10/2014 = MM/DD/YYYY
var dateStart = casper.cli.get('datefrom');
var dateEnd = casper.cli.get('dateto');
var dateStartCompare = casper.cli.get('datefromcompare');
var dateToCompare = casper.cli.get('datetocompare');

// channelPage(channel);
youtubeAnalytics(username,password,dateStart,dateEnd,dateStartCompare,dateToCompare);

function channelPage (channel) {
    var count=2;
    var link = "http://www.youtube.com/user/"+channel;
    var row = [
    '#browse-items-primary > li:nth-child(2)',
    '#browse-items-primary > li:nth-child(3)',
    '#browse-items-primary > li:nth-child(4)',
    '#browse-items-primary > li:nth-child(5)',
    '#browse-items-primary > li:nth-child(6)',
    '#browse-items-primary > li:nth-child(7)',
    '#browse-items-primary > li:nth-child(8)',
    '#browse-items-primary > li:nth-child(9)',
    '#browse-items-primary > li:nth-child(10)',
    '#browse-items-primary > li:nth-child(11)'
];

    casper.start(link).each(row, function(self, element) {
        self.then(function() {
            this.wait(4000,function(){
                var nextpage=1;
                var namefile = this.getHTML("#browse-items-primary > li:nth-child("+count+") > div.feed-item-dismissable > div > div > div > div > h2 > a.yt-uix-sessionlink.branded-page-module-title-link.spf-nolink > span > span");
                this.captureSelector("acerthailand/YT_stat/YT_stat_channel/"+namefile+"_"+nextpage+".png",element);
                var checkNext = "#browse-items-primary > li:nth-child("+count+") > div>div>div>div>div.yt-uix-shelfslider-at-tail";
                var btnNext = "#browse-items-primary > li:nth-child("+count+") > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span";
                nextpage++;

                if (!this.exists(checkNext)) { // If button Next slide video Visible
                    var next = [btnNext,btnNext]; // Array Next slide video
                    this.each(next,function(self,btnNext){ // Loop Next slide video
                        self.thenClick(btnNext,function(){ // Click Next slide video
                            this.wait(4000,function(){
                                this.captureSelector("acerthailand/YT_stat/YT_stat_channel/"+namefile+"_"+nextpage+".png",element);
                                nextpage++;
                            });
                        });
                    });
                };
                count++;
            });
        });
    });
}

function youtubeAnalytics (username,password,dateFrom,dateTo,dateFromCompare,dateToCompare) {
    casper.start();
    var calendar = "#gwt-debug-datePicker > button.GCJJMQ4DMCB.GCJJMQ4DBDB.GCJJMQ4DDDB.GCJJMQ4DOW.GCJJMQ4DODB";
    var calendarCompare = "#gwt-debug-datePicker1 > button.GCJJMQ4DMCB.GCJJMQ4DBDB.GCJJMQ4DDDB.GCJJMQ4DOW.GCJJMQ4DODB";
    var groupCalendar = "#body > div.gwt-PopupPanel > div > div";

    casper.thenOpen("https://www.youtube.com/analytics",function(){
        this.sendKeys("#Email",username);
        this.sendKeys("#Passwd",password);
        this.click("#signIn")
    });

    casper.then(function(){
        this.waitForSelector("#creator-sidebar-item-id-views > a > span",function(){
            this.thenClick("#creator-sidebar-item-id-views > a > span",function(){;
                this.waitForSelector("#gwt-debug-fullCompare",function(){

                    // date range
                    this.click("#gwt-debug-fullCompare"); // click add compare
                    this.wait(4000,function(){
                        this.thenClick(calendar,function(){
                           this.capture("Afddgdfdf.png");
                           this.sendKeys("div.popupContent>div>div:nth-child(1)>input",dateFrom);
                           this.sendKeys("div.popupContent>div>div:nth-child(2)>input",dateTo);
                            // this.fillSelectors(groupCalendar,{
                            //     'div.popupContent>div>div:nth-child(1)>input':dateFrom, // input dateFrom
                            //     'div.popupContent>div>div:nth-child(2)>input':dateTo // inout dateTo
                            // },true);
                            this.capture("Fill.png");
                            this.wait(3000,function(){
                                this.click("#body > div.gwt-PopupPanel > div > div > div.GCJJMQ4DEX > button.GCJJMQ4DMCB.GCJJMQ4DPDB > span"); // click Apply calendar
                            });
                        });
                    });


                    // date Compare
                    // this.wait(4000,function(){ // wait 4 second
                    //     this.thenClick(calendarCompare,function(){ // click button Calendar 
                    //         this.fillSelectors(groupCalendar,{ // find group of input
                    //             'div.popupContent>div>div:nth-child(1)>input':dateFromCompare, // input dateFrom
                    //             'div.popupContent>div>div:nth-child(2)>input':dateToCompare // inout dateTo
                    //         },true);
                    //         this.wait(3000,function(){
                    //             this.click("#body > div.gwt-PopupPanel > div > div > div.GCJJMQ4DEX > button.GCJJMQ4DMCB.GCJJMQ4DPDB > span"); // click Apply calendar
                    //         });
                    //         this.wait(2000,function(){
                    //             this.capture("acerthailand/YT_stat/Compare.png",{top:495,left:240,width:490,height:150});
                    //             this.captureSelector("acerthailand/YT_stat/ChartCompare.png","svg[width='774'] > rect");
                    //             this.capture("acerthailand/YT_stat/List_video.png",{top:980,left:240,width:810,height:560})
                    //         });
                    //     });
                    // });
                });
            })
        });
    });

}

casper.run();