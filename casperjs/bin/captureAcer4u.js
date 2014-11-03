var userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36(KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36';
var casper = require('casper').create({
    clientScripts:[
    'jquery-2.1.1.min.js',
    'bootstrap.js'],
    pageSettings: {
        javascriptEnabled: true,
        userAgent: userAgent,
    },
    viewportSize:{width: 1366, height: 3080}, // Resolution for Display Labtop 1366x768
    logLevel: "debug",      
    verbose: true ,
    waitTimeout:20000
});
var XPath = require('casper').selectXPath;
var dateNow = new Date(); // datetime
var username = "thothreport@gmail.com";
var password = "thothreport!";

var dateStart = "20141001";
var dateEnd = "20141030";
var dateStartCompare = "20140901";
var dateToCompare = "20140930";

captureHomepage();
captureNewandReview(dateNow);
capturePromotion(dateNow);
captureGoogleAnalytics(dateStart,dateEnd,dateStartCompare,dateToCompare);

function captureHomepage () {
    casper.start("http://www.acer4u.in.th/",function(){
        this.capture("acerthailand/acer4u_stat/acer4u_stat_lastUpdate.png",{top:0,left:70,height:800,width:1220});
    });
}

function captureNewandReview(datemonth){
    casper.thenOpen("http://www.acer4u.in.th/category/pr-news/",function(){
        var len = this.evaluate(function(){
            return document.querySelectorAll("#main > article").length; // return length of artcle
        });
        for (var i = 1; i <= len; i++) {
            var datetime = this.getElementAttribute('div[id=main] > article:nth-child('+i+') > time', 'datetime'); // "Google"
            var newformatDate = new Date(datetime);
            if (newformatDate.getMonth() == datemonth.getMonth()) { // check Month between Post and this date.
                this.captureSelector("acerthailand/acer4u_stat/acer4u_stat_review_"+i+".png","div[id=main] > article:nth-child("+i+")");
                console.log("Save article to Image.");
            }else{
                // Do something
                console.log("Not found article this Date.");
            };
        };
        
    });
}

function capturePromotion(datemonth){
    casper.thenOpen("http://www.acer4u.in.th/category/promotion/",function(){
        var len = this.evaluate(function(){
            return document.querySelectorAll("#main > article").length; // return length of artcle
        });
        for (var i = 1; i <= len; i++) {
            var datetime = this.getElementAttribute('div[id=main] > article:nth-child('+i+') > time', 'datetime'); // "Google"
            var newformatDate = new Date(datetime);
            if (newformatDate.getMonth() == datemonth.getMonth()) { // check Month between Post and this date.
                this.captureSelector("acerthailand/acer4u_stat/acer4u_stat_promotion_"+i+".png","div[id=main] > article:nth-child("+i+")");
                console.log("Save article to Image.");
            }else{
                // Do something
                console.log("Not found article this Date.");
            };
        };
        
    });
}

function captureGoogleAnalytics(dateFrom,dateTo,dateFromCompare,dateToCompare){

    casper.thenOpen("https://www.google.com/analytics/web/?hl=en#report/visitors-overview/a5476889w31158694p30174530/%3F_u.date00%3D"+dateStart+"%26_u.date01%3D"+dateEnd+"%26_u.date10%3D"+dateStartCompare+"%26_u.date11%3D"+dateToCompare,function(){
        this.sendKeys("#Email",username);
        this.sendKeys("#Passwd",password);
        this.thenClick("#signIn",function(){
            this.wait(5000,function(){
                this.captureSelector("acerthailand/acer4u_stat/acer4u_stat1.png","#ID-overview-graph");
                this.captureSelector("acerthailand/acer4u_stat/acer4u_stat2.png","#ID-tab > div > table");
            })
        });
    });

// a5476889w31158694p30174530/%3F_u.date00%3D20141002%26_u.date01%3D20141031%26_u.date10%3D20140902%26_u.date11%3D20141001/
}

function stringDate(date){
    if (date < 10) {
        date = "0"+date.toString();
    };
    return date;
}

casper.run();