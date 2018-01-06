<?php

	require("page.php");

	$homepage = new Page();

	$homepage->content = "<form action='/Anderson/php/search.php' method='POST'>
								<span>Search Keyword:</span><input type='text' name='keyword' size='75' maxlength='75' />
							</form>";

	$homepage->Display();
	
?>