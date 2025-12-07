<?php	
	//include_once $_SERVER["DOCUMENT_ROOT"].'/config/dbconnect.php';
	include_once $_SERVER["DOCUMENT_ROOT"].'/config/settings.php';
?>
<!doctype html>
<html lang="sl-SI">
<head>
	<title>Eksperiment 67-A</title>
	<?php include_once $_SERVER["DOCUMENT_ROOT"].'/view/global/main-header.php'; ?>
	
	<?= smart_css('/styles/css/naloga1/naloga1.css') ?>
	<?= smart_js('/styles/js/naloga1/naloga1.js', 'defer') ?> 
</head>
<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"].'/view/global/main-menu.php'; ?>
	<div id="mainscreen">		
		<?php
			include_once $_SERVER["DOCUMENT_ROOT"].'/view/naloga1/naloga1.php';
		?>
	</div>
	<?php include_once $_SERVER["DOCUMENT_ROOT"].'/view/global/main-footer.php'; ?>
</body>
</html>