<?php

require_once 'PHPPowerPoint-master\src\PhpPowerpoint\Autoloader.php';
\PhpOffice\PhpPowerpoint\Autoloader::register();
use PhpOffice\PhpPowerpoint\PhpPowerpoint;
use PhpOffice\PhpPowerpoint\Style\Alignment;
use PhpOffice\PhpPowerpoint\Style\Color;
use PhpOffice\PhpPowerpoint\IOFactory;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Bar3D;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Line;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Pie3D;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Scatter;
use PhpOffice\PhpPowerpoint\Shape\Chart\Series;
use PhpOffice\PhpPowerpoint\Style\Border;
use PhpOffice\PhpPowerpoint\Style\Fill;
use PhpOffice\PhpPowerpoint\Style\Shadow;

$objPHPPowerPoint = new PhpPowerpoint();

$objPHPPowerPoint->getProperties()->setCreator('PHPOffice')
                                  ->setLastModifiedBy('PHPPowerPoint Team')
                                  ->setTitle('Sample 01 Title')
                                  ->setSubject('Sample 01 Subject')
                                  ->setDescription('Sample 01 Description')
                                  ->setKeywords('office 2007 openxml libreoffice odt php')
                                  ->setCategory('Sample Category');

// Create slide
$currentSlide = $objPHPPowerPoint->getActiveSlide();
$title = "Sprint #3";
$subtitle = "Poc-PHPPowerPoint";
FirstPage($currentSlide,$title,$subtitle);
newSlide($objPHPPowerPoint,$title,$subtitle);
graph($objPHPPowerPoint);


function graph($objPHPPowerPoint){
	$slide = $objPHPPowerPoint->createSlide();


	$oFill = new Fill();
	$oFill->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('FFE06B20'));

	$oShadow = new Shadow();
	$oShadow->setVisible(true)->setDirection(45)->setDistance(10);

	$series1Data = array('Jan' => 133000, 'Feb' => 99, 'Mar' => 1910, 'Apr' => 205, 'May' => 167, 'Jun' => 201, 'Jul' => 240, 'Aug' => 226, 'Sep' => 255, 'Oct' => 264, 'Nov' => 283, 'Dec' => 293);
	$series2Data = array('Jan' => 2660, 'Feb' => 1980, 'Mar' => 271, 'Apr' => 305, 'May' => 267, 'Jun' => 301, 'Jul' => 340, 'Aug' => 326, 'Sep' => 344, 'Oct' => 364, 'Nov' => 383, 'Dec' => 379);
	$bar3DChart = new Bar3D();
	$series1 = new Series('2009', $series1Data);
	$series1->setShowSeriesName(true);
	$series1->getFill()->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('FF4F81BD'));
	$series1->getFont()->getColor()->setRGB('00FF00');
	$series1->getDataPointFill(2)->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('FFE06B20'));
	$series2 = new Series('2010', $series2Data);
	$series2->setShowSeriesName(true);
	$series2->getFont()->getColor()->setRGB('FF0000');
	$series2->getFill()->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('FFC0504D'));
	$bar3DChart->addSeries($series1);
	$bar3DChart->addSeries($series2);

	$shape = $slide->createChartShape();
	$shape->setName('PHPPowerPoint Monthly Downloads')
	      ->setResizeProportional(false)
	      ->setHeight(550)
	      ->setWidth(700)
	      ->setOffsetX(120)
	      ->setOffsetY(80);
	$shape->setShadow($oShadow);
	$shape->setFill($oFill);
	$shape->getBorder()->setLineStyle(Border::LINE_SINGLE);
	$shape->getTitle()->setText('Test Chart');
	$shape->getTitle()->getFont()->setItalic(true);
	$shape->getTitle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
	$shape->getPlotArea()->getAxisX()->setTitle('Month');
	$shape->getPlotArea()->getAxisY()->setTitle('Downloads');
	$shape->getPlotArea()->setType($bar3DChart);
	$shape->getView3D()->setRightAngleAxes(true);
	$shape->getView3D()->setRotationX(20);
	$shape->getView3D()->setRotationY(20);
	$shape->getLegend()->getBorder()->setLineStyle(Border::LINE_SINGLE);
	$shape->getLegend()->getFont()->setItalic(true);
}

function newSlide($objPHPPowerPoint,$title,$subtitle){
	$slide = $objPHPPowerPoint->createSlide();

	$shape = $slide->createDrawingShape();
	$shape->setName('PHPPowerPoint logo')
	      ->setDescription('PHPPowerPoint logo')
	      ->setPath('resources/ig_2014-10-02 10.18.30_samsungcanada0.jpeg')
	      ->setHeight(400)
	      ->setOffsetX(280)
	      ->setOffsetY(20);
	$shape->getShadow()->setVisible(true)
	                   ->setDirection(45)
	                   ->setDistance(10);

	$shape = $slide->createRichTextShape();
	$shape->setHeight(200);
	$shape->setWidth(600);
	$shape->setOffsetX(50);
	$shape->setOffsetY(450);
	$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );

	$textRun = $shape->createTextRun('Introduction to');
	$textRun->getFont()->setBold(true);
	$textRun->getFont()->setSize(28);
	$textRun->getFont()->setColor(new Color( 'FFE06B20' ));

$shape->createBreak();
}

function FirstPage($currentSlide,$title,$subtitle){
	$shape = $currentSlide->createRichTextShape()
      ->setHeight(300)
      ->setWidth(600)
      ->setOffsetX(170)
      ->setOffsetY(180);
	$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
	$textRun = $shape->createTextRun($title);
	$textRun->getFont()->setBold(true)
	                   ->setSize(60)
	                   ->setColor( new Color( 'FFE06B20' ) );
	$shape = $currentSlide->createRichTextShape()
      ->setHeight(300)
      ->setWidth(600)
      ->setOffsetX(170)
      ->setOffsetY(280);
	$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
   	$textRun = $shape->createTextRun($subtitle);
	$textRun->getFont()->setBold(false)
	                   ->setSize(35)
	                   ->setColor( new Color( 'FFE06B20' ) );
}


// Create File PowerPoint //
$oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
$oWriterPPTX->save(__DIR__ . "/sample.pptx");
$oWriterODP = IOFactory::createWriter($objPHPPowerPoint, 'ODPresentation');
$oWriterODP->save(__DIR__ . "/sample.odp");
?>