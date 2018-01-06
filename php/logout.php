<?php

	session_start();
	require "page.php";

	// store to test if they *were* logged in
	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	session_destroy();

	$homepage = new Page();

	$homepage->content = "<!-- page content -->
						  <h2>".$old_user.", you have been logged out!</h2>
						  <p>Browse and search for books!.</p>
						  <img height='800' width='1140' src='../images/andersonbookstore.jpg' />";

	$homepage->DisplayUnAuth();

?>