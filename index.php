<?php require_once 'header.php'; ?>

<body>
	
	<div class="column">
		
	<div class="row">
		
		<?php require_once 'nav.php'; ?>

	</div>	
	

	<div class="row">
		
		<div class="ui 1 column page grid">
			
			<main class="column">
				
				<div class="ui dimmer">
					
					<div class="ui large indeterminate text loader" id="task">Please Wait While We Load Things Up.</div>
					<!--
					<div class="ui large indeterminate text loader">Completed <span id="completed">0</span> out of  <span id="totalTask">0</span> Tasks</div>
					-->

				</div>

				<div id="main" class="ui segment" style="min-height:500px">
					

				</div>

			</main>

		</div>


	</div>

	</div>
</body>
</html>