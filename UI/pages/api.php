<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Logic/lib.php");
?>
<!DOCTYPE html>
<html>
<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/UI/component/head.php");
?>
<body>
<script type="text/javascript">
	console.log("not ready");
	$(document).ready(function() {
		console.log("ready");
		var request  = $.ajax({
			"url": "<?php echo $_SERVER['DOCUMENT_ROOT'].'/anthe.boets/public_html/TacGen/Logic/lib.php' ?>",
			"method": "POST",
			"dataType": "text"
		});

		request.done(function( msg ) {
  			console.log(msg);
		});
	});
	console.log("not ready");
</script>
</body>
</html>