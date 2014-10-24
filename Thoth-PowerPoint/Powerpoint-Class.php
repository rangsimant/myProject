<?php
require_once 'src/PhpPowerpoint/Autoloader.php';
\PhpOffice\PhpPowerpoint\Autoloader::register();
use PhpOffice\PhpPowerpoint\PhpPowerpoint;
use PhpOffice\PhpPowerpoint\IOFactory;
use PhpOffice\PhpPowerpoint\Style\Alignment;
use PhpOffice\PhpPowerpoint\Style\Color;
use PhpOffice\PhpPowerpoint\Style\Fill;
use PhpOffice\PhpPowerpoint\Style\Shadow;
use PhpOffice\PhpPowerpoint\Style\Border;
/**
* 
*/
class Powerpoint_Base
{
	private $objPHPPowerPoint;
	private $slide;
	function __construct()
	{
		$this->objPHPPowerPoint = new PhpPowerpoint();
		$this->objPHPPowerPoint->removeSlideByIndex(0);
	}

	public function New_Slide(){
		$this->slide = $this->objPHPPowerPoint->createSlide();
	}
	public function Centered_Text_FirstSlide($title='title Text',$subtitle='Subtitle Some Text'){
		$currentSlide = $this->objPHPPowerPoint->getActiveSlide();
		$shape = $currentSlide->createRichTextShape()
		      ->setHeight(300)
		      ->setWidth(600)
		      ->setOffsetX(170)
		      ->setOffsetY(220);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $shape->createTextRun($title);
		$textRun->getFont()->setBold(true)
		                   ->setSize(70)
		                   ->setColor( new Color( 'FFE06B20' ) );

		$shape = $currentSlide->createRichTextShape()
		      ->setHeight(300)
		      ->setWidth(600)
		      ->setOffsetX(170)
		      ->setOffsetY(350);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $shape->createTextRun($subtitle);
		$textRun->getFont()->setBold(false)
		                   ->setSize(40)
		                   ->setColor( new Color( 'FFE06B20' ) );
	}

	public function Image_FirstPage(){

	}
	public function Centered_Text($title='title Text',$subtitle='Subtitle Some Text'){
		$shape = $this->slide->createRichTextShape()
		      ->setHeight(300)
		      ->setWidth(600)
		      ->setOffsetX(170)
		      ->setOffsetY(220);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $shape->createTextRun($title);
		$textRun->getFont()->setBold(true)
		                   ->setSize(70)
		                   ->setColor( new Color( 'FFE06B20' ) );

		$shape = $this->slide->createRichTextShape()
		      ->setHeight(300)
		      ->setWidth(600)
		      ->setOffsetX(170)
		      ->setOffsetY(350);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $shape->createTextRun($subtitle);
		$textRun->getFont()->setBold(false)
		                   ->setSize(40)
		                   ->setColor( new Color( 'FFE06B20' ) );
	}

	public function Custom_Text($text='Write some text.',$size=20,$color='0000',$height=100,$width=900,$x=0,$y=0,$horizontal=Alignment::HORIZONTAL_LEFT){
		$shape = $this->slide->createRichTextShape()
		      ->setHeight($height)
		      ->setWidth($width)
		      ->setOffsetX($x)
		      ->setOffsetY($y);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal( $horizontal );
		$textRun = $shape->createTextRun($text);
		$textRun->getFont()->setBold(false)
		                   ->setSize($size)
		                   ->setColor( new Color( $color ) );
	}

	public function Custom_Image($path="",$height="100",$x="0",$y="0",$name="name",$descrip="descrip",$shadow_visible=true,$shadow_distance="10"){
		$shape = $this->slide->createDrawingShape();
		$shape->setName($name)
		      ->setDescription($descrip)
		      ->setPath($path)
		      ->setHeight($height)
		      ->setOffsetX($x)
		      ->setOffsetY($y);
		$shape->getShadow()->setVisible($shadow_visible) // boolean
		                   ->setDirection(45)
		                   ->setDistance($shadow_distance);
	}
	public function Savefile_PowerPoint($filename){

		$oWriterODP = IOFactory::createWriter($this->objPHPPowerPoint, 'ODPresentation');
		$oWriterODP->save(__DIR__ . "/".$filename.".odp");
	}
}
?>