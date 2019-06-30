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
			"url": "http://dtsl.ehb.be/~anthe.boets/TacGen/Logic/api.php",
			"method": "POST",
			"dataType": "json",
			"data": "{'name': 'pmc'}"
		});

		request.done(function( msg ) {
			console.log("succ")
  			console.log(msg);
		});
		request.fail(function( jqXHR ) {
			console.log("fail");
  			console.log(jqXHR);
		});
	});
	console.log("not ready");
</script>
</body>
</html>