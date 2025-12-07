<div style="height: 80px;"></div>
<div id="footer" class=
	<?php
		include_once $_SERVER["DOCUMENT_ROOT"].'/config/config.php';
		if(defined('ENV')){
			$env = ENV;
			if($env!=null){
				echo($env);
			}
		}
	?>
>
	<?php echo date("Y"); ?> Masa Udovic
</div>