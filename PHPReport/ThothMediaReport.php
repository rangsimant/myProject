<?php
use PhpOffice\PhpPowerpoint\Autoloader;
use PhpOffice\PhpPowerpoint\Settings;
use PhpOffice\PhpPowerpoint\IOFactory;
use PhpOffice\PhpPowerpoint\PhpPowerpoint;
use PhpOffice\PhpPowerpoint\Style\Alignment;
use PhpOffice\PhpPowerpoint\Style\Color;

require_once 'PHPPowerPoint-master/src/PhpPowerpoint/Autoloader.php';
\PhpOffice\PhpPowerpoint\Autoloader::register();
/**
* 
*/
class thothMediaReport 
{
	private $objPHPPowerPoint;

	function __construct(){
		$this->objPHPPowerPoint = new PhpPowerpoint();
		$this->objPHPPowerPoint->removeSlideByIndex(0);
	}

	public function genPage(){

		$slide = $this->objPHPPowerPoint->createSlide();
		return $slide;
	}

	public function genHeader($slide,$path='imageDefault/header/logoHeader.jpg',$height=80,$width=64,$offsetX=0,$offsetY=0){

		$shape = $slide->createDrawingShape();
		$shape->setName('ImageHeader')
      		->setDescription('This image Header')
     		->setPath($path)
     		->setHeight($height)
      		->setWidth($width)
      		->setOffsetX($offsetX)
      		->setOffsetY($offsetY);
	}

	public function genText($slide,$text='ThothMediaReport',$size=20,$height=50,$width=300,$offsetX=300,$offsetY=300,$color=000000,$honrizotal=Alignment::HORIZONTAL_LEFT){

		$shape = $slide->createRichTextShape()
      		->setHeight($height)
      		->setWidth($width)
      		->setOffsetX($offsetX)
      		->setOffsetY($offsetY);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal($honrizotal);
		$textRun = $shape->createTextRun($text);
		$textRun->getFont()->setSize($size)
                ->setColor( new Color($color) );
	}

	public function genImage($slide,$path='imageDefault/body/logoBody.jpg',$height=80,$width=64,$offsetX=300,$offsetY=300){

		$shape = $slide->createDrawingShape();
		$shape->setName('ImageHeader')
      		->setDescription('This image Header')
     		->setPath($path)
     		->setHeight($height)
      		->setWidth($width)
      		->setOffsetX($offsetX)
      		->setOffsetY($offsetY);
	}

	public function genFooter($slide,$text='Confidential and All Rights Reserved. Thoth Media Co.,Ltd.',$size=20,$height=50,$width=800,$offsetX=100,$offsetY=670,$color=000000,$honrizotal=Alignment::HORIZONTAL_CENTER){

		$shape = $slide->createRichTextShape()
      		->setHeight($height)
      		->setWidth($width)
      		->setOffsetX($offsetX)
      		->setOffsetY($offsetY);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal($honrizotal);
		$textRun = $shape->createTextRun($text);
		$textRun->getFont()->setSize($size)
                ->setColor( new Color($color) );
	}

	public function saveFile($name="Thothmedia"){

		$oWriterPPTX = IOFactory::createWriter($this->objPHPPowerPoint, 'PowerPoint2007');
		$oWriterPPTX->save(__DIR__ . "/$name.pptx");
	}
}

?>