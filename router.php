<?php	
	$path = isset($_GET['path']) ? $_GET['path'] : '';
	$parts = array_filter(explode('/', $path));
	
	// Check if there are more than 2 parts in the URL
	if (count($parts) > 2) {
	    include "404.php";
	    exit;
	}

	// Construct the file path
	if (count($parts) == 1) {
	    $file = __DIR__ . '/pages/' . $parts[0] . '.php';
	} elseif (count($parts) == 2) {
	    $file = __DIR__ . '/pages/' . $parts[0] . '/' . $parts[1] . '.php';
	} else {
	    $file = "404.php"; // default to 404 if no parts
	}

	// Load the appropriate file or the 404
	if (file_exists($file)) {
	    include $file;
	} else {
	    include "404.php";
	}
?>