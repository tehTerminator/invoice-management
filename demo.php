<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Demo</title>
	
	<script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
	
</head>
<body>

	<div id="output"></div>

	<input type="text" name="product[]">
	<input type="text" name="product[]">
	<input type="text" name="product[]">
	<input type="text" name="product[]">
	<input type="text" name="product[]">

	<button id="demo">Submit</button>

	<script>

	function getData(){
		a = [];
		jQuery("[name='product[]']").each(function(){
			a.push( jQuery(this).val() );
		});

		return a;
	}

	jQuery("#demo").on('click', function(){
		$.ajax({
			url : "TestPost.php",
			type : "post",
			data : $("[name]").serialize(),
			success : function(data){
				jQuery("#output").html( data );
			}
		});
	});

	</script>
	
</body>
</html>