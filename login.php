<?php 
	include ('header.php');
 ?>

 <body>
 	<div class="ui stackable three column page grid">
 			
 			<div class="four wide column"></div>
 			<div class="eight wide column">
 					<div class="ui basic segment"></div>
 					
 					<form action="checkLogin.php" method="post" class="ui form segment">
 						
 						<h2 class="ui header">Please Login</h2>

 						<div class="field"><label for="username">User Name</label><input type="text" name="username"></div>
 						<div class="field"><label for="password">Password</label><input type="password" name="password"></div>

						<button class="ui fluid green submit button">Submit</button>
 					</form>

 			</div>
 			<div class="four wide column"></div>

 	</div>
 </body>