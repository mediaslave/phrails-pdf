<?php

namespace net\mediaslave\pdf\lib;

error_reporting(E_ERROR);
require_once(__DIR__ . '/html2ps/config.inc.php');
require_once(HTML2PS_DIR . 'pipeline.factory.class.php');

require_once(HTML2PS_DIR.'fetcher.url.class.php');
require_once('MemoryDestination.php');

@set_time_limit(0);
parse_config_file(HTML2PS_DIR.'html2ps.config');




class UriPdf{
	
	private $html;
	
	function __construct($html) {
		$this->html = $html;
	}
	
	/**
	 * process
	 *
	 * @return void
	 * @author Justin Palmer
	 **/
	public function process()
	{
		$pipeline = \PipelineFactory::create_default_pipeline('', // Attempt to auto-detect encoding
		                                                       '');

		  // Override HTML source 
		  // @TODO: default http fetcher will return null on incorrect images 
		  // Bug submitted by 'imatronix' (tufat.com forum).
		  $pipeline->fetchers[] = new \FetcherURL();

		  // Override destination to local file
		  $pipeline->destination = new MemoryDestination('');

		  $baseurl = '';
		  $media = \Media::predefined('Letter');
		  $media->set_landscape(false);
		  $media->set_margins(array('left'   => 0,
		                            'right'  => 0,
		                            'top'    => 0,
		                            'bottom' => 0));
		  $media->set_pixels(1024); 

		  global $g_config;
		  $g_config = array(
		                    'cssmedia'     => 'screen',
		                    'scalepoints'  => '1',
		                    'renderimages' => true,
		                    'renderlinks'  => false,
		                    'renderfields' => false,
		                    'renderforms'  => false,
		                    'mode'         => 'html',
							'method'	   => 'fpdf',
		                    'encoding'     => '',
		                    'debugbox'     => false,
		                    'pdfversion'    => '1.4',
		                    'draw_page_border' => false
		                    );

		  $pipeline->configure($g_config);
		  $pipeline->process($this->html, $media);
		return $pipeline->output;
	}
	
}