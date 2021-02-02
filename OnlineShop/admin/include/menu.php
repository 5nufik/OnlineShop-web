<div class="container menu">
	<nav class="menu-nav">
		<ul>
			<?php
			$rows = $link->query("SELECT * FROM categories");
			foreach ( $rows as $row )
				echo '<li><a href="view-categories.php?type='.$row['categoryID'].'">'.$row['categoryName'].'</a></li>';
			?>
		</ul>
	</nav>

	<a href="create-product.php" class="new-product my-button">Создать товар</a>
</div>