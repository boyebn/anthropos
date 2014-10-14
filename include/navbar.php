<div class="navbar">
	<ul>
		<?php
		
		foreach ($pages as $title => $link)
		{
			echo "<li><a href='$link'>$title</a></li>";
		}
		
		?>
	</ul>
</div>