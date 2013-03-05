<?
$dirname = __DIR__;
//Include all of the folders that need to be included to run the plugin.

spl_autoload_register('pdf_autoload', true, true);

function pdf_autoload($class_name){
	$ns = 'net\\mediaslave\\pdf\\';

	$class_parts = explode('\\', $class_name);

	$class_name = array_pop($class_parts);

	$cpi = implode('\\', $class_parts);
	$cpi =	str_replace($ns, '', $cpi);
	$class = strtolower(preg_replace('%\\\\-%', '\\', preg_replace('/([^\s])([A-Z])/', '\1-\2', $cpi)));
	$file =  '/' . str_replace('\\', '/', $class) . '/' . $class_name . '.php' ;

	if(file_exists(__DIR__ . $file)) {
		require_once(__DIR__ . $file);
	}
}


//include($dirname . '/config/environment.php');
Template::registerView('pdf', new net\mediaslave\pdf\lib\WkPdfView);
