<?php

	function __autoload($class_name) 
	{
	    $filename = str_replace('_', DIRECTORY_SEPARATOR, 'components_'.strtolower($class_name)).'.spark.php';

	    $file = get_template_directory().'/'.$filename;
	    

	    if ( ! file_exists($file))
	    {
	        return FALSE;
	    }
	    include $file;
	}

	spl_autoload_register('__autoload');

	$sparkTheme = new Theme_Theme();

?>