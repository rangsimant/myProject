/*
######### Update 6/11/2557 #########
func capture :  Step 1 --> find length of div
                Step 2 --> capture div = length
                Step 3 --> find length of rigth menu
                Step 4 --> click button and capture
func FillandCapture :   Step 1 --> wait for form input
                        Step 2 --> fill input("date")
                        Step 3 --> call Func capture

####################################
*/




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

// format date MM/DD/YYYY Ex. 10/30/2014
var _datestart = casper.cli.get("datestart");
var _dateend = casper.cli.get("dateend");
var _user = casper.cli.get("user");
var _pass = casper.cli.get("pass");
var _page = casper.cli.get("page");
var path = "image/"+_page+"/";

console.log("Login by : "+_user+" Page Facebook : "+_page);
console.log("DateStart : "+_datestart);
console.log("DateEnd : "+_dateend);

LoginFacebook(_user,_pass,_page);
LikeChart(_page);
Overview(_page);
FindAndCapture("Likes_",_datestart,_dateend,_page,"navLikes");
FindAndCapture("Reach_",_datestart,_dateend,_page,"navReach");
FindAndCapture("Visits_",_datestart,_dateend,_page,"navVisits");
Posts(_page,"navPosts");
FindAndCapture("People_",_datestart,_dateend,_page,"navPeople");
People(_page,"navPeople");

function LoginFacebook(user,pass,page){

    // login Facebook
    casper.start("https://facebook.com/"+page+"/",function(){
        var btnLogin ="input#u_0_0";
        var tbUser = "input#email";
        var tbPass = "input#pass";
        var coverPage = "div#fbProfileCover";

        this.sendKeys(tbUser,user);
        this.echo("[status] Fill username");
        this.sendKeys(tbPass,pass);
        this.echo("[status] Fill password");
        this.thenClick(btnLogin,function(){
            this.echo("[status] Click Login");
             //capture Cover
            this.waitForSelector(coverPage,function(){
                this.echo("[status] Save capture Cover Page");
                this.captureSelector(path+"cover.png",coverPage);
            });
        }); 
    });
}

function LikeChart(page){
    var url = "https://facebook.com/"+page+"/likes";
    casper.thenOpen(url,function(){
        this.echo("[status] Change Url to : "+url);
        var wait = "div._1lox";
        var namefile = "People Like_";

        capture(namefile,wait,null,"likes");
    });

}

function Overview(page){
    var url = "https://facebook.com/"+page+"/insights";
    casper.thenOpen(url,function(){
        this.echo("[status] Change Url to : "+url);
        var wait = "div._5ojv.clearfix > a";
        var namefile ="Overview_";

        capture(namefile,wait,null,"overview");
    });
}

function FindAndCapture(filename,datestart,dateend,page,section){
    var url = "https://www.facebook.com/"+page+"/insights?section="+section;
    casper.thenOpen(url,function(){
        this.echo("[status] Change Url to : "+url);
        clickandcapture(filename,datestart,dateend,section);
    });
}

function Posts(page,section){
    var url = "https://www.facebook.com/"+page+"/insights?section="+section;
    casper.thenOpen(url,function(){
        this.echo("[status] Change Url to : "+url);
        var wait = "div[class=_5don] > div > div";
        var namefile ="Posts_";

        capture(namefile,wait,null,section);
        captureTopPost();
    });
}

function People(page,section){
    var url = "https://www.facebook.com/"+page+"/insights?section="+section;
    casper.thenOpen(url,function(){
        this.echo("[status] Change Url to : "+url);
        var wait=" div._5don > div._5nzo > div";
        var namefile = "People";
        var menu = "div._5don > div._5nzo > div:nth-child(1)";
        capture(namefile,wait,menu,section);
    });
}

function captureTopPost(){
    casper.then(function(){
        var topsort = "th._5k3-._5k3_:nth-child(5) > span";
        var btnMore = "div._25q1";
        obj = new Object();
        obj.linktoppost = "div._5591";
        obj.waitPostDetail = "div._55ii > div.clearfix >div";

        if (this.exists(obj.linktoppost)) {
            this.thenClick(topsort,function(){
                this.echo("[status] Click Sort");
                this.wait(5000,function(){
                    this.thenClick(btnMore,function(){
                        this.echo("[status] Click More");
                        this.wait(5000,function(){
                            var lentop = this.evaluate(function(toppost){
                                return document.querySelectorAll(toppost).length;
                            },obj.linktoppost);
                            this.echo("[status] Found Top Posts "+lentop+" post");

                            var countlink = 1;
                            this.repeat(lentop,function(){
                                obj.linktoppost = "tr:nth-child("+countlink+")>td._5k49:nth-child(2) >div >div >div:nth-child(2) > div > div";
                                this.thenClick(obj.linktoppost,function(){
                                    this.echo("[status] Click TopPost popup "+(countlink-1));
                                    this.wait(2000,function(){
                                        var lenpostdetail = this.evaluate(function(postdetail){
                                            return document.querySelectorAll(postdetail).length;
                                        },obj.waitPostDetail);
                                        var countpostdetail = 1;
                                        var btnClosePopup = "button._55ng._50zy._50-0._50z-._5upp._42ft > span";
                                        this.repeat(lenpostdetail,function(){
                                            var PostsBox = obj.waitPostDetail+":nth-child("+countpostdetail+")";
                                            if ((countlink-1)== 1) {
                                                this.wait(2000,function(){
                                                    this.captureSelector(path+"/toppost/TopPosts_"+(countlink-1)+"_"+countpostdetail+".png",PostsBox);
                                                    this.captureSelector(path+"/toppost/TopPosts_"+(countlink-1)+"_"+countpostdetail+".png",PostsBox);
                                                });
                                            }else{
                                                this.captureSelector(path+"/toppost/TopPosts_"+(countlink-1)+"_"+countpostdetail+".png",PostsBox);
                                            };
                                            this.echo("[status] Save capture At Post "+(countlink-1)+" Posts Detail "+countpostdetail);
                                            countpostdetail++;
                                        });
                                        this.wait(2000,function(){
                                            this.echo("[status] Click Close popup");
                                            this.click(btnClosePopup);
                                        });
                                    });
                                });
                            countlink++;
                            }); // end loop click top posts
                        }); // end wait 5sec
                    }); // click More
                }); // end wait 5sec
            }); // end click top post
        }else{
            this.echo("[status] Not found Top Posts");
        };
    });
}

function clickandcapture(filename,datestart,dateend,section){
    casper.then(function(){
            this.echo("[status] wait Selector.");
            this.waitForSelector("div._5nwa",function(){
                this.fillSelectors("div._5nwa",{
                    "span[name=sinceCalendar] > input._5qcz":datestart,
                    "span[name=untilCalendar] > input._5qcz":dateend
                },true);
                this.echo("[status] Fill datestart & dateend");
                var wait = "div[class=_5don] > div > div";
                var clickmenu = " > div._532o > div._532u > div > div._5npp";
                capture(filename,wait,clickmenu,null,section);
            });
    });
}

function capture(filename,waitSelector,menu,section){
    obj = new Object();
    obj.wait = waitSelector;


    casper.then(function(){
        this.echo("[status] wait Selector.");
        this.waitForSelector(waitSelector,function(){
            var len = this.evaluate(function(selector){
                return document.querySelectorAll(selector).length;
            },obj);
            this.echo("[status] len Div :"+len);
            if (len==null || len==0) {
                len=1;
            };
            var countlen = 1;
            this.repeat(len,function(){
                var listchartbox = waitSelector+":nth-child("+countlen+")";
                if (this.exists(listchartbox)) {
                    if (countlen == 1) {
                        this.captureSelector(path+"/"+section+"/"+filename+countlen+".png",listchartbox);
                        this.captureSelector(path+"/"+section+"/"+filename+countlen+".png",listchartbox);
                    }else{
                        this.captureSelector(path+"/"+section+"/"+filename+countlen+".png",listchartbox);
                    };
                    this.echo("[status] Save capture :"+path+"/"+section+"/"+filename+countlen+".png",listchartbox);
                    if (section == "navPeople") {
                        var clickmenu = menu+" > a";
                    }else{
                        var clickmenu = listchartbox+menu+" > a";
                    };
                    if (this.exists(clickmenu)) {
                        this.echo("[status] found button");
                        var obj_Menu = new Object();
                        obj_Menu.click = clickmenu;
                        var countclick = 1;

                        var len_menu = this.evaluate(function(click){
                            return document.querySelectorAll(click).length;
                        },obj_Menu);
                        this.echo("[status] Len button :"+len_menu);
                        this.repeat(len_menu,function(){
                            this.thenClick(clickmenu+":nth-child("+countclick+") > span",function(){
                                this.wait(8000,function(){
                                    var btnName = this.getHTML(clickmenu+":nth-child("+countclick+") > span");
                                    this.echo("[status] Click menu : "+btnName);
                                    this.captureSelector(path+"/"+section+"/"+filename+countlen+"_"+countclick+".png",listchartbox);
                                    this.echo("[status] then click and Save capture :"+path+"/"+section+"/"+btnName+".png",listchartbox);
                                    countclick++;
                                });
                            });
                        });
                    }else{
                        this.echo("[status] Not found button");
                    };
                };
            countlen++;
            });
        });
    });
}

casper.run();