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

casper.echo("DateStart : "+casper.cli.get('datefrom')+" DateEnd : "+casper.cli.get('dateto'));
casper.echo("DateStartCompare : "+casper.cli.get('datefromcompare')+" DateEndCompare : "+casper.cli.get('datetocompare'));


// formate date "20140930" = YYYYMMDD
var dateStart = casper.cli.get('datefrom');
var dateEnd = casper.cli.get('dateto');
var dateStartCompare = casper.cli.get('datefromcompare');
var dateToCompare = casper.cli.get('datetocompare');
var datePostFrom = new Date(casper.cli.get('datepostfrom')); // format date "2014-10-10" = YYYY-MM-DD
var datePostTo = new Date(casper.cli.get('datepostto')); // format date "2014-10-10" = YYYY-MM-DD

captureHomepage();
captureNewandReview(datePostFrom,datePostTo);
capturePromotion(datePostFrom,datePostTo);
captureGoogleAnalytics(dateStart,dateEnd,dateStartCompare,dateToCompare);

function captureHomepage () {
    casper.start("http://www.acer4u.in.th/",function(){
        this.capture("acerthailand/acer4u_stat/acer4u_stat_lastUpdate.png",{top:0,left:70,height:800,width:1220});
    });
}

function captureNewandReview(dateFrom,dateTo){
    casper.thenOpen("http://www.acer4u.in.th/category/pr-news/",function(){
        var len = this.evaluate(function(){
            return document.querySelectorAll("#main > article").length; // return length of artcle
        });
        for (var i = 1; i <= len; i++) {
            var datetime = this.getElementAttribute('div[id=main] > article:nth-child('+i+') > time', 'datetime'); // "Google"
            var newformatDate = new Date(datetime);
            console.log("################ "+newformatDate.getMonth()+" < "+dateTo.getMonth()+" ###################");
            console.log("################ "+newformatDate.getMonth()+" > "+dateFrom.getMonth()+" ###################");
            if (newformatDate.getMonth() <= dateTo.getMonth() && newformatDate.getMonth() >= dateFrom.getMonth()) { // check Month between Post and this date.
                this.captureSelector("acerthailand/acer4u_stat/acer4u_stat_review_"+i+".png","div[id=main] > article:nth-child("+i+")");
                console.log("Save article to Image.");
            }else{
                // Do something
                console.log("Not found article this Date.");
            };
        };
        
    });
}

function capturePromotion(dateFrom,dateTo){
    casper.thenOpen("http://www.acer4u.in.th/category/promotion/",function(){
        var len = this.evaluate(function(){
            return document.querySelectorAll("#main > article").length; // return length of artcle
        });
        for (var i = 1; i <= len; i++) {
            var datetime = this.getElementAttribute('div[id=main] > article:nth-child('+i+') > time', 'datetime'); // "Google"
            var newformatDate = new Date(datetime);
            console.log("################ "+newformatDate.getMonth()+" < "+dateTo.getMonth()+" ###################");
            console.log("################ "+newformatDate.getMonth()+" > "+dateFrom.getMonth()+" ###################");
            if (newformatDate.getMonth() <= dateTo.getMonth() && newformatDate.getMonth() >= dateFrom.getMonth()) { // check Month between Post and this date.
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

    casper.thenOpen("https://www.google.com/analytics/web/?hl=en#report/visitors-overview/a5476889w31158694p30174530/%3F_u.date00%3D"+dateFrom+"%26_u.date01%3D"+dateTo+"%26_u.date10%3D"+dateFromCompare+"%26_u.date11%3D"+dateToCompare,function(){
        this.waitForSelector("#Email",function(){
            this.sendKeys("#Email",username);
            this.sendKeys("#Passwd",password);
            this.thenClick("#signIn",function(){
                this.wait(5000,function(){
                    this.captureSelector("acerthailand/acer4u_stat/acer4u_stat1.png","#ID-overview-graph");
                    this.captureSelector("acerthailand/acer4u_stat/acer4u_stat2.png","#ID-tab > div > table");
                })
            });
        });
    });

}

function stringDate(date){
    if (date < 10) {
        date = "0"+date.toString();
    };
    return date;
}

casper.run();