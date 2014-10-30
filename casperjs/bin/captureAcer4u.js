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
var dateNow = new Date();

captureHomepage();
captureNewandReview(dateNow);

function captureHomepage () {
    casper.start("http://www.acer4u.in.th/",function(){
        this.capture("acerthailand/acer4u_stat/acer4u_stat_lastUpdate.png",{top:0,left:70,height:800,width:1220});
    });
}

function captureNewandReview(datemonth){
    casper.thenOpen("http://www.acer4u.in.th/category/pr-news/",function(){
        var len = this.evaluate(function(){
            return document.querySelectorAll("#main > article").length;
        });
        console.log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% "+len);
        for (var i = 1; i <= len; i++) {
            var datetime = this.getElementAttribute('div[id=main] > article:nth-child('+i+') > time', 'datetime'); // "Google"
            var newformatDate = new Date(datetime);
            if (newformatDate.getMonth() == datemonth.getMonth()) {
                this.captureSelector("acerthailand/acer4u_stat/acer4u_stat_review_"+i+".png","div[id=main] > article:nth-child("+i+")");
            }else{
                console.log(i+" NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO");
            };
        };
        
    });
}


casper.run();