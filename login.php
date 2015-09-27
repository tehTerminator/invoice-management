<?php 
	include ('header.php');
 ?>

 <body>
 	<div class="ui full width stacked page grid">
 			
			<div class="centered eight wide computer sixteen wide mobile twelve wide tablet column">

					
				<form action="checkLogin.php" method="post" class="ui ui middle aligned stacked form segment">
					<h2 class="ui header">Please Login</h2>
					
				
					<div class="field">
						<div class="ui huge left icon input">
							<input type="text" name="username" placeholder="Username">
							<i class="icon user"></i>
						</div>
					</div>
					<div class="field">
						<div class="ui huge left icon input">
							<input type="password" name="password" placeholder="Password">
							<i class="lock icon"></i>
						</div>
					</div>

				<button class="ui huge fluid green submit button">Submit</button>
				</form>

 			</div>

 	</div>
 </body>