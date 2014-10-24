<?php
require_once 'header.php';
use PhpOffice\PhpPowerpoint\PhpPowerpoint;
use PhpOffice\PhpPowerpoint\IOFactory;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Bar3D;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Line;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Pie3D;
use PhpOffice\PhpPowerpoint\Shape\Chart\Type\Scatter;
use PhpOffice\PhpPowerpoint\Shape\Chart\Series;
use PhpOffice\PhpPowerpoint\Shape\Chart\Axis;
use PhpOffice\PhpPowerpoint\Shape\Chart\PlotArea;
use PhpOffice\PhpPowerpoint\Shape\Chart\Title;
use PhpOffice\PhpPowerpoint\Style\Alignment;
use PhpOffice\PhpPowerpoint\Style\Color;
use PhpOffice\PhpPowerpoint\Style\Fill;
use PhpOffice\PhpPowerpoint\Style\Shadow;
use PhpOffice\PhpPowerpoint\Style\Border;
/**
* 
*/
class Template1
{
	private $objPHPPowerPoint;
	private $slide;
	function __construct()
	{
		$this->objPHPPowerPoint = new PhpPowerpoint();
	}

	public function FirstSlide($title,$subtitle){
		$this->objPHPPowerPoint->getProperties()->setCreator('PHPOffice')
                          ->setLastModifiedBy('it-thothmedia Team')
                          ->setTitle($title)
                          ->setSubject($subtitle)
                          ->setDescription('Sample 01 Description')
                          ->setKeywords('office 2007 openxml libreoffice odt php')
                          ->setCategory('Sample Category');
	}

	public function Centered_Text($header,$subheader){
		$currentSlide = $this->objPHPPowerPoint->getActiveSlide();
		$shape = $currentSlide->createRichTextShape()
		      ->setHeight(300)
		      ->setWidth(600)
		      ->setOffsetX(170)
		      ->setOffsetY(220);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $shape->createTextRun($header);
		$textRun->getFont()->setBold(true)
		                   ->setSize(70)
		                   ->setColor( new Color( 'FFE06B20' ) );

		$shape = $currentSlide->createRichTextShape()
		      ->setHeight(300)
		      ->setWidth(600)
		      ->setOffsetX(170)
		      ->setOffsetY(350);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $shape->createTextRun($subheader);
		$textRun->getFont()->setBold(false)
		                   ->setSize(40)
		                   ->setColor( new Color( 'FFE06B20' ) );
	}

	public function Blank_Slide(){
		$this->slide = $this->objPHPPowerPoint->createSlide();
	}

	public function Title_Slide($header,$text){
		$shape = $this->slide->createRichTextShape()
		      ->setHeight(300)
		      ->setWidth(950)
		      ->setOffsetX(5)
		      ->setOffsetY(50);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $shape->createTextRun($header);
		$textRun->getFont()->setBold(true)
		                   ->setSize(60)
		                   ->setColor( new Color( 'FFE06B20' ) );

		$shape = $this->slide->createRichTextShape()
				      ->setHeight(1000)
				      ->setWidth(950)
				      ->setOffsetX(5)
				      ->setOffsetY(220);
				$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
				$textRun = $shape->createTextRun($text);
				$textRun->getFont()->setBold(false)
				                   ->setSize(35)
				                   ->setColor( new Color( 'FFE06B20' ) );
	}

	public function Savefile_PowerPoint($filename){
		$oWriterPPTX = IOFactory::createWriter($this->objPHPPowerPoint, 'PowerPoint2007');
		$oWriterPPTX->save(__DIR__ . "/".$filename.".pptx");
		$oWriterODP = IOFactory::createWriter($this->objPHPPowerPoint, 'ODPresentation');
		$oWriterODP->save(__DIR__ . "/".$filename.".odp");
	}

	public function Pie_Chart(){
		$oFill = new Fill();
		$oFill->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('FFE06B20'));

		$oShadow = new Shadow();
		$oShadow->setVisible(true)->setDirection(45)->setDistance(10);
	
		$series1Data = array('Jan' => 133, 'Feb' => 99, 'Mar' => 191, 'Apr' => 205, 'May' => 167, 'Jun' => 201, 'Jul' => 240, 'Aug' => 226, 'Sep' => 255, 'Oct' => 264, 'Nov' => 283, 'Dec' => 293);
		$series2Data = array('Jan' => 266, 'Feb' => 198, 'Mar' => 271, 'Apr' => 305, 'May' => 267, 'Jun' => 301, 'Jul' => 340, 'Aug' => 326, 'Sep' => 344, 'Oct' => 364, 'Nov' => 383, 'Dec' => 379);

		$seriesData = array('Monday' => 12, 'Tuesday' => 15, 'Wednesday' => 13, 'Thursday' => 17, 'Friday' => 14, 'Saturday' => 9, 'Sunday' => 7);

		// Create a line chart (that should be inserted in a shape)

		$lineChart = new Line();
		$series = new Series('Downloads', $seriesData);
		$series->setShowSeriesName(true);
		$lineChart->addSeries($series);

		// Create a shape (chart)
		$shape = $this->slide->createChartShape();
		$shape->setName('PHPPowerPoint Daily Downloads')
		      ->setResizeProportional(false)
		      ->setHeight(550)
		      ->setWidth(700)
		      ->setOffsetX(120)
		      ->setOffsetY(80);
		      echo "<pre>";
		$shape->setShadow($oShadow);
		$shape->setFill($oFill);
		$shape->getBorder()->setLineStyle(Border::LINE_SINGLE);
		$shape->getTitle()->setText('PHPPowerPoint Daily Downloads');
		$shape->getTitle()->getFont()->setItalic(true);
		$shape->getPlotArea()->setType($lineChart);
		$shape->getView3D()->setRotationX(30);
		$shape->getView3D()->setPerspective(30);
		$shape->getLegend()->getBorder()->setLineStyle(Border::LINE_SINGLE);
		$shape->getLegend()->getFont()->setItalic(true);

		

	}
}
?>