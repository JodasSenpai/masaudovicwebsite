<?php
	session_start();
	include_once $_SERVER["DOCUMENT_ROOT"].'/controller/global/smart_asset.php';
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Maša Udovič</title>
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Css  -->
	<link href="/styles/css/index.css?ver=<?php echo date(format: "H:is"); ?>" rel="stylesheet">
	<!-- Javascript !-->
	<script src="/styles/js/jquery-3.7.1.min.js"></script>
	<!-- Favicon !-->
	<link rel="icon" href="/media/favicon.png" sizes="32x32" />
	<link rel="icon" href="/media/favicon.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="/media/favicon.png" />
	<meta name="msapplication-TileImage" content="/media/favicon.png" />

	<?= smart_js('/styles/js/index.js?v=1') ?>

</head>
<body>
	<div class="background-container">
		<div class="animated-bg"></div>
		<div class="floating-elements">
			<div class="floating-circle circle-1"></div>
			<div class="floating-circle circle-2"></div>
			<div class="floating-circle circle-3"></div>
			<div class="floating-circle circle-4"></div>
		</div>
	</div>
	
	<div class="center-container">
		<div class="safe-container">
			<div class="code-display">
				<div class="code-digit" id="code-digit-1">-</div>
				<div class="code-digit" id="code-digit-2">-</div>
				<div class="code-digit" id="code-digit-3">-</div>
				<div class="code-digit" id="code-digit-4">-</div>
			</div>
			<div class="safe-dial-wrapper">
				<div class="de">
					<div class="den">
						<hr class="line">
						<hr class="line">
						<hr class="line">
						<div class="switch">
							<label class="safe-number" data-number="0"><span>0</span></label>
							<label class="safe-number" data-number="1"><span>1</span></label>
							<label class="safe-number" data-number="2"><span>2</span></label>
							<label class="safe-number" data-number="3"><span>3</span></label>
							<label class="safe-number" data-number="4"><span>4</span></label>
							<label class="safe-number" data-number="5"><span>5</span></label>
							<label class="safe-number" data-number="6"><span>6</span></label>
							<label class="safe-number" data-number="7"><span>7</span></label>
							<label class="safe-number" data-number="8"><span>8</span></label>
							<label class="safe-number" data-number="9"><span>9</span></label>
							<div class="light"><span></span></div>
							<div class="dot"><span></span></div>
							<div class="dene">
								<div class="denem">
									<div class="deneme"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="kodazavstop">
		<div class="logo-container">
			<img src="/media/logo-masa.png" alt="Maša Udovič" id="login-logo-bottom"/>
		</div>
	</div>
</body>
</html>