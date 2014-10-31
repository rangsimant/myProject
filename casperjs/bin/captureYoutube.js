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
var channel = "acerthailand";

channelPage(channel);

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

//     casper.start("http://www.youtube.com/user/"+channel);
//     //############# Acer Channel #############
//     // first Acer Channel
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(2)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Acer_Channel_1.png","#browse-items-primary > li:nth-child(2)");
//             });
//         });
//     });

//     // next second Acer Channel
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(2)",function(){
//             this.click("#browse-items-primary > li:nth-child(2) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Acer_Channel_2.png","#browse-items-primary > li:nth-child(2)");
//             });
//         });
//     });

//     // next third Acer Channel
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(2)",function(){
//             this.click("#browse-items-primary > li:nth-child(2) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Acer_Channel_3.png","#browse-items-primary > li:nth-child(2)");
//             });
//         });
//     });
//     //############# End Channel #############

//     //############# Smartphone #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(3)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Smartphone_1.png","#browse-items-primary > li:nth-child(3)");
//             });
//         });
//     });

//     // second
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(3)",function(){
//             this.click("#browse-items-primary > li:nth-child(3) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Smartphone_2.png","#browse-items-primary > li:nth-child(3)");
//             });
//         });
//     });

//     // third
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(3)",function(){
//             this.click("#browse-items-primary > li:nth-child(3) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Smartphone_3.png","#browse-items-primary > li:nth-child(3)");
//             });
//         });
//     });
//     //############# End SSmartphone #############

//     //############# Tablet #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(4)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Tablet_1.png","#browse-items-primary > li:nth-child(4)");
//             });
//         });
//     });

//     // second
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(4)",function(){
//             this.click("#browse-items-primary > li:nth-child(4) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Tablet_2.png","#browse-items-primary > li:nth-child(4)");
//             });
//         });
//     });

//     // third
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(4)",function(){
//             this.click("#browse-items-primary > li:nth-child(4) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Tablet_3.png","#browse-items-primary > li:nth-child(4)");
//             });
//         });
//     });
//     //############# End Tablet #############

//     //############# Notebook #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(5)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Notebook_1.png","#browse-items-primary > li:nth-child(5)");
//             });
//         });
//     });

//     // second
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(5)",function(){
//             this.click("#browse-items-primary > li:nth-child(5) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Notebook_2.png","#browse-items-primary > li:nth-child(5)");
//             });
//         });
//     });

//     // third
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(5)",function(){
//             this.click("#browse-items-primary > li:nth-child(5) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Notebook_3.png","#browse-items-primary > li:nth-child(5)");
//             });
//         });
//     });
//     //############# End Notebook #############

//     //############# Projector #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(6)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Projector_1.png","#browse-items-primary > li:nth-child(6)");
//             });
//         });
//     });
//     //############# End Projector #############

//     //############# All in One #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(7)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/All_in_One.png","#browse-items-primary > li:nth-child(7)");
//             });
//         });
//     });
//     //############# End All in One #############

//     //############# Accessories #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(8)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Accessories.png","#browse-items-primary > li:nth-child(8)");
//             });
//         });
//     });
//     //############# End Accessories #############

//     //############# Apacer #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(9)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Apacer.png","#browse-items-primary > li:nth-child(9)");
//             });
//         });
//     });
//     //############# End Apacer #############

//      //############# Acer Activity #############
//     // first Acer 
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(10)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Acer_Activity_1.png","#browse-items-primary > li:nth-child(10)");
//             });
//         });
//     });

//     // next second 
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(10)",function(){
//             this.click("#browse-items-primary > li:nth-child(10) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Acer_Activity_2.png","#browse-items-primary > li:nth-child(10)");
//             });
//         });
//     });

//     // next third 
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(10)",function(){
//             this.click("#browse-items-primary > li:nth-child(10) > div.feed-item-dismissable > div > div > div > div > div > button.yt-uix-button.yt-uix-button-size-default.yt-uix-button-shelf-slider-pager.yt-uix-shelfslider-next > span > span");
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Acer_Activity_3.png","#browse-items-primary > li:nth-child(10)");
//             });
//         });
//     });
//     //############# End Activity #############   

//     //############# Other #############
//     // first
//     casper.then(function(){
//         this.waitForSelector("#browse-items-primary > li:nth-child(11)",function(){
//             this.wait(3000,function(){
//                 this.captureSelector("acerthailand/YT_stat/YT_stat_channel/Other.png","#browse-items-primary > li:nth-child(11)");
//             });
//         });
//     });
//     //############# End Other #############
// }

casper.run();