<?php
use PhpOffice\PhpPowerpoint\Autoloader;
use PhpOffice\PhpPowerpoint\Settings;
use PhpOffice\PhpPowerpoint\IOFactory;
use PhpOffice\PhpPowerpoint\PhpPowerpoint;
use PhpOffice\PhpPowerpoint\Style\Alignment;
use PhpOffice\PhpPowerpoint\Style\Color;

require_once 'AcerReport.php';

$LEFT = Alignment::HORIZONTAL_LEFT;
$CENTER = Alignment::HORIZONTAL_CENTER;
$RIGHT = Alignment::HORIZONTAL_RIGHT;

//variable of Cover Page
$month = 'xxxxxxxxxxx';
$year = 'xxxx';

//variable of Excutive Page
$like = 'xxxx';
$engagement = 'xxxx';
$reach = 'xxxx';

//variable of Facebook Statistics Page Like Comments And Shared (Like)
$FacebookStatisticsLike_average = 'xxxx';
$facebookStatisticsLike_percentage = 'xxxx';
$facebookStatisticsLike_rate = 'xxxx';

//variable of Facebook Statistics Page Like Comments And Shared (Comments)
$FacebookStatisticsComments_average = 'xxxx';
$facebookStatisticsComments_percentage = 'xxxx';
$facebookStatisticsComments_rate = 'xxxx';

//variable of Facebook Statistics Page Like Comments And Shared (Shared)
$FacebookStatisticsShared_average = 'xxxx';
$facebookStatisticsShared_percentage = 'xxxx';
$facebookStatisticsShared_rate = 'xxxx';

//variable of Facebook Statistics Page Total Reach
$FacebookStatisticsTotalReach_average = 'xxxx';
$facebookStatisticsTotalReach_percentage = 'xxxx';
$facebookStatisticsTotalReach_rate = 'xxxx';

$FacebookStatisticsTotalReachPaid_average = 'xxxx';
$facebookStatisticsTotalReachPaid_percentage = 'xxxx';
$facebookStatisticsTotalReachPaid_rate = 'xxxx';

//variable of Facebook Statistics Page Your Fans
$womenYourFans = 'xxxx';
$menYourFans = 'xxxx';
$phaseYourFans = 'xxxx';
$addressYourFans = 'xxxx';

//variable of Facebook Statistics Page People Reached
$womenPeopleReached = 'xxxx';
$menPeopleReached = 'xxxx';
$phasePeopleReached = 'xxxx';
$addressPeopleReached = 'xxxx';

//variable of Facebook Statistics Page People Engagement
$womenPeopleEngagement = 'xxxx';
$menPeopleEngagement = 'xxxx';
$phasePeopleEngagement_first = 'xxxx';
$phasePeopleEngagement_last = 'xxxx';
$addressPeopleEngagement = 'xxxx';

//variable Facebook Statistics Page When Your Fans Are Online
$timeFirst = 'xxxx';
$timeMid = 'xxxx';
$timeLast = 'xxxx';

//variable Facebook Statistics Page Post Type
$type = 'xxxx';

//variable Facebook Statistics Page Acer Activity
$dateActivity = 'xxxx';
$monthActivity = 'xxxx';
$yearActivity = 'xxxx';
$peopleActivity = 'xxxx';

//variable Twitter Statistics Page Followers
$twitterStatisticsFollowers_rate = 'xxxx';
$twitterStatisticsFollowers_average = 'xxxx';

$acerSocialMediaSummaryReport = new acerReport();

//create Cover Page
$coverPage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genAcerLogo($coverPage);
$acerSocialMediaSummaryReport->genImage($coverPage,'image/acer/facebookAndTwitterLogoCover.png','170','170','750','80');
$acerSocialMediaSummaryReport->genText($coverPage,'Social Media Summary','36','50','500','450','300','669900');
$acerSocialMediaSummaryReport->genText($coverPage,'Monthly Report on '.$month.' '.$year,'18','50','500','550','380');
$acerSocialMediaSummaryReport->genBodyImageFirst_LastPage($coverPage);
$acerSocialMediaSummaryReport->genFooter($coverPage);

//create Agenda Page
$agendaPage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaPage);
$acerSocialMediaSummaryReport->genText($agendaPage,'Agenda','26','50','500','80','100','669900');
$acerSocialMediaSummaryReport->genText($agendaPage,'Facebook Statistics'."\n".
													'Twitter Statistics'."\n".
													'Acer4u Statistics'."\n".
													'Youtube Statistics'."\n".
													'Competitors Analysis'."\n".
													'Suggestion & Next Step','20','500','500','120','150');
$acerSocialMediaSummaryReport->genFooter($agendaPage);

//create Excutive Summary Page
$excutivePage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($excutivePage);
$acerSocialMediaSummaryReport->genText($excutivePage,'Executive Summary '."(".$month." ".$year.")",'26','50','700','80','100','669900');
$acerSocialMediaSummaryReport->genText($excutivePage,'1. Facebook Page Total New Likes '.$like."\n".
                                					 '2. Overall Facebook Engagement '.$engagement."\n".
                                					 '3. Overall Facebook Reach '.$reach."\n",'20','500','500','120','150');
$acerSocialMediaSummaryReport->genFooter($excutivePage);

//create Agenda Facebook Page
$agendaFacebookPage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genAcerLogo($agendaFacebookPage);
$acerSocialMediaSummaryReport->genImage($agendaFacebookPage,'image/acer/facebookLogoCover.png','220','220','750','0');
$acerSocialMediaSummaryReport->genImage($agendaFacebookPage,'image/acer/messageLogo.png','220','220','60','400');
$acerSocialMediaSummaryReport->genText($agendaFacebookPage,'Facebook','24','50','300','420','280');
$acerSocialMediaSummaryReport->genBodyImageOfTitle($agendaFacebookPage);

//create Facebook Statistics Page Acer Thailand
$facebookStatistics_acerThailand = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_acerThailand);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_acerThailand);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_acerThailand);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_acerThailand);

//create Facebook Statistics Page Total Like and Talking about
$facebookStatistics_totalLikeAndTalkingAbout = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_totalLikeAndTalkingAbout);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_totalLikeAndTalkingAbout);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_totalLikeAndTalkingAbout);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_totalLikeAndTalkingAbout);

//create Facebook Statistics Page Ads Facebook
$adsFacebook = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($adsFacebook);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($adsFacebook);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($adsFacebook,'Ads Facebook');
$acerSocialMediaSummaryReport->genFooter($adsFacebook);

//create Facebook Statistics Page Like Comments And Shared (Like)
$facebookStatistics_likeCommentAndShared_like = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_likeCommentAndShared_like);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_likeCommentAndShared_like);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_likeCommentAndShared_like);
$acerSocialMediaSummaryReport->genText($facebookStatistics_likeCommentAndShared_like,'จำนวน Engagement (Like on content) เฉลี่ยอยู่ที่ '.$FacebookStatisticsLike_average."\n".
																				$facebookStatisticsLike_rate.'จากช่วงที่ผ่านมา '.$facebookStatisticsLike_percentage.'%',
																				'24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_likeCommentAndShared_like);

//create Facebook Statistics Page Like Comments And Shared (Comments)
$facebookStatistics_likeCommentAndShared_comments = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_likeCommentAndShared_comments);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_likeCommentAndShared_comments);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_likeCommentAndShared_comments);
$acerSocialMediaSummaryReport->genText($facebookStatistics_likeCommentAndShared_comments,'จำนวน Engagement (Comments) เฉลี่ยอยู่ที่ '.$FacebookStatisticsComments_average."\n".
																				$facebookStatisticsComments_rate.'จากช่วงที่ผ่านมา '.$facebookStatisticsComments_percentage.'%',
																				'24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_likeCommentAndShared_comments);

//create Facebook Statistics Page Like Comments And Shared (Shared)
$facebookStatistics_likeCommentAndShared_shared = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_likeCommentAndShared_shared);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_likeCommentAndShared_shared);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_likeCommentAndShared_shared);
$acerSocialMediaSummaryReport->genText($facebookStatistics_likeCommentAndShared_shared,'จำนวน Engagement (Shared) เฉลี่ยอยู่ที่ '.$FacebookStatisticsShared_average."\n".
																				$facebookStatisticsShared_rate.'จากช่วงที่ผ่านมา '.$facebookStatisticsShared_percentage.'%',
																				'24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_likeCommentAndShared_shared);

//create Facebook Statistics Page Total Reach
$facebookStatistics_totalReach = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_totalReach);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_totalReach);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_totalReach);
$acerSocialMediaSummaryReport->genText($facebookStatistics_totalReach,'จำนวน Total Reach "Orgenic" เฉลี่ยอยู่ที่ '.$FacebookStatisticsTotalReach_average.' '.$facebookStatisticsTotalReach_rate.' '.$facebookStatisticsTotalReach_percentage.'%'."\n".
															'"Paid" เฉลี่ยอยู่ที่ '.$FacebookStatisticsTotalReachPaid_average.' '.$facebookStatisticsTotalReach_rate.' '.$facebookStatisticsTotalReach_percentage.'%',
															'24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_totalReach);

//create Facebook Statistics Page Your Fans
$facebookStatistics_yourFans = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_yourFans);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_yourFans);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_yourFans);
$acerSocialMediaSummaryReport->genText($facebookStatistics_yourFans,'Your Fans เป็น W:'.$womenYourFans.'%'.' / '.'M:'.$menYourFans.'% '.'ส่วนใหญ่ อายุ '.$phaseYourFans."\n".
																	'อยู่ที่ '.$addressYourFans,
																	'24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_yourFans);

//create Facebook Statistics Page People Reached
$facebookStatistics_peopleReached = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_peopleReached);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_peopleReached);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_peopleReached);
$acerSocialMediaSummaryReport->genText($facebookStatistics_peopleReached,'People Reached W:'.$womenPeopleReached.'%'.' / '.'M:'.$menPeopleReached.'% '.'ส่วนใหญ่ อายุ '.$phasePeopleReached."\n".
																	'ส่วนใหญ่มาจาก '.$addressPeopleReached,
																	'24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_peopleReached);

//create Facebook Statistics Page People Engaged
$facebookStatistics_peopleEngaged = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_peopleEngaged);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_peopleEngaged);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_peopleEngaged);
$acerSocialMediaSummaryReport->genText($facebookStatistics_peopleEngaged,'Engagement W:'.$womenPeopleEngagement.'%'.' / '.'M:'.$menPeopleEngagement.'% '.'กลุ่ม อายุ '.$phasePeopleEngagement_first.' และ อายุ '.$phasePeopleEngagement_last."\n".
																	'ส่วนใหญ่มาจาก '.$addressPeopleEngagement,
																	'24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_peopleEngaged);

//create Facebook Statistics Page When Your Fans Are Online
$facebookStatistics_whenYourFansAreOnline = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_whenYourFansAreOnline);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_whenYourFansAreOnline);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_whenYourFansAreOnline);
$acerSocialMediaSummaryReport->genText($facebookStatistics_whenYourFansAreOnline,'ช่วงเวลาที่เหมาะสมกับการโพสต์ Content','18','50','400','500','100','000000',$RIGHT);
$acerSocialMediaSummaryReport->genText($facebookStatistics_whenYourFansAreOnline,'เวลา '.$timeFirst.' น. ,'.$timeMid.' น. และ '.$timeLast.' น.','24','50','400','500','150','000000',$RIGHT);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_whenYourFansAreOnline);

//create Facebook Statistics Page Post Type
$facebookStatistics_postType = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_postType);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_postType);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_postType);
$acerSocialMediaSummaryReport->genText($facebookStatistics_postType,'Fan Page ยังคงให้ความสนใจ Content ประเภท '.$type.' ซึ่งคือการนำเสนอทั้งรูปแบบการ'."\n".
																	'เขียนภาพและประกอบที่สวยงาม','24','100','960','0','550','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_postType);

//create Facebook Statistics Page Acer Activity
$facebookStatistics_acerActivity = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_acerActivity);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_acerActivity);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_acerActivity);
$acerSocialMediaSummaryReport->genText($facebookStatistics_acerActivity,'Acer Activity','18','50','300','330','100','000000',$CENTER);
$acerSocialMediaSummaryReport->genText($facebookStatistics_acerActivity,'ระยะเวลากิจกรรม : '.$dateActivity.' '.$monthActivity.' '.$yearActivity."\n".
																		'จำนวนผู้เข้าร่วมกิจกรรม : '.$peopleActivity,'18','100','300','30','600');
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_acerActivity);

//create Facebook Statistics Page Post Reach One
$facebookStatistics_postReach_one = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_postReach_one);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_postReach_one);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_postReach_one);
$acerSocialMediaSummaryReport->genText($facebookStatistics_postReach_one,'Post Reach','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_postReach_one);

//create Highlight Content Page Post Reach One
$highlightContent_postReach_one = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($highlightContent_postReach_one);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($highlightContent_postReach_one);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($highlightContent_postReach_one,'Highlight Content');
$acerSocialMediaSummaryReport->genText($highlightContent_postReach_one,'Post Reach','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($highlightContent_postReach_one);

//create Facebook Statistics Page Post Reach Two
$facebookStatistics_postReach_two = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($facebookStatistics_postReach_two);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($facebookStatistics_postReach_two);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($facebookStatistics_postReach_two);
$acerSocialMediaSummaryReport->genText($facebookStatistics_postReach_two,'Post Reach','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($facebookStatistics_postReach_two);

//create Highlight Content Page Post Reach Two
$highlightContent_postReach_two = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($highlightContent_postReach_two);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($highlightContent_postReach_two);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($highlightContent_postReach_two,'Highlight Content');
$acerSocialMediaSummaryReport->genText($highlightContent_postReach_two,'Post Reach','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($highlightContent_postReach_two);

//create Highlight Content Page Product
$highlightContent_product = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($highlightContent_product);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($highlightContent_product);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($highlightContent_product,'Highlight Content');
$acerSocialMediaSummaryReport->genText($highlightContent_product,'Product','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($highlightContent_product);

//create Highlight Content Page Promotion
$highlightContent_promotion = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($highlightContent_promotion);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($highlightContent_promotion);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($highlightContent_promotion,'Highlight Content');
$acerSocialMediaSummaryReport->genText($highlightContent_promotion,'Promotion','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($highlightContent_promotion);

//create Highlight Content Page Lifestyle Gadget
$highlightContent_lifeStyle = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($highlightContent_lifeStyle);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($highlightContent_lifeStyle);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($highlightContent_lifeStyle,'Highlight Content');
$acerSocialMediaSummaryReport->genText($highlightContent_lifeStyle,'Lifestyle/Gadget','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($highlightContent_lifeStyle);

//create Highlight Content Page Review
$highlightContent_review = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($highlightContent_review);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($highlightContent_review);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($highlightContent_review,'Highlight Content');
$acerSocialMediaSummaryReport->genText($highlightContent_review,'Review','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($highlightContent_review);

//create Highlight Content Page Tip And Tricks
$highlightContent_tipAndTricks = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($highlightContent_tipAndTricks);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($highlightContent_tipAndTricks);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($highlightContent_tipAndTricks,'Highlight Content');
$acerSocialMediaSummaryReport->genText($highlightContent_tipAndTricks,'Tip & Tricks','18','50','200','700','18','000000',$CENTER);
$acerSocialMediaSummaryReport->genFooter($highlightContent_tipAndTricks);

//create Agenda Twitter Page
$agendaTwitterPage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genAcerLogo($agendaTwitterPage);
$acerSocialMediaSummaryReport->genImage($agendaTwitterPage,'image/acer/textTwitterCover.jpg','300','400','500','100');
$acerSocialMediaSummaryReport->genImage($agendaTwitterPage,'image/acer/twitterLogoCover.jpg','500','500','40','200');
$acerSocialMediaSummaryReport->genBodyImageOfTitle($agendaTwitterPage);

//create Twitter Statistics Page Followers
$twitterStatistics_followers = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($twitterStatistics_followers);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($twitterStatistics_followers,'image/acer/twitterStatistics.png');
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($twitterStatistics_followers,'Twitter Statistics');
$acerSocialMediaSummaryReport->genText($twitterStatistics_followers,'ยอด Followers เฉลี่ย'.$twitterStatisticsFollowers_rate.' '.$twitterStatisticsFollowers_average.'%','18','50','400','600','150');
$acerSocialMediaSummaryReport->genFooter($twitterStatistics_followers);

//create Twitter Statistics Page Acer Thailand
$twitterStatistics_acerThailand = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($twitterStatistics_acerThailand);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($twitterStatistics_acerThailand,'image/acer/twitterStatistics.png');
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($twitterStatistics_acerThailand,'Twitter Statistics');
$acerSocialMediaSummaryReport->genFooter($twitterStatistics_acerThailand);

//create Twitter Statistics Most Popular Like
$twitterStatistics_mostPopularLike = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($twitterStatistics_mostPopularLike);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($twitterStatistics_mostPopularLike,'image/acer/twitterStatistics.png');
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($twitterStatistics_mostPopularLike,'Twitter Statistics');
$acerSocialMediaSummaryReport->genFooter($twitterStatistics_mostPopularLike);

//create Agenda Acer 4 You Page
$agendaAcer4YouPage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genAcerLogo($agendaAcer4YouPage);
$acerSocialMediaSummaryReport->genText($agendaAcer4YouPage,'www.acer4u.co.th','30','50','400','300','330');
$acerSocialMediaSummaryReport->genBodyImageOfTitle($agendaAcer4YouPage);

//create Acer 4 You Page Latest Updates
$agendaAcer4YouPage_latestUpdate = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaAcer4YouPage_latestUpdate);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaAcer4YouPage_latestUpdate,'Acer4U Latest Updates');

//create Acer 4 You Page News And Review
$agendaAcer4YouPage_newsAndReview = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaAcer4YouPage_newsAndReview);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaAcer4YouPage_newsAndReview,'Acer4U News & Review');

//create Acer 4 You Page Promotions
$agendaAcer4YouPage_promotions = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaAcer4YouPage_promotions);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaAcer4YouPage_promotions,'Acer4U Promotions');

//create Acer 4 You Statistics Page 
$agendaAcer4YouPageStatistics = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaAcer4YouPageStatistics);
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaAcer4YouPageStatistics,'Acer4U Statistics');
$acerSocialMediaSummaryReport->genFooter($agendaAcer4YouPageStatistics);

//create Agenda Youtube Page
$agendaYoutubePage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genAcerLogo($agendaYoutubePage);
$acerSocialMediaSummaryReport->genImage($agendaYoutubePage,'image/acer/youtubeLogo.png','250','350','270','230');
$acerSocialMediaSummaryReport->genBodyImageOfTitle($agendaYoutubePage);

//create Youtube Statistics Page One
$agendaYoutubePageStatistics_channel_one = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaYoutubePageStatistics_channel_one);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($agendaYoutubePageStatistics_channel_one,'image/acer/youtubeStatistics.png');
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaYoutubePageStatistics_channel_one,'Youtube Statistics');
$acerSocialMediaSummaryReport->genText($agendaYoutubePageStatistics_channel_one,'Youtube Channel Video','18','50','300','30','80');
$acerSocialMediaSummaryReport->genFooter($agendaYoutubePageStatistics_channel_one);

//create Youtube Statistics Page Two
$agendaYoutubePageStatistics_channel_two = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaYoutubePageStatistics_channel_two);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($agendaYoutubePageStatistics_channel_two,'image/acer/youtubeStatistics.png');
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaYoutubePageStatistics_channel_two,'Youtube Statistics');
$acerSocialMediaSummaryReport->genText($agendaYoutubePageStatistics_channel_two,'Youtube Channel Video','18','50','300','30','80');
$acerSocialMediaSummaryReport->genFooter($agendaYoutubePageStatistics_channel_two);

//create Youtube Statistics Page People See One
$agendaYoutubePageStatistics_peopleSee_one = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaYoutubePageStatistics_peopleSee_one);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($agendaYoutubePageStatistics_peopleSee_one,'image/acer/youtubeStatistics.png');
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaYoutubePageStatistics_peopleSee_one,'Youtube Statistics');
$acerSocialMediaSummaryReport->genFooter($agendaYoutubePageStatistics_peopleSee_one);

//create Youtube Statistics Page People See Two
$agendaYoutubePageStatistics_peopleSee_two = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($agendaYoutubePageStatistics_peopleSee_two);
$acerSocialMediaSummaryReport->genLogoFacebookStatistics($agendaYoutubePageStatistics_peopleSee_two,'image/acer/youtubeStatistics.png');
$acerSocialMediaSummaryReport->genTextOnTopPageFaceBookStatistics($agendaYoutubePageStatistics_peopleSee_two,'Youtube Statistics');
$acerSocialMediaSummaryReport->genFooter($agendaYoutubePageStatistics_peopleSee_two);

//create Competitors Analysis Page
$competitorsAnalysis = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genAcerLogo($competitorsAnalysis);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis,'image/acer/competitorsAnalysisSamsungMobile.png','50','100','30','200');
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis,'image/acer/competitorsAnalysisLennovo_white.png','60','100','150','200');
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis,'image/acer/competitorsAllbrand.png','250','550','30','250');
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis,'image/acer/competitorsAnalysisLennovo_black.jpg','80','80','260','260');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis,'Competitors Analysis','36','100','500','30','400','669900');
$acerSocialMediaSummaryReport->genBodyImageOfTitle($competitorsAnalysis);

//create Competitors Analysis Page brand
$competitorsAnalysis_brand = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brand);
$acerSocialMediaSummaryReport->genFooter($competitorsAnalysis_brand);

//create Competitors Analysis Page brand Asus
$competitorsAnalysis_brandAsus = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brandAsus);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis_brandAsus,'image/acer/competitorsAsus.png','100','100','40','70');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis_brandAsus,'Lifestyle, Product, Promotion : Zenfone, Fonepad7','18','50','600','170','70');

//create Competitors Analysis Page brand Dell
$competitorsAnalysis_brandDell = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brandDell);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis_brandDell,'image/acer/competitorsDell.png','100','100','40','70');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis_brandDell,'Promotion, Activity, Product','18','50','600','170','70');

//create Competitors Analysis Page brand HP
$competitorsAnalysis_brandHP = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brandHP);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis_brandHP,'image/acer/competitorsHP.png','100','100','40','70');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis_brandHP,'Product, Activities','18','50','600','170','70');

//create Competitors Analysis Page brand Lenovo White
$competitorsAnalysis_brandLenovoWhite = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brandLenovoWhite);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis_brandLenovoWhite,'image/acer/competitorsLenovo_white.png','100','100','40','70');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis_brandLenovoWhite,'[Lenovo Lover]Activities : Lenovo Yoga','18','50','600','170','70');

//create Competitors Analysis Page brand Lenovo Black
$competitorsAnalysis_brandLenovoBlack = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brandLenovoBlack);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis_brandLenovoBlack,'image/acer/competitorsLenovo_black.jpg','100','100','40','70');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis_brandLenovoBlack,'[Lenovo Mobile Thailand]'."\n".'Products','18','50','600','170','70');

//create Competitors Analysis Page brand Samsung
$competitorsAnalysis_brandSamsung = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brandSamsung);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis_brandSamsung,'image/acer/competitorsSamsung.png','100','100','40','70');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis_brandSamsung,'Product, Activity, Lifestyle','18','50','600','170','70');

//create Competitors Analysis Page brand Samsung Mobile
$competitorsAnalysis_brandSamsungMobile = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($competitorsAnalysis_brandSamsungMobile);
$acerSocialMediaSummaryReport->genImage($competitorsAnalysis_brandSamsungMobile,'image/acer/competitorsSamsungMobile.png','100','100','40','70');
$acerSocialMediaSummaryReport->genText($competitorsAnalysis_brandSamsungMobile,'[Samsung Mobile Thailand] Product,'."\n".'Promotion, Lifestyle, Activity','18','50','600','170','70');

//create Suggestions And Next Step Page
$suggestionsPage = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genAcerLogo($suggestionsPage);
$acerSocialMediaSummaryReport->genText($suggestionsPage,'Suggestions & Next Step','36','100','600','200','280');
$acerSocialMediaSummaryReport->genBodyImageOfTitle($suggestionsPage);

//create Next Step Page
$nextStep = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($nextStep);
$acerSocialMediaSummaryReport->genText($nextStep,'1. Lifestyle Product Photos increase engagements as expected. Therefore, we should continue and create more of such contents.'."\n".
												'2. Optimize Facebook Ads to generate more new likes'."\n".
												'3. Create Facebook Activities  to generate more Engagement','22','500','800','50','100');

//create Thank You Page
$thankYou = $acerSocialMediaSummaryReport->genPage();
$acerSocialMediaSummaryReport->genHeader($thankYou);
$acerSocialMediaSummaryReport->genText($thankYou,'Thank You','72','300','960','0','300','669900',$CENTER);
$acerSocialMediaSummaryReport->genBodyImageFirst_LastPage($thankYou);

$acerSocialMediaSummaryReport->saveFile('acerSocialMediaSummaryReport');
?>