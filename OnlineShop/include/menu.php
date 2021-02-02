<div class="container menu">
	<nav class="menu-nav">
		<ul>
			<?php 
				include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
				$rows = $link->query("SELECT * FROM categories");
				foreach ( $rows as $row )
					echo '<li><a href="view-categories.php?category='.$row['categoryID'].'">'.$row['categoryName'].'</a></li>';
			?>
		</ul>
	</nav>
	<form method="GET" action="search.php?q=" class="menu-search">
		<input autocomplete="off" type="text" maxlength="128" placeholder="Поиск" class="input-search" name="q" required>
		<div class="button-search">
			<input type="submit" class="search-logo" value=" ">
		</div>
	</form>
</div>