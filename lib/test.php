<?php

/**
 * Thanks for JensE for providing the code of fetcher class
 */



/**
 * Runs the HTML->PDF conversion with default settings
 *
 * Warning: if you have any files (like CSS stylesheets and/or images referenced by this file,
 * use absolute links (like http://my.host/image.gif).
 *
 * @param $path_to_html String HTML code to be converted
 * @param $path_to_pdf  String path to file to save generated PDF to.
 * @param $base_path    String base path to use when resolving relative links in HTML code.
 */
function convert_to_pdf($html, $path_to_pdf, $base_path='') {
  
}

convert_to_pdf(file_get_contents('../temp/long.html'), '../out/test.pdf');

?>