<?php 
	$string = file_get_contents('data/nav-items.json');
	$menuItems = json_decode($string); 
?>


<nav class="ui large inverted purple <?php echo $numbers[count($menuItems)]; ?> item menu" role="navigation">
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
</nav>
