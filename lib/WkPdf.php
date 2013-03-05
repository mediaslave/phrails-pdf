<?php

namespace net\mediaslave\pdf\lib;

/**
* 
*/
class WkPdf
{
	private $html;

	//out=>'-' means output to stdout
	private $args = array('imageQuality' => '100', 
					  	  'margin.top' => '.5cm', 
					  	  'margin.bottom' => '.5cm', 
					  	  'margin.left' => '.5cm', 
					  	  'margin.right' => '.5cm');


	function __construct($html, $args = array()) {
		$this->html = $html;
		$this->args = array_merge($this->args, $args);
	}

	/**
	 * process the view
	 *
	 * @return void
	 * @author Justin Palmer
	 **/
	public function process(){
		//put the file contents into the temp directory
		mt_srand(time());
		$path = '/tmp/' . sha1(microtime() . mt_rand()) . '.wkpdf';
		//Save the file to tmp
		file_put_contents($path . '.html', $this->html);

		$this->args['out'] = $path . '.pdf';
		//Convert it.
		//$converted = wkhtmltox_convert('pdf', $this->args, array(array('page' => $path . '.html')));
		$command = "wkhtmltopdf --image-quality 100 --margin-top '.5cm' --margin-right '.5cm' --margin-bottom '.5cm' --margin-left '.5cm' $path.html $path.pdf";

		$command = escapeshellcmd($command);
		`$command`;
		return file_get_contents("$path.pdf");
	}
}
