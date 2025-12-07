<?php	
	//include_once $_SERVER["DOCUMENT_ROOT"].'/config/dbconnect.php';
	include_once $_SERVER["DOCUMENT_ROOT"].'/config/settings.php';
	include_once $_SERVER["DOCUMENT_ROOT"].'/config/logincheck.php';
?>
<!doctype html>
<html lang="sl-SI">
<head>
	<title>Pregled</title>
	<?php include_once $_SERVER["DOCUMENT_ROOT"].'/view/global/main-header.php'; ?>
	
	<?= smart_css('/styles/css/pregled/pregled.css') ?>
	<?= smart_js('/styles/js/pregled/pregled.js', 'defer') ?> 
</head>
<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"].'/view/global/main-menu.php'; ?>
	<div id="mainscreen">		
		<?php
			include_once $_SERVER["DOCUMENT_ROOT"].'/view/pregled/pregled.php';
			
		?>
	</div>
	<?php include_once $_SERVER["DOCUMENT_ROOT"].'/view/global/main-footer.php'; ?>
</body>
</html>