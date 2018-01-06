<?php

	session_start();

	require("page.php");

	if(isset($_SESSION['valid_user']))
	{
		$homepage = new Page();

		$homepage->content = "<!-- page content -->
							  <h2>Welcome ".$_SESSION['valid_user'].", to Anderson's Book store!</h2>
							  <p>Browse and search for books!.</p>
							  <img height='800' width='1140' src='../images/andersonbookstore.jpg' />";

		$homepage->Display();
	}
	else
	{
		$homepage = new Page();

		$homepage->content = "<!-- page content -->
							  <h2>Welcome to Anderson's Book store!</h2>
							  <p>Browse and search for books!.</p>
							  <img height='800' width='1140' src='../images/andersonbookstore.jpg' />";

		$homepage->DisplayUnAuth();
	}
	
?>



































