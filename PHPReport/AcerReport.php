<?php
use PhpOffice\PhpPowerpoint\Autoloader;
use PhpOffice\PhpPowerpoint\Settings;
use PhpOffice\PhpPowerpoint\IOFactory;
use PhpOffice\PhpPowerpoint\PhpPowerpoint;
use PhpOffice\PhpPowerpoint\Style\Alignment;
use PhpOffice\PhpPowerpoint\Style\Color;
require_once 'ThothMediaReport.php';

/**
* 
*/
class acerReport extends thothMediaReport{

	public function genHeader($slide,$path='image/acer/headerFacebookStatistics.png',$height=150,$width=960,$offsetX=0,$offsetY=5){

		$shape = $slide->createDrawingShape();
		$shape->setName('ImageHeader')
      		->setDescription('This image Header Of Statistic Page')
     		->setPath($path)
     		->setHeight($height)
      		->setWidth($width)
      		->setOffsetX($offsetX)
      		->setOffsetY($offsetY);
	}

	public function genText($slide,$text='AcerReport',$size=20,$height=50,$width=300,$offsetX=300,$offsetY=300,$color=000000,$honrizotal=Alignment::HORIZONTAL_LEFT){

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

	public function genImage($slide,$path='image/acer/bodyImageOfTitlePage.png',$height=80,$width=64,$offsetX=300,$offsetY=300){

		$shape = $slide->createDrawingShape();
		$shape->setName('ImageHeader')
      		->setDescription('This image Header')
     		->setPath($path)
     		->setHeight($height)
      		->setWidth($width)
      		->setOffsetX($offsetX)
      		->setOffsetY($offsetY);
	}

	public function genFooter($slide,$text='Confidential and All Rights Reserved. Thoth Media Co.,Ltd.',$size=10,$height=30,$width=960,$offsetX=0,$offsetY=690,$color=000000,$honrizotal=Alignment::HORIZONTAL_CENTER){

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

  public function genAcerLogo($slide,$path='image/acer/acerLogo.png',$height=220,$width=220,$offsetX=30,$offsetY=100){

    $shape = $slide->createDrawingShape();
    $shape->setName('Acer Logo')
          ->setDescription('This image Acer Logo')
        ->setPath($path)
        ->setHeight($height)
          ->setWidth($width)
          ->setOffsetX($offsetX)
          ->setOffsetY($offsetY);
  }

  public function genBodyImageFirst_LastPage($slide,$path='image/acer/bodyImageFirst-LastPage.png',$height=300,$width=960,$offsetX=0,$offsetY=455){

    $shape = $slide->createDrawingShape();
    $shape->setName('Body Image Frist and Last Page')
          ->setDescription('This Image Frist and Last Page')
        ->setPath($path)
        ->setHeight($height)
          ->setWidth($width)
          ->setOffsetX($offsetX)
          ->setOffsetY($offsetY);
  }

  public function genBodyImageOfTitle($slide,$path='image/acer/bodyImageOfTitlePage.png',$height=300,$width=960,$offsetX=0,$offsetY=207){

    $shape = $slide->createDrawingShape();
    $shape->setName('Body Image Of Title Page')
          ->setDescription('This Image Of Title Page')
        ->setPath($path)
        ->setHeight($height)
          ->setWidth($width)
          ->setOffsetX($offsetX)
          ->setOffsetY($offsetY);
  }

  public function genLogoFacebookStatistics($slide,$path='image/acer/facebookLogoStatistics.png',$height=50,$width=50,$offsetX=150,$offsetY=5){

    $shape = $slide->createDrawingShape();
    $shape->setName('Body Image Of Facebook Statistic')
          ->setDescription('This Image Of Facebook Statistic')
        ->setPath($path)
        ->setHeight($height)
          ->setWidth($width)
          ->setOffsetX($offsetX)
          ->setOffsetY($offsetY);
  }

  public function genTextOnTopPageFaceBookStatistics($slide,$text='Facebook Statistics',$size=24,$height=50,$width=500,$offsetX=200,$offsetY=13,$color=000000,$honrizotal=Alignment::HORIZONTAL_LEFT){

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
}

?>