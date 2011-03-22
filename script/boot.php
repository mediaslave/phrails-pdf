<?php
//Register the autoload function for the command line scripts
spl_autoload_register('cmd_autoload');
//Boot up the framework.
include __DIR__ . '/../config/boot.php';
//Include the migrations folder.
add_include_directory(__DIR__ . '/../db/migrations');
//Register the autoload for migrations.
function cmd_autoload($class_name){
	$file = $class_name . '.migration.php';
	$included = @include_once($file);
}
