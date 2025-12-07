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
	<link href="/styles/css/indexdifferent.css?ver=<?php echo date(format: "H:is"); ?>" rel="stylesheet">
	<!-- Javascript !-->
	<script src="/styles/js/jquery-3.7.1.min.js"></script>
	<script src="/styles/js/handler.js"></script>
	<!-- Favicon !-->
	<link rel="icon" href="/media/favicon.png" sizes="32x32" />
	<link rel="icon" href="/media/favicon.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="/media/favicon.png" />
	<meta name="msapplication-TileImage" content="/media/favicon.png" />

	<?= smart_js('/styles/js/index.js?v=1', 'defer') ?>

</head>
<body>
	<!-- Glow effect -->
    <div class="glow-ring"></div>

    <!-- Floating pixels -->
    <div class="pixel" style="top:10%; left:15%; animation-delay:0s"></div>
    <div class="pixel" style="top:70%; left:80%; animation-delay:3s"></div>
    <div class="pixel" style="top:40%; left:60%; animation-delay:6s"></div>
    <div class="pixel" style="top:20%; left:75%; animation-delay:9s"></div>

    <!-- Center content -->
    <div class="center-wrap">
        <img src="/media/logo-masa.png" class="logo" alt="Maša Logo">

        <form method="post">
            <input 
                type="text" 
                name="query" 
                class="main-input" 
                placeholder="Type something and press Enter..."
                autofocus
                required
            >
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>