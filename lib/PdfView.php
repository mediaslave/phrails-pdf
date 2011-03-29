<?php

namespace net\mediaslave\pdf\lib;

/**
* 
*/
class PdfView extends \View
{
	public $extension = 'pdf';
	/**
	 * process the view
	 *
	 * @return void
	 * @author Justin Palmer
	 **/
	public function process($content){
		$pdf = new Pdf($content);
		header('content-type:application/pdf');
		return $pdf->process();
	}
}
