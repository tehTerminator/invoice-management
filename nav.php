<?php 
	$string = file_get_contents('data/nav-items.json');
	$menuItems = json_decode($string); 
?>


<nav class="ui blue menu" role="navigation">
	<?php 
		foreach ($menuItems as $item) {
			echo 	"
					<a class='item' data-link='$item->link'>
						<i class='icon $item->icon'></i>
						$item->name
					</a>
					";
		}
	?>

	<div class="ui right menu">
		<div class="item">
			<div class="ui transparent icon input">
				<input type="text" placeholder="Search">
				<i class="icon search link"></i>
			</div>
		</div>
	</div>
</nav>
